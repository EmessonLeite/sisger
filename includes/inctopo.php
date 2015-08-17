<?php

/** @var string */
$arqJS = "";

/** @var string */
$arqCSS = "";

/** Referencia da Avaliacao passada na URL */
$referenciaAvaliacao = ($url->posicaoExiste(1)) ? $url->getURL(1) : "";

/** @var Avaliacao */
$avaliacaoBusiness = Avaliacao::getInstance($referenciaAvaliacao);

/**
 * Referencia da avaliacao selecionada para visualização
 * @var string
 */
$avaliacao = $avaliacaoBusiness->buscar();

/**Verifica se o arquivo de js da pagina atual existe */
if(file_exists("js/{$url->getURL(0)}.js")){
    $arqJS = "<script src='js/{$url->getURL(0)}.js'></script>";
}

/**Verifica se o arquivo de css da pagina atual existe */
if(file_exists("css/{$url->getURL(0)}.css")){
    $arqCSS = "<link rel='stylesheet' type='text/css' href='css/{$url->getURL(0)}.css'>";
}

/** Inclue a pagina do topo */
include_once('pages/pgtopo.php');