/* global define, Modernizr */
define( [ 'jquery', 'underscore', 'bootstrapCarousel' ], function ( $, _ ) {
	'use strict';

	/**
	 * SLIDER_SETTINGS constant object
	 * @type Object
	 */
	var SLIDER_SETTINGS = {
		selector: '.js-jumbotron-slider',
		interval: $( '.js-jumbotron-slider' ).data( 'interval' ),
	};

	/**
	 * Prevents the jumping of the content on the front page because of the slider - different amount of the content
	 */
	var checkMinHeight = function () {
		if ( Modernizr.mq( '(min-width: 992px)' ) ) {
			$( SLIDER_SETTINGS.selector ).removeAttr( 'style' );
			return;
		}

		var currentHeight = $( SLIDER_SETTINGS.selector ).outerHeight(),
			maxHeight = $( SLIDER_SETTINGS.selector ).css( 'min-height' );

		if ( ! _( maxHeight ).isNumber() || currentHeight > maxHeight ) {
			$( SLIDER_SETTINGS.selector ).css( 'min-height', currentHeight );
		}
	};

	// call the BS slider
	var slider = $( SLIDER_SETTINGS.selector ).carousel( {
		interval: SLIDER_SETTINGS.interval,
	} );

	/**
	 * Change the text on the slide change and fix the center of the slider and height of container
	 */
	slider.on( 'slid.bs.carousel', checkMinHeight );


	/**
	 * Recalculate layout if the viewport is resized
	 */
	$( window ).on( 'resize', _.debounce( function() {
		$( SLIDER_SETTINGS.selector ).css( 'min-height', 0 );
		checkMinHeight();
	}, 300 ) );
} );