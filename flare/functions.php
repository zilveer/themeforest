<?php
/**
 * This file is part of the BTP_Flare_Theme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 */

/* Prevent direct script access */
if ( !empty( $_SERVER[ 'SCRIPT_FILENAME' ] ) && 'functions.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'No direct script access allowed' );
}

/* Define paths to common folders */
define( 'BTP_LIB_DIR',    		get_template_directory() . '/lib' );
define( 'BTP_FRAMEWORK_DIR',    get_template_directory() . '/framework' );

/* Global super variable */
$_BTP = array();

/* Always set BTP_CUSTOMIZE_MODE to false! */
define( 'BTP_CUSTOMIZE_MODE', false );
if( BTP_CUSTOMIZE_MODE && !session_id() ) {
	session_start();	
}

require_once( BTP_FRAMEWORK_DIR . '/lib/config.php' );
require_once( BTP_LIB_DIR . '/functions.php' );
require_once( BTP_LIB_DIR . '/dependencies.php' );
require_once( BTP_LIB_DIR . '/precontent/config.php' );
require_once( BTP_LIB_DIR . '/sliders/config.php' );
require_once( BTP_LIB_DIR . '/pages/config.php' );
require_once( BTP_LIB_DIR . '/posts/config.php' );
require_once( BTP_LIB_DIR . '/works/config.php' );
require_once( BTP_LIB_DIR . '/flexsliders/config.php' );
require_once( BTP_LIB_DIR . '/relations/config.php' );
require_once( BTP_LIB_DIR . '/feeds/config.php' );

require_once( BTP_LIB_DIR . '/options.php' );
require_once( BTP_LIB_DIR . '/fonts.php' );

/* Hide the WordPress version information from the <head> */
remove_action('wp_head', 'wp_generator');
/* Enable post thumbnails */
add_theme_support( 'post-thumbnails' );

/* EnableWP Auto Feed Links */
add_theme_support('automatic-feed-links');

add_theme_support('woocommerce');

/* Set standard content width */
if ( ! isset( $content_width ) ) $content_width = 711;

/* Enable editor styles */
add_theme_support('editor_style');
add_editor_style();

/* Enqueue the scripts & styles */
add_action( 'wp_enqueue_scripts', 'btp_theme_enqueue_styles' );
add_action( 'wp_enqueue_scripts', 'btp_theme_enqueue_scripts' );

/* Init various mechanisms */
add_action( 'after_setup_theme', 'btp_init_localization' );
add_action( 'after_setup_theme', 'btp_init_post_thumbnails' );
add_action( 'init', 'btp_init_nav_menus' );
add_action( 'init', 'btp_init_sidebars' );
btp_init_shortcodes();
btp_init_widgets();
add_action( 'init', 'btp_init_fonts' );

/* Modify some standard forms */
add_filter( 'comment_form_default_fields', 'btp_comment_form_default_fields' );
add_filter( 'comment_form_field_comment', 'btp_comment_form_field_comment' );
add_filter( 'comment_form_defaults', 'btp_comment_form_defaults' );
add_filter( 'the_password_form', 'btp_get_the_password_form' );
?>