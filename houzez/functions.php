<?php
/**
 * Houzez functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Houzez
 * @since Houzez 1.0
 * @author Waqas Riaz
 */

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
/**
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*	Define constants
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*/
define( 'HOUZEZ_THEME_NAME', 'Houzez' );
define( 'HOUZEZ_THEME_SLUG', 'houzez' );
define( 'HOUZEZ_THEME_VERSION', '1.4.0' );

/**
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*	Set up theme default and register various supported features.
*	----------------------------------------------------------------------------------------------------------------------------------------------------
*/
if ( ! function_exists( 'houzez_setup' ) ) {
	function houzez_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		//Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		//Add support for post thumbnails.
		add_theme_support( 'post-thumbnails' );

		set_post_thumbnail_size( 150, 150 );
		add_image_size( 'houzez-single-big-size', 1170, 600, true ); // toparea-v1.php , single-property.php
		add_image_size( 'houzez-property-thumb-image', 385, 258, true ); // List, grid view. Include VC modules grid view, content-grid-1.php
		add_image_size( 'houzez-property-thumb-image-v2', 380, 280, true ); // List, grid view. Include VC modules grid view, content-grid-1.php
		add_image_size( 'houzez-image570_340', 570, 340, true ); // for property carousels and property grids
		add_image_size( 'houzez-property-detail-gallery', 810, 430, true ); // Slideshow.php , blog-function.php
		add_image_size( 'houzez-imageSize1170_738', 1170, 738, true ); // lightbox.php , toparea-v2.php
		add_image_size( 'houzez-prop_image1440_610', 1440, 610, true ); // property-slider.php
		add_image_size( 'houzez-image350_350', 350, 350, true ); // author.php , content-grid-2.php , single-houzez_agent.php , template-agent.php
		add_image_size( 'houzez-widget-prop', 150, 110, true ); // slideshow.php , dashboard_property_unit.php
		add_image_size( 'houzez-image_masonry', 350, 9999, false ); // blog-masonry.php
		

		/**
		*	Register nav menus. 
		*/
		register_nav_menus(
			array(
				'main-menu' => esc_html__( 'Main Menu', 'houzez' ),
				'top-menu' => esc_html__( 'Top Menu', 'houzez' ),
				'footer-menu' => esc_html__( 'Footer Menu', 'houzez' )
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support( 'post-formats', array(

		) );

		//remove gallery style css
		add_filter( 'use_default_gallery_style', '__return_false' );
		
	}

	add_action( 'after_setup_theme', 'houzez_setup' );
}

/**
 *	----------------------------------------------------------------------------------------------------------------------------------------------------
 *	Make the theme available for translation.
 *	----------------------------------------------------------------------------------------------------------------------------------------------------
 */
load_theme_textdomain( 'houzez', get_template_directory() . '/languages' );

/**
 *	----------------------------------------------------------------------------------------------------------------------------------------------------
 *	Set up the content width value based on the theme's design.
 *	----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if( !function_exists('houzez_content_width') ) {
	function houzez_content_width()
	{
		$GLOBALS['content_width'] = apply_filters('houzez_content_width', 1170);
	}

	add_action('after_setup_theme', 'houzez_content_width', 0);
}


/**
 *	----------------------------------------------------------------------------------------------------------------------------------------------------
 *	Enqueue scripts and styles.
 *	----------------------------------------------------------------------------------------------------------------------------------------------------
 */
require_once( get_template_directory() . '/inc/register-scripts.php' );

/**
 *	----------------------------------------------------------------------------------------------------------------------------------------------------
 *	TMG plugin activation
 *	----------------------------------------------------------------------------------------------------------------------------------------------------
 */
	require_once( get_template_directory() . '/framework/class-tgm-plugin-activation.php' );
	require_once( get_template_directory() . '/framework/register-plugins.php' );

/**
 *	----------------------------------------------------------------------------------------------------------------------------------------------------
 *	Visual Composer
 *	----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if (is_plugin_active('js_composer/js_composer.php') && is_plugin_active('houzez-theme-functionality/houzez-theme-functionality.php') ) {

	if( !function_exists('houzez_include_composer') ) {
		function houzez_include_composer()
		{
			require_once(get_template_directory() . '/framework/vc_extend.php');
		}

		add_action('init', 'houzez_include_composer', 9999);
	}

	// Filter to replace default css class names for vc_row shortcode and vc_column
	if( !function_exists('houzez_custom_css_classes_for_vc_row_and_vc_column') ) {
		add_filter('vc_shortcodes_css_class', 'houzez_custom_css_classes_for_vc_row_and_vc_column', 10, 2);
		function houzez_custom_css_classes_for_vc_row_and_vc_column($class_string, $tag)
		{
			if ($tag == 'vc_row' || $tag == 'vc_row_inner') {
				$class_string = str_replace('vc_row-fluid', 'row-fluid', $class_string); // This will replace "vc_row-fluid" with "my_row-fluid"
				$class_string = str_replace('vc_row', 'row', $class_string); // This will replace "vc_row-fluid" with "my_row-fluid"
				$class_string = str_replace('wpb_row', '', $class_string); // This will replace "vc_row-fluid" with "my_row-fluid"
			}
			if ($tag == 'vc_column' || $tag == 'vc_column_inner') {
				$class_string = preg_replace('/vc_col-sm-(\d{1,2})/', 'col-sm-$1', $class_string); // This will replace "vc_col-sm-%" with "my_col-sm-%"
				$class_string = str_replace('wpb_column', '', $class_string);
				$class_string = str_replace('vc_column_container', '', $class_string);
			}
			return $class_string; // Important: you should always return modified or original $class_string
		}
	}

}

/**
 *	----------------------------------------------------------------------------------------------------------------------------------------------------
 *	Functions
 *	----------------------------------------------------------------------------------------------------------------------------------------------------
 */
require_once( get_template_directory() . '/framework/functions/price_functions.php' );
require_once( get_template_directory() . '/framework/functions/currency_switcher_functions.php' );
require_once( get_template_directory() . '/framework/functions/helper_functions.php' );
require_once( get_template_directory() . '/framework/functions/profile_functions.php' );
require_once( get_template_directory() . '/framework/functions/property_functions.php' );
require_once( get_template_directory() . '/framework/functions/emails-functions.php' );
require_once( get_template_directory() . '/framework/functions/blog-functions.php' );
require_once( get_template_directory() . '/framework/functions/membership-functions.php' );
require_once( get_template_directory() . '/framework/functions/cron-functions.php' );
require_once( get_template_directory() . '/framework/functions/houzez-localization.php' );
require_once( get_template_directory() . '/framework/functions/db-update.php' );
require_once( get_template_directory() . '/inc/header/favicon-apple-icons.php' );
require_once( get_template_directory() . '/inc/yelpauth/yelpoauth.php' );

if ( class_exists( 'ReduxFramework' ) ) {
	require_once( get_template_directory() . '/inc/styling-options.php' );
	require_once( get_template_directory() . '/framework/functions/demo-importer.php' );
}

/**
 *	---------------------------------------------------------------------------------------
 *	Widgets
 *	---------------------------------------------------------------------------------------
 */
require_once ( get_template_directory() . '/inc/widgets/houzez-featured-properties.php' );
require_once ( get_template_directory() . '/inc/widgets/houzez-properties.php' );
require_once ( get_template_directory() . '/inc/widgets/houzez-property-taxonomies.php' );
require_once ( get_template_directory() . '/inc/widgets/houzez-advanced-search.php' );
require_once ( get_template_directory() . '/inc/widgets/houzez-about.php' );
require_once ( get_template_directory() . '/inc/widgets/houzez-contact.php' );
require_once ( get_template_directory() . '/inc/widgets/houzez-latest-posts.php' );
require_once ( get_template_directory() . '/inc/widgets/houzez-code-banner.php' );
require_once ( get_template_directory() . '/inc/widgets/houzez-facebook.php' );
require_once ( get_template_directory() . '/inc/widgets/houzez-flickr-photos.php' );
require_once ( get_template_directory() . '/inc/widgets/houzez-image-banner-300-250.php' );
require_once ( get_template_directory() . '/inc/widgets/houzez-mortgage-calculator.php' );
require_once ( get_template_directory() . '/inc/widgets/houzez-instagram.php' );
require_once ( get_template_directory() . '/inc/widgets/houzez-twitter.php' );
require_once ( get_template_directory() . '/inc/widgets/houzez-properties-viewed.php' );

if( class_exists('Houzez_login_register') ) {
	require_once( get_template_directory() . '/inc/widgets/houzez-login-widget.php');
	require_once( get_template_directory() . '/framework/functions/roles-functions.php' );
}

/**
 *	---------------------------------------------------------------------------------------
 *	IDX Broker
 *	---------------------------------------------------------------------------------------
 */
if( class_exists('Idx_Broker_Plugin') ) {
	// Widgets
	/*require_once(get_template_directory() . '/inc/idxbroker/impress-carousel-widget.php');
	require_once(get_template_directory() . '/inc/idxbroker/impress-showcase-widget.php');
	require_once(get_template_directory() . '/inc/idxbroker/impress-lead-login-widget.php');
	require_once(get_template_directory() . '/inc/idxbroker/impress-lead-signup-widget.php');*/
}

/**
 *	----------------------------------------------------------------------------------------------------------------------------------------------------
 *	Twitter Oauth
 *	----------------------------------------------------------------------------------------------------------------------------------------------------
 */
if(!class_exists('TwitterOAuth',false)) {
	require_once( get_template_directory() . '/inc/twitteroauth/twitteroauth.php' );
}


/**
 *	---------------------------------------------------------------------------------------
 *	Classes
 *	---------------------------------------------------------------------------------------
 */
require_once( get_template_directory() . '/framework/classes/houzez_data_source.php' );
require_once( get_template_directory() . '/framework/classes/Houzez_Compare_Properties.php' );

/**
 *	---------------------------------------------------------------------------------------
 *	Meta Boxes
 *	---------------------------------------------------------------------------------------
 */
require_once( get_template_directory() . '/framework/metaboxes/metaboxes.php' );
require_once( get_template_directory() . '/framework/metaboxes/property-status-meta.php' );
require_once( get_template_directory() . '/framework/metaboxes/property-label-meta.php' );
require_once( get_template_directory() . '/framework/metaboxes/property-area-meta.php' );
require_once( get_template_directory() . '/framework/metaboxes/property-cities-meta.php' );
require_once( get_template_directory() . '/framework/metaboxes/property-state-meta.php' );
require_once( get_template_directory() . '/framework/metaboxes/houzez-meta-boxes.php' );

/**
 *	---------------------------------------------------------------------------------------
 *	Options Admin Panel
 *	---------------------------------------------------------------------------------------
 */
require_once( get_template_directory() . '/framework/options/remove-tracking-class.php' ); // Remove tracking
require_once( get_template_directory() . '/framework/options/fave-options.php' );
require_once( get_template_directory() . '/framework/options/fave-option.php' );



/*-----------------------------------------------------------------------------------*/
/*	Register blog sidebar, footer and custom sidebar
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_widgets_init') ) {
	add_action('widgets_init', 'houzez_widgets_init');
	function houzez_widgets_init()
	{
		register_sidebar(array(
			'name' => 'Default Sidebar',
			'id' => 'default-sidebar',
			'description' => 'Widgets in this area will be shown in the blog sidebar.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-top"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => 'Property Listings',
			'id' => 'property-listing',
			'description' => 'Widgets in this area will be shown in property listings sidebar.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-top"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => 'Single Property',
			'id' => 'single-property',
			'description' => 'Widgets in this area will be shown in single property sidebar.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-top"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => 'Agent Sidebar',
			'id' => 'agent-sidebar',
			'description' => 'Widgets in this area will be shown in agents template and angent detail page.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-top"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => 'Search Sidebar',
			'id' => 'search-sidebar',
			'description' => 'Widgets in this area will be shown in search result page.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-top"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => 'Page Sidebar',
			'id' => 'page-sidebar',
			'description' => 'Widgets in this area will be shown in page sidebar.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-top"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => 'IDX Sidebar',
			'id' => 'idx-sidebar',
			'description' => 'Widgets in this area will be shown in idx template sidebar.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-top"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		/*register_sidebar(array(
			'name' => 'Create Listing Sidebar',
			'id' => 'create-listing-sidebar',
			'description' => 'Widgets in this area will be shown in create listing without login sidebar.',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-top"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));*/
		register_sidebar(array(
			'name' => 'Footer Area 1',
			'id' => 'footer-sidebar-1',
			'description' => 'Widgets in this area will be show in footer column one',
			'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-top"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => 'Footer Area 2',
			'id' => 'footer-sidebar-2',
			'description' => 'Widgets in this area will be show in footer column two',
			'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-top"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => 'Footer Area 3',
			'id' => 'footer-sidebar-3',
			'description' => 'Widgets in this area will be show in footer column three',
			'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-top"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
		register_sidebar(array(
			'name' => 'Footer Area 4',
			'id' => 'footer-sidebar-4',
			'description' => 'Widgets in this area will be show in footer column four',
			'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-top"><h3 class="widget-title">',
			'after_title' => '</h3></div>',
		));
	}
}

if ( ! current_user_can( 'manage_options' ) ) {
	show_admin_bar( false );
}

/*if( !function_exists('houzez_no_admin_access') ) {
	function houzez_no_admin_access()
	{
		$users_admin_access = houzez_option('users_admin_access');
		if ($users_admin_access != 1) {
			$redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : home_url('/');
			if (is_admin() && !current_user_can('administrator') &&
				!(defined('DOING_AJAX') && DOING_AJAX)
			) {
				wp_die(__("You don't have permission to access admin panel.", 'houzez'));
			}
		}
	}
}*/

if( !function_exists('houzez_vcSetAsTheme') ) {
	add_action('vc_before_init', 'houzez_vcSetAsTheme');
	function houzez_vcSetAsTheme()
	{
		vc_set_as_theme($disable_updater = false);
	}
}

if( class_exists('iHomefinderAutoloader') ) {
	function remove_bb_bootstrap() {
		wp_dequeue_script('bootstrap.min');
	}

	add_action('wp_enqueue_scripts', 'remove_bb_bootstrap', 1000);
}
?>