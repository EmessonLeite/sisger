$(document).ready(function(){
    
    /**Validação do submit do formulario de login */
    $('form[name=login]').submit(function(){
        
        if($('input[name=usuario]').val() === "" || $('input[name=senha]').val() === ""){
            $('#info').removeClass('processando');
            $('#info').html("Preencha todos os campos.")
                          .addClass('erro');
            return false;
        }
        
        /** Personalizando a mensagem para 'Processando...' */
        $('#info').html('Autenticando...')
                  .removeClass('logado')
                  .removeClass('erro')
                  .addClass('processando');
          
        /** Verificar se o usuario existe */
        $.ajax({
            method: "POST",
            url: "responses/reslogin.php",
            data: { login: $('input[name=usuario]').val(), senha: $('input[name=senha]').val() }
        })
        .done(function( resultado ) {
            
            $('#info').removeClass('processando');
            
            /** Verifica se o usuario é válido */
            if(resultado !== '0'){
                $('#info').html("Login efetuado com sucesso.")
                          .addClass('logado');
                  
                /** Redireciona para a home caso o usuario seja vádido */
                window.location = $('#raiz').val() + "paHome";
            }else{
                $('#info').html("Login ou senha inválido.")
                          .addClass('erro');
            }
        });
        return false;
    });
});