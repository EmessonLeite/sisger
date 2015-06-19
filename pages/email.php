<?php
    define('MAILUSER','anderson@iteva.org.br');
    define('MAILPASS','102030');
    define('MAILPORT','587');
    define('MAILHOST','smtp.iteva.org.br');

    function sendMail($assunto,$mensagem,$remetente,$nomeRemetente,$destino,$nomeDestino, $reply = NULL, $replyNome = NULL){

        require_once('Classes/mail/class.phpmailer.php'); //Include pasta/classe do PHPMailer

        $mail = new PHPMailer(); //INICIA A CLASSE
        $mail->IsSMTP(); //Habilita envio SMPT
        $mail->SMTPAuth = true; //Ativa email autenticado
        $mail->IsHTML(true);

        $mail->Host = 'mail.projetomidiacom.org.br'; //Servidor de envio
        $mail->Port = 587; //Porta de envio
        $mail->Username = 'anderson@projetomidiacom.org.br'; //email para smtp autenticado
        $mail->Password = '102030'; //seleciona a porta de envio

        $mail->From = utf8_decode($remetente); //remtente
        $mail->FromName = utf8_decode($nomeRemetente); //remtetene nome

        if($reply != NULL){
            $mail->AddReplyTo(utf8_decode($reply),utf8_decode($replyNome));
        }

        $mail->Subject = utf8_decode($assunto); //assunto
        $mail->Body = utf8_decode($mensagem); //mensagem
        $mail->AddAddress(utf8_decode($destino),utf8_decode($nomeDestino)); //email e nome do destino

        if($mail->Send()){
            return true;
        }else {
            return false;
        }
    }

    function validaUsuario($nome, $email) {
        $pdo = new PDO("mysql:host=" . HOST . ";dbname=" . DBSA,USER, PASS);
        $verifica = $pdo->prepare("SELECT * FROM usuarios WHERE nome = ? AND email = ?");
        $verifica->bindValue(1, $nome);
        $verifica->bindValue(2, $email);
        $verifica->execute();
        return ($verifica->rowCount() == 1) ? $verifica->fetch(PDO::FETCH_OBJ) : false;
    }

    function atualizaSenha($senha, $id) {
        $pdo = new PDO("mysql:host=" . HOST . ";dbname=" . DBSA,USER, PASS);
        $atualiza = $pdo->prepare("UPDATE usuarios set senha = PASSWORD(?) WHERE id = ?");
        $atualiza->bindValue(1, $senha);
        $atualiza->bindValue(2, $id);
        $atualiza->execute();
        return ($atualiza->rowCount() == 1) ? true : false;
    }
?>