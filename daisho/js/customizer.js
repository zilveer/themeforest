/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 * Things like site title and description changes.
 * It's temporarily disabled.
 */

( function( $ ) {

	'use strict';
	
	var $styleTagColorScheme = $( '#flow-color-scheme-css' );
	var $styleTagCustomCSS = $( '#flow-custom-css' );
	var $styleTagCustomBackground = $( '#flow-custom-background-css' );

	if ( ! $styleTagColorScheme.length ) {
		$styleTagColorScheme = $( 'head' ).append( '<style type="text/css" id="flow-color-scheme-css" />' ).find( '#flow-color-scheme-css' );
	}

	if ( ! $styleTagCustomCSS.length ) {
		$styleTagCustomCSS = $( 'head' ).append( '<style type="text/css" id="flow-custom-css" />' ).find( '#flow-custom-css' );
	}

	if ( ! $styleTagCustomBackground.length ) {
		$styleTagCustomBackground = $( 'head' ).append( '<style type="text/css" id="flow-custom-background-css" />' ).find( '#flow-custom-background-css' );
	}

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title' ).text( to );
		} );
	} );

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	wp.customize( 'custom_css_style', function( value ) {
		value.bind( function( to ) {
			$styleTagCustomCSS.text( to );
		} );
	} );

	wp.customize( 'flow_background_size', function( value ) {
		value.bind( function( to ) {
			$styleTagCustomBackground.text( 'body { background-size: ' + to + ';' );
		} );
	} );

	// Color Scheme CSS.
	wp.customize.bind( 'preview-ready', function() {
		wp.customize.preview.bind( 'update-color-scheme-css', function( css ) {
			$styleTagColorScheme.html( css );
		} );
	} );

} )( jQuery );
