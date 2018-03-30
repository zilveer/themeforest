(function($){
    'use strict';

    var sliders = $('.slider-parallax'),
        primary = $('#primary');

    sliders.prev('#header').addClass('header-slider-parallax slider-fixed');

    if( ! $('body').hasClass( 'boxed-layout' ) ){
        $('.header-parallax').css('margin-top', $('#header').height());
    }

    var windowsize = $(window).width();


    if(yit.isRtl)    {
        primary.find(".slider-parallax").css({
            right: -(( windowsize-$('.container').width())/2),
            width: windowsize
        });

        primary.find(".slider-parallax-item").css({
            right: "auto",
            width: windowsize
        });
    }
    else{
        $("#primary .slider-parallax, .header-parallax .parallaxeos_outer").css({
            left: -(( windowsize-$('.container').width())/2),
            width: windowsize
        });

        primary.find(".slider-parallax-item").css({
            left: "auto",
            width: windowsize
        });
    }

    if ($.fn.imagesLoaded && $.fn.owlCarousel ) {
        sliders.imagesLoaded(function(){
            var autoplay = false,
                slider = $(this);

            if ( slider.data('autoplay') ){
                autoplay = slider.data('autoplay');
            }

            slider.owlCarousel({
                autoPlay: autoplay,
                singleItem:true,
                navigation : true,
                stopOnHover: true,
                paginationSpeed : 400,
                beforeInit: function() {
                    slider.find('.slider-parallax-item').each(function(){
                        $(this)
                            .addClass('parallaxeos_slider')
                            .find('.parallaxeos_animate').removeClass('animated');
                    });
                },
                afterAction: function(current) {
                    current.find('.parallaxeos_animate').removeClass('animated');
                    setTimeout(function(){
                        current.find('.parallaxeos_animate').addClass('animated');
                    }, 50);

                    current.find('.video-parallaxeos').trigger('play');


                }
            });
        });
    }

})(jQuery);