$(document).ready(function () {

    /** Configurações do lightbox */
    $(".caixaComentarios").draggable();
    $("a[rel*=leanModal]").leanModal({top: 200, overlay: 0.4, closeButton: ".modal_close"});

    /** Exbição da mensagem de exclusão */
    $('a.exluirComentario').click(function (e) {
        e.preventDefault();
        $('#idCargoExcluido').val($(this).attr('href'));
        $('#btnExcluir').click();
    });

    /** Redireciona para a pagina de exclusão */
    $('#confirmarExcluir').click(function () {
        window.location = $('#raiz').val() + $('#idCargoExcluido').val();
    });
});