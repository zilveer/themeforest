<?php
/**
 * Functions used to implement options
 *
 * @package Customizer Library
 */

/**
 * Enqueue Google Fonts Example
 */
function heartfelt_customizer_google_fonts() {

	// Font options
	$fonts = array(
		get_theme_mod( 'header-font', customizer_library_get_default( 'header-font' ) ),
		get_theme_mod( 'paragraph-font', customizer_library_get_default( 'paragraph-font' ) )
	);

	$font_uri = customizer_library_get_google_font_uri( $fonts );

	// Load Google Fonts
	wp_enqueue_style( 'heartfelt-google-fonts', $font_uri, array(), null, 'screen' );

}
add_action( 'wp_enqueue_scripts', 'heartfelt_customizer_google_fonts' );

/**
 * Custom Customizer Style
 */
function heartfelt_customizer_style() {

	wp_enqueue_style( 'heartfelt-customizer-style', get_template_directory_uri() . '/customizer/style.css', array(), '', 'all' );
}
add_action( 'customize_controls_enqueue_scripts', 'heartfelt_customizer_style' );
