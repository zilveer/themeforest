(function($){
    'use strict';

    $('.slider-parallax').prev('#header').addClass('header-slider-parallax slider-fixed');

    if( $('#header').hasClass('sticky-header') && ! $('body').hasClass('force-sticky-header')){
        $('.header-parallax').css('margin-top', $('#header').height());
    }

    var windowsize = $(window).width();

    if(yit.isRtl == true )    {
        $("#primary .slider-parallax").css({
            right: -( windowsize / 2 ),
            width: windowsize
        });

        $("#primary .slider-parallax-item").css({
            right: "auto",
            width: windowsize
        });
    }
    else{
        $("#primary .slider-parallax, .header-parallax .parallaxeos_outer").css({
            left: -( windowsize / 2 ),
            width: windowsize
        });

        $("#primary .slider-parallax-item").css({
            left: "auto",
            width: windowsize
        });
    }

    var sliders = $('.slider-parallax');

    if ($.fn.imagesLoaded && $.fn.owlCarousel ) {

        sliders.each(function(){

            var slider = $(this),
                autoplay = false,
                transition = ( typeof slider.data('transition') != 'undefined' ) ? slider.data('transition') : '1500',
                loop = true,
                nav = true,
                dots = true,
                autoplayTimeout = 5000;

            if ( slider.data('autoplay') ) {
                autoplayTimeout = slider.data('autoplay');
                autoplay = true;
            }


            var numchild = slider.find('.slider-parallax-item').length;

            if( numchild == 1 ){
                loop = false;
                nav = false;
                autoplay = false;
                dots = false;
            }

            slider.imagesLoaded(function(){
                var owl = slider.owlCarousel({
                    items:1,
                    autoplay: autoplay,
                    autoplayTimeout: autoplayTimeout,
                    loop: loop,
                    dots: dots,
                    autoplayHoverPause: true,
                    smartSpeed: transition,
                    rtl: yit.isRtl == true,
                    onInitialize : function() {
                        slider.find('.slider-parallax-item').each(function(){
                            $(this)
                                .addClass('parallaxeos_slider')
                                .find('.parallaxeos_animate').removeClass('animated');
                        });
                    },
                    onInitialized: function() {
                        slider.find('.slider-parallax-item').each(function(){
                            var video = $(this).find('video');

                            video.on('play', function(e){
                                e.stopPropagation();
                            }).trigger('play');
                        });
                    }
                });

                owl.on('changed.owl.carousel', function (event) {
                    var current = $(event.target);
                    current.find('.parallaxeos_animate').removeClass('animated');
                    setTimeout(function () {
                        current.find('.parallaxeos_animate').addClass('animated');
                    }, 50);

                    var video = current.find('video');

                    video.on('play', function(e){
                        e.stopPropagation();
                    }).trigger('play');
                });
            });

        });
    }

})(jQuery);