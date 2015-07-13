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
                <option <?php echo ($av['referente'] == $avaliacao[0]['referente'] ? "selected" : "") ?> value="<?php echo $idUsuarioSelecionado; ?>"><?php echo $av['referente']; ?></option>
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
            <label id="email">E-mail: <?php echo $dadosUsuarioSelecionado[0]['email']; ?></label>
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
                            <a href="<?php echo "paHome/{$avaliacao[0]['referente']}/{$usuario['id']}"; ?>" class="funcionarios">
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
        <a href="includes/incpaInfogerais.php<?php echo $infoURL; ?>" class="info <?php echo ($geral) ? 'clicado' : 'naoClicado'; ?>" name="infog" target="conteudos">Informações gerais</a>
        <?php
        if (!isset($dadosUsuarioAvaliacao[0]['erro'])) {

            echo "<a href='includes/incpaAutoav.php{$infoURL}' class='info " . ((!$geral) ? 'clicado' : 'naoClicado') . "' name='autoav' target='conteudos'>Como eu me avaliaria</a>
                  <a href='includes/incpaAvaliacaoPassada.php{$infoURL}' class='info naoClicado' name='avpassada' target='conteudos'>Avaliação passada</a>";
        }
        ?>

    </div>
    <iframe src="<?php echo $conteudoIframe; ?>" class="conteudos" scrolling="no" id="conteudo" name="conteudos" ></iframe>
    <?php
    if (!isset($dadosUsuarioAvaliacao[0]['erro'])) {
        if ((($avaliacao[0]['fim'] == '0000-00-00 00:00:00') || ($avaliacao[0]['fim'] == NULL)) && $usuarioCadastrado) {
            echo "
                <div id='comentario-negativo'>
                    <div id='titulo-negativo'>
                        <a href='#lightbox-negativo' name='lightbox-negativo' rel='leanModal' id='edita-comentario-negativo'>
                            <img id='lapis-negativo' src='imagens/lapis.png'>
                        </a>
                        <p id='texto-negativo'>Pontos Negativos</p>
                    </div>
                </div>
                <div id='comentario-positivo'>
                    <div id='titulo-positivo'>
                        <a href='#lightbox-positivo' name='lightbox-positivo' rel='leanModal' id='edita-comentario-positivo'>
                            <img id='lapis-positivo' src='imagens/lapis.png'>
                        </a>
                        <p id='texto-positivo'>Pontos Positivos</p>
                    </div>
                </div>
            ";
        } else {
            echo "<div id='erro' style='margin-top: 20px; margin-bottom: 20px;'>Não pode adicionar comentários pois a avaliação já foi fechada.</div>";
            echo "
                <div id='comentario-negativo'>
                    <div id='titulo-negativo'>
                        <p id='texto-negativo' style='position: absolute; margin-top: 10px;'>Pontos Negativos</p>
                    </div>
                </div>
                <div id='comentario-positivo'>
                    <div id='titulo-positivo'>
                        <p id='texto-positivo' style='position: absolute; margin-top: 10px;'>Pontos Positivos</p>
                    </div>
                </div>
            ";
        }
        ?>
        <?php
        if (($avaliacao[0]['fim'] == '0000-00-00 00:00:00') || ($avaliacao[0]['fim'] == NULL)) {
            
        } else {
            echo "
             <table id='tbl-comentario'>
                <tr>
                    <td id='negativo'>
                    ";
            foreach ($comentariosNegativos as $c) {
                echo "
                            <p class='comentario'>{$c['comentario']}
                            </p>
                            ";
            }
            echo "
                    </td>

                    <td id='positivo'>
                    ";
            foreach ($comentariosPositivos as $c) {
                echo "
                            <p class='comentario'>{$c['comentario']}
                            </p>
                            ";
            }
            echo "
                    </td>
                </tr>
            </table>
            ";
        }
        ?>

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
                    <p>Pontos Positivos</p>
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

        <div id="comentario-positivo" style="visibility: hidden">
            <div id="titulo-positivo">
                <a href="#lightboxAvaliacaoPassada" name="lightbox-positivo" rel="leanModal" id="editaAvaliacaoPassadaClick">
                    <img id="lapis-positivo" src="imagens/lapis.png">
                </a>
                <p id="texto-positivo">Pontos Positivos</p>
            </div>
        </div>

        <!-- div para lightbox auto-avaliação. /-->
        <div id="lightbox-autoava" class="caixaAutoAva">
            <form method="POST" class="frmAutoAva" id="frmAutoAva">
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
                                <p><?php echo $dadosAutoAvaliacao['quesito1']; ?></p>
                            </td>
                            <td class="auto-nota">
                                <input type="text" maxlength="3" class="nota" name="nota1" value="<?php echo $dadosAutoAvaliacao['nota1']; ?>">
                            </td>
                            <td class="auto-obs">
                                <input type="text" maxlength="255" class="obs" name="descricao1" value="<?php echo $dadosAutoAvaliacao['descricao1']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td class="auto-quesito">
                                <p><?php echo $dadosAutoAvaliacao['quesito2']; ?></p>
                            </td>
                            <td class="auto-nota">
                                <input type="text" maxlength="3" class="nota" name="nota2" value="<?php echo $dadosAutoAvaliacao['nota2']; ?>">
                            </td>
                            <td class="auto-obs">
                                <input type="text" maxlength="255" class="obs" name="descricao2" value="<?php echo $dadosAutoAvaliacao['descricao2']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td class="auto-quesito">
                                <p><?php echo $dadosAutoAvaliacao['quesito3']; ?></p>
                            </td>
                            <td class="auto-nota">
                                <input type="text" maxlength="3" class="nota" name="nota3" value="<?php echo $dadosAutoAvaliacao['nota3']; ?>">
                            </td>
                            <td class="auto-obs">
                                <input type="text" maxlength="255" class="obs" name="descricao3" value="<?php echo $dadosAutoAvaliacao['descricao3']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td class="auto-quesito">
                                <p><?php echo $dadosAutoAvaliacao['quesito4']; ?></p>
                            </td>
                            <td class="auto-nota">
                                <input type="text" maxlength="3" class="nota" name="nota4" value="<?php echo $dadosAutoAvaliacao['nota4']; ?>">
                            </td>
                            <td class="auto-obs">
                                <input type="text" maxlength="255" class="obs" name="descricao4" value="<?php echo $dadosAutoAvaliacao['descricao4']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td class="auto-quesito">
                                <p><?php echo $dadosAutoAvaliacao['quesito5']; ?></p>
                            </td>
                            <td class="auto-nota">
                                <input type="text" maxlength="3" class="nota" name="nota5" value="<?php echo $dadosAutoAvaliacao['nota5']; ?>">
                            </td>
                            <td class="auto-obs">
                                <input type="text" maxlength="255" class="obs" name="descricao5" value="<?php echo $dadosAutoAvaliacao['descricao5']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td class="auto-quesito">
                                <p><?php echo $dadosAutoAvaliacao['quesito6']; ?></p>
                            </td>
                            <td class="auto-nota">
                                <input type="text" maxlength="3" class="nota" name="nota6" value="<?php echo $dadosAutoAvaliacao['nota6']; ?>">
                            </td>
                            <td class="auto-obs">
                                <input type="text" maxlength="255" class="obs" name="descricao6" value="<?php echo $dadosAutoAvaliacao['descricao6']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td class="auto-quesito">
                                <p><?php echo $dadosAutoAvaliacao['quesito7']; ?></p>
                            </td>
                            <td class="auto-nota">
                                <input type="text" maxlength="3" class="nota" name="nota7" value="<?php echo $dadosAutoAvaliacao['nota7']; ?>">
                            </td>
                            <td class="auto-obs">
                                <input type="text" maxlength="255" class="obs" name="descricao7" value="<?php echo $dadosAutoAvaliacao['descricao7']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td class="auto-quesito">
                                <p><?php echo $dadosAutoAvaliacao['quesito8']; ?></p>
                            </td>
                            <td class="auto-nota">
                                <input type="text" maxlength="3" class="nota" name="nota8" value="<?php echo $dadosAutoAvaliacao['nota8']; ?>">
                            </td>
                            <td class="auto-obs">
                                <input type="text" maxlength="255" class="obs" name="descricao8" value="<?php echo $dadosAutoAvaliacao['descricao8']; ?>">
                            </td>
                        </tr>
                        <?php
                        if ($dadosAutoAvaliacao['quesito9'] != NULL) {
                            echo "
                                    <tr>
                                        <td class='auto-quesito'>
                                            <p>{$dadosAutoAvaliacao['quesito9']}</p>
                                        </td>
                                        <td class='auto-nota'>
                                            <input type='text' maxlength='3' class='nota' name='nota9' value='{$dadosAutoAvaliacao['nota9']}'>
                                        </td>
                                        <td class='auto-obs'>
                                            <input type='text' maxlength='255' class='obs' name='descricao9' value='{$dadosAutoAvaliacao['descricao9']}'>
                                        </td>
                                    </tr>
                                ";
                        }
                        ?>
                    </table>
                    <input id="salvar-autoava" type="submit" name="salvarAutoAva" value="Salvar" />
                </div>
            </form>
        </div>

        <!-- div para lightbox avaliação passada. /-->
        <div id="lightboxAvaliacaoPassada" class="caixaAvaliacaoPassada">
            <form method="POST" class="frmAvaliacaoPassada" id="frmAvaliacaoPassada">
                <div id="cabecalhoAvaliacaoPassada">
                    <p>Avaliação passada</p>
                    <a class="modal_close"></a>
                </div>
                <div class="txt-cabecalhoAvaliacaoPassada">
                    <table id="avaliacaoPassada" cellspacing="0" cellpadding="0">
                        <tr>
                            <th id="quesito">Quesito:</th>
                            <th id="pa">PA:</th>
                            <th id="ab">AB:</th>
                            <th id="pq">PQ:</th>
                            <th id="obs">Obs:</th>
                        </tr>
                        <?php
                        for ($i = 1, $j = 0; $j < count($dadosAvaliacaoPassada); $i++, $j+=4) {
                            if(isset($dadosAvaliacaoPassada["quesito{$i}"]) && $dadosAvaliacaoPassada["quesito{$i}"] != ""){
                                ?>
                                <tr>
                                    <td class="ava-quesito">
                                        <p><?php echo $dadosAvaliacaoPassada["quesito{$i}"]; ?></p>
                                    </td>
                                    <td class="ava-pa">
                                        <input type="text" maxlength="3" class="pa" name="pa<?php echo $i;?>" value="<?php echo $dadosAvaliacaoPassada["pa{$i}"]; ?>">
                                    </td>
                                    <td class="ava-ab">
                                        <input type="text" maxlength="3" class="ab" name="ab<?php echo $i;?>" value="<?php echo $dadosAvaliacaoPassada["ab{$i}"]; ?>">
                                    </td>
                                    <td class="ava-pq">
                                        <input type="text" maxlength="5" class="pq" name="pq<?php echo $i;?>" value="<?php echo $dadosAvaliacaoPassada["pq{$i}"]; ?>">
                                    </td>
                                    <td class="ava-obs">
                                        <input type="text" maxlength="3" class="obsAva" name="obs<?php echo $i;?>" value="<?php echo $dadosAvaliacaoPassada["obs{$i}"]; ?>">
                                    </td>
                                </tr>
                            <?php
                            }
                        }
                        ?>
                        <tr>
                            <td class="inativo"></td>
                            <td class="inativo"></td>
                            <td class="inativo"></td>
                            <td class="inativo"></td>
                            <td class="ava-total">
                                <input type="text" maxlength="5" class="total" name="total" value="<?php echo $dadosAvaliacaoPassada["total"]; ?>">
                            </td>
                        </tr>
                    </table>
                    <input id="salvarAvaliacaoPassada" type="submit" name="salvarAvaliacaoPassada" value="Salvar" />
                </div>
            </form>
        </div>
        <?php
    }
    ?>
</div>