$(document).ready(function () {

    $(".caixaLightBox").draggable();
    $(".caixaAutoAva").draggable();

    $("a[rel*=leanModal]").leanModal({top: 200, overlay: 0.4, closeButton: ".modal_close"});

});