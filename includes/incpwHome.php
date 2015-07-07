<?php

/** @var Horario */
$horarioBusiness = Horario::getInstance($idUsuario);

$horarioBusiness->darEntrada();

var_dump($horarioBusiness->buscar());