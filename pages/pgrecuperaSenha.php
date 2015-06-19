<?php
require_once('Classes/mail/class.phpmailer.php'); //Include pasta/classe do PHPMailer
require_once('pages/email.php');

if (isset($_POST['enviar'])) {
    $nome = $_POST['usuario'];
    $email = $_POST['email'];
    $dados = validaUsuario($nome, $email);
    $nomeRemetente = 'Instituto Tecnológico e Vocacional Avançado';
    $remetente = 'iteva@iteva.org.br';

    if($dados) {
        $id = $dados->id;
        $mensagem = "Você pediu para recuperar a senha da pre-avaliação.<br/>
                     Click no link abaixo e redefina sua senha<br/>
                     <a href='http://localhost:8080/preAvaliacaoWEB/redefine/".$id."'>Redefinir senha.</a>
        ";
        sendMail('Recuperar Senha', $mensagem, $remetente, $nomeRemetente, $email, $nome, '','');

        echo "Foi enviado um link pro seu email.";
    }
    else {
        echo "Nome ou email não cadastrado.";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Pré-Avaliação</title>
        <link rel="stylesheet" type="text/css" href="css/recuperaSenha.css">
    </head>
    <body>
        <div id="login">
            <div id="icon">
                <img id="icon" src="imagens/logo.png">
            </div>
            <form method="post">
                <div id="inputs">
                    <p id="info"></p>
                    <input type="text" name="usuario" class="id" id="id" required="required" placeholder="Nome" >
                    <br />
                    <input type="email" name="email" class="log" id="pass" required="required" placeholder="Email">
                    <br />
                    <input  value="Enviar email" type="submit" id="button" name="enviar">
                </div>
            </form>
        </div>
    </body>
</html>