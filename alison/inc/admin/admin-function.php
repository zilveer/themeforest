<?php
// Prevent loading this file directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

// ADMIN JS&CSS
function gorilla_custom_scripts() {
  	wp_enqueue_media();
	wp_enqueue_style( 'gorilla-admin-css', get_template_directory_uri() . '/inc/admin/assets/css/admin.css' );
	wp_enqueue_script( 'gorilla-admin-js', get_template_directory_uri() . '/inc/admin/assets/js/admin.js', '', '', true );
}

add_action('admin_head', 'gorilla_custom_scripts');

