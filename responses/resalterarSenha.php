<?php

include_once('../Classes/Config.inc.php');

/** Recebe o formulario */
$form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

/** @var Usuario */
$usuario = Usuario::getInstance();

/** */
session_start();

if (isset($_SESSION['id']) && is_int($_SESSION['id']) && is_string($_SESSION['apelido']) && $form['idUsuario'] == $_SESSION['id']) {
    /**
     * 
     */
    echo $usuario->editarSenha($form['idUsuario'], $form['senhaAtual'], $form['novaSenha'], $form['confirmarSenha']);
} else {
    /**
     * 
     */
    echo "Você não está logado com este Usuario";
}