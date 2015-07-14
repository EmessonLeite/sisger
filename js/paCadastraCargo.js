$(document).ready(function () {
    
    /** Configurações do lightbox */
    $(".caixaComentarios").draggable();
    $("a[rel*=leanModal]").leanModal({top: 200, overlay: 0.4, closeButton: ".modal_close"});
    
    /** Exbibição da mensagem de exclusão */
    $('a.exluirCargo').click(function (e) {
        e.preventDefault();
        $('#idCargoExcluido').val($(this).attr('href'));
        $('#btnExcluir').click();
    });

    /** Redireciona para a pagina de exclusão */
    $('#confirmarExcluir').click(function () {
        window.location = $('#raiz').val() + $('#idCargoExcluido').val();
    });
});

/**
 * Função que ler o arquivo e carrega na IMG fotoAtual
 * @param input que contem a imagem
 * @return void
 */
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#fotoAtual').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}