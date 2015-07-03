$(document).ready(function () {
    /** */
    $('.date').mask('00/00/0000');
    $('.fone').mask('(00) 00000-0000');

    /** */
    $(".caixaComentarios").draggable();
    $("a[rel*=leanModal]").leanModal({top: 200, overlay: 0.4, closeButton: ".modal_close"});
    
    /** */
    $('a.exluirFuncionario').click(function (e) {
        e.preventDefault();
        $('#idUsuarioExcluido').val($(this).attr('href'));
        $('#btnExcluir').click();
    });
    
    /** */
    $('#confirmarExcluir').click(function () {
        window.location = $('#raiz').val() + 'cadastraFunc/excluir/' + $('#idUsuarioExcluido').val();
    });
});