<?php
/**
 * Main Theme Functions
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

/*-----------------------------------------------------------------------------------*/
/* Define Theme Constants
/*-----------------------------------------------------------------------------------*/

define( 'SD_FRAMEWORK', get_template_directory() . '/framework/' );
define( 'SD_FRAMEWORK_INC', get_template_directory() . '/framework/inc/' );
define( 'SD_FRAMEWORK_CSS', get_template_directory_uri() . '/framework/css/' );
define( 'SD_FRAMEWORK_JS', get_template_directory_uri() . '/framework/js/' );

// Redux Theme Options

// extension loader
require_once( SD_FRAMEWORK . 'admin/sd-loader.php');

// redux core and options

if ( ! class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/framework/admin/ReduxCore/framework.php' ) ) {
	require_once( dirname( __FILE__ ) . '/framework/admin/ReduxCore/framework.php' );
}

if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/framework/admin/sd-admin-options/sd-admin-options.php' ) ) {
	require_once( dirname( __FILE__ ) . '/framework/admin/sd-admin-options/sd-admin-options.php' );
}

// Define content width
if ( ! isset( $content_width ) ) $content_width = 1170;

/* ------------------------------------------------------------------------ */
/* Localization
/* ------------------------------------------------------------------------ */

$lang = SD_FRAMEWORK . '/lang';
load_theme_textdomain('sd-framework', $lang);

/* ------------------------------------------------------------------------ */
/* Inlcudes
/* ------------------------------------------------------------------------ */

// Enqueue JavaScripts & CSS
require_once( SD_FRAMEWORK_INC . 'enqueue.php');
	
// Theme Functions
require_once( SD_FRAMEWORK_INC . 'sd-theme-functions/sd-functions.php' );

// Include Widgets
require_once( SD_FRAMEWORK_INC . 'widgets/widgets.php' );
	
// Visual Composer
if ( class_exists( 'Vc_Manager' ) ) {
	require_once( SD_FRAMEWORK_INC . 'vc/sd-vc-functions.php' );
}
/* Include Meta Box Script */
if ( ! function_exists( 'sd_load_meta_box_plugin' ) ) {
	function sd_load_meta_box_plugin() {
		// Re-define meta box path and URL
		require get_template_directory() . '/framework/inc/metabox/meta-box.php';
		include 'framework/inc/metabox/the-meta-boxes.php';
		include 'framework/inc/metabox/meta-box-show-hide.php';
	}
	add_action('init', 'sd_load_meta_box_plugin');
}

/* TGMPA Automatic Plugin Activation */
require_once( SD_FRAMEWORK_INC . 'tgmpa/sd-tgmpa.php' );