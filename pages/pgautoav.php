<?php

?>
<link rel='stylesheet' href='../css/autoava.css'/>
<script src="../js/jquery-2.1.4.min.js" type="text/javascript"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript" src="../js/jquery.leanModal.min.js"></script>
<link rel='stylesheet' type='text/css' href='../css/lightBox.css'>

<div id="tabela-auto">
    <div id="toda-autoava">
        <div id="titulo">
            <label id="titulo-autoava">Como eu me avaliaria</label>
            <img id="lapis-positivo" src="../imagens/lapis.png">
            <a href="#lightbox-autoava" name="lightbox-autoava" rel="leanModal" id="edita-autoava">
                
            </a>
        </div>
        <table id="autoava" cellspacing="0" cellpadding="0">
            <tr>
                <th id="quesito">Quesito:</th>
                <th id="np">NP:</th>
                <th id="obs">Obs:</th>
            </tr>
            <tr>
                <td>
                    <label>União e cooperação</label>
                </td>
                <td>
                    <label>100</label>
                </td>
                <td>
                    <label>dggfdg</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Disciplina</label>
                </td>
                <td>
                    <label>100</label>
                </td>
                <td>
                    <label>dfgdgdf</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Dedicação</label>
                </td>
                <td>
                    <label>100</label>
                </td>
                <td>
                    <label>fgdfg</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Consciência Crítica</label>
                </td>
                <td>
                    <label>100</label>
                </td>
                <td>
                    <label>sdfdsf</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Bom domínio e agilidade nas rotinas</label>
                </td>
                <td>
                    <label>100</label>
                </td>
                <td>
                    <label>sdfsdfsdf</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Boa organização nos processos</label>
                </td>
                <td>
                    <label>100</label>
                </td>
                <td>
                    <label>dfsdfsdf</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Boa criatividade</label>
                </td>
                <td>
                    <label>100</label>
                </td>
                <td>
                    <label>sdfsdfsdf</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Boa interação com seus coordenadores</label>
                </td>
                <td>
                    <label>100</label>
                </td>
                <td>
                    <label>sdfsdfsdf</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Iniciativa</label>
                </td>
                <td>
                    <label>100</label>
                </td>
                <td>
                    <label>sdfsdfsdf</label>
                </td>
            </tr>
        </table>
    </div>
</div>

<div id="lightbox-autoava" class="caixaComentarios">
    <form action="" class="frmComentarios">
        <div id="cabecalho-negativo">
            <p>Pontos Negativos</p>
            <a class="modal_close"></a>
        </div>
        <div class="txt-comentario-negativo">
            <label for="">Comentário: </label><br/>
            <textarea name="" id="comentario"></textarea>
            <button id="salvar-negativo" type="submit">Salvar</button>
        </div>
    </form>
</div>