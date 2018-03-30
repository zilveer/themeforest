/*-----------------------------------------------------------------------------------*/
/*	Colorpicker
/*-----------------------------------------------------------------------------------*/

var WolfThemeAdminParams =  WolfThemeAdminParams || {};

;( function( $ ) {

	'use strict';

	var colorpickerOptions = {
		
		palettes: WolfThemeAdminParams.defaultPalette
	};

	if ( {} !== WolfThemeAdminParams && WolfThemeAdminParams.defaultPalette ) {
		$( '.wolf-options-colorpicker' ).wpColorPicker( colorpickerOptions );
	} else {
		$( '.wolf-options-colorpicker' ).wpColorPicker();
	}

} )( jQuery );