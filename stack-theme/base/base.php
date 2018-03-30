<?php

class Base {
	
	var $types;
	var $settings;
	var $sidebars;
	var $widgets;
	var $menus;
	var $options;
	var $plugins;
	var $shortcodes;
	
	// Initialize theme.
	function init( $options ) {
		
		// Define theme's constants.
		$this->theme_config( $options );
		
		// Load base's core.
		$this->base_functions();

		// Language support.
		add_action( 'init', array( &$this, 'theme_language' ) );
		
		// Theme support.
		add_action( 'after_setup_theme', array( &$this, 'theme_support' ) );
		
		// Theme's shortcodes.
		$this->theme_shortcodes();
		
		// Theme's widgets.
		add_action( 'widgets_init', array( &$this, 'theme_widgets' ) );
		
		// Theme's sidebars
		$this->theme_sidebars();
		
		// Theme's types
		$this->theme_types();
		
		// Theme's AJAX.
		require_once( THEME_CUSTOM_DIR . '/theme-ajax.php' );
		
		// Frontend Enque
		add_action( 'wp_enqueue_scripts', array( &$this, 'theme_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( &$this, 'theme_styles' ) );
		
		// Custom 
		add_action(	'wp_head', array(&$this, 'theme_header'));
		$this->theme_function();

		// Theme's admin.
		$this->theme_admin();

		// Theme's plugins.
		$this->theme_custom_libs();
	}
	
	function theme_config( $options ) {
	
		$this->types = $options['theme_types'];
		$this->metas = $options['theme_custom_metas'];
		$this->menus = $options['theme_menus'];
		$this->sidebars = $options['theme_sidebars'];
		$this->options = $options['theme_options'];
		$this->shortcodes = $options['theme_shortcodes'];
		$this->widgets = $options['theme_widgets'];
		$this->plugins = $options['theme_custom_libs'];
		
		// Get Theme Data from style.css
		$theme_data = wp_get_theme();

		// Core
		define( 'THEME_NAME', $theme_data->Name );
		define( 'THEME_SLUG', strtolower( trim( str_ireplace( 'child', '', $theme_data->Name ) ) ) );
		define( 'THEME_VERSION', $theme_data->Version );

		define( 'THEME_URI', get_template_directory_uri() );
		define( 'THEME_DIR', get_template_directory() );

		define( 'THEME_FRAMEWORK_URI', THEME_URI.'/base' );
		define( 'THEME_FRAMEWORK_DIR', THEME_DIR.'/base' );
		
		define( 'THEME_FRAMEWORK_ASSETS_URI', THEME_FRAMEWORK_URI.'/assets' );
		define( 'THEME_FRAMEWORK_ASSETS_DIR', THEME_FRAMEWORK_DIR.'/assets' );

		define( 'THEME_FUNCTIONS_URI', THEME_FRAMEWORK_URI.'/functions' );
		define( 'THEME_FUNCTIONS_DIR', THEME_FRAMEWORK_DIR.'/functions' );

		define( 'THEME_LIBS_URI', THEME_FRAMEWORK_URI.'/libs' );
		define( 'THEME_LIBS_DIR', THEME_FRAMEWORK_DIR.'/libs' );

		// Custom
		define( 'THEME_CUSTOM_URI', THEME_FRAMEWORK_URI.'/custom' );
		define( 'THEME_CUSTOM_DIR', THEME_FRAMEWORK_DIR.'/custom' );
		
		define( 'THEME_CUSTOM_ASSETS_URI', THEME_FRAMEWORK_URI.'/custom/assets' );
		define( 'THEME_CUSTOM_ASSETS_DIR', THEME_FRAMEWORK_DIR.'/custom/assets' );

		define( 'THEME_TYPES_URI', THEME_CUSTOM_URI.'/types' );
		define( 'THEME_TYPES_DIR', THEME_CUSTOM_DIR.'/types' );

		define( 'THEME_WIDGETS_URI', THEME_CUSTOM_URI.'/widgets' );
		define( 'THEME_WIDGETS_DIR', THEME_CUSTOM_DIR.'/widgets' );

		define( 'THEME_OPTIONS_URI', THEME_CUSTOM_URI.'/options' );
		define( 'THEME_OPTIONS_DIR', THEME_CUSTOM_DIR.'/options' );

		define( 'THEME_LANGUAGES_URI', THEME_CUSTOM_URI.'/languages' );
		define( 'THEME_LANGUAGES_DIR', THEME_CUSTOM_DIR.'/languages' );

		define( 'THEME_SHORTCODES_URI', THEME_CUSTOM_URI.'/shortcodes' );
		define( 'THEME_SHORTCODES_DIR', THEME_CUSTOM_DIR.'/shortcodes' );

		define( 'THEME_CUSTOM_LIBS_URI', THEME_CUSTOM_URI.'/libs' );
		define( 'THEME_CUSTOM_LIBS_DIR', THEME_CUSTOM_DIR.'/libs' );
	}
	
	function theme_language() {
		$locale = get_locale();
		if (is_admin()) {
			load_theme_textdomain( 'theme_admin', THEME_CUSTOM_DIR . '/languages' );
			$locale_file = THEME_FRAMEWORK_DIR . "/languages/$locale.php";
		}else{
			load_theme_textdomain( 'theme_front', THEME_DIR . '/languages' );
			$locale_file = THEME_DIR . "/languages/$locale.php";
		}
		if ( is_readable( $locale_file ) ){
			require_once( $locale_file );
		}
	}
	
	function theme_support() {
		// Editor style
		add_editor_style();

		// Post Thumbnail
		add_theme_support( 'post-thumbnails' );

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		if ( ! isset( $content_width ) )
		$content_width = 600;

		// WordPress Navigation Menu
		register_nav_menus( $this->menus );
	}
	
	function base_functions() {
		require_once( THEME_FUNCTIONS_DIR . '/base-functions.php' );
		require_once( THEME_FUNCTIONS_DIR . '/font-awesome-list.php' );
	}
	
	function theme_custom_libs() {
		foreach ( $this->plugins as $plugin ) {
			require_once( THEME_CUSTOM_LIBS_DIR . $plugin );
		}

		require_once( THEME_LIBS_DIR . '/class-tgm-plugin-activation.php' );
		add_action( 'tgmpa_register', array( &$this, 'theme_required_plugins' ) );
	}
	
	function theme_required_plugins() {
		$plugins = array(
			array(
				'name' 		=> 'Shortcodes Ultimate',
				'slug' 		=> 'shortcodes-ultimate',
				'version'	=> '4.7.2',
				'source'	=> get_template_directory() . '/plugins/shortcodes-ultimate.zip',
				'required' 	=> true
			),
			array(
				'name' 		=> 'Revolution Slider',
				'slug' 		=> 'revslider',
				'version'	=> '4.6.0',
				'source'	=> get_template_directory() . '/plugins/revslider.zip',
				'required' 	=> false
			),
			array(
				'name' 		=> 'Contact Form 7',
				'slug' 		=> 'contact-form-7',
				'version'	=> '3.9.3',
				'source'	=> 'http://downloads.wordpress.org/plugin/contact-form-7.3.9.3.zip',
				'required' 	=> false
			),
		);

		$config = array(
			'default_path' 		=> '',
			'parent_menu_slug' 	=> 'themes.php', 
			'parent_url_slug' 	=> 'themes.php',
			'menu'         		=> 'install-required-plugins',
			'has_notices'      	=> true, 
			'is_automatic'    	=> true,
		);
		tgmpa( $plugins, $config );
	}
	
	function theme_shortcodes() {
		require_once( THEME_FUNCTIONS_DIR . '/base-shortcode.php' );

		foreach ( $this->shortcodes as $slug ) {
			require_once( THEME_SHORTCODES_DIR . '/' . $slug . '.php' );
		}
	}
	
	function theme_widgets() {
		foreach ( $this->widgets as $widget ) {
			require_once( THEME_WIDGETS_DIR . '/' . $widget . '.php' );
		}
	}
	
	function theme_sidebars() {
		$custom_sidebars = theme_options('sidebar', 'custom_sidebars');
		if($custom_sidebars) {
			foreach ($custom_sidebars as $custom_sidebar){
				$sidebar_name = $custom_sidebar['stack_title'];
				$sidebar_desc = __('Custom Sidebar Widget Area', 'theme_admin');
				register_sidebar(array(
					'id' => preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower( $sidebar_name )) ),
					'name' =>  $sidebar_name . ' (custom)',
					'description' => $sidebar_desc,
					'before_title' => '<div class="widget-title">',
					'after_title' => '</div>',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>',
				));
			}
		}
		foreach( $this->sidebars as $theme_sidebar ){
			register_sidebar($theme_sidebar);
		}
	}
	
	function theme_types() {
		foreach( $this->types as $type ) {
			require_once( THEME_TYPES_DIR . '/' . $type . '/register.php' );
		}
	}
	
	function theme_scripts() {
		include( THEME_CUSTOM_DIR . '/theme-scripts.php' );
	}

	function theme_styles() {
		include( THEME_CUSTOM_DIR . '/theme-styles.php' );
	}
	
	function theme_header() {
		include( THEME_CUSTOM_DIR . '/theme-header.php' );
	}
	
	function theme_function() {
		include( THEME_CUSTOM_DIR . '/theme-functions.php' );
	}
	
	function theme_admin() {
		if ( is_admin() ) {
			require_once( THEME_FUNCTIONS_DIR . '/admin.php' );
			$admin = new Base_admin();
			$admin->init( $this );
		}
	}

}

?>