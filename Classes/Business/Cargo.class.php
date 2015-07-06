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
    public function cadastrar($dados){

        return $this->conexao->Cadastrar($dados);
    }

    /**
     * editar
     * Editar um cargo existente
     *
     * @param array $dados
     * @return int
     */
    public function editar($dados){

        return $this->conexao->Editar($dados);
    }

    /**
     * excluir
     * Exclui um cargo existente
     *
     * @param int
     * @return int
     */
    public function excluir($id){
        return $this->conexao->Deletar($id);
    }

    /**
     * buscar
     * retorna os cargos cadastrados
     *
     * @param array $dados que serão usuados para filtrar
     * @return array
     */
    public function buscar($dados = array()){

        /** @var string */
        $filtro = "";

        /** Monta o filtro na consulta */
        if(count($dados) > 0){
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
