<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<section>
    <form class="cadastro" id="completo" name="formUsuario" method="POST" enctype="multipart/form-data">
        <div class="camposFormularioCompleto">
            <div class="inputs">
                <p id="tituloPrincipal">Cadastro de avaliações</p>

                <input type="hidden" name="tipo" value="<?php echo $url->getURL(1); ?>" />
                
                <input type="hidden" name="quesitos" />

                <?php
                echo (isset($dadosAvaliacao[0]['id'])) ? "<input type='hidden' name='id' value='{$dadosAvaliacao[0]['id']}'>" : "";
                ?>

                <div>
                    <label for="nome">Referente</label><br/>
                    <input type="text" name="referente" value="<?php echo (isset($dadosAvaliacao[0]['referente'])) ? $dadosAvaliacao[0]['referente'] : ""; ?>" />
                </div>

                <div>
                    <label for="apelido">Data início</label><br/>
                    <input type="text" name="inicio" class="dateTime" value="<?php echo (isset($dadosAvaliacao[0]['inicio'])) ? $dadosAvaliacao[0]['inicio'] : ""; ?>" />
                </div>

                <div>
                    <label for="apelido">Data fim</label><br/>
                    <input type="text" name="fim" class="dateTime" value="<?php echo (isset($dadosAvaliacao[0]['fim'])) ? $dadosAvaliacao[0]['fim'] : ""; ?>" />
                </div>

                <div>
                    <label for="apelido">Início comentários</label><br/>
                    <input type="text" name="inicioComentario" class="dateTime" value="<?php echo (isset($dadosAvaliacao[0]['inicioComentario'])) ? $dadosAvaliacao[0]['inicioComentario'] : ""; ?>" />
                </div>

                <div>
                    <label for="apelido">Fim comentários</label><br/>
                    <input type="text" name="fimComentario" class="dateTime" value="<?php echo (isset($dadosAvaliacao[0]['fimComentario'])) ? $dadosAvaliacao[0]['fimComentario'] : ""; ?>" />
                </div>

                <div>
                    <label for="apelido">Início autoavaliação</label><br/>
                    <input type="text" name="inicioAutoAva" class="dateTime" value="<?php echo (isset($dadosAvaliacao[0]['inicioAutoAva'])) ? $dadosAvaliacao[0]['inicioAutoAva'] : ""; ?>" />
                </div>

                <div>
                    <label for="apelido">Fim autoavaliação</label><br/>
                    <input type="text" name="fimAutoAva" class="dateTime" value="<?php echo (isset($dadosAvaliacao[0]['fimAutoAva'])) ? $dadosAvaliacao[0]['fimAutoAva'] : ""; ?>" />
                </div>

                <div style="display: block;">
                    <input type="submit" class="alterar" name="cadastrar" value="Salvar">
                    <a href="<?php echo RAIZ . $url->getURL(0); ?>">Voltar a listagem</a>
                    <p id="infoQuesitos"></p>
                </div>

            </div>
        </div>
    </form>
</section>