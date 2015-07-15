<section class="listagemCadastro">
    <div class="camposSection">
        <?php echo $erroExcluir; ?>
        <table class="listagem">
            <input name="enviar" class="novo" type="submit" value="Novo Cargo" onclick="window.location = '<?php echo $url->getURL(0); ?>/novo';"/>
            <form method="post" name="frmPesquisa" id="frmPesquisa">
                <input type="text" class="pesquisa" id="filtro" name="filtro" value="<?php echo (isset($form['filtro']) ? $form['filtro'] : ""); ?>"/>
            </form>
            <tr>
                <th>Ordem</th>
                <th>Cargo</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
            <?php
            if (count($dadosCargos)) {
                foreach ($dadosCargos as $cargo) {
                    echo "
                    <tr>
                        <td>{$cargo['ordem']}</td>
                        <td>{$cargo['cargo']}</td>
                        <td id='editar'><a href='{$url->getURL(0)}/editar/{$cargo['id']}'>Editar</a></td>
                        <td id='excluir'><a class='exluirCargo' href='{$url->getURL(0)}/excluir/{$cargo['id']}'>Excluir</a></td>
                    </tr>
                ";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhum cargo encontrado.</td></tr>";
            }
            ?>

        </table>
    </div>
    <a href='#frmExcluir' name='frmExcluir' rel='leanModal' id='btnExcluir'></a>
</section>

<div id="frmExcluir" class="caixaComentarios">
    <form action="" class="frmComentarios">
        <div id="cabecalho-excluir">
            <p>Excluir cargo</p>
            <a class="modal_close"></a>
        </div>
        <div class="txt-excluir">
            <p>Você deseja realmente excluir este cargo?</p>
            <input type="button" value="Excluir" id="confirmarExcluir" />
            <input type="hidden" id="idCargoExcluido" />
            <input type="button" class="modal_close" value="Cancelar" id="cancelar" />
        </div>
    </form>
</div>