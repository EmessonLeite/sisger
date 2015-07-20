$(document).ready(function () {

    $(".dateTime").datepicker($.datepicker.regional["pt-BR"]);
    
    /**Validação do form */
    $('form#completo').submit(function(){
        var vazio = false ;
        $.each(['nome', 'apelido', 'login'], function(i, l){
            if($('input[name=' + l + ']').val() ==  ''){
                $('p#info').html('Preencha todos os campos obrigatorios.');
                vazio = true;
            }
        });
        return !vazio;
        
    });

    /** Receber a imagem selecionada e exbe no img#fotoAtual */
    $('input#foto').change(function(){
        
        /** Verifica se o arquivo possui menos que 2MB */
        if(this.files[0].size < 2*(1024*1024)){
            readURL(this);
            $('p#info').html('');
        }else{
            $('p#info').html('A imagem do perfil deve ter no máximo 2 MB.');
            $('')
            $(this).val('');
        }
       
    });
    
    $("input#editar").mouseenter(function(){
        $("input#editar").animate({dispaly: 'block', height: '100%', opacity: '1'}, "slow");             
    });
        
    $("input#editar").click(function(){
         $("input#foto").click();
    });
    
    $("div#fotoPerfil").mouseleave(function(){
        $("input#editar").animate({height: '20px', opacity: '0.8'}, "slow");        
    });
    
    /** Configurações do lightbox */
    $(".caixaComentarios").draggable();
    $("a[rel*=leanModal]").leanModal({top: 200, overlay: 0.4, closeButton: ".modal_close"});
    
    /** Exbibição da mensagem de exclusão */
    $('a.exluirFuncionario').click(function (e) {
        e.preventDefault();
        $('#idUsuarioExcluido').val($(this).attr('href'));
        $('#btnExcluir').click();
    });

    /** Redireciona para a pagina de exclusão */
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