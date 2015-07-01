<form class="cadastro" id="alterarLogin">
    <div class="camposFormularioSimples">
        <p id="tituloPrincipal">Alterar Login de acesso</p>

        <label for="nome">Nome completo:</label>
        <input type="text" name="nome" disabled="disabled" value="<?php echo $dadosUsuario[0]['nome']; ?>" />

        <label for="apelido">Nome curto:</label>
        <input type="text" name="apelido"  disabled="disabled" value="<?php echo $dadosUsuario[0]['apelido']; ?>" />

        <label for="email">Email:</label>
        <input type="text" name="email"  disabled="disabled" value="<?php echo $dadosUsuario[0]['email']; ?>" />

        <label for="login">Login:</label>
        <input type="text" name="login" value="<?php echo $dadosUsuario[0]['login']; ?>" />

        <input name="enviar" class="alterar" type="submit" value="Alterar" />
        <p id="info"></p>
    </div>
</form>

