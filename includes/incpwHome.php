<?php

/** @var Horario */
$horarioBusiness = Horario::getInstance($idUsuario);

$horarioBusiness->corrigir();
//$horarioBusiness->darEntrada();


//var_dump($horarioBusiness->buscar());

/** Inclue a pagina inicial do ponto */
include_once('pages/pgpwHome.php');