<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="css/formCadastraFunc.css">
<!--<link rel="stylesheet" href="css/jquery-ui.css">/-->
<section>
    <form class="cadastro" id="completo" name="formUsuario" method="POST" enctype="multipart/form-data">
        <div class="camposFormularioCompleto">
            <div class="inputs">
                <p id="tituloPrincipal">Cadastro de funcionários</p>
                
                <p class="subTitulo">Dados Gerais</p>
                <hr/>
                <div id="fotoPerfil">
                    <input id="editar" type="button" value="editar"/>
                    <img src="imagens/perfil/<?php echo $foto; ?>" alt="" id="fotoAtual" />
                    <input type="file" name="foto" id="foto" accept="image/*" />
                </div>
                
                <input type="hidden" name="tipo" value="<?php echo $url->getURL(1); ?>" />
                
                <?php
                    echo (isset($dadosUsuario[0]['id'])) ?  "<input type='hidden' name='id' value='{$dadosUsuario[0]['id']}'>" : "" ;
                ?>
                
                <input type="hidden" name="senha" value="*23AE809DDACAF96AF0FD78ED04B6A265E05AA257" />

                <div class="left">
                    <label for="nome">Nome completo</label><br/>
                    <input type="text" name="nome" value="<?php echo (isset($dadosUsuario[0]['nome'])) ? $dadosUsuario[0]['nome'] : ""; ?>" />
                </div>

                <div class="left">
                    <label for="apelido">Nome de Visualiazação</label><br/>
                    <input type="text" name="apelido" value="<?php echo (isset($dadosUsuario[0]['apelido'])) ? $dadosUsuario[0]['apelido'] : ""; ?>" />
                </div>

                <div class="left">
                    <label for="dataEntrada">Data de entrada</label><br/>
                    <input type="text" id="datepicker" class="date" name="dataEntrada" value="<?php echo (isset($dadosUsuario[0]['dataEntrada'])) ? $dadosUsuario[0]['dataEntrada'] : ""; ?>" />
                </div>

                <div>
                    <label for="login">Login</label><br/>
                    <input type="text" name="login" value="<?php echo (isset($dadosUsuario[0]['login'])) ? $dadosUsuario[0]['login'] : ""; ?>" />
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
                    <input type="radio" value="1" <?php echo ((!isset($dadosUsuario[0]['status']) || $dadosUsuario[0]['status'] == '1') ? 'checked="checked"' : '' ); ?> name="status" />
                    Ativo
                    <input type="radio" value="0" <?php echo ((isset($dadosUsuario[0]['status']) && $dadosUsuario[0]['status'] == '0') ? 'checked="checked"' : '' ); ?> name="status" />
                    Inativo  
                    </select>
                </div>
                <br/>
                <p class="subTitulo" id="dadosPessoais">Dados Pessoais</p>
                <hr/>
                
                <div>
                    <label for="cpf">CPF</label><br/>
                    <input type="text" name="cpf" class="cpf" value="<?php echo (isset($dadosUsuario[0]['cpf'])) ? $dadosUsuario[0]['cpf'] : ""; ?>" />
                </div>
                
                <div>
                    <label for="rg">RG</label><br/>
                    <input type="text" name="rg" value="<?php echo (isset($dadosUsuario[0]['rg'])) ? $dadosUsuario[0]['rg'] : ""; ?>" />
                </div>

                <div>
                    <label for="dataNascimento">Data de Nascimento</label><br/>
                    <input type="text" id="datepicker" name="dataNascimento" class="date" value="<?php echo (isset($dadosUsuario[0]['dataNascimento'])) ? $dadosUsuario[0]['dataNascimento'] : ""; ?>" />
                </div>
                
                <div>
                    <label for="nomeMae">Nome da Mãe</label><br/>
                    <input type="text" name="nomeMae" value="<?php echo (isset($dadosUsuario[0]['nomeMae'])) ? $dadosUsuario[0]['nomeMae'] : ""; ?>" />
                </div>
                
                <div>
                    <label for="nomePai">Nome do pai</label><br/>
                    <input type="text" name="nomePai" value="<?php echo (isset($dadosUsuario[0]['nomePai'])) ? $dadosUsuario[0]['nomePai'] : ""; ?>" />
                </div>
                
                <div id="sexo">
                    <label for="sexo">Sexo</label><br/>
                    <input type="radio" value="1" <?php echo ((!isset($dadosUsuario[0]['sexo']) || $dadosUsuario[0]['sexo'] == '1') ? 'checked="checked"' : '' ); ?> name="sexo" />
                    Masculino
                    <input type="radio" value="0" <?php echo ((isset($dadosUsuario[0]['sexo']) && $dadosUsuario[0]['sexo'] == '0') ? 'checked="checked"' : '' ); ?> name="sexo" />
                    Feminino
                    </select>
                </div>
                
                <p class="subTitulo">Contatos</p>
                <hr/>
                
                <div>
                    <label for="endereco">Endereço</label><br/>
                    <input type="text"  name="endereco" value="<?php echo (isset($dadosUsuario[0]['endereco'])) ? $dadosUsuario[0]['endereco'] : ""; ?>" />
                </div>    
                
                <div>
                    <label for="bairro">Bairro</label><br/>
                    <input type="text" name="bairro" value="<?php echo (isset($dadosUsuario[0]['bairro'])) ? $dadosUsuario[0]['bairro'] : ""; ?>" />
                </div>   
                
                <div>
                    <label for="cep">CEP</label><br/>
                    <input type="text" class="cep" name="cep" value="<?php echo (isset($dadosUsuario[0]['cep'])) ? $dadosUsuario[0]['cep'] : ""; ?>" />
                </div>  
                
                <div>
                    <label for="telefone">Telefone</label><br/>
                    <input type="text" class="fone" name="telefone" value="<?php echo (isset($dadosUsuario[0]['telefone'])) ? $dadosUsuario[0]['telefone'] : ""; ?>" />
                </div>    
                
                <div>
                    <label for="email">E-mail</label><br/>
                    <input type="email" name="email" value="<?php echo (isset($dadosUsuario[0]['email'])) ? $dadosUsuario[0]['email'] : ""; ?>" />
                </div>
                
                <hr id="salvar"/>
                
                <div>
                    <input type="submit" class="alterar" name="cadastrar" value="Salvar">
                    <a href="<?php echo RAIZ . $url->getURL(0); ?>">Voltar a listagem</a>
                </div>
                
                <div>
                    <p id="info"></p>
                </div>

            </div>
        </div>
    </form>
</section>