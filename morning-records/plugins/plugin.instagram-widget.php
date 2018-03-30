<?php
/* Instagram Widget support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('morning_records_instagram_widget_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_instagram_widget_theme_setup', 1 );
	function morning_records_instagram_widget_theme_setup() {
		if (morning_records_exists_instagram_widget()) {
			add_action( 'morning_records_action_add_styles', 						'morning_records_instagram_widget_frontend_scripts' );
		}
		if (is_admin()) {
			add_filter( 'morning_records_filter_importer_required_plugins',		'morning_records_instagram_widget_importer_required_plugins', 10, 2 );
			add_filter( 'morning_records_filter_required_plugins',					'morning_records_instagram_widget_required_plugins' );
		}
	}
}

// Check if Instagram Widget installed and activated
if ( !function_exists( 'morning_records_exists_instagram_widget' ) ) {
	function morning_records_exists_instagram_widget() {
		return function_exists('wpiw_init');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'morning_records_instagram_widget_required_plugins' ) ) {
	//add_filter('morning_records_filter_required_plugins',	'morning_records_instagram_widget_required_plugins');
	function morning_records_instagram_widget_required_plugins($list=array()) {
		if (in_array('instagram_widget', morning_records_storage_get('required_plugins')))
			$list[] = array(
					'name' 		=> 'Instagram Widget',
					'slug' 		=> 'wp-instagram-widget',
					'required' 	=> false
				);
		return $list;
	}
}

// Enqueue custom styles
if ( !function_exists( 'morning_records_instagram_widget_frontend_scripts' ) ) {
	//add_action( 'morning_records_action_add_styles', 'morning_records_instagram_widget_frontend_scripts' );
	function morning_records_instagram_widget_frontend_scripts() {
		if (file_exists(morning_records_get_file_dir('css/plugin.instagram-widget.css')))
			morning_records_enqueue_style( 'morning_records-plugin.instagram-widget-style',  morning_records_get_file_url('css/plugin.instagram-widget.css'), array(), null );
	}
}



// One-click import support
//------------------------------------------------------------------------

// Check Instagram Widget in the required plugins
if ( !function_exists( 'morning_records_instagram_widget_importer_required_plugins' ) ) {
	//add_filter( 'morning_records_filter_importer_required_plugins',	'morning_records_instagram_widget_importer_required_plugins', 10, 2 );
	function morning_records_instagram_widget_importer_required_plugins($not_installed='', $list='') {
		//if (in_array('instagram_widget', morning_records_storage_get('required_plugins')) && !morning_records_exists_instagram_widget() )
		if (morning_records_strpos($list, 'instagram_widget')!==false && !morning_records_exists_instagram_widget() )
			$not_installed .= '<br>WP Instagram Widget';
		return $not_installed;
	}
}
?>