<?php
/**
 * Load the Customizer with some custom extended addons
 *
 * @package BuildPress
 * @link http://codex.wordpress.org/Theme_Customization_API
 */

/**
 * This funtion is only called when the user is actually on the customizer page
 * @param  WP_Customize_Manager $wp_customize
 */
if ( ! function_exists( 'buildpress_customizer' ) ) {
	function buildpress_customizer( $wp_customize ) {
		// add required files
		load_template( get_template_directory() . '/inc/customizer/class-pt-customize-base.php' );
		load_template( get_template_directory() . '/inc/customizer/class-pt-customize-setting-dynamic-css.php' );

		new BuildPress_Customizer_Base( $wp_customize );
	}
	add_action( 'customize_register', 'buildpress_customizer' );
}


/**
 * Takes care for the frontend output from the customizer and nothing else
 */
if ( ! function_exists( 'buildpress_customizer_frontend' ) && ! class_exists( 'BuildPress_Customize_Frontent' ) ) {
	function buildpress_customizer_frontend() {
		load_template( get_template_directory() . '/inc/customizer/class-pt-customize-frontend.php' );
		new BuildPress_Customize_Frontent();
	}
	add_action( 'init', 'buildpress_customizer_frontend' );
}