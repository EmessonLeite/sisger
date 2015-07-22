<?php

class Avaliacao {

    /** @var ConexaoDAO */
    private $conexao;

    /** @var string */
    private $avaliacao;

    /**
     * __construct
     * Recebe a avaliacao e inicializa a conexao
     * 
     * @param string referencia da avaliacao atual
     */
    public function __construct($avaliacao) {
        $this->conexao = new ConexaoDAO('pa_avaliacao');
        $this->avaliacao = $avaliacao;
    }

    /**
     * cadastrar
     * Cadastra um novo cargo
     *
     * @param array $dados
     * @return int
     */
    public function cadastrar($dados) {
        (isset($dados['inicio'])) ? $dados['inicio'] = dateTimesql($dados['inicio']) : '' ;
        (isset($dados['fim'])) ? $dados['fim'] = dateTimesql($dados['fim']) : '' ;
        (isset($dados['inicioComentario'])) ? $dados['inicioComentario'] = dateTimesql($dados['inicioComentario']) : '' ;
        (isset($dados['fimComentario'])) ? $dados['fimComentario'] = dateTimesql($dados['fimComentario']) : '' ;
        (isset($dados['inicioAutoAva'])) ? $dados['inicioAutoAva'] = dateTimesql($dados['inicioAutoAva']) : '' ;
        (isset($dados['fimAutoAva'])) ? $dados['fimAutoAva'] = dateTimesql($dados['fimAutoAva']) : '' ;

        /** @var int */
        $idCargo = $this->conexao->Cadastrar($dados);

        return $idCargo;
    }

    /**
     * editar
     * Editar um cargo existente
     *
     * @param array $dados
     * @return int
     */
    public function editar($dados) {
        (isset($dados['inicio'])) ? $dados['inicio'] = dateTimesql($dados['inicio']) : '' ;
        (isset($dados['fim'])) ? $dados['fim'] = dateTimesql($dados['fim']) : '' ;
        (isset($dados['inicioComentario'])) ? $dados['inicioComentario'] = dateTimesql($dados['inicioComentario']) : '' ;
        (isset($dados['fimComentario'])) ? $dados['fimComentario'] = dateTimesql($dados['fimComentario']) : '' ;
        (isset($dados['inicioAutoAva'])) ? $dados['inicioAutoAva'] = dateTimesql($dados['inicioAutoAva']) : '' ;
        (isset($dados['fimAutoAva'])) ? $dados['fimAutoAva'] = dateTimesql($dados['fimAutoAva']) : '' ;

        /** @var int */
        $this->conexao->Editar($dados);

        return $dados['id'];
    }

    /**
     * excluir
     * Exclui um cargo existente
     *
     * @param int
     * @return int
     */
    public function excluir($id) {
        return $this->conexao->Deletar($id);
    }

    /**
     * buscar
     * Retorna os dados da avaliacao indicada na variavel $avaliacao
     * 
     * @return array Dados de todas as avaliacoes
     */
    public function buscar() {
        if ($this->avaliacao != "") {
            $query = "SELECT id, inicio, fim, inicioComentario, fimComentario, inicioAutoAva, fimAutoAva, referente FROM [tabela] WHERE referente = ?";
            $dados = array($this->avaliacao);
        } else {
            $query = "SELECT id, inicio, fim, inicioComentario, fimComentario, inicioAutoAva, fimAutoAva, referente FROM [tabela] WHERE NOW() > inicio ORDER BY inicio DESC LIMIT 0, 1";
            $dados = array();
        }

        /** @var array */
        $result = $this->conexao->Buscar($query, $dados);

        /** Seta o valor da referencia com o valor retornado da pesquisa */
        $this->avaliacao = $result[0]['referente'];

        return $result;
    }

    /**
     * buscarTodas
     * Retorna todas as avaliações cadastradas
     * 
     * @return array Dados de todas as avaliacoes
     */
    public function buscarTodas($dados = array()) {

        /** @var string */
        $filtro = "";

        /** Monta o filtro na consulta */
        if (count($dados) > 0) {
            $filtro = 'WHERE ' . implode(" LIKE ? OR ", array_keys($dados)) . " LIKE ?";
        }

        /** Consulta para retornar as avaliacoes */
        $query = "SELECT id, referente, inicio, inicioComentario, fimComentario, inicioAutoAva, fimAutoAva, fim FROM [tabela] {$filtro} ORDER BY inicio";

        /** Executa e retorna a consulta */
        return $this->conexao->Buscar($query, $dados);
    }

    /**
     * buscarPorID
     * Retorna os dados de um cargo especifico
     * @param string
     * @return array
     */
    public function buscarPorID($id) {
        $query = "SELECT id, referente, inicio, inicioComentario, fimComentario, inicioAutoAva, fimAutoAva, fim FROM [tabela] WHERE id = ?";
        $dados = array($id);
        return $this->conexao->Buscar($query, $dados);
    }

    /**
     * buscarDadosUsuario
     * Retorna todos os dados do usuario selecionado
     * 
     * @param int $idUsuario ID do usuario selecionado
     * @return array Dados do usuario selecionado
     */
    public function buscarDadosUsuario($idUsuario) {
        /** @var string */
        $query = "SELECT horasTrabalhadas, folgas, faltas, atrasos, videosLivros, comentarios, c.id as idCargo, idAvaliacao, idUsuario, cargo
                  FROM pa_usuarioavaliacao
                  INNER JOIN pa_avaliacao as a
                  ON a.id = idAvaliacao
                  LEFT OUTER JOIN cargos as c
                  ON idCargoAvaliacao = c.id
                  WHERE referente = ? AND idUsuario = ?";

        /** @var array */
        $dados = array($this->avaliacao, $idUsuario);

        /** @var array */
        $retorno = $this->conexao->Buscar($query, $dados);

        if (!$retorno) {
            $retorno = array(array(
                    "comentarios" => "0",
                    "cargo" => "-",
                    "horasTrabalhadas" => "-",
                    "folgas" => "-",
                    "faltas" => "-",
                    "atrasos" => "-",
                    "videosLivros" => "-",
                    "erro" => "Usuário não cadastrado nesta avaliação."
            ));
        }

        return $retorno;
    }
    
    /**
     * checarUsuarioAvaliacao
     * Verifica se o usuario esta cadastrado nesta avaliacao
     * 
     * @param int $idUsuario ID do usuario selecionado
     * @return bool
     */
    public function checarUsuarioAvaliacao($idUsuario){
        $query = "SELECT COUNT(*) as qtd
                  FROM pa_usuarioavaliacao ua
                  LEFT JOIN pa_avaliacao a
                  ON ua.idAvaliacao = a.id
                  WHERE referente = ? AND idUsuario = ?";
        
        $dados = array($this->avaliacao, $idUsuario);
        
        $retorno = $this->conexao->Buscar($query, $dados);
        
        return $retorno[0]['qtd'];
    }

    /**
     * getInstance
     * Retorna uma instância única de uma classe.
     * 
     * @staticvar Singleton $instance A instância única dessa classe.
     * @return Singleton A Instância única.
     */
    public static function getInstance($avaliacao) {
        /** Inicializa a var instance e retorna */
        static $instance = null;
        if (null === $instance) {
            $instance = new static($avaliacao);
        }

        return $instance;
    }

}
