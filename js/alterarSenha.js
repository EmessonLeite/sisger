$(document).ready(function () {
    $('form#alterarSenha').submit(function () {
        var iIdUsuario = $('input#idUsuario').val();
        var iSenhaAtual = $('input[name=senhaAtual]').val();
        var iNovaSenha = $('input[name=novaSenha]').val();
        var iConfirmarSenha = $('input[name=confirmarSenha]').val();

        $.ajax({
            method: "POST",
            url: "responses/resalterarSenha.php",
            data: {idUsuario: iIdUsuario, senhaAtual: iSenhaAtual, novaSenha: iNovaSenha, confirmarSenha: iConfirmarSenha}
        })
                .done(function (resultado) {
                    if (resultado == "ok") {
                        window.location = $('#raiz').val() + "home";
                    } else {
                        $('p#info').html(resultado);
                    }
                });
        return false;
    });
});