<?php
require_once('email.php');

if (isset($_POST['enviar'])) {
    $senha = $_POST['senha'];
    $confSenha = $_POST['confsenha'];
    $id = $url->getURL(1);

    if ($senha == $confSenha) {
        if(atualizaSenha($senha,$id)) {
            echo "Senha redefinida.";
        }
        else {
            echo "Erro ao redefinir senha.";
        }
    }
    else {
        echo "As senha não combinam. Digite novamente";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Redefinir Senha</title>
    <link rel="stylesheet" type="text/css" href="../css/redefine.css">
</head>
<body>
<div id="login">
    <div id="icon">
        <img id="icon" src="../imagens/logo.png">
    </div>
    <form method="post">
        <div id="inputs">
            <p id="info"></p>
            <input type="password" name="senha" class="id" id="id" required="required" placeholder="Nova Senha" >
            <br /><input type="password" name="confsenha" class="log" id="pass" required="required" placeholder="Confime sua senha">
            <br />
            <input  value="Redefinir"  type="submit" id="button" name="enviar">
        </div>
    </form>
</div>
</body>
</html>
