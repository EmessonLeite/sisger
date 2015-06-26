<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <base href="<?php echo RAIZ; ?>" target="_self">
        <title>Pré-avaliação</title>
        <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui.js"></script>
        <script type="text/javascript" src="js/jquery.leanModal.min.js"></script>
        <script type="text/javascript" src="js/topo.js"></script>
        <link rel='stylesheet' type='text/css' href='css/topo.css'>
        <link rel='stylesheet' type='text/css' href='css/lightBox.css'>
        <link rel="shortcut icon" href="imagens/icon.ico" type="image/gif">
        <?php
        echo $arqJS;
        echo $arqCSS;
        ?>
    </head>
    <body>
    <input type="hidden" value="<?php echo RAIZ; ?>" id="raiz" />
    <div id="topo">
        <div id="central">
            <img id="logo" src="imagens/logo-branca.png">
            <div id="usuario">
                <label><a id="apelido" href="home"><?php echo $apelido; ?></a></label>
                <div id="imgusuario">
                    <a href="home">
                        <img class="usuario" src="imagens/perfil/<?php echo $foto; ?>">
                    </a>
                </div>
            </div>
            <div id="icons">
                <a><img id="config" src="imagens/config.png"></a>
                <div id="drop-config">
                    <img id="seta-cima" width="15" height="10" src="imagens/seta-cima-config.png">
                    <a href="configPerfil"><p style="padding-top: 0">Configurar perfil</p></a>
                    <a href="cadastraFunc"><p>Cadastrar funcionário</p></a>
                    <a href="cadastraCargo"><p>Cadastrar cargo</p></a>
                    <a href="cadastraAva"><p>Cadastrar avaliação</p></a>
                </div>
                <a href="logout"> <img src="imagens/sair.png"></a>
            </div>
        </div>
    </div>
