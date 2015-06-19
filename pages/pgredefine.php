<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pré-Avaliação</title>
    <link rel="stylesheet" type="text/css" href="../css/redefine.css">
    <link rel="shortcut icon" href="../imagens/icon.ico" type="image/gif">
</head>
<body>
<div id="login">
    <div id="icon">
        <img id="icon" src="../imagens/logo.png">
    </div>
    <form method="post">
        <div id="informacoes">
            <label id="txt-informacoes">Digite sua nova senha e a confirme em seguida!</label>
        </div>
        <div id="inputs">
            <?php echo $erro . $info; ?>
            <input type="password" name="senha" class="id" id="id" required="required" placeholder="Nova Senha" >
            <br /><input type="password" name="confsenha" class="log" id="pass" required="required" placeholder="Confime sua senha">
            <br />
            <input  value="Redefinir"  type="submit" id="button" name="enviar">
        </div>
    </form>
</div>
</body>
</html>
