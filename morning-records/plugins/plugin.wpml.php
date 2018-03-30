<?php
/* WPML support functions
------------------------------------------------------------------------------- */

// Check if WPML installed and activated
if ( !function_exists( 'morning_records_exists_wpml' ) ) {
	function morning_records_exists_wpml() {
		return defined('ICL_SITEPRESS_VERSION') && class_exists('sitepress');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'morning_records_wpml_required_plugins' ) ) {
	//add_filter('morning_records_filter_required_plugins',	'morning_records_wpml_required_plugins');
	function morning_records_wpml_required_plugins($list=array()) {
		if (in_array('wpml', morning_records_storage_get('required_plugins'))) {
			$path = morning_records_get_file_dir('plugins/install/wpml.zip');
			if (file_exists($path)) {
				$list[] = array(
					'name' 		=> 'WPML',
					'slug' 		=> 'wpml',
					'source'	=> $path,
					'required' 	=> false
					);
			}
		}
		return $list;
	}
}
?>