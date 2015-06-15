<?php

class Avaliacao {
    
    /** @var ConexaoDAO */
    private $conexao;
    
    /** @var string */
    private $avaliacao;
    
    /**
     * __construct
     * Recebe a avaliacao e inicializa a conexao
     * @param string
     */
    public function __construct($avaliacao){
        $this->conexao = new ConexaoDAO('avaliacao');
        $this->avaliacao = $avaliacao;
    }
    
    /**
     * buscar
     * Retorna os dados da avaliacao indicada na variavel $avaliacao
     * @return array
     */
    public function buscar(){
        if($this->avaliacao != ""){
            $query = "SELECT id, inicio, fim, referente FROM [tabela] WHERE referente = ?";
            $dados = array($this->avaliacao);
        }else{
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
     * @return array
     */
    public function buscarTodas(){
        $query = "SELECT id, referente, inicio, fim FROM avaliacao ORDER BY inicio";
        return $this->buscar($query);
    }


    public function buscarDadosUsuario($idUsuario){
        $query = "SELECT horasTrabalhadas, folgas, faltas, atrasos, videosLivros, comentarios, cargo
                  FROM usuarioavaliacao
                  INNER JOIN avaliacao as a
                  ON a.id = idAvaliacao
                  LEFT OUTER JOIN cargos as c
                  ON idCargoAvaliacao = c.id
                  WHERE referente = ? AND idUsuario = ?";
        $dados = array($this->avaliacao, $idUsuario);
        return $this->conexao->Buscar($query, $dados);
    }
    
    
    /**
     * Retorna uma instância única de uma classe.
     * @staticvar Singleton $instance A instância única dessa classe.
     * @return Singleton A Instância única.
     */
    public static function getInstance($avaliacao)
    {
        /** Inicializa a var instance e retorna */
        static $instance = null;
        if (null === $instance) {
            $instance = new static($avaliacao);
        }

        return $instance;
    }
}