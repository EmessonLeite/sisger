<?php
/** Inclui o arquivo de configurações gerais do projeto */
include_once('../Classes/config.inc.php');

/** Valida os dados enviados via URL */
if (is_string($_GET['referencia']) && is_numeric($_GET['id'])) {
    $idUsuarioSelecionado = $_GET['id'];
    $referencia = $_GET['referencia'];
}else{
    echo "ERRO AO CARREGAR AVALIAÇÃO PASSADA.";
    exit;
}

/** @var AutoAvaliacao */
$avaliacaoPassada = AvaliacaoPassada::getInstance($referencia, $idUsuarioSelecionado);

/**
 * @var array
 * Dados da autoAvalicao do Usuario selecionado
 */
$dadosAvaliacaoPassada = $avaliacaoPassada->buscar();

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

/** @var Permissao */
$permissao = Permissao::getInstance();

/**
 * Permissoes do usuario logado
 * @var array
 */
$p = $permissao->buscarPorUsuario($idUsuario);
$permissoes = array();

for ($i = 0; $i < count($p); $i++) {
    $permissoes[$p[$i]['id']] = $p[$i]['nome'];
}

/** Include a pagina home */
include_once('../pages/pgpaAvaliacaoPassada.php');