<?php
/**
 * MediaCenter setup functions
 *
 * @package mediacenter
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @see mc_content_width()
 *
 */
if ( ! isset( $content_width ) ) {
	$content_width = 810;
}

if( ! function_exists( 'mc_content_width' ) ) {
	/**
	 * Adjust content_width value for image attachment template.
	 *
	 */
	function mc_content_width() {
		if ( is_attachment() && wp_attachment_is_image() ) {
			$GLOBALS['content_width'] = 810;
		}
	}
}

/**
 * Assign the MediaCenter version to a var
 */
$theme 					= wp_get_theme();
$mc_version 			= $theme['Version'];

/**
 * Enables template debug mode
 */
function mc_template_debug_mode() {
	if ( ! defined( 'MC_TEMPLATE_DEBUG_MODE' ) ) {
		$status_options = get_option( 'woocommerce_status_options', array() );
		if ( ! empty( $status_options['template_debug_mode'] ) && current_user_can( 'manage_options' ) ) {
			define( 'MC_TEMPLATE_DEBUG_MODE', true );
		} else {
			define( 'MC_TEMPLATE_DEBUG_MODE', false );
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
function mc_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
	if ( $args && is_array( $args ) ) {
		extract( $args );
	}
	
	$located = mc_locate_template( $template_name, $template_path, $default_path );
	
	if ( ! file_exists( $located ) ) {
		_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $located ), '2.1' );
		return;
	}
	
	// Allow 3rd party plugin filter template file from their plugin
	$located = apply_filters( 'mc_get_template', $located, $template_name, $args, $template_path, $default_path );
	
	do_action( 'mc_before_template_part', $template_name, $template_path, $located, $args );
	
	include( $located );
	
	do_action( 'mc_after_template_part', $template_name, $template_path, $located, $args );
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
function mc_locate_template( $template_name, $template_path = '', $default_path = '' ) {
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
	if ( ! $template || MC_TEMPLATE_DEBUG_MODE ) {
		$template = $default_path . $template_name;
	}
	
	// Return what we found
	return apply_filters( 'mc_locate_template', $template, $template_name, $template_path );
}

if ( ! function_exists( 'mc_theme_setup' ) ) {
	/**
	 * Media Center Theme Setup
	 * 
	 */
	function mc_theme_setup(){

		// Theme Support
		add_theme_support( 'woocommerce' );

		add_theme_support( 'title-tag' );

		// Theme Support
		add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio', 'quote', 'link', 'aside', 'status' ) ); // Post formats.
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );

		// Register Nav Menus
		$nav_menus = array(
			'top-left'    =>  __( 'Top Bar Left Navigation', 'mediacenter' ),
			'top-right'   =>  __( 'Top Bar Right Navigation', 'mediacenter' ),
			'primary'     =>  __( 'Main Navigation', 'mediacenter' ),
			'departments' =>  __( 'Shop by Departments' , 'mediacenter' )
		);
		register_nav_menus( $nav_menus );

		// Theme Text Domain
		load_theme_textdomain( 'mediacenter', trailingslashit( WP_LANG_DIR ) . 'themes/' );
		
		// wp-content/themes/child-theme-name/languages/it_IT.mo
		load_theme_textdomain( 'mediacenter', get_stylesheet_directory() . '/languages' );
		
		// wp-content/themes/theme-name/languages/it_IT.mo
		load_theme_textdomain( 'mediacenter', get_template_directory() . '/languages' );

	}
}

if ( ! function_exists( 'mc_widgets_init' ) ) {
	/**
	 * Register widgetized area and update sidebar with default widgets
	 * 
	 */
	function mc_widgets_init() {
	
		$sidebars_widgets = wp_get_sidebars_widgets();	
		$footer_area_widgets_counter = "0";	
		if (isset($sidebars_widgets['footer-widget-area'])) $footer_area_widgets_counter  = count($sidebars_widgets['footer-widget-area']);
		
		switch ($footer_area_widgets_counter) {
			case 0:
				$footer_area_widgets_columns ='col-lg-12';
				break;
			case 1:
				$footer_area_widgets_columns ='col-lg-12 col-md-12 col-sm-12';
				break;
			case 2:
				$footer_area_widgets_columns ='col-lg-6 col-md-6 col-sm-12';
				break;
			case 3:
				$footer_area_widgets_columns ='col-lg-4 col-md-6 col-sm-12';
				break;
			case 4:
				$footer_area_widgets_columns ='col-lg-3 col-md-6 col-sm-12';
				break;
			case 5:
				$footer_area_widgets_columns ='col-md-15 col-lg-2 col-sm-12';
				break;
			case 6:
				$footer_area_widgets_columns ='col-lg-2 col-md-6 col-sm-12';
				break;
			default:
				$footer_area_widgets_columns ='col-lg-2 col-md-6 col-sm-12';
		}
		
		//default sidebar
		register_sidebar(array(
			'name'          => __( 'Sidebar', 'mediacenter' ),
			'id'            => 'default-sidebar',
			'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		));
		
		//footer widget area
		register_sidebar( array(
			'name'          => __( 'Footer Widget Area', 'mediacenter' ),
			'id'            => 'footer-widget-area',
			'before_widget' => '<div class="' . $footer_area_widgets_columns . ' columns"><aside id="%1$s" class="widget clearfix %2$s"><div class="body">',
			'after_widget'  => '</div></aside></div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		//footer bottom widget area
		register_sidebar( array(
			'name'          => __( 'Footer Bottom Widget Area', 'mediacenter' ),
			'id'            => 'footer-bottom-widget-area',
			'before_widget' => '<div class="columns"><aside id="%1$s" class="widget clearfix %2$s"><div class="body">',
			'after_widget'  => '</div></aside></div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
		
		//catalog widget area
		register_sidebar( array(
			'name'          => __( 'Shop Sidebar', 'mediacenter' ),
			'id'            => 'catalog-widget-area',
			'before_widget' => '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-12"><aside id="%1$s" class="widget clearfix %2$s">',
			'after_widget'  => '</aside></div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );

		//product filters widget area
		register_sidebar( array(
			'name'          => __( 'Product Filters', 'mediacenter' ),
			'id'            => 'product-filters-widget-area',
			'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
	}
}

if ( ! function_exists( 'mc_font_url' ) ) {
	/**
	 * Register Open Sans Google font for Media Center.
	 *
	 * @return string
	 */
	function mc_font_url() {
		$font_url = '';
		/*
		 * Translators: If there are characters in your language that are not supported
		 * by Open Sans, translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'mediacenter' ) ) {
			$font_url = esc_url( add_query_arg( 'family', urlencode( 'Open Sans:400,600,700,800' ), "//fonts.googleapis.com/css" ) );
		}

		return $font_url;
	}
}

if ( ! function_exists( 'mc_scripts' ) ) {
	/**
	 * Enqueue scripts and styles for the front end.
	 */
	function mc_scripts(){

		global $yith_woocompare, $mc_version;

		/*
		* CSS
		*/
		
		// Bootstrap Core CSS
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', '', $mc_version );

		if ( is_rtl() ) {
			wp_enqueue_style( 'bootstrap-rtl', get_template_directory_uri() . '/assets/css/bootstrap-rtl.min.css', '', $mc_version );
			wp_enqueue_style( 'media_center-main-style', get_template_directory_uri() . '/rtl.min.css', '', $mc_version );
		} else {
			wp_enqueue_style( 'media_center-main-style', get_template_directory_uri() . '/style.min.css', '', $mc_version );
		}

		

		$preset_color = apply_filters( 'mc_main_theme_color', 'green' );

		// Customizable CSS
		wp_enqueue_style( 'media_center-preset-color',  get_template_directory_uri() . '/assets/css/' . $preset_color . '.css', '', $mc_version );
		
		// Javascript & CSS plugin styles
		wp_enqueue_style( 'media_center-owl-carousel',  get_template_directory_uri() . '/assets/css/owl.carousel.min.css', '', $mc_version );
		wp_enqueue_style( 'media_center-animate',  get_template_directory_uri() . '/assets/css/animate.min.css', '', $mc_version );

		
		$use_default_font = apply_filters( 'mc_load_default_fonts', true );

		if( $use_default_font ){
			// Google Fonts
	    	wp_enqueue_style( 'media_center-open-sans', mc_font_url(), array(), null );
		}

		// Icons/Glyphs
		wp_enqueue_style( 'media_center-font-awesome',  get_template_directory_uri() . '/assets/css/font-awesome.min.css', '', $mc_version );

		/*
		* Javascript
		*/

		wp_enqueue_script( 'media_center-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), $mc_version, true );
		wp_enqueue_script( 'media_center-bootstrap-hover-dropdown', get_template_directory_uri() . '/assets/js/bootstrap-hover-dropdown.min.js', array( 'jquery' ), $mc_version, true );
		wp_enqueue_script( 'media_center-owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), $mc_version, true );
		wp_enqueue_script( 'media_center-echo', get_template_directory_uri() . '/assets/js/echo.min.js', array( 'jquery' ), $mc_version, true );
		wp_enqueue_script( 'media_center-css-browser-selector', get_template_directory_uri() . '/assets/js/css_browser_selector.min.js', array( 'jquery' ), $mc_version, true );
		wp_enqueue_script( 'media_center-jquery-easing', get_template_directory_uri() . '/assets/js/jquery.easing-1.3.min.js', array( 'jquery' ), $mc_version, true );
	    wp_enqueue_script( 'prettyPhoto', get_template_directory_uri() . '/assets/js/jquery.prettyPhoto.min.js', array( 'jquery' ), $mc_version, true );
	    wp_enqueue_script( 'media_center-jquery-customselect', get_template_directory_uri() . '/assets/js/jquery.customSelect.min.js', array( 'jquery' ), $mc_version, true );

	    $sticky_header = apply_filters( 'mc_is_sticky_header', true );
		
		if( $sticky_header ) {
			wp_enqueue_script( 'media_center-waypoints', get_template_directory_uri() . '/assets/js/waypoints.min.js', array( 'jquery' ), $mc_version, true );
	    	wp_enqueue_script( 'media_center-waypoints-sticky', get_template_directory_uri() . '/assets/js/waypoints-sticky.min.js', array( 'jquery' ), $mc_version, true );
		}

		$enable_live_search = apply_filters( 'mc_is_enable_live_search', true );

		if( $enable_live_search ) {
			wp_enqueue_script( 'wp_typeahead_js', get_template_directory_uri() . '/assets/js/typeahead.bundle.min.js', array( 'jquery' ), '', true );
			wp_enqueue_script( 'handlebars', get_template_directory_uri() . '/assets/js/handlebars.min.js', array( 'wp_typeahead_js' ), '', true );
		}

	    wp_enqueue_script( 'media_center-wow', get_template_directory_uri() . '/assets/js/wow.min.js', array( 'jquery' ), $mc_version, true );
	    wp_enqueue_script( 'media_center-jplayer', get_template_directory_uri() . '/assets/js/jquery.jplayer.min.js', array( 'jquery' ), $mc_version, true );
	    
	    // Theme Scripts
		wp_enqueue_script( 'media_center-theme-scripts', get_template_directory_uri() . '/assets/js/scripts.min.js', array( 'jquery' ), $mc_version, true );

		$scroll_to_top = apply_filters( 'mc_is_scroll_to_top', true );
		$is_rtl_js = is_rtl() ? true : false ;

		$live_search_template = apply_filters( 'mc_get_live_search_template', '<p>{{value}}</p>' );

		$mc_options = apply_filters( 'mc_localize_script_data', array(
			'rtl' 					=> $is_rtl_js,
			'ajaxurl'				=> admin_url( 'admin-ajax.php' ),
			'should_stick'			=> $sticky_header,
			'should_scroll'			=> $scroll_to_top,
			'live_search_template'	=> $live_search_template,
			'enable_live_search'	=> $enable_live_search,
			'ajax_loader_url'		=> get_template_directory_uri() . '/assets/images/ajax-loader.gif',
			'live_search_empty_msg'	=> __( 'Unable to find any products that match the current query', 'mediacenter' )
		) );
		
		wp_localize_script( 'media_center-theme-scripts', 'mc_options', $mc_options );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}

if ( ! function_exists( 'mc_register_required_plugins' ) ) {
	/**
	 * Registers all the required mediacenter plugins using tgmpa
	 * 
	 */
	function mc_register_required_plugins() {
		
		$plugins = array(
			
			array(
				'name'					=> 'Contact Form 7',
				'slug'					=> 'contact-form-7',
				'required'				=> false,
				'version'				=> '4.5.1',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
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
				'name'					=> 'Media Center Extensions',
				'slug'					=> 'media-center-extensions',
				'source'				=> get_template_directory() . '/assets/plugins/media-center-extensions.zip',
				'required'				=> true,
				'version'				=> '2.3.5',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),

			array(
				'name'					=> 'Redux Framework',
				'slug'					=> 'redux-framework',
				'required'				=> true,
				'version'				=> '3.6.2',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),

			array(
				'name'					=> 'Regenerate Thumbnails',
				'slug'					=> 'regenerate-thumbnails',
				'required'				=> false,
				'version'				=> '2.2.6',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),

			array(
				'name'					=> 'Slider Revolution',
				'slug'					=> 'revslider',
				'source'				=> get_template_directory() . '/assets/plugins/revslider.zip',
				'required'				=> false,
				'version'				=> '5.2.6',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),

			array(
				'name'					=> 'Visual Composer',
				'slug'					=> 'js_composer',
				'source'				=> get_template_directory() . '/assets/plugins/js_composer.zip',
				'required'				=> false,
				'version'				=> '4.12.1',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),

			array(
				'name'					=> 'WooCommerce',
				'slug'					=> 'woocommerce',
				'required'				=> false,
				'version'				=> '2.6.4',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),

			array(
				'name'					=> 'YITH Woocommerce Compare',
				'slug'					=> 'yith-woocommerce-compare',
				'required'				=> false,
				'version'				=> '2.0.9',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			),

			array(
				'name'					=> 'YITH WooCommerce Wishlist',
				'slug'					=> 'yith-woocommerce-wishlist',
				'required'				=> false,
				'version'				=> '2.0.16',
				'force_activation'		=> false,
				'force_deactivation'	=> false,
				'external_url'			=> '',
			)

		);

		$config = array(
			'domain'       		=> 'mediacenter',
			'default_path' 		=> '',
			'parent_slug' 		=> 'themes.php',
			'menu'         		=> 'install-required-plugins',
			'has_notices'      	=> true,
			'is_automatic'    	=> false,
			'message' 			=> '',
			'strings'      		=> array(
				'page_title'                       			=> __( 'Install Required Plugins', 'mediacenter' ),
				'menu_title'                       			=> __( 'Install Plugins', 'mediacenter' ),
				'installing'                       			=> __( 'Installing Plugin: %s', 'mediacenter' ), // %1$s = plugin name
				'oops'                             			=> __( 'Something went wrong with the plugin API.', 'mediacenter' ),
				'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'mediacenter' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'mediacenter' ), // %1$s = plugin name(s)
				'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'mediacenter' ), // %1$s = plugin name(s)
				'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'mediacenter' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'mediacenter' ), // %1$s = plugin name(s)
				'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'mediacenter' ), // %1$s = plugin name(s)
				'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'mediacenter' ), // %1$s = plugin name(s)
				'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'mediacenter' ), // %1$s = plugin name(s)
				'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'mediacenter'  ),
				'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'mediacenter'  ),
				'return'                           			=> __( 'Return to Required Plugins Installer', 'mediacenter' ),
				'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'mediacenter' ),
				'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'mediacenter' ), // %1$s = dashboard link
				'nag_type'									=> 'updated'
			)
		);

		tgmpa( $plugins, $config );
	}
}

if ( ! function_exists( 'media_center_admin_styles' ) ) {
	/**
	 * Enqueue MC Admin styles
	 *
	 * @deprecated deprecated since version 2.1.2
	 * 
	 */
	function media_center_admin_styles() {
		mc_admin_styles();
	}
}

if ( ! function_exists( 'mc_admin_styles' ) ) {
	/**
	 * Enqueue MC Admin Styles
	 */
	function mc_admin_styles() {
		if ( is_admin() ) {
			
			// WPAlchemy Metabox
			wp_enqueue_style( 'wpalchemy-metabox', get_template_directory_uri() . '/assets/css/admin/meta-boxes.css' );
			
			if ( class_exists( 'WPBakeryVisualComposerAbstract' ) ) { 
				wp_enqueue_style( 'media_center_visual_composer', get_template_directory_uri() .'/assets/css/admin/visual-composer.css', false, "1.0", 'all');
			}
	    }
	}
}