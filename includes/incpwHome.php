<?php

/** @var Horario */
$horarioBusiness = Horario::getInstance($idUsuario);

/** Recebe o formulario */
$form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

/** Verifica se o formulario enviado é para abrir o horario */
if(isset($form['abrirHorario'])){
    unset($form['abrirHorario']);
    $horarioBusiness->darEntrada($form);
}

echo "<br /><br /><br /><br />";
var_dump($_POST);

/** Inclue a pagina inicial do ponto */
include_once('pages/pgpwHome.php');