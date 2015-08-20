<?php

/**
 * $permissoes[6] indica se o usuario possui permissao de previsualizar comentários
 * Caso a permissão não seja valida, redireciona para a pagina erro 404
 */
Permissao::validar(isset($permissoes[6]));

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
 * Todos os usuarios cadastrados em determinanda avaliação
 * @var string
 */
$usuariosAvaliacao = $usuarioBusiness->buscarTodos($avaliacao[0]['referente']);

/** @var array Comentarios negativos deste usuario nesta avaliacao */
$comentariosPositivos = $comentario->buscar($idUsuarioSelecionado, $avaliacao[0]['id'], '1');

/** @var array Comentarios positivos deste usuario nesta avaliacao  */
$comentariosNegativos = $comentario->buscar($idUsuarioSelecionado, $avaliacao[0]['id'], '0');

/** Recebe o formulario */
$form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

/** Checa se está tentando excluir algum comentário */
if ($url->posicaoExiste(1) && $url->getURL(1) == 'excluir') {

    $erro = "";

    /** Executa a exclusão de um comentário */
    try {
        $comentario->excluir($url->getURL(2));
        echo "<script>window.location = '" . RAIZ . "{$url->getURL(0)}';</script>";
    } catch (Exception $ex) {
        echo "<script>window.location = '" . RAIZ . "{$url->getURL(0)}/erro/{$url->getURL(2)}';</script>";
    }

    exit;
}

/** Include o formulario de cadastro/edição de funcionarios */
if ($url->posicaoExiste(1)) {

    /** Include da pagina de listagem de comentários */
    include_once("pages/pgpaListaComentarios.php");
    include_once('includes/incrodape.php');
    exit;
}

if (strtotime(date("Y-m-d h:i:s")) > strtotime($avaliacao[0]['fimComentario']) && ($avaliacao[0]['fimComentario'] != '0000-00-00 00:00:00') && ($avaliacao[0]['fimComentario'] != NULL)) {
    /** Include da pagina de configuração de perfil */
    include_once("pages/pg{$url->getURL(0)}.php");
}
else{
    echo '<script language= "JavaScript">
            location.href="' . RAIZ . 'erro404";
          </script>';
    exit;
}
