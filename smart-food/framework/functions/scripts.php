<?php
/**
 * Functions for handling JavaScript in the framework.  Themes can add support for the 
 * 'tdp-core-scripts' feature to allow the framework to handle loading the stylesheets into 
 * the theme header or footer at an appropriate time.
 *
 * @package    ThemesDepotCore
 * @subpackage Functions
 * @author    Alessandro Tesoro
 * @copyright Copyright (c) 2014, Alessandro Tesoro
 * @link      https://themesdepot.org
 */


/**
 * Helper function for loading scripts and additional css files.
 *
 * @since  3.0.0
 */
function tdp_theme_load_scripts() {

	// Register Scripts
	wp_register_script( 'tdp-scripts', TDP_JS . 'scripts.js', array('jquery'), TDP_VERSION, true);
	wp_register_script( 'tdp-custom-scripts', TDP_JS . 'custom.js', array('jquery'), TDP_VERSION, true);
	wp_register_script( 'googlemap_api', 'https://maps.googleapis.com/maps/api/js?sensor=false');
	wp_register_script( 'googlemap',  TDP_JS . 'googlemap_utility.js', array('jquery'), TDP_VERSION, false );

	// Load Scripts
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'tdp-scripts' );
	wp_enqueue_script( 'tdp-custom-scripts' );
	wp_enqueue_script( 'googlemap_api' );
	wp_enqueue_script( 'googlemap' );

}
add_action('wp_enqueue_scripts','tdp_theme_load_scripts', 0);