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
     * buscarTodos
     * Retorna todos os cargos cadastrados
     * @return array
     */
    public function buscarTodos() {
        
        $query = "SELECT id, cargo FROM [tabela] ORDER BY ordem";
        
        return $this->conexao->Buscar($query);
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
