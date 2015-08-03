<?php

include_once('../Classes/Config.inc.php');

/** Recebe o formulario */
$form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

/** @var Usuario */
$usuario = Usuario::getInstance();

/** Inicia a sessão */
session_start();

if (isset($_SESSION['id']) && is_int($_SESSION['id']) && is_string($_SESSION['apelido'])) {
    
    /** Edita a senha do usuario */
    echo $usuario->editarSenha($_SESSION['id'], $form['senhaAtual'], $form['novaSenha'], $form['confirmarSenha']);
} else {
    
    /** Retorna a mensagem de erro caso o usuario não esteja logado */
    echo "Você não possui permissão para alterar a sua senha.";
}