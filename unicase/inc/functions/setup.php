<?php
/**
 * unicase setup functions
 *
 * @package unicase
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

/**
 * Assign the Unicase version to a var
 */
$theme 				= wp_get_theme();
$unicase_version 	= $theme['Version'];

if ( ! function_exists( 'unicase_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function unicase_setup() {

		/*
		 * Load Localisation files.
		 *
		 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
		 */

		// wp-content/languages/themes/unicase-it_IT.mo
		load_theme_textdomain( 'unicase', trailingslashit( WP_LANG_DIR ) . 'themes/' );

		// wp-content/themes/child-theme-name/languages/it_IT.mo
		load_theme_textdomain( 'unicase', get_stylesheet_directory() . '/languages' );

		// wp-content/themes/theme-name/languages/it_IT.mo
		load_theme_textdomain( 'unicase', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to head.
		 */
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'primary'		=> esc_html__( 'Primary Menu', 'unicase' ),
			'topbar-left'	=> esc_html__( 'Top Bar Left Menu', 'unicase' ),
			'topbar-right'	=> esc_html__( 'Top Bar Right Menu', 'unicase' )
		) );

		/*
		 * Switch default core markup for search form, comment form, comments, galleries, captions and widgets
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'widgets',
		) );

		// Setup the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'unicase_custom_background_args', array(
			'default-color' => apply_filters( 'unicase_default_background_color', 'fcfcfc' ),
			'default-image' => '',
		) ) );

		// Add support for the Site Logo plugin and the site logo functionality in JetPack
		// https://github.com/automattic/site-logo
		// http://jetpack.me/
		add_theme_support( 'site-logo', array( 'size' => 'full' ) );

		// Declare WooCommerce support
		add_theme_support( 'woocommerce' );

		// Declare support for title theme feature
		add_theme_support( 'title-tag' );

		// Declare support for Post formats feature
		add_theme_support( 'post-formats', array(
			'image',
			'gallery',
			'video',
			'audio',
			'quote',
			'link',
			'aside',
			'status'
		) );

	}
endif; // unicase_setup

/**
 * Register widget functions
 */

require get_template_directory() . '/inc/functions/uc-widget-functions.php';

/**
 * Custom Menu functions
 */

require get_template_directory() . '/inc/functions/uc-menu-functions.php';

if ( ! function_exists( 'unicase_widgets_init' ) ) {
	/**
	 * Register widget area.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
	 */
	function unicase_widgets_init() {

		$sidebars_widgets = wp_get_sidebars_widgets();

		$footer_widgets_counters = array(
			'footer-top-widgets-1' => 0,
			'footer-bottom-widgets-1' => 0
		);

		if ( isset( $sidebars_widgets['footer-top-widgets-1'] ) ) {
			$footer_widgets_counters['footer-top-widgets-1']  = count( $sidebars_widgets['footer-top-widgets-1'] );
		}
		if ( isset( $sidebars_widgets['footer-bottom-widgets-1'] ) ) {
			$footer_widgets_counters['footer-bottom-widgets-1']  = count( $sidebars_widgets['footer-bottom-widgets-1'] );
		}

		foreach ( $footer_widgets_counters as $key => $footer_widgets_counter ) {
			switch ( $footer_widgets_counter ) {
				case 0:
					$footer_widgets_columns[$key] ='col-lg-12 col-md-12 col-sm-12 col-xs-12';
					break;
				case 1:
					$footer_widgets_columns[$key] ='col-lg-12 col-md-12 col-sm-12 col-xs-12';
					break;
				case 2:
					$footer_widgets_columns[$key] ='col-lg-6 col-md-6 col-sm-6 col-xs-12';
					break;
				case 3:
					$footer_widgets_columns[$key] ='col-lg-4 col-md-4 col-sm-4 col-xs-12';
					break;
				case 4:
					$footer_widgets_columns[$key] ='col-lg-3 col-md-3 col-sm-6 col-xs-12';
					break;
				case 5:
					$footer_widgets_columns[$key] ='column-5 col-xs-12 col-sm-6';
					break;
				case 6:
					$footer_widgets_columns[$key] ='col-lg-2 col-md-2 col-sm-6 col-xs-12';
					break;
				default:
					$footer_widgets_columns[$key] ='col-lg-2 col-md-2 col-sm-6 col-xs-12';
			}
		}

		register_sidebar( apply_filters( 'unicase_register_sidebar_args', array(
			'name'          => esc_html__( 'Blog Sidebar', 'unicase' ),
			'id'            => 'blog-sidebar-1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) ) );

		register_sidebar( apply_filters( 'unicase_register_page_sidebar_args', array(
			'name'          => esc_html__( 'Page Sidebar', 'unicase' ),
			'id'            => 'page-sidebar-1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) ) );

		register_sidebar( apply_filters( 'unicase_register_shop_sidebar_args', array(
			'name'          => esc_html__( 'Shop Sidebar', 'unicase' ),
			'id'            => 'shop-sidebar-1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) ) );

		register_sidebar( apply_filters( 'unicase_register_product_filters_sidebar_args', array(
			'name'          => esc_html__( 'Product Filters', 'unicase' ),
			'id'            => 'product-filters-1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) ) );

		register_sidebar( apply_filters( 'unicase_register_footer_top_widgets_args', array(
			'name' 			=> esc_html__( 'Footer Top Widgets', 'unicase' ),
			'id' 			=> 'footer-top-widgets-1',
			'description' 	=> 'Widgetized Footer Top Region',
			'before_widget' => '<div class="' . esc_attr( $footer_widgets_columns['footer-top-widgets-1'] )  . '"><aside id="%1$s" class="widget clearfix %2$s"><div class="body">',
			'after_widget' 	=> '</div></aside></div>',
			'before_title' 	=> '<h4 class="widget-title">',
			'after_title' 	=> '</h4>',
		) ) );

		register_sidebar( apply_filters( 'unicase_register_footer_bottom_widgets_args', array(
			'name' 			=> esc_html__( 'Footer Bottom Widgets', 'unicase' ),
			'id' 			=> 'footer-bottom-widgets-1',
			'description' 	=> 'Widgetized Footer Bottom Region',
			'before_widget' => '<div class="' . esc_attr( $footer_widgets_columns['footer-bottom-widgets-1'] )  . '"><aside id="%1$s" class="widget clearfix %2$s"><div class="body">',
			'after_widget' 	=> '</div></aside></div>',
			'before_title' 	=> '<h4 class="widget-title">',
			'after_title' 	=> '</h4>',
		) ) );
	}
}

if ( ! function_exists( 'unicase_fonts_url' ) ) :
	/**
	 * Register Google fonts for Unicase.
	 *
	 * @since Twenty Fifteen 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function unicase_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';
		/* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== esc_html_x( 'on', 'Roboto font: on or off', 'unicase' ) ) {
			 $fonts[] = 'Roboto:400,100,300,500,700,900';
		}

		/* translators: If there are characters in your language that are not supported by Oswald, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== esc_html_x( 'on', 'Oswald font: on or off', 'unicase' ) ) {
			$fonts[] =  'Oswald:400,300,700';
		}

		/* translators: If there are characters in your language that are not supported by Lato, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== esc_html_x( 'on', 'Lato font: on or off', 'unicase' ) ) {
			$fonts[] =  'Lato:400,700';
		}

		$fonts = apply_filters( 'unicase_google_fonts', $fonts );

		/* translators: To add an additional character subset specific to your language, translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language. */
		$subset = esc_html_x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'unicase' );
		if ( 'cyrillic' == $subset ) {
			$subsets .= ',cyrillic,cyrillic-ext';
		} elseif ( 'greek' == $subset ) {
			$subsets .= ',greek,greek-ext';
		} elseif ( 'devanagari' == $subset ) {
			$subsets .= ',devanagari';
		} elseif ( 'vietnamese' == $subset ) {
			$subsets .= ',vietnamese';
		}
		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), '//fonts.googleapis.com/css' );
		}
		return $fonts_url;
	}
endif;

if ( ! function_exists( 'unicase_colors_url' ) ) :
	/**
	 * Register colors for Unicase.
	 */
	function unicase_colors_url() {
		$colors_url = get_template_directory_uri() . '/assets/css/green.css';

		return apply_filters( 'unicase_colors_url', $colors_url );
	}
endif;

if ( ! function_exists( 'unicase_scripts' ) ) :
	/**
	 * Enqueue scripts and styles.
	 * @since  1.0.0
	 */
	function unicase_scripts() {

		global $unicase_version;

		if( apply_filters( 'unicase_load_default_fonts', TRUE ) ) {
			wp_enqueue_style( 'unicase-fonts', unicase_fonts_url(), array(), null );
		}
		
		wp_enqueue_style( 'bootstrap',		get_template_directory_uri() . '/assets/css/bootstrap.min.css', '', $unicase_version );

		if( is_rtl() ) {
			wp_enqueue_style( 'bootstrap-rtl',		get_template_directory_uri() . '/assets/css/bootstrap-rtl.min.css', '', $unicase_version );
			
		}

		wp_enqueue_style( 'font-awesome', 	get_template_directory_uri() . '/assets/css/font-awesome.min.css', '', $unicase_version );
		wp_enqueue_style( 'animate', 		get_template_directory_uri() . '/assets/css/animate.min.css', '', $unicase_version );

		if( !is_rtl() ) {
			wp_enqueue_style( 'unicase-style', get_template_directory_uri() . '/style.css', '', $unicase_version );
		}

		wp_enqueue_style( 'unicase-color', unicase_colors_url(), '', $unicase_version );

		$is_rtl_js = is_rtl() ? true : false ;
		
		$unicase_option = array(
			'is_rtl'				=> $is_rtl_js,
			'ajax_url'				=> admin_url( 'admin-ajax.php' ),
			'ajax_loader_url'		=> get_template_directory_uri() . '/assets/images/ajax-loader.gif',
			'enable_sticky_header'	=> apply_filters( 'unicase_enable_sticky_header', false ),
			'enable_live_search'	=> apply_filters( 'unicase_enable_live_search', true ),
			'live_search_template'	=> apply_filters( 'unicase_live_search_template', '<p>{{value}}</p>' ),
			'live_search_empty_msg'	=> apply_filters( 'unicase_live_search_empty_msg', esc_html__( 'Unable to find any products that match the currenty query', 'unicase' ) ),
		);

		if( apply_filters( 'unicase_enable_retina', false ) ) {
			wp_enqueue_script( 'retina', get_template_directory_uri() . '/assets/js/retina.min.js', '', $unicase_version, true );
		}

		if( apply_filters( 'unicase_load_all_minifed_js', true ) ) {
			wp_enqueue_script( 'unicase-all', get_template_directory_uri() . '/assets/js/unicase-all.min.js', array( 'jquery' ), $unicase_version, true );
			wp_localize_script( 'unicase-all', 'unicase', $unicase_option );
		} else {
			wp_enqueue_script( 'bootstrap-js', 					get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), $unicase_version, true );
			wp_enqueue_script( 'unicase-skip-link-focus-fix', 	get_template_directory_uri() . '/assets/js/skip-link-focus-fix.min.js', array(), $unicase_version, true );
			wp_enqueue_script( 'wow', 							get_template_directory_uri() . '/assets/js/wow.min.js', array( 'jquery' ), $unicase_version, true );

			if( apply_filters( 'unicase_enable_pace', TRUE ) ) {
				wp_enqueue_script( 'pace', get_template_directory_uri() . '/assets/js/pace.min.js', array( 'jquery' ), $unicase_version, true );
			}

			if( apply_filters( 'unicase_enable_scrollup', TRUE ) ) {
				wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/assets/js/jquery.easing-1.3.min.js', array( 'jquery' ), $unicase_version, true );
				wp_enqueue_script( 'scrollup', get_template_directory_uri() . '/assets/js/scrollup.min.js', array( 'jquery' ), $unicase_version, true );
			}

			if( apply_filters( 'unicase_enable_sticky_header', false ) ) {
				wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/assets/js/waypoints.min.js', array( 'jquery' ), $unicase_version, true );
				wp_enqueue_script( 'waypoints-sticky', get_template_directory_uri() . '/assets/js/waypoints-sticky.min.js', array( 'jquery' ), $unicase_version, true );
			}

			if( apply_filters( 'unicase_enable_bootstrap_hover', TRUE ) ) {
				wp_enqueue_script( 'bootstrap-hover-dropdown', get_template_directory_uri() . '/assets/js/bootstrap-hover-dropdown.min.js', array( 'bootstrap-js' ), $unicase_version, true );
			}

			if( apply_filters( 'unicase_enable_echo', TRUE ) ) {
				wp_enqueue_script( 'echo', get_template_directory_uri() . '/assets/js/echo.min.js', '', $unicase_version, true );
			}

			if( apply_filters( 'unicase_enable_live_search', true ) ) {
				wp_enqueue_script( 'typeahead', get_template_directory_uri() . '/assets/js/typeahead.bundle.min.js', array( 'jquery' ), $unicase_version, true );
				wp_enqueue_script( 'handlebars', get_template_directory_uri() . '/assets/js/handlebars.min.js', array( 'typeahead' ), $unicase_version, true );
			}

			wp_enqueue_script( 'unicase-js', get_template_directory_uri() . '/assets/js/scripts.min.js', array( 'jquery' ), $unicase_version, true );

			wp_enqueue_script( 'unicase-custom-select', get_template_directory_uri() . '/assets/js/jquery.customSelect.min.js', array( 'jquery' ), $unicase_version, true );
			wp_enqueue_script( 'unicase-owl-carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), $unicase_version, true );

			wp_localize_script( 'unicase-js', 'unicase', $unicase_option );
		}

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

	}
endif;

/**
 * Enables template debug mode
 */
function unicase_template_debug_mode() {
	if ( ! defined( 'UC_TEMPLATE_DEBUG_MODE' ) ) {
		$status_options = get_option( 'woocommerce_status_options', array() );
		if ( ! empty( $status_options['template_debug_mode'] ) && current_user_can( 'manage_options' ) ) {
			define( 'UC_TEMPLATE_DEBUG_MODE', true );
		} else {
			define( 'UC_TEMPLATE_DEBUG_MODE', false );
		}
	}
}

/**
 * Get other templates (e.g. product attributes) passing attributes and including the file.
 *
 * @access public
 * @param string $template_name
 * @param array $args (default: array())
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return void
 */

function unicase_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
	if ( $args && is_array( $args ) ) {
		extract( $args );
	}

	$located = unicase_locate_template( $template_name, $template_path, $default_path );

	if ( ! file_exists( $located ) ) {
		_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $located ), '2.1' );
		return;
	}

	// Allow 3rd party plugin filter template file from their plugin
	$located = apply_filters( 'unicase_get_template', $located, $template_name, $args, $template_path, $default_path );

	do_action( 'unicase_before_template_part', $template_name, $template_path, $located, $args );

	include( $located );

	do_action( 'unicase_after_template_part', $template_name, $template_path, $located, $args );
}

/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 *		yourtheme		/	$template_path	/	$template_name
 *		yourtheme		/	$template_name
 *		$default_path	/	$template_name
 *
 * @access public
 * @param string $template_name
 * @param string $template_path (default: '')
 * @param string $default_path (default: '')
 * @return string
 */
function unicase_locate_template( $template_name, $template_path = '', $default_path = '' ) {
	if ( ! $template_path ) {
		$template_path = 'templates/';
	}

	if ( ! $default_path ) {
		$default_path = 'templates/';
	}

	// Look within passed path within the theme - this is priority
	$template = locate_template(
		array(
			trailingslashit( $template_path ) . $template_name,
			$template_name
		)
	);

	// Get default template
	if ( ! $template || UC_TEMPLATE_DEBUG_MODE ) {
		$template = $default_path . $template_name;
	}

	// Return what we found
	return apply_filters( 'unicase_locate_template', $template, $template_name, $template_path );
}

if ( ! function_exists( 'unicase_register_required_plugins' ) ) {
	/**
	 * Registers all required and recommended plugins for Unicase Theme
	 */
	function unicase_register_required_plugins() {
		
		$plugins = array(

			array(
				'name'     				=> 'Contact Form 7',
				'slug'     				=> 'contact-form-7',
				'source'   				=> 'https://downloads.wordpress.org/plugin/contact-form-7.4.4.2.zip',
				'required' 				=> false,
				'version' 				=> '4.4.2',
				'force_activation' 		=> false,
				'force_deactivation' 	=> false,
				'external_url' 			=> '',
			),

			array(
				'name'					=> 'Envato Market',
				'slug'					=> 'envato-market',
				'source'				=> 'http://envato.github.io/wp-envato-market/dist/envato-market.zip',
				'required'				=> false,
				'version'				=> '1.0.0-RC2',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),

			array(
				'name'     				=> 'MailChimp for WordPress Lite',
				'slug'     				=> 'mailchimp-for-wp',
				'source'   				=> 'https://downloads.wordpress.org/plugin/mailchimp-for-wp.3.1.10.zip',
				'required' 				=> false,
				'version' 				=> '3.1.10',
				'force_activation' 		=> false,
				'force_deactivation' 	=> false,
				'external_url' 			=> '',
			),

			array(
				'name'					=> 'Redux Framework',
				'slug'					=> 'redux-framework',
				'source'				=> 'https://downloads.wordpress.org/plugin/redux-framework.3.6.0.2.zip',
				'required'				=> true,
				'version'				=> '3.6.0.2',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),

			array(
				'name'     				=> 'Regenerate Thumbnails',
				'slug'     				=> 'regenerate-thumbnails',
				'source'   				=> 'https://downloads.wordpress.org/plugin/regenerate-thumbnails.zip',
				'required' 				=> false,
				'version' 				=> '2.2.6',
				'force_activation' 		=> false,
				'force_deactivation' 	=> false,
				'external_url' 			=> '',
			),

			array(
	            'name'					=> 'Revolution Slider',
	            'slug'					=> 'revslider',
	            'source'				=> get_template_directory() . '/assets/plugins/revslider.zip',
	            'required'				=> false,
	            'version'				=> '5.2.6',
	            'force_activation'		=> false,
	            'force_deactivation'	=> false,
	            'external_url'			=> '',
	        ),

	        array(
	            'name'					=> 'Unicase Extensions',
	            'slug'					=> 'unicase-extensions',
	            'source'				=> get_template_directory() . '/assets/plugins/unicase-extensions.zip',
	            'required'				=> false,
	            'version'				=> '1.2.3',
	            'force_activation'		=> false,
	            'force_deactivation'	=> false,
	            'external_url'			=> '',
	        ),

			array(
				'name'     				=> 'WooCommerce',
				'slug'     				=> 'woocommerce',
				'source'   				=> 'https://downloads.wordpress.org/plugin/woocommerce.2.6.2.zip',
				'required' 				=> true,
				'version' 				=> '2.6.2',
				'force_activation' 		=> false,
				'force_deactivation' 	=> false,
				'external_url' 			=> '',
			),

			array(
	            'name'					=> 'WPBakery Visual Composer',
	            'slug'					=> 'js_composer',
	            'source'				=> get_template_directory() . '/assets/plugins/js_composer.zip',
	            'required'				=> false,
	            'version'				=> '4.12',
	            'force_activation'		=> false,
	            'force_deactivation'	=> false,
	            'external_url'			=> '',
	        ),

			array(
				'name'					=> 'YITH WooCommerce Compare',
				'slug'					=> 'yith-woocommerce-compare',
				'source'				=> 'https://downloads.wordpress.org/plugin/yith-woocommerce-compare.2.0.9.zip',
				'required'				=> false,
				'version'				=> '2.0.9',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),

			array(
				'name'					=> 'YITH WooCommerce Wishlist',
				'slug'					=> 'yith-woocommerce-wishlist',
				'source'				=> 'https://downloads.wordpress.org/plugin/yith-woocommerce-wishlist.2.0.16.zip',
				'required'				=> false,
				'version'				=> '2.0.16',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),

		);

		$config = array(
			'domain'       		=> 'unicase',
			'default_path' 		=> '',
			'parent_slug' 		=> 'themes.php',
			'menu'         		=> 'install-required-plugins',
			'has_notices'      	=> true,
			'is_automatic'    	=> false,
			'message' 			=> '',
			'strings'      		=> array(
				'page_title'                       			=> esc_html__( 'Install Required Plugins', 'unicase' ),
				'menu_title'                       			=> esc_html__( 'Install Plugins', 'unicase' ),
				'installing'                       			=> esc_html__( 'Installing Plugin: %s', 'unicase' ),
				'oops'                             			=> esc_html__( 'Something went wrong with the plugin API.', 'unicase' ),
				'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'unicase' ),
				'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'unicase' ),
				'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'unicase' ),
				'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'unicase' ),
				'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'unicase' ),
				'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'unicase' ),
				'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'unicase' ),
				'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'unicase' ),
				'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'unicase'  ),
				'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'unicase'  ),
				'return'                           			=> esc_html__( 'Return to Required Plugins Installer', 'unicase' ),
				'plugin_activated'                 			=> esc_html__( 'Plugin activated successfully.', 'unicase' ),
				'complete' 									=> esc_html__( 'All plugins installed and activated successfully. %s', 'unicase' ),
				'nag_type'									=> 'updated'
			)
		);
		tgmpa( $plugins, $config );
	}
}

if ( ! function_exists( 'unicase_add_editor_styles' ) ) {
	function unicase_add_editor_styles() {
		add_editor_style( 'editor-style.css' );
	}
}
