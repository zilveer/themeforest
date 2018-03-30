<?php
/**
 * Functions.php => This is where the magic happens.
 *
 * IMPORTANT: DO NOT USE AN ILLEGAL COPY OF THIS THEME !!!
 * IMPORTANT: DO NOT EVER EDIT THIS FILE !!!!
 * IMPORTANT: DO NOT EVER COPY AND PASTE ANYTHING FROM THIS FILE TO YOUR CHILD THEME !!!
 * IMPORTANT: DO NOT COPY AND PASTE THIS FILE INTO YOUR CHILD THEME !!!
 * IMPORTANT: DO USE HOOKS, FILTERS & TEMPLATE PARTS TO ALTER THIS THEME
 *
 * Total is a very powerful theme and virtually anything can be customized
 * via a child theme. If you need any help altering a function, just let us know!
 * Customizations aren't included with your purchase but if it's a simple task we can assist :)
 *
 * Theme Docs        : http://wpexplorer-themes.com/total/docs/
 * Using Hooks       : http://wpexplorer-themes.com/total/docs/action-hooks/
 * Filters Reference : http://www.wpexplorer.com/docs/total-wordpress-theme-filters/
 * Theme Support     : http://wpexplorer-themes.com/support/ (valid purchase required)
 *
 * @package Total WordPress Theme
 * @subpackage Templates
 * @version 3.5.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Core Constants
define( 'TOTAL_THEME_ACTIVE', true );
define( 'WPEX_THEME_VERSION', '3.5.3' );
define( 'WPEX_VC_SUPPORTED_VERSION', '4.12' );

define( 'WPEX_THEME_DIR', get_template_directory() );
define( 'WPEX_THEME_URI', get_template_directory_uri() );

// Start up class
class WPEX_Theme_Setup {

	/**
	 * Main Theme Class Constructor
	 *
	 * Loads all necessary classes, functions, hooks, configuration files and actions for the theme.
	 * Everything starts here.
	 *
	 * @since 1.6.0
	 *
	 */
	public function __construct() {

		// Perform actions after updating => These run on init hook
		require_once( WPEX_THEME_DIR .'/framework/updates/after-update.php' );

		// Define globals
		global $wpex_theme, $wpex_theme_mods;

		// Gets all theme mods and stores them in an easily accessable global var to limit DB requests
		$wpex_theme_mods = get_theme_mods();

		// Functions used to retrieve theme mods.
		// Loaded early so it can be used on all hooks.
		// Requires $wpex_theme_mods global var to be defined first => look up!
		require_once( WPEX_THEME_DIR .'/framework/get_mods.php' );

		// Include conditional functions early so we can use them anywhere
		require_once( WPEX_THEME_DIR .'/framework/conditionals.php' );

		// Include global object class early so it can be used anywhere needed.
		// This is important because when inserting VC modules we must re-run the class object at times
		require_once( WPEX_THEME_DIR .'/framework/classes/global-object.php' );

		// Define constants
		add_action( 'after_setup_theme', array( 'WPEX_Theme_Setup', 'constants' ), 0 );

		// Load all core theme function files
		// Load Before classes and addons so we can make use of them
		add_action( 'after_setup_theme', array( 'WPEX_Theme_Setup', 'include_functions' ), 1 );

		// Load all the theme addons - must run on this hook!!!
		add_action( 'after_setup_theme', array( 'WPEX_Theme_Setup', 'addons' ), 2 );

		// Load configuration classes (post types & 3rd party plugins)
		// Must load first so it can use hooks defined in the classes
		add_action( 'after_setup_theme', array( 'WPEX_Theme_Setup', 'configs' ), 3 );

		// Load framework classes
		add_action( 'after_setup_theme', array( 'WPEX_Theme_Setup', 'classes' ), 4 );

		// Setup theme => add_theme_support, register_nav_menus, load_theme_textdomain, etc
		// Must run on 10 priority or else child theme locale will be overritten
		add_action( 'after_setup_theme', array( 'WPEX_Theme_Setup', 'theme_setup' ), 10 );

		// Defines hooks and runs actions
		// @todo move to 'wp' hook since it's not needed so early? Would break a lot of snippets...
		add_action( 'init', array( 'WPEX_Theme_Setup', 'hooks_actions' ), 0 );

		// Populate the global object
		// Must be done early on to prevent issues with plugins altering templates
		// But must run after WP has loaded so conditionals work
		add_action( 'template_redirect', array( 'WPEX_Theme_Setup', 'global_object' ), 0 );

		// Run after switch theme
		add_action( 'after_switch_theme', array( 'WPEX_Theme_Setup', 'after_switch_theme' ) );

		// Load custom widgets
		if ( wpex_get_mod( 'custom_widgets_enable', true ) ) {
			add_action( 'widgets_init', array( 'WPEX_Theme_Setup', 'custom_widgets' ), 10 );
		}

		// register sidebar widget areas
		add_action( 'widgets_init', array( 'WPEX_Theme_Setup', 'register_sidebars' ) );

		// Add gallery metabox to portfolio
		add_filter( 'wpex_gallery_metabox_post_types', array( 'WPEX_Theme_Setup', 'add_gallery_metabox' ), 10 );

		// Define the directory URI for the gallery metabox calss
		add_filter( 'wpex_gallery_metabox_dir_uri', array( 'WPEX_Theme_Setup', 'gallery_metabox_dir_uri' ) );

		/** Admin only actions **/
		if ( is_admin() ) {

			// Load scripts in the WP admin
			add_action( 'admin_enqueue_scripts', array( 'WPEX_Theme_Setup', 'admin_scripts' ) );

			// Outputs custom CSS for the admin
			add_action( 'admin_head', array( 'WPEX_Theme_Setup', 'admin_inline_css' ) );

			// Add new social profile fields to the user dashboard
			add_filter( 'user_contactmethods', array( 'WPEX_Theme_Setup', 'add_user_social_fields' ) );

			// Remove wpex_term_data when a term is removed
			add_action( 'delete_term', array( 'WPEX_Theme_Setup', 'delete_term' ), 5 );

		/** Non Admin actions **/
		} else {

			// Load theme CSS
			add_action( 'wp_enqueue_scripts', array( 'WPEX_Theme_Setup', 'theme_css' ) );

			// Gravity Forms CSS
			add_action( 'wp_enqueue_scripts', array( 'WPEX_Theme_Setup', 'gravity_forms_css' ), 40 );

			// Load RTL CSS right before responsive
			add_action( 'wp_enqueue_scripts', array( 'WPEX_Theme_Setup', 'rtl_css' ), 98 );

			// Load responsive CSS - must be added last
			add_action( 'wp_enqueue_scripts', array( 'WPEX_Theme_Setup', 'responsive_css' ), 99 );

			// Load theme js => High priority so after js_composer
			add_action( 'wp_enqueue_scripts', array( 'WPEX_Theme_Setup', 'theme_js' ) );

			// Exclude categories from the blog page
			add_action( 'pre_get_posts', array( 'WPEX_Theme_Setup', 'pre_get_posts' ) );

			// Redirect posts with custom links
			add_filter( 'template_redirect', array( 'WPEX_Theme_Setup', 'redirect_custom_links' ) );

			// Add meta viewport tag to header
			add_action( 'wp_head', array( 'WPEX_Theme_Setup', 'meta_viewport' ), 1 );

			// Add theme meta generator
			add_action( 'wp_head', array( 'WPEX_Theme_Setup', 'theme_meta_generator' ), 1 );

			// Add an X-UA-Compatible header
			add_filter( 'wp_headers', array( 'WPEX_Theme_Setup', 'x_ua_compatible_headers' ) );

			// Browser dependent CSS
			add_action( 'wp_head', array( 'WPEX_Theme_Setup', 'browser_dependent_css' ) );

			// Loads html5 shiv script
			add_action( 'wp_head', array( 'WPEX_Theme_Setup', 'html5_shiv' ) );

			// Outputs custom CSS to the head
			add_action( 'wp_head', array( 'WPEX_Theme_Setup', 'custom_css' ), 9999 );

			// Alter tagcloud widget to display all tags with 1em font size
			add_filter( 'widget_tag_cloud_args', array( 'WPEX_Theme_Setup', 'widget_tag_cloud_args' ) );

			// Alter WP categories widget to display count inside a span
			add_filter( 'wp_list_categories', array( 'WPEX_Theme_Setup', 'wp_list_categories_args' ) );

			// Add a responsive wrapper to the WordPress oembed output
			add_filter( 'embed_oembed_html', array( 'WPEX_Theme_Setup', 'oembed_html' ), 99, 4 );

			// Allow for the use of shortcodes in the WordPress excerpt
			add_filter( 'the_excerpt', 'shortcode_unautop' );
			add_filter( 'the_excerpt', 'do_shortcode' );

			// Make sure the wp_get_attachment_url() function returns correct page request (HTTP or HTTPS)
			add_filter( 'wp_get_attachment_url', array( 'WPEX_Theme_Setup', 'honor_ssl_for_attachments' ) );

			// Tweak the default password protection output form
			add_filter( 'the_password_form', array( 'WPEX_Theme_Setup', 'custom_password_protected_form' ) );

			// Exclude posts with custom links from the next and previous post links
			add_filter( 'get_previous_post_join', array( 'WPEX_Theme_Setup', 'prev_next_join' ) );
			add_filter( 'get_next_post_join', array( 'WPEX_Theme_Setup', 'prev_next_join' ) );
			add_filter( 'get_previous_post_where', array( 'WPEX_Theme_Setup', 'prev_next_where' ) );
			add_filter( 'get_next_post_where', array( 'WPEX_Theme_Setup', 'prev_next_where' ) );

			// Remove emoji scripts
			if ( wpex_get_mod( 'remove_emoji_scripts_enable', true ) ) {
				remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
				remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
				remove_action( 'wp_print_styles', 'print_emoji_styles' );
				remove_action( 'admin_print_styles', 'print_emoji_styles' );
			}

			// Adds classes the post class
			add_filter( 'post_class', array( 'WPEX_Theme_Setup', 'post_class' ) );

			// Add schema markup to the authors post link
			add_filter( 'the_author_posts_link', array( 'WPEX_Theme_Setup', 'the_author_posts_link' ) );

			// Move Comment textarea form field back to bottom
			add_filter( 'comment_form_fields', array( 'WPEX_Theme_Setup', 'move_comment_form_fields' ) );

			// Disable WP responsive images if retina is enabled
			if ( wpex_is_retina_enabled() ) {
				add_filter( 'wp_calculate_image_srcset', '__return_false' );
			}

			// Disable canonical redirect on the homepage when using pagination via VC modules
			add_filter( 'redirect_canonical', array( 'WPEX_Theme_Setup', 'home_pagination_fix' ) );

			// Filter kses protocols
			add_filter( 'kses_allowed_protocols' , array( 'WPEX_Theme_Setup', 'kses_allowed_protocols' ) );

			// Filter comment link for smooth scrolling
			add_filter( 'get_comments_link', array( 'WPEX_Theme_Setup', 'get_comments_link' ), 10, 2 );
			add_filter( 'respond_link', array( 'WPEX_Theme_Setup', 'get_comments_link' ), 10, 2 );

		} // Non admin functions

	} // End constructor

	/**
	 * Defines the constants for use within the theme.
	 *
	 * @since 2.0.0
	 */
	public static function constants() {

		// Theme branding
		define( 'WPEX_THEME_BRANDING', wpex_get_mod( 'theme_branding', 'Total' ) );

		// Theme Panel slug
		define( 'WPEX_THEME_PANEL_SLUG', 'wpex-panel' );
		define( 'WPEX_ADMIN_PANEL_HOOK_PREFIX', 'theme-panel_page_'. WPEX_THEME_PANEL_SLUG );

		// Javascript and CSS Paths
		define( 'WPEX_JS_DIR_URI', WPEX_THEME_URI .'/js/' );
		define( 'WPEX_CSS_DIR_URI', WPEX_THEME_URI .'/css/' );

		// Framework Paths
		define( 'WPEX_FRAMEWORK_DIR', WPEX_THEME_DIR .'/framework/' );
		define( 'WPEX_FRAMEWORK_DIR_URI', WPEX_THEME_URI .'/framework/' );

		// Classes directory
		define( 'WPEX_ClASSES_DIR', WPEX_FRAMEWORK_DIR .'classes/' );

		// Check if plugins are active
		define( 'WPEX_VC_ACTIVE', class_exists( 'Vc_Manager' ) );
		define( 'WPEX_BBPRESS_ACTIVE', class_exists( 'bbPress' ) );
		define( 'WPEX_WOOCOMMERCE_ACTIVE', class_exists( 'WooCommerce' ) );
		define( 'WPEX_WPML_ACTIVE', class_exists( 'SitePress' ) );

		// Active post types
		define( 'WPEX_PORTFOLIO_IS_ACTIVE', wpex_get_mod( 'portfolio_enable', true ) );
		define( 'WPEX_STAFF_IS_ACTIVE', wpex_get_mod( 'staff_enable', true ) );
		define( 'WPEX_TESTIMONIALS_IS_ACTIVE', wpex_get_mod( 'testimonials_enable', true ) );

	}

	/**
	 * Defines all theme hooks and runs all needed actions for theme hooks.
	 *
	 * @since 2.0.0
	 */
	public static function hooks_actions() {

		$dir = WPEX_FRAMEWORK_DIR;

		// Register hooks (needed in admin for Custom Actions panel)
		require_once( $dir .'hooks/hooks.php' );

		// Front-end stuff
		if ( ! is_admin() ) {
			require_once( $dir .'hooks/actions.php' );
			require_once( $dir .'hooks/partials.php' );
		}

	}

	/**
	 * Framework functions
	 * Load before Classes & Addons so we can use them
	 *
	 * @since 2.0.0
	 */
	public static function include_functions() {
		$dir = WPEX_FRAMEWORK_DIR;

		// Needed in front-end and back-end
		require_once( $dir .'deprecated.php' );
		require_once( $dir .'core-functions.php' );
		require_once( $dir .'arrays.php' );
		require_once( $dir .'fonts.php' );
		require_once( $dir .'shortcodes/shortcodes.php' );
		require_once( $dir .'overlays.php' );

		// Not needed in admin
		if ( ! is_admin() ) {
			require_once( $dir .'body-classes.php' );
			require_once( $dir .'header-functions.php' );
			require_once( $dir .'title.php' );
			require_once( $dir .'page-header.php' );
			require_once( $dir .'menu-functions.php' );
			require_once( $dir .'excerpts.php' );
			require_once( $dir .'pagination.php' );
			require_once( $dir .'blog-functions.php' );
		}
		
	}

	/**
	 * Include Theme Panel class which loads various add-on functions
	 *
	 * @since 2.0.0
	 */
	public static function addons() {
		require_once( WPEX_FRAMEWORK_DIR .'addons/theme-panel.php' );
	}

	/**
	 * Configs for post types and 3rd party plugins.
	 *
	 * @since 2.0.0
	 */
	public static function configs() {

		$dir = WPEX_FRAMEWORK_DIR;

		// Portfolio
		if ( WPEX_PORTFOLIO_IS_ACTIVE ) {
			require_once( $dir .'portfolio/portfolio-config.php' );
		}

		// Staff
		if ( WPEX_STAFF_IS_ACTIVE ) {
			require_once( $dir .'staff/staff-config.php' );
		}

		// Testimonias
		if ( WPEX_TESTIMONIALS_IS_ACTIVE ) {
			require_once( $dir .'testimonials/testimonials-config.php' );
		}

		// WooCommerce
		if ( WPEX_WOOCOMMERCE_ACTIVE ) {
			require_once( $dir .'woocommerce/woocommerce-config.php' );
		}

		// Visual Composer
		if ( WPEX_VC_ACTIVE ) {
			require_once( $dir .'visual-composer/vc-config.php' );
		}

		// The Events Calendar
		if ( class_exists( 'Tribe__Events__Main' ) ) {
			require_once( $dir .'tribe-events/tribe-events-config.php' );
		}

		// WPML
		if ( WPEX_WPML_ACTIVE ) {
			require_once( $dir .'config/wpml.php' );
		}

		// Polylang
		if ( class_exists( 'Polylang' ) ) {
			require_once( $dir .'config/polylang.php' );
		}

		// bbPress
		if ( WPEX_BBPRESS_ACTIVE ) {
			require_once( $dir .'config/bbpress.php' );
		}

		// Sensei
		if ( function_exists( 'Sensei' ) ) {
			require_once( $dir .'config/sensei.php' );
		}

		// Yoast SEO
		if ( defined( 'WPSEO_VERSION' ) ) {
			require_once( $dir .'config/yoast.php' );
		}

		// Revolution
		if ( class_exists( 'RevSlider' ) ) {
			require_once( $dir .'config/revslider.php' );
		}

		// LayerSlider
		if ( class_exists( 'LS_Sliders' ) ) {
			require_once( $dir .'config/layerslider.php' );
		}

		// JetPack
		if ( class_exists( 'Jetpack' ) ) {
			require_once( $dir .'config/jetpack.php' );
		}

	}

	/**
	 * Framework Classes
	 *
	 * @since 2.0.0
	 */
	public static function classes() {

		// Classes Dir
		$dir = WPEX_ClASSES_DIR;

		// Sanitize input
		require_once( $dir .'sanitize-data.php' );

		// iLightbox
		require_once( $dir .'ilightbox.php' );

		// Image Resize
		require_once( $dir .'image-resize.php' );

		// Gallery metabox
		require_once( $dir .'gallery-metabox/gallery-metabox.php' );

		// Term colors - coming soon!
		//require_once( $dir .'term-colors.php' );

		// Post Series
		if ( wpex_get_mod( 'post_series_enable', true ) ) {
			require_once( $dir .'post-series.php' );
		}

		// Custom WP header
		if ( wpex_get_mod( 'header_image_enable' ) ) {
			require_once( $dir .'custom-header.php' );
		}

		// Term meta
		require_once( $dir .'term-meta.php' );

		// Term thumbnails
		if ( wpex_get_mod( 'term_thumbnails_enable', true ) ) {
			require_once( $dir .'term-thumbnails.php' );
		}

		// Remove post type slugs
		if ( wpex_get_mod( 'remove_posttype_slugs' ) ) {
			require_once( $dir .'remove-post-type-slugs.php' );
		}
		
		// Image sizes panel
		if ( wpex_get_mod( 'image_sizes_enable', true ) ) {
			require_once( $dir .'image-sizes.php' );
		}

		// Admin only classes
		if ( is_admin() ) {

			// Recommend plugins
			if ( wpex_recommended_plugins() && wpex_get_mod( 'recommend_plugins_enable', true ) ) {
				require_once( $dir .'class-tgm-plugin-activation.php' );
				require_once( WPEX_FRAMEWORK_DIR .'config/tgm-plugin-activation.php' );
			}

			// Plugins updater
			// Won't work with multisite because of how themes work.
			require_once( $dir .'plugins-updater.php' );

			// Category meta
			require_once( $dir .'category-meta.php' );

			// Metabox => Page Settings
			require_once( $dir .'metabox.php' );

			// Custom attachment fields
			require_once( $dir .'attachment-fields.php' );

		}

		// Front-end classes
		else {

			// Accent color
			require_once( $dir .'accent-color.php' );

			// Border color
			require_once( $dir .'border-colors.php' );

			// Site backgrounds
			require_once( $dir .'site-backgrounds.php' );

			// Advanced styling
			require_once( $dir .'advanced-styling.php' );

			// Breadcrumbs class
			require_once( $dir .'breadcrumbs.php' );

		}

		// Disable Google Services - @see conditionals.php
		if ( wpex_disable_google_services() ) {
			require_once( $dir .'disable-google-services.php' );
		}

		// Customizer must load last to take advantage of all functions before it
		require_once( WPEX_FRAMEWORK_DIR .'customizer/customizer.php' );

	}

	/**
	 * Include all custom widget classes
	 *
	 * @since 2.0.0
	 */
	public static function custom_widgets() {

		// Define directory for widgets
		$dir = WPEX_ClASSES_DIR .'widgets/';

		// Define array of custom widgets for the theme so you can easily disable any
		$widgets = array(
			'about',
			'newsletter',
			'info',
			'social-fontawesome',
			'social',
			'simple-menu',
			'modern-menu',
			'facebook-page',
			'google-map',
			'flickr',
			'video',
			'posts-thumbnails',
			'posts-grid',
			'posts-icons',
			'instagram-grid',
			'comments-avatar',
		);

		// Add templatera widget
		if ( function_exists( 'templatera_init' ) ) {
			$widgets['templatera'] = 'templatera';
		}

		// Apply filters
		$widgets = apply_filters( 'wpex_custom_widgets', $widgets );

		// Loop through array and register the custom widgets
		if ( $widgets && is_array( $widgets ) ) {
			foreach ( $widgets as $widget ) {
				require_once( $dir . $widget .'.php' );
			}
		}

	}

	/**
	 * Populate the $wpex_theme global object.
	 *
	 * This helps speed things up by calling core functions only once and saving them in memory.
	 *
	 * @since 2.0.0
	 */
	public static function global_object() {
		global $wpex_theme;
		$wpex_theme = new WPEX_Global_Theme_Object();
		$wpex_theme = $wpex_theme->generate_obj();
	}

	/**
	 * Adds basic theme support functions and registers the nav menus
	 *
	 * @since 1.6.0
	 */
	public static function theme_setup() {

		// Load text domain
		load_theme_textdomain( 'total', WPEX_THEME_DIR .'/languages' );

		// Get globals
		global $content_width;

		// Set content width based on theme's default design
		if ( ! isset( $content_width ) ) {
			$content_width = 980;
		}

		// Array of theme menus
		$menus = apply_filters( 'wpex_nav_menus', array(
			'topbar_menu'     => esc_html__( 'Top Bar', 'total' ),
			'main_menu'       => esc_html__( 'Main', 'total' ),
			'mobile_menu_alt' => esc_html__( 'Mobile Menu Alternative', 'total' ),
			'mobile_menu'     => esc_html__( 'Mobile Icons', 'total' ),
			'footer_menu'     => esc_html__( 'Footer', 'total' ),
		) );

		// Register navigation menus
		register_nav_menus( $menus );

		// Declare theme support
		add_theme_support( 'post-formats', array( 'video', 'gallery', 'audio', 'quote', 'link' ) );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'title-tag' );

		// Enable excerpts for pages.
		add_post_type_support( 'page', 'excerpt' );

		// Add styles to the WP editor
		add_editor_style( 'css/editor-style.css' );

	}

	/**
	 * Functions called after theme switch
	 *
	 * @since 1.6.0
	 */
	public static function after_switch_theme() {
		flush_rewrite_rules();
		delete_metadata( 'user', null, 'tgmpa_dismissed_notice_wpex_theme', null, true );
	}

	/**
	 * Adds the meta tag to the site header
	 *
	 * @since 1.6.0
	 */
	public static function meta_viewport() {

		// Responsive viewport viewport
		if ( wpex_global_obj( 'responsive' ) ) {
			$viewport = '<meta name="viewport" content="width=device-width, initial-scale=1">';
		}

		// Non responsive meta viewport
		else {
			$width    = intval( wpex_get_mod( 'main_container_width', '980' ) );
			$width    = $width ? $width: '980';
			$viewport = '<meta name="viewport" content="width='. $width .'" />';
		}
		
		// Apply filters to the meta viewport for child theme tweaking
		echo apply_filters( 'wpex_meta_viewport', $viewport );

	}

	/**
	 * Adds meta generator for 
	 *
	 * @since 3.1.0
	 */
	public static function theme_meta_generator() {
		echo "\r\n";
		echo '<meta name="generator" content="Total WordPress Theme '. WPEX_THEME_VERSION .'" />';
		echo "\r\n";
	}

	/**
	 * Load scripts in the WP admin
	 *
	 * @since 1.6.0
	 */
	public static function admin_scripts() {
		wp_enqueue_style( 'wpex-font-awesome', WPEX_CSS_DIR_URI .'lib/font-awesome.min.css', array(), '4.5.0' );
	}

	/**
	 * Returns all CSS needed for the front-end
	 *
	 * @since 1.6.0
	 */
	public static function theme_css() {

		// Remove other font awesome scripts
		wp_deregister_style( 'font-awesome' );
		wp_deregister_style( 'fontawesome' );

		// Load font awesome script everywhere except the front-end composer because the js_composer already adds it
		wp_enqueue_style( 'wpex-font-awesome', WPEX_CSS_DIR_URI .'lib/font-awesome.min.css', array(), '4.3.0' );

		// Register hover-css
		wp_register_style( 'wpex-hover-animations', WPEX_CSS_DIR_URI .'lib/hover-css.min.css', array(), '2.0.1' );

		// LayerSlider
		if ( function_exists( 'lsSliders' ) ) {
			wp_enqueue_style( 'wpex-layerslider', WPEX_CSS_DIR_URI .'wpex-layerslider.css', array(), WPEX_THEME_VERSION );
		}

		// Main Style.css File
		wp_enqueue_style(
			'wpex-style', // !! IMPORTANT ** Do NOT edit 'wpex-style' *** !!!
			get_stylesheet_uri(),
			array(),
			WPEX_THEME_VERSION
		);

	}

	/**
	 * Loads Gravity Forms stylesheet
	 *
	 * @since 1.6.0
	 */
	public static function gravity_forms_css() {
		if ( class_exists( 'RGForms' ) ) {
			global $post;
			if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'gravityform' ) ) {
				wp_enqueue_style( 'wpex-gravity-forms', WPEX_CSS_DIR_URI .'wpex-gravity-forms.css', array(), WPEX_THEME_VERSION );
			}
		}
	}

	/**
	 * Loads RTL stylesheet
	 *
	 * @since 1.6.0
	 */
	public static function rtl_css() {
		if ( is_RTL() ) {
			wp_enqueue_style( 'wpex-rtl', WPEX_CSS_DIR_URI .'rtl.css', array(), WPEX_THEME_VERSION );
		}
	}

	/**
	 * Loads responsive css very last after all styles.
	 *
	 * @since 1.6.0
	 */
	public static function responsive_css() {
		if ( wpex_global_obj( 'responsive' ) ) {
			wp_enqueue_style( 'wpex-responsive', WPEX_CSS_DIR_URI .'wpex-responsive.css', array(), WPEX_THEME_VERSION );
		}
	}

	/**
	 * Returns all js needed for the front-end
	 *
	 * @since 1.6.0
	 */
	public static function theme_js() {

		// Get js directory uri
		$dir = WPEX_JS_DIR_URI;

		// Get current theme version
		$theme_version = WPEX_THEME_VERSION;

		// Get localized array
		$localize_array = WPEX_Theme_Setup::localize_array();

		// Make sure the core jQuery script is loaded
		wp_enqueue_script( 'jquery' );

		// Comment reply
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Load minified js
		if ( wpex_get_mod( 'minify_js_enable', true ) ) {
			wp_enqueue_script( 'wpex-core', $dir .'total-min.js', array( 'jquery' ), $theme_version, true );
		}
		
		// Load all non-minified js
		else {

			// Easing
			wp_enqueue_script( 'easing', $dir .'core/jquery.easing.js', array( 'jquery' ), '1.3.2', true );

			// Superfish used for menu dropdowns
			wp_enqueue_script( 'wpex-superfish', $dir .'core/superfish.js', array( 'jquery' ), $theme_version, true );
			wp_enqueue_script( 'wpex-supersubs', $dir .'core/supersubs.js', array( 'jquery' ), $theme_version, true );
			wp_enqueue_script( 'wpex-hoverintent', $dir .'core/hoverintent.js', array( 'jquery' ), $theme_version, true );

			// Tooltips
			wp_enqueue_script( 'wpex-tipsy', $dir .'core/tipsy.js', array( 'jquery' ), $theme_version, true );

			// Typed
			wp_enqueue_script( 'wpex-typed', $dir .'core/typed.js', array( 'jquery' ), $theme_version, true );

			// Checks if images are loaded within an element
			wp_enqueue_script( 'wpex-images-loaded', $dir .'core/images-loaded.js', array( 'jquery' ), $theme_version, true );

			// Main masonry script
			wp_enqueue_script( 'wpex-isotope', $dir .'core/isotope.js', array( 'jquery' ), '2.2.2', true );

			// Leaner modal used for search/woo modals: @todo: Replace with CSS+light js
			wp_enqueue_script( 'wpex-leanner-modal', $dir .'core/leanner-modal.js', array( 'jquery' ), $theme_version, true );

			// Slider Pro
			wp_enqueue_script( 'wpex-sliderpro', $dir .'core/jquery.sliderPro.js', array( 'jquery' ), '1.3', true );
			wp_enqueue_script( 'wpex-sliderpro-customthumbnails', $dir .'core/jquery.sliderProCustomThumbnails.js', array( 'jquery', 'wpex-sliderpro' ), false, true );

			// Touch Swipe - do we need it?
			wp_enqueue_script( 'wpex-touch-swipe', $dir .'core/touch-swipe.js', array( 'jquery' ), $theme_version, true );

			// Carousels
			wp_enqueue_script( 'wpex-owl-carousel', $dir .'core/owl.carousel.js', array( 'jquery' ), $theme_version, true );

			// Used for milestones
			wp_enqueue_script( 'wpex-countUp', $dir .'core/countUp-jquery.js', array( 'jquery' ), $theme_version, true );
			wp_enqueue_script( 'wpex-appear', $dir .'core/appear.js', array( 'jquery' ), $theme_version, true );

			// Mobile menu
			wp_enqueue_script( 'wpex-sidr', $dir .'core/sidr.js', array( 'jquery' ), $theme_version, true );

			// Custom Selects
			wp_enqueue_script( 'wpex-custom-select', $dir .'core/jquery.customSelect.js', array( 'jquery' ), $theme_version, true );

			// Equal Heights
			wp_enqueue_script( 'wpex-equal-heights', $dir .'core/jquery.wpexEqualHeights.js', array( 'jquery' ), $theme_version, true );

			// Mousewheel
			wp_enqueue_script( 'wpex-mousewheel', $dir .'core/jquery.mousewheel.js', array( 'jquery' ), $theme_version, true );

			// Parallax bgs
			wp_enqueue_script( 'wpex-scrolly', $dir .'core/scrolly.js', array( 'jquery' ), $theme_version, true );

			// iLightbox
			wp_enqueue_script( 'wpex-ilightbox', $dir .'core/ilightbox.js', array( 'jquery' ), $theme_version, true );

			// Core global functions
			wp_enqueue_script( 'wpex-core', $dir .'functions.js', array( 'jquery' ), $theme_version, true );

		}

		// Localize core js
		wp_localize_script( 'wpex-core', 'wpexLocalize', $localize_array );

		// Retina.js
		if ( wpex_is_retina_enabled() ) {
			wp_enqueue_script( 'wpex-retina', $dir .'dynamic/retina.js', array( 'jquery' ), '0.0.2', true );
			wp_localize_script( 'wpex-retina', 'wpexRetina', array(
				'mode' => wpex_get_mod( 'retina_mode', 1 )
			) );
		}

	}

	/**
	 * Functions.js localize array
	 * IMPORTANT: Must be ** static function ** so we can get array in VC inline_js class
	 *
	 * @since 3.0.0
	 */
	public static function localize_array() {

		// Get Header Style and Mobile meny style
		$header_style    = wpex_global_obj( 'header_style' );
		$mm_style        = wpex_global_obj( 'mobile_menu_style' );
		$mm_toggle_style = wpex_global_obj( 'mobile_menu_toggle_style' );
		$mm_breakpoint   = intval( wpex_get_mod( 'mobile_menu_breakpoint' ) );

		// Create array
		$array = array(
			'isRTL'                 => is_rtl(),
			'mainLayout'            => wpex_global_obj( 'main_layout' ),
			'menuSearchStyle'       => wpex_global_obj( 'menu_search_style' ),
			'siteHeaderStyle'       => $header_style,
			'megaMenuJS'            => true,
			'superfishDelay'        => 600,
			'superfishSpeed'        => 'fast',
			'superfishSpeedOut'     => 'fast',
			'hasMobileMenu'         => wpex_global_obj( 'has_mobile_menu' ),
			'mobileMenuBreakpoint'  => $mm_breakpoint ? $mm_breakpoint : '960',
			'mobileMenuStyle'       => $mm_style,
			'mobileMenuToggleStyle' => $mm_toggle_style,
			'localScrollUpdateHash' => false,
			'localScrollSpeed'      => 1000,
			'localScrollEasing'     => 'easeInOutExpo',
			'scrollTopSpeed'        => 1000,
			'scrollTopOffset'       => 100,
			'carouselSpeed'		    => 150,
			'customSelects'         => '.woocommerce-ordering .orderby, #dropdown_product_cat, .widget_categories select, .widget_archive select, #bbp_stick_topic_select, #bbp_topic_status_select, #bbp_destination_topic, .single-product .variations_form .variations select',
		);

		/**** Header params ****/
		if ( 'disabled' != $header_style ) {

			// Sticky Header
			if ( wpex_global_obj( 'has_fixed_header' ) ) {
				$array['hasStickyHeader'] = true;
				if ( $logo = wpex_global_obj( 'fixed_header_logo' ) ) {
					$array['stickyheaderCustomLogo'] = esc_url( $logo );
					if ( $logo = wpex_global_obj( 'fixed_header_logo_retina' ) ) {
						$array['stickyheaderCustomLogoRetina'] = esc_url( $logo );
					}
				}
				$array['stickyHeaderStyle']      = wpex_global_obj( 'fixed_header_style' );
				$array['hasStickyMobileHeader']  = wpex_get_mod( 'fixed_header_mobile' );
				$array['overlayHeaderStickyTop'] = 0;
				$array['stickyHeaderBreakPoint'] = 960;

				// Shrink sticky header > used for local-scroll offset
				if ( wpex_global_obj( 'shrink_fixed_header' ) ) {
					$height = intval( wpex_get_mod( 'fixed_header_shrink_end_height' ) );
					$height = $height ? $height + 20 : 70;
					$array['shrinkHeaderHeight'] = $height;
				}
				
			}

			// Sticky Navbar
			if ( 'two' == $header_style || 'three' == $header_style || 'four' == $header_style ) {
				$enabled = wpex_get_mod( 'fixed_header_menu', true );
				$array['hasStickyNavbar'] = $enabled;
				if ( $enabled ) {
					$array['hasStickyNavbarMobile']  = wpex_get_mod( 'fixed_header_menu_mobile' );
					$array['stickyNavbarBreakPoint'] = 960;
				}
			}

			// Header five
			if ( 'five' == $header_style ) {
				$array['headerFiveSplitOffset'] = 1;
			}

			// WooCart
			if ( WPEX_WOOCOMMERCE_ACTIVE ) {
				$array['wooCartStyle'] = wpex_global_obj( 'menu_cart_style' );
			}

		} // End header params

		// Toggle mobile menu
		if ( 'toggle' == $mm_style ) {
			$array['animateMobileToggle'] = true;
			if ( 'fixedTopNav' != $mm_toggle_style && ( wpex_global_obj( 'has_overlay_header' ) || wpex_get_mod( 'fixed_header_mobile' ) ) ) {
				$mobileToggleMenuPosition = 'absolute';
			} else {
				$mobileToggleMenuPosition =  'static';
			}
			$array['mobileToggleMenuPosition'] = $mobileToggleMenuPosition;
		}

		// Sidr settings
		if ( 'sidr' == $mm_style ) {
			$sidr_side = wpex_get_mod( 'mobile_menu_sidr_direction' );
			$sidr_side = $sidr_side ? $sidr_side : 'left'; // Fallback is crucial
			$array['sidrSource']         = wpex_global_obj( 'sidr_menu_source' );
			$array['sidrDisplace']       = wpex_get_mod( 'mobile_menu_sidr_displace', true ) ?  true : false;
			$array['sidrSide']           = $sidr_side;
			$array['sidrBodyNoScroll']   = false;
			$array['sidrSpeed']          = 300;
			$array['sidrDropdownTarget'] = 'arrow';
		}

		// Sticky topBar
		if ( wpex_get_mod( 'top_bar_sticky' ) ) {
			$array['stickyTopBarBreakPoint'] = 960;
			$array['hasStickyTopBarMobile']  = true;
		}

		// Full screen mobile menu style
		if ( 'full_screen' == $mm_style ) {
			$array['fullScreenMobileMenuStyle'] = wpex_get_mod( 'full_screen_mobile_menu_style', 'white' );
		}

		// Apply filters and return array - sanitization done by wp_localize_script
		return apply_filters( 'wpex_localize_array', $array );
	}

	/**
	 * Add headers for IE to override IE's Compatibility View Settings
	 *
	 * @since 2.1.0
	 */
	public static function x_ua_compatible_headers( $headers ) {
		$headers['X-UA-Compatible'] = 'IE=edge';
		return $headers;
	}

	/**
	 * Adds CSS for ie8
	 * Applies the wpex_ie_8_url filter so you can alter your IE8 stylesheet URL
	 *
	 * @since 1.6.0
	 */
	public static function browser_dependent_css() {
		$ie_8 = apply_filters( 'wpex_ie8_stylesheet', WPEX_CSS_DIR_URI .'ie8.css' );
		echo '<!--[if IE 8]><link rel="stylesheet" type="text/css" href="'. $ie_8 .'" media="screen"><![endif]-->';
		$ie_9 = apply_filters( 'wpex_ie9_stylesheet', WPEX_CSS_DIR_URI .'ie9.css' );
		echo '<!--[if IE 9]><link rel="stylesheet" type="text/css" href="'. $ie_9 .'" media="screen"><![endif]-->';
	}

	/**
	 * Load HTML5 dependencies for IE8
	 *
	 * @since 1.6.0
	 */
	public static function html5_shiv() {
		echo '<!--[if lt IE 9]><script src="'. WPEX_JS_DIR_URI .'html5.js"></script><![endif]-->';
	}

	/**
	 * Registers the theme sidebars (widget areas)
	 *
	 * @since 1.6.0
	 */
	public static function register_sidebars() {

		// Heading element type
		$sidebar_headings = wpex_get_mod( 'sidebar_headings', 'div' );
		$sidebar_headings = $sidebar_headings ? $sidebar_headings : 'div';
		$footer_headings  = wpex_get_mod( 'footer_headings', 'div' );
		$footer_headings  = $footer_headings ? $footer_headings : 'div';

		// Main Sidebar
		register_sidebar( array(
			'name'          => esc_html__( 'Main Sidebar', 'total' ),
			'id'            => 'sidebar',
			'before_widget' => '<div class="sidebar-box %2$s clr">',
			'after_widget'  => '</div>',
			'before_title'  => '<'. $sidebar_headings .' class="widget-title">',
			'after_title'   => '</'. $sidebar_headings .'>',
		) );

		// Pages Sidebar
		if ( wpex_get_mod( 'pages_custom_sidebar', true ) ) {
			register_sidebar( array(
				'name'          => esc_html__( 'Pages Sidebar', 'total' ),
				'id'            => 'pages_sidebar',
				'before_widget' => '<div class="sidebar-box %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<'. $sidebar_headings .' class="widget-title">',
				'after_title'   => '</'. $sidebar_headings .'>',
			) );
		}

		// Search Results Sidebar
		if ( wpex_get_mod( 'search_custom_sidebar', true ) ) {
			register_sidebar( array(
				'name'          => esc_html__( 'Search Results Sidebar', 'total' ),
				'id'            => 'search_sidebar',
				'before_widget' => '<div class="sidebar-box %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<'. $sidebar_headings .' class="widget-title">',
				'after_title'   => '</'. $sidebar_headings .'>',
			) );
		}

		// Check if footer widgets are enabled
		$footer_widgets = wpex_get_mod( 'footer_widgets', true );
		$footer_widgets = apply_filters( 'wpex_register_footer_sidebars', $footer_widgets );

		// Register footer widgets if enabled
		if ( $footer_widgets ) {

			// Footer widget columns
			$footer_columns = wpex_get_mod( 'footer_widgets_columns', '4' );
			
			// Footer 1
			register_sidebar( array(
				'name'          => esc_html__( 'Footer Column 1', 'total' ),
				'id'            => 'footer_one',
				'before_widget' => '<div class="footer-widget %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<'. $footer_headings .' class="widget-title">',
				'after_title'   => '</'. $footer_headings .'>',
			) );
			
			// Footer 2
			if ( $footer_columns > '1' ) {
				register_sidebar( array(
					'name'          => esc_html__( 'Footer Column 2', 'total' ),
					'id'            => 'footer_two',
					'before_widget' => '<div class="footer-widget %2$s clr">',
					'after_widget'  => '</div>',
					'before_title'  => '<'. $footer_headings .' class="widget-title">',
					'after_title'   => '</'. $footer_headings .'>'
				) );
			}
			
			// Footer 3
			if ( $footer_columns > '2' ) {
				register_sidebar( array(
					'name'          => esc_html__( 'Footer Column 3', 'total' ),
					'id'            => 'footer_three',
					'before_widget' => '<div class="footer-widget %2$s clr">',
					'after_widget'  => '</div>',
					'before_title'  => '<'. $footer_headings .' class="widget-title">',
					'after_title'   => '</'. $footer_headings .'>',
				) );
			}
			
			// Footer 4
			if ( $footer_columns > '3' ) {
				register_sidebar( array(
					'name'          => esc_html__( 'Footer Column 4', 'total' ),
					'id'            => 'footer_four',
					'before_widget' => '<div class="footer-widget %2$s clr">',
					'after_widget'  => '</div>',
					'before_title'  => '<'. $footer_headings .' class="widget-title">',
					'after_title'   => '</'. $footer_headings .'>',
				) );
			}

			// Footer 5
			if ( $footer_columns > '4' ) {
				register_sidebar( array(
					'name'          => esc_html__( 'Footer Column 5', 'total' ),
					'id'            => 'footer_five',
					'before_widget' => '<div class="footer-widget %2$s clr">',
					'after_widget'  => '</div>',
					'before_title'  => '<'. $footer_headings .' class="widget-title">',
					'after_title'   => '</'. $footer_headings .'>',
				) );
			}

		}

	}

	/**
	 * Add the gallery metabox to more post types
	 *
	 * @since 2.0.0
	 */
	public static function add_gallery_metabox( $types ) {
		$types[] = 'page';
		return $types;
	}

	/**
	 * Defines the directory URI for the gallery metabox class.
	 *
	 * @since 1.6.3
	 */
	public static function gallery_metabox_dir_uri() {
		return WPEX_FRAMEWORK_DIR_URI .'classes/gallery-metabox/';
	}

	/**
	 * All theme functions hook into the wpex_head_css filter for this function.
	 * This way all dynamic CSS is minified and outputted in one location in the site header.
	 *
	 * @since 1.6.0
	 */
	public static function custom_css( $output = NULL ) {

		// Add filter for adding custom css via other functions
		$output = apply_filters( 'wpex_head_css', $output );

		// Minify and output CSS in the wp_head
		if ( ! empty( $output ) ) {
			echo "<!-- TOTAL CSS -->\n<style type=\"text/css\">\n" . wp_strip_all_tags( wpex_minify_css( $output ) ) . "\n</style>";
		}

	}

	/**
	 * Adds inline CSS for the admin
	 *
	 * @since 1.6.0
	 */
	public static function admin_inline_css() {
		echo '<style>div#setting-error-tgmpa{display:block;}</style>';
	}

	/**
	 * Alters the default WordPress tag cloud widget arguments.
	 * Makes sure all font sizes for the cloud widget are set to 1em.
	 *
	 * @since 1.6.0 
	 */
	public static function widget_tag_cloud_args( $args ) {
		$args['largest']  = '0.923';
		$args['smallest'] = '0.923';
		$args['unit']     = 'em';
		return $args;
	}

	/**
	 * Alter wp list categories arguments.
	 * Adds a span around the counter for easier styling.
	 *
	 * @since 1.6.0
	 */
	public static function wp_list_categories_args( $links ) {
		$links = str_replace( '</a> (', '</a> <span class="cat-count-span">(', $links );
		$links = str_replace( ')', ')</span>', $links );
		return $links;
	}

	/**
	 * This function runs before the main query.
	 *
	 * @since 1.6.0
	 */
	public static function pre_get_posts( $query ) {

		// Only alter main query
		if ( ! $query->is_main_query() ) {
			return;
		}

		// Search pagination
		if ( is_search() ) {
			$query->set( 'posts_per_page', wpex_get_mod( 'search_posts_per_page', '10' ) );
			return;
		}

		// Exclude categories from the main blog
		if ( ( is_home() || is_page_template( 'templates/blog.php' ) ) && $cats = wpex_blog_exclude_categories() ) {
			$query->set( 'category__not_in', $cats );
			return;
		}

		// Category pagination
		if ( $query->is_category() ) {
			$terms = get_terms( 'category' );
			if ( ! empty( $terms ) ) {
				foreach ( $terms as $term ) {
					if ( is_category( $term->slug ) ) {
						$term_id    = $term->term_id;
						$term_data  = get_option( "category_$term_id" );
						if ( $term_data ) {
							if ( ! empty( $term_data['wpex_term_posts_per_page'] ) ) {
								$query->set( 'posts_per_page', $term_data['wpex_term_posts_per_page'] );
								return;
							}
						}
					}
				}
			}
		}

	}

	/**
	 * Add new user fields / user meta
	 *
	 * @since 1.6.0
	 */
	public static function add_user_social_fields( $contactmethods ) {

		$branding = wpex_get_theme_branding();
		$branding = $branding ? $branding .' - ' : '';

		if ( ! isset( $contactmethods['wpex_twitter'] ) ) {
			$contactmethods['wpex_twitter'] = $branding .'Twitter';
		}

		if ( ! isset( $contactmethods['wpex_facebook'] ) ) {
			$contactmethods['wpex_facebook'] = $branding .'Facebook';
		}

		if ( ! isset( $contactmethods['wpex_googleplus'] ) ) {
			$contactmethods['wpex_googleplus'] = $branding .'Google+';
		}

		if ( ! isset( $contactmethods['wpex_linkedin'] ) ) {
			$contactmethods['wpex_linkedin'] = $branding .'LinkedIn';
		}

		if ( ! isset( $contactmethods['wpex_pinterest'] ) ) {
			$contactmethods['wpex_pinterest'] = $branding .'Pinterest';
		}
		
		if ( ! isset( $contactmethods['wpex_instagram'] ) ) {
			$contactmethods['wpex_instagram'] = $branding .'Instagram';
		}

		return $contactmethods;

	}

	/**
	 * Alters the default oembed output.
	 * Adds special classes for responsive oembeds via CSS.
	 *
	 * @since 1.6.0
	 */
	public static function oembed_html( $cache, $url, $attr, $post_ID ) {

		// Remove frameborder
		$cache = str_replace( 'frameborder="0"', '', $cache );

		// Supported video embeds
		$hosts = apply_filters( 'wpex_oembed_responsive_hosts', array(
			'vimeo.com',
			'youtube.com',
			'blip.tv',
			'money.cnn.com',
			'dailymotion.com',
			'flickr.com',
			'hulu.com',
			'kickstarter.com',
			'vine.co',
			'soundcloud.com',
		) );

		// Supports responsive
		$supports_responsive = false;

		// Check if responsive wrap should be added
		foreach( $hosts as $host ) {
			if ( strpos( $url, $host ) !== false ) {
				$supports_responsive = true;
				break; // no need to loop further
			}
		}

		// Output code
		if ( $supports_responsive ) {
			return '<p class="responsive-video-wrap wpex-clr">' . $cache . '</p>';
		} else {
			return '<div class="wpex-oembed-wrap wpex-clr">' . $cache . '</div>';
		}

	}

	/**
	 * The wp_get_attachment_url() function doesn't distinguish whether a page request arrives via HTTP or HTTPS.
	 * Using wp_get_attachment_url filter, we can fix this to avoid the dreaded mixed content browser warning
	 *
	 * @since 1.6.0
	 */
	public static function honor_ssl_for_attachments( $url ) {
		$http     = site_url( FALSE, 'http' );
		$https    = site_url( FALSE, 'https' );
		$isSecure = false;
		if ( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443 ) {
			$isSecure = true;
		}
		if ( $isSecure ) {
			return str_replace( $http, $https, $url );
		} else {
			return $url;
		}
	}

	/**
	 * Alters the default WordPress password protected form so it's easier to style
	 *
	 * @since 2.0.0
	 */
	public static function custom_password_protected_form() {
		ob_start();
		include( locate_template( 'partials/password-protection-form.php' ) );
		return ob_get_clean();
	}


	/**
	 * Modify JOIN in the next/prev function
	 *
	 * @since 2.0.0
	 */
	public static function prev_next_join( $join ) {
		global $wpdb;
		$join .= " LEFT JOIN $wpdb->postmeta AS m ON ( p.ID = m.post_id AND m.meta_key = 'wpex_post_link' )";
		return $join;
	}

	/**
	 * Modify WHERE in the next/prev function
	 *
	 * @since 2.0.0
	 */
	public static function prev_next_where( $where ) {
		$where .= " AND ( (m.meta_key = 'wpex_post_link' AND CAST(m.meta_value AS CHAR) = '' ) OR m.meta_id IS NULL ) ";
		return $where;
	}

	/**
	 * Redirect posts using custom links
	 *
	 * @since 2.0.0
	 */
	public static function redirect_custom_links() {
		if ( ! wpex_vc_is_inline()
			&& is_singular()
			&& $custom_link = wpex_get_custom_permalink()
		) {
			wp_redirect( $custom_link, 301 );
		}
	}

	/**
	 * When a term is deleted, delete its data.
	 *
	 * @since 2.1.0
	 */
	public static function delete_term( $term_id ) {

		// If term id is defined
		if ( $term_id = absint( $term_id ) ) {
			
			// Get terms data
			$term_data = get_option( 'wpex_term_data' );

			// Remove key with term data
			if ( $term_data && isset( $term_data[$term_id] ) ) {
				unset( $term_data[$term_id] );
				update_option( 'wpex_term_data', $term_data );
			}

		}

	}

	/**
	 * Adds extra classes to the post_class() output
	 *
	 * @since 3.0.0
	 */
	public static function post_class( $classes ) {

		// Get post
		global $post;

		// Add entry class
		$classes[] = 'entry';

		// Add has media class
		if ( has_post_thumbnail()
			|| get_post_meta( $post->ID, 'wpex_post_oembed', true )
			|| get_post_meta( $post->ID, 'wpex_post_self_hosted_media', true )
			|| get_post_meta( $post->ID, 'wpex_post_video_embed', true )
			|| wpex_post_has_gallery( $post->ID )
		) {
			$classes[] = 'has-media';
		}

		// Return classes
		return $classes;

	}

	/**
	 * Add schema markup to the authors post link
	 *
	 * @since 3.0.0
	 */
	public static function the_author_posts_link( $link ) {

		// Add schema markup
		$schema = wpex_get_schema_markup( 'author_link' );
		if ( $schema ) {
			$link = str_replace( 'rel="author"', 'rel="author"'. $schema, $link );
		}

		// Return link
		return $link;

	}

	/**
	 * Move Comment form field back to bottom which was altered in WP 4.4
	 *
	 * @since 3.3.0
	 */
	public static function move_comment_form_fields( $fields ) {
		$comment_field = $fields['comment'];
		unset( $fields['comment'] );
		$fields['comment'] = $comment_field;
		return $fields;
	}

	/**
	 * Disable canonical redirect on the homepage when using pagination via VC modules
	 * or when using the blog template on the homepage
	 *
	 * @since 3.3.3
	 */
	public static function home_pagination_fix( $redirect_url ) {
		if ( is_paged() && is_singular() ) {
			$redirect_url = false;
		}
		return $redirect_url;
	}

	/**
	 * Filters the kses_allowed_protocols for sanitization like esc_url to allow
	 * specific protocols such as skype calls
	 *
	 * @since 3.5.0
	 */
	public static function kses_allowed_protocols( $protocols ) {
		$protocols[] = 'skype';
		return $protocols;
	}

	/**
	 * Filters the comments_link for smoother local scrolling and to
	 * fix issues with fixed/sticky elements
	 *
	 * @since 3.5.0
	 */
	public static function get_comments_link( $comments_link, $post_id ) {
		$hash = get_comments_number( $post_id ) ? '#view_comments' : '#comments_reply';
		$comments_link = get_permalink( $post_id ) . $hash;
		return $comments_link;
	}

}
new WPEX_Theme_Setup;