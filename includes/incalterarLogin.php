<?php

/** @var Usuario */
$usuarioBusiness = Usuario::getInstance();

/** @var array */
$dadosUsuario = $usuarioBusiness->buscarPorID($idUsuario);

/** Include da pagina de alterarção de login */
include_once('pages/pgalterarLogin.php');
