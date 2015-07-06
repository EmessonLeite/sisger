<?php

class Permissao {

    /** @var ConexaoDAO */
    private $conexao;

    /**
     * 
     */
    public function __construct() {
        $this->conexao = new ConexaoDAO("pa_permissoes");
    }

    /**
     * 
     */
    public function cadastrar($dados) {
        return $this->conexao->Cadastrar($dados);
    }

    /**
     * 
     */
    public function editar() {
        
    }

    /**
     * 
     */
    public function deletar() {
        
    }

    /**
     * buscarPorUsuario
     * Retorna as permissoes cadastradas para um usuario
     * 
     * @param int $idUsuario 
     * @return array
     */
    public function buscarPorUsuario($idUsuario) {

        /** @var string */
        $query = "SELECT p.id, p.nome
                  FROM pa_permissoes p
                  INNER JOIN pa_permissoesusuarios pu
                  ON p.id = pu.idPermissao
                  WHERE idUsuario = ?";

        /** @var array */
        $dados = array($idUsuario);

        /** @var array */
        $resultado = $this->conexao->Buscar($query, $dados);

        return $resultado;
    }
    
    /**
     * validar
     * redireciona para a  pagina erro404 caso a permissão não seja valida
     * 
     * @param bool $valido 
     */
    public static function validar($valido) {
        if (!$valido) {
            echo '<script language= "JavaScript">
                    location.href="' . RAIZ . 'erro404";
                  </script>';
            exit;
        }
    }

    /**
     * getInstance
     * Retorna uma instância única de uma classe.
     * 
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
