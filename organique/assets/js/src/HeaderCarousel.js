/* global define, enquire */
define( [ 'jquery', 'underscore', 'enquire', 'bootstrapCarousel' ], function ( $, _ ) {
	'use strict';

	/**
	 * Set the 'left' css prop to the right value that the central part of the slider is shown
	 */
	var centerSliderImg = function () {
		var headerWidth = $( '.carousel--fixed-height' ).outerWidth();

		$('.carousel--fixed-height .item > img')
			.css( 'margin-left', parseInt( -0.5*( 1920 - headerWidth ) ) );
	};

	if ( $( '.carousel--fixed-height' ).length ) {
		enquire.register('screen and (max-width: 1920px)', {
			match: function() {
				centerSliderImg();
				$( window ).on( 'resize.headerCarousel', _.debounce( centerSliderImg, 300 ) );
			},
			unmatch: function () {
				$( window ).off( 'resize.headerCarousel' );
				setTimeout( function () {
					$('.carousel--fixed-height .item > img').removeAttr( 'style' );
				}, 301 );
			}
		});
	}
} );
