<?php

/**
	Maintenance Module :: Air Framework

	The contents of this file are subject to the terms of the GNU General
	Public License Version 2.0. You may not use this file except in
	compliance with the license. Any of the license terms and conditions
	can be waived if you get permission from the copyright holder.

	Copyright (c) 2012 WPBandit
	Jermaine Marée

		@package air_maintenance
		@version 1.1
**/

// air_maintenance
class air_maintenance extends Air {

	protected static
		// Option name
		$option_name = 'air-maintenance',
		// Options
		$options,
		// URL
		$url,
		// Path
		$path;

	/**
		Initialize module
			@public
	**/
	static function init() {
		// Get options
		self::$options = get_option(self::$option_name);
		
		// Set default options, if necessary
		if ( self::$options == FALSE )
			update_option(self::$option_name,'');
		
		// Set Path
		self::$path = AIR_MODULES . '/maintenance';
		// Set URL
		self::$url = get_template_directory_uri() . '/air/modules/maintenance';
		
		// Admin init
		add_action('admin_init',__CLASS__.'::admin_init');

		// Enable maintenance mode
		if ( self::get_option('maintenance-mode') )
			self::enable_maintenance_mode();
	}

	/**
		Get module option
			@public
	**/
	static function get_option($key,$default=FALSE) {
		if ( isset(self::$options[$key]) && self::$options[$key] )
			return self::$options[$key];
		else
			return $default;
	}

	/**
		Admin init
			@public
	**/
	static function admin_init() {
		// Register settings
		register_setting(self::$option_name.'-settings', self::$option_name,
			'AirValidate::init_module');
		// Enqueue admin styles and scripts
		add_action('admin_enqueue_scripts',__CLASS__.'::admin_styles_and_scripts');
	}

	/**
		Admin styles and scripts
			@public
	**/
	static function admin_styles_and_scripts($hook) {
		// Only load on theme admin pages
		if ( $hook != get_plugin_page_hook('theme-modules','admin.php') )
			return;

		// Only load for social module
		if ( isset($_GET['module']) && ('maintenance' == $_GET['module']) ) {
			// Enqueue style
			wp_enqueue_style('air-maintenance', self::$url.'/maintenance.css');
			// Enqueue script
			wp_enqueue_script('air-social', self::$url.'/maintenance.js', array('jquery'));
		}
	}

	/**
		Enable maintenance mode
			@private
	**/
	private static function enable_maintenance_mode() {
		// Set access role
		$role = self::get_option('maintenance-role','administrator');

		if(!current_user_can($role)) {
			// Exclude login,register pages
			$exclude = array('wp-login.php','wp-register.php');

			// Verify we are not trying to register or login
			if ( !in_array(self::$vars['PAGENOW'], $exclude) ) {

				// Get URI
				$uri = esc_attr($_SERVER['REQUEST_URI']);
				
				// Get URL based on permalinks
				if ( self::$vars['PERMALINKS'] ) {
					$url = substr($uri,-12);
					$redirect_url = home_url() . '/_maintenance';
				} else {
					$url = isset($_REQUEST['p'])?esc_attr($_REQUEST['p']):'';
					$redirect_url = home_url() . '/?p=_maintenance';
				}

				// Are we in admin?
				$in_admin = strstr($uri,'wp-admin');
				
				// Redirect if not maintenance URL
				if ( ('_maintenance' != $url) && !$in_admin ) {
					header('Location: '.$redirect_url,TRUE,307);
					exit;
				}
				
				// Load maintenance template
				if ( !$in_admin ) {
					require ( self::$path . '/maintenance-template.php' );
					exit(1);	
				}
			}
		}
	}

}

// Initialize module
air_maintenance::init();
