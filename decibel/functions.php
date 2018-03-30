<?php
/**
 * The functions file required by Wordpress
 *
 */

// add_filter('show_admin_bar', '__return_false'); // hide admin bar for style debug
// define( 'WOLF_DEBUG', true );

/**
 * Set up the content width value based on the theme's design.
 */
if ( ! isset( $content_width ) )
	$content_width = 740;

/**
 *  Require the framework core file to do the magic
 */
require_once get_template_directory() . '/wp-wolf-framework/wolf-core.php';

/**
 * We use the Wolf_Theme class to set the theme settings in an array (wp-wolf-framework/wolf-core.php).
 */
$wolf_theme = array(

	/* Menus (id => name) */
	'menus' => array(
		'primary' => __( 'Main Menu', 'wolf' ),
		'primary-left' => __( 'Main Menu Left', 'wolf' ),
		'primary-right' => __( 'Main Menu Right', 'wolf' ),
		'secondary' => __( 'Secondary Menu', 'wolf' ),
		'tertiary' => __( 'Bottom Menu', 'wolf' ),
	),

	/**
	 *  The thumbnails :
	 *  We define wordpress thumbnail sizes that we will use in our design
	 */
	'images' => array(

		/**
		 *  max width, max height, true|false -> hardcrop or not
		 */
		// Slides
		'slide' => array( 1200, 700, true ),
		'slide-tablet' => array( 625, 450, true ),
		'slide-laptop' => array( 676, 424, true ),
		'slide-desktop' => array( 922, 506, true ),
		'slide-mobile' => array( 277, 494, true ),

		'classic-thumb' => array( 640, 360, true ),
		'classic-video-thumb' => array( 480, 270, true ),
		'portrait' => array( 600, 900, true ),

		// Mosaic
		'2x1' => array( 960, 480, true ),
		'1x2' => array( 480, 960, true ),
		'1x1' => array( 360, 360, true ),
		'2x2' => array( 960, 960, true ),

		// Big image
		'extra-large' => array( 2560, 4000, false ),

		// avatar
		'avatar' => array( 80, 80, true ),
	),
);
$wolf_do_theme = new Wolf_Framework( $wolf_theme );

// Recommend plugins with TGM plugins activation
include( 'includes/admin/plugins/plugins.php' );