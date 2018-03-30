<?php
/**
 * The Mysitemyway class. Defines the necessary constants 
 * and includes the necessary files for theme's operation.
 *
 * @package Mysitemyway
 * @subpackage Awake
 */

class Mysitemyway {
	
	/**
	 * Initializes the theme framework by loading
	 * required files and functions for the theme.
	 *
	 * @since 1.0
	 */
	function init( $options ) {
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
		define( 'THEME_ADMIN_CLASSES', THEME_ADMIN . '/classes' );
		define( 'THEME_ADMIN_OPTIONS', THEME_ADMIN . '/options' );
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
		require_once( THEME_FUNCTIONS . '/core.php' );
		require_once( THEME_FUNCTIONS . '/theme.php' );
		require_once( THEME_FUNCTIONS . '/context.php' );
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
		
		# WordPress actions
		add_action( 'init', 'mysite_is_mobile_device' );
		add_action( 'init', 'mysite_is_responsive' );
		add_action( 'init', 'mysite_shortcodes_init' );
		add_action( 'init', 'mysite_menus' );
		add_action( 'init', 'mysite_post_types'  );
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
		add_action( 'template_redirect', 'mysite_enqueue_script' );
		add_action( 'template_redirect', 'mysite_awake_search_cluetip' );
		add_action( 'template_redirect', 'mysite_squeeze_page' );
		add_action( 'comment_form_defaults', 'mysite_comment_form_args' );
		remove_action( 'wp_head', 'rel_canonical' );
		
		# Mysitemyway actions
		add_action( 'mysite_head', 'mysite_header_scripts' );
		add_action( 'mysite_before_header', 'mysite_fullscreen_bg' );
		add_action( 'mysite_header', 'mysite_logo' );
		add_action( 'mysite_header', 'mysite_header_extras' );
		add_action( 'mysite_after_header', 'mysite_primary_menu' );
		add_action( 'mysite_after_header', 'mysite_responsive_menu' );
		add_action( 'mysite_after_header', 'mysite_slider_module' );
		add_action( 'mysite_after_header', 'mysite_teaser' );
		add_action( 'mysite_before_page_content', 'mysite_home_content' );
		add_action( 'mysite_before_page_content', 'mysite_page_content' );
		add_action( 'mysite_before_page_content', 'mysite_page_title' );
		add_action( 'mysite_before_page_content', 'mysite_query_posts' );
		add_action( 'mysite_primary_menu_end', 'mysite_fancy_search' );
		add_action( 'mysite_before_main', 'mysite_breadcrumbs' );
		add_action( 'mysite_before_post', 'mysite_post_image' );
		add_action( 'mysite_after_post', 'mysite_page_navi' );
		add_action( 'mysite_before_entry', 'mysite_post_title' );
		add_action( 'mysite_singular-post_before_entry', 'mysite_post_meta' );
		add_action( 'mysite_singular-portfolio_before_entry', 'mysite_portfolio_date' );
		add_action( 'mysite_before_entry', 'mysite_comment_bubble' );
		add_action( 'mysite_singular-post_after_entry', 'mysite_post_meta_bottom' );
		add_action( 'mysite_singular-post_after_entry', 'mysite_post_nav' );
		add_action( 'mysite_singular-page_before_entry', 'mysite_post_image' );
		add_action( 'mysite_blog_after_entry', 'mysite_blog_meta_bottom' );
		add_action( 'mysite_singular-post_after_post', 'mysite_post_sociables' );
		add_action( 'mysite_singular-post_after_post', 'mysite_about_author' );
		add_action( 'mysite_singular-post_after_post', 'mysite_like_module' );
		add_action( 'mysite_singular-portfolio_after_post', 'mysite_post_sociables' );
		add_action( 'mysite_after_main', 'mysite_get_sidebar' );
		add_action( 'mysite_before_footer', 'mysite_footer_teaser' );
		add_action( 'mysite_footer', 'mysite_main_footer' );
		add_action( 'mysite_after_footer', 'mysite_sub_footer' );
		add_action( 'mysite_body_end', 'mysite_print_cufon' );
		add_action( 'mysite_body_end', 'mysite_image_preloading' );
		add_action( 'mysite_body_end', 'mysite_custom_javascript' );
		add_action( 'mysite_body_end', 'mysite_ios_rotate' );
		add_action( 'mysite_body_end', 'mysite_awake_scripts' );
	}
	
	/**
	 * Loads theme filters.
	 *
	 * @since 1.0
	 */
	function filters() {
		
		# Mysitemyway filters
		add_filter( 'mysite_avatar_size', create_function('','return "60";') );
		add_filter( 'mysite_author_avatar_size', create_function('','return "60";') );
		add_filter( 'mysite_date_format', create_function('','return __( "m-d-y" );') );
		add_filter( 'mysite_additional_posts_title', create_function('','return;') );
		add_filter( 'mysite_read_more', 'mysite_read_more' );
		add_filter( 'mysite_fancy_link', 'mysite_fancy_link', 1, 2 );
		add_filter( 'mysite_portfolio_read_more', 'mysite_portfolio_read_more', 1, 2 );
		add_filter( 'mysite_portfolio_visit_site', 'mysite_portfolio_visit_site', 1, 2 );
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
		        ( !empty( $img_set['one_column_portfolio_full']['w'] ) ? $img_set['one_column_portfolio_full']['w'] : 882 ),
		        ( !empty( $img_set['one_column_portfolio_full']['h'] ) ? $img_set['one_column_portfolio_full']['h'] : 547 )),
		    'two_column_portfolio' => array( 
		        ( !empty( $img_set['two_column_portfolio_full']['w'] ) ? $img_set['two_column_portfolio_full']['w'] : 414 ),
		        ( !empty( $img_set['two_column_portfolio_full']['h'] ) ? $img_set['two_column_portfolio_full']['h'] : 257 )),
		    'three_column_portfolio' => array( 
		        ( !empty( $img_set['three_column_portfolio_full']['w'] ) ? $img_set['three_column_portfolio_full']['w'] : 258 ),
		        ( !empty( $img_set['three_column_portfolio_full']['h'] ) ? $img_set['three_column_portfolio_full']['h'] : 160 )),
		    'four_column_portfolio' => array( 
		        ( !empty( $img_set['four_column_portfolio_full']['w'] ) ? $img_set['four_column_portfolio_full']['w'] : 180 ),
		        ( !empty( $img_set['four_column_portfolio_full']['h'] ) ? $img_set['four_column_portfolio_full']['h'] : 111 )),

		    'one_column_blog' => array( 
		        ( !empty( $img_set['one_column_blog_full']['w'] ) ? $img_set['one_column_blog_full']['w'] : 882 ),
		        ( !empty( $img_set['one_column_blog_full']['h'] ) ? $img_set['one_column_blog_full']['h'] : 373 )),
		    'two_column_blog' => array( 
		        ( !empty( $img_set['two_column_blog_full']['w'] ) ? $img_set['two_column_blog_full']['w'] : 414 ),
		        ( !empty( $img_set['two_column_blog_full']['h'] ) ? $img_set['two_column_blog_full']['h'] : 175 )),
		    'three_column_blog' => array( 
		        ( !empty( $img_set['three_column_blog_full']['w'] ) ? $img_set['three_column_blog_full']['w'] : 258 ),
		        ( !empty( $img_set['three_column_blog_full']['h'] ) ? $img_set['three_column_blog_full']['h'] : 109 )),
		    'four_column_blog' => array( 
		        ( !empty( $img_set['four_column_blog_full']['w'] ) ? $img_set['four_column_blog_full']['w'] : 180 ),
		        ( !empty( $img_set['four_column_blog_full']['h'] ) ? $img_set['four_column_blog_full']['h'] : 76 )),

		    'small_post_list' => array( 
		        ( !empty( $img_set['small_post_list_full']['w'] ) ? $img_set['small_post_list_full']['w'] : 50 ),
		        ( !empty( $img_set['small_post_list_full']['h'] ) ? $img_set['small_post_list_full']['h'] : 50 )),
		    'medium_post_list' => array( 
		        ( !empty( $img_set['medium_post_list_full']['w'] ) ? $img_set['medium_post_list_full']['w'] : 200 ),
		        ( !empty( $img_set['medium_post_list_full']['h'] ) ? $img_set['medium_post_list_full']['h'] : 200 )),
		    'large_post_list' => array( 
		        ( !empty( $img_set['large_post_list_full']['w'] ) ? $img_set['large_post_list_full']['w'] : 570 ),
		        ( !empty( $img_set['large_post_list_full']['h'] ) ? $img_set['large_post_list_full']['h'] : 356 )),

		    'portfolio_single_full' => array( 
		        ( !empty( $img_set['portfolio_single_full_full']['w'] ) ? $img_set['portfolio_single_full_full']['w'] : 882 ),
		        ( !empty( $img_set['portfolio_single_full_full']['h'] ) ? $img_set['portfolio_single_full_full']['h'] : 547 )),
		    'additional_posts_grid' => array( 
		        ( !empty( $img_set['additional_posts_grid_full']['w'] ) ? $img_set['additional_posts_grid_full']['w'] : 180 ),
		        ( !empty( $img_set['additional_posts_grid_full']['h'] ) ? $img_set['additional_posts_grid_full']['h'] : 111 )),

		);

		$big_sidebar_images = array(
		    'one_column_portfolio' => array( 
		        ( !empty( $img_set['one_column_portfolio_big']['w'] ) ? $img_set['one_column_portfolio_big']['w'] : 568 ),
		        ( !empty( $img_set['one_column_portfolio_big']['h'] ) ? $img_set['one_column_portfolio_big']['h'] : 352 )),
		    'two_column_portfolio' => array( 
		        ( !empty( $img_set['two_column_portfolio_big']['w'] ) ? $img_set['two_column_portfolio_big']['w'] : 263 ),
		        ( !empty( $img_set['two_column_portfolio_big']['h'] ) ? $img_set['two_column_portfolio_big']['h'] : 163 )),
		    'three_column_portfolio' => array( 
		        ( !empty( $img_set['three_column_portfolio_big']['w'] ) ? $img_set['three_column_portfolio_big']['w'] : 161 ),
		        ( !empty( $img_set['three_column_portfolio_big']['h'] ) ? $img_set['three_column_portfolio_big']['h'] : 100 )),
		    'four_column_portfolio' => array( 
		        ( !empty( $img_set['four_column_portfolio_big']['w'] ) ? $img_set['four_column_portfolio_big']['w'] : 110 ),
		        ( !empty( $img_set['four_column_portfolio_big']['h'] ) ? $img_set['four_column_portfolio_big']['h'] : 68 )),

		    'one_column_blog' => array( 
		        ( !empty( $img_set['one_column_blog_big']['w'] ) ? $img_set['one_column_blog_big']['w'] : 568 ),
		        ( !empty( $img_set['one_column_blog_big']['h'] ) ? $img_set['one_column_blog_big']['h'] : 240 )),
		    'two_column_blog' => array( 
		        ( !empty( $img_set['two_column_blog_big']['w'] ) ? $img_set['two_column_blog_big']['w'] : 263 ),
		        ( !empty( $img_set['two_column_blog_big']['h'] ) ? $img_set['two_column_blog_big']['h'] : 111 )),
		    'three_column_blog' => array( 
		        ( !empty( $img_set['three_column_blog_big']['w'] ) ? $img_set['three_column_blog_big']['w'] : 161 ),
		        ( !empty( $img_set['three_column_blog_big']['h'] ) ? $img_set['three_column_blog_big']['h'] : 68 )),
		    'four_column_blog' => array( 
		        ( !empty( $img_set['four_column_blog_big']['w'] ) ? $img_set['four_column_blog_big']['w'] : 110 ),
		        ( !empty( $img_set['four_column_blog_big']['h'] ) ? $img_set['four_column_blog_big']['h'] : 46 )),

		    'small_post_list' => array( 
		        ( !empty( $img_set['small_post_list_big']['w'] ) ? $img_set['small_post_list_big']['w'] : 50 ),
		        ( !empty( $img_set['small_post_list_big']['h'] ) ? $img_set['small_post_list_big']['h'] : 50 )),
		    'medium_post_list' => array( 
		        ( !empty( $img_set['medium_post_list_big']['w'] ) ? $img_set['medium_post_list_big']['w'] : 200 ),
		        ( !empty( $img_set['medium_post_list_big']['h'] ) ? $img_set['medium_post_list_big']['h'] : 200 )),
		    'large_post_list' => array( 
		        ( !empty( $img_set['large_post_list_big']['w'] ) ? $img_set['large_post_list_big']['w'] : 364 ),
		        ( !empty( $img_set['large_post_list_big']['h'] ) ? $img_set['large_post_list_big']['h'] : 227 )),

		    'portfolio_single_full' => array( 
		        ( !empty( $img_set['portfolio_single_full_big']['w'] ) ? $img_set['portfolio_single_full_big']['w'] : 568 ),
		        ( !empty( $img_set['portfolio_single_full_big']['h'] ) ? $img_set['portfolio_single_full_big']['h'] : 352 )),
		    'additional_posts_grid' => array( 
		        ( !empty( $img_set['additional_posts_grid_big']['w'] ) ? $img_set['additional_posts_grid_big']['w'] : 120 ),
		        ( !empty( $img_set['additional_posts_grid_big']['h'] ) ? $img_set['additional_posts_grid_big']['h'] : 75 )),

		);

		$small_sidebar_images = array(
		    'one_column_portfolio' => array( 
		        ( !empty( $img_set['one_column_portfolio_small']['w'] ) ? $img_set['one_column_portfolio_small']['w'] : 647 ),
		        ( !empty( $img_set['one_column_portfolio_small']['h'] ) ? $img_set['one_column_portfolio_small']['h'] : 401 )),
		    'two_column_portfolio' => array( 
		        ( !empty( $img_set['two_column_portfolio_small']['w'] ) ? $img_set['two_column_portfolio_small']['w'] : 301 ),
		        ( !empty( $img_set['two_column_portfolio_small']['h'] ) ? $img_set['two_column_portfolio_small']['h'] : 186 )),
		    'three_column_portfolio' => array( 
		        ( !empty( $img_set['three_column_portfolio_small']['w'] ) ? $img_set['three_column_portfolio_small']['w'] : 185 ),
		        ( !empty( $img_set['three_column_portfolio_small']['h'] ) ? $img_set['three_column_portfolio_small']['h'] : 114 )),
		    'four_column_portfolio' => array( 
		        ( !empty( $img_set['four_column_portfolio_small']['w'] ) ? $img_set['four_column_portfolio_small']['w'] : 128 ),
		        ( !empty( $img_set['four_column_portfolio_small']['h'] ) ? $img_set['four_column_portfolio_small']['h'] : 79 )),

		    'one_column_blog' => array( 
		        ( !empty( $img_set['one_column_blog_small']['w'] ) ? $img_set['one_column_blog_small']['w'] : 647 ),
		        ( !empty( $img_set['one_column_blog_small']['h'] ) ? $img_set['one_column_blog_small']['h'] : 274 )),
		    'two_column_blog' => array( 
		        ( !empty( $img_set['two_column_blog_small']['w'] ) ? $img_set['two_column_blog_small']['w'] : 301 ),
		        ( !empty( $img_set['two_column_blog_small']['h'] ) ? $img_set['two_column_blog_small']['h'] : 127 )),
		    'three_column_blog' => array( 
		        ( !empty( $img_set['three_column_blog_small']['w'] ) ? $img_set['three_column_blog_small']['w'] : 185 ),
		        ( !empty( $img_set['three_column_blog_small']['h'] ) ? $img_set['three_column_blog_small']['h'] : 78 )),
		    'four_column_blog' => array( 
		        ( !empty( $img_set['four_column_blog_small']['w'] ) ? $img_set['four_column_blog_small']['w'] : 128 ),
		        ( !empty( $img_set['four_column_blog_small']['h'] ) ? $img_set['four_column_blog_small']['h'] : 54 )),

		    'small_post_list' => array( 
		        ( !empty( $img_set['small_post_list_small']['w'] ) ? $img_set['small_post_list_small']['w'] : 50 ),
		        ( !empty( $img_set['small_post_list_small']['h'] ) ? $img_set['small_post_list_small']['h'] : 50 )),
		    'medium_post_list' => array( 
		        ( !empty( $img_set['medium_post_list_small']['w'] ) ? $img_set['medium_post_list_small']['w'] : 200 ),
		        ( !empty( $img_set['medium_post_list_small']['h'] ) ? $img_set['medium_post_list_small']['h'] : 200 )),
		    'large_post_list' => array( 
		        ( !empty( $img_set['large_post_list_small']['w'] ) ? $img_set['large_post_list_small']['w'] : 416 ),
		        ( !empty( $img_set['large_post_list_small']['h'] ) ? $img_set['large_post_list_small']['h'] : 260 )),

		    'portfolio_single_full' => array( 
		        ( !empty( $img_set['portfolio_single_full_small']['w'] ) ? $img_set['portfolio_single_full_small']['w'] : 647 ),
		        ( !empty( $img_set['portfolio_single_full_small']['h'] ) ? $img_set['portfolio_single_full_small']['h'] : 401 )),
		    'additional_posts_grid' => array( 
		        ( !empty( $img_set['additional_posts_grid_small']['w'] ) ? $img_set['additional_posts_grid_small']['w'] : 128 ),
		        ( !empty( $img_set['additional_posts_grid_small']['h'] ) ? $img_set['additional_posts_grid_small']['h'] : 79 )),

		);
		
		$additional_images = array(
		    'image_banner_intro' => array( 
		        ( !empty( $img_set['image_banner_intro_full']['w'] ) ? $img_set['image_banner_intro_full']['w'] : 980 ),
		        ( !empty( $img_set['image_banner_intro_full']['h'] ) ? $img_set['image_banner_intro_full']['h'] : 420 )),
		);




		# Slider
		$images_slider = array(
			'responsive_slide' => array( 980, 420 ),
			'floating_slide' => array( 900, 350 ),
			'staged_slide' => array( 900, 350 ),
			'partial_staged_slide' => array( 567, 334 ),
			'partial_gradient_slide' => array( 510, 344 ),
			'overlay_slide' => array( 900, 350 ),
			'nivo_slide' => array( 900, 350 ),
			'full_slide' => array( 980, 420 ),
			'nav_thumbs' => array( 64, 45 )
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
		$mysite->layout['images'] = array_merge( $images, array( 'image_padding' => 18 ) );
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
 * @subpackage Awake
 */

if ( !function_exists( 'mysite_read_more' ) ) :
/**
 *
 */
function mysite_read_more( $url ) {
	return '<span class="post_more_link"><a class="post_more_link_a" href="' . $url . '">' . __( 'Read More', MYSITE_TEXTDOMAIN ) . '</a><span class="post_more_link_arrow"></span></span>';
}
endif;

if ( !function_exists( 'mysite_portfolio_read_more' ) ) :
/**
 *
 */
function mysite_portfolio_read_more( $read_more, $url ) {
	return '<span class="post_more_link"><a href="' . $url  . '" class="post_more_link_a">' . __( 'Read More', MYSITE_TEXTDOMAIN ) . '</a><span class="post_more_link_arrow"></span></span>';
}
endif;

if ( !function_exists( 'mysite_portfolio_visit_site' ) ) :
/**
 *
 */
function mysite_portfolio_visit_site( $visit_site, $url ) {
	return '<span class="post_more_link"><a href="' . $url  . '" class="post_more_link_a">' . __( 'Visit Site', MYSITE_TEXTDOMAIN ) . '</a><span class="post_more_link_arrow"></span></span>';
}
endif;

if ( !function_exists( 'mysite_fancy_link' ) ) :
/**
 *
 */
function mysite_fancy_link( $fancy_link, $args ) {
	extract( $args );
	return '<span class="fancy_link"><a href="' . esc_url( $link ) . '" class="fancy_link_a' . $target . $variation . '"' . $color .'>' . mysite_remove_wpautop( $content ) . '</a><span class="fancy_link_arrow"></span></span>';
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
	
	$out = '';
	$meta_options = mysite_get_setting( 'disable_meta_options' );
	$_meta = ( is_array( $meta_options ) ) ? $meta_options : array();
	$meta_output = '';
	
	if( !in_array( 'date_meta', $_meta ) )
		$meta_output .= '[post_date] ';
		
	if( !in_array( 'author_meta', $_meta ) )
		$meta_output .= '[post_author text="' . __( '<em>by:</em>', MYSITE_TEXTDOMAIN ) . ' "] ';
	
	if( !empty( $meta_output ) ) {
		$out .='<p class="post_meta">' . $meta_output . '</p>';
	}
	
	if( $echo )
		echo apply_atomic_shortcode( 'post_meta', $out );
	else
		return apply_atomic_shortcode( 'post_meta', $out );
}
endif;

if ( !function_exists( 'mysite_blog_meta_bottom' ) ) :	
/**
 *
 */
function mysite_blog_meta_bottom( $args = array() ) {
	$defaults = array(
		'shortcode' => false,
		'echo' => true
	);
	
	$args = wp_parse_args( $args, $defaults );
	
	extract( $args );
	
	if ( is_page() && !$shortcode ) return;
	
	$out = '';
	$meta_options = mysite_get_setting( 'disable_meta_options' );
	$_meta = ( is_array( $meta_options ) ) ? $meta_options : array();
	$meta_output = '';

	if( !in_array( 'date_meta', $_meta ) )
		$meta_output .= '[post_date] ';

	if( !in_array( 'categories_meta', $_meta ) )
		$meta_output .= '[post_terms taxonomy="category"] ';

	if( !empty( $meta_output ) )
		$out .='<p class="post_meta_bottom">' . $meta_output . '</p>';
	
	if( $echo )
		echo apply_atomic_shortcode( 'blog_meta_bottom', $out );
	else
		return apply_atomic_shortcode( 'blog_meta_bottom', $out );
}
endif;

if ( !function_exists( 'mysite_comment_bubble' ) ) :
/**
 *
 */
function mysite_comment_bubble( $args = array() ) {
	$defaults = array(
		'shortcode' => false,
		'echo' => true
	);
	
	$number = get_comments_number();
	if( ( $number<1 && !comments_open() ) || ( is_attachment() ) || ( is_singular( 'portfolio' ) ) ) return;
	
	$args = wp_parse_args( $args, $defaults );
	extract( $args );
	
	if ( is_page() && !$shortcode ) return;
	
	$meta_options = mysite_get_setting( 'disable_meta_options' );
	if( is_array( $meta_options ) && in_array( 'comments_meta', $meta_options ) )
		return;
	
	$out = '<div class="post_comments_bubble">[post_comments text="" more="%1$s" one="1" zero="0"]</div>';
	
	if( $echo )
		echo apply_atomic_shortcode( 'comment_bubble', $out );
	else
		return apply_atomic_shortcode( 'comment_bubble', $out );
}
endif;

if ( !function_exists( 'mysite_fancy_search' ) ) :
/**
 * 
 */
function mysite_fancy_search() {
	
	$out = '<div id="fancy_search"><a id="search_tooltip_trigger" href="#" rel=".search_tooltip">Search</a></div>';
	$out .= '<div class="search_tooltip">';
	$out .= '<form id = "searchform" method="get" action="' . get_bloginfo( 'url' ) . '/">';
	$out .= '<p><input type="text" size="20" class="tooltip_search_field" name="s" id="s" value="Search.." onfocus="if(this.value == \'Search..\') {this.value = \'\';}" onblur="if (this.value == \'\') {this.value = \'Search..\';}" /></p>';
	$out .= '<p><input type="submit" value="Search" class="tooltip_search_button" /></p>';
	if ( get_query_var( 'lang' ) ) { echo '<input type = "hidden" name = "lang" value = "'.get_query_var('lang').'" />'; }
	$out .= '</form>';
	$out .= '</div>';
	
	echo apply_atomic( 'fancy_search', $out );
}
endif;

if ( !function_exists( 'mysite_post_sociables' ) ) :
/**
 *
 */
function mysite_post_sociables() {
	$out = '';
	
	$social_bookmarks = mysite_get_setting( 'social_bookmarks' );
	if( empty( $social_bookmarks ) ) {
		$out .= '<div class="share_this_module">';
		
		$out .= '<h4 class="share_this_title"><a id="share_tooltip_trigger" href="#" rel=".share_this_content">' .
		__( 'Share this Post', MYSITE_TEXTDOMAIN ) . '</a></h4>';
		
		$out .= '<div class="share_this_content">';
		
		$out .= mysite_sociable_bookmarks();
		
		$out .= '</div><!-- .share_this_content -->';
		$out .= '</div><!-- .share_this_module -->';
	}
	
	echo apply_filters( 'mysite_post_sociables', $out );
}
endif;

if ( !function_exists( 'mysite_before_post_sc' ) ) :
/**
 *
 */
function mysite_before_post_sc( $filter_args ) {
	$out = '';
	
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
	
	if( strpos( $filter_args['disable'], 'title' ) === false )
		$out .= mysite_post_title( $filter_args );
	
	if( strpos( $filter_args['disable'], 'meta' ) === false )
		$out .= mysite_comment_bubble( $filter_args );
	
	return $out;
}
endif;

if ( !function_exists( 'mysite_after_entry_sc' ) ) :
/**
 *
 */
function mysite_after_entry_sc( $filter_args ) {
	$out = '';
	
	extract( $filter_args );
	
	if( strpos( $disable, 'meta' ) === false )
		$out .= mysite_blog_meta_bottom( $filter_args );
	
	return $out;
}
endif;

if ( !function_exists( 'mysite_widget_meta' ) ) :
/**
 *
 */
function mysite_widget_meta() {
	return do_shortcode( '[post_date text=""]' );
}
endif;

if ( !function_exists( 'mysite_awake_search_cluetip' ) ) :
/**
 *
 */
function mysite_awake_search_cluetip() {
	wp_enqueue_script( MYSITE_PREFIX . '_cluetip' );
}
endif;

if ( !function_exists( 'mysite_awake_scripts' ) ) :
/**
 *
 */
function mysite_awake_scripts() {
	$out ='';
	
	# Awake search this tooltip
	$out .= "var ua = jQuery.browser;
	if(ua.msie && ua.version.substring(0,1) < '9'){
		var tipFx = 'custom';
	}else{
		var tipFx = 'fadeIn';
	}
	
	if( jQuery('#search_tooltip_trigger').length >0){
		jQuery('#search_tooltip_trigger').cluetip({
			positionBy: 'fixed',
			cluezIndex: 999,
			topOffset: -69,
			leftOffset: -192,
			local:true,
			hideLocal: true,
			cursor: 'pointer',
			showTitle: false,
			waitImage: false,
			clickThrough: false,
			dropShadow: false,
			waitImage :false,
			sticky: true,
			mouseOutClose: true,
			fx: { open: tipFx, openSpeed: 'fast' },
			onShow: function(e) {
				jQuery('#cluetip-close').css('display','none');
				jQuery('.search_tooltip').css('display','block').css('text-indent','-9999px');
				jQuery('#cluetip').addClass('search_tooltip');
				jQuery('#cluetip').find('.search_tooltip').css('text-indent','0px');
			},
			onHide: function(e) {
				if (jQuery('.tooltip_search_field:focus' ).is(':focus')) {
					jQuery('#cluetip').addClass('search_tooltip');
					jQuery('#cluetip' ).css('display','block');
				}else{
					jQuery('#cluetip').removeClass('search_tooltip');
				}
			}
		});
	}
	
	jQuery('#primary_menu').mouseout(function(e) {
		if( e.relatedTarget.id == 'intro' || e.relatedTarget.id == '' ){
			jQuery('#cluetip' ).css('display','none');
			jQuery('#cluetip').removeClass('search_tooltip');
		}
	});";
	
	# Awake share this tooltip
	if( is_single() ) {
		$out .= "if( jQuery('#share_tooltip_trigger').length >0){
			jQuery('#share_tooltip_trigger').cluetip({
				positionBy: 'fixed',
				topOffset: -78,
				leftOffset: -144,
				local:true,
				hideLocal: true,
				cursor: 'pointer',
				showTitle: false,
				waitImage: false,
				clickThrough: false,
				dropShadow: false,
				waitImage :false,
				sticky: true,
				mouseOutClose: true,
				fx: { open: tipFx, openSpeed: 'fast' },
				onShow: function(e) {
					jQuery('#cluetip-close').css('display','none');
					jQuery('#cluetip').addClass('share_this_tooltip');
					if(!jQuery.browser.msie){
					jQuery('.post_sociable').live('hover', function(e) {
							if( e.type == 'mouseenter' )
								jQuery(this).stop().animate({opacity:0.6},400);

							if( e.type == 'mouseleave' )
								jQuery(this).stop().animate({opacity:1},400);
						});
					}
				},
				onHide: function(e) {
					jQuery('#cluetip').removeClass('share_this_tooltip');
				}
			});
		}";
	}
	
	$out = '<script type="text/javascript">
	/* <![CDATA[ */
	' . $out . '
	/* ]]> */
	</script>';
	
	echo preg_replace( "/(\r\n|\r|\n)\s*/i", '', $out );
}
endif;

?>