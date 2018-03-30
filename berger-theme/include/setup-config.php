<?php
/**
 * Created by Clapat.
 * Date: 29/05/14
 * Time: 6:21 AM
 */

if ( ! function_exists( 'clapat_theme_setup' ) ){

    function clapat_theme_setup() {

        // Set content width
        if ( ! isset( $content_width ) ) $content_width = 1180;

        // Allow shortcodes in widget text
        //add_filter('widget_text', 'do_shortcode');

        // add support for multiple languages
        load_theme_textdomain( THEME_LANGUAGE_DOMAIN, get_template_directory() . '/languages' );
	
	}

} // clapat_theme_setup

/**
 * Tell WordPress to run clapat_theme_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'clapat_theme_setup' );