<?php
if (! defined ( 'IAMD_BASE_URL' )) {
	define ( 'IAMD_BASE_URL', get_template_directory_uri () . '/' );
}
define ( 'IAMD_FW_URL', IAMD_BASE_URL . 'framework/' );
define ( 'IAMD_FW', get_template_directory() . '/framework/' );
define ( 'IAMD_CORE_PLUGIN', WP_PLUGIN_DIR.'/designthemes-core-features' );
define ( 'IAMD_THEME_SETTINGS', 'mytheme' );

/*
 * Define IAMD_THEME_NAME Objective: Used to show theme name where ever needed( eg: in widgets title ar the back-end).
 */
// get themedata version wp 3.4+
if (function_exists ( 'wp_get_theme' )) :
	$theme_data = wp_get_theme ();
	define ( 'IAMD_THEME_NAME', $theme_data->get ( 'Name' ) );
	define ( 'IAMD_THEME_FOLDER_NAME', $theme_data->template );
	define ( 'IAMD_THEME_VERSION', ( float ) $theme_data->get ( 'Version' ) );
endif;

define ( 'IAMD_SAMPLE_FONT', __ ( 'The quick brown fox jumps over the lazy dog', 'iamd_text_domain' ) );

if (! isset ( $content_width ))
	$content_width = 840;
	
// BACKEND DETAILS WILL BE IN include.php
require_once (get_template_directory () . '/framework/include.php'); 

define ( 'BP_AVATAR_THUMB_WIDTH', 70 );
define ( 'BP_AVATAR_THUMB_HEIGHT', 70 );

$page_layout = dt_theme_option('specialty', 'global-page-layout');
$GLOBALS['page_layout'] = !empty($page_layout) ? $page_layout : 'content-full-width';
$GLOBALS['force_enable'] = dt_theme_option('specialty', 'force-enable-global-layout'); ?>