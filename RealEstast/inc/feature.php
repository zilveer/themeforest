<?php

class PGL_Feature {
	static function init() {
		self::register_theme_support();
		self::register_image_size();
		self::register_menus();
		self::register_sidebar();
		self::load_extras();
	}

	static function register_menus() {
		if ( function_exists( 'register_nav_menu' ) ) {
			register_nav_menu( 'primary_navigation', __( 'Primary Navigation', PGL ) );
		}
	}

	static function register_theme_support() {
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links');
	}

	static function register_image_size() {
		PGL_Loader::find_class( 'image', _PREFIX_ );
		PGL_Image::init();
	}

	static function register_sidebar() {
		if ( function_exists( 'register_sidebar' ) ) {
			register_sidebar(
				array(
					'name'          => __( 'Main Sidebar', PGL ),
					'id'            => 'main-sidebar',
					'description'   => __( 'The main sidebar', PGL ),
					'before_widget' => '<div class="sidebar-box %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<div class="title-get"><div class="heading"><span class="widget-name">',
					'after_title'   => '</span><div class="stripe"></div><div class="stripe2"></div></div></div>',
				)
			);
			 //TODO: add sidebar to display language selector and phone in next update
			register_sidebar( array(
				'name' => __( 'Header Top Bar Left', PGL ),
				'id' => 'header-top-left',
				'description' => __( 'Top-most bar, widget(s) will be shown above header.', PGL ),
				'before_title' => '<h1>',
				'after_title' => '</h1>',
				'before_widget' => '<div class="pull-left %2$s">',
				'after_widget' => '</div>'
			) );
			register_sidebar( array(
				'name' => __( 'Header Top Bar Right', PGL ),
				'id' => 'header-top-right',
				'description' => __( 'Top-most bar, widget(s) will be shown above header.', PGL ),
				'before_title' => '<h1>',
				'after_title' => '</h1>',
				'before_widget' => '<div class="pull-right %2$s">',
				'after_widget' => '</div>'
			) );
            register_sidebar( array(
                'name' => __( 'Homepage Header Widgets', PGL ),
                'id' => 'home-header-widgets',
                'description' => __( 'Widget(s) will be shown under homepage header.', 'PGL' ),
                'before_title' => '<h1>',
                'after_title' => '</h1>',
                'before_widget' => '<div>',
                'after_widget' => '</div>'
            ) );
            register_sidebar( array(
                'name' => __( 'Page Header Widgets', PGL ),
                'id' => 'page-header-widgets',
                'description' => __( 'Widget(s) will be shown under page header. Except homepage', 'PGL' ),
                'before_title' => '<h1>',
                'after_title' => '</h1>',
                'before_widget' => '<div>',
                'after_widget' => '</div>'
            ) );


			register_sidebar(
				array(
					'name'          => __( 'Footer Widget Area', PGL ),
					'id'            => 'footer-widget-area',
					'description'   => __( 'The widget area on footer', PGL ),
					'before_widget' => '<div class="col-md-4 col-sm-4"><div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div></div>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
				)
			);

			register_sidebar(
				array(
					'name'          => __( 'Estate Sidebar', PGL ),
					'id'            => 'estate-widget-area',
					'description'   => __( 'Sidebar for estate pages', PGL ),
					'before_widget' => '<div class="sidebar-box %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h2>',
					'after_title'   => '</h2>',
				)
			);
		}
	}

	static function load_extras() {

	}
}

?>
