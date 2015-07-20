<section class="listagemCadastro">
    <div class="camposSection">
        <?php echo $erroExcluir; ?>
        <table class="listagem">
            <input name="enviar" class="novo" type="submit" value="Nova Avaliação" onclick="window.location = '<?php echo $url->getURL(0); ?>/novo';"/>
            <form method="post" name="frmPesquisa" id="frmPesquisa">
                <input type="text" class="pesquisa" id="filtro" name="filtro" value="<?php echo (isset($form['filtro']) ? $form['filtro'] : ""); ?>"/>
            </form>
            <tr>
                <th>Referente</th>
                <th>Data início</th>
                <th>Data fim</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
            <?php
            if (count($dadosAvaliacao)) {
                foreach ($dadosAvaliacao as $avaliacao) {
                    echo "
                    <tr>
                        <td>{$avaliacao['referente']}</td>
                        <td>{$avaliacao['inicio']}</td>
                        <td>{$avaliacao['fim']}</td>
                        <td id='editar'><a href='{$url->getURL(0)}/editar/{$avaliacao['id']}'>Editar</a></td>
                        <td id='excluir'><a class='exluirAvaliacao' href='{$url->getURL(0)}/excluir/{$avaliacao['id']}'>Excluir</a></td>
                    </tr>
                ";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhuma avaliação encontrada.</td></tr>";
            }
            ?>

        </table>
    </div>
    <a href='#frmExcluir' name='frmExcluir' rel='leanModal' id='btnExcluir'></a>
</section>

<div id="frmExcluir" class="caixaComentarios">
    <form action="" class="frmComentarios">
        <div id="cabecalho-excluir">
            <p>Excluir avaliação</p>
            <a class="modal_close"></a>
        </div>
        <div class="txt-excluir">
            <p>Você deseja realmente excluir esta avaliação?</p>
            <input type="button" value="Excluir" id="confirmarExcluir" />
            <input type="hidden" id="idAvaliacaoExcluido" />
            <input type="button" class="modal_close" value="Cancelar" id="cancelar" />
        </div>
    </form>
</div>