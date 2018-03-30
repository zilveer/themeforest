<?php
/**
 * ThemesDepot Core - A WordPress theme development framework.
 *
 * ThemesDepot Core is a framework for developing WordPress themes.  The framework allows theme developers
 * to quickly build themes without having to handle all of the "logic" behind the theme or having to code 
 * complex functionality for features that are often needed in themes.  The framework does these things 
 * for developers to allow them to get back to what matters the most:  developing and designing themes.  
 * The framework was built to make it easy for developers to include (or not include) specific, pre-coded 
 * features.  Themes handle all the markup, style, and scripts while the framework handles the logic.
 *
 * ThemesDepot Core is a modular system, which means that developers can pick and choose the features they 
 * want to include within their themes.  Many files are only loaded if the theme registers support for the 
 * feature using the add_theme_support( $feature ) function within their theme.
 *
 *
 * @package   ThemesDepotCore
 * @version   3.0.0
 * @author    Alessandro Tesoro
 * @copyright Copyright (c) 2014, Alessandro Tesoro
 * @link      https://themesdepot.org
 */

if ( !class_exists( 'ThemesDepot' ) ) {

	/**
	 * The ThemesDepot class launches the framework.  It's the organizational structure behind the entire framework. 
	 * This class should be loaded and initialized before anything else within the theme is called to properly use 
	 * the framework.  
	 *
	 * After parent themes call the ThemesDepot class, they should perform a theme setup function on the 
	 * 'after_setup_theme' hook with a priority of 10.  Child themes should add their theme setup function on
	 * the 'after_setup_theme' hook with a priority of 11.  This allows the class to load theme-supported features
	 * at the appropriate time, which is on the 'after_setup_theme' hook with a priority of 12.
	 *
	 * Note that while it is possible to extend this class, it's not usually recommended unless you absolutely 
	 * know what you're doing and expect your sub-class to break on updates.  This class often gets modifications 
	 * between versions.
	 *
	 * @since  3.0.0
	 * @access public
	 */
	class ThemesDepot {

		/**
		 * Constructor method for the ThemesDepot class.  This method adds other methods of the class to 
		 * specific hooks within WordPress.  It controls the load order of the required files for running 
		 * the framework.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		function __construct() {
			global $tdp;

			/* Set up an empty class for the global $ThemesDepot object. */
			$tdp = new stdClass;

			/* Define framework, parent theme, and child theme constants. */
			add_action( 'after_setup_theme', array( $this, 'constants' ), 1 );

			/* Load the core functions/classes required by the rest of the framework. */
			add_action( 'after_setup_theme', array( $this, 'core' ), 2 );

			/* Initialize the framework's default actions and filters. */
			add_action( 'after_setup_theme', array( $this, 'default_filters' ), 3 );
			
			/* Handle theme supported features. */
			add_action( 'after_setup_theme', array( $this, 'theme_support' ), 12 );

			/* Load the framework widgets class. */
			add_action( 'after_setup_theme', array( $this, 'widgets' ), 12 );

			/* Load framework includes. */
			add_action( 'after_setup_theme', array( $this, 'includes' ), 13 );

			/* Load the framework extensions. */
			add_action( 'after_setup_theme', array( $this, 'extensions' ), 14 );

			/* Language functions and translations setup. */
			add_action( 'after_setup_theme', array( $this, 'i18n' ), 25 );

		}

		/**
		 * Defines the constant paths for use within the core framework, parent theme, and child theme.  
		 * Constants prefixed with 'TDP_' are for use only within the core framework and don't 
		 * reference other areas of the parent or child theme.
		 *
		 * @since  0.7.0
		 * @access public
		 * @return void
		 */
		function constants() {

			/* Sets the framework version number. */
			define( 'TDP_VERSION', '3.0.0' );

			/* Sets the path to the parent theme directory. */
			define( 'THEME_DIR', get_template_directory() );

			/* Sets the path to the parent theme directory URI. */
			define( 'THEME_URI', get_template_directory_uri() );

			/* Sets the path to the child theme directory. */
			define( 'CHILD_THEME_DIR', get_stylesheet_directory() );

			/* Sets the path to the child theme directory URI. */
			define( 'CHILD_THEME_URI', get_stylesheet_directory_uri() );

			/* Sets the path to the core framework directory. */
			if ( !defined( 'TDP_DIR' ) )
				define( 'TDP_DIR', trailingslashit( THEME_DIR ) . basename( dirname( __FILE__ ) ) );

			/* Sets the path to the core framework directory URI. */
			if ( !defined( 'TDP_URI' ) )
				define( 'TDP_URI', trailingslashit( THEME_URI ) . basename( dirname( __FILE__ ) ) );

			/* Sets the path to the core framework admin directory. */
			define( 'TDP_ADMIN', trailingslashit( TDP_DIR ) . 'admin' );

			/* Sets the path to the core framework classes directory. */
			define( 'TDP_CLASSES', trailingslashit( TDP_DIR ) . 'classes' );

			/* Sets the path to the core framework extensions directory. */
			define( 'TDP_EXTENSIONS', trailingslashit( TDP_DIR ) . 'extensions' );

			/* Sets the path to the core framework functions directory. */
			define( 'TDP_FUNCTIONS', trailingslashit( TDP_DIR ) . 'functions' );

			/* Sets the path to the core framework languages directory. */
			define( 'TDP_LANGUAGES', trailingslashit( TDP_DIR ) . 'languages' );

			/* Sets the path to the core framework CSS directory URI. */
			define( 'TDP_CSS', trailingslashit( THEME_URI ) . 'assets/css/' );

			/* Sets the path to the core framework JavaScript directory URI. */
			define( 'TDP_JS', trailingslashit( THEME_URI) . 'assets/js/' );
		}

		/**
		 * Loads the core framework files.  These files are needed before loading anything else in the 
		 * framework because they have required functions for use.  Many of the files run filters that 
		 * theme authors may wish to remove in their theme setup functions.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		function core() {

			/* Load the core framework admin panel. */
			require_once( trailingslashit( TDP_ADMIN ) . 'admin-init.php' );

			/* Load the framework filters. */
			require_once( trailingslashit( TDP_FUNCTIONS ) . 'filters.php' );

			/* Load the sidebar functions. */
			require_once( trailingslashit( TDP_FUNCTIONS ) . 'sidebars.php' );

			/* Load the scripts functions. */
			require_once( trailingslashit( TDP_FUNCTIONS ) . 'scripts.php' );

			/* Load the styles functions. */
			require_once( trailingslashit( TDP_FUNCTIONS ) . 'styles.php' );

			/* Load the utility functions. */
			require_once( trailingslashit( TDP_FUNCTIONS ) . 'utility.php' );

		}

		/**
		 * Loads the framework files supported by themes and template-related functions/classes.  Functionality 
		 * in these files should not be expected within the theme setup function.
		 *
		 * @since  2.0.0
		 * @access public
		 * @return void
		 */
		function includes() {

			/* Load the HTML attributes functions. */
			require_once( trailingslashit( TDP_FUNCTIONS ) . 'attr.php' );


		}

		/**
		 * Load extensions (external projects).  Extensions are projects that are included within the 
		 * framework but are not a part of it.  They are external projects developed outside of the 
		 * framework.  Themes must use add_theme_support( $extension ) to use a specific extension 
		 * within the theme.  This should be declared on 'after_setup_theme' no later than a priority of 11.
		 *
		 * @since  0.7.0
		 * @access public
		 * @return void
		 */
		function extensions() {

			/* Remove Redux Framework Tracking Script */ 
			require_once( trailingslashit( TDP_EXTENSIONS ) . 'remove-tracking.php' );

			/* Add Options For Redux Framework */ 
			require_once( trailingslashit( TDP_EXTENSIONS ) . 'theme-options.php' );

			/* Load the Breadcrumb Trail extension if supported. */
			require_if_theme_supports( 'breadcrumb-trail', trailingslashit( TDP_EXTENSIONS ) . 'breadcrumb-trail.php' );

			/* Load the Breadcrumb Trail extension if supported. */
			require_if_theme_supports( 'tgm', trailingslashit( TDP_CLASSES ) . 'class-tgm-plugin-activation.php' );

			/* Load the image resizing script */ 
			require_once( trailingslashit( TDP_EXTENSIONS ) . 'freshizer.php' );

		}

		/**
		 * Load widgets class.
		 *
		 * @since  3.0.0
		 * @access public
		 * @return void
		 */
		function widgets() {

			/* Load the widgets utility class. */
			require_once( trailingslashit( TDP_EXTENSIONS ) . 'widgets.php' );

		}

		/**
		 * Removes theme supported features from themes in the case that a user has a plugin installed
		 * that handles the functionality.
		 *
		 * @since  1.3.0
		 * @access public
		 * @return void
		 */
		function theme_support() {

			/* Adds core WordPress HTML5 support. */
			add_theme_support( 'html5', array( 'comment-form', 'comment-list', 'search-form' ) );

			/* Add default posts and comments RSS feed links to head */
			add_theme_support( 'automatic-feed-links' );

			/* Enable support for Post Thumbnails on posts and pages*/
			add_theme_support( 'post-thumbnails' );

			/* Enable support for WordPress Menus */
			add_theme_support('menus');

		}

		/**
		 * Loads both the parent and child theme translation files.  If a locale-based functions file exists
		 * in either the parent or child theme (child overrides parent), it will also be loaded.  All translation 
		 * and locale functions files are expected to be within the theme's '/languages' folder, but the 
		 * framework will fall back on the theme root folder if necessary.  Translation files are expected 
		 * to be prefixed with the template or stylesheet path (example: 'templatename-en_US.mo').
		 *
		 * @since  1.2.0
		 * @access public
		 * @return void
		 */
		function i18n() {
			
		}

		/**
		 * Adds the default framework actions and filters.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		function default_filters() {

			/* Make text widgets shortcode aware. */
			add_filter( 'widget_text', 'do_shortcode' );

			/* Don't strip tags on single post titles. */
			remove_filter( 'single_post_title', 'strip_tags' );

			/* Hide advanced custom fields plugin interface if the plugin is not installed. */
			if ( !in_array( 'advanced-custom-fields/acf.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				define( 'ACF_LITE', true );
			}

		}

	}
}
