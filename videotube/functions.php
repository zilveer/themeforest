<?php
if( !defined('ABSPATH') ) exit;
if ( ! isset( $content_width ) ) $content_width = 750;
### Define
if( !defined('MARS_THEME_URI') ){
	define('MARS_THEME_URI', get_template_directory_uri());
}
if( !defined('MARS_THEME_DIR') ){
	define('MARS_THEME_DIR', get_template_directory());
}

require_once ( MARS_THEME_DIR . '/includes/functions.php');
require_once ( MARS_THEME_DIR . '/includes/awesomeicon-array.php');
//------------------------------ End Image Size -----------------------------------------//
require_once ( MARS_THEME_DIR . '/includes/Mars_Video_Table.php');
require_once ( MARS_THEME_DIR . '/includes/class-tgm-plugin-activation.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_Required_Plugins.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_Subscribe_Ajax.php');
//------------------------------ End Functions-----------------------------------------//
//------------------------------ Hooks -----------------------------------------//
require_once ( MARS_THEME_DIR . '/includes/hooks.php');
//------------------------------ End Hooks -----------------------------------------//
require_once ( MARS_THEME_DIR . '/includes/Mars_Like_Dislike.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_Styling_Typography.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_Author_Page.php');
//------------------------------ Widgets -----------------------------------------//
require_once ( MARS_THEME_DIR . '/includes/Mars_Custom_Post_Type.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_Custom_Taxonomies.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_MetaBox.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_FeaturedVideos_Widgets.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_FeaturedPosts_Widgets.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_MainVideos_Widgets.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_MainPosts_Widgets.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_OneBigVideo_Widgets.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_Posts_Widget_Siderbar.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_Videos_Widget_Siderbar.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_KeyCloud_Widgets.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_RelatedBlog_Widgets.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_RelatedVideo_Widgets.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_Subscribox_Widget.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_StayConnected_Widget.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_VideoShortcode.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_ShortcodeListVideos.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_ShortcodeSubmitVideo.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_LoginRegister_Template.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_LoginForm_Widget.php');
require_once ( MARS_THEME_DIR . '/includes/Mars_LoadingMore_Ajax.php');
require_once ( MARS_THEME_DIR . '/includes/class-composer.php');
require_once ( MARS_THEME_DIR . '/includes/theme-options.php');
require_once ( MARS_THEME_DIR . '/includes/media.php');

require_once ( MARS_THEME_DIR . '/includes/wpes-envato-theme-update.php');

if( ! function_exists( 'mars_theme_update' ) ){
	function mars_theme_update() {
		global $videotube;
		
		$purchase_code = isset( $videotube['purchase_code'] ) ? $videotube['purchase_code'] : null;
		$access_token = isset( $videotube['access_token'] ) ? $videotube['access_token'] : null;
		if( ! empty( $purchase_code ) && ! empty( $access_token ) ){
			new WPES_Envato_Theme_Update( basename( get_template_directory() ) , $purchase_code , $access_token , false );
		}
	}
	add_action( 'init' , 'mars_theme_update' );
}

//------------------------------ End Widgets -----------------------------------------//
if( !function_exists( 'mars_after_setup_theme' ) ){
	function mars_after_setup_theme() {
		//------------------------------ Load Language -----------------------------------------//
		load_theme_textdomain( 'mars', get_template_directory() . '/languages' );
		//------------------------------ Add Theme Support -----------------------------------------//
		add_theme_support('menus');
		add_theme_support('post-thumbnails');
		add_theme_support( 'title-tag' );
		add_theme_support('woocommerce');
		add_theme_support('custom-background', array(
			'default-color'          => '',
			'default-image'          => '',
			'admin-head-callback'    => '',
			'admin-preview-callback' => ''
		));
		add_theme_support( 'jetpack-responsive-videos' );
		add_theme_support( 'automatic-feed-links' );
		//------------------------------ And Theme Support -----------------------------------------//
		//------------------------------ Add Image Size -----------------------------------------//
		add_image_size('video-featured', 360, 240, true);
		add_image_size('video-lastest', 230, 150, true);
		add_image_size('video-category-featured', 295, 197, true);
		add_image_size('video-item-category-featured', 750, 440, true);
		### sidebar
		add_image_size('most-video-2col', 165, 108, true);
		### Blog
		add_image_size('blog-large-thumb', 750, 'auto', true);
		//add_image_size( '590-300', 590, 300, true );
	}
	add_action('after_setup_theme', 'mars_after_setup_theme');
}

//------------------------------ Enqueue Scripts && Styles-----------------------------------------//
if( !function_exists('mars_enqueue_scripts') ){
	function mars_enqueue_scripts() {
		### Core JS
		wp_enqueue_script('jquery');
		if( is_single() || is_page() ){
			wp_enqueue_script('comment-reply');
		}
		wp_enqueue_script('bootstrap.min.js', MARS_THEME_URI . '/assets/js/bootstrap.min.js', array(), '', true);
		wp_enqueue_script('mars-jquery.placeholder.js', MARS_THEME_URI . '/assets/js/ie8/jquery.placeholder.js', array(), '', true);
		wp_enqueue_script('mars-jquery.matchHeight', MARS_THEME_URI . '/assets/js/jquery.matchheight-min.js', array(), '', true);
		wp_enqueue_script('mars-functions.js', MARS_THEME_URI . '/assets/js/functions.js', array(), '', true);
		wp_enqueue_script('mars-custom.js', MARS_THEME_URI . '/assets/js/custom.js', array(), '', true);
		
		wp_localize_script( 'mars-custom.js' , 'jsvar', apply_filters( 'jsvar' , array(
			'home_url'	=>	esc_js( home_url( '/' ) ),
		)) );
		
		//wp_enqueue_style('bootstrap.min.css', MARS_THEME_URI . '/assets/css/bootstrap.min.css');
		wp_enqueue_style('bootstrap.min.css', MARS_THEME_URI . '/assets/css/bootstrap.min.css' );
		wp_enqueue_style('mars-font-awesome.css', MARS_THEME_URI . '/assets/css/font-awesome.min.css' );	
		if( is_rtl() ){
			wp_enqueue_style('font-awesome-rtl.css', MARS_THEME_URI . '/assets/css/font-awesome-rtl.css');
		}
		wp_enqueue_style('mars-googlefont-lato','//fonts.googleapis.com/css?family=Lato:300,400,700,900');
		wp_enqueue_style( 'style', get_bloginfo( 'stylesheet_url' ), array(), null );
		wp_enqueue_script('jquery.cookie.js', MARS_THEME_URI . '/assets/js/jquery.cookie.js', array(), '', true);
		### Bootstrap MultiSelect
		wp_enqueue_script('bootstrap-multiselect.js', MARS_THEME_URI . '/assets/js/bootstrap-multiselect.js', array(), '', true);
		wp_enqueue_style('bootstrap-multiselect.css', MARS_THEME_URI . '/assets/css/bootstrap-multiselect.css');
		### jQuery Form Upload
		wp_enqueue_script('jquery.form.min.js', MARS_THEME_URI . '/assets/js/jquery.form.min.js', array(), '', true);
		wp_enqueue_script('ajax_handled.js', MARS_THEME_URI . '/assets/js/ajax_handled.js', array(), '', true);
		wp_enqueue_script('loading-more.js', MARS_THEME_URI . '/assets/js/loading-more.js', array(), '', true);
		
		echo '<script>var mars_ajax_url = "'.admin_url('admin-ajax.php').'";</script>';
	}
	add_action('wp_enqueue_scripts', 'mars_enqueue_scripts');
}
if( !function_exists( 'mars_load_custom_style' ) ){
	function mars_load_custom_style() {
		global $videotube;
		if( !empty( $videotube['style'] ) && !in_array( $videotube['style'] , array( 'default','custom' )) ){
			$custom_style = esc_url(  $videotube['style'] );
			$name = wp_make_link_relative( $custom_style );
			wp_enqueue_style( $name , $custom_style, array(), null);
		}
	}
	add_action('wp_enqueue_scripts', 'mars_load_custom_style');
}
if( !function_exists( 'mars_load_custom_code_style' ) ){
	function mars_load_custom_code_style() {
		global $videotube;
		if( $videotube['style'] == 'custom' && !empty( $videotube['style_custom'] ) ){
			print '<style>'.trim( $videotube['style_custom'] ).'</style>';
		}
	}
	add_action( 'wp_footer' , 'mars_load_custom_code_style');
}
if( !function_exists('mars_admin_enqueue_scripts') ){
	function mars_admin_enqueue_scripts() {
		global $pagenow;
		if( $pagenow == 'widgets.php' ){
			wp_enqueue_script('jquery-ui-datepicker');
			wp_enqueue_style('jquery-ui-datepicker', MARS_THEME_URI . '/assets/css/ui-lightness/jquery-ui-1.10.4.custom.min.css');
			wp_enqueue_script('mars-admin.js', MARS_THEME_URI . '/assets/js/admin.js', array(), '', true);
		}
		wp_enqueue_style('redux-admin', MARS_THEME_URI . '/assets/css/redux-admin.css');
		wp_enqueue_style('mars-admin-style', MARS_THEME_URI . '/assets/css/admin.css');
	}
	add_action('admin_enqueue_scripts', 'mars_admin_enqueue_scripts');
}
//------------------------------ End Scripts && Styles-----------------------------------------//
//------------------------------ Register Menu Location-----------------------------------------//
if( !function_exists('mars_register_my_menus') ){
	function mars_register_my_menus() {
	  register_nav_menus(
	    array(
	    	'header_main_navigation' => __('Home Page Navigation','mars'), 
	    )
	  );
	} 
	add_action( 'init', 'mars_register_my_menus' );	
}
//------------------------------ End Menu Location-----------------------------------------//
//------------------------------ Register Sidebar-----------------------------------------//
if( !function_exists('mars_register_sidebars') ){
	function mars_register_sidebars() {
		register_sidebar( $args = array(
				'name'          => __( 'Right Homepage', 'mars' ),
				'id'            => 'mars-homepage-right-sidebar',
				'description'   => __('Display the Widgets on Home Page Right Sidebar','mars'),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>'
			)
		);		
		### is page
		register_sidebar( $args = array(
			'name'          => __( 'Inner Page Right', 'mars' ),
			'id'            => 'mars-inner-page-right-sidebar',
			'description'   => __('Static Page, Category,Tag,Archive,Search,Author Right Sidebar','mars'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
			)
		);		
		register_sidebar( $args = array(
			'name'          => __( 'Featured Videos', 'mars' ),
			'id'            => 'mars-featured-videos-sidebar',
			'description'   => __('Display the featured videos on Home Page','mars'),
			'before_widget' => null,
			'after_widget'  => null,
			'before_title'  => null,
			'after_title'   => null )
		);
		register_sidebar( $args = array(
			'name'          => __( 'Main Homepage', 'mars' ),
			'id'            => 'mars-home-videos-sidebar',
			'description'   => __('Display the video on Main Video Content Page','mars'),
			'before_widget' => null,
			'after_widget'  => null,
			'before_title'  => null,
			'after_title'   => null )
		);
		register_sidebar( $args = array(
			'name'          => __( 'Author/Channel Page Right', 'mars' ),
			'id'            => 'mars-author-page-right-sidebar',
			'description'   => __('The Author/Channel right sidebar','mars'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
			)
		);
		register_sidebar( $args = array(
			'name'          => __( 'Footer Sidebar', 'mars' ),
			'id'            => 'mars-footer-sidebar',
			'description'   => __('Display the Widgets on Footer','mars'),
			'before_widget' => '<div id="%1$s" class="col-sm-3 widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="footer-widget-title">',
			'after_title'   => '</h4>'
			)
		);
		register_sidebar( $args = array(
			'name'          => __( 'Video Single Below Content', 'mars' ),
			'id'            => 'mars-video-single-below-sidebar',
			'description'   => __('Display the Widgets on Video Single page, below the video description, you can use to display the Videos Related widget or an ads.','mars'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
			)
		);
		register_sidebar( $args = array(
			'name'          => __( 'Post Single Below Content', 'mars' ),
			'id'            => 'mars-post-single-below-content-sidebar',
			'description'   => __('Display the Widgets on blog/post single page, bellow the post content, you can use to display the Videos Related widget or an ads.','mars'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>'
			)
		);		
	}
	add_action('widgets_init', 'mars_register_sidebars');
}
//------------------------------ End Sidebar-----------------------------------------//