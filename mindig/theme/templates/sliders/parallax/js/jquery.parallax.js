(function($, window, document){
    'use strict';

    var sliders = $('.yes-js .slider-parallax .masterslider-parallax'),
        windowsize = $('body').hasClass('boxed-layout') ? $('#wrapper').outerWidth() : $(window).width();

    sliders.each(function () {
        var autoplay = false,
            slider = $(this),
            slider_parent = $(this).parent(),
            id = slider.attr('id'),
            listSliders = slider.find('.parallaxeos_content'),
            layout = $('body').hasClass('boxed-layout') ? 'boxed' : 'fullwidth',
            mslider = new MasterSlider();


        if (typeof slider_parent.data('autoplay') != undefined ) {
            autoplay = slider.parent().data('autoplay');
        }

        if ( slider_parent.data('pagination') == 'yes' ) {
            mslider.control('bullets');
        }

        mslider.setup(id, {
            layout     : layout,
            width      : windowsize,
            height     : slider.data('height'),
            fullheight : true,
            space      : 0,
            autoplay   : autoplay,
            hideLayers : true,
            view       : "basic"
        });

        mslider.api.addEventListener(MSSliderEvent.CHANGE_START, function () {
            listSliders.each(function () {
                $(this).find('.parallaxeos_animate').removeClass('animated');
            });

            var current = $(listSliders[mslider.api.index()]);
            setTimeout(function () {
                current.find('.parallaxeos_animate').addClass('animated');
            }, 50);
            if (current.next('video').length) {
                current.next('video').trigger('play');
            }
        });

        $('.slider-parallax-item').css( 'visibility' , 'visible' );

    });
})(jQuery, window, document);