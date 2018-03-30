/*!
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 * Things like site title, description, and background color changes.
 */

 var console = console || {};

;( function( $ ) {

	'use strict';

	/**
	 * Background
	 */
	var backgrounds = {
		'body_bg' : 'body',
		'site_footer_bg' : '.site-footer'
	},

	options = [ 'repeat', 'position', 'attachment' ];

	$.each( backgrounds, function( key, bg ) {

		$.each( options, function( k, o ) {

			wp.customize( key + '_' + o, function( value ) {

				value.bind( function( to ) {

					var prop = 'background-' + o;
					$( bg ).css( prop , to );

				} );
			} );
		} );

		/* Size
		---------------*/
		wp.customize( key + '_size', function( value ) {

			value.bind( function( to ) {

				if ( to === 'cover' ) {
					$( bg ).css( {
						'background-size' : 'cover',
						'-webkit-background-size' : 'cover',
						'-moz-background-size' : 'cover',
						'-o-background-size' : 'cover'
					} );

				} else if ( to === 'resize' ) {

					$( bg ).css( {
						'background-size' : '100% auto',
						'-webkit-background-size' : '100% auto',
						'-moz-background-size' : '100% auto',
						'-o-background-size' : '100% auto'
					} );

				} else if ( to === 'normal' ) {

					$( bg ).css( {
						'background-size' : 'auto',
						'-webkit-background-size' : 'auto',
						'-moz-background-size' : 'auto',
						'-o-background-size' : 'auto'
					} );
				}
			} );
		} );
	} ); // end for each background

	// --------------------------------------------------------------------------

	wp.customize( 'layout', function( value ) {
		value.bind( function( to ) {
			//console.log( to );
			$( 'body' ).removeClass( 'boxed-layout wide-layout' );
			$( 'body' ).addClass( to );
		} );
	} );

} )( jQuery );