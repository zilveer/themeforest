jQuery(document).ready( function($){

    $('.carousel[id^="properties-carousel-v2-"]').each(function(){
        var $div = jQuery(this);
        var token = $div.data('token');
        var obj = window['prop_carousel_v2_' + token];

        var slidesToShow = parseInt(obj.slides_to_show),
            slidesToScroll = parseInt(obj.slides_to_scroll),
            autoplay = parseBool(obj.slide_auto),
            autoplaySpeed = parseInt(obj.auto_speed),
            slide_infinite = parseBool(obj.slide_infinite),
            dots = parseBool( obj.slide_dots );

        var houzez_rtl = HOUZEZ_ajaxcalls_vars.houzez_rtl;

        if( houzez_rtl == 'yes' ) {
            houzez_rtl = true;
        } else {
            houzez_rtl = false;
        }

        function parseBool(str) {
            if( str == 'true' ) { return true; } else { return false; }
        }

        var faveOwl = $('#properties-carousel-v2-'+token);

        faveOwl.owlCarousel({
            rtl: houzez_rtl,
            loop: slide_infinite,
            autoplay: autoplay,
            autoplaySpeed: autoplaySpeed,
            dots: dots,
            smartSpeed: 700,
            slideBy: slidesToScroll,
            nav:false,
            responsive:{
                0: {
                    items: 1
                },
                320: {
                    items: 1
                },
                480: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });    


        $('.btn-prev-'+token).on('click',function(){
                faveOwl.trigger('prev.owl.carousel',[1000])
        })
        $('.btn-next-'+token).on('click',function(){
            faveOwl.trigger('next.owl.carousel')
        })

    });

});