<?php

class AvaliacaoPassada {

    /** @var ConexaoDAO */
    private $conexao;

    /** @var string */
    private $avaliacao;

    /** @var int */
    private $idUsuario;

    /**
     * __construct
     * Recebe a avaliacao e o ID do usuario e inicializa a conexao
     * 
     * @param string referencia da avaliacao atual
     * @param int ID do usuario selecionado
     */
    public function __construct($avaliacao, $idUsuario) {
        
        /** Inicializa a conexao */
        $this->conexao = new ConexaoDAO('pa_avaliacaopassada');
        
        /** Inicializa a referencia da avalaicao */
        $this->avaliacao = $avaliacao;
        
        /** Inicializa o ID do Usuario */
        $this->idUsuario = $idUsuario;
        
        /** Inicializa os valores caso não tenha sido cadastrado */
        $this->inicializarValores();
    }
    
    
    /**
     * editar
     * Edita a AvaliacaoPassada do usuario selecionado.
     * 
     * @param array
     * @return int  
     */
    public function editar($dados){
        /** @var int */
        $id = $this->buscarID();        
        
        /** @var array */
        $dadosCompletos = array_merge($dados, array('id' => $id));
        
        /** @var int */
        return $this->conexao->Editar($dadosCompletos);
    }
    
    /**
     * buscar
     * Retorna os dados da avaliacao indicada na variavel $avaliacao
     * 
     * @return array Dados de todas as avaliacoes
     */
    public function buscar() {

        $query = "SELECT p.*
                  FROM pa_avaliacaopassada as p
                  INNER JOIN pa_avaliacao as a
                  ON p.idAvaliacao = a.id
                  WHERE referente = ? AND idUsuario = ?";
        $dados = array($this->avaliacao, $this->idUsuario);

        /** @var array */
        $resultado = $this->conexao->Buscar($query, $dados);
        
        return $resultado[0];
    }
    
    /**
     * buscarID
     * Retorna o id da avaliacaoPassada do Usuario nesta avaliacao
     * 
     * @return int
     */
    private function buscarID(){
        $query = "SELECT p.id
                  FROM pa_avaliacaopassada as p
                  INNER JOIN pa_avaliacao as a
                  ON p.idAvaliacao = a.id
                  WHERE referente = ? AND idUsuario = ?";
        $dados = array($this->avaliacao, $this->idUsuario);

        /** @var array */
        $resultado = $this->conexao->Buscar($query, $dados);
        
        return $resultado[0]['id'];
    }
    
    /**
     * inicializarValores
     * Inicializa os valores caso a avaliacaoPassada ainda não tenha sido inicializada.
     */
    private function inicializarValores(){
        if (!$this->verificarSeExiste()) {

            /** @var Avaliacao */
            $usuarioAvaliacao = Avaliacao::getInstance($this->avaliacao);
            
            /** @var array */
            $dadosUsuario = $usuarioAvaliacao->buscarDadosUsuario($this->idUsuario);
            
            /** @var Quesito */
            $quesito = Quesito::getInstance($dadosUsuario[0]['idCargo']);
            
            /** @var array */
            $quesitos = $quesito->buscar();

            /** @var array */
            $dados = array(
                "idUsuario" => $dadosUsuario[0]['idUsuario'],
                "idAvaliacao" => $dadosUsuario[0]['idAvaliacao']
            );
            
            for($i = 1; $i <= count($quesitos); $i++){
                $dados = array_merge($dados, array("quesito{$i}" => $quesitos[$i - 1]['quesito']));
            }
            
            $this->conexao->Cadastrar($dados);
            
        }
    }
    
    /**
     * verificarSeExiste
     * Verifica se a avaliacaoPassada foi inicializada.
     * 
     * @return int
     */
    private function verificarSeExiste() {
        $query = "SELECT COUNT(*) as qtd FROM [tabela]
                 INNER JOIN pa_avaliacao as a
                 ON a.id = idAvaliacao
                 WHERE idUsuario = ? AND referente = ?";

        $dados = array($this->idUsuario, $this->avaliacao);

        /** @var array */
        $result = $this->conexao->Buscar($query, $dados);

        return $result[0]['qtd'];
    }

    /**
     * getInstance
     * Retorna uma instância única de uma classe.
     * 
     * @staticvar Singleton $instance A instância única dessa classe.
     * @return Singleton A Instância única.
     */
    public static function getInstance($avaliacao, $idUsuario) {
        /** Inicializa a var instance e retorna */
        static $instance = null;
        if (null === $instance) {
            $instance = new static($avaliacao, $idUsuario);
        }

        return $instance;
    }

}
