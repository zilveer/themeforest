<?php

/* ==========================================================================
	Get default accent color
============================================================================= */

if( ! function_exists( 'shiroi_default_accent_color' ) ):

function shiroi_default_accent_color() {
	return apply_filters( 'shiroi_default_accent_color', '#a57a50' );
}
endif;


/* ==========================================================================
	Color Scheme Functions
============================================================================= */

if( ! function_exists( 'shiroi_custom_color_scheme' ) ):

function shiroi_custom_color_scheme() {

	static $color_scheme = null;
	if( ! is_null( $color_scheme ) ) {
		return $color_scheme;
	}

	$all_options = Youxi()->option->get_all();

	$color_keys = shiroi_custom_color_keys();
	$color_keys = array_flip( $color_keys );
	$color_defaults = array_intersect_key( Youxi()->option->defaults(), $color_keys );

	$parsed = array_intersect_key( $all_options, $color_keys );
	$parsed = wp_parse_args( $parsed, $color_defaults );

	$color_scheme = array();
	foreach( $parsed as $key => $val ) {
		$color_scheme[ str_replace( '_', '-', $key ) ] = $val;
	}

	return $color_scheme;
}
endif;

if( ! function_exists( 'shiroi_predefined_color_schemes' ) ):

function shiroi_predefined_color_schemes() {

	return apply_filters( 'shiroi_predefined_color_schemes', array(
		'dark' => array(
			'body-bg' => '#444', 
			'text-color' => '#bababa', 
			'headings-color' => '#fff', 
			'base-border-color' => '#434343', 
			'dotted-border-color' => '#4d4d4d', 
			'base-box-bg' => '#383838', 
			'header-bg' => '#383838', 
			'menu-link-color' => '#bababa', 
			'menu-link-hover-color' => '#fff', 
			'footer-bg' => '#383838', 
			'footer-text-color' => '#ccc', 
			'footer-link-color' => '#fff', 
			'footer-link-hover-color' => '#fff', 
			'footer-bottom-bg' => '#2f2f2f', 
			'widget-box-bg' => '#383838', 
			'widget-title-color' => '#fff', 
			'widget-title-border-color' => '#4d4d4d', 
			'widget-border-color' => '#434343', 
			'widget-footer-title-color' => '#fff', 
			'widget-footer-title-border-color' => '#4d4d4d', 
			'widget-footer-border-color' => '#434343'
		)
	));
}
endif;

if( ! function_exists( 'shiroi_custom_color_keys' ) ):
	
function shiroi_custom_color_keys() {
	return array(
		'body_bg', 
		'text_color', 
		'headings_color', 
		'base_border_color', 
		'dotted_border_color', 
		'base_box_bg', 
		'header_top_bg', 
		'header_top_text_color', 
		'header_top_link_hover_color', 
		'header_bg', 
		'menu_link_color', 
		'menu_link_hover_color', 
		'menu_submenu_bg', 
		'menu_submenu_link_color', 
		'menu_submenu_link_hover_color', 
		'footer_bg', 
		'footer_text_color', 
		'footer_link_color', 
		'footer_link_hover_color', 
		'footer_bottom_bg', 
		'widget_box_bg', 
		'widget_title_color', 
		'widget_title_border_color', 
		'widget_border_color', 
		'widget_footer_title_color', 
		'widget_footer_title_border_color', 
		'widget_footer_border_color'
	);
}
endif;

if( ! function_exists( 'shiroi_get_color_scheme' ) ):

function shiroi_get_color_scheme( $color_scheme ) {
	$color_schemes = shiroi_predefined_color_schemes();
	return isset( $color_schemes[ $color_scheme ] ) ? $color_schemes[ $color_scheme ] : false;
}
endif;