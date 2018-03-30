<?php

/**
	Air Framework : Admin Library

	The contents of this file are subject to the terms of the GNU General
	Public License Version 3.0. You may not use this file except in
	compliance with the license. Any of the license terms and conditions
	can be waived if you get permission from the copyright holder.

	Copyright (c) 2012 WPBandit
	Jermaine Maree

		@package AirAdmin
		@version 1.1
**/

class AirAdmin extends Air {

	protected
		$hooks;

	/**
		Admin actions
			@private
	**/
	private function actions() {
		// Admin init
		add_action('admin_init', array($this, 'admin_init'));
		// Admin menu
		add_action('admin_menu', array($this, 'admin_menu'));
		// Admin notices
		add_action('admin_notices', array($this, 'admin_notices'));
	}

	/**
		Admin init
			@public
	**/
	function admin_init() {
		// Set page hooks
		$this->hooks = array(
			// Theme options
			get_plugin_page_hook('theme-options','admin.php'),
			// Theme modules 
			get_plugin_page_hook('theme-modules','admin.php'),
			// More themes
			get_plugin_page_hook('more-themes','admin.php')
		);

		// Load settings, form, and validation libraries
		if ( !class_exists('AirSettings') ) {
			require ( AIR_PATH . '/lib/air-settings.php' );
		}
		require ( AIR_PATH . '/lib/air-form.php' );
		require ( AIR_PATH . '/lib/air-validate.php' );

		// Register settings
		register_setting('air-settings', self::$config['theme-options'],
			'AirValidate::init_theme');

		// Enqueue admin styles
		add_action('admin_enqueue_scripts', array($this, 'admin_styles'));

		// Enqueue admin scripts
		add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));

		// Action to create settings
		add_action('load-'.$this->hooks[0], array($this, 'theme_settings'));
		add_action('load-'.$this->hooks[1], array($this, 'module_settings'));

		// Action to create helps tabs
		add_action('load-'.$this->hooks[0], array($this, 'theme_help'));
	}

	/**
		Admin styles
			@public
	**/
	function admin_styles($hook) {
		// Only load on theme admin pages
		if ( !in_array($hook, $this->hooks) &&
				!in_array($hook, array('post.php','post-new.php')) )
			return;

		// Enqueue colorpicker stylesheet
		if ( in_array($hook, $this->hooks) ) {
			wp_enqueue_style('air-colorpicker', AIR_ASSETS . '/colorpicker.css',
				FALSE, '1.1');
		}

		// Enqueue Air stylesheet
		wp_enqueue_style('air', AIR_ASSETS . '/air.css',
			array('thickbox'), '1.1');
	}

	/**
		Admin scripts
			@public
	**/
	function admin_scripts($hook) {
		// Only load on theme admin pages
		if ( !in_array($hook, $this->hooks) &&
				!in_array($hook, array('post.php','post-new.php')) )
			return;

		// Enqueue colorpicker script
		if ( in_array($hook, $this->hooks) ) {
			wp_enqueue_script('air-colorpicker', AIR_ASSETS . '/colorpicker.js',
				array('jquery'), '1.1');
		}

		// Enqueue Air script
		wp_enqueue_script('air', AIR_ASSETS . '/air.js',
			array('media-upload', 'thickbox', 'jquery'), '1.1');
	}

	/**
		Admin menu
			@public
	**/
	function admin_menu() {
		// Set page and menu title
		$title = Air::get('theme-name','Air Framework');
		$icon_url = AIR_ASSETS . '/img/wpbandit.png';

		// Create top-level menu
		add_menu_page($title, $title, 'manage_options', 'theme-options',
			array($this, 'options_page'), $icon_url);

		// Theme options menu
		add_submenu_page('theme-options', 'Theme Options', 'Theme Options',
			'manage_options', 'theme-options', array($this, 'options_page'));
		// Theme modules menu
		add_submenu_page('theme-options', 'Theme Modules', 'Theme Modules',
			'manage_options', 'theme-modules', array($this, 'modules_page'));
	}

	/**
		Options page
			@public
	**/
	function options_page() {
		// Set menu
		$menu = Air::get_options_menu();
		// Set section
		$section = isset($_GET['section'])?$_GET['section']:key($menu);
		// Load options page
		require ( AIR_PATH . '/gui/air-options-page.php' );
	}

	/**
		Modules page
			@public
	**/
	function modules_page() {
		// Set menu
		$menu = Air::get_modules();
		// Set module
		$module = isset($_GET['module'])?$_GET['module']:key($menu);
		// Load modules page
		require ( AIR_PATH . '/gui/air-modules-page.php' );
	}

	/**
		Admin notices
			@public
	**/
	function admin_notices() {
		// Display settings erros
		settings_errors('air-settings-errors');
	}

	/**
		Theme settings
			@public
	**/
	function theme_settings() {
		// Set menu
		$menu = Air::get_options_menu();
		// Set section
		$section = isset($_GET['section'])?$_GET['section']:key($menu);
		// Set option name
		AirSettings::set_option_name(Air::get('theme-options'));
		// Define settings file
		$settings_file = AIR_THEME . '/config/settings-'.$section.'.php';
		// Load settings file, if exists
		if ( is_file($settings_file) ) {
			// Load settings
			require ( $settings_file );
			// Add sections - sections, tab
			AirSettings::add_sections($sections, $section);
			// Add settings fields
			AirSettings::add_fields($fields);
		}
	}

	/**
		Module settings
			@public
	**/
	function module_settings() {
		// Set menu
		$menu = Air::get_modules();
		// Set module
		$module = isset($_GET['module'])?$_GET['module']:key($menu);
		// Settings file path
		$module_settings_file = AIR_MODULES . '/'. $module . '/' . $module . '-settings.php';
		// Load and process module settings
		if ( is_file($module_settings_file) ) {
			// Load module settings
			require ( $module_settings_file );
			// Add sections - sections, tab
			AirSettings::add_sections($sections, $module);
			// Add settings fields
			AirSettings::add_fields($fields);
		}
	}

	/**
		Theme help
			@public
	**/
	function theme_help() {
		// Get current screen
		$screen = get_current_screen();

		// Check if theme options admin page
		if ( 'toplevel_page_theme-options' != $screen->id )
			return;

		// Get help tabs
		$tabs = Air::get('help-tabs');

		if ( $tabs ) {
			foreach ( $tabs as $key=>$value ) {
				$screen->add_help_tab(
					array(
						'id'		=> $key,
						'title'		=> $value,
						'callback'	=> array($this, 'add_help_tab')
					)
				);
			}
		}
	}

	/**
		Adds help tabs
			@public
	**/
	function add_help_tab($screen, $tab) {
		// Set help file
		$file = AIR_THEME . '/help/help-' . $tab['id'] . '.php';
		// Load help file
		if ( is_file($file) ) require ( $file );
	}

	/**
		Class constructor
			@public
	**/
	function __construct() {
		// Admin actions
		$this->actions();
	}

}

return new AirAdmin();