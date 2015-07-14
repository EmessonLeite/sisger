<?php

class Cargo {

    /** @var ConexaoDAO */
    private $conexao;

    /**
     * __construct
     * Inicializa a conexao
     */
    public function __construct() {
        $this->conexao = new ConexaoDAO('cargos');
    }

    /**
     * cadastrar
     * Cadastra um novo cargo
     *
     * @param array $dados
     * @return int
     */
    public function cadastrar($dados) {
        /** @var array */
        $quesitos = json_decode($dados['quesitos']);

        /** Remove o indice quesitos do array de dados */
        unset($dados['quesitos']);

        /** Remove o indice quesitoAdd do array de dados */
        unset($dados['quesitoAdd']);

        /** @var int */
        $idCargo = $this->conexao->Cadastrar($dados);

        for ($i = 1; $i <= count($quesitos); $i++) {
            $quesitoBusiness = Quesito::getInstance($idCargo);
            $quesitoBusiness->cadastrar(array(
                'ordem' => $i,
                'quesito' => $quesitos[$i - 1],
                'idCargo' => $idCargo
            ));
        }

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
        /** @var array */
        $quesitos = json_decode($dados['quesitos']);

        /** Remove o indice quesitos do array de dados */
        unset($dados['quesitos']);

        /** Remove o indice quesitoAdd do array de dados */
        unset($dados['quesitoAdd']);

        /** @var int */
        $this->conexao->Editar($dados);

        $quesitoBusiness = Quesito::getInstance($dados['id']);
        $quesitoBusiness->excluirTodos();

        for ($i = 1; $i <= count($quesitos); $i++) {

            $quesitoBusiness->cadastrar(array(
                'ordem' => $i,
                'quesito' => $quesitos[$i - 1],
                'idCargo' => $dados['id']
            ));
        }

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
     * retorna os cargos cadastrados
     *
     * @param array $dados que serão usuados para filtrar
     * @return array
     */
    public function buscar($dados = array()) {

        /** @var string */
        $filtro = "";

        /** Monta o filtro na consulta */
        if (count($dados) > 0) {
            $filtro = 'WHERE ' . implode(" LIKE ? OR ", array_keys($dados)) . " LIKE ?";
        }

        /** Consulta para retornar os cargos */
        $query = "
                  SELECT id, ordem, cargo
                  FROM cargos
                  {$filtro}
                  ORDER BY ordem
        ";

        /** Executa e retorna a consulta */
        return $this->conexao->Buscar($query, $dados);
    }

    /**
     * buscarTodos
     * Retorna todos os cargos cadastrados
     * @return array
     */
    public function buscarTodos() {

        $query = "SELECT id, ordem, cargo FROM [tabela] ORDER BY ordem";

        return $this->conexao->Buscar($query);
    }

    /**
     * buscarPorID
     * Retorna os dados de um cargo especifico
     * @param string
     * @return array
     */
    public function buscarPorID($id) {
        $query = "SELECT id, ordem, cargo FROM [tabela] WHERE id = ?";
        $dados = array($id);
        return $this->conexao->Buscar($query, $dados);
    }

    /**
     * Retorna uma instância única de uma classe.
     * @staticvar Singleton $instance A instância única dessa classe.
     * @return Singleton A Instância única.
     */
    public static function getInstance() {
        /** Inicializa a var instance e retorna */
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }

}
