<?php

class AutoAvaliacao {

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
        $this->conexao = new ConexaoDAO('autoavaliacao');
        $this->avaliacao = $avaliacao;
        $this->idUsuario = $idUsuario;
    }
    
    /**
     * cadastrar
     * Cadastra uma nova auto-avaliacao neste usuario
     * @param array
     * @return int
     */
    public function cadastrar($dados) {
        //deletar se já existir e cadastrar uma nova
    }

    /**
     * buscar
     * Retorna os dados da avaliacao indicada na variavel $avaliacao
     * 
     * @return array Dados de todas as avaliacoes
     */
    public function buscar() {
        $query = "SELECT * FROM [tabela] WHERE referente = ? AND idUsuario = ?";
        $dados = array($this->avaliacao, $this->idUsuario);

        /** @var array */
        $result = $this->conexao->Buscar($query, $dados);

        /** Seta o valor da referencia com o valor retornado da pesquisa */
        $this->avaliacao = $result[0];

        return $result;
    }

}
