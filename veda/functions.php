<?php
/**
 * Theme Functions
 *
 * @package DTtheme
 * @author DesignThemes
 * @link http://wedesignthemes.com
 */

define( 'VEDA_THEME_DIR', get_template_directory() );
define( 'VEDA_THEME_URI', get_template_directory_uri() );
define( 'VEDA_CORE_PLUGIN', WP_PLUGIN_DIR.'/designthemes-core-features' );
define( 'VEDA_SETTINGS', 'veda-opts' );

if (function_exists ('wp_get_theme')) :
	$themeData = wp_get_theme();
	define( 'THEME_NAME', $themeData->get('Name'));
	define( 'THEME_VERSION', $themeData->get('Version'));
endif;

define( 'VEDA_LANG_DIR', VEDA_THEME_DIR. '/languages' );

/* ---------------------------------------------------------------------------
 * Loads Theme Textdomain
 * --------------------------------------------------------------------------- */
load_theme_textdomain( 'veda', VEDA_LANG_DIR );

/* ---------------------------------------------------------------------------
 * Loads the Admin Panel Scripts
 * --------------------------------------------------------------------------- */
function veda_admin_scripts() {

	wp_enqueue_style('veda-admin', VEDA_THEME_URI .'/framework/theme-options/style.css');
	wp_enqueue_style('veda-chosen', VEDA_THEME_URI .'/framework/theme-options/css/chosen.css');
	wp_enqueue_style('wp-color-picker');

	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('wp-color-picker');
	
	wp_enqueue_script('veda-tooltip', VEDA_THEME_URI . '/framework/theme-options/js/jquery.tools.min.js');
	wp_enqueue_script('veda-chosen', VEDA_THEME_URI . '/framework/theme-options/js/chosen.jquery.min.js');
	wp_enqueue_script('veda-custom', VEDA_THEME_URI . '/framework/theme-options/js/dttheme.admin.js');
	wp_enqueue_media();

	wp_localize_script('veda-custom', 'objectL10n', array(
		'saveall' => esc_html__('Save All', 'veda'),
		'saving' => esc_html__('Saving ...', 'veda'),
		'noResult' => esc_html__('No Results Found!', 'veda'),
		'resetConfirm' => esc_html__('This will restore all of your options to default. Are you sure?', 'veda'),
		'importConfirm' => esc_html__('You are going to import the dummy data provided with the theme, kindly confirm?', 'veda'),
		'backupMsg' => esc_html__('Click OK to backup your current saved options.', 'veda'),
		'backupSuccess' => esc_html__('Your options are backuped successfully', 'veda'),
		'backupFailure' => esc_html__('Backup Process not working', 'veda'),
		'disableImportMsg' => esc_html__('Importing is disabled.. :), Please select atleast import type','veda'),
		'restoreMsg' => esc_html__('Warning: All of your current options will be replaced with the data from your last backup! Proceed?', 'veda'),
		'restoreSuccess' => esc_html__('Your options are restored from previous backup successfully', 'veda'),
		'restoreFailure' => esc_html__('Restore Process not working', 'veda'),
		'importMsg' => esc_html__('Click ok import options from the above textarea', 'veda'),
		'importSuccess' => esc_html__('Your options are imported successfully', 'veda'),
		'importFailure' => esc_html__('Import Process not working', 'veda')));
}
add_action( 'admin_enqueue_scripts', 'veda_admin_scripts' );

/* ---------------------------------------------------------------------------
 * Loads the Options Panel
 * --------------------------------------------------------------------------- */
require_once( VEDA_THEME_DIR .'/framework/utils.php' );
require_once( VEDA_THEME_DIR .'/framework/fonts.php' );
require_once( VEDA_THEME_DIR .'/framework/theme-options/init.php' );

/* ---------------------------------------------------------------------------
 * Loads Theme Functions
 * --------------------------------------------------------------------------- */

// Functions --------------------------------------------------------------------
require_once( VEDA_THEME_DIR .'/functions/register-functions.php' );

// Header -----------------------------------------------------------------------
require_once( VEDA_THEME_DIR .'/functions/register-head.php' );

// Meta box ---------------------------------------------------------------------
require_once( VEDA_THEME_DIR .'/framework/theme-metaboxes/post-metabox.php' );
require_once( VEDA_THEME_DIR .'/framework/theme-metaboxes/page-metabox.php' );

// Tribe Events -----------------------------------------------------------------
if ( class_exists( 'Tribe__Events__Main' ) )
	require_once( VEDA_THEME_DIR .'/framework/theme-metaboxes/event-metabox.php' );

// Menu -------------------------------------------------------------------------
require_once( VEDA_THEME_DIR .'/functions/register-menu.php' );
require_once( VEDA_THEME_DIR .'/functions/register-mega-menu.php' );

// Hooks ------------------------------------------------------------------------
require_once( VEDA_THEME_DIR .'/functions/register-hooks.php' );

// Likes ------------------------------------------------------------------------
require_once( VEDA_THEME_DIR .'/functions/register-likes.php' );

// Widgets ----------------------------------------------------------------------
add_action( 'widgets_init', 'veda_widgets_init' );
function veda_widgets_init() {
	require_once( VEDA_THEME_DIR .'/functions/register-widgets.php' );

	if(class_exists('DTCorePlugin')) {
		register_widget('Veda_Twitter');
	}
	
	register_widget('Veda_Flickr');
	register_widget('Veda_Recent_Posts');
	register_widget('Veda_Portfolio_Widget');
}
if(class_exists('DTCorePlugin')) {
	require_once( VEDA_THEME_DIR .'/functions/widgets/widget-twitter.php' );
}
require_once( VEDA_THEME_DIR .'/functions/widgets/widget-flickr.php' );
require_once( VEDA_THEME_DIR .'/functions/widgets/widget-recent-posts.php' );
require_once( VEDA_THEME_DIR .'/functions/widgets/widget-recent-portfolios.php' );

// Plugins ---------------------------------------------------------------------- 
require_once( VEDA_THEME_DIR .'/functions/register-plugins.php' );

// WooCommerce ------------------------------------------------------------------
if( function_exists( 'is_woocommerce' ) ){
	require_once( VEDA_THEME_DIR .'/functions/register-woocommerce.php' );
}?>