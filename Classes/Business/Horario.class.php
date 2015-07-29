<?php

class Horario extends ConexaoDAO {

    /**
     * __construct
     * Inicializa a conexao
     */
    public function __construct() {

        /** Inicializa a conexao com o banco */
        parent::__construct('pw_horarios');

        /** seta o fuso horario padrão com o de fortaleza */
        date_default_timezone_set("America/Fortaleza");
    }

    /**
     * DarEntrada
     * Adiciona um novo horario no momento em que foi clicado
     * 
     * @param array $dados informações que serão adicionadas junto com o horario
     * @throws Exception Caso não seja possível adicionar um novo horario
     */
    public function DarEntrada($dados) {

        /** Buscar horarios abertos */
        $horariosAbertos = $this->buscarAberto($dados['idUsuario']);

        /** Verifica se o usuario possui algum horario em aberto */
        if (!count($horariosAbertos)) {
            /** Dados que serão cadastrados no novo horario */
            $dados = array_merge($dados, array('entrada' => date('Y-m-d H:i:00')));

            /** Cadastrar novo horario */
            parent::Cadastrar($dados);
        } else {
            /** gera uma exception caso o usuario não possa inserir um novo horario */
            $message = "Não é possível \"Dar entrada\" com um horário já aberto.";
            throw new Exception($message);
        }
    }

    /**
     * DarSaida
     * Atualiza o horario de saida caso exista algum horario aberto
     * 
     * @throws Exception Caso não seja possível dar saída no horario
     */
    public function DarSaida($idUsuario) {

        /** Buscar horarios abertos */
        $horariosAbertos = $this->buscarAberto($idUsuario);

        /** Verifica se há algum horario aberto */
        if (count($horariosAbertos)) {
            $dados = array(
                'saida' => date('Y-m-d H:i:00'),
                'id' => $horariosAbertos[0]['id']
            );
            
            parent::Editar($dados);
        } else {
            /** gera uma exception caso o usuario não possa inserir um novo horario */
            $message = "Não há horário aberto.";
            throw new Exception($message);
        }
    }

    public function corrigir($dados) {
        $dados['entrada'] = datasql($dados['data']) .  "{$dados['entrada']}:00";
        $dados['saida'] = datasql($dados['data']) .  "{$dados['saida']}:00";
    }

    public function buscarAberto($idUsuario) {
        $query = "SELECT id FROM [tabela] WHERE saida IS NULL AND idUsuario = ?";
        $dados = array('idUsuario' => $idUsuario);
        return parent::Buscar($query, $dados);
    }

    /**
     * buscar
     * Buscar os horarios de um determinado usuario
     * 
     * @param array dados a serem filtrados
     * @return array
     */
    public function BuscarHorarios($filtro) {

        /** Consulta para retonaros horario seguindo os filtros selecionado */
        $query = "SELECT DATE_FORMAT(entrada, '%d/%m/%Y') data,
                         DATE_FORMAT(entrada, '%H:%i') entrada,
                         DATE_FORMAT(saida, '%H:%i') saida,
                         DATE_FORMAT(TIMEDIFF(saida, entrada), '%H:%i') total,
                         id, remuneracao, atividade, celulaMidia, coordenador, entradaAjuste, saidaAjuste, motivoAjuste
                  FROM pw_horarios h
                  WHERE idUsuario = ?
                  AND entrada BETWEEN ? AND ?"
                . ((isset($filtro['remuneracao'])) ? " AND remuneracao LIKE ?" : "" )
                . ((isset($filtro['atividade'])) ? " AND atividade LIKE ?" : "" )
                . ((isset($filtro['celulaMidia'])) ? " AND celulaMidia LIKE ?" : "" )
                . ((isset($filtro['coordenador'])) ? " AND coordenador LIKE ?" : "" )
                . " ORDER BY h.entrada DESC";

        /** retorna os dados selecionado */
        return parent::Buscar($query, $filtro);
    }

    public function getUsuarios() {
        /** Consulta para retonar os usuarios que utilizam o ponto */
        $query = "SELECT u.id, u.apelido
                  FROM usuarios u
                  JOIN cargos c
                  ON u.cargo = c.id
                  WHERE status = 1 AND c.ordem > (SELECT ordem FROM cargos WHERE cargo = 'Aspirante')
                  ORDER BY apelido";

        /** retorna os dados selecionado */
        return parent::Buscar($query);
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
