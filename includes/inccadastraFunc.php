<?php

/**
 * $permissoes[1] indica se o usuario possui permissao de gestão de funcionarios
 * Caso a permissão não seja valida, redireciona para a pagina erro 404
 */
Permissao::validar(isset($permissoes[1]));

/** @var Usuario */
$usuarioBusiness = Usuario::getInstance();


/** Include o formulario de cadastro/edição de funcionarios */
if ($url->posicaoExiste(1) && ($url->getURL(1) == 'novo' || $url->getURL(1) == 'editar')) {

    /** Recebe o formulario */
    $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

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
            
            /** Executa a atualização do usuario */
        }

        /** Redireciona para a listagem */
        echo "<script>window.location = '" . RAIZ . "{$url->getURL(0)}';</script>";
        exit;
    }

    /** @var Cargo */
    $cargosBusiness = Cargo::getInstance();

    /** @var array */
    $cargos = $cargosBusiness->buscarTodos();

    /** Include da pagina de configuração de perfil */
    include_once("pages/pgForm{$url->getURL(0)}.php");
    exit;
}

/** @var array */
$dadosUsuarios = $usuarioBusiness->buscar();

/** Include da pagina de configuração de perfil */
include_once("pages/pg{$url->getURL(0)}.php");
