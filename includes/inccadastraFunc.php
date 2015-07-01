<?php

/**
 * $permissoes[1] indica se o usuario possui permissao de gestão de funcionarios
 * Caso a permissão não seja valida, redireciona para a pagina erro 404
 */
Permissao::validar(isset($permissoes[1]));

/** Include o formulario de cadastro/edição de funcionarios */
if ($url->posicaoExiste(1) && ($url->getURL(1) == 'novo' || $url->getURL(1) == 'editar')) {
    /** Include da pagina de configuração de perfil */
    include_once("pages/pgForm{$url->getURL(0)}.php");
    exit;
}

/** @var Usuario */
$usuarioBusiness = Usuario::getInstance();

/** @var array */
$dadosUsuarios = $usuarioBusiness->buscar();

/** Include da pagina de configuração de perfil */
include_once("pages/pg{$url->getURL(0)}.php");
