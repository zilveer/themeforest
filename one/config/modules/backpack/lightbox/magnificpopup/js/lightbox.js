(function($) {
	"use strict";

	window.THB_MagnificPopup = function( options ) {

		var self = this;

		/**
		 * Lightbox handler.
		 */
		var lightbox = new THB_Lightbox();

		/**
		 * Library handler.
		 *
		 * @type {string}
		 */
		var handler = "magnificPopup";

		/**
		 * Filter options.
		 *
		 * @type {Object}
		 */
		var options = $.extend( {
			image: {
				titleSrc: function( item ) {
					var caption = '';

					if ( item.el && typeof item.el !== 'undefined' ) {
						if ( item.el.next('.wp-caption-text').length ) {
							caption = item.el.next('.wp-caption-text').text();
						}
						else if ( typeof item.el.attr("title") !== "undefined" && item.el.attr("title") != "" ) {
							caption = item.el.attr("title");
						}
					}

					return caption;
				}
			},
			removalDelay: 200,
			mainClass: 'thb-mfp-skin'
		}, options );

		/**
		 * Galleries filter options.
		 *
		 * @type {Object}
		 */
		var galleriesOptions = $.extend( {
			delegate: 'a[href*=".jpg"]:not(.nothumb), a[href*=".png"]:not(.nothumb), a[href*=".gif"]:not(.nothumb), a[href*=".jpeg"]:not(.nothumb), a.mfp-iframe:not(.nothumb)',
			type: 'image',
			gallery:{
				enabled:true
			},
			callbacks: {
				open: function() {
					var isMobile = $( "body" ).hasClass( "thb-mobile" );

					if ( isMobile ) {
						var supportsFastClick = Boolean( $.fn.mfpFastClick ),
							evt = supportsFastClick ? "mfpFastClick" : "click",
							mfp = this;

						$( ".mfp-arrow" ).off( "click" );
						$( ".mfp-arrow" ).off( "mfpFastClick" );

						$( ".mfp-arrow-left" ).on( evt, function() {
							mfp.prev();
							return false;
						} );
						$( ".mfp-arrow-right" ).on( evt, function() {
							mfp.next();
							return false;
						} );
					}
				}
			}
		}, options );

		/**
		 * Initialize the lightbox component.
		 */
		this.init = function( target, gallery ) {
			lightbox.init( target );

			if ( gallery === undefined ) {
				this.bindImages( lightbox["images"] );
				this.bindGalleries( lightbox["galleries"] );
			}
			else {
				if ( gallery == true ) {
					this.bindGallery( target, {
						delegate: null
					} );
				}
				else {
					this.bindImages( target );
				}
			}
		};

		/**
		 * Bind the lightbox event of the selected images.
		 *
		 * @param {jQuery} target
		 */
		this.bindImages = function( target, opts ) {
			if ( target[handler] ) {
				target[handler]( $.extend( {}, options, opts ) );
			}
		};

		/**
		 * Bind the lightbox event of the selected galleries.
		 *
		 * @param {jQuery} target
		 */
		this.bindGalleries = function( target, opts ) {
			target.each( function() {
				self.bindGallery( $(this), opts );
			} );
		};

		/**
		 * Bind the lightbox event of the selected gallery images.
		 *
		 * @param {jQuery} target
		 */
		this.bindGallery = function( target, opts ) {
			if ( target[handler] ) {
				target[handler]( $.extend( {}, galleriesOptions, opts ) );
			}
		};

	};

	$(document).ready(function() {
		if ( $( "body" ).hasClass( "thb-lightbox-enabled" ) ) {
			window.thb_lightbox_handler = new THB_MagnificPopup( { type: 'image' } );
			window.thb_lightbox_handler.init();
		}
	});
})(jQuery);