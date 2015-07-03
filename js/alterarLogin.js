$(document).ready(function () {
    $('form#simples').submit(function () {
        var iLogin = $('input[name=login]').val();
        
        $.ajax({
            method: "POST",
            url: "responses/resalterarLogin.php",
            data: {login: iLogin}
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