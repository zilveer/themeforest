<?php

add_action('admin_head', 'theme_admin_head');
function theme_admin_head() {

}

// Include JS
add_action('admin_enqueue_scripts', 'theme_admin_scripts');
function theme_admin_scripts( $page ) {
	
	if( !in_array( $page, array( 'edit.php', 'post.php', 'post-new.php', 'widget.php', 'appearance_page_theme_options') ) ) return;

	// jQuery
	wp_enqueue_script( 'jquery' );

	// jQuery UI - Sortable - Drag & Drop
	wp_enqueue_script( 'jquery-ui-core' );

	// WordPress Media Upload
	wp_enqueue_media();

	// Iris Color Picker
	wp_enqueue_script('iris');

	// iPhone style checkbox
	wp_enqueue_script('iphone-style-checkboxes-script', THEME_FRAMEWORK_ASSETS_URI . '/js/iphone-style-checkboxes.js', false, THEME_VERSION, true);
	wp_enqueue_script('iphone-style-tri-toggle', THEME_FRAMEWORK_ASSETS_URI . '/js/iphone-style-tri-toggle.js', false, THEME_VERSION, true);

	// jQuery Date Picker
	wp_enqueue_script('bootstrap-date-picker', THEME_FRAMEWORK_ASSETS_URI . '/js/bootstrap-datepicker.js', false, THEME_VERSION, true);

	// Input Slider
	wp_enqueue_script('simple-slider', THEME_FRAMEWORK_ASSETS_URI . '/js/simple-slider.min.js', false, THEME_VERSION, true);

	// Admin JS
	wp_enqueue_script('theme-admin-script', THEME_FRAMEWORK_ASSETS_URI . '/js/base-admin.js', false, THEME_VERSION, true);
}

// Include CSS
add_action('admin_enqueue_scripts', 'theme_admin_styles');
function theme_admin_styles( $page ) {
	
	if( !in_array( $page, array( 'edit.php', 'post.php', 'post-new.php', 'widget.php', 'toplevel_page_theme_setting', 'grizzly_page_theme_document', 'appearance_page_theme_options') ) ) return;
	
	// WordPress Media Upload
	wp_enqueue_style('thickbox');

	wp_enqueue_style( 'font-awesome', THEME_FRAMEWORK_ASSETS_URI . '/css/font-awesome.min.css', true, THEME_VERSION );

	// jQuery Datepicker
	wp_enqueue_style('bootstrap-datepicker', THEME_FRAMEWORK_ASSETS_URI . '/css/datepicker.css', false, THEME_VERSION);
	
	// Admin Style
	wp_enqueue_style('theme-admin-style', THEME_FRAMEWORK_ASSETS_URI . '/css/style.css', false, THEME_VERSION);
}

// Widget JS
add_action('admin_enqueue_scripts', 'theme_admin_widget_scripts');
function theme_admin_widget_scripts($page) {
	if( 'widgets.php' != $page ) return;
	
	// Widget Admin
	wp_enqueue_script('widget-admin-script', THEME_FRAMEWORK_ASSETS_URI . '/js/base-widget-admin.js', false, THEME_VERSION);
	
}
