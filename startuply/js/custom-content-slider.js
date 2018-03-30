/* =========================================================
 * jquery.vc_chart.js v1.0
 * =========================================================
 * Copyright 2013 Wpbakery
 *
 * Jquery chart plugin for the Visual Composer(modified).
 * ========================================================= */
(function($){
    $.each($('.vsc_content_slider'), function () {
        var sliderSettings = {
                pager: $(this).attr('data-pagination') == 'true',
                controls: $(this).attr('data-arrows') == 'true',
                auto: $(this).attr('data-autoplay') == 'true',
                infiniteLoop: $(this).attr('data-loop') == 'true',
                speed: $(this).attr('data-speed'),
                pause: $(this).attr('data-interval'),
                autoDelay: $(this).attr('data-interval'),
                nextText: '',
                prevText: ''
            };

        $(this).find('.bx-slider').bxSlider(sliderSettings);
    })
})(window.jQuery);
