<?php

/**
 * $permissoes[1] indica se o usuario possui permissao de gestão de cargos
 * Caso a permissão não seja valida, redireciona para a pagina erro 404
 */
Permissao::validar(isset($permissoes[1]));

/** @var Usuario */
$cargoBusiness = Cargo::getInstance();

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
            $cargoBusiness->cadastrar($form);
        } else {
            /** Remove o indice tipo da array */
            unset($form['tipo']);

            /** Executa a atualização de um usuario */
            $cargoBusiness->editar($form);
        }

        /** Redireciona para a listagem */
        echo "<script>window.location = '" . RAIZ . "{$url->getURL(0)}';</script>";
        exit;
    }

    if ($url->getURL(1) == 'editar') {
        $dadosCargo = $cargoBusiness->buscarPorID($url->getURL(2));
    }

    /** Include da pagina de configuração de perfil */
    include_once("pages/pgForm{$url->getURL(0)}.php");
    exit;
} elseif ($url->posicaoExiste(1) && $url->getURL(1) == 'excluir') {

    $erro = "";

    /** Executa a exclusão de um usuario */
    try {
        $cargoBusiness->excluir($url->getURL(2));
        echo "<script>window.location = '" . RAIZ . "{$url->getURL(0)}';</script>";
    } catch (Exception $ex) {
        echo "<script>window.location = '" . RAIZ . "{$url->getURL(0)}/erro/{$url->getURL(2)}';</script>";
    }

    exit;
}


if(isset($form['filtro'])){
    $filtro = array(
        'ordem' => "%{$form['filtro']}%",
        'cargo' => "%{$form['filtro']}%"
    );
}

else{
    $filtro = array();
}

/** @var array */
$dadosCargos = $cargoBusiness->buscar($filtro);


if ($url->posicaoExiste(1) && $url->getURL(1) == 'erro') {

    /** Dados usuario erro ao exlcuir */
    $dadosCargoErro = $cargoBusiness->buscarPorID($url->getURL(2));

    $erroExcluir = "<p class='erro'>Erro ao exlcuir o cargo.</p>";
} else {
    $erroExcluir = "";
}

/** Include da pagina de configuração de perfil */
include_once("pages/pg{$url->getURL(0)}.php");


?>