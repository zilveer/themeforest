<?php

//========================================================================================
//  ____  _     _   _            _   _          _____ _                              
// |  _ \(_)___| |_(_)_ __   ___| |_(_)_   ____|_   _| |__   ___ _ __ ___   ___  ___ 
// | | | | / __| __| | '_ \ / __| __| \ \ / / _ \| | | '_ \ / _ \ '_ ` _ \ / _ \/ __|
// | |_| | \__ \ |_| | | | | (__| |_| |\ V /  __/| | | | | |  __/ | | | | |  __/\__ \
// |____/|_|___/\__|_|_| |_|\___|\__|_| \_/ \___||_| |_| |_|\___|_| |_| |_|\___||___/
//
//========================================================================================

//==========================================================
// === DEFINE CONTANTS
//==========================================================
define( 'DTMETA_URL', trailingslashit( get_stylesheet_directory_uri() . '/framework/meta-box' ) );
define( 'DTMETA_DIR', trailingslashit( get_template_directory() . '/framework/meta-box' ) );
$distinctivethemes_theme_data = wp_get_theme();
define( 'DISTINCTIVETHEMES_THEME_URL', get_template_directory_uri() );
define( 'DISTINCTIVETHEMES_THEME_TEMPLATE', get_template_directory() );
define( 'DISTINCTIVETHEMES_THEME_VERSION', trim( $distinctivethemes_theme_data->Version ) );
define( 'DISTINCTIVETHEMES_THEME_NAME', $distinctivethemes_theme_data->Name );
define( 'DISTINCTIVETHEMES_THEME_FILE', get_option( 'template' ) );
define('DISTINCTIVETHEMESTEXTDOMAIN', wp_get_theme()->get( 'TextDomain' ));
define('DISTINCTIVETHEMESTHEMENAME', wp_get_theme()->get( 'Name' ));

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'quote_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function quote_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on quote, use a find and replace
	 * to change 'quote' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'quote', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'quote' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'gallery', 'video'
	) );

	add_theme_support( 'post-thumbnails' );
	add_image_size( 'main-featured', 570, 360, true );
	add_image_size( 'small-featured', 300, 220, true );
	add_image_size( 'small-square', 300, 300, true );
	add_image_size( 'half', 570, 220, true );
	add_image_size( 'square100', 100, 100, true );
	add_image_size( 'widget-featured', 80, 80, true );
}
endif; // quote_setup
add_action( 'after_setup_theme', 'quote_setup' );

//==========================================================
// === FRAMEWORK
//==========================================================
require_once( trailingslashit( get_template_directory() ) . 'framework/framework-functions.php' );
require_once( trailingslashit( get_template_directory() ) . 'framework/customizer-options.php' );
require_once( trailingslashit( get_template_directory() ) . 'framework/customizations.php' );
require_once( trailingslashit( get_template_directory() ) . 'framework/plugin-activate.php' );
require_once( trailingslashit( get_template_directory() ) . 'framework/distinctive-page-builder/page-builder.php' );
require_once( trailingslashit( get_template_directory() ) . 'framework/meta-boxes.php' );
require_once( trailingslashit( get_template_directory() ) . 'framework/aqua-resizer.php' );
require_once DTMETA_DIR . 'meta-box.php';

//==========================================================
// === THEME SPECIFIC FUNCTIONS
//==========================================================
require_once( trailingslashit( get_template_directory() ) . 'includes/widgets.php' );
require_once( trailingslashit( get_template_directory() ) . 'includes/menus-and-sidebars.php' );
require_once( trailingslashit( get_template_directory() ) . 'includes/utility.php' );
require_once( trailingslashit( get_template_directory() ) . 'includes/scripts-and-styles.php' );
require_once( trailingslashit( get_template_directory() ) . 'includes/functions/related-posts.php' );
require_once( trailingslashit( get_template_directory() ) . 'includes/functions/bg-img-slider.php' );
require_once( trailingslashit( get_template_directory() ) . 'framework/update-notifications.php' );
require get_template_directory() . '/includes/template-tags.php';
require get_template_directory() . '/includes/extras.php';

//==========================================================
// === IMPORT
//==========================================================
add_action('wp_ajax_ebor_ajax_import_data', 'ebor_ajax_import_data');
function ebor_ajax_import_data() {        
  require_once( trailingslashit( get_template_directory() ) . 'framework/demo-import.php');
  die('ebor_import');
}

add_filter( 'wp_nav_menu_objects', 'single_page_nav_links' );

function single_page_nav_links( $items ) {
	foreach ( $items as $item ) {		
		if('page-sections' == $item->object) {
			$current_post = get_post($item->object_id);
			$menu_title = "#".$current_post->post_name;
				if(!is_home()) {
					$item->url = home_url( '/' ).$menu_title;
				} else {
					$item->url = $menu_title;
				}
		} elseif ('custom' == $item->type && !is_home()){
			if( 1 === preg_match('/^#([^\/]+)$/', $item->url , $matches)){			 	
			 	$item->url = home_url( '/' ).$item->url;
			}
		}	 
	}
	return $items;   
}