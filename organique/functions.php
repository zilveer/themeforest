<?php
/**
 * Organique functions and definitions
 *
 * @package Organique
 * @author Primoz Ciger <primoz@proteusnet.com>
 */

/**
 * Define the version variable to assign it to all the assets (css and js)
 */
define( 'ORGANIQUE_WP_VERSION', wp_get_theme()->get( 'Version' ) );

/**
 * Define the development
 */
if ( ! defined( 'ORGANIQUE_DEVELOPMENT' ) ) {
	define( 'ORGANIQUE_DEVELOPMENT', false );
}

/**
 * Include important admin files
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @see http://developer.wordpress.com/themes/content-width/
 */
if ( ! isset( $content_width ) ) {
	$content_width = 700; /* pixels */
}

if( ! function_exists( 'organique_adjust_content_width' ) ) {
	function organique_adjust_content_width() { // adjust if necessary
		global $content_width;

		if ( is_page_template( 'page-no-sidebar.php' ) ) {
			$content_width = 940;
		}
	}
	add_action( 'template_redirect', 'organique_adjust_content_width' );
}


/**
 * Option Tree Plugin
 *
 * - ot_show_pages:      will hide the settings & documentation pages.
 * - ot_show_new_layout: will hide the "New Layout" section on the Theme Options page.
 */

if ( ! ORGANIQUE_DEVELOPMENT ) {
	add_filter( 'ot_show_pages', '__return_false' );
	add_filter( 'ot_show_new_layout', '__return_false' );
}

// Required: set 'ot_theme_mode' filter to true.
add_filter( 'ot_theme_mode', '__return_true' );

// Required: include OptionTree.
load_template( trailingslashit( get_template_directory() ) . 'bower_components/option-tree/ot-loader.php' );

// Load the options file
if ( ! ORGANIQUE_DEVELOPMENT ) {
	load_template( trailingslashit( get_template_directory() ) . 'inc/theme-options.php' );
}




/**
 * Theme support and thumbnail sizes
 */
if( ! function_exists( 'organique_setup' ) ) {
	function organique_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Organique, use a find and replace
		 * to change 'proteusthemes' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'organique_wp', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Add title tag support
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		// Custom Backgrounds
		add_theme_support( 'custom-background', array(
			'default-color' => 'ffffff',
			'default-image' => ''
		) );

		set_post_thumbnail_size( 750, 285, true );
		add_image_size( 'small-product-in-cart', 40, 50, true );
		add_image_size( 'team-slider', 260, 260, true );
		add_image_size( 'jumbotron-slider', 1920, 420, true );

		// Menus
		add_theme_support( 'menus' );
		register_nav_menu( "main-menu", "Main Menu" );
		register_nav_menu( "top-bar-menu", "Top bar Menu" );

		// Add theme support for Semantic Markup
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
		) );

		// WooCommerce
		add_theme_support( 'woocommerce' );
	}
	add_action( 'after_setup_theme', 'organique_setup' );
}



/**
 * Enqueue styles
 */
if( ! function_exists( 'enqueue_organique_styles' ) ) {
	function enqueue_organique_styles() {
		if ( is_admin() || is_login_page() ) {
			return;
		}

		// bootstrap css
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . "/assets/stylesheets/bootstrap.css", false, '3.0.2' );

		// jquery UI theme
		// wp_enqueue_style( 'jquery-ui-organique', get_template_directory_uri() . "/assets/stylesheets/smoothness/jquery-ui-1.10.3.custom.min.css", false, '1.10.3' );

		// main
		wp_enqueue_style( 'main', get_template_directory_uri() . "/assets/stylesheets/main.css", array( 'bootstrap', /* 'jquery-ui-organique' */ ), ORGANIQUE_WP_VERSION );
	}
	add_action( "wp_enqueue_scripts", "enqueue_organique_styles" );
}


/**
 * Enqueue scripts
 */
if( ! function_exists( 'organique_scripts' ) ) {
	function organique_scripts() {
		// modernizr for the frontend feature detection
		wp_enqueue_script( 'organique-modernizr', get_template_directory_uri() . '/assets/js/modernizr.custom.95157.js', array(), null );

		if ( ! is_admin() && ! is_login_page() ) {
			wp_enqueue_script( 'organique-gmaps', organique_get_google_maps_api_url(), array(), null, TRUE );
			wp_enqueue_script( 'organique-main', get_template_directory_uri() . "/assets/js/dist/main.min.js", array(
				'jquery',
				'underscore',
				'organique-gmaps',
			), ORGANIQUE_WP_VERSION, true );

			/**
			 * Pass data to the main script
			 */
			wp_localize_script( 'organique-main', 'OrganiqueVars', array(
				'pathToTheme'    => get_template_directory_uri(),
				'gmapsLocations' => organique_maps_array(),
				'latLng'         => ot_get_option( 'gm_lat_lng', '0,0' ),
				'mapType'        => get_theme_mod( 'map_type', 'ROADMAP' ),
				'mapStyle'       => get_theme_mod( 'map_style', '[]' ),
				'zoomLevel'      => get_theme_mod( 'zoom_level', 15 ),
			) );

			// for nested comments
			if ( ! is_admin() && is_singular() && comments_open() ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}
	}
	add_action( "wp_enqueue_scripts", "organique_scripts" );
}



/**
 * Load OT variables
 */
if( ! function_exists( 'load_ot_settings' ) ) {
	function load_ot_settings() {
		global $content_divider;
		if ( function_exists( 'ot_get_option' ) ) {
			$content_divider = ot_get_option( 'content_divider', 'scissors' );
		}
	}
	add_action( 'init', 'load_ot_settings' );
}



/**
 * Require the files in the folder /inc/
 */
$files_to_require = array(
	'helpers',
	'post-types',
	'ot-meta-boxes',
	'shortcodes',
	'theme-widgets',
	'register-sidebars',
	'filters',
	'theme-customizer',
	'custom-comments',
	'template-tags',
	'woocommerce'
);

// Conditionally require the includes files, based if they exist in the child theme or not
foreach( $files_to_require as $file ) {
	locate_template ( "inc/{$file}.php", true, true );
}

/**
 * Plugin activation class
 */
if( is_admin() ) {
	require_once( trailingslashit( get_template_directory() ) . 'inc/tgm-plugin-activation.php' );
}

/**
 * Trigger automatic theme updates notifications
 */
if ( ! function_exists( 'organique_check_for_updates' ) ) {
	function organique_check_for_updates() {
		load_template( trailingslashit( get_template_directory() ) . 'bower_components/Envato-WordPress-Theme-Updater/envato-wp-theme-updater.php' );
		$username = trim( ot_get_option( 'tf_username', '' ) );
		$api_key  = trim( ot_get_option( 'tf_api_key', '' ) );

		if ( ! empty( $username ) && ! empty( $api_key ) ) {
			Envato_WP_Theme_Updater::init( $username, $api_key, 'ProteusThemes' );
		}
	}
	add_action( 'after_setup_theme', 'organique_check_for_updates' );
}