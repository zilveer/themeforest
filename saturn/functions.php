<?php
if( !defined('ABSPATH') ) exit; // Don't access me directly.
if ( !isset( $content_width ) ) $content_width = 900;
if( !defined( 'SATURN_POST_VIEWS' ) ){
	define( 'SATURN_POST_VIEWS' , 'saturn_post_views');
}
if( !defined( 'SATURN_TEMPLATE_DIRECTORY' ) ){
	define( 'SATURN_TEMPLATE_DIRECTORY' , get_template_directory());
}
if( !defined( 'SATURN_TEMPLATE_DIRECTORY_URI' ) ){
	define( 'SATURN_TEMPLATE_DIRECTORY_URI' , get_template_directory_uri());
}
require_once ( SATURN_TEMPLATE_DIRECTORY . '/includes/class-tgm-plugin-activation.php');
require_once ( SATURN_TEMPLATE_DIRECTORY . '/includes/functions.php');
require_once ( SATURN_TEMPLATE_DIRECTORY . '/includes/template.php');
require_once ( SATURN_TEMPLATE_DIRECTORY . '/includes/widgets.php');
require_once ( SATURN_TEMPLATE_DIRECTORY . '/includes/theme-options.php');
require_once ( SATURN_TEMPLATE_DIRECTORY . '/includes/custom-header.php');
require_once ( SATURN_TEMPLATE_DIRECTORY . '/includes/metaboxes.php');
require_once ( SATURN_TEMPLATE_DIRECTORY . '/includes/custom-sidebar.php');

if( !function_exists( 'saturn_after_setup_theme' ) ){
	/**
	 * Do the action after setup the theme.
	 */
	function saturn_after_setup_theme() {
		// Loading theme textdomain.
		load_theme_textdomain( 'saturn', SATURN_TEMPLATE_DIRECTORY . '/languages' );
		// Adding html5 support.
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );
		// require Jetpack installed.
		add_theme_support( 'jetpack-responsive-videos' );
		// V4.1
		add_theme_support( 'title-tag' );
		// adding woocommerce support.
		add_theme_support( 'woocommerce' );
		// adding menu support.
		add_theme_support('menus');
		// adding thumbnail support.
		add_theme_support('post-thumbnails');
		// adding custom background support.
		add_theme_support('custom-background', array(
			'default-color'          => '',
			'default-image'          => '',
			'admin-head-callback'    => '',
			'admin-preview-callback' => ''
		));
		// adding post format support.
		add_theme_support( 'post-formats', array(
			'audio', 'gallery', 'image', 'video','quote'
		) );
		// hooked saturn_infinite_scroll,10,1;
		add_theme_support( 'infinite-scroll', apply_filters( 'saturn_infinite_scroll' , array(
					'container' => 'primary-content',
					'footer' => 'footer',
					'type'	=>	'scroll',
					'posts_per_page' => get_option( 'posts_per_page' )
				)
			)
		);
		add_theme_support( 'automatic-feed-links' );
		add_image_size( 'post-760-434', 760, 434, true );
	}
	add_action( 'after_setup_theme' , 'saturn_after_setup_theme');
}

if( !function_exists( 'saturn_enqueue_scripts' ) ){
	/**
	 * Loading the script/style.
	 */
	function saturn_enqueue_scripts() {
		global $saturn_global_data;
		wp_enqueue_script('jquery');
		if( is_single() || is_page() ){
			wp_enqueue_script('comment-reply');
		}
		wp_enqueue_script('bootstrap.min', SATURN_TEMPLATE_DIRECTORY_URI . '/assets/js/bootstrap.min.js', array('jquery'), '', true);
		wp_enqueue_script('jquery.mb.YTPlayer.min', SATURN_TEMPLATE_DIRECTORY_URI . '/assets/js/jquery.mb.YTPlayer.min.js', array('jquery'), '', true);
		wp_enqueue_script('jquery.fitvids', SATURN_TEMPLATE_DIRECTORY_URI . '/assets/js/jquery.fitvids.js', array('jquery'), '', true);	
		if( isset( $saturn_global_data['smart_menu'] ) && $saturn_global_data['smart_menu'] == 1 ):
			wp_enqueue_script('headroom.min', SATURN_TEMPLATE_DIRECTORY_URI . '/assets/js/headroom.min.js', array('jquery'), '', true);
			wp_enqueue_script('jquery.headroom', SATURN_TEMPLATE_DIRECTORY_URI . '/assets/js/jquery.headroom.js', array('jquery'), '', true);
			wp_enqueue_script('smart-menu', SATURN_TEMPLATE_DIRECTORY_URI . '/assets/js/smart-menu.js', array('jquery'), '', true);
		endif;
		wp_enqueue_script('jquery.flexslider', SATURN_TEMPLATE_DIRECTORY_URI . '/assets/js/jquery.flexslider.js', array('jquery'), '', true);
		wp_enqueue_script('script', SATURN_TEMPLATE_DIRECTORY_URI . '/assets/js/script.js', array('jquery'), '', true);

		wp_enqueue_style( 'google-lato', saturn_font_url(), array(), 'all' );
		wp_enqueue_style('bootstrap.min', SATURN_TEMPLATE_DIRECTORY_URI . '/assets/css/bootstrap.min.css', array(), null);
		wp_enqueue_style('font-awesome.min', SATURN_TEMPLATE_DIRECTORY_URI . '/assets/css/font-awesome.min.css', array(), null);
		wp_enqueue_style('YTPlayer', SATURN_TEMPLATE_DIRECTORY_URI . '/assets/css/YTPlayer.css', array(), null);
		wp_enqueue_style('flexslider', SATURN_TEMPLATE_DIRECTORY_URI . '/assets/css/flexslider.css', array(), null);
		wp_enqueue_style('rejetpack', SATURN_TEMPLATE_DIRECTORY_URI . '/assets/css/jetpack.css', array('jetpack_css'), 'all');
		wp_enqueue_style( 'marstheme-woocommerce', SATURN_TEMPLATE_DIRECTORY_URI . '/assets/css/woocommerce.css', array( 'woocommerce-general' ), null);
		wp_enqueue_style( 'style', get_bloginfo( 'stylesheet_url' ), array(), '' );
		wp_enqueue_style('responsive', SATURN_TEMPLATE_DIRECTORY_URI . '/assets/css/responsive.css', array(), null);
	}
	add_action( 'wp_enqueue_scripts' , 'saturn_enqueue_scripts');
}

if( !function_exists('saturn_admin_enqueue_scripts') ){
	function saturn_admin_enqueue_scripts() {
		wp_enqueue_script('saturn-script', SATURN_TEMPLATE_DIRECTORY_URI . '/assets/js/admin.js', array(), '', true);
		wp_enqueue_style('saturn-admin.css', SATURN_TEMPLATE_DIRECTORY_URI . '/assets/css/admin.css');
		wp_enqueue_style('redux-admin.css', SATURN_TEMPLATE_DIRECTORY_URI . '/assets/css/redux-admin.css');
	}
	add_action('admin_enqueue_scripts', 'saturn_admin_enqueue_scripts');
}

if( !function_exists('saturn_font_url') ){
	function saturn_font_url() {
		$font_url = '';
		if ( 'off' !== _x( 'on', 'Lato font: on or off', 'saturn' ) ) {
			$font_url = add_query_arg( 'family','Lato:300,400,700,900', "//fonts.googleapis.com/css" );
		}
		return $font_url;
	}
}

if( !function_exists( 'saturn_widgets_init' ) ){
	/**
	 * Adding the sidebars.
	 */
	function saturn_widgets_init() {
		//right sidebar
		register_sidebar( array(
			'name' => __( 'Primary Sidebar', 'saturn' ),
			'id' => 'sidebar-primary',
			'description' => __('Appears in the right section of the site.','saturn'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );
		if( class_exists( 'WooCommerce' ) ){
			register_sidebar( array(
				'name' => __( 'Woocommerce Sidebar', 'saturn' ),
				'id' => 'woocommerce-primary',
				'description' => __('Appears in the right section of the site.','saturn'),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			) );			
		}
		//featured sidebar
		register_sidebar( array(
			'name' => __( 'Featured Sidebar', 'saturn' ),
			'id' => 'featured-second',
			'description' => __('The Featured Post widget should be here.','saturn'),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title' => '',
		) );
	}
	add_action( 'widgets_init', 'saturn_widgets_init' );
}

if( !function_exists('saturn_register_menus') ){
	/**
	 * Adding the main menu.
	 */
	function saturn_register_menus() {
		register_nav_menus(array('main_navigation' => __('Main Navigation','saturn')));
	}
	add_action( 'init', 'saturn_register_menus' );
}