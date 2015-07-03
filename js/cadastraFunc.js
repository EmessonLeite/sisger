$(document).ready(function () {

    /** */
    $("#datepicker").datepicker($.datepicker.regional["pt-BR"]);

    /** */
    $('.date').mask('00/00/0000');
    $('.fone').mask('(00) 00000-0000');

    /** */
    $('input[type=file]').change(function(){
        var foto = document.getElementById('foto');
        if(foto.files[0].size){
            readURL(this);
        }else{
            alert('')
        }
       
    });
    
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