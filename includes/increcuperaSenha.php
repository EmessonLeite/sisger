<?php

$info = '';
$erro = '';
/**
 * Inclui classes de envio de email
 */
require_once('Classes/mail/class.phpmailer.php');
require_once('pages/email.php');

/**
 * Verifica se foi enviado via POST o form
 */
if (isset($_POST['enviar']) && is_string($_POST['enviar'])) {
    $nome = $_POST['usuario'];
    $email = $_POST['email'];
    $dados = validaUsuario($nome, $email);
    $nomeRemetente = 'Instituto Tecnológico e Vocacional Avançado';
    $remetente = 'iteva@iteva.org.br';

    if ($dados) {
        $id = $dados->id;
        $data = strtotime(date("Y-m-d H:i:s"));
        $parametro = base64_encode($data . $id);

        $mensagem = "Você pediu para recuperar a senha da pre-avaliação.<br/>
                     Click no link abaixo e redefina sua senha<br/>
                    <a href='" . RAIZ . "redefine/{$parametro}'>Redefinir senha.</a>
        ";
        sendMail('Recuperar Senha', $mensagem, $remetente, $nomeRemetente, $email, $nome, '', '');

        $info = "Foi enviado um link pro seu email.";
        echo "<meta http-equiv='refresh' content=5;url='" . RAIZ . "login'>";
    } else {
        $erro = "Nome ou email não cadastrado.";
    }
}
$info = ($info != '') ? "<p id='info'>{$info}</p>" : '';
$erro = ($erro != '') ? "<p id='erro'>{$erro}</p>" : '';


include_once('pages/pgrecuperaSenha.php');
