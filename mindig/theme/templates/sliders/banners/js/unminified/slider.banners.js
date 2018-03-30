// ==ClosureCompiler==
// @output_file_name default.js
// @compilation_level SIMPLE_OPTIMIZATIONS
// ==/ClosureCompiler==

/**
 * Handler for banners slider
 */

(function($, window){
    'use strict';

    var windowsize = $(window).width();

    $('#primary').find('.slider.banners').css({
        left: -(( windowsize-$('.container').width())/2),
        width: windowsize
    });


    $('.slider.banners').each(function(){
        var this_slider = $(this),
            height = this_slider.data('height'),
            slider = new Swiper( '#' + this_slider.attr('id'), {
                slidesPerView: 'auto',
                calculateHeight: false,
                cssWidthAndHeight: true,
                mode : 'horizontal',
                autoplay: this_slider.data('autoplay') == 'yes' ? this_slider.data('interval') : 0,
                autoResize : false,
                resizeReInit : true,
                onSwiperCreated: function(swiper){
                    fixTextPosition( swiper );
                },
                onInit: function(swiper){
                    $( swiper.container).height( height );
                    resizeFix();
                }
            }),

            zoomProp = function() {
                var width = $(window).width(),
                    zoom;

                if ( width < 768 ) {
                    zoom = 480 / 1200;
                }
                else if ( width >= 768 && width <= 991 ) {
                    zoom = 768 / 1200;
                }
                else if ( width >= 992 && width <= 1199 ) {
                    zoom = 992 / 1200;
                }
                else {
                    zoom = 1;
                }

                return zoom;
            },

            resizeFix = function() {
                var width = $(window).width(),
                    h;

                h = zoomProp() * this_slider.data('height');

                $( slider.container ).height( h );
                $( '.swiper-wrapper, .swiper-slide', slider.container ).height( h );
                fixTextPosition( slider );
            };


        $(slider.container).on('click', '.prev', function(e){
            e.preventDefault();

            var nslides = $( '.swiper-slide', slider.container ).length,
                res = slider.swipePrev();

            if ( ! res ) {
                slider.swipeTo(nslides);
            }
        });

        $(slider.container).on('click', '.next', function(e){
            e.preventDefault();

            var res = slider.swipeNext();

            if ( ! res ) {
                slider.swipeTo(0);
            }
        });

        _onresize( function(){
            slider.reInit();
            resizeFix();
        });

        function fixTextPosition( swiper ) {
            $( '.slide-text.center', swiper.container ).each(function(){
                var text = $(this),
                    height = text.outerHeight(false);

                text.css({
                    position: 'absolute',
                    height: height,
                    top: '50%',
                    marginTop: ( height / 2 ) * -1,
                    zoom: zoomProp
                });
            });

            // remove prev and next link
            if ( $( '.swiper-wrapper', swiper.container ).width() <= swiper.width ) {
                $( '.prev, .next', swiper.container ).remove();
            }
        }
    });

})(jQuery, window);