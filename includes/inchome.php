<?php
/** @var Usuario */
$usuarioBusiness = Usuario::getInstance();

/** @var Comentario */
$comentario = Comentario::getInstance();


/**
 * Referencia da avaliacao selecionada para visualização
 * @var string 
 */
$avaliacao = $avaliacaoBusiness->buscar();

/**
 * ID do usuario selecionado para visualização
 * @var string
 */
$idUsuarioSelecionado = ($url->posicaoExiste(2)) ? $url->getURL(2) : $idUsuario;

/**
 * Posicao atual do menu de funcionarios
 * @var string
 */
$top = ($url->posicaoExiste(3)) ? $url->getURL(3) : '0';

$dadosUsuarioSelecionado = $usuarioBusiness->buscarPorID($idUsuarioSelecionado);
$dadosUsuarioAvaliacao = $avaliacaoBusiness->buscarDadosUsuario($idUsuarioSelecionado);
$usuariosAvaliacao = $usuarioBusiness->buscarTodos($avaliacao[0]['referente']);

/** URL para pgInfogerais */
$infoURL = "?referencia={$avaliacao[0]['referente']}&id={$idUsuarioSelecionado}" ;

/** @var array  */
$comentariosPositivos = $comentario->buscar($idUsuarioSelecionado, $avaliacao[0]['id'], '1');

/** @var array  */
$comentariosNegativos = $comentario->buscar($idUsuarioSelecionado, $avaliacao[0]['id'], '0');

/** Include a pagina home */
include_once('pages/pghome.php');