<section>
    <form class="cadastro" id="completo" name="formUsuario" method="POST">
        <div class="camposFormularioCompleto">
            <div class="inputs">
                <p id="tituloPrincipal">Cadastro de funcionário</p>

                <input type="hidden" name="tipo" value="novo" />

                <input type="hidden" name="senha" value="*23AE809DDACAF96AF0FD78ED04B6A265E05AA257" />

                <div>
                    <label for="nome">Nome completo</label><br/>
                    <input type="text" name="nome" value="" />
                </div>

                <div>
                    <label for="apelido">Nome de Visualiazação</label><br/>
                    <input type="text" name="apelido" value="" />
                </div>

                <div>
                    <label for="apelido">Login</label><br/>
                    <input type="text" name="login" value="" />
                </div>

                <div>
                    <label for="apelido">Foto</label><br/>
                    <input type="file" disabled="disabled" name="foto" value="" />
                </div>

                <div>
                    <label for="apelido">Data de entrada</label><br/>
                    <input type="text" class="date" name="dataEntrada" value="" />
                </div>

                <div>
                    <label for="apelido">E-mail</label><br/>
                    <input type="email" name="email" value="" />
                </div>

                <div>
                    <label for="apelido">Telefone</label><br/>
                    <input type="text" class="fone" name="telefone" value="" />
                </div>

                <div>
                    <label for="apelido">Cargo</label><br/>
                    <select name="cargo">
                        <?php
                        foreach ($cargos as $cargo) {
                            echo "<option value='{$cargo['id']}'>{$cargo['cargo']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div>
                    <input type="submit" class="alterar" name="cadastrar" value="Salvar">
                </div>

            </div>
        </div>
    </form>
</section>