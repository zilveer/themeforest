<?php
add_action( 'admin_head', 'ocmx_add_tinymce' );
function ocmx_add_tinymce() {
	global $typenow;

	// only on Post Type: post and page
	if( ! in_array( $typenow, array( 'post', 'page' ) ) )
		return ;

	add_filter( 'mce_external_plugins', 'ocmx_add_tinymce_plugin' );
	// Add to line 1 form WP TinyMCE
	add_filter( 'mce_buttons', 'ocmx_add_tinymce_button' );
}

add_filter('admin_init', 'ocmx_mcekit_editor_style');
function ocmx_mcekit_editor_style($url) {
	if ( !empty($url) )
		$url .= ',';
	// Retrieves the plugin directory URL
	// Change the path here if using different directories
	$url .= trailingslashit( get_stylesheet_directory_uri() ) . 'editor-style.css';
	return $url;
}

add_filter('admin_init', 'ocmx_admin_editor_style');
function ocmx_admin_editor_style() {
	global $obox_themeid;
	wp_enqueue_style( $obox_themeid.'-editor-style', get_template_directory_uri().'/editor-style.css');
	add_editor_style( 'editor-style.css' );
}

// inlcude the js for tinymce
function ocmx_add_tinymce_plugin( $plugin_array ) {

	wp_localize_script( "editor", "template_directory",  get_template_directory_uri() );
	$plugin_array['oboxbutton'] = get_template_directory_uri().'/scripts/editor_styles.js';

	return $plugin_array;
}

// Add the button key for address via JS
function ocmx_add_tinymce_button( $buttons ) {

	array_push( $buttons, 'oboxbutton' );
	// Print all buttons
	return $buttons;
}