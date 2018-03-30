(function($) {
	
    $( document ).ready(function() {
	
		// SELECT
	
		$( 'select' ).fancySelect();

		//
		
		var slider_count = $( '.topSlide' ).attr( 'data-count' );
		if ( slider_count > 3 ) {
			window.bt_slick_sl = 4;
			window.bt_slick_s2 = 3;
			window.bt_slick_s3 = 2;
			window.bt_slick_s4 = 1;
		} else if ( slider_count == 3 ) {
			window.bt_slick_sl = 3;
			window.bt_slick_s2 = 3;
			window.bt_slick_s3 = 2;
			window.bt_slick_s4 = 1;
		} else if ( slider_count == 2 ) {
			window.bt_slick_sl = 2;
			window.bt_slick_s2 = 2;
			window.bt_slick_s3 = 2;
			window.bt_slick_s4 = 1;
		} else if ( slider_count == 1 ) {
			window.bt_slick_sl = 1;
			window.bt_slick_s2 = 1;
			window.bt_slick_s3 = 1;
			window.bt_slick_s4 = 1;
		}

		$( '.topSlide' ).css('visibility','hidden');
        $( '.topSlidePort' ).slick({
            arrows: false,
            infinite: true,
            dots: true,
            slide: 'div.tsItem',
            slidesToShow: window.bt_slick_sl,
            slidesToScroll: window.bt_slick_sl,
            responsive: [
                {
                    breakpoint: 1280,
                    settings: {
                        slidesToShow: window.bt_slick_s2,
                        slidesToScroll: window.bt_slick_s2
                    }
                },			
                {
                    breakpoint: 820,
                    settings: {
                        slidesToShow: window.bt_slick_s3,
                        slidesToScroll: window.bt_slick_s3
                    }
                },
                {
                    breakpoint: 580,
                    settings: {
                        slidesToShow: window.bt_slick_s4,
                        slidesToScroll: window.bt_slick_s4
                    }
                }
            ]
        });

        $( '.sbPort' ).slick({
            arrows: true,
            infinite: true,
            dots: false,
            slidesToShow: 1,
            slidesToScroll: 1
        });
		
		$( '.slideBox' ).each(function() { 
			$( this ).find( '.slick-slide' ).not( '.slick-cloned' ).find( 'a' ).magnificPopup({
				type: 'image',
				// other options
				gallery:{
					enabled:true
				},
				closeMarkup:'<button class="mfp-close" type="button" title="%title%"></button>',
				closeBtnInside:false
			});
		});
		
		$( '.gallGrid' ).each(function() { 
			$( this ).find( 'a' ).magnificPopup({
				type: 'image',
				// other options
				gallery:{
					enabled:true
				},
				closeMarkup:'<button class="mfp-close" type="button" title="%title%"></button>',
				closeBtnInside:false
			});	
		});

    });

    $( window ).load(function() {
        Modernizr.load([
            //first test need for polyfill
            {
                test: window.matchMedia,
                nope: window.BTURI + "/js/media.match.min.js"
            },

            //and then load enquire
            window.BTURI + "/js/enquire.min.js",
            window.BTURI + "/js/enquire.mics.js"
        ]);
		$( '.topSlide' ).css('visibility','visible');
    });	
	
})( jQuery );