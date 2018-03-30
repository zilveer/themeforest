<?php
/*
*	openframe
*	written by stefano giliberti (stfno@me.com),
*	opendept.net
*/

function op_panel_menu() {
	$op_panel_hook = add_theme_page( __( 'Theme Options', 'openframe' ), __( 'Theme Options', 'openframe' ), 'switch_themes', op_config( 'theme' ), 'op_panel_display' );
	add_action( 'admin_print_styles-' . $op_panel_hook, 'op_panel_css' );
	add_action( 'admin_print_scripts-' . $op_panel_hook, 'op_panel_js' );
}

add_action( 'admin_menu', 'op_panel_menu' );

function op_panel_display() {
	require_once( op_config( 'panel_includes' ) . '/template.php' );
	require_once( op_config( 'panel' ) . '/display.php' );
}

function op_panel_css() {
	wp_register_style( 'op_panel',  op_config( 'panel_includes_uri' ) . '/html/style.css', '', op_config( '$' ) );
	wp_enqueue_style( 'op_panel' );	
}

function op_panel_js() {
	wp_register_script( 'op_panel_js', op_config( 'panel_includes_uri' ) . '/html/js/openframe.js', '', op_config( '$' ), 1 );
	wp_localize_script( 'op_panel_js', 'op_panel_ref', wp_create_nonce( 'op-panel-ajax' ) );
	wp_enqueue_media();
	wp_enqueue_script( array( 'iris', 'media-upload', 'op_panel_js' ) );
}

function op_panel_helpers() {
	require_once( op_config( 'panel_includes' ) . '/helper.php' );
}

add_action( 'admin_init', 'op_panel_helpers' );

?>