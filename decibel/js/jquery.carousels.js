/* jshint -W062 */
var WolfThemeParams =  WolfThemeParams || {},
	WolfThemeCarousels = WolfThemeCarousels || {},
	WolfThemeUi = WolfThemeUi || {},
	Modernizr = Modernizr || {},
	WolfThemeLikesViews =  WolfThemeLikesViews || {},
	console = console || {};

WolfThemeCarousels = function( $ ) {

	'use strict';

	return {

		init : function () {

			this.owlCarousel();
			$( window ).trigger( 'resize' ); // trigger resize event to force all window size related calculation
			$( window ).trigger( 'scroll' ); // trigger scroll event to force all window scroll related calculation
		},

		/**
		 * owlCarousel
		 */
		owlCarousel : function () {

			/* Portrait Carousel */
			$( '.vertical-carousel' ).owlCarousel( {
				dots : false,
				loop : true,
				margin : 0,
				nav : true,
				autoplay : false,
				autoplayTimeout : 4000,
				autoplayHoverPause : true,
				responsive : {
					0 : {
						items : 1
					},
					600 : {
						items : 3
					},
					1000 : {
						items : 5
					}
				}
			} );

			/* Last posts shortcode carousel */
			$( '.last-posts-carousel' ).owlCarousel( {
				dots : false,
				loop : true,
				margin : 0,
				nav : true,
				autoplay : false,
				autoplayTimeout : 4000,
				autoplayHoverPause : true,
				responsive : {
					0 : {
						items : 1
					},
					800 : {
						items : 3
					}
				},
				onRefreshed : function() {
					WolfThemeLikesViews.likes();
				}
			} );

			/* mosaic gallery carousel (no used) */
			$( '.carousel-mosaic-gallery' ).owlCarousel( {
				dots : false,
				loop : true,
				margin : 0,
				nav : true,
				autoplay : false,
				autoplayTimeout : 4000,
				autoplayHoverPause : true,
				responsive : {
					0 : {
						items : 1
					},
					800 : {
						items : 2
					}
				},
				onRefreshed : function() {
					WolfThemeUi.lightbox();
				}
			} );

			/* Carousel gallery */
			$( '.carousel-simple-gallery' ).owlCarousel( {
				dots : false,
				loop : true,
				margin : 0,
				nav : true,
				autoplay : false,
				autoplayTimeout : 4000,
				autoplayHoverPause : true,
				responsive : {
					0 : {
						items : 1
					},
					600 : {
						items : 3
					},
					1000 : {
						items : 5
					}
				},
				onRefreshed : function() {
					WolfThemeUi.lightbox();
				}
			} );

			/* last works shortcode carousel */
			$( '.works-carousel' ).owlCarousel( {
				dots : false,
				loop : true,
				margin : 0,
				nav : true,
				autoplay : false,
				autoplayTimeout : 4000,
				autoplayHoverPause : true,
				responsive : {
					0 : {
						items : 2
					},
					1000 : {
						items : 4
					}
				}
			} );

			/* last releases shortcode carousel */
			$( '.releases-carousel' ).owlCarousel( {
				dots : false,
				loop : true,
				margin : 0,
				nav : true,
				autoplay : false,
				autoplayTimeout : 4000,
				autoplayHoverPause : true,
				responsive : {
					0 : {
						items : 2
					},
					1000 : {
						items : 4
					}
				}
			} );

			/* Client carousel shortcode */
			$( '.clients-carousel' ).owlCarousel( {
				dots : false,
				loop : true,
				margin : 0,
				nav : true,
				autoplay : false,
				autoplayTimeout : 4000,
				autoplayHoverPause : true,
				responsive : {
					0 : {
						items : 1
					},
					500 : {
						items : 3
					},
					800 : {
						items : 4
					}
				}
			} );

			/* Last Videos carousel shortcode */
			$( '.videos-carousel' ).owlCarousel( {
				dots : true,
				items: 1,
				merge: true,
				loop: true,
				margin: 10,
				video: true,
				center: true,
				responsive:{
					480:{
						items:2
					},
					600:{
						items:4
					}
				}
			} );

			var defaultTransition = ( Modernizr.isTouch ) ? 'slide' : 'fade';

			$( '.testimonials-slider' ).each( function () {
				var $slider = $( this ),
					transition,
					dataAutoplay = $slider.data( 'autoplay' ),
					dataSpeed = $slider.data( 'slideshow-speed' ),
					dataPauseonHover = $slider.data( 'pause-on-hover' ),
					dataTransition = $slider.data( 'transition' ),
					dataNavbullets = $slider.data( 'nav-bullets' ),
					dataArrows = $slider.data( 'nav-arrows' );

				transition = ( 'auto' === dataTransition ) ? defaultTransition : dataTransition;

				$slider.owlCarousel( {
					mouseDrag : false,
					loop : true,
					items : 1,
					autoplay : dataAutoplay,
					autoplayTimeout: dataSpeed,
					autoplayHoverPause : dataPauseonHover,
					nav : dataArrows,
					dots : dataNavbullets
				} );
			} );
		}
	};

}( jQuery );

;( function( $ ) {

	'use strict';

	$( window ).load( function() {
		WolfThemeCarousels.init();
	} );

} )( jQuery );
