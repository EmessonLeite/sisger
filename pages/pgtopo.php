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
                        <a href="alterarLogin"><p style="padding-top: 0">Alterar login</p></a>
                        <a href="alterarSenha"><p style="padding-top: 0">Alterar senha</p></a>
                        <?php
                            /** Índice 1 no array de permissoes indica permissao de Gestão de funcionarios */
                            if (isset($permissoes[1])) {
                                echo '<a href="cadastraFunc"><p>Cadastrar funcionário</p></a>';
                            }

                            /** Índice 2 no array de permissoes indica permissao de Gestão de cargos */
                            if(isset($permissoes[2])){
                                echo '<a href="cadastraCargo"><p>Cadastrar cargo</p></a>';
                            }

                            /** Índice 3 no array de permissoes indica permissao de Gestão de avaliação */
                            if(isset($permissoes[3])){
                                echo '<a href="cadastraAva"><p>Cadastrar avaliação</p></a>';
                            }

                            /** Índice 4 no array de permissoes indica permissao de Gestão de Permissões */
                            if(isset($permissoes[4])){
                                echo '<a href="cadastraPermissoes"><p>Cadastrar Permissões</p></a>';
                            }
                        ?>


                    </div>
                    <a href="logout"> <img src="imagens/sair.png"></a>
                </div>
            </div>
        </div>
