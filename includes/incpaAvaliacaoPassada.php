<?php
/** Inclui o arquivo de configurações gerais do projeto */
include_once('../Classes/config.inc.php');

/** @var AutoAvaliacao */
$avaliacaoPassada = AvaliacaoPassada::getInstance($_GET['referencia'], $_GET['id']);

/**
 * @var array
 * Dados da autoAvalicao do Usuario selecionado
 */
$dadosAvaliacaoPassada = $avaliacaoPassada->buscar();

/** Include a pagina home */
include_once('../pages/pgpaAvaliacaoPassada.php');