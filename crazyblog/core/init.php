<?php

class crazyblog_Module_Init {

	static public function crazyblog_Init() {
		self::crazyblog_Constants();
		$files = glob( crazyblog_ROOT . "core/application/classes/*.php" );
		if ( !class_exists( 'Walker_Nav_Menu_Edit' ) ) {
			include(ABSPATH . 'wp-admin/includes/nav-menu.php');
			foreach ( $files as $file ) {
				if ( !is_dir( $file ) ) {
					$info = pathinfo( $file );
					locate_template( "core/application/classes/" . $info['basename'], true, true );
				}
			}
		}

		if ( is_admin() ) {
			$files = glob( crazyblog_ROOT . "core/application/library/update/*.php" );
			foreach ( $files as $file ) {
				if ( !is_dir( $file ) ) {
					$info = pathinfo( $file );
					locate_template( "core/application/library/update/" . $info['basename'], true, true );
				}
			}
		}

		new crazyblog_Forms;
		new crazyblog_Ajax;
		new crazyblog_Validation;
		crazyblog_View::get_instance()->library( 'Widgets', false );
		crazyblog_View::get_instance()->library( 'Shortcodes', false );
		crazyblog_View::get_instance()->library( 'Metabox', false );
		crazyblog_View::get_instance()->library( 'Woocommerce', false );
		if ( function_exists( 'crazyblog_post_type_setup' ) ) {
			crazyblog_post_type_setup();
		}
		if ( is_admin() ) {
			crazyblog_Admin::crazyblog_Init();
			self::crazyblog_Support();
			return;
		}

		self::crazyblog_Support();
		self::crazyblog_actions();
		add_filter( 'body_class', array( 'crazyblog_Module_Init', 'crazyblog_body_classes' ) );
	}

	static public function crazyblog_Constants() {
		$theme = wp_get_theme();
		define( 'APP', 'crazyblog' );
		define( 'TH', 'CrazyBlog' );
		define( 'DOMAIN', strtolower( strip_tags( $theme->Author ) . '_' . $theme->Name ) );
		define( 'crazyblog_VERSION', $theme->Version );
		if ( is_child_theme() === false ) {
			define( 'crazyblog_ROOT', get_stylesheet_directory() . '/' );
			if ( !defined( 'crazyblog_URI' ) ) {
				define( 'crazyblog_URI', get_stylesheet_directory_uri() . '/' );
			}
		} else {
			define( 'crazyblog_ROOT', get_template_directory() . '/' );
			if ( !defined( 'crazyblog_URI' ) ) {
				define( 'crazyblog_URI', get_template_directory_uri() . '/' );
			}
		}
		define( 'VM', crazyblog_ROOT . 'images/vc/' );
		define( 'crazyblog_DIR', crazyblog_ROOT . 'core/application' );
		define( 'crazyblog_LANG_DIR', crazyblog_ROOT . 'languages' );
	}

	static protected function crazyblog_Support() {
		crazyblog_db_like_table();
		add_editor_style();
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'widgets' );
		add_theme_support( "woocommerce" );
		add_theme_support( "custom-header" );
		add_theme_support( "custom-background" );
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
		) );
		add_theme_support( 'post-formats', array( 'audio', 'gallery', 'video', 'quote', 'image', 'link' ) );
		add_theme_support( 'custom-background', apply_filters( 'sh_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
		register_nav_menu( 'primary-menu', esc_html__( 'Primary Menu', 'crazyblog' ) );
		register_nav_menu( 'topbar-menu', esc_html__( 'Top Bar Menu', 'crazyblog' ) );
		register_nav_menu( 'responsive-menu', esc_html__( 'Responsive Menu', 'crazyblog' ) );
		register_nav_menu( 'footer-menu', esc_html__( 'Footer Menu', 'crazyblog' ) );
		register_nav_menu( 'left-menu', esc_html__( 'Left Menu', 'crazyblog' ) );
		register_nav_menu( 'right-menu', esc_html__( 'Right Menu', 'crazyblog' ) );
		if ( !isset( $content_width ) ) {
			$content_width = 960;
		}
		$ThumbSize = array( 'crazyblog_939x586', 'crazyblog_400x400', 'crazyblog_470x540', 'crazyblog_462x343', 'crazyblog_770x458', 'crazyblog_200x200', 'crazyblog_454x344', 'crazyblog_1170x590', 'crazyblog_376x350', 'crazyblog_370x197', 'crazyblog_343x241', 'crazyblog_608x446', 'crazyblog_343x410', 'crazyblog_1170x380' );

		foreach ( $ThumbSize as $v ) {
			$explode = explode( 'x', $v );
			add_image_size( $v, str_replace( 'crazyblog_', '', $explode[0] ), $explode[1], true );
		}
	}

	static public function crazyblog_body_classes( $classes ) {
		if ( is_multi_author() ) {
			$classes[] = 'body_class';
		}

		if ( is_single() ) {
			$classes[] = 'magnification';
		}

		return $classes;
	}

	static public function crazyblog_actions() {
		add_action( 'widgets_init', array( 'crazyblog_Widgets', 'register' ) );
		add_action( 'widgets_init', array( 'crazyblog_Sidebars', 'register' ) );
		add_action( 'init', array( 'crazyblog_Module_Init', 'init_actions' ) );
		add_action( 'init', array( 'crazyblog_Shortcodes', 'init' ) );
		add_action( 'crazyblog_custom_header', array( 'crazyblog_Header', 'crazyblog_headers' ) );
	}

	static public function init_actions() {
		add_action( 'admin_enqueue_scripts', array( crazyblog_View::get_instance(), 'crazyblog_admin_render_styles' ), 999 );
		add_action( 'wp_enqueue_scripts', array( crazyblog_View::get_instance(), 'crazyblog_render_styles' ), 999 );
		add_action( 'wp_enqueue_scripts', array( crazyblog_View::get_instance(), 'crazyblog_custom_styles' ), 999 );
		add_action( 'wp_enqueue_scripts', array( crazyblog_View::get_instance(), 'crazyblog_render_scripts' ), 999 );
		add_action( 'wp_head', array( crazyblog_View::get_instance(), 'crazyblog_additional_head' ) );
	}

}
