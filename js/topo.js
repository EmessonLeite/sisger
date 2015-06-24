$(document).ready(function () {
    $('#config').click(function () {
        $('#drop-config').css("visibility", "visible");
    });
    $('#config').change(function () {
        $('#drop-config').css("visibility", "hidden");

    });
});