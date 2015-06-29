<?php

/**
 * $permissoes[1] indica se o usuario possui permissao de gestão de funcionarios
 * Caso a permissão não seja valida, redireciona para a pagina erro 404
 */
Permissao::validar(isset($permissoes[1]));

/** Include da pagina de configuração de perfil */
include_once('pages/pgcadastraFunc.php');
