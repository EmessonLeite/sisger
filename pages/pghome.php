<?php ?>
<div id="todo">
    <input type="hidden" id="top" value="<?php echo $top; ?>" />
    <?php
    if (isset($dadosUsuarioAvaliacao[0]['erro'])) {
        echo "<div id='erro'>{$dadosUsuarioAvaliacao[0]['erro']}</div>";
    }
    ?>
    <div id="geral">
        <select id="avaliacoes">
            <option value="0">Selecione a avaliação</option>
            <?php foreach ($avaliacoes as $av) { ?>
                <option <?php echo ($av['referente'] == $avaliacao[0]['referente'] ? "selected" : "") ?> value="<?php echo $av['id']; ?>"><?php echo $av['referente']; ?></option>
            <?php } ?>
        </select>
        <img id="informacoes" src="imagens/informacoes.png">
        <div id="imgperfil">
            <img id="perfil" src="imagens/perfil/<?php echo $dadosUsuarioSelecionado[0]['foto']; ?>">
        </div>
        <div id="dados">
            <label id="nome"><?php echo $dadosUsuarioSelecionado[0]['apelido']; ?></label>
            <input type="hidden" value="<?php echo $dadosUsuarioSelecionado[0]['id']; ?>" id="idSelecionado" />
            <label id="comentarios"><?php echo $dadosUsuarioAvaliacao[0]['comentarios']; ?> comentários</label></br>
            <label id="posto">Posto: <?php echo $dadosUsuarioAvaliacao[0]['cargo']; ?></label></br>
            <label id="email">Email: <?php echo $dadosUsuarioSelecionado[0]['email']; ?></label>
        </div>
    </div>
    <div id="pessoas">
        <label id="titulo">Pessoas</label>
        <hr id="linhaCima" class="linha">
        <div id="setaCima">
            <img width="25" height="25" src="imagens/seta-cima.gif">
        </div>
        <div id="listagem-geral">
            <div id="lista-pessoas">
                <table id="funcionarios">
                    <?php
                    for ($i = 0; $i < count($usuariosAvaliacao); $i++) {
                        $usuario = $usuariosAvaliacao[$i];
                        if ($i % 2 == 0)
                            echo "<tr>";
                        ?>
                        <td>
                            <a href="<?php echo "home/{$avaliacao[0]['referente']}/{$usuario['id']}"; ?>" class="funcionarios">
                                <img class="fotos-perfil" src="imagens/perfil/<?php echo $usuario['foto']; ?>"><br/>
                                <p class="nomes"><?php echo $usuario['apelido']; ?></p>
                            </a>
                        </td>
                        <?php
                        if ($i % 2 == 1)
                            echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
        <hr id="linhaBaixo" class="linha">
        <div id="setaBaixo">
            <img width="25" height="25" src="imagens/seta_baixo.gif">
        </div>
    </div>    
    <div id="menu">
        <a href="includes/incinfogerais.php<?php echo $infoURL; ?>" class="info clicado" name="infog" target="conteudos">Informações Gerais</a>
        <?php
        if (!isset($dadosUsuarioAvaliacao[0]['erro'])) {

            echo "<a href='includes/incautoav.php{$infoURL}' class='info naoClicado' name='autoav' target='conteudos'>Como eu me avaliaria</a>";
        }
        ?>
        <a href="includes/incavaliacaoPassada.php<?php echo $infoURL; ?>" class="info naoClicado" name="avpassada" target="conteudos">Avaliação passada</a>
    </div>
    <iframe src="includes/incinfogerais.php<?php echo $infoURL; ?>" class="conteudos" id="conteudo" scrolling="yes" name="conteudos" ></iframe>
    <?php
    if (!isset($dadosUsuarioAvaliacao[0]['erro'])) {
        ?>
        <div id="comentario-negativo">
            <div id="titulo-negativo">
                <a href="#lightbox-negativo" name="lightbox-negativo" rel="leanModal" id="edita-comentario-negativo">
                    <img id="lapis-negativo" src="imagens/lapis.png">
                </a>
                <p id="texto-negativo">Pontos Negativos</p>
            </div>
        </div>
        <div id="comentario-positivo">
            <div id="titulo-positivo">
                <a href="#lightbox-positivo" name="lightbox-positivo" rel="leanModal" id="edita-comentario-positivo">
                    <img id="lapis-positivo" src="imagens/lapis.png">
                </a>
                <p id="texto-positivo">Pontos Positivos</p>
            </div>
        </div>
        <table id="tbl-comentario">
            <tr>
                <td id="negativo">
                    <?php
                    foreach ($comentariosNegativos as $c) {
                        ?>
                        <p class="comentario">
                        <?php echo $c['comentario']; ?>
                        </p>
                        <?php
                    }
                    ?>
                </td>

                <td id="positivo">
                    <?php
                    foreach ($comentariosPositivos as $c) {
                        ?>
                        <p class="comentario">
                        <?php echo $c['comentario']; ?>
                        </p>
                        <?php
                    }
                    ?>
                </td>
            </tr>
        </table>
        <div id="lightbox-negativo" class="caixaComentarios">
            <form action="" class="frmComentarios">
                <div id="cabecalho-negativo">
                    <p>Pontos Negativos</p>
                    <a class="modal_close"></a>
                </div>
                <div class="txt-comentario-negativo">
                    <input type="hidden" id="idUsuario" value="<?php echo $dadosUsuarioSelecionado[0]['id']; ?>" />
                    <input type="hidden" id="idAvaliacao" value="<?php echo $avaliacao[0]['id']; ?>" />
                    <input type="hidden" id="idUsuarioLogado" value="<?php echo $idUsuario; ?>" />
                    <input type="hidden" id="tipo" value="<?php echo '0'; ?>" />
                    <label for="">Comentário: </label><br/>
                    <textarea name="" id="comentario"></textarea>
                    <button id="salvar-negativo" type="submit">Salvar</button>
                </div>
            </form>
        </div>
        <div id="lightbox-positivo" class="caixaComentarios">
            <form action="" class="frmComentarios">
                <div id="cabecalho-positivo">
                    <p>Pontos Positivo</p>
                    <a class="modal_close"></a>
                </div>
                <div class="txt-comentario-positivo">
                    <input type="hidden" id="idUsuario" value="<?php echo $dadosUsuarioSelecionado[0]['id']; ?>" />
                    <input type="hidden" id="idAvaliacao" value="<?php echo $avaliacao[0]['id']; ?>" />
                    <input type="hidden" id="idUsuarioLogado" value="<?php echo $idUsuario; ?>" />
                    <input type="hidden" id="tipo" value="<?php echo '1'; ?>" />
                    <label for="">Comentário: </label><br/>
                    <textarea name="" id="comentario"></textarea>
                    <button id="salvar-positivo" type="submit">Salvar</button>
                </div>
            </form>
        </div>
        <div id="comentario-positivo" style="visibility: hidden">
            <div id="titulo-positivo">
                <a href="#lightbox-autoava" name="lightbox-positivo" rel="leanModal" id="edita-autoava-click">
                    <img id="lapis-positivo" src="imagens/lapis.png">
                </a>
                <p id="texto-positivo">Pontos Positivos</p>
            </div>
        </div>

        <!-- div para lightbox auto-avaliação. /-->
        <div id="lightbox-autoava" class="caixaAutoAva">
            <form action="" class="frmAutoAva">
                <div id="cabecalho-autoava">
                    <p>Auto-avaliação</p>
                    <a class="modal_close"></a>
                </div>
                <div class="txt-cabecalho-autoava">
                    <table id="autoava" cellspacing="0" cellpadding="0">
                        <tr>
                            <th id="quesito">Quesito:</th>
                            <th id="np">NP:</th>
                            <th id="obs">Obs:</th>
                        </tr>
                        <tr>
                            <td class="auto-quesito">
                                <p>União e cooperação</p>
                            </td>
                            <td class="auto-nota">
                                <input type="text" maxlength="3" class="nota" name="np">
                            </td>
                            <td class="auto-obs">
                                <input type="text" maxlength="255" class="obs" name="obs">
                            </td>
                        </tr>
                        <tr>
                            <td class="auto-quesito">
                                <p>Disciplina</p>
                            </td>
                            <td class="auto-nota">
                                <input type="text" maxlength="3" class="nota" name="np">
                            </td>
                            <td class="auto-obs">
                                <input type="text" maxlength="255" class="obs" name="obs">
                            </td>
                        </tr>
                        <tr>
                            <td class="auto-quesito">
                                <p>Dedicação</p>
                            </td>
                            <td class="auto-nota">
                                <input type="text" maxlength="3" class="nota" name="np">
                            </td>
                            <td class="auto-obs">
                                <input type="text" maxlength="255" class="obs" name="obs">
                            </td>
                        </tr>
                        <tr>
                            <td class="auto-quesito">
                                <p>Consciência Crítica</p>
                            </td>
                            <td class="auto-nota">
                                <input type="text" maxlength="3" class="nota" name="np">
                            </td>
                            <td class="auto-obs">
                                <input type="text" maxlength="255" class="obs" name="obs">
                            </td>
                        </tr>
                        <tr>
                            <td class="auto-quesito">
                                <p>Bom domínio e agilidade nas rotinas</p>
                            </td>
                            <td class="auto-nota">
                                <input type="text" maxlength="3" class="nota" name="np">
                            </td>
                            <td class="auto-obs">
                                <input type="text" maxlength="255" class="obs" name="obs">
                            </td>
                        </tr>
                        <tr>
                            <td class="auto-quesito">
                                <p>Boa organização nos processos</p>
                            </td>
                            <td class="auto-nota">
                                <input type="text" maxlength="3" class="nota" name="np">
                            </td>
                            <td class="auto-obs">
                                <input type="text" maxlength="255" class="obs" name="obs">
                            </td>
                        </tr>
                        <tr>
                            <td class="auto-quesito">
                                <p>Boa criatividade</p>
                            </td>
                            <td class="auto-nota">
                                <input type="text" maxlength="3" class="nota" name="np">
                            </td>
                            <td class="auto-obs">
                                <input type="text" maxlength="255" class="obs" name="obs">
                            </td>
                        </tr>
                        <tr>
                            <td class="auto-quesito">
                                <p>Boa interação com seus coordenadores</p>
                            </td>
                            <td class="auto-nota">
                                <input type="text" maxlength="3" class="nota" name="np">
                            </td>
                            <td class="auto-obs">
                                <input type="text" maxlength="255" class="obs" name="obs">
                            </td>
                        </tr>
                        <tr>
                            <td class="auto-quesito">
                                <p>Iniciativa</p>
                            </td>
                            <td class="auto-nota">
                                <input type="text" maxlength="3" class="nota" name="np">
                            </td>
                            <td class="auto-obs">
                                <input type="text" maxlength="255" class="obs" name="obs">
                            </td>
                        </tr>
                    </table>
                    <button id="salvar-autoava" type="submit">Salvar</button>
                </div>
            </form>
        </div>
        <?php
    }
    ?>
</div>