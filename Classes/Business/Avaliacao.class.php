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
     * buscar
     * Retorna os dados da avaliacao indicada na variavel $avaliacao
     * 
     * @return array Dados de todas as avaliacoes
     */
    public function buscar() {
        if ($this->avaliacao != "") {
            $query = "SELECT id, inicio, fim, referente FROM [tabela] WHERE referente = ?";
            $dados = array($this->avaliacao);
        } else {
            $query = "SELECT id, inicio, fim, referente FROM [tabela] WHERE NOW() > inicio ORDER BY inicio DESC LIMIT 0, 1";
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
    public function buscarTodas() {
        $query = "SELECT id, referente, inicio, fim FROM [tabela] ORDER BY inicio";
        return $this->conexao->buscar($query);
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
