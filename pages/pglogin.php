<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Pré-Avaliação</title>
        <base href="<?php echo RAIZ; ?>">
        <script src="js/jquery-2.1.4.min.js"></script>
        <script src="js/login.js"></script>
        <link rel="stylesheet" type="text/css" href="css/login.css">
    </head>
    <body>
        <input type="hidden" value="<?php echo RAIZ; ?>" id="raiz" />
        <div id="login">
            <div id="icon">
                <img id="icon" src="imagens/logo.png">
            </div>
            <form name="login">
                <div id="inputs">
                    <p id="info"></p>
                    <input type="text" name="usuario" class="id" id="id"  required="required" maxlength="24" placeholder="Login" >
                    <br />
                    <input type="password" name="senha" class="log" id="pass" required="required"  maxlength="20" placeholder="Senha">
                    <br />
                    <input  value="Entrar"  type="submit" id="button" name="button">
                    <p id="txt-esqueceu-senha">Esqueceu sua senha? <span><a id="link-esqueceu-senha" href="recuperaSenha"> Click aqui.</a></span></p><br/>
                </div>
            </form>
        </div>
    </body>
</html>