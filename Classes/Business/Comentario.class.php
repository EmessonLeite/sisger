<?php

class Comentario {

    /** @var ConexaoDAO */
    private $conexao;

    /**
     * __construct
     * Inicializa a conexao
     */
    public function __construct() {
        $this->conexao = new ConexaoDAO('pa_comentarios');
    }

    /**
     * cadastrar
     * Cadastra um novo comentario e incrementa o numero de comentarios do usuario
     * @param array
     * @return int
     */
    public function cadastrar($dadosComentario) {

        /** Separa o ID do usuario logado do restante dos dados */
        $idUsuario = $dadosComentario['idUsuarioLogado'];
        unset($dadosComentario['idUsuarioLogado']);

        /** Incrementa o numero de comentarios do usuario logado */
        $usuario = Usuario::getInstance();
        $usuario->addComentarios($idUsuario, $dadosComentario['idAvaliacao']);

        /** Cadastra um novo comentario e retorna o ID gerado */
        return $this->conexao->Cadastrar($dadosComentario);
    }

    /**
     * excluir
     * Exclui um usuario existente
     *
     * @param int
     * @return int
     */
    public function excluir($id){
        return $this->conexao->Deletar($id);
    }

    /**
     * buscar
     * Retorna os comentarios de um usuario em uma determinada avaliacao
     * @param int $idUsuario
     * @param int $idAvaliacao
     * @param boolean $tipo
     * @return array
     */
    public function buscar($idUsuario, $idAvaliacao, $tipo) {
        $query = "SELECT id, comentario FROM [tabela] WHERE tipo = ? AND idUsuario = ? AND idAvaliacao = ?";
        $dados = array($tipo, $idUsuario, $idAvaliacao);

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
