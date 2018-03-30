/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
			}
		} );
	} );

	// General
	wp.customize( 'mainbackground', function( value ) {
		value.bind( function( to ) {
			$( 'container' ).css( { 'background' : to } );
		} );
	} );

	wp.customize( 'headerbackground', function( value ) {
		value.bind( function( to ) {
			$( '#head .container' ).css( { 'background' : to } );
		} );
	} );

	wp.customize( 'maintext', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( { 'color' : to } );
		} );
	} );

	wp.customize( 'mainlink', function( value ) {
		value.bind( function( to ) {
			$( 'a' ).css( { 'color' : to } );
		} );
	} );

	wp.customize( 'mainhover', function( value ) {
		value.bind( function( to ) {
			$( 'a:hover' ).css( { 'color' : to } );
		} );
	} );

	// Footer
	wp.customize( 'footerbackground', function( value ) {
		value.bind( function( to ) {
			$( 'footer#bottom, footer#bottom .container' ).css( { 'background' : to } );
		} );
	} );
	wp.customize( 'footer_text', function( value ) {
		value.bind( function( to ) {
			$( 'footer#bottom' ).css( { 'color' : to } );
		} );
	} );
	wp.customize( 'footerlink', function( value ) {
		value.bind( function( to ) {
			$( 'footer#bottom a' ).css( { 'color' : to } );
		} );
	} );

} )( jQuery );
