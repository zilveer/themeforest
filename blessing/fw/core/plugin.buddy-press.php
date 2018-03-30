<?php
/* BuddyPress support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('ancora_buddypress_theme_setup')) {
	add_action( 'ancora_action_before_init_theme', 'ancora_buddypress_theme_setup' );
	function ancora_buddypress_theme_setup() {
		if (ancora_is_buddypress_page()) {
			add_action( 'ancora_action_add_styles', 'ancora_buddypress_frontend_scripts' );
			// Detect current page type, taxonomy and title (for custom post_types use priority < 10 to fire it handles early, than for standard post types)
			add_filter('ancora_filter_detect_inheritance_key',	'ancora_buddypress_detect_inheritance_key', 9, 1);
		}
	}
}
if ( !function_exists( 'ancora_buddypress_settings_theme_setup2' ) ) {
	add_action( 'ancora_action_before_init_theme', 'ancora_buddypress_settings_theme_setup2', 3 );
	function ancora_buddypress_settings_theme_setup2() {
		if (ancora_exists_buddypress()) {
			ancora_add_theme_inheritance( array('buddypress' => array(
				'stream_template' => 'buddypress',
				'single_template' => '',
				'taxonomy' => array(),
				'taxonomy_tags' => array(),
				'post_type' => array(),
				'override' => 'page'
				) )
			);
		}
	}
}

// Check if BuddyPress installed and activated
if ( !function_exists( 'ancora_exists_buddypress' ) ) {
	function ancora_exists_buddypress() {
		return class_exists( 'BuddyPress' );
	}
}

// Check if current page is BuddyPress page
if ( !function_exists( 'ancora_is_buddypress_page' ) ) {
	function ancora_is_buddypress_page() {
		return  ancora_is_bbpress_page() || (function_exists('is_buddypress') && is_buddypress());
	}
}

// Filter to detect current page inheritance key
if ( !function_exists( 'ancora_buddypress_detect_inheritance_key' ) ) {
	//add_filter('ancora_filter_detect_inheritance_key',	'ancora_buddypress_detect_inheritance_key', 9, 1);
	function ancora_buddypress_detect_inheritance_key($key) {
		if (!empty($key)) return $key;
		return ancora_is_buddypress_page() ? 'buddypress' : '';
	}
}

// Enqueue BuddyPress custom styles
if ( !function_exists( 'ancora_buddypress_frontend_scripts' ) ) {
	//add_action( 'ancora_action_add_styles', 'ancora_buddypress_frontend_scripts' );
	function ancora_buddypress_frontend_scripts() {
		ancora_enqueue_style( 'buddypress-style',  ancora_get_file_url('css/buddypress-style.css'), array(), null );
	}
}

?>