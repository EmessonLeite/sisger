$(document).ready(function () {
    $('form#simples').submit(function () {
        var iSenhaAtual = $('input[name=senhaAtual]').val();
        var iNovaSenha = $('input[name=novaSenha]').val();
        var iConfirmarSenha = $('input[name=confirmarSenha]').val();

        var vazio = false;

        $.each(['senhaAtual', 'novaSenha', 'confirmarSenha'], function (i, l) {
            if ($('input[name=' + l + ']').val() == '') {
                $('p#info').html('Preencha todos os campos obrigatorios.');
                vazio = true;
            }
        });

        $.ajax({
            method: "POST",
            url: "responses/resalterarSenha.php",
            data: {senhaAtual: iSenhaAtual, novaSenha: iNovaSenha, confirmarSenha: iConfirmarSenha}
        })
                .done(function (resultado) {
                    if (resultado == "true") {
                        window.location = $('#raiz').val() + "home";
                    } else {
                        $('p#info').html(resultado);
                    }
                });
        return false;
    });
});