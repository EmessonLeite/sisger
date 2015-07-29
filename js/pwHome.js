$(document).ready(function () {
    
    /** Caixas que terão o comportamento dreggable */
    $(".caixaLightBox").draggable();
    $(".caixaAutoAva").draggable();
    
    /** lightbox */
    $("a[rel*=leanModal]").leanModal({top: 200, overlay: 0.4, closeButton: ".modal_close"});
    
    $('a#excluir').click(function(){
       $('input#idHorariooExcluido').val($(this).parent().find('input.idHorario').val());
    });
    
    
    
});