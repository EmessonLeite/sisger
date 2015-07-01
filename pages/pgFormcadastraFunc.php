<section>
    <form class="cadastro" name="formUsuario" method="POST">
        <div class="camposFormularioSimples">
            <p id="tituloPrincipal">Cadastro de funcionário</p>

            <input type="hidden" name="tipo" value="novo" />
            
            <input type="hidden" name="senha" value="*23AE809DDACAF96AF0FD78ED04B6A265E05AA257" />

            <label for="nome">Nome completo</label>
            <input type="text" name="nome" value="" />

            <label for="apelido">Nome de Visualiazação</label>
            <input type="text" name="apelido" value="" />

            <label for="apelido">Login</label>
            <input type="text" name="login" value="" />

            <label for="apelido">Foto</label>
            <input type="file" disabled="disabled" name="foto" value="" />

            <label for="apelido">Data de entrada</label>
            <input type="text" name="dataEntrada" value="" />

            <label for="apelido">E-mail</label>
            <input type="email" name="email" value="" />

            <label for="apelido">Telefone</label>
            <input type="text" name="telefone" value="" />

            <label for="apelido">Cargo</label>
            <select name="cargo">
                <?php
                foreach ($cargos as $cargo) {
                    echo "<option value='{$cargo['id']}'>{$cargo['cargo']}</option>";
                }
                ?>
            </select>

            <input type="submit" class="alterar" name="cadastrar" value="Salvar">
        </div>
    </form>
</section>