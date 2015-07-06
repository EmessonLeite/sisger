<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<!--<link rel="stylesheet" href="css/jquery-ui.css">/-->
<section>
    <form class="cadastro" id="completo" name="formUsuario" method="POST" enctype="multipart/form-data">
        <div class="camposFormularioCompleto">
            <div class="inputs">
                <p id="tituloPrincipal">Cadastro de cargos</p>

                <input type="hidden" name="tipo" value="<?php echo $url->getURL(1); ?>" />

                <?php
                    echo (isset($dadosCargo[0]['id'])) ?  "<input type='hidden' name='id' value='{$dadosCargo[0]['id']}'>" : "" ;
                ?>

                <div>
                    <label for="nome">Ordem</label><br/>
                    <input type="text" name="ordem" value="<?php echo (isset($dadosCargo[0]['ordem'])) ? $dadosCargo[0]['ordem'] : ""; ?>" />
                </div>

                <div>
                    <label for="apelido">Nome do cargo</label><br/>
                    <input type="text" name="cargo" value="<?php echo (isset($dadosCargo[0]['cargo'])) ? $dadosCargo[0]['cargo'] : ""; ?>" />
                </div>

                <div>
                    <input type="submit" class="alterar" name="cadastrar" value="Salvar">
                    <a href="<?php echo RAIZ . $url->getURL(0); ?>">Voltar a listagem</a>
                </div>

            </div>
        </div>
    </form>
</section>