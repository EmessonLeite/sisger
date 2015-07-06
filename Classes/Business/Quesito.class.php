<?php

class Quesito {

    /** @var ConexaoDAO */
    private $conexao;

    /** @var string */
    private $idCargo;

    /**
     * __construct
     * Recebe a ID de um cargo e inicializa a conexao
     * 
     * @param int ID do cargo 
     */
    public function __construct($idCargo) {
        $this->conexao = new ConexaoDAO('pa_quesitos');
        $this->idCargo = $idCargo;
    }
    
    /**
     * cadastrar
     * Cadastra uma nova auto-avaliacao neste usuario
     * @param array
     * @return int
     */
    public function cadastrar($dados) {
        //Implementar o cadastro de cargos
    }

    /**
     * buscar
     * Retorna os dados dos quesitos indicados no idCargo
     * 
     * @return array Dados de todas as avaliacoes
     */
    public function buscar() {
        $query = "SELECT * FROM [tabela] WHERE idCargo = ? ORDER BY ordem ASC";
        $dados = array($this->idCargo);

        /** @var array */
        $result = $this->conexao->Buscar($query, $dados);

        return $result;
    }
    
    /**
     * getInstance
     * Retorna uma instância única de uma classe.
     * 
     * @staticvar Singleton $instance A instância única dessa classe.
     * @return Singleton A Instância única.
     */
    public static function getInstance($idCargo) {
        /** Inicializa a var instance e retorna */
        static $instance = null;
        if (null === $instance) {
            $instance = new static($idCargo);
        }

        return $instance;
    }

}
