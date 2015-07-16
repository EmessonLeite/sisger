$(document).ready(function () {
    var retorno = false;
    $('form#completo').submit(function () {
        if ($('input[name=ordem]').val() === "") {
            $('p#infoQuesitos').html('O campo "Ordem" deve ser preenchido.');
        } else if ($('input[name=cargo]').val() === "") {
            $('p#infoQuesitos').html('O campo "Nome do cargo" deve ser preenchido.');
        } else {
            var quesitosCargo = [];
            $('div.quesito').each(function () {
                quesitosCargo.push($(this).html());
            });
            
            $('input[name=quesitos]').val(JSON.stringify(quesitosCargo));
            retorno = true;
        }
        return retorno;
    });

    $("#sortable").sortable({
        revert: true
    });
    $("ul, li").disableSelection();

    /** Configurações do lightbox */
    $(".caixaComentarios").draggable();
    $("a[rel*=leanModal]").leanModal({top: 200, overlay: 0.4, closeButton: ".modal_close"});

    /** Exbição da mensagem de exclusão */
    $('a.exluirCargo').click(function (e) {
        e.preventDefault();
        $('#idCargoExcluido').val($(this).attr('href'));
        $('#btnExcluir').click();
    });

    /** Redireciona para a pagina de exclusão */
    $('#confirmarExcluir').click(function () {
        window.location = $('#raiz').val() + $('#idCargoExcluido').val();
    });

    /**
     *  Remove a linha clicada da listagem
     *  @param e elemento clicado
     */
    $(document).on('click', 'a.excluirQuesito', function (e) {
        e.preventDefault();
        $(this).parent().remove();
    });

    /** Adiciona o quesito a listagem */
    $('input#add').click(function () {

        /** Recebe o valor digitado para o novo quesito */
        var quesito = $('input[name=quesitoAdd]').val();

        /** @var bool */
        var repetido = false;
        /** Verifica se o valor esta repitido */
        $('div.quesito').each(function () {
            if ($(this).html() === quesito) {
                repetido = true;
            }
        });


        /** Verifica se o valor a ser iserido é vazio ou repetido */
        if (quesito === "") {
            $('p#infoQuesitos').html('Não pode ser inserido um quesito vazio.');
        } else if (repetido) {
            $('p#infoQuesitos').html('O quesito "' + quesito + '" já foi adicionado neste cargo.');
        } else {
            var row = '<li class="ui-state-default"><div class="quesito">' + quesito + '</div><a href="" class="excluirQuesito"><img src="imagens/lixeira.gif"></a></li>';
            $('ul#sortable').append(row);
            $('p#infoQuesitos').html('');
        }
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