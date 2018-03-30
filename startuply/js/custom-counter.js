$(window).on('load', function () {
    function drawValue($el) {

        if ( $el.is('.vsc_ready') ) return;

        var $field = $el.find('.vsc_counter_value_place'),
            value = parseInt($el.attr('data-counter-value')),
            drawInterval, i = 0, progressVal = 0, t = 0.05;
        var tmp = '';

        $el.addClass('vsc_ready');

        var easeInOutQuart = function (t) { return t<.3 ? 8*t*t*t*t : 1-8*(--t)*t*t*t };
        var easeOutQuart = function (t) { return 1-(--t)*t*t*t },

        drawInterval = setInterval(function() {
            i += 0.01;
            progressVal = easeOutQuart(i)*value;

            if ( Math.round(progressVal) >= value ) {
                $field.html(value);
                clearInterval(drawInterval);
            } else {
                $field.html(Math.round(progressVal));
            }
        }, 40);
    }

    if ( $('.vsc_counter').not('.no-animation').length ) {
        $.each( $('.vsc_counter').not('.no-animation'), function ( i, v ) {
            if (typeof $.fn.waypoint !== 'undefined') {
                $(this).waypoint(function(direction) { drawValue($(this)); }, { offset: '90%' });
            } else {
                drawValue($(this));
            }
        });
    }
});