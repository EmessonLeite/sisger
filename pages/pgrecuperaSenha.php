<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Pré-Avaliação</title>
        <link rel="stylesheet" type="text/css" href="css/recuperaSenha.css">
        <link rel="shortcut icon" href="imagens/icon.ico" type="image/gif">
    </head>
    <body>
        <div id="login">
            <div id="icon">
                <img id="icon" src="imagens/logo.png">
            </div>
            <form method="post">
                <div id="informacoes">
                    <label id="txt-informacoes">Informe seu nome e email para ter permissão de redefinir sua senha!</label>
                </div>
                <div id="inputs">
                    <?php echo $erro . $info; ?>
                    <input type="text" name="usuario" class="id" id="id" required="required" placeholder="Nome Completo" >
                    <br />
                    <input type="email" name="email" class="log" id="pass" required="required" placeholder="Email">
                    <br />
                    <input  value="Enviar email" type="submit" id="button" name="enviar">
                </div>
            </form>
        </div>
    </body>
</html>