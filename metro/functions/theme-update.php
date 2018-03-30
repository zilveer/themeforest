<?php

if(is_admin()) {
	
	require_once (TEMPLATEPATH . '/libraries/envato-theme-updater/envato-wp-theme-updater.php');
	
	function om_theme_updater_init() {
		
		$username = get_option(OM_THEME_PREFIX . 'envato_username');
		$key = get_option(OM_THEME_PREFIX . 'envato_api');
		
		if($username && $key) {
			
			$theme_data = wp_get_theme(get_option('template'));
			Envato_WP_Theme_Updater::init( $username, $key, $theme_data->get( 'Author' ) );
		
		}
	}
	
	om_theme_updater_init();
	
}