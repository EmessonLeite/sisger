<?php
class Login {
    /** @var ConexaoDAO */
    private $conexao;
    
    /** @var string */
    private $login;
    
    /** @var string */
    private $senha;
    
    /**
     * __construct
     * Recebe o login e senha e inicializa a conexao
     * @param string
     * @param string
     */
    public function __construct($login, $senha){
        $this->conexao = new ConexaoDAO('usuarios');
        $this->login = $login;
        $this->senha = $senha;
    }
    
    /**
     * consultar
     * Retorna o numero de usuarios existentes com este login e senha
     * @return array
     */
    public function consultar(){
        $query = "SELECT id, apelido, foto FROM [tabela] WHERE login=? AND senha=PASSWORD(?)";
        $dados = array($this->login, $this->senha);
        return $this->conexao->Buscar($query, $dados);
    }
    
    /**
     * Retorna uma instância única de uma classe.
     * @staticvar Singleton $instance A instância única dessa classe.
     * @return Singleton A Instância única.
     */
    public static function getInstance($login, $senha)
    {
        /** Inicializa a var instance e retorna */
        static $instance = null;
        if (null === $instance) {
            $instance = new static($login, $senha);
        }

        return $instance;
    }
}