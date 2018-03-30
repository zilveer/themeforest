<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Initiate admin components.
 *
 * @return void
 */
function stag_admin_init(){

	if( stag_is_theme_activated() ){
		flush_rewrite_rules();
		header( 'Location: ' . admin_url( 'admin.php?page=stagframework&activated=true' ) );
	}

	$data = get_option('stag_framework_options');

	$data['theme_version']     = STAG_THEME_VERSION;
	$data['theme_name']        = STAG_THEME_NAME;
	$data['framework_version'] = STAG_FRAMEWORK_VERSION;
	$data['stag_framework']    = array();
	update_option('stag_framework_options', $data);

	$stag_values = get_option('stag_framework_values');
	if( !is_array($stag_values) ) update_option( 'stag_framework_values', array() );
}
add_action( 'init', 'stag_admin_init', 2 );

/**
 * Add admin menus.
 *
 * @return void
 */
function stag_admin_menu(){
	add_menu_page( STAG_THEME_NAME, STAG_THEME_NAME, 'manage_options', 'stagframework', 'stag_options_page', 'dashicons-admin-generic', 31 );
	add_submenu_page('stagframework', __('Theme Options', 'stag'), __('Theme Options', 'stag'), 'manage_options', 'stagframework', 'stag_options_page' );
}
add_action( 'admin_menu', 'stag_admin_menu' );

/**
 * Enqueue admin styles.
 *
 * @param string $hook Page name where to enqueue the admin styles
 * @return void
 */
function stag_admin_styles( $hook ) {
	if( $hook == 'post.php' || $hook == 'post-new.php' ){
		wp_register_style( 'stag-admin-metabox', get_template_directory_uri() . '/framework/assets/css/stag-admin-metabox.css', array( 'wp-color-picker' ), STAG_FRAMEWORK_VERSION );
		wp_enqueue_style('stag-admin-metabox');
	}
}
add_action( 'admin_enqueue_scripts', 'stag_admin_styles' );

function stag_admin_scripts( $hook ) {
	if( $hook == 'post.php' || $hook == 'post-new.php' || $hook == 'widgets.php' ) {
		wp_enqueue_media();
		wp_register_script( 'stag-admin-metabox', get_template_directory_uri() . '/framework/assets/js/stag-admin-metabox.js', array( 'jquery', 'wp-color-picker' ) );
		wp_enqueue_script( 'stag-admin-metabox' );
		wp_enqueue_style( 'wp-color-picker' );
	}
	return;
}
add_action( 'admin_enqueue_scripts', 'stag_admin_scripts' );


/**
* Load Framework Files
*/
$path         = get_template_directory() . '/framework/';
$classes_path = get_template_directory() . '/framework/classes/';

require_once( $classes_path . 'class-admin-backup.php' );
require_once( $classes_path . 'class-tgm-plugin-activation.php' );

require_once( $path . 'stag-admin-interface.php' );
require_once( $path . 'stag-admin-functions.php' );
require_once( $path . 'stag-admin-metaboxes.php' );

require_once( $path . 'stag-theme-functions.php' );
require_once( $path . 'stag-theme-hooks.php' );

/**
 * Schema.org markup helper.
 *
 * @since 2.0.1.2
 */
require_once( $path . 'stag-markup-helper.php' );
