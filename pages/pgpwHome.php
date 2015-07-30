<?php ?>

<div id="todo">

    <?php echo $erro; ?>
    <div id="entrada">
        <label class="titulo">Ponto</label> <hr id="linhaPonto">
        <form method="post">
            <input type="hidden" name="acao" value="" />
            <a <?php echo ($btnLabel === "Dar entrada") ? 'href="#lightboxPontoEntrarSair" rel="leanModal"' : ''; ?>>
                <input type="submit" value="<?php echo $btnLabel; ?>" name="entradaSaida" id="entradaSaida" />
            </a>
            <a href="#lightboxPontoCorrigir" rel="leanModal">
                <input type="button" value="Corrigir" name="corrigir" />
            </a>
        </form>
    </div>

    <div id="filtro">
        <label class="titulo">Filtro</label> <hr id="linhaFiltro">
        <div id="pessoas">
            <label class="subTitulo">Pessoas:</label>
            <select id="usuarios">
                <option value="<?php echo $idUsuario ?>"><?php echo $apelido; ?></option>
                <optgroup label="..."></optgroup>
                <?php
                foreach ($usuarios as $usuario) {
                    echo "<option value='{$usuario['id']}'>{$usuario['apelido']}</option>";
                }
                ?>
            </select>
        </div>
        <form method="post">
            <div id="infoPesquisa">
                <label class="subTitulo">Data Início:</label> <input type="text" id="inicio" class="" value="">
                <label class="subTitulo">Data Fim:</label> <input type="text" id="fim" value="">
                <div id="links">
                    <a href="#" id="mais1Dia">+1 dia</a><a  href="#" id="hoje">Hoje</a><br>
                    <a href="#" id="menos1Dia">-1 dia</a><a id="mesAtual"  href="#">Mês Atual</a>
                    <input type="button" value="Pesquisar" id="pesquisar" />
                </div>
            </div>
        </form>
    </div>

    <div id="tabela">
        <table id="informacoesHorarios">
            <tr>
                <th class="data">Data</th>
                <th class="entrada">Entrada</th>
                <th class="saida">Saída</th>
                <th class="total">Total</th>
                <th class="tipo">$</th>
                <th class="atividade">Atividade</th>
                <th class="celula">Célula/Mídia</th>
                <th class="coordenador">Coordenador</th>
                <th class="editar">Editar</th>
                <th class="excluir">Excluir</th>
            </tr>
            <?php
            if (count($horarios)) {
                foreach ($horarios as $horario) {
                    
                    /** Verifica se o ponto esta aberto */
                    $tipo = (!$horario['saida']) ? "aberto" : "";
                    
                    /** Verifica se a entrada foi corrigida */
                    $entradaCorrigida = ($horario['entradaAjuste']) ? 'class="corrigido"' : "" ; 
                    
                    /** Verifica se a saida foi corrigida */
                    $saidaCorrigida = ($horario['saidaAjuste']) ? 'class="corrigido"' : "" ; 
                    
                    
                    echo "
                    <tr class='{$tipo}'>
                        <td><label>{$horario['data']}</label></td>
                        <td {$entradaCorrigida}><label>{$horario['entrada']}</label></td>
                        <td {$saidaCorrigida}><label>{$horario['saida']}</label></td>
                        <td><label>{$horario['total']}</label></td>
                        <td><label><input type='checkbox' disabled " . (($horario['remuneracao']) ? "checked='checked'" : "" ) . "/></label></td>
                        <td><label>{$horario['atividade']}</label></td>
                        <td><label>{$horario['celulaMidia']}</label></td>
                        <td><label>{$horario['coordenador']}</label></td>
                        <td><a href='#lightboxPontoEditar' id='editar' rel='leanModal' name='modal'>Editar</a></td>
                        <td>
                            <a href='#lightboxPontoExcluir' id='excluir' rel='leanModal' name='modal'>Excluir</a>
                            <input type='hidden' class='idHorario' value='{$horario['id']}' />
                        </td>
                    </tr>";
                }
            }
            ?>
        </table>
    </div>

    <div id="meta">
        <label>Total de horas: 00:00:00</label>
        <div id="metaTotal">Meta: xx:xx</div>
        <div id="legenda">
            <p><div id="aberto"></div><span id="horarioAberto">Horário em aberto</span></p>
            <p><div id="ajustado"></div><span id="horarioAjustado">Horário ajustado</span></p>
        </div>
    </div>

    <!-- Tela para ligthBox /-->
    <div id="lightboxPontoEntrarSair" class="caixaLightBox">
        <form method="POST" class="">
            <div id="cabecalhoPontoEntrarSair">
                <p>Ponto</p>
                <a class="modal_close"></a>
            </div>
            <div class="txtPontoEntrarSair">
                <label for="atividade">Atividade</label>
                <input type="text" name="atividade" value="" />
                <label for="celulaMidia">Célula/Mídia</label>
                <input name="celulaMidia" type="text" value="" />
                <label for="coordenador">Coordenador</label>
                <input name="coordenador" type="text" value="" />
                <label for="remunerado">Remunerado</label>
                <input name="remuneracao" type="checkbox" value="1" />
            </div>
            <div class="enviarCancelarPontoEntrarSair">
                <input type="submit" name="abrirHorario" value="Salvar" id="confirmarSalvar" />
                <input type="hidden" id="idUsuarioExcluido" />
                <input type="button" class="modal_close" value="Cancelar" id="cancelar" />
            </div>
        </form>
    </div>

    <div id="lightboxPontoCorrigir" class="caixaLightBox">
        <form method="post">
            <div id="cabecalhoPontoCorrigir">
                <p>Corrigir</p>
                <a class="modal_close"></a>
            </div>
            <div class="txtPontoCorrigir">
                <label for="atividade">Atividade</label>
                <input type="text" name="atividade" value="" />

                <label for="celulaMidia">Célula/Mídia</label>
                <input name="celulaMidia" type="text" value="" />

                <label for="coordenador">Coordenador</label>
                <input name="coordenador" type="text" value="" />

                <label for="remuneracao">Remunerado</label>
                <input name="remuneracao" type="checkbox" value="1" />

                <label for="data">Data</label>
                <select name="data">
                    <option value="<?php echo date('Y-m-d'); ?>"><?php echo date('d/m/Y'); ?></option>
                    <option value="<?php echo date("Y-m-d", strtotime("yesterday"));  ?>"><?php echo date("d/m/Y", strtotime("yesterday"));  ?></option>
                </select>

                <label for="entrada">*Entrada</label>
                <input name="entrada" type="text" class="data" value="" />

                <label for="saida">Saída</label>
                <input name="saida" type="text" class="data" value="" />

                <label for="motivoAjuste">*Motivo</label>
                <input name="motivoAjuste" type="text" value="" />

                <label id="obrigatorio">(*)Campos de preenchimento obrigatório.</label>
            </div>
            <div class="enviarCancelarPontoCorrigir">
                <input type="submit" name="corrigir" value="Salvar" id="confirmarSalvar" />
                <input type="hidden" id="idUsuarioExcluido" />
                <input type="button" class="modal_close" value="Cancelar" id="cancelar" />
            </div>
        </form>
    </div>

    <div id="lightboxPontoEditar" class="caixaLightBox">
        <form action="" class="">
            <div id="cabecalhoPontoEditar">
                <p>Editar</p>
                <a class="modal_close"></a>
            </div>
            <div class="txtPontoEditar">
                <label>Atividade</label>
                <input type="text" value="" />

                <label>Célula/Mídia</label>
                <input type="text" value="" />

                <label>Coordenador</label>
                <input type="text" value="" />

                <label>Remunerado</label>
                <input type="checkbox" value="" />

                <label>Data</label>
                <select>
                    <option>08/07/2015</option>
                    <option>07/07/2015</option>
                </select>

                <label>*Entrada</label>
                <input type="text" class="data" value="" />
                <input id="dataAtual" type="checkbox" value="" />
                <label id="dataAtual">Atual</label>

                <label>Saída</label>
                <input type="text" class="data" value="" />
                <input id="dataAtual" type="checkbox" value="" />
                <label id="dataAtual">Atual</label>

                <label id="obrigatorio">(*)Campos de preenchimento obrigatório.</label>
            </div>
            <div class="enviarCancelarPontoEditar">
                <input type="submit" value="Salvar" id="confirmarSalvar" />
                <input type="hidden" id="idHorarioEditado" />
                <input type="button" class="modal_close" value="Cancelar" id="cancelar" />
            </div>
        </form>
    </div>

    <div id="lightboxPontoExcluir" class="caixaLightBox">
        <form action="" method="post">
            <div id="cabecalhoPontoExcluir">
                <p>Atenção</p>
                <a class="modal_close"></a>
            </div>
            <div class="txtPontoExcluir">
                <p>Você deseja realmente excluir este horário?</p>
                <input type="submit" name="excluir" value="Excluir" id="confirmarExcluir" />
                <input type="hidden" name="idExcluido" id="idHorariooExcluido" />
                <input type="button" class="modal_close" value="Cancelar" id="cancelar" />
            </div>
        </form>
    </div>
</div>