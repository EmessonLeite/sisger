<?php

class Horario {

    /** @var ConexaoDAO */
    private $conexao;
    
    /** @var int */
    private $idUsuario;
    
    /**
     * __construct
     * Inicializa a conexao
     */
    public function __construct($idUsuario) {
        
        /** Inicializa a conexao com o banco e o ID usuario  */
        $this->conexao = new ConexaoDAO('pw_horarios');
        $this->idUsuario = $idUsuario;
    }
    
    
    public function darEntrada(){
        $horariosAbertos = $this->buscarAberto();
               
        if(!count($horariosAbertos)){
            $dados = array('entrada' => date('Y-m-d h:i:s'), 'idUsuario' => $this->idUsuario);
            $this->conexao->Cadastrar($dados);
        } else {
            echo '<br /><br /><br />';
            echo 'Horário aberto!';
        }
        
    }
    
    public function darSaida(){
        
        $horariosAbertos = $this->buscarAberto();
        
        if(count($horariosAbertos) != 0){
            $dados = array('saida' => date('Y-m-d h:i:s'), 'id' => $horariosAbertos[0]['id']);
            $this->conexao->Editar($dados);
        } else {/*
            echo '<br /><br /><br />';
            echo 'Não há horário aberto!';*/
        }
    }
    
    public function corrigir(){
        $query = "SELECT * FROM [tabela] WHERE idUsuario = ? ";
        $dados = array('idUsuario' => $this->idUsuario);
        $corrigir = $this->conexao->Buscar($query, $dados);
        /*echo '<br /><br /><br />';*/
    }
    
    public function buscarAberto(){
        $query = "SELECT id FROM [tabela] WHERE saida IS NULL AND idUsuario = ?";
        $dados = array('idUsuario' => $this->idUsuario);
        return $this->conexao->Buscar($query, $dados);
    }


    /**
     * buscar
     * Buscar os horarios de um determinado usuario
     * 
     * @param array dados a serem filtrados
     * @return array
     */
    public function buscar($dadosFiltrar = array()){
        $query = "SELECT * FROM pw_horarios WHERE idUsuario = ?";
        
        $dados = array_merge($dadosFiltrar, array('idUsuario' => $this->idUsuario));
        return $this->conexao->Buscar($query, $dados);
    }

    /**
     * Retorna uma instância única de uma classe.
     * @staticvar Singleton $instance A instância única dessa classe.
     * @return Singleton A Instância única.
     */
    public static function getInstance($idUsuario) {
        /** Inicializa a var instance e retorna */
        static $instance = null;
        if (null === $instance) {
            $instance = new static($idUsuario);
        }

        return $instance;
    }

}
