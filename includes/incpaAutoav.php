<?php
/** Inclui o arquivo de configurações gerais do projeto */
include_once('../Classes/config.inc.php');

/** @var AutoAvaliacao */
$autoAvalicao = AutoAvaliacao::getInstance($_GET['referencia'], $_GET['id']);

/**
 * @var array
 * Dados da autoAvalicao do Usuario selecionado
 */
$dadosAutoAvaliacao = $autoAvalicao->buscar();

$idUsuarioSelecionado = $_GET['id'];

session_start();

/**Verifica se a sessão existe */
if (isset($_SESSION['id']) && is_int($_SESSION['id']) && is_string($_SESSION['apelido'])) {
    /**
     * ID do usuario logado
     * @var int
     */
    $idUsuario = $_SESSION['id'];

    /**
     * Apelido do usuario logado
     * @var string
     */
    $apelido = $_SESSION['apelido'];

    /**
     * Foto do usuario logado
     * @var string
     */
    $foto = $_SESSION['foto'];
}

/** Include a pagina home */
include_once('../pages/pgautoav.php');