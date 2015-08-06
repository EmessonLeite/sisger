<?php

/**
 * $permissoes[6] indica se o usuario possui permissao de previsualizar comentários
 * Caso a permissão não seja valida, redireciona para a pagina erro 404
 */
Permissao::validar(isset($permissoes[6]));

/** @var Usuario */
$usuarioBusiness = Usuario::getInstance();

/** Recebe o formulario */
$form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

/** Include o formulario de cadastro/edição de funcionarios */
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
            $usuarioBusiness->cadastrar($form);
        } else {
            /** Remove o indice tipo da array */
            unset($form['tipo']);

            /** Executa a atualização de um usuario */
            $usuarioBusiness->editar($form);
        }

        /** Redireciona para a listagem */
        echo "<script>window.location = '" . RAIZ . "{$url->getURL(0)}';</script>";
        exit;
    }

    if ($url->getURL(1) == 'editar') {
        $dadosUsuario = $usuarioBusiness->buscarPorID($url->getURL(2));

    } else {
        $foto = "default.jpg";
    }

    /** Include da pagina de configuração de perfil e o rodape */
    include_once("pages/pgForm{$url->getURL(0)}.php");
    include_once('includes/incrodape.php');
    exit;
} elseif ($url->posicaoExiste(1) && $url->getURL(1) == 'excluir') {

    $erro = "";

    /** Executa a exclusão de um usuario */
    try {
        $usuarioBusiness->excluir($url->getURL(2));
        echo "<script>window.location = '" . RAIZ . "{$url->getURL(0)}';</script>";
    } catch (Exception $ex) {
        echo "<script>window.location = '" . RAIZ . "{$url->getURL(0)}/erro/{$url->getURL(2)}';</script>";
    }

    exit;
}


if(isset($form['filtro'])){
    $filtro = array(
        'nome' => "%{$form['filtro']}%",
        'email' => "%{$form['filtro']}%",
        'c.cargo' => "%{$form['filtro']}%"
    );
}else{
    $filtro = array();
}
/** @var array */
$dadosUsuarios = $usuarioBusiness->buscar($filtro);

/*
if ($url->posicaoExiste(1) && $url->getURL(1) == 'erro') {

    /** Dados usuario erro ao exlcuir
    $dadosUsuarioErro = $usuarioBusiness->buscarPorID($url->getURL(2));

    $erroExcluir = "<p class='erro'>Erro ao exlcuir o usuário '{$dadosUsuarioErro[0]['apelido']}'. Ele(a) está cadastrado em alguma das avaliações.</p>";
} else {
    $erroExcluir = "";
}*/

/** Include da pagina de configuração de perfil */
include_once("pages/pg{$url->getURL(0)}.php");
