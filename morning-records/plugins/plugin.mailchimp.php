<?php
/* Mail Chimp support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('morning_records_mailchimp_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_mailchimp_theme_setup', 1 );
	function morning_records_mailchimp_theme_setup() {
		if (morning_records_exists_mailchimp()) {
			if (is_admin()) {
				add_filter( 'morning_records_filter_importer_options',				'morning_records_mailchimp_importer_set_options' );
			}
		}
		if (is_admin()) {
			add_filter( 'morning_records_filter_importer_required_plugins',		'morning_records_mailchimp_importer_required_plugins', 10, 2 );
			add_filter( 'morning_records_filter_required_plugins',					'morning_records_mailchimp_required_plugins' );
		}
	}
}

// Check if Instagram Feed installed and activated
if ( !function_exists( 'morning_records_exists_mailchimp' ) ) {
	function morning_records_exists_mailchimp() {
		return function_exists('mc4wp_load_plugin');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'morning_records_mailchimp_required_plugins' ) ) {
	//add_filter('morning_records_filter_required_plugins',	'morning_records_mailchimp_required_plugins');
	function morning_records_mailchimp_required_plugins($list=array()) {
		if (in_array('mailchimp', morning_records_storage_get('required_plugins')))
			$list[] = array(
				'name' 		=> 'MailChimp for WP',
				'slug' 		=> 'mailchimp-for-wp',
				'required' 	=> false
			);
		return $list;
	}
}



// One-click import support
//------------------------------------------------------------------------

// Check Mail Chimp in the required plugins
if ( !function_exists( 'morning_records_mailchimp_importer_required_plugins' ) ) {
	//add_filter( 'morning_records_filter_importer_required_plugins',	'morning_records_mailchimp_importer_required_plugins', 10, 2 );
	function morning_records_mailchimp_importer_required_plugins($not_installed='', $list='') {
		//if (in_array('mailchimp', morning_records_storage_get('required_plugins')) && !morning_records_exists_mailchimp() )
		if (morning_records_strpos($list, 'mailchimp')!==false && !morning_records_exists_mailchimp() )
			$not_installed .= '<br>Mail Chimp';
		return $not_installed;
	}
}

// Set options for one-click importer
if ( !function_exists( 'morning_records_mailchimp_importer_set_options' ) ) {
	//add_filter( 'morning_records_filter_importer_options',	'morning_records_mailchimp_importer_set_options' );
	function morning_records_mailchimp_importer_set_options($options=array()) {
		if ( in_array('mailchimp', morning_records_storage_get('required_plugins')) && morning_records_exists_mailchimp() ) {
			// Add slugs to export options for this plugin
			$options['additional_options'][] = 'mc4wp_lite_checkbox';
			$options['additional_options'][] = 'mc4wp_lite_form';
		}
		return $options;
	}
}
?>