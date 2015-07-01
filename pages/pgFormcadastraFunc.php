<section>
    <form class="cadastro" name="formUsuario">
        <div class="camposFormularioSimples">
            <p id="tituloPrincipal">Cadastro de funcionário</p>

            <input type="hidden" name="tipo" value="novo" />

            <label for="nome">Nome completo</label>
            <input type="text" name="nome" value="" />

            <label for="apelido">Nome de Visualiazação</label>
            <input type="text" name="apelido" value="" />

            <label for="apelido">Login</label>
            <input type="text" name="login" value="" />

            <label for="apelido">Foto</label>
            <input type="file" name="foto" value="" />

            <label for="apelido">Data de entrada</label>
            <input type="text" name="dataEntrada" value="" />

            <label for="apelido">E-mail</label>
            <input type="email" name="email" value="" />

            <label for="apelido">Telefone</label>
            <input type="text" name="telefone" value="" />

            <label for="apelido">Cargo</label>
            <select name="cargo">
                <?php
                foreach ($dadosCargos as $cargo) {
                    echo "<option value=''>{$cargo['cargo']}</option>";
                }
                ?>
            </select>

            <input type="submit" class="alterar" name="cadastrar" value="Salvar">
        </div>
    </form>
</section>