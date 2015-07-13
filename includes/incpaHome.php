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
$infoURL = "?referencia={$avaliacao[0]['referente']}&id={$idUsuarioSelecionado}";

/** @var array Comentarios negativos deste usuario nesta avaliacao */
$comentariosPositivos = $comentario->buscar($idUsuarioSelecionado, $avaliacao[0]['id'], '1');

/** @var array Comentarios positivos deste usuario nesta avaliacao  */
$comentariosNegativos = $comentario->buscar($idUsuarioSelecionado, $avaliacao[0]['id'], '0');

/** @var AutoAvaliacao */
if (!isset($dadosUsuarioAvaliacao[0]['erro'])) {
    $autoAvalicao = AutoAvaliacao::getInstance($avaliacao[0]['referente'], $idUsuarioSelecionado);
    $avaliacaoPassada = AvaliacaoPassada::getInstance($avaliacao[0]['referente'], $idUsuarioSelecionado);
}

/** @var AutoAvaliacao */
$avaliacaoPassada = AvaliacaoPassada::getInstance($avaliacao[0]['referente'], $idUsuarioSelecionado);

/**
 * @var array
 * Dados da autoAvalicao do Usuario selecionado
 */
$dadosAvaliacaoPassada = $avaliacaoPassada->buscar();

/** Recebe o formulario */
$form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

/**Verifica qual das abas deve ser selecionada */
if (isset($form['salvarAutoAva'])) {
    unset($form['salvarAutoAva']);
    $autoAvalicao->editar($form);
    $conteudoIframe = "includes/incpaAutoav.php{$infoURL}";
    $geral = false;
} elseif (isset($form['salvarAvaliacaoPassada'])) {
    unset($form['salvarAvaliacaoPassada']);
    $avaliacaoPassada->editar($form);
    $conteudoIframe = "includes/incpaAvaliacaoPassada.php{$infoURL}";
    $geral = false;
} else {
    $conteudoIframe = "includes/incpaInfogerais.php{$infoURL}";
    $geral = true;
}

/**
 * @var array
 * Dados da autoAvalicao do Usuario selecionado
 */
if (!isset($dadosUsuarioAvaliacao[0]['erro'])) {
    $dadosAutoAvaliacao = $autoAvalicao->buscar();
}

/** Verificar se o usuario logado esta cadastrado na avaliacao atual */
$usuarioCadastrado = $avaliacaoBusiness->checarUsuarioAvaliacao($idUsuario);

/** Include a pagina home */
include_once('pages/pgpaHome.php');
