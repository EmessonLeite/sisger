<?php ?>
<link rel='stylesheet' href='../css/avaliacaoPassada.css'/>
<div id="tabela-ava-passada">
    <div id="toda-ava-passada" class="tbConteudo">
        <div id="titulo">
            <label>Avaliação Passada</label>
        </div>
        <a href='#lightboxAvaliacaoPassada' rel='leanModal' id='editaAvaliacaoPassada'>
            <img id='lapis-positivo' src='../imagens/lapis-preto.png' style='position: relative; margin-left: 570px; margin-top: -20px; z-index: 100;'>
        </a>
        <table id="ava-passada" cellspacing="0" cellpadding="0">
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
                    <td  class="quesito">
                        <label><?php echo $dadosAvaliacaoPassada["quesito{$i}"]; ?></label>
                    </td>
                    <td class="pa">
                        <label><?php echo $dadosAvaliacaoPassada["pa{$i}"]; ?></label>
                    </td>
                    <td class="ab">
                        <label><?php echo $dadosAvaliacaoPassada["ab{$i}"]; ?></label>
                    </td>
                    <td class="pq">
                        <label><?php echo $dadosAvaliacaoPassada["pq{$i}"]; ?></label>
                    </td>
                    <td class="obs">
                        <label><?php echo round($dadosAvaliacaoPassada["obs{$i}"], 2); ?></label>
                    </td>
                </tr>
                <?php
                }
            }
            ?>
            <tr>
                <td class="inativo"></td>
                <td class="obs" colspan="4"><?php echo round($dadosAvaliacaoPassada["total"],2); ?></td>
            </tr>
        </table>
    </div>
</div>