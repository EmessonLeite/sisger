$(document).ready(function () {

    $('#config').click(function () {
        $('#drop-config').css("visibility", "visible");
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('#config').length) {
            $('#drop-config').css("visibility", "hidden");
        }
    });
});