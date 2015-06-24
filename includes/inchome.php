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

/** @var array Dados de todas as avaliações */
$avaliacoes = $avaliacaoBusiness->buscarTodas();

/** @var string URL para pgInfogerais */
$infoURL = "?referencia={$avaliacao[0]['referente']}&id={$idUsuarioSelecionado}" ;

/** @var array Comentarios negativos deste usuario nesta avaliacao */
$comentariosPositivos = $comentario->buscar($idUsuarioSelecionado, $avaliacao[0]['id'], '1');

/** @var array Comentarios positivos deste usuario nesta avaliacao  */
$comentariosNegativos = $comentario->buscar($idUsuarioSelecionado, $avaliacao[0]['id'], '0');

/** @var AutoAvaliacao */
$autoAvalicao = AutoAvaliacao::getInstance($avaliacao[0]['referente'], $idUsuarioSelecionado);

/**
 * @var array
 * Dados da autoAvalicao do Usuario selecionado
 */
$dadosAutoAvaliacao = $autoAvalicao->buscar();


/** Include a pagina home */
include_once('pages/pghome.php');