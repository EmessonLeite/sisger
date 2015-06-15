<?php

class Usuario {

    /** @var ConexaoDAO */
    private $conexao;

    /**
     * __construct
     * Inicializa a conexao
     */
    public function __construct() {
        $this->conexao = new ConexaoDAO('usuarios');
    }

    /**
     * buscarTodos
     * Retorna todos os usuarios cadastrados
     * @param string
     * @return array
     */
    public function buscarTodos($avaliacao = "") {

        /** Verifica se a referencia da avaliacao foi passada como parametro */
        if ($avaliacao != "") {
            $filtro = "WHERE referente = ?";
            $dados = array($avaliacao);
        } else {
            /** Se não tiver sido passado nenhum parametro, inicia o filtro e o array de dados zerados */
            $filtro = "";
            $dados = array();
        }

        /** Monta a query que será executada */
        $query = "SELECT u.id, nome, apelido, foto
                  FROM usuarios as u
                  INNER JOIN usuarioavaliacao
                  ON u.id = idUsuario
                  INNER JOIN avaliacao as a
                  ON a.id = idAvaliacao
                  LEFT OUTER JOIN cargos as c
                  ON c.id = idCargoAvaliacao 
                  {$filtro}
                  ORDER BY ordem, apelido";

        /** Executa a buscar e retorna o resultado */
        return $this->conexao->Buscar($query, $dados);
    }

    /**
     * buscarPorID
     * Retorna os dados de um usuario especifico
     * @param string
     * @return array
     */
    public function buscarPorID($id) {
        $query = "SELECT id, nome, login, foto, apelido, DATE_FORMAT(dataEntrada, '%d/%m/%Y') dataEntrada, telefone, email FROM [tabela] WHERE id = ?";
        $dados = array($id);
        return $this->conexao->Buscar($query, $dados);
    }

    /**
     * addComentarios
     * Incrementa o numero de comentarios do usuario
     * 
     * @param string
     * @return array
     */
    public function addComentarios($id, $idAvaliacao) {
        if ($this->usuarioCadastrado($id, $idAvaliacao)) {
            $query = "UPDATE usuarioavaliacao SET comentarios = comentarios + 1 WHERE idUsuario = ? AND idAvaliacao = ?";
            $dados = array("id" => $id, "idAvaliacao" => $idAvaliacao);
            return $this->conexao->Buscar($query, $dados);
        } else {
            return 0;
        }
    }

    /**
     * usuarioCadastrado
     * Verifica se o usuario esta cadastrado na avaliacao
     * 
     * @param int $id
     * @param int $idAvaliacao
     * @return array
     */
    private function usuarioCadastrado($id, $idAvaliacao) {
        $query = "SELECT COUNT(id) FROM usuarioavaliacao WHERE idUsuario = ? AND idAvaliacao = ?";
        $dados = array("id" => $id, "idAvaliacao" => $idAvaliacao);
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
