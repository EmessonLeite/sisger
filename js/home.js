
$(document).ready(function() {

    /**
     * Configurção fullcalender
     */
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
        },
        defaultDate: "<?php echo date('Y - m - d'); ?>",
        lang: 'pt',
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: []
    });



});
