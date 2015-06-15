<?php
/** Inclui o arquivo de configurações gerais do projeto */
include_once('../Classes/config.inc.php');

/** @var Usuario */
$usuarioBusiness = Usuario::getInstance();

/** Referencia da Avaliacao passada na URL */
$referenciaAvaliacao = $_GET['referencia'];

/** @var Avaliacao */
$avaliacaoBusiness = Avaliacao::getInstance($referenciaAvaliacao);

/**
 * Referencia da avaliacao selecionada para visualização
 * @var string 
 */
$avaliacao = $avaliacaoBusiness->buscar();

/**
 * ID do usuario selecionado para visualização
 * @var string
 */
$idUsuarioSelecionado = $_GET['id'];

$dadosUsuarioSelecionado = $usuarioBusiness->buscarPorID($idUsuarioSelecionado);
$dadosUsuarioAvaliacao = $avaliacaoBusiness->buscarDadosUsuario($idUsuarioSelecionado);

/** Include a pagina home */
include_once('../pages/pgavaliacaoPassada.php');