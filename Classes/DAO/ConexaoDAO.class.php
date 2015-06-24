<?php

class ConexaoDAO {

    /** @var myqli */
    private $mysqli;

    /** @var mysqli_stmt */
    private $stmt;

    /** @var string */
    private $tabela;

    /** @var string */
    private $query;

    /** @var array */
    private $result;

    /**
     * __construct
     * Inicializa a conexao, guarda o nome da tabela e verifica se ocorreu algum erro.
     * 
     * @param string
     * @throws  Exception
     * 
     */
    public function __construct($tabela) {

        /** Recebe o valor da tabela */
        if ($tabela != '') {
            $this->tabela = $tabela;
        } else {
            /** Mensagem de erro */
            $message = "O nome da tabela não pode ser vazio.";

            /** Gera uma nova exceção */
            throw new Exception($message);
        }
    }

    /**
     * Cadastrar
     * Cadastrar uma nova tupla no banco de dados.
     * 
     * @param array
     * @throws Exception
     * @return int
     */
    public function Cadastrar(array $dados) {

        /** Verificar se a dados a serem inseridos */
        $this->verificarDados($dados);

        /** Abre a conexao com o banco */
        $this->openConnection();

        /** Concatena os campos em que serão inseridos valores  */
        $campos = implode(", ", array_keys($dados));

        /** Concatena a posição dos varios valores que serão inseridos */
        $valores = "?" . str_repeat(", ?", count($dados) - 1);

        /** Monta a query */
        $this->query = "INSERT INTO {$this->tabela} ({$campos}) VALUES ({$valores})";

        /** Prepara o Statement */
        $this->stmt = $this->mysqli->prepare($this->query);

        /** Função que executa a query */
        $this->executar($dados);

        /** Retorna o id do item inserido */
        return $this->maxID();
    }

    /**
     * Editar
     * Edita uma tupla na tabela pelo ID.
     * 
     * @param array
     * @throws Exception
     * @return int
     */
    public function Editar(array $dados) {

        /** Verificar se a dados a serem editados */
        $this->verificarDados($dados);

        /** Abre a conexao com o banco */
        $this->openConnection();

        /** Concatenas os campos que serão editados */
        $campos = implode("= ?, ", array_keys($dados)) . "= ?";

        /** Monta a query  */
        $this->query = "UPDATE {$this->tabela} SET {$campos} WHERE id = ?";

        /** Prepara a consulta */
        $this->stmt = $this->mysqli->prepare($this->query);

        /** Adiciona o ID no final da array, para ser inserido no place do WHERE */
        $dados[] = $dados['id'];

        /** Executa o comando */
        $this->executar($dados);

        /** Retorna o ID da tupla editada */
        return $dados['id'];
    }

    /**
     * Deletar
     * Deleta uma tupla na tabela pelo ID.
     * 
     * @param int
     * @return int
     */
    public function Deletar($id) {

        /** Abre a conexao com o banco */
        $this->openConnection();

        /** Monta a query  */
        $this->query = "DELETE FROM {$this->tabela} WHERE id = ?";

        /** Prepara a consulta */
        $this->stmt = $this->mysqli->prepare($this->query);

        /** Executa o comando */
        $this->executar(array($id));

        /** Retorna o ID da tupla excluida */
        return $id;
    }

    /**
     * BuscarPorID
     * Busca uma tupla na tabela pelo ID.
     * 
     * @param array
     * @throws Exception
     */
    public function BuscarPorID(array $dados) {

        /** Verificar se a dados a serem selecionados */
        $this->verificarDados($dados);

        /** Verificar se a dados a serem selecionados */
        $campos = ($dados > 1) ? implode(', ', array_keys($dados)) : '*';

        /** Adiciona o ID no final da array, para ser inserido no place do WHERE */
        $dados[] = $dados['id'];

        /** Abre a conexao com o banco */
        $this->openConnection();

        /** Monta a query  */
        $this->query = "SELECT {$campos} FROM {$this->tabela} WHERE id = ?";

        /** Prepara a consulta */
        $this->stmt = $this->mysqli->prepare($this->query);

        /** Executa o comando */
        $this->executar($dados);

        return $this->result;
    }

    /**
     * Buscar
     * Busca generica, é necessario informar a query e os places.
     * 
     * @param string
     * @throws Exception
     */
    public function Buscar($query, array $dados = array()) {

        /** Abre a conexao com o banco */
        $this->openConnection();

        /** Monta a query  */
        $this->query = str_replace('[tabela]', $this->tabela, $query);

        /** Prepara a consulta */
        $this->stmt = $this->mysqli->prepare($this->query);

        /** Executa o comando */
        $this->executar($dados);

        /** Retona o resultado da consulta */
        return $this->result;
    }

    /**
     * openConnection
     * Abre a conexao com o banco.
     * 
     * @throws Exception
     */
    protected function openConnection() {
        /** Inicializar a conexao com o banco */
        $this->mysqli = new mysqli(HOST, USER, PASS, DBSA);

        /** Define o padrão do banco como UTF-8 */
        $this->mysqli->set_charset('utf8');

        /** Verifica se ocorreu algum erro */
        if (mysqli_connect_errno()) {
            /** Mensagem de erro */
            $message = "Erro ao conectar com o banco: " . mysqli_connect_error();

            /** Gera uma nova exceção */
            throw new Exception($message);
        }
    }

    /**
     * executar
     * Recebe os dados, monta o bind_param e executa.
     * 
     * @param array
     * @throws Exception
     */
    protected function executar(array $dados) {

        /** @var array */
        $params = $this->prepararDados($dados);

        /** Passa os paramentros ao bind_param */
        if (count($dados) > 0) {
            if ($this->stmt) {
                call_user_func_array(array($this->stmt, 'bind_param'), $this->makeValuesReferenced($params));
            } else {
                throw new Exception("Erro ao executar \"{$this->mysqli->error}\"", $this->mysqli->errno);
            }
        }

        /** Executa a consulta e verifica se ocorreu algum erro */
        if (!$this->stmt->execute()) {
            throw new Exception("Erro ao executar: (" . $this->stmt->error . ") ", $this->stmt->errno);
        }

        /** Preenche o array de dados caso haja algum retorno */
        $this->result = array();
        $r = $this->stmt->get_result();

        if ($r) {
            while ($row = $r->fetch_assoc()) {
                $this->result[] = $row;
            }
        }

        /** Fecha o stamtment e a conexao com o banco */
        $this->stmt->close();
        $this->mysqli->close();
    }

    /**
     * makeValuesReferenced
     * Gera uma array de referencias apartir de um array de valores
     * 
     * @return array
     */
    protected function makeValuesReferenced(&$arr) {
        $refs = array();
        foreach (array_keys($arr) as $key) {
            $refs[$key] = &$arr[$key];
        }
        return $refs;
    }

    /**
     * maxID
     * Retorna o maior ID cadastrado no banco.
     * 
     * @throw Exception
     * @return int
     */
    protected function maxID() {

        /** Abre a conexao com o banco */
        $this->openConnection();

        /** Monta a query */
        $this->query = "SELECT IFNULL(MAX(id), 0) as max FROM {$this->tabela}";

        /** Executa a consulta */
        $result = $this->mysqli->query($this->query);


        /** Busca o resultado da consulta */
        $linha = $result->fetch_assoc();


        /** Fecha a conexao com o banco */
        $this->mysqli->close();


        /** Retorna o maior ID na tabela */
        return $linha['max'];
    }

    /**
     * proximoID
     * Retorna o proximo ID a ser inserido no banco.
     * 
     * @throw Exception
     * @return int
     */
    protected function proximoID() {
        /** Abre a conexao com o banco */
        $this->openConnection();

        /** Monta a query */
        $this->query = "SHOW TABLE STATUS WHERE Name = '{$this->tabela}';";

        /** Executa a consulta */
        $result = $this->mysqli->query($this->query);

        /** Busca o resultado da consulta */
        $linha = $result->fetch_assoc();

        /** Fecha a conexao com o banco */
        $this->mysqli->close();


        /** Retorna o proximo ID no Auto_increment */
        return (int) $linha['Auto_increment'] + 1;
    }

    /**
     * prepararDados
     * Prepara os dados para deixar no formato que sera utilizado no bind_param.
     * 
     * @param array
     * @return array
     */
    private function prepararDados(array $dados) {
        /** Array com os parametros que serão passados ao bind_param */
        $params = array("");

        /** Preenche a array de paramentros */
        foreach ($dados as $dado) {
            $params[0] .= $this->tipoParametro($dado);
            $params[] = $dado;
        }

        return $params;
    }

    /**
     * tipoParametro
     * Verifica o tipo da variavel e retorna o identificador referente ao tipo.
     * 
     * @param string
     * @return string
     */
    private function tipoParametro($dado) {
        /** Variavel que contem o identificador referente ao tipo */
        $tipo = "s";

        /** Alterar o tipo do identificador caso não seja string */
        switch (gettype($dado)) {
            case "boolean":
                $tipo = "i";
                break;
            case "integer":
                $tipo = "i";
                break;
            case "double":
                $tipo = "d";
                break;
        }

        return $tipo;
    }

    /**
     * verificarDados
     * Verifica se existe dados ou se a array esta nula.
     * 
     * @param array
     * @throws Exception
     */
    private function verificarDados(array $dados) {
        /** Verifica se há dados para serem iseridos */
        if (!isset($dados) || count($dados) == 0) {

            /** Mensagem de erro */
            $message = "Impossivel executar instrução. Nenhum dado foi enviado.";

            /** Gera uma nova exceção */
            throw new Exception($message);
        }
    }

}
