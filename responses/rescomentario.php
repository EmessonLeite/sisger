<?php
include_once('../Classes/Config.inc.php');

/** Recebe o formulario */
$form = filter_input_array(INPUT_POST, FILTER_DEFAULT);

/** @var Comentario */
$comentario = Comentario::getInstance();

$idComentario = $comentario->cadastrar($form);

/** Retorna se o comentario foi inserido */
echo ($idComentario > 0) ? true : false;