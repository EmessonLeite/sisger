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

/** Include a pagina home */
include_once('../pages/pgpaAvaliacaoPassada.php');