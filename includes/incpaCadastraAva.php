<?php

/**
 * $permissoes[1] indica se o usuario possui permissao de gestão de cargos
 * Caso a permissão não seja valida, redireciona para a pagina erro 404
 */
Permissao::validar(isset($permissoes[1]));

/** @var Usuario */
$avaliacaoBusiness = Avaliacao::getInstance('');

/** Recebe o formulario */
$form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

/** Include o formulario de cadastro/edição de cargos */
if ($url->posicaoExiste(1) && ($url->getURL(1) == 'novo' || $url->getURL(1) == 'editar')) {

    /** Verifica se o form foi enviado */
    if (isset($form['cadastrar'])) {

        /** Remove o indice cadastrar da array */
        unset($form['cadastrar']);

        /** Verifica se o form é de cadastro ou atualização */
        if ($form['tipo'] == 'novo') {
            /** Remove o indice tipo da array */
            unset($form['tipo']);

            /** Executa o cadastro do usuario */
            $avaliacaoBusiness->cadastrar($form);
        } else {
            /** Remove o indice tipo da array */
            unset($form['tipo']);

            /** Executa a atualização de um usuario */
            $avaliacaoBusiness->editar($form);
        }

        /** Redireciona para a listagem */
        echo "<script>window.location = '" . RAIZ . "{$url->getURL(0)}';</script>";
        exit;
    }

    if ($url->getURL(1) == 'editar') {
        $dadosAvaliacao = $avaliacaoBusiness->buscarPorID($url->getURL(2));
        (isset($dadosAvaliacao[0]['inicio'])) ? $dadosAvaliacao[0]['inicio'] = dateTimebr($dadosAvaliacao[0]['inicio']) : '' ;
        (isset($dadosAvaliacao[0]['fim'])) ? $dadosAvaliacao[0]['fim'] = dateTimebr($dadosAvaliacao[0]['fim']) : '' ;
        (isset($dadosAvaliacao[0]['inicioComentario'])) ? $dadosAvaliacao[0]['inicioComentario'] = dateTimebr($dadosAvaliacao[0]['inicioComentario']) : '' ;
        (isset($dadosAvaliacao[0]['fimComentario'])) ? $dadosAvaliacao[0]['fimComentario'] = dateTimebr($dadosAvaliacao[0]['fimComentario']) : '' ;
        (isset($dadosAvaliacao[0]['inicioAutoAva'])) ? $dadosAvaliacao[0]['inicioAutoAva'] = dateTimebr($dadosAvaliacao[0]['inicioAutoAva']) : '' ;
        (isset($dadosAvaliacao[0]['fimAutoAva'])) ? $dadosAvaliacao[0]['fimAutoAva'] = dateTimebr($dadosAvaliacao[0]['fimAutoAva']) : '' ;
    }

    /** Include da pagina de configuração de perfil e o rodape */
    include_once("pages/pgpaFormCadastraAvaliacao.php");
    include_once('includes/incrodape.php');
    exit;
} elseif ($url->posicaoExiste(1) && $url->getURL(1) == 'excluir') {

    $erro = "";

    /** Executa a exclusão de uma avaliacao */
    try {
        $avaliacaoBusiness->excluir($url->getURL(2));
        echo "<script>window.location = '" . RAIZ . "{$url->getURL(0)}';</script>";
    } catch (Exception $ex) {
        echo "<script>window.location = '" . RAIZ . "{$url->getURL(0)}/erro/{$url->getURL(2)}';</script>";
    }

    exit;
}


if(isset($form['filtro'])){
    $filtro = array(
        'referente' => "%{$form['filtro']}%",
        'inicio' => "%{$form['filtro']}%",
        'fim' => "%{$form['filtro']}%"
    );
}

else{
    $filtro = array();
}

/** @var array */
$dadosAvaliacao = $avaliacaoBusiness->buscarTodas($filtro);


if ($url->posicaoExiste(1) && $url->getURL(1) == 'erro') {

    /** Dados usuario erro ao exlcuir */
    $dadosAvaliacaoErro = $avaliacaoBusiness->buscarPorID($url->getURL(2));

    $erroExcluir = "<p class='erroCargo'>Erro ao exlcuir a avaliação.</p>";
} else {
    $erroExcluir = "";
}

/** Include da pagina de configuração de perfil */
include_once('pages/pgpaCadastraAva.php');