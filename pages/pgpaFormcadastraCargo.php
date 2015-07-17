<section>
    <form class="cadastro" id="completo" name="formUsuario" method="POST" enctype="multipart/form-data">
        <div class="camposFormularioCompleto">
            <div class="inputs">
                <p id="tituloPrincipal">Cadastro de cargos</p>

                <input type="hidden" name="tipo" value="<?php echo $url->getURL(1); ?>" />
                
                <input type="hidden" name="quesitos" />

                <?php
                echo (isset($dadosCargo[0]['id'])) ? "<input type='hidden' name='id' value='{$dadosCargo[0]['id']}'>" : "";
                ?>

                <div>
                    <label for="nome">Ordem</label><br/>
                    <input type="text" name="ordem" value="<?php echo (isset($dadosCargo[0]['ordem'])) ? $dadosCargo[0]['ordem'] : ""; ?>" />
                </div>

                <div>
                    <label for="apelido">Nome do cargo</label><br/>
                    <input type="text" name="cargo" value="<?php echo (isset($dadosCargo[0]['cargo'])) ? $dadosCargo[0]['cargo'] : ""; ?>" />
                </div>

                <div id="infoQuesitos">
                    <label for="quesitoAdd">Quesito</label>
                    <input type="text" name="quesitoAdd" />
                    <input type="button" class="alterar" id="add" value="Adicionar" />
                    <ul id="sortable">
                        <?php
                        if(isset($quesitos) && count($quesitos))
                        foreach ($quesitos as $q){
                            echo "<li class='ui-state-default'><div class='quesito'><p id='txtQuesito'>{$q['quesito']}</p></div><a href='' class='excluirQuesito'><img src='imagens/lixeira.gif'></a></li>";
                        }
                        
                        ?>
                    </ul>
                </div>

                <div>
                    <input type="submit" class="alterar" name="cadastrar" value="Salvar">
                    <a href="<?php echo RAIZ . $url->getURL(0); ?>">Voltar a listagem</a>
                    <p id="infoQuesitos"></p>
                </div>

            </div>
        </div>
    </form>
</section>