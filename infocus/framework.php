<?php
/**
 * The Mysitemyway class. Defines the necessary constants 
 * and includes the necessary files for theme's operation.
 *
 * @package Mysitemyway
 * @subpackage inFocus
 */

class Mysitemyway {
	
	/**
	 * Initializes the theme framework by loading
	 * required files and functions for the theme.
	 *
	 * @since 1.0
	 */
	public static function init( $options ) {
		self::constants( $options );
		self::functions();
		self::extensions();
		self::classes();
		self::variables();
		self::actions();
		self::filters();
		self::supports();
		self::locale();
		self::admin();
	}
	
	/**
	 * Define theme constants.
	 *
	 * @since 1.0
	 */
	function constants( $options ) {
		define( 'THEME_NAME', $options['theme_name'] );
		define( 'THEME_SLUG', get_template() );
		define( 'THEME_VERSION', $options['theme_version'] );
		define( 'FRAMEWORK_VERSION', '3.1' );
		define( 'DOCUMENTATION_URL', 'http://mysitemyway.com/docs/index.php/Main_Page' );
		define( 'SUPPORT_URL', 'http://mysitemyway.com/support' );
		define( 'MYSITE_PREFIX', 'mysite' );
		define( 'MYSITE_TEXTDOMAIN', THEME_SLUG );
		define( 'MYSITE_ADMIN_TEXTDOMAIN', THEME_SLUG . '_admin' );
		
		define( 'MYSITE_SETTINGS', 'mysite_' . THEME_SLUG . '_options' );
		define( 'MYSITE_INTERNAL_SETTINGS', 'mysite_' . THEME_SLUG . '_internal_options' );
		define( 'MYSITE_SIDEBARS', 'mysite_' . THEME_SLUG . '_sidebars' );
		define( 'MYSITE_SKINS', 'mysite_' . THEME_SLUG . '_skins' );
		define( 'MYSITE_ACTIVE_SKIN', 'mysite_' . THEME_SLUG . '_active_skin' );
		define( 'MYSITE_SKIN_NT_WRITABLE', 'mysite_' . THEME_SLUG . '_skins_nt_writable' );

		define( 'THEME_URI', get_template_directory_uri() );
		define( 'THEME_DIR', get_template_directory() );

		define( 'THEME_LIBRARY', THEME_DIR . '/lib' );
		define( 'THEME_ADMIN', THEME_LIBRARY . '/admin' );
		define( 'THEME_FUNCTIONS', THEME_LIBRARY . '/functions' );
		define( 'THEME_CLASSES', THEME_LIBRARY . '/classes' );
		define( 'THEME_EXTENSIONS', THEME_LIBRARY . '/extensions' );
		define( 'THEME_SHORTCODES', THEME_LIBRARY . '/shortcodes' );
		define( 'THEME_CACHE', THEME_DIR . '/cache' );
		define( 'THEME_FONTS', THEME_LIBRARY . '/scripts/fonts' );
		define( 'THEME_STYLES_DIR', THEME_DIR . '/styles' );
		define( 'THEME_PATTERNS_DIR', THEME_STYLES_DIR . '/_patterns' );
		define( 'THEME_SPRITES_DIR', THEME_STYLES_DIR . '/_sprites' );
		define( 'THEME_IMAGES_DIR', THEME_DIR . '/images' );

		define( 'THEME_PATTERNS', '_patterns' );
		define( 'THEME_IMAGES', THEME_URI . '/images' );
		define( 'THEME_IMAGES_ASSETS', THEME_IMAGES . '/assets' );
		define( 'THEME_JS', THEME_URI . '/lib/scripts' );
		define( 'THEME_STYLES', THEME_URI . '/styles' );
		define( 'THEME_SPRITES', THEME_STYLES . '/_sprites' );

		define( 'THEME_ADMIN_FUNCTIONS', THEME_ADMIN . '/functions' );
		define( 'THEME_ADMIN_CLASSES', THEME_ADMIN . '/classes');
		define( 'THEME_ADMIN_OPTIONS', THEME_ADMIN . '/options');
		define( 'THEME_ADMIN_ASSETS_URI', THEME_URI . '/lib/admin/assets' );
	}
		
	/**
	 * Loads theme functions.
	 *
	 * @since 1.0
	 */
	function functions() {
		require_once( THEME_DIR . '/activation.php' );
		require_once( THEME_FUNCTIONS . '/hooks-actions.php' );
		require_once( THEME_FUNCTIONS . '/context.php' );
		require_once( THEME_FUNCTIONS . '/core.php' );
		require_once( THEME_FUNCTIONS . '/theme.php' );
		require_once( THEME_FUNCTIONS . '/sliders.php' );
		require_once( THEME_FUNCTIONS . '/scripts.php' );
		require_once( THEME_FUNCTIONS . '/image.php' );
		require_once( THEME_FUNCTIONS . '/bookmarks.php' );
		require_once( THEME_FUNCTIONS . '/hooks-actions.php' );
		require_once( THEME_FUNCTIONS . '/compatibility.php' );
	}
	
	/**
	 * Loads theme extensions.
	 *
	 * @since 1.0
	 */
	function extensions() {
		require_once( THEME_EXTENSIONS . '/breadcrumbs-plus/breadcrumbs-plus.php' );
	}
	
	/**
	 * Loads theme classes.
	 *
	 * @since 1.0
	 */
	function classes() {
		require_once( THEME_CLASSES . '/twitter-api.php' );
		require_once( THEME_CLASSES . '/contact.php' );
		require_once( THEME_CLASSES . '/menu-walker.php' );
		require_once( THEME_CLASSES . '/raw-shortcode.php' );
	}
	
	/**
	 * Loads theme actions.
	 *
	 * @since 1.0
	 */
	function actions() {
		global $mysite;
		
		# WordPress actions
		add_action( 'init', 'mysite_is_mobile_device' );
		add_action( 'init', 'mysite_is_responsive' );
		add_action( 'init', 'mysite_shortcodes_init' );
		add_action( 'init', 'mysite_menus' );
		add_action( 'init', 'mysite_post_types' );
		add_action( 'init', 'mysite_register_script' );
		add_action( 'init', 'mysite_wp_image_resize', 11 );
		add_action( 'init', array( 'mysiteForm', 'init'), 11 );
		add_action( 'widgets_init', 'mysite_sidebars' );
		add_action( 'widgets_init', 'mysite_widgets' );
		add_action( 'wp_head', 'mysite_seo_meta' );
		add_action( 'wp_head', 'mysite_mobile_meta' );
		add_action( 'wp_head', 'mysite_analytics' );
		add_action( 'wp_head', 'mysite_custom_bg' );
		add_action( 'wp_head', 'mysite_additional_headers', 99 );
		add_action( 'wp_head', 'mysite_fitvids' );
		add_action( 'get_header', 'mysite_custom_post_layout' );
		add_action( 'template_redirect', 'mysite_enqueue_script' );
		add_action( 'template_redirect', 'mysite_squeeze_page' );
		add_action( 'comment_form_defaults', 'mysite_comment_form_args' );
		remove_action( 'wp_head', 'rel_canonical' );
		
		# Mysitemyway actions
		add_action( 'mysite_head', 'mysite_header_scripts' );
		add_action( 'mysite_before_header', 'mysite_fullscreen_bg' );
		add_action( 'mysite_header', 'mysite_logo' );
		add_action( 'mysite_header', 'mysite_header_extras' );
		add_action( 'mysite_header', 'mysite_primary_menu' );
		add_action( 'mysite_header', 'mysite_responsive_menu' );
		add_action( 'mysite_after_header', 'mysite_slider_module' );
		add_action( 'mysite_after_header', 'mysite_teaser' );
		add_action( 'mysite_before_main', 'mysite_breadcrumbs' );
		add_action( 'mysite_before_page_content', 'mysite_home_content' );
		add_action( 'mysite_before_page_content', 'mysite_page_content' );
		add_action( 'mysite_before_page_content', 'mysite_page_title' );
		add_action( 'mysite_before_page_content', 'mysite_query_posts' );
		add_action( 'mysite_after_post', 'mysite_page_navi' );
		add_action( 'mysite_post_image_begin', 'mysite_post_img_shadow_before' );
		add_action( 'mysite_post_image_end', 'mysite_post_img_shadow_after' );
		add_action( 'mysite_portfolio_image_begin', 'mysite_post_img_shadow_before');
		add_action( 'mysite_portfolio_image_end', 'mysite_post_img_shadow_after' );
		add_action( 'mysite_before_portfolio_image', 'mysite_post_img_shadow_before' );
		add_action( 'mysite_after_portfolio_image', 'mysite_post_img_shadow_after' );
		add_action( 'mysite_singular-post_after_entry', 'mysite_post_nav' );
		add_action( 'mysite_singular-post_after_entry', 'mysite_post_meta_bottom' );
		add_action( 'mysite_singular-post_after_post', 'mysite_post_sociables' );
		add_action( 'mysite_singular-portfolio_after_post', 'mysite_post_sociables' );
		add_action( 'mysite_singular-post_after_post', 'mysite_about_author' );
		add_action( 'mysite_singular-post_after_post', 'mysite_like_module' );
		add_action( 'mysite_after_main', 'mysite_get_sidebar' );
		add_action( 'mysite_before_footer', 'mysite_footer_teaser' );
		add_action( 'mysite_footer', 'mysite_main_footer' );
		add_action( 'mysite_after_footer', 'mysite_sub_footer' );
		add_action( 'mysite_body_end', 'mysite_print_cufon' );
		add_action( 'mysite_body_end', 'mysite_image_preloading' );
		add_action( 'mysite_body_end', 'mysite_ios_rotate' );
		add_action( 'mysite_body_end', 'mysite_custom_javascript' );
		add_action( 'mysite_body_end', 'mysite_infocus_menu_script' );
	}
	
	/**
	 * Loads theme filters.
	 *
	 * @since 1.0
	 */
	function filters() {
		
		# Mysitemyway filters
		add_filter( 'mysite_avatar_size', create_function('','return "60";' ) );
		add_filter( 'mysite_additional_posts_title', create_function('','return;' ) );
		add_filter( 'mysite_read_more', 'mysite_read_more' );
		add_filter( 'mysite_blog_sc_meta', array( &$this, 'post_meta' ) );
		add_filter( 'mysite_widget_meta', 'mysite_widget_meta' );
		
		# WordPress filters
		//remove_filter( 'the_content', 'wpautop' );
		//remove_filter( 'the_content', 'wptexturize' );
		//add_filter( 'the_content', 'mysite_formatter', 99 );
		//add_filter( 'widget_text', 'mysite_formatter', 99 );
		
		add_filter( 'the_content', 'mysite_texturize_shortcode_before' );
		add_filter( 'the_content_more_link', 'mysite_full_read_more', 10, 2 );
		add_filter( 'excerpt_length', 'mysite_excerpt_length_long', 999 );
		add_filter( 'excerpt_more', 'mysite_excerpt_more' );
		add_filter( 'posts_where', 'mysite_multi_tax_terms' );
		add_filter( 'pre_get_posts', 'mysite_exclude_category_feed' );
		add_filter( 'pre_get_posts', 'mysite_custom_search' );
		add_filter( 'widget_categories_args', 'mysite_exclude_category_widget' );
		add_filter( 'query_vars', 'mysite_queryvars' );
		add_filter( 'rewrite_rules_array', 'mysite_rewrite_rules',10,2 );
		add_filter( 'widget_text', 'do_shortcode' );
		add_filter( 'wp_page_menu_args', 'mysite_page_menu_args' );
		add_filter( 'the_password_form', 'mysite_password_form' );
	}
	
	/**
	 * Loads theme supports.
	 *
	 * @since 1.0
	 */
	function supports() {
		add_theme_support( 'menus' );
		add_theme_support( 'widgets' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
	}

	/**
	 * Handles the locale functions file and translations.
	 *
	 * @since 1.0
	 */
	function locale() {
		# Get the user's locale.
		$locale = get_locale();
		
		if( is_admin() ) {
			# Load admin theme textdomain.
			load_theme_textdomain( MYSITE_ADMIN_TEXTDOMAIN, THEME_ADMIN . '/languages' );
			$locale_file = THEME_ADMIN . "/languages/$locale.php";
			
		} else {
			# Load theme textdomain.
			load_theme_textdomain( MYSITE_TEXTDOMAIN, THEME_DIR . '/languages' );
			$locale_file = THEME_DIR . "/languages/$locale.php";
		}
		
		if ( is_readable( $locale_file ) )
			require_once( $locale_file );
	}
	
	/**
	 * Loads admin files.
	 *
	 * @since 1.0
	 */
	function admin() {
		if( !is_admin() ) return;
			
		require_once( THEME_ADMIN . '/admin.php' );
		mysiteAdmin::init();
	}
	
	/**
	 * Define theme variables.
	 *
	 * @since 1.0
	 */
	function variables() {
		global $mysite;
		
		$layout = '';
		$img_set = get_option( MYSITE_SETTINGS );
		$img_set = ( !empty( $img_set ) && !isset( $_POST[MYSITE_SETTINGS]['reset'] ) ) ? $img_set : array();
		$blog_layout = apply_filters( 'mysite_blog_layout', mysite_get_setting( 'blog_layout' ) );
		
		# Images
		$images = array(
		    'one_column_portfolio' => array( 
		        ( !empty( $img_set['one_column_portfolio_full']['w'] ) ? $img_set['one_column_portfolio_full']['w'] : 950 ),
		        ( !empty( $img_set['one_column_portfolio_full']['h'] ) ? $img_set['one_column_portfolio_full']['h'] : 590 )),
		    'two_column_portfolio' => array( 
		        ( !empty( $img_set['two_column_portfolio_full']['w'] ) ? $img_set['two_column_portfolio_full']['w'] : 446 ),
		        ( !empty( $img_set['two_column_portfolio_full']['h'] ) ? $img_set['two_column_portfolio_full']['h'] : 277 )),
		    'three_column_portfolio' => array( 
		        ( !empty( $img_set['three_column_portfolio_full']['w'] ) ? $img_set['three_column_portfolio_full']['w'] : 278 ),
		        ( !empty( $img_set['three_column_portfolio_full']['h'] ) ? $img_set['three_column_portfolio_full']['h'] : 172 )),
		    'four_column_portfolio' => array( 
		        ( !empty( $img_set['four_column_portfolio_full']['w'] ) ? $img_set['four_column_portfolio_full']['w'] : 194 ),
		        ( !empty( $img_set['four_column_portfolio_full']['h'] ) ? $img_set['four_column_portfolio_full']['h'] : 120 )),

		    'one_column_blog' => array( 
		        ( !empty( $img_set['one_column_blog_full']['w'] ) ? $img_set['one_column_blog_full']['w'] : 950 ),
		        ( !empty( $img_set['one_column_blog_full']['h'] ) ? $img_set['one_column_blog_full']['h'] : 365 )),
		    'two_column_blog' => array( 
		        ( !empty( $img_set['two_column_blog_full']['w'] ) ? $img_set['two_column_blog_full']['w'] : 446 ),
		        ( !empty( $img_set['two_column_blog_full']['h'] ) ? $img_set['two_column_blog_full']['h'] : 171 )),
		    'three_column_blog' => array( 
		        ( !empty( $img_set['three_column_blog_full']['w'] ) ? $img_set['three_column_blog_full']['w'] : 278 ),
		        ( !empty( $img_set['three_column_blog_full']['h'] ) ? $img_set['three_column_blog_full']['h'] : 106 )),
		    'four_column_blog' => array( 
		        ( !empty( $img_set['four_column_blog_full']['w'] ) ? $img_set['four_column_blog_full']['w'] : 194 ),
		        ( !empty( $img_set['four_column_blog_full']['h'] ) ? $img_set['four_column_blog_full']['h'] : 74 )),

		    'small_post_list' => array( 
		        ( !empty( $img_set['small_post_list_full']['w'] ) ? $img_set['small_post_list_full']['w'] : 60 ),
		        ( !empty( $img_set['small_post_list_full']['h'] ) ? $img_set['small_post_list_full']['h'] : 60 )),
		    'medium_post_list' => array( 
		        ( !empty( $img_set['medium_post_list_full']['w'] ) ? $img_set['medium_post_list_full']['w'] : 200 ),
		        ( !empty( $img_set['medium_post_list_full']['h'] ) ? $img_set['medium_post_list_full']['h'] : 200 )),
		    'large_post_list' => array( 
		        ( !empty( $img_set['large_post_list_full']['w'] ) ? $img_set['large_post_list_full']['w'] : 614 ),
		        ( !empty( $img_set['large_post_list_full']['h'] ) ? $img_set['large_post_list_full']['h'] : 381 )),

		    'portfolio_single_full' => array( 
		        ( !empty( $img_set['portfolio_single_full_full']['w'] ) ? $img_set['portfolio_single_full_full']['w'] : 950 ),
		        ( !empty( $img_set['portfolio_single_full_full']['h'] ) ? $img_set['portfolio_single_full_full']['h'] : 590 )),
		    'additional_posts_grid' => array( 
		        ( !empty( $img_set['additional_posts_grid_full']['w'] ) ? $img_set['additional_posts_grid_full']['w'] : 194 ),
		        ( !empty( $img_set['additional_posts_grid_full']['h'] ) ? $img_set['additional_posts_grid_full']['h'] : 120 )),

		);

		$big_sidebar_images = array(
		    'one_column_portfolio' => array( 
		        ( !empty( $img_set['one_column_portfolio_big']['w'] ) ? $img_set['one_column_portfolio_big']['w'] : 614 ),
		        ( !empty( $img_set['one_column_portfolio_big']['h'] ) ? $img_set['one_column_portfolio_big']['h'] : 381 )),
		    'two_column_portfolio' => array( 
		        ( !empty( $img_set['two_column_portfolio_big']['w'] ) ? $img_set['two_column_portfolio_big']['w'] : 286 ),
		        ( !empty( $img_set['two_column_portfolio_big']['h'] ) ? $img_set['two_column_portfolio_big']['h'] : 177 )),
		    'three_column_portfolio' => array( 
		        ( !empty( $img_set['three_column_portfolio_big']['w'] ) ? $img_set['three_column_portfolio_big']['w'] : 177 ),
		        ( !empty( $img_set['three_column_portfolio_big']['h'] ) ? $img_set['three_column_portfolio_big']['h'] : 109 )),
		    'four_column_portfolio' => array( 
		        ( !empty( $img_set['four_column_portfolio_big']['w'] ) ? $img_set['four_column_portfolio_big']['w'] : 122 ),
		        ( !empty( $img_set['four_column_portfolio_big']['h'] ) ? $img_set['four_column_portfolio_big']['h'] : 75 )),

		    'one_column_blog' => array( 
		        ( !empty( $img_set['one_column_blog_big']['w'] ) ? $img_set['one_column_blog_big']['w'] : 614 ),
		        ( !empty( $img_set['one_column_blog_big']['h'] ) ? $img_set['one_column_blog_big']['h'] : 236 )),
		    'two_column_blog' => array( 
		        ( !empty( $img_set['two_column_blog_big']['w'] ) ? $img_set['two_column_blog_big']['w'] : 286 ),
		        ( !empty( $img_set['two_column_blog_big']['h'] ) ? $img_set['two_column_blog_big']['h'] : 110 )),
		    'three_column_blog' => array( 
		        ( !empty( $img_set['three_column_blog_big']['w'] ) ? $img_set['three_column_blog_big']['w'] : 177 ),
		        ( !empty( $img_set['three_column_blog_big']['h'] ) ? $img_set['three_column_blog_big']['h'] : 68 )),
		    'four_column_blog' => array( 
		        ( !empty( $img_set['four_column_blog_big']['w'] ) ? $img_set['four_column_blog_big']['w'] : 122 ),
		        ( !empty( $img_set['four_column_blog_big']['h'] ) ? $img_set['four_column_blog_big']['h'] : 46 )),

		    'small_post_list' => array( 
		        ( !empty( $img_set['small_post_list_big']['w'] ) ? $img_set['small_post_list_big']['w'] : 60 ),
		        ( !empty( $img_set['small_post_list_big']['h'] ) ? $img_set['small_post_list_big']['h'] : 60 )),
		    'medium_post_list' => array( 
		        ( !empty( $img_set['medium_post_list_big']['w'] ) ? $img_set['medium_post_list_big']['w'] : 200 ),
		        ( !empty( $img_set['medium_post_list_big']['h'] ) ? $img_set['medium_post_list_big']['h'] : 200 )),
		    'large_post_list' => array( 
		        ( !empty( $img_set['large_post_list_big']['w'] ) ? $img_set['large_post_list_big']['w'] : 395 ),
		        ( !empty( $img_set['large_post_list_big']['h'] ) ? $img_set['large_post_list_big']['h'] : 245 )),

		    'portfolio_single_full' => array( 
		        ( !empty( $img_set['portfolio_single_full_big']['w'] ) ? $img_set['portfolio_single_full_big']['w'] : 614 ),
		        ( !empty( $img_set['portfolio_single_full_big']['h'] ) ? $img_set['portfolio_single_full_big']['h'] : 381 )),
		    'additional_posts_grid' => array( 
		        ( !empty( $img_set['additional_posts_grid_big']['w'] ) ? $img_set['additional_posts_grid_big']['w'] : 122 ),
		        ( !empty( $img_set['additional_posts_grid_big']['h'] ) ? $img_set['additional_posts_grid_big']['h'] : 75 )),

		);

		$small_sidebar_images = array(
		    'one_column_portfolio' => array( 
		        ( !empty( $img_set['one_column_portfolio_small']['w'] ) ? $img_set['one_column_portfolio_small']['w'] : 672 ),
		        ( !empty( $img_set['one_column_portfolio_small']['h'] ) ? $img_set['one_column_portfolio_small']['h'] : 417 )),
		    'two_column_portfolio' => array( 
		        ( !empty( $img_set['two_column_portfolio_small']['w'] ) ? $img_set['two_column_portfolio_small']['w'] : 313 ),
		        ( !empty( $img_set['two_column_portfolio_small']['h'] ) ? $img_set['two_column_portfolio_small']['h'] : 194 )),
		    'three_column_portfolio' => array( 
		        ( !empty( $img_set['three_column_portfolio_small']['w'] ) ? $img_set['three_column_portfolio_small']['w'] : 194 ),
		        ( !empty( $img_set['three_column_portfolio_small']['h'] ) ? $img_set['three_column_portfolio_small']['h'] : 120 )),
		    'four_column_portfolio' => array( 
		        ( !empty( $img_set['four_column_portfolio_small']['w'] ) ? $img_set['four_column_portfolio_small']['w'] : 134 ),
		        ( !empty( $img_set['four_column_portfolio_small']['h'] ) ? $img_set['four_column_portfolio_small']['h'] : 83 )),

		    'one_column_blog' => array( 
		        ( !empty( $img_set['one_column_blog_small']['w'] ) ? $img_set['one_column_blog_small']['w'] : 672 ),
		        ( !empty( $img_set['one_column_blog_small']['h'] ) ? $img_set['one_column_blog_small']['h'] : 258 )),
		    'two_column_blog' => array( 
		        ( !empty( $img_set['two_column_blog_small']['w'] ) ? $img_set['two_column_blog_small']['w'] : 313 ),
		        ( !empty( $img_set['two_column_blog_small']['h'] ) ? $img_set['two_column_blog_small']['h'] : 120 )),
		    'three_column_blog' => array( 
		        ( !empty( $img_set['three_column_blog_small']['w'] ) ? $img_set['three_column_blog_small']['w'] : 194 ),
		        ( !empty( $img_set['three_column_blog_small']['h'] ) ? $img_set['three_column_blog_small']['h'] : 74 )),
		    'four_column_blog' => array( 
		        ( !empty( $img_set['four_column_blog_small']['w'] ) ? $img_set['four_column_blog_small']['w'] : 134 ),
		        ( !empty( $img_set['four_column_blog_small']['h'] ) ? $img_set['four_column_blog_small']['h'] : 51 )),

		    'small_post_list' => array( 
		        ( !empty( $img_set['small_post_list_small']['w'] ) ? $img_set['small_post_list_small']['w'] : 60 ),
		        ( !empty( $img_set['small_post_list_small']['h'] ) ? $img_set['small_post_list_small']['h'] : 60 )),
		    'medium_post_list' => array( 
		        ( !empty( $img_set['medium_post_list_small']['w'] ) ? $img_set['medium_post_list_small']['w'] : 200 ),
		        ( !empty( $img_set['medium_post_list_small']['h'] ) ? $img_set['medium_post_list_small']['h'] : 200 )),
		    'large_post_list' => array( 
		        ( !empty( $img_set['large_post_list_small']['w'] ) ? $img_set['large_post_list_small']['w'] : 433 ),
		        ( !empty( $img_set['large_post_list_small']['h'] ) ? $img_set['large_post_list_small']['h'] : 268 )),

		    'portfolio_single_full' => array( 
		        ( !empty( $img_set['portfolio_single_full_small']['w'] ) ? $img_set['portfolio_single_full_small']['w'] : 672 ),
		        ( !empty( $img_set['portfolio_single_full_small']['h'] ) ? $img_set['portfolio_single_full_small']['h'] : 417 )),
		    'additional_posts_grid' => array( 
		        ( !empty( $img_set['additional_posts_grid_small']['w'] ) ? $img_set['additional_posts_grid_small']['w'] : 134 ),
		        ( !empty( $img_set['additional_posts_grid_small']['h'] ) ? $img_set['additional_posts_grid_small']['h'] : 83 )),

		);

		$additional_images = array(
		    'image_banner_intro' => array( 
		        ( !empty( $img_set['image_banner_intro_full']['w'] ) ? $img_set['image_banner_intro_full']['w'] : 960 ),
		        ( !empty( $img_set['image_banner_intro_full']['h'] ) ? $img_set['image_banner_intro_full']['h'] : 400 )),
		);
		


		# Slider
		$images_slider = array(
			'responsive_slide' => array( 960, 340 ),
			'nivo_slide' => array( 960, 340 ),
			'floating_slide' => array( 960, 340 ),
			'staged_slide' => array( 960, 340 ),
			'partial_staged_slide' => array( 600, 340 ),
			'partial_gradient_slide' => array( 600, 340 ),
			'overlay_slide' => array( 960, 340 ),
			'full_slide' => array( 960, 400 ),
			'nav_thumbs' => array( 34, 34 )
		);
		
		foreach( $images as $key => $value ) {
			foreach( $value as $img => $size ) {
				$size = str_replace( ' ', '', $size );
				$new_size[$img] = str_replace( 'px', '', $size );
			}
			$images[$key] = $new_size;
		}
	
		foreach( $big_sidebar_images as $key => $value ) {
			foreach( $value as $img => $size ) {
				$size = str_replace( ' ', '', $size );
				$new_size[$img] = str_replace( 'px', '', $size );
			}
			$big_sidebar_images[$key] = $new_size;
		}
	
		foreach( $small_sidebar_images as $key => $value ) {
			foreach( $value as $img => $size ) {
				$size = str_replace( ' ', '', $size );
				$new_size[$img] = str_replace( 'px', '', $size );
			}
			$small_sidebar_images[$key] = $new_size;
		}
		
		foreach( $additional_images as $key => $value ) {
			foreach( $value as $img => $size ) {
				$size = str_replace( ' ', '', $size );
				$new_size[$img] = str_replace( 'px', '', $size );
			}
			$additional_images[$key] = $new_size;
		}
		
	
		# Blog layouts
		switch( $blog_layout ) {
			case "blog_layout1":
				$layout = array(
					'blog_layout' => $blog_layout,
					'main_class' => 'post_grid blog_layout1',
					'post_class' => 'post_grid_module',
					'content_class' => 'post_grid_content',
					'img_class' => 'post_grid_image'
				);
				break;
			case "blog_layout2":
				$layout = array(
					'blog_layout' => $blog_layout,
					'main_class' => 'post_list blog_layout2',
					'post_class' => 'post_list_module',
					'content_class' => 'post_list_content',
					'img_class' => 'post_list_image'
				);
				break;
			case "blog_layout3":
				$columns_num = 2;
				$featured = 1;
				$columns = ( $columns_num == 2 ? 'one_half'
				: ( $columns_num == 3 ? 'one_third'
				: ( $columns_num == 4 ? 'one_fourth'
				: ( $columns_num == 5 ? 'one_fifth'
				: ( $columns_num == 6 ? 'one_sixth'
				: ''
				)))));
			
				$layout = array(
					'blog_layout' => $blog_layout,
					'main_class' => 'post_grid blog_layout3',
					'post_class' => 'post_grid_module',
					'content_class' => 'post_grid_content',
					'img_class' => 'post_grid_image',
					'columns_num' => ( !empty( $columns_num ) ? $columns_num : '' ),
					'featured' => ( !empty( $featured ) ? $featured : '' ),
					'columns' => ( !empty( $columns ) ? $columns : '' )
				);
				break;
		}
	
		$mysite->layout['blog'] = $layout;
		$mysite->layout['images'] = array_merge( $images, array( 'image_padding' => 10, 'column_margin' => 5 ) );
		$mysite->layout['big_sidebar_images'] = $big_sidebar_images;
		$mysite->layout['small_sidebar_images'] = $small_sidebar_images;
		$mysite->layout['additional_images'] = $additional_images;
		$mysite->layout['images_slider'] = $images_slider;
	}
	
}

/**
 * Functions & Pluggable functions specific to theme.
 *
 * @package Mysitemyway
 * @subpackage inFocus
 */

if ( !function_exists( 'mysite_read_more' ) ) :
/**
 *
 */
function mysite_read_more( $url ) {
	$out = '<p><a class="post_more_link hover_fade" href="' . $url . '">' . __( 'Read More', MYSITE_TEXTDOMAIN ) . '</a></p>';
	return $out;
}
endif;

if ( !function_exists( 'mysite_full_read_more' ) ) :
/**
 *
 */
function mysite_full_read_more( $more_link, $more_link_text ) {
	global $post;
	$out = '<p><a class="post_more_link hover_fade" href="' . esc_url( get_permalink( $post->ID ) ) . '#more-' . $post->ID . '">' . __( 'Read More', MYSITE_TEXTDOMAIN ) . '</a></p>';
	return '[raw]' . $out . '[/raw]';
}
endif;

if ( !function_exists( 'mysite_post_img_shadow_before' ) ) :
/**
 *
 */
function mysite_post_img_shadow_before() {
	$out = '<img src="' . THEME_IMAGES . '/shadow_top.png" class="infocus_shadow_top">';
	echo $out;
}
endif;

if ( !function_exists( 'mysite_post_img_shadow_after' ) ) :
/**
 *
 */
function mysite_post_img_shadow_after() {
	$out = '<img src="' . THEME_IMAGES . '/shadow_bottom.png" class="infocus_shadow_bottom">';
	echo $out;
}
endif;

if ( !function_exists( 'mysite_custom_post_layout' ) ) :
/**
 *
 */
function mysite_custom_post_layout() {
	global $mysite;
	
	if( $mysite->layout['blog']['blog_layout'] == 'blog_layout2' ) {
		add_action( 'mysite_before_entry', 'mysite_post_title' );
		add_action( 'mysite_before_entry', 'mysite_post_meta' );
	} elseif( is_singular( 'portfolio' ) ) {
		add_action( 'mysite_before_entry', 'mysite_post_title' );
		add_action( 'mysite_before_entry', 'mysite_portfolio_date' );
	} else {
		add_action( 'mysite_before_post', 'mysite_post_title' );
		add_action( 'mysite_before_post', 'mysite_post_meta' );
	}
		
	add_action( 'mysite_before_post', 'mysite_post_image' );
	add_action( 'mysite_singular-page_before_entry', 'mysite_post_image' );
}
endif;

if ( !function_exists( 'mysite_post_meta' ) ) :
/**
 *
 */
function mysite_post_meta( $args = array() ) {
	$defaults = array(
		'shortcode' => false,
		'echo' => true
	);
	
	$args = wp_parse_args( $args, $defaults );
	
	extract( $args );
	
	if( is_page() && !$shortcode ) return;
	
	global $mysite;
	
	$out = '';
	$meta_options = mysite_get_setting( 'disable_meta_options' );
	$_meta = ( is_array( $meta_options ) ) ? $meta_options : array();
	$meta_output = '';

	# Display post meta
	if( !in_array( 'date_meta', $_meta ) )
		$meta_output .= '[post_date text="' . __( 'Posted', MYSITE_TEXTDOMAIN ) . ' " format="M j Y"] ';

	if( !in_array( 'author_meta', $_meta ) )
		$meta_output .= '[post_author text="' . __( 'by', MYSITE_TEXTDOMAIN ) . ' "] ';

	if( !in_array( 'categories_meta', $_meta ) )
		$meta_output .= '[post_terms taxonomy="category" text=' . __( 'in&nbsp;', MYSITE_TEXTDOMAIN ) . '] ';

	if( !in_array( 'comments_meta', $_meta ) )
		$meta_output .= '[post_comments text="' . __( 'with', MYSITE_TEXTDOMAIN ) . ' "] ';

	if( !empty( $meta_output ) )
		$out .='<p class="post_meta">' . $meta_output . '</p>';

	if( $echo )
		echo apply_atomic_shortcode( 'post_meta', $out );
	else
		return apply_atomic_shortcode( 'post_meta', $out );
}
endif;

if ( !function_exists( 'mysite_post_meta_bottom' ) ) :
/**
 *
 */
function mysite_post_meta_bottom( $args = array() ) {
	if( is_page() ) return;
	
	$out = '';
	$meta_options = mysite_get_setting( 'disable_meta_options' );
	$_meta = ( is_array( $meta_options ) ) ? $meta_options : array();
	$meta_output = '';
	
	if( !in_array( 'tags_meta', $_meta ) )
		$meta_output .= '[post_terms text=' . __( '<em>Tags:</em>&nbsp;', MYSITE_TEXTDOMAIN ) . '] ';

	if( !in_array( 'categories_meta', $_meta ) )
		$meta_output .= '[post_terms taxonomy="category" text=' . __( '<em>Categories:</em>&nbsp;', MYSITE_TEXTDOMAIN ) . '] ';

	if( !empty( $meta_output ) )
		$out .='<p class="post_meta_bottom">' . $meta_output . '</p>';
	
	echo apply_atomic_shortcode( 'post_meta_bottom', $out );
}
endif;

if ( !function_exists( 'mysite_widget_meta' ) ) :
/**
 *
 */
function mysite_widget_meta() {
	return do_shortcode( '[post_date text="" format="F j, Y"]' );
}
endif;

if ( !function_exists( 'mysite_before_post_sc' ) ) :
/**
 *
 */
function mysite_before_post_sc( $filter_args ) {
	$out = '';
	
	if( in_array( 'post_list_image', $filter_args ) )
		$filter_args = array_merge( $filter_args, array( 'inline_width' => true ) );
	
	if( $filter_args['type'] == 'blog_grid' ) {
		
		if( strpos( $filter_args['disable'], 'title' ) === false )
			$out .= mysite_post_title( $filter_args );
		
		if( strpos( $filter_args['disable'], 'meta' ) === false )
			$out .= mysite_post_meta( $filter_args );
	}
	
	if( strpos( $filter_args['disable'], 'image' ) === false )
		$out .= mysite_get_post_image( $filter_args );
	
	return $out;
}
endif;

if ( !function_exists( 'mysite_before_entry_sc' ) ) :
/**
 *
 */
function mysite_before_entry_sc( $filter_args ) {
	$out = '';
	
	if( $filter_args['type'] == 'blog_list' ) {
		
		if( strpos( $filter_args['disable'], 'title' ) === false )
			$out .= mysite_post_title( $filter_args );
			
		if( strpos( $filter_args['disable'], 'meta' ) === false )
			$out .= mysite_post_meta( $filter_args );
	}
	
	return $out;
}
endif;

if ( !function_exists( 'mysite_comments_callback' ) ) :
/**
 *
 */
function mysite_comments_callback( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	$comment_type = get_comment_type( $comment->comment_ID );
	$author = esc_html( get_comment_author( $comment->comment_ID ) );
	$url = esc_url( get_comment_author_url( $comment->comment_ID ) );
	$default_avatar = ( 'pingback' == $comment_type || 'trackback' == $comment_type )
	? THEME_IMAGES_ASSETS . "/gravatar_{$comment_type}.png"
	: THEME_IMAGES_ASSETS . '/gravatar_default.png';

	?><li <?php comment_class() ?> id="comment-<?php comment_ID() ?>">
		<div id="div-comment-<?php comment_ID() ?>"><?php

		/* Display gravatar */
		$avatar = get_avatar( get_comment_author_email( $comment->comment_ID ), apply_filters( "mysite_avatar_size", '80' ), $default_avatar, $author );

		if ( $url )
			$avatar = '<a href="' . $url . '" rel="external nofollow" title="' . $author . '">' . $avatar . '</a>';
			
		?><div class="comment-author vcard"><?php
			echo $avatar;
		
			/* Display link and cite if URL is set. */
			if ( $url )
				echo '<cite class="fn" title="' . $url . '"><a href="' . $url . '" title="' . $author . '" class="url" rel="external nofollow">' . $author . '</a></cite>';
			else
				echo '<cite class="fn">' . $author . '</cite>';

			/* Display comment date */
			?><span class="date"><?php printf( __('%1$s', MYSITE_TEXTDOMAIN ), get_comment_date( __( apply_filters( "mysite_comment_date_format", 'm-d-Y' ) ) ) ); ?></span>
		
		</div>

		<div class="comment-text"><?php
			if ( $comment->comment_approved == '0' ) : ?>
				<p class="alert moderation"><?php _e( 'Your comment is awaiting moderation.', MYSITE_TEXTDOMAIN ); ?></p>
				<?php endif; ?>

				<?php comment_text() ?>

				<div class="comment-meta commentmetadata"><?php
					comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
					edit_comment_link( __( 'Edit', MYSITE_TEXTDOMAIN ), ' ' );
				?></div>
				
		</div><!-- .comment-text -->

		</div><!-- #div-comment-## -->
<?php
}
endif;

if ( !function_exists( 'mysite_infocus_menu_script' ) ) :
/**
 *
 */
function mysite_infocus_menu_script() {
	
	# Hide inFocus arrow on click
	$out = "jQuery('.jqueryslidemenu').click(function() {
	  jQuery('.menu_arrow').css('display','none');
	});";
	
	$out = '<script type="text/javascript">
	/* <![CDATA[ */
	' . $out . '
	/* ]]> */
	</script>';
	
	echo preg_replace( "/(\r\n|\r|\n)\s*/i", '', $out );
}
endif;

?>