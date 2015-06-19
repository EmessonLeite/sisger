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
