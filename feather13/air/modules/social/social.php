<?php

/**
	Social Module :: Air Framework

	The contents of this file are subject to the terms of the GNU General
	Public License Version 2.0. You may not use this file except in
	compliance with the license. Any of the license terms and conditions
	can be waived if you get permission from the copyright holder.

	Copyright (c) 2012 WPBandit
	Jermaine Marée

		@package air_social
		@version 1.0
**/

// air_social
class air_social extends Air {

	//@{ Module variables
	protected static
		// Option Name
		$option_name = 'air-social',
		// Option
		$option,
		// URL
		$url,
		// Path
		$path;
	//@}

	/**
		Initialize module
			@public
	**/
	static function init() {
		// Get Option
		self::$option = get_option(self::$option_name);
		// Set default option
		if ( self::$option == FALSE ) {
			update_option(self::$option_name,'');
		}
		// Set Path
		self::$path = AIR_MODULES . '/social';
		// Set URL
		self::$url = get_template_directory_uri() . '/air/modules/social';
		// Admin init
		add_action('admin_init',__CLASS__.'::admin_init');
	}


	/**
		Admin init
			@public
	**/
	static function admin_init() {
		// Register settings
		register_setting(self::$option_name.'-settings', self::$option_name,
			__CLASS__.'::validate_settings');

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
		if ( isset($_GET['module']) && ('social' == $_GET['module']) ) {
			// Enqueue style
			wp_enqueue_style('air-social', self::$url.'/social.css');
			// ENqueue script
			wp_enqueue_script('air-social', self::$url.'/social.js', 
				array('jquery','jquery-ui-core','jquery-ui-sortable','jquery-ui-tabs'));
		}
	}

	/**
		Get variable
			@public
	**/
	static function get_var($name=NULL) {
		return isset(self::$$name)?self::$$name:FALSE;
	}

	/**
		Validate settings
			@public
	**/
	static function validate_settings($input) {
		// If no input, return
		if (!$input)
			return;
		
		$action = esc_attr($input['action']);

		// Add new icon
		if($action == 'new') {
			// Get current options
			$valid = get_option(self::$option_name);

			// Any options exist?
			if(!$valid) { $valid = array(); }

			// Validate input
			$tmp['url'] = esc_url($input['url']);
			$tmp['name'] = esc_attr($input['name']);
			
			// Icon
			$split = self::$url.'/icons/';
			$icon = explode($split,esc_url($input['icon']));
			$tmp['icon'] = isset($icon[1])?$icon[1]:esc_url($input['icon']);

			// New Window
			$tmp['new-window'] = isset($input['new-window'])?'1':'0';

			// Add to array
			$valid[] = $tmp;

			// Return validated settings
			return $valid;
		}

		// Update current icons
		if($action == 'update') {
			// Unset action
			unset($input['action']);
			
			// Create valid array
			$valid = array();
			
			// Loop through items for update
			foreach($input as $item) {
				$item['url'] = esc_url($item['url']);
				$item['name'] = esc_attr($item['name']);
				
				// Icon
				if(substr($item['icon'],0,4)=='http') {
					$item['icon'] = esc_url($item['icon']);
				} else {
					$item['icon'] = esc_attr($item['icon']);	
				}

				// New Window
				$item['new-window'] = isset($item['new-window'])?'1':'0';

				// Add to valid array
				$valid[] = $item;
				
				// Unset item
				unset($item);
			}

			// Return validated settings
			return $valid;
		}
	}

	/**
		Get icons
			@public
	**/
	static function get_icons($folder='default') {
		// Get images
		$icons = scandir(self::$path.'/icons/'.$folder);
		// Return images
		return $icons?$icons:FALSE;
	}

	/**
		Get icon list
			@public
	**/
	static function get_icon_list($folder='default') {
		// Get icons
		$icons = self::get_icons();
		// Build list
		if($icons) {
			$output = '<ul class="air-social-icons">';
			// Loop through icons
			foreach($icons as $icon) {
				if($icon != "." && $icon != "..")
					$output .= '<li><img src="'.self::$url.'/icons/'.$folder.'/'.$icon.'" alt="'.$icon.'" title="'.$icon.'" />';
			}
			$output .= '</ul>';
			// Return list
			return $output;
		}
	}

	/**
		Get items
			@public
	**/
	static function get_items() {
		// Get items and set URL
		$options = self::$option;
		$url = self::$url . '/icons';

		// Loop through items
		if(is_array($options)) {
			foreach($options as $key=>$item) {
				$options[$key]['icon_input'] = $options[$key]['icon'];
				# Icon
				if(substr($options[$key]['icon'],0,4) != 'http') {
					$options[$key]['icon'] = $url.'/'.$options[$key]['icon'];
				}
			}
		}
		return $options;
	}

}

// Initialize module
air_social::init();
