<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<!--<link rel="stylesheet" href="css/jquery-ui.css">/-->
<section>
    <form class="cadastro" id="completo" name="formUsuario" method="POST" enctype="multipart/form-data">
        <div class="camposFormularioCompleto">
            <div class="inputs">
                <p id="tituloPrincipal">Cadastro de funcionário</p>
                <div>
                    <img src="imagens/perfil/<?php echo $foto; ?>" alt="" id="fotoAtual" />
                </div>
                
                <div>
                    <label for="foto">Foto</label><br/>
                    <input type="file" name="foto" />
                </div>
                
                <input type="hidden" name="tipo" value="<?php echo $url->getURL(1); ?>" />
                
                <?php
                    echo (isset($dadosUsuario[0]['id'])) ?  "<input type='hidden' name='id' value='{$dadosUsuario[0]['id']}'>" : "" ;
                ?>
                
                <input type="hidden" name="senha" value="*23AE809DDACAF96AF0FD78ED04B6A265E05AA257" />

                <div>
                    <label for="nome">Nome completo</label><br/>
                    <input type="text" name="nome" value="<?php echo (isset($dadosUsuario[0]['nome'])) ? $dadosUsuario[0]['nome'] : ""; ?>" />
                </div>

                <div>
                    <label for="apelido">Nome de Visualiazação</label><br/>
                    <input type="text" name="apelido" value="<?php echo (isset($dadosUsuario[0]['apelido'])) ? $dadosUsuario[0]['apelido'] : ""; ?>" />
                </div>

                <div>
                    <label for="login">Login</label><br/>
                    <input type="text" name="login" value="<?php echo (isset($dadosUsuario[0]['login'])) ? $dadosUsuario[0]['login'] : ""; ?>" />
                </div>

                <div>
                    <label for="dataEntrada">Data de entrada</label><br/>
                    <input type="text" id="datepicker" class="date" name="dataEntrada" value="<?php echo (isset($dadosUsuario[0]['dataEntrada'])) ? $dadosUsuario[0]['dataEntrada'] : ""; ?>" />
                </div>

                <div>
                    <label for="email">E-mail</label><br/>
                    <input type="email" name="email" value="<?php echo (isset($dadosUsuario[0]['email'])) ? $dadosUsuario[0]['email'] : ""; ?>" />
                </div>

                <div>
                    <label for="telefone">Telefone</label><br/>
                    <input type="text" class="fone" name="telefone" value="<?php echo (isset($dadosUsuario[0]['telefone'])) ? $dadosUsuario[0]['telefone'] : ""; ?>" />
                </div>

                <div>
                    <label for="cargo">Cargo</label><br/>
                    <select name="cargo">
                        <?php
                        foreach ($cargos as $cargo) {
                            if(isset($dadosUsuario[0]['cargo']) && $dadosUsuario[0]['cargo'] == $cargo['id']){
                                $selected = "selected='selected'";
                            }else{
                                $selected = "";
                            }
                            echo "<option {$selected} value='{$cargo['id']}'>{$cargo['cargo']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div id="status">
                    <label for="status">Status</label><br/>
                    <input type="radio" value="0" name="status" />
                    Ativo
                    <input type="radio" value="1" name="status" />
                    Inativo  
                    </select>
                </div>

                <div>
                    <input type="submit" class="alterar" name="cadastrar" value="Salvar">
                    <input type="submit" class="alterar" value="Voltar" onclick="window.location = '<?php echo $url->getURL(0); ?>';">
                </div>

            </div>
        </div>
    </form>
</section>