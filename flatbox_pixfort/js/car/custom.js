// jQuery Initialization
jQuery(document).ready(function($){

    /* ---------------------------------------------------------------------- */
    /* jCarousel
    /* ---------------------------------------------------------------------- */

    if($().jcarousel){

        var carousels = $('.iconbox-carousel, .project-carousel, .post-carousel');
        var testimonialCarousels = $('.testimonial-carousel');

        function swipeCarousel(e, dir) {
            var carouselParent = $(e.currentTarget).parents().eq(2);
            if(dir.toLowerCase() == 'left' ){
                carouselParent.find('.jcarousel-next').trigger('click');
            }
            if(dir.toLowerCase() == 'right' ){
                carouselParent.find('.jcarousel-prev').trigger('click');
            }
        }

        function getCarouselScrollCount(carousel) {

            var scroll = 100000;
            if(carousel.data('scroll')){
                scroll = parseInt(carousel.data('scroll'));
            }
            var windowWidth = $(window).width();

            if(windowWidth < 480 ) {
                return 1;
            } else if(windowWidth < 768 ) {
                return Math.min(1, scroll);
            } else if(windowWidth < 960 ) {
                return Math.min(1, scroll);
            } else {
                return Math.min(1, scroll);
            }

        }

        function resetCarouselPosition(carousel) {
            if(carousel.data('resize')) {
                carousel.css('left', '0');
            }
        }

        function initBasicCarousel(carousels, bindGestures) {
            carousels.each(function(i) {
                var carousel = $(this);
                var carouselScrollCount = getCarouselScrollCount(carousel);
                carousel.jcarousel({
                    scroll: carouselScrollCount,
                    animation: 'normal',
                    easing: 'easeOutCubic',
                    auto: ( carousel.data('auto') ? parseInt( carousel.data('auto') ) : 0 ),
                    wrap: 'last',
                    itemFallbackDimension: 220,
                    itemVisibleInCallback : function() {
                        onBeforeAnimation : resetCarouselPosition(carousel);
                        onAfterAnimation : resetCarouselPosition(carousel);
                    }
                });
            });

            if(bindGestures && Modernizr.touch && $().swipe) {
                carousels.swipe({
                    click       : function(e, target){
                        $(target).trigger('click');
                    },
                    swipeLeft       : swipeCarousel,
                    swipeRight      : swipeCarousel,
                    allowPageScroll : 'auto'
                });
            }
        }

        function resizeBasicCarousel(carousels) {
            carousels.each(function() {
                var carousel = $(this);
                var carouselChildren = carousel.children('li');
                var carouselItemWidth = carouselChildren.first().outerWidth(true);
                var newWidth = carouselChildren.length * carouselItemWidth + 100;
                if(carousel.width() !== newWidth ) {
                    carousel.css('width', newWidth).data('resize','true');
                    initBasicCarousel(carousel, true);
                    carousel.jcarousel('scroll', 1);
                    var timer = window.setTimeout( function() {
                        window.clearTimeout( timer );
                        carousel.data('resize', null);
                    }, 600 );
                }
            });
        }

        function initTestimonialCarousel(carousels) {
            carousels.each(function() {
                var carouselId = uuid().toString();
                var carouselParentId = uuid().toString();
                var carousel = $(this);
                var carouselSectionParent  = carousel.parent();
                carouselSectionParent.attr('id', carouselParentId);
                carousel.attr('id', carouselId);
                carousel.jcarousel({
                    scroll: 1,
                    visible: 1,
                    wrap: 'last'
                });
                $('#'+carouselParentId+' .jcarousel-next').attr('id', carouselId+"-next");
                $('#'+carouselParentId+' .jcarousel-prev').attr('id', carouselId+"-prev");
            });

            if(Modernizr.touch && $().swipe) {
                carousels.swipe({
                    click       : function(e, target){
                        $(target).trigger('click');
                    },
                    swipeLeft       : swipeCarousel,
                    swipeRight      : swipeCarousel,
                    allowPageScroll : 'auto'
                });
            }
        }

        initBasicCarousel(carousels, true);
        initTestimonialCarousel(testimonialCarousels);

        $(window).on('resize', function() {
            var timer = window.setTimeout( function() {
                window.clearTimeout(timer);
                resizeBasicCarousel(carousels);
            }, 30 );
        });

    }

});