<?php

$theme_version = '';
$smof_output = '';

if( function_exists( 'wp_get_theme' ) ) {
	if( is_child_theme() ) {
		$temp_obj = wp_get_theme();
		$theme_obj = wp_get_theme( $temp_obj->get('Template') );
	} else {
		$theme_obj = wp_get_theme();
	}
	$theme_version = $theme_obj->get('Version');
	$theme_name = $theme_obj->get('Name');
	$theme_uri = $theme_obj->get('ThemeURI');
	$author_uri = $theme_obj->get('AuthorURI');
}

if( !defined('ADMIN_PATH') ) define( 'ADMIN_PATH', get_template_directory() . '/admin/' );
if( !defined('ADMIN_DIR') ) define( 'ADMIN_DIR', get_template_directory_uri() . '/admin/' );
define( 'ADMIN_IMAGES', ADMIN_DIR . 'assets/images/' );
define( 'THEMENAME', $theme_name );
define( 'BACKUPS','backups' );

/* action filters */
add_action('admin_head', 'optionsframework_admin_message');
add_action('admin_init','optionsframework_admin_init');
add_action('admin_menu', 'optionsframework_add_admin');

/* required files */ 
require_once( ADMIN_PATH . 'options.php' );
require_once( ADMIN_PATH . 'lib/functions.php' );
require_once( ADMIN_PATH . 'lib/machine.php' );

/* AJAX saving options */
add_action('wp_ajax_of_ajax_post_action', 'of_ajax_callback');
