<?php

?>
<section class="listagemCadastro">
    <div class="camposSection">
        <div id='comentario-negativo'>
            <div id='titulo-negativo'>
                <p id='texto-negativo' style='position: absolute; margin-top: 10px;'>Pontos Negativos</p>
            </div>
        </div>
<?php
    echo "
             <table id='tbl-comentario'>
                <tr>
                    <td id='negativo'>
                    ";
    foreach ($comentariosNegativos as $c) {
        echo "
                            <p class='comentario'>{$c['comentario']}
                            <a class='exluirCargo' href='{$url->getURL(0)}/excluir/{$c['id']}'><img src='imagens/lixeira.gif'></a>
                            </p>
                            ";
    }
    echo "
                    </td>
                </tr>
            </table>

            <div id='comentario-positivo'>
                <div id='titulo-positivo'>
                    <p id='texto-positivo' style='position: absolute; margin-top: 10px;'>Pontos Positivos</p>
                </div>
            </div>
            <table id='tbl-comentario'>
                <tr>
                    <td id='positivo'>
                    ";
    foreach ($comentariosPositivos as $c) {
        echo "
                            <p class='comentario'>{$c['comentario']}
                            <a class='exluirComentario' href='{$url->getURL(0)}/excluir/{$c['id']}'><img src='imagens/lixeira.gif'></a>
                            </p>
                            ";
    }
    echo "
                    </td>
                </tr>
            </table>
            ";

?>
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
            <p>Você deseja realmente excluir este comentário?</p>
            <input type="button" value="Excluir" id="confirmarExcluir" />
            <input type="hidden" id="idCargoExcluido" />
            <input type="button" class="modal_close" value="Cancelar" id="cancelar" />
        </div>
    </form>
</div>

