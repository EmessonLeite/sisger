<?php

/** Inclui o arquivo de configurações gerais do projeto */
include_once('../Classes/config.inc.php');

/** Valida os dados enviados via URL */
if (is_string($_GET['referencia']) && is_numeric($_GET['id'])) {
    $idUsuarioSelecionado = $_GET['id'];
    $referencia = $_GET['referencia'];
}else{
    echo "ERRO AO CARREGAR AUTOAVALIAÇÃO";
    exit;
}

/** @var Avaliacao */
$avaliacaoBusiness = Avaliacao::getInstance($referencia);

/**
 * Referencia da avaliacao selecionada para visualização
 * @var string
 */
$avaliacao = $avaliacaoBusiness->buscar();

/** @var AutoAvaliacao */
$autoAvalicao = AutoAvaliacao::getInstance($referencia, $idUsuarioSelecionado);

/**
 * @var array
 * Dados da autoAvalicao do Usuario selecionado
 */
$dadosAutoAvaliacao = $autoAvalicao->buscar();

session_start();

/* * Verifica se a sessão existe */
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

/** Verificar se o usuario logado esta cadastrado na avaliacao atual */
$usuarioCadastrado = $avaliacaoBusiness->checarUsuarioAvaliacao($idUsuario);

/** Include a pagina home */
include_once('../pages/pgpaAutoav.php');
