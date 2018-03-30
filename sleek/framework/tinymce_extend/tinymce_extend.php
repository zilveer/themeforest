<?php

add_action('init', 'tinymce_extend');

function tinymce_extend() {
	if( get_user_option('rich_editing') == 'true' ) {
		add_filter( 'mce_external_plugins', 'sleek_mce_add_plugin' );
		add_filter( 'mce_buttons', 'sleek_mce_register_buttons' );
		add_filter( 'mce_buttons_2', 'sleek_mce_include_hidden_buttons' );
		add_filter( 'tiny_mce_before_init', 'sleek_mce_customization' );
	}
}



function sleek_mce_add_plugin( $plugin_array ) {
	$plugin_array['sleek_tinymce_extend'] =  THEME_FRAMEWORK_URI . '/tinymce_extend/tinymce_shortcodes.js';
	return $plugin_array;
}



if( !function_exists( 'sleek_mce_register_buttons' ) ){
function sleek_mce_register_buttons( $buttons ) {
	array_push( $buttons, "", "sleek_typography" );
	array_push( $buttons, "", "sleek_elements" );
	array_push( $buttons, "", "sleek_layout" );
	array_push( $buttons, "", "sleek_background" );
	array_push( $buttons, "", "sleek_icons" );
	return $buttons;
}
}




function sleek_mce_include_hidden_buttons($buttons) {
	// Add in a core button that's disabled by default
	$buttons[] = 'fontsizeselect';
	return $buttons;
}



// Customize mce editor font sizes
if( !function_exists( 'sleek_mce_customization' ) ){
function sleek_mce_customization( $initArray ){

	// Font Sizes
	$initArray['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 18px 20px 21px 22px 24px 28px 32px 36px 50px 70px 120px";

	$default_colours = '
	    "000000", "Blacadasdk",
	    "993300", "Burnt orange",
	    "333300", "Dark olive",
	    "003300", "Dark green",
	    "003366", "Dark azure",
	    "000080", "Navy Blue",
	    "333399", "Indigo",
	    "333333", "Very dark gray",
	    "800000", "Maroon",
	    "FF6600", "Orange",
	    "808000", "Olive",
	    "008000", "Green",
	    "008080", "Teal",
	    "0000FF", "Blue",
	    "666699", "Grayish blue",
	    "808080", "Gray",
	    "FF0000", "Red",
	    "FF9900", "Amber",
	    "99CC00", "Yellow green",
	    "339966", "Sea green",
	    "33CCCC", "Turquoise",
	    "3366FF", "Royal blue",
	    "800080", "Purple",
	    "999999", "Medium gray",
	    "FF00FF", "Magenta",
	    "FFCC00", "Gold",
	    "FFFF00", "Yellow",
	    "00FF00", "Lime",
	    "00FFFF", "Aqua",
	    "00CCFF", "Sky blue",
	    "993366", "Brown",
	    "C0C0C0", "Silver",
	    "FF99CC", "Pink",
	    "FFCC99", "Peach",
	    "FFFF99", "Light yellow",
	    "CCFFCC", "Pale green",
	    "CCFFFF", "Pale cyan",
	    "99CCFF", "Light sky blue",
	    "CC99FF", "Plum",
	    "FFFFFF", "White"
    ';

    $theme_settings = sleek_theme_settings();
	$custom_colours = '
		"'.substr( $theme_settings->style['color']['color_primary'], 1) .'", "Custom Primary Color",
		"'.substr( $theme_settings->style['color']['color_white'], 1) .'", "Custom White",
		"'.substr( $theme_settings->style['color']['color_grey_pale'], 1) .'", "Custom Grey Pale",
		"'.substr( $theme_settings->style['color']['color_grey_light'], 1) .'", "Custom Grey Light",
		"'.substr( $theme_settings->style['color']['color_grey'], 1) .'", "Custom Grey",
		"'.substr( $theme_settings->style['color']['color_black'], 1) .'", "Custom Black",
	';

	$initArray['textcolor_map'] = '['.$default_colours.','.$custom_colours.']';
	$initArray['textcolor_rows'] = 6;


	return $initArray;
}
}
