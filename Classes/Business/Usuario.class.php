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
     * cadastrar
     * Cadastra um novo usuario
     * 
     * @param array $dados
     * @return int
     */
    public function cadastrar($dados){

        (isset($dados['dataEntrada'])) ? $dados['dataEntrada'] = dateTimesql($dados['dataEntrada']) : '' ;
        (isset($dados['dataNascimento'])) ? $dados['dataNascimento'] = dateTimesql($dados['dataNascimento']) : '' ;
        
        return $this->conexao->Cadastrar($dados);
    }
    
    /**
     * editar
     * Editar um usuario existente
     * 
     * @param array $dados
     * @return int
     */
    public function editar($dados){

        (isset($dados['dataEntrada'])) ? $dados['dataEntrada'] = dateTimesql($dados['dataEntrada']) : '' ;
        (isset($dados['dataNascimento'])) ? $dados['dataNascimento'] = dateTimesql($dados['dataNascimento']) : '' ;
        
        return $this->conexao->Editar($dados);
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
     * retorna os usuarios cadastrados
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
        /** Consulta para retornar os usuarios */
        $query = "SELECT u.*, c.cargo
                  FROM usuarios as u
                  LEFT JOIN cargos as c
                  ON u.cargo = c.id
                  {$filtro}
                  ORDER BY status DESC, c.ordem ASC, u.nome ASC";
                  
        /** Executa e retorna a consulta */
        return $this->conexao->Buscar($query, $dados);
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
                  INNER JOIN pa_usuarioavaliacao
                  ON u.id = idUsuario
                  INNER JOIN pa_avaliacao as a
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
        $query = "SELECT id, nome, login, foto, apelido, dataEntrada, telefone, email, cargo, status, cep, cpf, rg, dataNascimento, endereco, bairro, sexo, nomePai, nomeMae FROM [tabela] WHERE id = ?";
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
            $query = "UPDATE pa_usuarioavaliacao SET comentarios = comentarios + 1 WHERE idUsuario = ? AND idAvaliacao = ?";
            $dados = array("id" => $id, "idAvaliacao" => $idAvaliacao);
            return $this->conexao->Buscar($query, $dados);
        } else {
            return 0;
        }
    }

    /**
     * editar
     * Recebe os dados do usuario e atualiza no banco
     * 
     * @param array
     * @return string
     */
    public function editarSenha($idUsuario, $senhaAtual, $novaSenha, $confirmarSenha) {
        if ($this->validarSenha($idUsuario, $senhaAtual)) {

            if ($novaSenha == "") {
                $retorno = "O campo nova senha não pode ser vazio.";
            }
            elseif ($novaSenha == $confirmarSenha) {
                /** Query para alterar senha */
                $query = "UPDATE [tabela] SET senha = PASSWORD(?) WHERE id = ? ";

                /** Dados para alterar a senha */
                $dados = array($novaSenha, $idUsuario);

                /** Executa a ação no banco */
                $this->conexao->Buscar($query, $dados);
                $retorno = "true";
                
            }
            else {
                $retorno = "Os campos \"nova senha\" e \"confirmar nova senha\" não conferem, por favor, preencha novamente.";
            }
        } else {
            $retorno = "A senha atual não está correta, por favor, preencha novamente com a sua senha atual.";
        }

        return $retorno;
    }
    
    /**
     * editarLogin
     * Alterar o login de um usuario
     * 
     * @param int $idUsuario ID do usuario selecionado
     * @param string $novoLogin login que será atualizado no banco
     * @return int
     */
    public function editarLogin($idUsuario, $novoLogin){
        /** Query para atualiza o login do usuario */
        $query = "UPDATE [tabela] SET login = ? WHERE id = ?";
        
        /** Parametros para a consulta */
        $dados = array($novoLogin, $idUsuario);
        
        /** Executar a consulta no banco */
        $this->conexao->Buscar($query, $dados);
        return "true";
    }

    /**
     * validarSenha
     * Verifica se a senha informada esta correta
     * 
     * @param type $idUsuario ID do usuario logado
     * @param type $senha Senha informada pelo usuario
     * @return int
     */
    private function validarSenha($idUsuario, $senha) {
        /** Query para verificar se a senha esta correta */
        $query = "SELECT COUNT(*) as qtd FROM [tabela] WHERE id = ? AND senha = PASSWORD(?)";

        /** Parametros para a query */
        $dados = array($idUsuario, $senha);

        /** Executa a consulta */
        $retorno = $this->conexao->Buscar($query, $dados);

        return $retorno[0]['qtd'];
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
        $query = "SELECT COUNT(id) FROM pa_usuarioavaliacao WHERE idUsuario = ? AND idAvaliacao = ?";
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
