<?php
include_once("../Classes/Config.inc.php");
//var_dump($_GET);

?>
<link rel='stylesheet' href='../css/autoava.css'/>
<script src="../js/jquery-2.1.4.min.js" type="text/javascript"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="../js/jquery.leanModal.min.js"></script>
<link rel='stylesheet' type='text/css' href='../css/lightBox.css'>

<div id="tabela-auto" class="tbConteudo">
    <div id="toda-autoava">
        <div id="titulo">
            <div id="titulo-label">
                <label id="titulo-autoava">Como eu me avaliaria</label>
            </div>
            <?php
                date_default_timezone_set('America/Sao_Paulo');

                if (($idUsuario == $idUsuarioSelecionado) && ((($avaliacao[0]['inicioAutoAva'] != '0000-00-00 00:00:00' && $avaliacao[0]['inicioAutoAva'] != NULL) && (strtotime(date("Y-m-d h:i:s")) >= strtotime($avaliacao[0]['inicioAutoAva']))) && (($avaliacao[0]['fimAutoAva'] == '0000-00-00 00:00:00') || ($avaliacao[0]['fimAutoAva'] == NULL) || (strtotime(date("Y-m-d h:i:s")) <= strtotime($avaliacao[0]['fimAutoAva']))))) {
                    echo "
                        <a href='#lightbox-autoava' name='lightbox-autoava' rel='leanModal' id='edita-autoava'>
                            <img id='lapis-positivo' src='../imagens/lapis-preto.png' style='color: #000000; position: relative; margin-left: 625px; margin-top: -15px;'>
                        </a>
                    ";
                }
            ?>
        </div>
        <?php
        if (($avaliacao[0]['fim'] != '0000-00-00 00:00:00') && ($avaliacao[0]['fim'] != NULL) && (strtotime(date("Y-m-d h:i:s")) > strtotime($avaliacao[0]['fim']))) {
            echo "<div id='erro'>Não é permitido fazer autoavaliação, a avaliação já foi fechada.</div>";
        }
        else {
            if (($avaliacao[0]['inicioAutoAva'] == '0000-00-00 00:00:00') || ($avaliacao[0]['inicioAutoAva'] == NULL)) {
                echo "<div id='erro'>A autoavaliação ainda não foi aberta.</div>";
            }

            if (strtotime(date("Y-m-d h:i:s")) < strtotime($avaliacao[0]['inicioAutoAva'])) {
                echo "<div id='erro'>A autoavaliação só será aberta dia <strong>\"" . dateTimebr($avaliacao[0]['inicioAutoAva']) . "\"</strong>.</div>";
            }

            if ((strtotime(date("Y-m-d h:i:s")) > strtotime($avaliacao[0]['fimAutoAva'])) && (($avaliacao[0]['fimAutoAva'] != '0000-00-00 00:00:00') && ($avaliacao[0]['fimAutoAva'] != NULL))) {
                echo "<div id='erro'>O período para fazer autoavaliação já encerrou.</div>";
            }
        }
        ?>
        <table id="autoava" cellspacing="0" cellpadding="0">
            <tr>
                <th id="quesito">Quesito:</th>
                <th id="np">NP:</th>
                <th id="obs">Obs:</th>
            </tr>
            <tr>
                <td>
                    <label><?php echo $dadosAutoAvaliacao['quesito1']; ?></label>
                </td>
                <td>
                    <label><?php echo $dadosAutoAvaliacao['nota1']; ?></label>
                </td>
                <td>
                    <label><?php echo $dadosAutoAvaliacao['descricao1']; ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <label><?php echo $dadosAutoAvaliacao['quesito2']; ?></label>
                </td>
                <td>
                    <label><?php echo $dadosAutoAvaliacao['nota2']; ?></label>
                </td>
                <td>
                    <label><?php echo $dadosAutoAvaliacao['descricao2']; ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <label><?php echo $dadosAutoAvaliacao['quesito3']; ?></label>
                </td>
                <td>
                    <label><?php echo $dadosAutoAvaliacao['nota3']; ?></label>
                </td>
                <td>
                    <label><?php echo $dadosAutoAvaliacao['descricao3']; ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <label><?php echo $dadosAutoAvaliacao['quesito4']; ?></label>
                </td>
                <td>
                    <label><?php echo $dadosAutoAvaliacao['nota4']; ?></label>
                </td>
                <td>
                    <label><?php echo $dadosAutoAvaliacao['descricao4']; ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <label><?php echo $dadosAutoAvaliacao['quesito5']; ?></label>
                </td>
                <td>
                    <label><?php echo $dadosAutoAvaliacao['nota5']; ?></label>
                </td>
                <td>
                    <label><?php echo $dadosAutoAvaliacao['descricao5']; ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <label><?php echo $dadosAutoAvaliacao['quesito6']; ?></label>
                </td>
                <td>
                    <label><?php echo $dadosAutoAvaliacao['nota6']; ?></label>
                </td>
                <td>
                    <label><?php echo $dadosAutoAvaliacao['descricao6']; ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <label><?php echo $dadosAutoAvaliacao['quesito7']; ?></label>
                </td>
                <td>
                    <label><?php echo $dadosAutoAvaliacao['nota7']; ?></label>
                </td>
                <td>
                    <label><?php echo $dadosAutoAvaliacao['descricao7']; ?></label>
                </td>
            </tr>
            <tr>
                <td>
                    <label><?php echo $dadosAutoAvaliacao['quesito8']; ?></label>
                </td>
                <td>
                    <label><?php echo $dadosAutoAvaliacao['nota8']; ?></label>
                </td>
                <td>
                    <label><?php echo $dadosAutoAvaliacao['descricao8']; ?></label>
                </td>
            </tr>
            <?php
                if ($dadosAutoAvaliacao['quesito9'] != NULL) {
                    echo "
                        <tr>
                            <td>
                                <label>{$dadosAutoAvaliacao['quesito9']}</label>
                            </td>
                            <td>
                                <label>{$dadosAutoAvaliacao['nota9']}</label>
                            </td>
                            <td>
                                <label>{$dadosAutoAvaliacao['descricao9']}</label>
                            </td>
                        </tr>
                    ";
                }
            ?>

        </table>
    </div>
</div>
