<?php
/************************************************************************
* NineZeroseven Functions File
*************************************************************************/

if ( !defined( 'WBC907THEME' ) ) {
	define( 'WBC907THEME', true );
}

if ( ! isset( $content_width ) )
	$content_width = 1170;

if ( ! function_exists( 'wbc907_wp_setup' ) ) {

	function wbc907_wp_setup() {
		/**
		 * Translation
		 */
		load_theme_textdomain( 'ninezeroseven', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Add Post Format Support
		 */
		add_theme_support( 'post-formats', array( 'link', 'quote', 'video', 'gallery', 'audio' ) );

		/**
		 * Enable support for Post Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * WordPress 4.1+ title tag
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Register Main Navigation.
		 */
		register_nav_menus( array(
				'wbc907-primary' => esc_html__( 'Primary Menu', 'ninezeroseven' ),
				'wbc907-footer'  => esc_html__( 'Footer Menu', 'ninezeroseven' ),
			) );

		add_theme_support( 'html5', array(
				'comment-list',
				'search-form',
				'comment-form',
				'gallery',
			) );

	}

	add_action( 'after_setup_theme', 'wbc907_wp_setup' );

} // wbc907_wp_setup

/************************************************************************
* Image Sizing
*************************************************************************/

add_image_size( 'square', 500, 500, true );

add_image_size( 'dbl-square', 1000, 1000, true );

add_image_size( 'landscape', 1000, 500, true );

add_image_size( 'portrait', 500, 1000, true );

add_image_size( 'post-600x400-image', 600, 400, true );

add_image_size( 'post-500x400-image', 500, 400, true );

add_image_size( 'post-1140-image', 1140 );

add_image_size( 'post-848-image', 848 );



/************************************************************************
* Load/Register scripts/styles
*************************************************************************/
if ( !function_exists( 'wbc907_wp_scripts' ) ) {

	function wbc907_wp_scripts() {

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Roboto:400,100,300' );

		wp_enqueue_style( 'base', get_template_directory_uri().'/assets/css/bootstrap.css' );

		wp_register_style( 'flexslider', get_template_directory_uri().'/assets/css/flexslider.css' );
		wp_enqueue_style( 'flexslider' );

		wp_enqueue_style( 'prettyPhoto', get_template_directory_uri().'/assets/js/prettyPhoto/css/prettyPhoto.css' );

		wp_register_style( 'font-awesome', get_template_directory_uri().'/assets/css/font-icons/font-awesome/css/font-awesome.min.css' );
		wp_enqueue_style( 'font-awesome' );

		wp_register_style( 'etline-icons', get_template_directory_uri().'/assets/css/font-icons/etline/et-icons.css' );
		// wp_enqueue_style( 'etline-icons' );
		wp_register_style( 'flat-icons', get_template_directory_uri().'/assets/css/font-icons/flaticon/flat-icons.css' );

		//Animated
		wp_register_style( 'wbc907-animated', get_template_directory_uri().'/assets/css/animate.min.css' );
		wp_enqueue_style( 'wbc907-animated' );


		wp_enqueue_style( 'theme-styles', get_template_directory_uri().'/assets/css/theme-styles.css' );
		wp_enqueue_style( 'theme-features', get_template_directory_uri().'/assets/css/theme-features.css' );

		wp_enqueue_style( 'style', get_stylesheet_uri() );

		/*SCRIPTS*/
		wp_enqueue_script( 'jquery' );

		wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/assets/js/jquery.flexslider-min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'prettyPhoto', get_template_directory_uri() . '/assets/js/prettyPhoto/js/jquery.prettyPhoto.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'sticky-bar', get_template_directory_uri() . '/assets/js/jquery.sticky.js', array( 'jquery' ), false, true );

		wp_enqueue_script( 'wbc-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), false, true );

		wp_register_script( 'wbc-wow', get_template_directory_uri() . '/assets/js/jquery.wow.min.js', array( 'jquery' ), false, true );

		wp_register_script( 'wbc-froogaloop', get_template_directory_uri() . '/assets/js/jquery.froogaloop.js', array( 'jquery', 'wbc-int-scripts' ), false, true );

		wp_enqueue_script( 'wbc-int-scripts', get_template_directory_uri() . '/assets/js/wbc-int.js', array( 'jquery' ), false, true );
		wp_register_script( 'wbc-mb-YTPlayer', get_template_directory_uri() . '/assets/js/jquery.mb.YTPlayer.js', array( 'jquery' ), false );

		wp_register_script( 'wbc-retina-imgs', get_template_directory_uri() . '/assets/js/retina.min.js', array( 'jquery' ), false, true );

		global $wbc907_data;
		if ( isset( $wbc907_data['opts-retina-enable'] ) && $wbc907_data['opts-retina-enable'] == 1 ) {
			wp_enqueue_script( 'wbc-retina-imgs' );
		}

	}

	add_action( 'wp_enqueue_scripts', 'wbc907_wp_scripts', 20 );
}


/**
 * Register widgetized area and update sidebar with default widgets
 */
if ( !function_exists( 'wbc907_wp_widgets_init' ) ) {
	function wbc907_wp_widgets_init() {

		global $wbc907_data;


		$wbc907_footer_columns = ( isset( $wbc907_data['opts-footer'] ) && is_numeric( $wbc907_data['opts-footer'] ) ) ? $wbc907_data['opts-footer'] : 4;


		register_sidebar( array(
				'name'          => esc_html__( 'Default Sidebar', 'ninezeroseven' ),
				'id'            => 'sidebar-1',
				'before_widget' => '<div class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			) );

		register_sidebar( array(
				'name'          => esc_html__( 'Footer 1', 'ninezeroseven' ),
				'id'            => 'footer-1',
				'before_widget' => '<div class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			) );

		register_sidebar( array(
				'name'          => esc_html__( 'Footer 2', 'ninezeroseven' ),
				'id'            => 'footer-2',
				'before_widget' => '<div class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			) );

		register_sidebar( array(
				'name'          => esc_html__( 'Footer 3', 'ninezeroseven' ),
				'id'            => 'footer-3',
				'before_widget' => '<div class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			) );


		if ( $wbc907_footer_columns == 4 ) {

			register_sidebar( array(
					'name'          => esc_html__( 'Footer 4', 'ninezeroseven' ),
					'id'            => 'footer-4',
					'before_widget' => '<div class="widget %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h4 class="widget-title">',
					'after_title'   => '</h4>',
				) );
		}


		$wbc907_sidebars = get_theme_mod( 'redux-widget-areas' );
		if ( is_array( $wbc907_sidebars ) ) {
			foreach ( $wbc907_sidebars as $key => $value ) {
				$key = ( empty($key) || is_numeric($key) ) ? $value : $key;
				register_sidebar( array(
						'name'          => esc_html( $value ),
						'id'            => sanitize_title( $key ),
						'before_widget' => '<div class="widget %2$s">',
						'class'         => 'redux-custom',
						'after_widget'  => '</div>',
						'before_title'  => '<h4 class="widget-title">',
						'after_title'   => '</h4>',
					) );
			}
		}

	}

	add_action( 'widgets_init', 'wbc907_wp_widgets_init' );
}

/************************************************************************
* Include theme files & Settings
*************************************************************************/
require get_template_directory().'/includes/theme-init.php';

?>