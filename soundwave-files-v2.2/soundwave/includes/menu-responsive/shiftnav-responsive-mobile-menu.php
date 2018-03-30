<?php
/*
Plugin Name: ShiftNav - Responsive Mobile Menu
Plugin URI: http://shiftnav.io
Description: An off-canvas mobile menu for WordPress
Author: Chris Mavricos, SevenSpark
Author URI: http://sevenspark.com
License: GPLv2
Version: 0.1

Copyright (C) 2014 Chris Mavricos, SevenSpark
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'ShiftNav' ) ) :

final class ShiftNav {
	/** Singleton *************************************************************/

	private static $instance;
	private static $settings_api;
	private static $skins;
	private static $settings_defaults;
	private static $registered_icons;

	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new ShiftNav;
			self::$instance->setup_constants();
			self::$instance->includes();
		}
		return self::$instance;
	}

	/**
	 * Setup plugin constants
	 *
	 * @since 1.0
	 * @access private
	 * @uses plugin_dir_path() To generate plugin path
	 * @uses plugin_dir_url() To generate plugin url
	 */
	private function setup_constants() {
		// Plugin version

		if( ! defined( 'SHIFTNAV_VERSION' ) )
			define( 'SHIFTNAV_VERSION', '0.1' );

		if( ! defined( 'SHIFTNAV_PRO' ) )
			define( 'SHIFTNAV_PRO', false );

		if( ! defined( 'SHIFTNAV_BASENAME' ) )
			define( 'SHIFTNAV_BASENAME' , plugin_basename( __FILE__ ) );

		// Plugin Folder URL
		if( ! defined( 'SHIFTNAV_URL' ) )
			define( 'SHIFTNAV_URL', '/wp-content/themes/soundwave/shiftnav-responsive-mobile-menu/' );

		// Plugin Folder Path
		if( ! defined( 'SHIFTNAV_DIR' ) )
			define( 'SHIFTNAV_DIR', plugin_dir_path( __FILE__ ) );

		// Plugin Root File
		if( ! defined( 'SHIFTNAV_FILE' ) )
			define( 'SHIFTNAV_FILE', __FILE__ );

		if( ! defined( 'SHIFTNAV_MENU_ITEM_META_KEY' ) )
			define( 'SHIFTNAV_MENU_ITEM_META_KEY' , '_shiftnav_settings' );

		define( 'SHIFTNAV_PREFIX' , 'shiftnav_' );
		
	}

	private function includes() {
		
		require_once SHIFTNAV_DIR . 'includes/ShiftNavWalker.class.php';
		//require_once SHIFTNAV_DIR . 'includes/icons.php';
		require_once SHIFTNAV_DIR . 'includes/functions.php';
		require_once SHIFTNAV_DIR . 'includes/shiftnav.api.php';
		

		require_once SHIFTNAV_DIR . 'admin/admin.php';

		if( SHIFTNAV_PRO ) require_once SHIFTNAV_DIR . 'pro/shiftnav.pro.php';

	}

	public function settings_api(){
		if( self::$settings_api == null ){
			self::$settings_api = new ShiftNav_Settings_API();
		}
		return self::$settings_api;
	}

	public function get_skins(){
		return self::$skins;
	}
	public function register_skin( $id , $title , $src ){
		if( self::$skins == null ){
			self::$skins = array();
		}
		self::$skins[$id] = array(
			'title'	=> $title,
			'src'	=> $src,
		);

		wp_register_style( 'shiftnav-'.$id , $src );
	}

	public function set_defaults( $fields ){

		if( self::$settings_defaults == null ) self::$settings_defaults = array();

		foreach( $fields as $section_id => $ops ){

			self::$settings_defaults[$section_id] = array();

			foreach( $ops as $op ){
				self::$settings_defaults[$section_id][$op['name']] = isset( $op['default'] ) ? $op['default'] : '';
			}
		}

		//shiftp( $this->settings_defaults );

	}

	function get_defaults( $section = null ){
		if( self::$settings_defaults == null ) self::set_defaults( shiftnav_get_settings_fields() );

		if( $section != null && isset( self::$settings_defaults[$section] ) ) return self::$settings_defaults[$section];
		
		return self::$settings_defaults;
	}

	function get_default( $option , $section ){

		if( self::$settings_defaults == null ) self::set_defaults( shiftnav_get_settings_fields() );

		$default = '';

		//echo "[[$section|$option]]  ";
		if( isset( self::$settings_defaults[$section] ) && isset( self::$settings_defaults[$section][$option] ) ){
			$default = self::$settings_defaults[$section][$option];
		}
		return $default;
	}

	function register_icons( $group , $iconmap ){
		if( !is_array( self::$registered_icons ) ) self::$registered_icons = array();
		self::$registered_icons[$group] = $iconmap;
	}
	function degister_icons( $group ){
		if( is_array( self::$registered_icons ) && isset( self::$registered_icons[$group] ) ){
			unset( self::$registered_icons[$group] );
		}
	}
	function get_registered_icons(){ //$group = '' ){
		return self::$registered_icons;
	}

}

/*
 * If the class already exists, and we're running ShiftNav Pro, 
 * ShiftNav free needs to be deactivated
 */
elseif ( defined( 'SHIFTNAV_PRO' ) && SHIFTNAV_PRO ) :

	function deactivate_shiftnav() {
		if ( is_plugin_active('shiftnav/shiftnav.php') ) {
			//echo 'deactivate shiftnav';
			deactivate_plugins('shiftnav/shiftnav.php');    
		}
	}
	add_action( 'admin_init', 'deactivate_shiftnav' );

	//or
	function shiftnav_duplicate_warning(){
		echo '<div class="error"><p><strong>Attempting to disable ShiftNav [Free]</strong>.  Please be sure that the free version of ShiftNav has been disabled in order to use ShiftNav Pro</p></div>';
	}
	add_action( 'admin_notices' , 'shiftnav_duplicate_warning' );


endif; // End if class_exists check

if( !function_exists( '_SHIFTNAV' ) ){
	function _SHIFTNAV() {
		return ShiftNav::instance();
	}
	_SHIFTNAV();
}

