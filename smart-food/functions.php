<?php
/**
 * ThemesDepot Framework functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * Files that are loaded through the locate_template function can be overidden
 * through a child theme.
 * 
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package SmartFood
 * @since 1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

/* Launch the ThemesDepot framework. */
require_once( trailingslashit( get_template_directory() ) . 'framework/themesdepot.php' );
new ThemesDepot();

/* Load the Advanced Custom Fields plugin if the plugin is not already installed supported. */
if( !class_exists('acf') ):
	require_once( trailingslashit( 'framework/extensions/' ) . 'advanced-custom-fields/acf.php' );
	require_once locate_template('includes/acf-fields.php' );
endif;

require_once( 'framework/extensions/page-builder/tdpt-page-builder.php' );	
require_once( 'includes/page-builder-blocks.php' );	

/* Set up the theme early. */
add_action( 'after_setup_theme', 'tdp_theme_setup', 13 );

/**
 * The theme setup function.  This function sets up support for various WordPress and framework functionality.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function tdp_theme_setup() {

	if ( ! isset( $content_width ) ) $content_width = 900;

	/* Handle Theme specific functions not part of the framework. */
	require_once locate_template('includes/theme-specific.php' );

	/* Handle Integration with WP Restaurant Manager Plugin. */
	if ( class_exists( 'WP_Restaurant_Manager' ) ) {
		require_once locate_template('includes/wp-restaurant-manager.php' );
	}

	/* Handle Integration with TGMPA Class. */
	require_once locate_template('framework/extensions/required-plugins.php' );

	/* Register Nav Menus */
	register_nav_menus(
            array(
				'primary'   => __('Primary Menu', 'smartfood'), 
				'secondary' => __('Secondary Menu', 'smartfood'),
				'footer' => __('Footer Menu', 'smartfood'),
				'responsive' => __('Responsive Menu', 'smartfood'),
            )
    );

	/* Register Sidebars */
	tdp_register_sidebar(
		array(
			'id'          => 'page_sidebar',
			'name'        => __('Page Sidebar', 'smartfood'),
			'description' => __('Display widgets in pages sidebars.', 'smartfood')
		)
	);
	tdp_register_sidebar(
		array(
			'id'          => 'blog_sidebar',
			'name'        => __('Blog Sidebar', 'smartfood'),
			'description' => __('Display widgets into the blog page.', 'smartfood')
		)
	);
	tdp_register_sidebar(
		array(
			'id'          => 'food_sidebar',
			'name'        => __('Food Widget Area', 'smartfood'),
			'description' => __('Display widgets into the pages reserved to the WP Restaurant Manager Plugin.', 'smartfood')
		)
	);
	if ( in_array( 'the-events-calendar/the-events-calendar.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	    tdp_register_sidebar(
			array(
				'id'          => 'events_sidebar',
				'name'        => __('Events Sidebar', 'smartfood'),
				'description' => __('Display widgets into the pages reserved to the The Events Restaurant Plugin.', 'smartfood')
			)
		);
	}
	tdp_register_sidebar(
		array(
			'id'          => 'footer_widget_area1',
			'name'        => __('Footer Widget Area 1', 'smartfood'),
			'description' => __('Display widgets into the footer area only when the footer layout is set to "Minimal Footer With Widgets".', 'smartfood')
		)
	);
	tdp_register_sidebar(
		array(
			'id'          => 'footer_widget_area2',
			'name'        => __('Footer Widget Area 2', 'smartfood'),
			'description' => __('Display widgets into the footer area only when the footer layout is set to "Minimal Footer With Widgets".', 'smartfood')
		)
	);
	tdp_register_sidebar(
		array(
			'id'          => 'footer_widget_area3',
			'name'        => __('Footer Widget Area 3', 'smartfood'),
			'description' => __('Display widgets into the footer area only when the footer layout is set to "Minimal Footer With Widgets".', 'smartfood')
		)
	);
	tdp_register_sidebar(
		array(
			'id'          => 'footer_booking_widget_area',
			'name'        => __('Footer Booking Widget Area', 'smartfood'),
			'description' => __('Display widgets into the footer area only when the footer layout is set to "Booking".', 'smartfood')
		)
	);

	/* Extensions Support */
	add_theme_support( 'tgm' ); // TGM Library for plugins requirements.
	add_theme_support( 'breadcrumb-trail' ); // Library to handle the breadcrumbs
	add_theme_support( 'tdp_widget_class' ); // Library to handle all widgets

    /* Post formats. */
	add_theme_support( 
		'post-formats', 
		array( 'image', 'gallery', 'link', 'quote', 'video' ) 
	);

	/* Load Theme Widgets */
	if(current_theme_supports( 'tdp_widget_class' ) && class_exists('WPH_Widget')):
		require_once locate_template('includes/widgets/widget-social-icons.php' );
		require_once locate_template('includes/widgets/widget-find-us.php' );
		
		register_widget( 'TDP_Social_Icons' );
		register_widget( 'TDP_Find_Us' );
	endif;

	/* Custom image sizes */
	add_image_size( 'gallery-thumb', 480, 480, true );

	/* Update Default Gallery Settings */
	update_option('image_default_link_type', 'media' );

	// Setup translations
	load_theme_textdomain('smartfood', get_template_directory() . '/languages');

}

function tdp_fix_acf_bug() {

	echo "<style>.acf-image-uploader.active .no-image {display:block !important;}</style>";

}
add_action( 'admin_head', 'tdp_fix_acf_bug' );
