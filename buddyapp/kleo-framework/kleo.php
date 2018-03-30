<?php

class Kleo {

    /*
     * Initialization args
     */
    public static $config = array();
		
	public static $custom_css;

	/**
	 * Constructor method for the Kleo class. It controls the load order of the required files for running 
	 * the framework.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		/* Define framework, parent theme, and child theme constants. */
		$this->constants();

		/* Load core functions */
		$this->core();

		/* Initialize the framework's default actions and filters. */
		add_action( 'after_setup_theme', array( &$this, 'default_filters' ), 3 );

		/* Load the framework functions. */
		add_action( 'after_setup_theme', array( &$this, 'functions' ), 12 );

        add_action( 'wp_head', array( 'Kleo', 'render_css' ), 14 ) ;

	}

	public static function add_css( $data ) {
		self::$custom_css .= $data;
	}

	public static function render_css() {
		if( sq_option( 'quick_css' ) != ''  ) {
			self::add_css( sq_option('quick_css') );
		}

		if ( self::$custom_css != '' ) {
			echo "\n<style>\n";
			echo self::$custom_css;
			echo "\n</style>\n";
		}
	}

	public static function get_config( $name ) {
		if (isset(self::$config[$name])) {
			return self::$config[$name];
		}

		return false;
	}

	public static function init_config( $data ) {
		self::$config = $data;
	}

	public static function set_config($name, $value) {
		self::$config[$name] = $value;
	}

	/**
	 * Defines the constant paths for use within the core framework, parent theme, and child theme.  
	 *
	 * @since 1.0.0
	 */
	function constants() {

		/* Sets the framework version number. */
		define( 'KLEO_VERSION', '3.0' );
        
		/* Sets the framework domain */
		define( 'KLEO_DOMAIN', str_replace(" ","_",strtolower(wp_get_theme())) );

		/* Sets the path to the parent theme directory. */
		define( 'THEME_DIR', get_template_directory() );

		/* Sets the path to the parent theme directory URI. */
		define( 'THEME_URI', get_template_directory_uri() );

		/* Sets the path to the child theme directory. */
		define( 'CHILD_THEME_DIR', get_stylesheet_directory() );

		/* Sets the path to the child theme directory URI. */
		define( 'CHILD_THEME_URI', get_stylesheet_directory_uri() );

		/* Sets the path to the core framework directory. */
		define( 'KLEO_DIR', trailingslashit( THEME_DIR ) . 'kleo-framework' );

		/* Sets the path to the core framework directory URI. */
		define( 'KLEO_URI', trailingslashit( THEME_URI ) . 'kleo-framework' );

		/* Sets the path to the theme framework folder. */
		define( 'KLEO_FW_DIR', trailingslashit( THEME_DIR ) . 'kleo-framework' );

		/* Sets the url to the theme framework folder. */
		define( 'KLEO_FW_URI', trailingslashit( THEME_URI ) . 'kleo-framework' );

		/* Sets the path to the theme library folder. */
		define( 'KLEO_LIB_DIR', trailingslashit( THEME_DIR ) . 'lib' );
		
		/* Sets the url to the theme library folder. */
		define( 'KLEO_LIB_URI', trailingslashit( THEME_URI ) . 'lib' );

		/* If is a AJAX request */
		define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

	}

	/**
	 * Loads the core framework functions.  These files are needed before loading anything else in the 
	 * framework because they have required functions for use.
	 *
	 * @since 1.0.0
	 */
	function core() {

		/* Load required plugins library */
		require_once KLEO_DIR. '/lib/class-tgm-plugin-activation.php';

		/* Load the core framework functions. */
		require_once( trailingslashit( KLEO_DIR ) . 'lib/function-core.php' );

	}

	/**
	 * Loads the framework functions.
	 *
	 * @since 1.0.0
	 */
	function functions() {

		/* Load multiple sidebars plugin */
		if( ! class_exists( 'sidebar_generator' ) ) {
			 require_if_theme_supports ('kleo-sidebar-generator', KLEO_DIR. '/lib/class-multiple-sidebars.php');
		}

		// Include breadcrumb
		if ( ! is_admin() ) {
            require_once(KLEO_DIR.'/lib/function-breadcrumb.php');
		}
	}

	
	/**
	 * Adds the default framework actions and filters.
	 *
	 * @since 1.0.0
	 */
	function default_filters() 
	{

		/* Remove bbPress theme compatibility if current theme supports bbPress. */
		if ( current_theme_supports( 'bbpress' ) ) {
			remove_action( 'bbp_init', 'bbp_setup_theme_compat', 8 );
		}
		
		/* Make text widgets and term descriptions shortcode aware. */
		add_filter( 'widget_text', 'do_shortcode' );
		add_filter( 'term_description', 'do_shortcode' );
		
	}

}

//instance of our theme framework
new Kleo();