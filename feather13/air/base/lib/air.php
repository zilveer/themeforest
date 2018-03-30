<?php

/**
	Air Framework

	The contents of this file are subject to the terms of the GNU General
	Public License Version 2.0. You may not use this file except in
	compliance with the license. Any of the license terms and conditions
	can be waived if you get permission from the copyright holder.

	Copyright (c) 2012 WPBandit
	Jermaine Maree

		@package Air
		@version 1.2
**/

// Air Framework
class Air {

	//@{ Framework details
	const
		TEXT_Name = 'Air Framework',
		TEXT_Version = '1.2';
	//@}
	
	//@{ Global variables
	protected static
		// Framework variables
		$vars,
		// Theme Configuration
		$config,
		// Theme options
		$options,
		// Theme options menu
		$options_menu,
		// Theme modules
		$modules,
		// Post/Page ID : is_singular()
		$post_id,
		// Post/Page metadata
		$metadata;
	//@}

	/**
		Set configuration option
			@public
	**/
	static function set($key,$value) {
		self::$config[$key] = $value;
	}

	/**
		Set multiple configuration options
			@public
	**/
	static function mset(array $keys) {
		if ( isset(self::$config) ) {
			array_merge(self::$config, $keys);
		} else {
			foreach ( $keys as $key=>$value ) {
				self::$config[$key] = $value;
			}
		}
	}

	/**
		Get configuration option
			@public
	**/
	static function get($key,$default=FALSE) {
		return isset(self::$config[$key])?self::$config[$key]:$default;
	}

	/**
		Get theme option
			@public
	**/
	static function get_option($key,$default=FALSE) {
		if ( isset(self::$options[$key]) && self::$options[$key] )
			return self::$options[$key];
		else
			return $default;
	}

	/**
		Set metadata ( during loop only )
			@public
	**/
	static function set_metadata($data) {
		self::$metadata = $data;
	}

	/**
		Reset metadata ( after loop )
			@public
	**/
	static function reset_metadata() {
		// Check if $post_id has been set
		if ( !isset(self::$post_id) )
			return;

		// Reset metadata
		self::$metadata = get_metadata('post', self::$post_id);
	}

	/**
		Get meta field value
			@public
	**/
	static function get_meta($key,$default=FALSE) {
		if ( isset(self::$metadata[$key]) && self::$metadata[$key] )
			return self::$metadata[$key][0];
		else
			return $default;
	}

	/**
		Add theme options menu item
			@public
	**/
	static function add_options_menu_item($slug,$title) {
		self::$options_menu[$slug] = $title;
	}

	/**
		Get theme option menu
			@public
	**/
	static function get_options_menu() {
		return isset(self::$options_menu)?self::$options_menu:FALSE;
	}

	/**
		Add module
			@public
	**/
	static function add_module($slug,$title) {
		self::$modules[$slug] = $title;
	}

	/**
		Get modules
			@public
	**/
	static function get_modules() {
		return isset(self::$modules)?self::$modules:FALSE;
	}

/**
		Set default options
			@public
	**/
	static function set_default_options() {
		// Check if theme options are set
		if ( isset(self::$options) && self::$options )
			return;
		// Load settings library
		if ( !class_exists('AirSettings') )
			require ( AIR_PATH . '/lib/air-settings.php' );
		// Set default options
		AirSettings::set_default_options();
	}

	/**
		Bootstrap code
			@public
	**/
	function start() {
		// Prohibit multiple calls
		if ( self::$vars )
			return;

		// Define framework constants
		define ( 'AIR_PATH',	get_template_directory() . '/air/base' );
		define ( 'AIR_THEME',	get_template_directory() . '/air/theme' );
		define ( 'AIR_MODULES',	get_template_directory() . '/air/modules' );
		define ( 'AIR_WIDGETS',	get_template_directory() . '/widgets' );

		define ( 'AIR_URL',		get_template_directory_uri() . '/air/base' );
		define ( 'AIR_ASSETS',	AIR_URL . '/assets' );

		// Global $pagenow variable
		global $pagenow;

		// Permalinks structure
		$permalinks = get_option('permalink_structure');

		// Hydrate framework variables
		self::$vars = array(
			// Global $pagenow variable
			'PAGENOW' => $pagenow,
			// Permalinks
			'PERMALINKS' => ($permalinks && ($permalinks != ''))?TRUE:FALSE,
			// Static front page
			'STATIC' => ('page' === get_option('show_on_front'))?TRUE:FALSE,
		);
	}

	/**
		Process framework configuration
			@public
	**/
	function run() {
		// Load framework functions
		require ( AIR_PATH . '/lib/air-functions.php' );

		// Set theme name
		if ( !isset(self::$config['theme-name']) )
			self::$config['theme-name'] = wp_get_theme()->Name;

		// Set theme version
		if ( !isset(self::$config['theme-version']) )
			self::$config['theme-version'] = wp_get_theme()->Version;

		// Set theme options name
		if ( !isset(self::$config['theme-options']) )
			self::$config['theme-options'] = 'air-options';

		// Get theme options
		self::$options = get_option(self::$config['theme-options']);

		// Admin and meta libraries
		if ( is_admin() ) {
			require ( AIR_PATH . '/lib/air-admin.php' );
			require ( AIR_PATH . '/lib/air-meta.php' );
		}

		// Load Air modules
		if ( self::get_modules() ) {
			foreach ( self::$modules as $key=>$module ) {
				require ( AIR_MODULES . '/' . $key . '/' . $key.'.php' );
			}
		}

		// Add meta boxes (custom fields)
		if ( is_admin() && isset(self::$config['meta-files']) )
			$this->meta_boxes();

		// Setup theme
		add_action('wp', array($this, 'action_get_metadata'));
		add_action('widgets_init', array($this, 'register_widgets'));
		add_action('widgets_init', array($this, 'register_sidebars'));
		add_action('after_setup_theme', array($this, 'action_setup_theme'));
		add_action('wp_enqueue_scripts', array($this, 'action_register_styles'));
		add_action('wp_enqueue_scripts', array($this, 'action_register_scripts'));

		// Load theme-specific functions
		if ( is_file( AIR_THEME . '/theme.php' ) )
			require ( AIR_THEME . '/theme.php' );

		// Load custom-functions.php
		if ( is_file( get_template_directory() . '/custom-functions.php' ) )
			require ( get_template_directory() . '/custom-functions.php' );
	}

	/**
		Add meta boxes in dashboard
			@private
	**/
	private function meta_boxes() {
		// Pages to apply custom fields
		$pages = array('post.php','post-new.php');
		// Check page
		if( !in_array(self::$vars['PAGENOW'],$pages) )
			return;
		// Set files and folder
		$files = Air::get('meta-files');
		$folder = AIR_THEME . '/config';
		// Initialize meta library
		AirMeta::init($files,$folder);
	}

	/**
		Get metadata for single post/page
			@public
	**/
	function action_get_metadata() {
		// Check if singular page
		if ( !is_singular() )
			return;

		// Get post ID
		self::$post_id = get_queried_object_id();
		
		// Set metadata
		self::$metadata = get_metadata('post', self::$post_id);
	}

	/**
		Widgets
			@public
	**/
	function register_widgets() {
		if ( !isset(self::$config['widgets']) || !is_array(self::$config['widgets']) )
			return;

		// Loop through widgets
		foreach ( self::$config['widgets'] as $name=>$class ) {
			require ( AIR_WIDGETS . '/' . $name . '.php' );
			register_widget($class);
		}
	}

	/**
		Register sidebars
			@public
	**/
	function register_sidebars() {
		// Are sidebars configured ?
		if ( !isset(self::$config['sidebars']) || !is_array(self::$config['sidebars']) )
			return;

		// Loop through sidebars
		foreach ( self::$config['sidebars'] as $sidebar) {
			// Single Sidebar
			if ( !isset($sidebar['count']) ) {
				register_sidebar($sidebar);
			}
			// Multiple Sidebars
			if ( isset($sidebar['count']) ) {
				$count = $sidebar['count'];
				unset($sidebar['count']);
				register_sidebars($count,$sidebar);
			}
		}
	}

	/**
		Setup theme
			@public
	**/
	function action_setup_theme() {
		// Theme text domain
		if ( isset(self::$config['text-domain']) )
			load_theme_textdomain(self::$config['text-domain'], get_template_directory().'/languages');

		// Register nav menus
		if ( isset(self::$config['nav-menus']) )
			register_nav_menus(self::$config['nav-menus']);

		// Theme features
		if ( isset(self::$config['features']) ) {
			foreach ( self::$config['features'] as $key=>$value ) {
				if ( $value && is_bool($value) ) {
					add_theme_support($key);
				} elseif ( $value && is_array($value) ) {
					add_theme_support($key, $value);
				}
			}
		}

		// Image sizes
		if ( isset(self::$config['features']['post-thumbnails']) &&
				isset(self::$config['image-sizes']) ) {
			foreach ( self::$config['image-sizes'] as $size ) {
				// Set crop attribute
				if ( !isset($size['crop']) )
					$size['crop'] = FALSE;
				extract($size);
				add_image_size($name,$width,$height,$crop);
			}
		}
	}

	/**
		Register styles
			@public
	**/
	function action_register_styles() {
		if ( !isset(self::$config['styles']) )
			return;

		// Defaults
		$defaults = array(
			'deps'		=> FALSE,
			'ver'		=> '1.0',
			'media'		=> 'all'
		);

		// Loop through styles and register
		foreach ( self::$config['styles'] as $style ) {
			// Parse $style and merge with $defaults
			extract(wp_parse_args($style,$defaults));
			// Register style
			wp_register_style($handle,$src,$deps,$ver,$media);
		}
	}

	/**
		Register scripts
			@public
	**/
	function action_register_scripts() {
		if ( !isset(self::$config['scripts']) )
			return;

		// Defaults
		$defaults = array(
			'deps'		=> FALSE,
			'ver'		=> '1.0',
			'footer'	=> FALSE
		);

		// Loop through scripts and register
		foreach ( self::$config['scripts'] as $script ) {
			// Parse $script and merge with $defaults
			extract(wp_parse_args($script,$defaults));
			// Register script
			wp_register_script($handle,$src,$deps,$ver,$footer);
		}
	}

	/**
		Class constructor
			@param $boot bool
			@public
	**/
	function __construct($boot=FALSE) {
		if ( $boot )
			$this->start();
	}

}

// Bootstrap framework
return new Air(TRUE);
