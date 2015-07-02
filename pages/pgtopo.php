<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <base href="<?php echo RAIZ; ?>" target="_self">
        <title>Pré-avaliação</title>
        <link rel='stylesheet' type='text/css' href='css/style.css'>
        <link rel='stylesheet' type='text/css' href='css/topo.css'>
        <link rel='stylesheet' type='text/css' href='css/lightBox.css'>
        <?php echo $arqCSS; ?>
        <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
        <script src="js/jquery.mask.js" type="text/javascript"></script>
        <script src="js/mascaras.js" type="text/javascript"></script>
        <script src="js/jquery-ui.js"></script>
        <script type="text/javascript" src="js/jquery.leanModal.min.js"></script>
        <script type="text/javascript" src="js/topo.js"></script>
        <script type="text/javascript" src="js/datepicker-pt-br.js"></script>
        <?php echo $arqJS; ?>
        <link rel="shortcut icon" href="imagens/icon.ico" type="image/gif">
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
                    <a href="logout"> <img src="imagens/sair.png"></a>
                    <div id="drop-config">
                        <img id="seta-cima" width="15" height="10" src="imagens/seta-cima-config.png">
                        <a href="alterarLogin"><p id="alterarLogin">Alterar login</p></a>
                        <a href="alterarSenha"><p>Alterar senha</p></a>
                        <?php
                        /** Índice 1 no array de permissoes indica permissao de Gestão de funcionarios */
                        if (isset($permissoes[1])) {
                            echo '<a href="cadastraFunc"><p id="permissao1">Cadastrar funcionário</p></a>';
                        }

                        /** Índice 2 no array de permissoes indica permissao de Gestão de cargos */
                        if (isset($permissoes[2])) {
                            echo '<a href="cadastraCargo"><p id="permissao2">Cadastrar cargo</p></a>';
                        }

                        /** Índice 3 no array de permissoes indica permissao de Gestão de avaliação */
                        if (isset($permissoes[3])) {
                            echo '<a href="cadastraAva"><p id="permissao3">Cadastrar avaliação</p></a>';
                        }

                        /** Índice 4 no array de permissoes indica permissao de Gestão de Permissões */
                        if (isset($permissoes[4])) {
                            echo '<a href="cadastraPermissoes"><p id="permissao4">Cadastrar Permissões</p></a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

