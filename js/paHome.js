$(document).ready(function () {
    /**
     * Valor atual do atributo css top da div#lista-pessoas
     */
    var top = (-1) * $('#top').val();

    $('#lista-pessoas').css('top', top + 'px');

    /**
     * Altura minima que a div#lista-pessoas pode ter
     */
    var min = ($('#lista-pessoas').height() - $('#listagem-geral').height()) * (-1);

    /**
     * Altura max que a div#lista-pessoas pode ter
     */
    var max = 0;

    /**
     * Direção atual da animação. Pode ser: parado, cima, baixo
     */
    var direcao = "parado";

    /**
     * Redireciona para o funcionario clicado
     */
    $('.funcionarios').click(function () {
        $(this).attr('href', $(this).attr('href') + '/' + ((-1) * top));
    });

    /**
     * Redireciona para a avaliacao clicada
     */
    $('select#avaliacoes').change(function () {
        var referente = $(this).find('option:selected').html();
        var ID = $(this).find('option:selected').val();

        if (ID !== "0") {
            window.location = $('#raiz').val() + "paHome/" + referente + "/" + ID + "/0";
        }
    });

    /**
     * Clique do botão de auto avalicao dentro do iframe conteudo
     */
    $('#conteudo').load(function () {
        /** Recebe o tamanho do conteudo do iframe */
        var tamanho = $('#conteudo').contents().find('.tbConteudo').height();

        /** Caso o tamanho do conteudo seja maior 390, o tamanho do iframe é aumentado  */
        if(tamanho != null && tamanho > 380){
            $('iframe.conteudos').css('height', (tamanho + 25) + 'px');
        }else{
            $('iframe.conteudos').css('height', '390px');
        }
        
        $('#conteudo').contents().find('#edita-autoava').click(function () {
            $('#edita-autoava-click').click();
        });
    });

    /**
     * Clique do botão de avaliação passada dentro do iframe conteudo
     */
    $('#conteudo').load(function () {
        /** Recebe o tamanho do conteudo do iframe */
        var tamanho = $('#conteudo').contents().find('.tbConteudo').height();

        /** Caso o tamanho do conteudo seja maior 390, o tamanho do iframe é aumentado  */
        if(tamanho != null && tamanho > 380){
            $('iframe.conteudos').css('height', (tamanho + 25) + 'px');
        }else{
            $('iframe.conteudos').css('height', '390px');
        }

        $('#conteudo').contents().find('#editaAvaliacaoPassada').click(function () {
            $('#editaAvaliacaoPassadaClick').click();
        });
    });

    $(".caixaComentarios").draggable();
    $(".caixaAutoAva").draggable();
    $(".caixaAvaliacaoPassada").draggable();

    $("a[rel*=leanModal]").leanModal({top: 200, overlay: 1.0, closeButton: ".modal_close"});

    /**
     * 
     */
    $('.frmComentarios').submit(function () {
        var iIdusuario = $(this).find('#idUsuario').val();
        var iIdusuarioLogado = $(this).find('#idUsuarioLogado').val();
        var iIdAvaliacao = $(this).find('#idAvaliacao').val();
        var iTipo = $(this).find('#tipo').val();
        var iComentario = $(this).find('#comentario').val();

        $.ajax({
            method: "POST",
            url: "responses/rescomentario.php",
            data: {idUsuario: iIdusuario, idAvaliacao: iIdAvaliacao, tipo: iTipo, comentario: iComentario, idUsuarioLogado: iIdusuarioLogado}
        })
                .done(function (resultado) {
                    //alert(resultado);
                    if (resultado > 0) {
                        $('.frmComentarios').find('#comentario').val('');
                        $('.frmComentarios').find('.modal_close').click();
                    } else {
                        alert("Usuário não cadastrado nesta avaliação.");
                    }

                });
        return false;
    });

    /**
     * Marcar aba clicada com uma cor diferente, indicando que esta está selecionada
     */
    $('.info').click(function () {
        mudarCor(this);
    });

    /**
     * Inicia a barra de rolagem para cima da listagem de pessoas
     */
    $('#setaBaixo').mousedown(function () {
        if (top > min) {
            top -= 10;
            direcao = "cima";

            $('#lista-pessoas').css('top', top + 'px');

            setTimeout(function () {
                if (direcao === "cima") {
                    $('#setaBaixo').mousedown();
                }
            }, 10);
        }
    });

    /**
     * Pausa a barra de rolagem para cima da listagem de pessoas
     */
    $('#setaBaixo').mouseup(function () {
        direcao = "parado";
    });

    /**
     * Inicia a barra de rolagem para baixo da listagem de pessoas
     */
    $('#setaCima').mousedown(function () {
        if (top < max) {
            top += 10;
            direcao = "baixo";

            $('#lista-pessoas').css('top', top + 'px');

            setTimeout(function () {
                if (direcao === "baixo") {
                    $('#setaCima').mousedown();
                }
            }, 10);
        }
    });

    /**
     * Pausa a barra de rolagem para baixo da listagem de pessoas
     */
    $('#setaCima').mouseup(function () {
        direcao = "parado";
    });

});

/**
 * Função que muda a cor da aba que esta selecionada
 */
function mudarCor(btnSelecionado) {
    $('.info').each(function () {
        $(this).removeClass('clicado')
                .addClass('naoClicado');
    });

    $(btnSelecionado).removeClass('naoClicado')
            .addClass('clicado');
}
