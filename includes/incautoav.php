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

var_dump($dadosAutoAvaliacao);


/** Include a pagina home */
include_once('../pages/pgautoav.php');