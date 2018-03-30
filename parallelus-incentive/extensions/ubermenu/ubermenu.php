<?php
/*
Plugin Name: UberMenu 3 - The Ultimate WordPress Mega Menu
Plugin URI: http://wpmegamenu.com
Description: Easily create beautiful, flexible, responsive mega menus 
Author: Chris Mavricos, SevenSpark
Author URI: http://sevenspark.com
Version: 3.0.5-LITE
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;


if ( !class_exists( 'UberMenu' ) ) :

final class UberMenu {

	/** Singleton *************************************************************/

	private static $instance;
	private static $settings_api;
	private static $skins;
	private static $settings_defaults;
	private static $settings_fields = false;
	
	private static $registered_icons;
	private static $registered_fonts;

	private static $item_styles;

	private $current_config = 'main';

	private $theme_location_counts = array();
	private $main_taken = false;

	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new UberMenu;
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
		define( 'UBERMENU_VERSION', '3.0.5-LITE' );

		//Override in wp-config.php

		if( ! defined( 'UBERMENU_PRO' ) )
			define( 'UBERMENU_PRO', true );

		// Plugin Folder URL
		if( ! defined( 'UBERMENU_URL' ) )
			define( 'UBERMENU_URL', plugin_dir_url( __FILE__ ) );

		// Plugin Folder Path
		if( ! defined( 'UBERMENU_DIR' ) )
			define( 'UBERMENU_DIR', plugin_dir_path( __FILE__ ) );

		if( ! defined( 'UBERMENU_BASENAME' ) ){
			define( 'UBERMENU_BASENAME' , plugin_basename(__FILE__) );
		}

		if( ! defined( 'UBERMENU_MENU_ITEM_META_KEY' ) )
			define( 'UBERMENU_MENU_ITEM_META_KEY' , '_ubermenu_settings' );

		if( ! defined( 'UBERMENU_MENU_ITEM_DEFAULTS_OPTION_KEY' ) )
			define( 'UBERMENU_MENU_ITEM_DEFAULTS_OPTION_KEY' , '_ubermenu_menu_item_settings_defaults' );




		define( 'UBERMENU_PREFIX' , 'ubermenu_' );

		define( 'UBERMENU_MENU_INSTANCES' , 'ubermenu_menus' );								//Key for instances

		define( 'UBERMENU_SKIN_GENERATOR_STYLES' , '_ubermenu_skin_generator_styles' );		//Key for Skin Gen Styles Array
		define( 'UBERMENU_MENU_STYLES' , '_ubermenu_menu_styles' );							//Key for Menu Styles Array
		define( 'UBERMENU_MENU_ITEM_STYLES' , '_ubermenu_menu_item_styles' );				//Key for Item Styles Array
		define( 'UBERMENU_MENU_ITEM_WIDGET_AREAS' , '_ubermenu_menu_item_widget_areas' );
		define( 'UBERMENU_WIDGET_AREAS' , '_ubermenu_widget_areas' );
		define( 'UBERMENU_WELCOME_MSG' , '_ubermenu_welcome' );

		define( 'UBERMENU_GENERATED_STYLES_CHANGED' , '_ubermenu_generated_styles_changed' );

		define( 'UBERMENU_GENERATED_STYLE_TRANSIENT' , '_ubermenu_generated_styles' );
		if( ! defined( 'UBERMENU_GENERATED_STYLE_TRANSIENT_EXPIRATION' ) )
			define( 'UBERMENU_GENERATED_STYLE_TRANSIENT_EXPIRATION' , 30 * DAY_IN_SECONDS );

		//URLs
		define( 'UBERMENU_KB_URL' , 'http://sevenspark.com/docs/ubermenu-3' );
		define( 'UBERMENU_VIDEOS_URL' , 'http://sevenspark.com/docs/ubermenu-3/video-tutorials' );
		define( 'UBERMENU_SUPPORT_URL' , 'http://goo.gl/fAKwNT' );
		define( 'UBERMENU_QUICKSTART_URL' , '//www.youtube.com/embed/Vz0VMgEpI1o?list=PLObX861ISTA6JgNu4-Mp9p5f6YuE1XC8w' );

		if( ! defined( 'UBERMENU_TERM_COUNT_WRAP_START' ) )
			define( 'UBERMENU_TERM_COUNT_WRAP_START' , '(' );
		if( ! defined( 'UBERMENU_TERM_COUNT_WRAP_END' ) )
			define( 'UBERMENU_TERM_COUNT_WRAP_END' , ')' );

				
	}

	private function includes() {
		
		require_once UBERMENU_DIR . 'includes/menuitems/menuitems.php';
		require_once UBERMENU_DIR . 'includes/UberMenuWalker.class.php';
		require_once UBERMENU_DIR . 'includes/functions.php';
		require_once UBERMENU_DIR . 'includes/icons.php';
		require_once UBERMENU_DIR . 'includes/customizer/customizer.php';
		require_once UBERMENU_DIR . 'includes/customizer/custom-styles.php';
		require_once UBERMENU_DIR . 'includes/ubermenu.api.php';
		require_once UBERMENU_DIR . 'includes/shortcodes.php';
		require_once UBERMENU_DIR . 'includes/item-limit-detection.php';

		require_once UBERMENU_DIR . 'admin/admin.php';
		require_once UBERMENU_DIR . 'admin/migration.php';

		if( ubermenu_is_pro() ){
			require_once UBERMENU_DIR . 'pro/ubermenu.pro.php';
		}

	}

	public function settings_api(){
		if( self::$settings_api == null ){
			self::$settings_api = new UberMenu_Settings_API();
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

		wp_register_style( 'ubermenu-'.$id , $src );
	}

	public function set_defaults(){

		self::$settings_defaults = ubermenu_get_settings_defaults();

	}

	function get_defaults( $section = null ){
		if( self::$settings_defaults == null ) self::set_defaults();

		if( $section != null && isset( self::$settings_defaults[$section] ) ) return self::$settings_defaults[$section];
		
		return self::$settings_defaults;
	}

	function get_default( $option , $section ){

		if( self::$settings_defaults == null ) self::set_defaults();

		$default = '';

		if( isset( self::$settings_defaults[$section] ) && isset( self::$settings_defaults[$section][$option] ) ){
			$default = self::$settings_defaults[$section][$option];
		}
		return $default;
	}

	function register_icons( $group , $iconmap ){
		if( !is_array( self::$registered_icons ) ) self::$registered_icons = array();
		self::$registered_icons[$group] = $iconmap;
	}
	function deregister_icons( $group ){
		if( is_array( self::$registered_icons ) && isset( self::$registered_icons[$group] ) ){
			unset( self::$registered_icons[$group] );
		}
	}
	function get_registered_icons(){ //$group = '' ){
		return self::$registered_icons;
	}



	function register_font( $font_id , $font_ops ){
		if( !is_array( self::$registered_fonts ) ) self::$registered_fonts = array();
		self::$registered_fonts[$font_id] = $font_ops;
	}
	function degister_font( $font_id ){
		if( is_array( self::$registered_fonts ) && isset( self::$registered_fonts[$font_id] ) ){
			unset( self::$registered_fonts[$font_id] );
		}
	}
	function get_registered_fonts(){ //$group = '' ){
		return self::$registered_fonts;
	}


	function set_item_style( $item_id , $selector , $property_map ){
		//Get all stored menu item styles
		$item_styles = _UBERMENU()->get_item_styles( $item_id );

		//Initialize new array if this menu item doesn't have any rules yet
		if( !isset( self::$item_styles[$item_id] ) ){
			self::$item_styles[$item_id] = array();
		}

		if( $selector ){
			//Initialize new array if this selector doesn't exist yet
			if( !isset( self::$item_styles[$item_id][$selector] ) ){
				self::$item_styles[$item_id][$selector] = array();
			}

			if( is_array( $property_map ) ){
				//Add to the $properties array
				foreach( $property_map as $property => $value ){
					self::$item_styles[$item_id][$selector][$property] = $value;
				}
			}
		}

	}
	function get_item_styles( $reset_id = false ){
		if( !is_array( self::$item_styles ) ){
			self::$item_styles = get_option( UBERMENU_MENU_ITEM_STYLES , array() );
			if( $reset_id ){
				//reset the item's styles so we can re-save from scratch
				unset( self::$item_styles[$reset_id] );
			}
		}
		return self::$item_styles;
	}
	function update_item_styles(){
		if( is_array( self::$item_styles ) ){
			update_option( UBERMENU_MENU_ITEM_STYLES , self::$item_styles );
		}
		self::$item_styles = null;	//reset so we'll need to grab it again
	}



	function set_current_config( $config_id ){
		$this->current_config = $config_id;
	}
	function get_current_config(){
		return $this->current_config;
	}

	function count_theme_location( $theme_location ){
		if( !isset( $this->theme_location_counts[$theme_location] ) ){
			$this->theme_location_counts[$theme_location] = 0;
		}
		$this->theme_location_counts[$theme_location]++;
	}
	function get_theme_location_count( $theme_location ){
		return isset( $this->theme_location_counts[$theme_location] ) ? $this->theme_location_counts[$theme_location] : 0;
	}


	function get_settings_fields(){
		return self::$settings_fields;
	}
	function set_settings_fields( $fields ){
		self::$settings_fields = $fields;
	}


}


endif; // End if class_exists check

if( !function_exists( '_UBERMENU' ) ){
	function _UBERMENU() {
		return UberMenu::instance();
	}
	_UBERMENU();
}

