jQuery(document).ready( function($){

    $('.carousel[id^="properties-carousel-v1-"]').each(function(){
        var $div = jQuery(this);
        var token = $div.data('token');
        var obj = window['prop_carousel_' + token];

        var slidesToShow = parseInt(obj.slides_to_show),
            slidesToScroll = parseInt(obj.slides_to_scroll),
            autoplay = parseBool(obj.slide_auto),
            autoplaySpeed = parseInt(obj.auto_speed),
            dots = parseBool( obj.slide_dots),
            slide_infinite =  parseBool( obj.slide_infinite );

        var houzez_rtl = HOUZEZ_ajaxcalls_vars.houzez_rtl;

        if( houzez_rtl == 'yes' ) {
            houzez_rtl = true;
        } else {
            houzez_rtl = false;
        }

        var faveOwl = $('#properties-carousel-v1-'+token);
           
            function parseBool(str) {
                if( str == 'true' ) { return true; } else { return false; }
            }

            if( slidesToShow == 1 ) {

                faveOwl.owlCarousel({
                    rtl: houzez_rtl,
                    items: slidesToShow,
                    loop: slide_infinite,
                    autoplay: autoplay,
                    autoplaySpeed: autoplaySpeed,
                    dots: dots,
                    smartSpeed: 700,
                    slideBy: slidesToScroll,
                    nav:false
                });

            } else if ( slidesToShow == 2 ) {

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
                            items: 2
                        },
                        768: {
                            items: 2
                        },
                        1000: {
                            items: slidesToShow
                        }
                    }
                });

            } else if ( slidesToShow == 3 || slidesToShow == 4  || slidesToShow == 5 || slidesToShow == 6 ) {

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
                            items: 2
                        },
                        768: {
                            items: 3
                        },
                        1000: {
                            items: slidesToShow
                        }
                    }
                });
                
            }
            

            $('.btn-prev-'+token).on('click',function(){
                faveOwl.trigger('prev.owl.carousel',[1000])
            })
            $('.btn-next-'+token).on('click',function(){
                faveOwl.trigger('next.owl.carousel')
            })
    });

});