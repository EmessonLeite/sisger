$(document).ready(function () {

    $(".dateTime").datepicker($.datepicker.regional["pt-BR"]);
    
    $('input.dateTime').focus(function(){
        $('input#datepicker').attr('id', '1');
        $(this).attr('id', 'datepicker');
    });

    /** Configurações do lightbox */
    $(".caixaComentarios").draggable();
    $("a[rel*=leanModal]").leanModal({top: 200, overlay: 0.4, closeButton: ".modal_close"});

    /** Exbição da mensagem de exclusão */
    $('a.exluirAvaliacao').click(function (e) {
        e.preventDefault();
        $('#idAvaliacaoExcluido').val($(this).attr('href'));
        $('#btnExcluir').click();
    });

    /** Redireciona para a pagina de exclusão */
    $('#confirmarExcluir').click(function () {
        window.location = $('#raiz').val() + $('#idAvaliacaoExcluido').val();
    });

});