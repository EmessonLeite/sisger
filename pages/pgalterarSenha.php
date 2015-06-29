<form class="cadastro" id="alterarSenha">
    <h1>Alterar senha de acesso</h1>
    
    <input id="idUsuario" type="hidden" value="<?php echo $idUsuario; ?>" />
    
    <label for="senhaAtual">Senha atual:</label>
    <input type="password" name="senhaAtual" />
    
    <label for="novaSenha">Nova senha:</label>
    <input type="password" name="novaSenha" />
    
    <label for="confirmarSenha">Confirmar senha:</label>
    <input type="password" name="confirmarSenha" />
    
    <input name="enviar" type="submit" value="Alterar" />
    <p id="info"></p>
</form>