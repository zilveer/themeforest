<?php
/**
 * Theme Scripts and Styles
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

if ( !function_exists( 'sd_jquery_scripts' ) ) {
	function sd_jquery_scripts() {
		/* ------------------------------------------------------------------------ */
		/* Register jQuery Scripts */
		/* ------------------------------------------------------------------------ */
		wp_register_script( 'sd-pretty-photo', SD_FRAMEWORK_JS . 'prettyphoto.js', array( 'jquery' ), '', true );
		wp_register_script( 'sd-isotope', SD_FRAMEWORK_JS . 'isotope.js', array( 'jquery' ), '', true );
		wp_register_script( 'flexslider', SD_FRAMEWORK_JS . 'flexslider.js', array( 'jquery' ), '', true );
		wp_register_script( 'sd-custom', SD_FRAMEWORK_JS . 'custom.js', array( 'jquery' ), '', true );
		wp_register_script( 'sd-easing', SD_FRAMEWORK_JS . 'easing.js', array( 'jquery' ), '', true );
		wp_register_script( 'sd-tabs', SD_FRAMEWORK_JS . 'sd-tabs.js', array( 'jquery' ), '', true );
		//wp_register_script( 'sd-gmap', 'http://maps.google.com/maps/api/js?sensor=false', false, '', false );

		/* ------------------------------------------------------------------------ */
		/* Enqueue Scripts */
		/* ------------------------------------------------------------------------ */
		wp_enqueue_script( 'sd-pretty-photo' );
		wp_enqueue_script( 'flexslider' );
		//wp_enqueue_script( 'sd-gmap' );
		wp_enqueue_script( 'sd-custom' );
		if ( is_page_template( 'campaigns.php' ) ) {
			wp_enqueue_script( 'sd-isotope' );
			wp_enqueue_script( 'sd-easing' );
		}
		wp_localize_script( 'sd-custom', 'afp_vars', array(
			'afp_nonce' => wp_create_nonce( 'afp_nonce' ),
			'afp_ajax_url' => admin_url( 'admin-ajax.php' ),
			)
		);
		wp_localize_script( 'sd-custom', 'sd_add_again_var', array(
				'text' => __( 'ADD AGAIN?', 'sd-framework' )
			)
		);
		
		if ( is_singular( 'events' ) ) {
			wp_enqueue_script( 'googleapis' );
		}
		
	}

	add_action( 'wp_enqueue_scripts', 'sd_jquery_scripts' );
}

if ( !function_exists( 'sd_css_styles' ) ) {
	function sd_css_styles() {
	
		/* ------------------------------------------------------------------------ */
		/* Register Stylesheets */
		/* ------------------------------------------------------------------------ */
		
		wp_register_style( 'sd-bootstrap', SD_FRAMEWORK_CSS . 'bootstrap.css', 'style' );
		wp_register_style( 'sd-font-awesome', SD_FRAMEWORK_CSS . 'font-awesome.css', 'style' );
		wp_register_style( 'sd-prettyphoto', SD_FRAMEWORK_CSS . 'prettyPhoto.css', 'style' );
		if ( is_multisite() ) {
			wp_register_style( 'sd-custom-css-' . get_current_blog_id() , get_template_directory_uri() . '/framework/admin/sd-admin-options/custom-styles-' . get_current_blog_id() . '.css', 'style' );
		} else {
			wp_register_style( 'sd-custom-css', get_template_directory_uri() . '/framework/admin/sd-admin-options/custom-styles.css', 'style' );
		}
	
		
		/* ------------------------------------------------------------------------ */
		/* Enqueue Styles */
		/* ------------------------------------------------------------------------ */
		wp_enqueue_style( 'sd-bootstrap', '2' );	
		wp_enqueue_style( 'stylesheet', get_stylesheet_uri(), array(), '3', 'all' ); // Main Stylesheet
		if ( is_multisite() ) {
			wp_enqueue_style( 'sd-custom-css-' . get_current_blog_id(), '4', 'all' );
		} else {
			wp_enqueue_style( 'sd-custom-css', '4', 'all' );
		}
		wp_enqueue_style( 'sd-font-awesome' );
		wp_enqueue_style( 'flexslider' );
		wp_enqueue_style( 'sd-prettyphoto' );
	}
	add_action( 'wp_enqueue_scripts', 'sd_css_styles', 15 );
}
?>