<?php

require_once('pages/email.php');
$parametro = base64_decode($url->getURL(1));
$data = substr($parametro, 0, 10);
$dataAtual = strtotime(date("Y-m-d H:i:s"));
$id = substr($parametro, 10);
$erro = '';

if ($dataAtual < $data + 1800) {
    if (isset($_POST['enviar']) && is_string($_POST['enviar'])) {
        $senha = $_POST['senha'];
        $confSenha = $_POST['confsenha'];

        if ($senha == $confSenha) {
            if (atualizaSenha($senha, $id)) {
                $info = "Senha redefinida com sucesso.";
                echo "<meta http-equiv='refresh' content=1;url='" . RAIZ . "login'>";
            } else {
                $erro = "Erro ao redefinir senha. Digite novamente.";
            }
        } else {
            $erro = "As senha não combinam. Digite novamente.";
        }
    }
} else {
    $erro = "O link expirou. Solicite outro email.";
    echo "<meta http-equiv='refresh' content=5;url='" . RAIZ . "recuperaSenha'>";
}

$erro = ($erro != '') ? "<p id='erro'>{$erro}</p>" : '';
$info = (isset($info)) ? "<p id='info'>{$info}</p>" : '';

include_once('pages/pgredefine.php');
