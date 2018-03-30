<?php
/**
 * Functions for handling stylesheets in the framework.  Themes can add support for the 
 * 'tdp-core-styles' feature to allow the framework to handle loading the stylesheets into the 
 * theme header at an appropriate point.
 *
 * @package    ThemesDepotCore
 * @subpackage Functions
 * @author    Alessandro Tesoro
 * @copyright Copyright (c) 2014, Alessandro Tesoro
 * @link      https://themesdepot.org
 */


/**
 * Helper function for getting the google fonts.
 *
 * @since  3.0.0
 */
function tdp_theme_google_fonts() {

	if(tdp_option('google_fonts')) :

		// Register Fonts
		wp_register_style('tdp-main-font', ( is_ssl() ? 'https' : 'http' ) .'://'.tdp_option('main_google_font') );
	    wp_register_style('tdp-headings-font', ( is_ssl() ? 'https' : 'http' ) .'://'.tdp_option('headings_google_font') );
	    // Load Fonts
	    wp_enqueue_style( 'tdp-main-font' );
	    wp_enqueue_style( 'tdp-headings-font' );

	    $font_data = "body, #overlay-content h1, #subheader-static h1, h3.subheader, .block-with-image .container h3 {font-family: '".tdp_option('main_google_font_name')."', Helvetica Neue, Helvetica, Arial, sans-serif !important;}";
	    $font_data .= "h1, h2, h3, h4, h5, h6, header nav, .widget input, #footer-nav ul li, .widget-a-button, textarea, .comment-form-row input, #submit, .social-bar, .btn-ghost, .paragraph-highlight, #header-dropin, .tdp-tabs ul.ui-tabs-nav li a, .caption a.button, #mobile-nav, #static-image-section .title-1, #static-image-section .title-4 {font-family: '".tdp_option('headings_google_font_name')."', Helvetica Neue, Helvetica, Arial, sans-serif !important;}";
	    wp_add_inline_style( 'main', $font_data );

    endif;

}
add_action('wp_enqueue_scripts','tdp_theme_google_fonts');

/**
 * Helper function for loading scripts and additional css files.
 *
 * @since  3.0.0
 */
function tdp_theme_load_styles() {

	// Register Styles
	wp_register_style( 'main', get_stylesheet_uri());
	wp_register_style( 'tdp-font-awesome', TDP_CSS . 'font-awesome.min.css'); 

	wp_enqueue_style( 'main' );
	wp_enqueue_style( 'tdp-font-awesome' );

}
add_action('wp_enqueue_scripts','tdp_theme_load_styles', 0);