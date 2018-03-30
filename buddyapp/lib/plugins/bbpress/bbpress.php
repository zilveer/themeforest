<?php

/* 
 * bbPress specific configurations
 * @package WordPress
 * @subpackage Kleo
 * @author SeventhQueen <themesupport@seventhqueen.com>
 * @since Kleo 1.0
 */


//register our own css file
if( ! is_admin() ){
	add_action( 'bbp_enqueue_scripts', 'kleo_bbpress_register_style',15 );
}


function kleo_bbpress_register_style()
{
	wp_dequeue_style( 'bbp-default-bbpress' );
	wp_dequeue_style( 'bbp-default' );

	wp_enqueue_style( 'kleo-bbpress', KLEO_LIB_URI.'/plugins/bbpress/less/bbpress.css');
}

/* Load our Less file */
add_filter('kleo_less_files', 'kleo_bbp_add_less_file');

function kleo_bbp_add_less_file( $less_files ) {
	$less_files[THEME_DIR . "/lib/plugins/bbpress/less/dynamic/bbpress.less"] = '';

	return $less_files;
}

/* Regenerate theme css on plugin activate/deactivate */
function kleo_bbp_detect_plugin_change( $plugin, $network_activation ) {
	if ( $plugin == 'bbpress/bbpress.php' ) {
		kleo_unlink_dynamic_css();
	}
}
add_action( 'activated_plugin', 'kleo_bbp_detect_plugin_change', 10, 2 );
add_action( 'deactivated_plugin', 'kleo_bbp_detect_plugin_change', 10, 2 );




function kleo_bbp_no_breadcrumb ($param) {
    return true;
}
add_filter ( 'bbp_no_breadcrumb', 'kleo_bbp_no_breadcrumb' );