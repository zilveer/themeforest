<?php

/**
	Sidebar Module :: Air Framework

	The contents of this file are subject to the terms of the GNU General
	Public License Version 2.0. You may not use this file except in
	compliance with the license. Any of the license terms and conditions
	can be waived if you get permission from the copyright holder.

	Copyright (c) 2012 WPBandit
	Jermaine Marée

		@package air_sidebar
		@version 1.0
**/

// air_sidebar
class air_sidebar {

	protected static
		// Option name
		$option_name = 'air-sidebar',
		// Options
		$options,
		// URL
		$url,
		// Path
		$path;

	private static
		// Templates
		$templates = array(
			'sidebar-front-page',
			'sidebar-home',
			'sidebar-404',
			'sidebar-archive',
			'sidebar-page',
			'sidebar-search',
			'sidebar-single'
		);

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
		self::$path = AIR_MODULES . '/sidebar';
		// Set URL
		self::$url = get_template_directory_uri() . '/air/modules/sidebar';
		
		// Admin init
		add_action('admin_init',__CLASS__.'::admin_init');

		// Register sidebar
		if ( self::get_sidebars() )
			add_action('widgets_init', __CLASS__.'::register_sidebars');

		// Meta fields
		self::metadata();
	}

	/**
		Get variable
			@public
	**/
	static function get_var($name=NULL) {
		return isset(self::$$name)?self::$$name:FALSE;
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
		if ( isset($_GET['module']) && ('sidebar' == $_GET['module']) ) {
			// Enqueue style
			wp_enqueue_style('air-sidebar', self::$url.'/sidebar.css');
			// ENqueue script
			wp_enqueue_script('air-sidebar', self::$url.'/sidebar.js', array('jquery'));
		}
	}

	/**
		Validate settings
			@public
	**/
	static function validate_settings($input) {
		// If no input, return
		if (!$input)
			return;

		// Get and unset action
		$action = esc_attr($input['action']);
		unset($input['action']);

		// Add new sidebar
		if($action == 'new') {
			// Get current options
			$valid = get_option(self::$option_name);

			// Any options exist?
			if(!$valid) { $valid = array(); }

			// Validate name
			$tmp['name'] = esc_attr($input['name']);

			// Validate id
			if ( $input['id'] ) {
				$tmp['id'] = sanitize_title($input['id']);
			} else {
				$tmp['id'] = sanitize_title($input['name']);
			}

			// Add prefix if necessary
			if ( strpos($tmp['id'],'air-') === false ) {
				$tmp['id'] = 'air-' . $tmp['id'];
			}

			// Add to array
			$valid['sidebars'][$tmp['id']] = $tmp['name'];

			// Return validated settings
			return $valid;
		}

		// Update current icons
		if($action == 'update') {
			// Create valid array
			$valid = array();
			
			// Are sidebars set ?
			if ( isset($input['sidebars']) ) {
				// Loop through sidebars for update
				foreach($input['sidebars'] as $sidebar) {
					
					// Validate name
					$tmp['name'] = esc_attr($sidebar['name']);

					// Validate id
					if ( $sidebar['id'] ) {
						$tmp['id'] = sanitize_title($sidebar['id']);
					} else {
						$tmp['id'] = sanitize_title($sidebar['name']);
					}

					// Add prefix if necessary
					if ( strpos($tmp['id'],'air-') === false ) {
						$tmp['id'] = 'air-' . $tmp['id'];
					}

					// Add to valid array
					$valid['sidebars'][$tmp['id']] = $tmp['name'];

					// Unset tmp variable
					unset($tmp);
				}

				// Loop through templates
				foreach ( self::$templates as $template ) {
					// Set template value
					$value = esc_attr($input[$template]);

					// Validate template
					if ( isset($valid['sidebars'][$value]) ) {
						$valid[$template] = $value;
					} else {
						$valid[$template] = '0';
					}
				}
			}

			// Return validated settings
			return $valid;
		}
	}

	/**
		Get sidebars
			@public
	**/
	static function get_sidebars() {
		// Get sidebars
		$sidebars = self::get_option('sidebars');
		// Sort by name
		if ( $sidebars ) { asort($sidebars); }
		// Return sidebars
		return $sidebars;
	}

	/**
		Get choices
			@public
	**/
	static function get_choices() {
		// Set default choice
		$choices = array('0' => 'Default');
		// Add sidebars to choices
		if ( self::get_sidebars() ) {
			$choices = $choices + self::get_sidebars();
		}
		// Return choices
		return $choices;
	}

	/**
		Register sidebars
			@public
	**/
	static function register_sidebars() {
		// Process and register sidebar
		foreach ( self::get_sidebars() as $id=>$name ) {
			// Sidebar settings
			$sidebar = array(
				'id'			=> $id,
				'name'			=> $name,
				'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
				'after_widget'	=> '</li>',
				'before_title'	=> '<h3 class="widget-title fix"><span>',
				'after_title'	=> '</span></h3>',
			);
			// Register sidebars
			register_sidebar($sidebar);
		}
	}

/**
		Add metadata
			@private
	**/
	private static function metadata() {
		// $pagenow variable
		global $pagenow;
		// Pages to apply custom fields
		$pages = array('post.php','post-new.php');
		// Check page
		if( !in_array($pagenow,$pages) )
			return;
		// Set files
		$files = array('sidebar-meta.php');
		// Initialize meta library
		AirMeta::init($files,self::$path);
	}

	/**
		Sidebar dropdown
			@public
	**/
	static function dropdown($field) {
		// Get field value
		$value = self::get_option($field);
		// Set attributes
		$attrs = array(
			'name' => 'air-sidebar['.$field.']'
		);
		// Build dropdown
		$output = AirForm::select($attrs,$value,self::get_choices());
		// Return dropdown
		return $output;
	}

}

// Initialize module
air_sidebar::init();
