<?php
/**
 * Theme Name: 		SPECTRA - Responsive Music Wordpress Theme
 * Theme Author: 	Mariusz Rek - Rascals Themes
 * Theme URI: 		http://rascals.eu/spectra
 * Author URI: 		http://rascals.eu
 * File:			functions.php
 * =========================================================================================================================================
 *
 * @package spectra
 * @since 1.0.0
 */

/* ----------------------------------------------------------------------
	CONSTANTS NAD GLOBALS
/* ---------------------------------------------------------------------- */

global $spectra_opts;

define( 'SPECTRA_THEME', 'spectra' );


/* Set up the content width value based on the theme's design.
 -------------------------------------------------------------------------------- */
if ( ! isset( $content_width ) ) {
	$content_width = 680;
}


/* ----------------------------------------------------------------------
	TRANSLATIONS
/* ---------------------------------------------------------------------- */

/*
 * Make Spectra available for translation.
 *
 * Translations can be added to the /languages/ directory.
 * If you're building a theme based on Spectra, use a find and
 * replace to change 'spectra' to the name of your theme in all
 * template files.
 */
load_theme_textdomain( SPECTRA_THEME, get_template_directory() . '/languages' );


/* ----------------------------------------------------------------------
	ADMIN PANEL
/* ---------------------------------------------------------------------- */
get_template_part( 'admin/panel', 'init' );


/* ----------------------------------------------------------------------
	THEME SETUP
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'spectra_setup' ) ) :

	/**
	 * Spectra setup.
	 *
	 * Set up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support post thumbnails.
	 *
	 */

function spectra_setup() {

	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( get_template_directory_uri() . '/css/editor-style.css' );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );

	set_post_thumbnail_size( 710, 420, true );
	add_image_size( 'spectra-small-thumb', 545, 545, array( 'center', 'center' ) );

	add_image_size( 'spectra-full-width', 1070, 440, true );
	add_image_size( 'spectra-main-width', 720, 420, true );
	add_image_size( 'spectra-portfolio-thumb', 360, 360, true );
	add_image_size( 'spectra-small-thumb', 90, 90, true );

	// Menu support
	add_theme_support( 'menus' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Top primary menu', SPECTRA_THEME )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
	 'image', 'video', 'audio', 'gallery'
	) );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

	// Enable support for Woocommerce
	add_theme_support( 'woocommerce' );

}

add_action( 'after_setup_theme', 'spectra_setup' );

endif; 


/* ----------------------------------------------------------------------
	REQUIRED STYLES AND SCRIPTS
/* ---------------------------------------------------------------------- */
function spectra_scripts_and_styles() {
	
	global $spectra_opts, $post, $wp_query;


	// Add comment reply script when applicable
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	
	/*--- Required Scripts ---*/
	wp_enqueue_script( 'jquery' );	// Load jquery 
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.js' ); //MODERNIZR for html5

	// Google maps
	if ( ! is_404() && $spectra_opts->get_option( 'google_maps_key' ) && $spectra_opts->get_option( 'google_maps_key' ) !== '') {
		$map_key = '?key=' . $spectra_opts->get_option( 'google_maps_key' );
		if ( $spectra_opts->get_option( 'ajaxed' ) && $spectra_opts->get_option( 'ajaxed' ) === 'on' ) {
	  		wp_enqueue_script('js-gmaps-api','https://maps.googleapis.com/maps/api/js' . $map_key, array('jquery'), '1.0.0' );
	  		wp_enqueue_script( 'gmap', get_template_directory_uri() . '/js/jquery.gmap.min.js', false, false, true );
		} else {
			if ( get_post_meta( $wp_query->post->ID, '_intro_type', true ) === 'gmap' || has_shortcode( $post->post_content, 'google_maps' ) ) {
		  		wp_enqueue_script('js-gmaps-api','https://maps.googleapis.com/maps/api/js' . $map_key, array('jquery'), '1.0.0' );
	  			wp_enqueue_script( 'gmap', get_template_directory_uri() . '/js/jquery.gmap.min.js', false, false, true );
		  	}
		}
	}
  	
  	// YTPlayer
  	if ( ! is_404() ) {
	  	if ( get_post_meta( $wp_query->post->ID, '_intro_type', true ) === 'intro_youtube' ) {
	  		wp_enqueue_script( 'YTPlayer', get_template_directory_uri() . '/js/jquery.mb.YTPlayer.js', false, false, true );
	  	}
  	}
	
	if ( $spectra_opts->get_option( 'smoothscroll' ) && $spectra_opts->get_option( 'smoothscroll' ) === 'on' ) {
		wp_enqueue_script( 'smoothscroll', get_template_directory_uri() . '/js/smoothscroll.js', false, false, true );	
	}
	wp_enqueue_script( 'jquery.easing', get_template_directory_uri() . '/js/jquery.easing-1.3.min.js', false, false, true ); // jQuery easing
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', false, false, true ); //OWL CAROUSEL
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', false, false, true ); // jQuery lightbox
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', false, false, true ); // jQuery masonry plugin

	// Transit
	if ( $spectra_opts->get_option( 'content_animations' ) && $spectra_opts->get_option( 'content_animations' ) == 'on' ) {
		wp_enqueue_script( 'transit', get_template_directory_uri() . '/js/jquery.transit.min.js', false, false, true );
	}
	wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/js/waypoints.min.js', false, false, true );
	wp_enqueue_script( 'countdown', get_template_directory_uri() . '/js/jquery.countdown.js', false, false, true );
	wp_enqueue_script( 'SpectraPlugins', get_template_directory_uri() . '/js/plugins.js', false, false, true ); // Small Plugins

	// Slide sidebar
	wp_enqueue_script( 'iscroll', get_template_directory_uri() . '/js/iscroll.js', false, false, true );
	
	// Enable retina displays
	if ( $spectra_opts->get_option( 'retina' ) && $spectra_opts->get_option( 'retina' ) === 'on' ) {
		wp_enqueue_script( 'retina', get_template_directory_uri() . '/js/retina.min.js', false, false, true );
	}

	// Ajax scripts
	$ajaxed = 0;
	if ( $spectra_opts->get_option( 'ajaxed' ) && $spectra_opts->get_option( 'ajaxed' ) === 'on' ) {
		$ajaxed = 1;
		wp_enqueue_script( 'jquery.address', get_template_directory_uri() . '/js/jquery.address.js' , false, false, true);
		wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/js/imagesloaded.js' , false, false, true);
		wp_enqueue_script( 'jquery.ba-urlinternal', get_template_directory_uri() . '/js/jquery.ba-urlinternal.min.js' , false, false, true);
		wp_enqueue_script( 'jquery.WPAjaxLoader', get_template_directory_uri() . '/js/jquery.WPAjaxLoader.js' , false, false, true);
	}

	// Permalinks
	$permalinks = 0;
	if ( get_option('permalink_structure') ) {
		$permalinks = 1;
	}
	wp_enqueue_script( 'custom-controls', get_template_directory_uri() . '/js/custom.controls.js' , false, false, true ); // Loads ajax scripts

	// WOOCOMMERCE
	if ( class_exists( 'WooCommerce' ) ) {
		$ajax_exclude_links = '';
		$ajax_exclude_links .= get_permalink( get_option( 'woocommerce_shop_page_id' ) ) . '|';
		$ajax_exclude_links .= get_permalink( get_option( 'woocommerce_cart_page_id' ) ) . '|';
		$ajax_exclude_links .= get_permalink( get_option( 'woocommerce_checkout_page_id' ) ) . '|'; 
		$ajax_exclude_links .= get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) . '|'; 
		$ajax_exclude_links .= get_post_type_archive_link( 'product' ) . '|';

		$permalinks = get_option( 'woocommerce_permalinks' ); 
		$ajax_exclude_links .= '?product=|';
		if ( isset( $permalinks['product_base'] ) && $permalinks['product_base'] ) {
			$ajax_exclude_links .= $permalinks['product_base']  . '|';
		} else {
			$ajax_exclude_links .= '/product'  . '|';
		}

		$ajax_exclude_links .= '?product_tag=' . '|';
		if ( isset( $permalinks['tag_base'] ) && $permalinks['tag_base'] ) {
			$ajax_exclude_links .= $permalinks['tag_base']  . '|';
		} else {
			$ajax_exclude_links .= '/product-tag'  . '|';
		}

		$ajax_exclude_links .= '?product_cat=' . '|';
		if ( isset( $permalinks['category_base'] ) && $permalinks['category_base'] != '' ) {
			$ajax_exclude_links .= $permalinks['category_base']  . '|';
		} else {
			$ajax_exclude_links .= '/product-category' . '|';
		}

		if ( isset( $permalinks['attribute_base'] ) && $permalinks['attribute_base'] != '' ) {
			$ajax_exclude_links .= $permalinks['attribute_base']  . '|';
		} else {
			$ajax_exclude_links .= '/attribute'  . '|';
		}
		$ajax_exclude_links = str_replace( home_url(), '', $ajax_exclude_links );
		$ajax_scripts = $spectra_opts->get_option( 'ajax_reload_scripts' );
   		$ajax_el = $spectra_opts->get_option( 'ajax_elements' ) . ',.ajax_add_to_cart,.wc-tabs li a,ul.tabs li a,.woocommerce-review-link,.woocommerce-Button.download';
	} else {
		$ajax_exclude_links = '';
		$ajax_el = $spectra_opts->get_option( 'ajax_elements' );
		$ajax_scripts = $spectra_opts->get_option( 'ajax_reload_scripts' );
	}

	$dir = parse_url( home_url() );
	if ( ! isset( $dir[ 'path' ] ) ) {
		$dir[ 'path' ] = '';
	}

	$js_controls_variables = array(
		'home_url'            => home_url(),
		'theme_uri'           => get_template_directory_uri(),
		'dir'                 => $dir[ 'path' ],
		'ajaxed'              => $ajaxed,
		'permalinks'          => $permalinks,
		'ajax_events'         => $spectra_opts->get_option( 'ajax_events' ),
		'ajax_elements'       => $ajax_el,
		'ajax_async'          => $spectra_opts->get_option( 'ajax_async' ),
		'ajax_cache'          => $spectra_opts->get_option( 'ajax_cache' ),
		'ajax_reload_scripts' => $ajax_scripts,
		'ajax_exclude_links'  => $ajax_exclude_links
	);
	wp_localize_script( 'custom-controls', 'ajax_vars', $js_controls_variables );


	// Custom scripts
	wp_enqueue_script( 'custom-scripts', get_template_directory_uri() . '/js/custom.js' , false, false, true ); // Loads custom scripts

	$js_variables = array(
		'theme_uri'          => get_template_directory_uri(),
		'map_marker'         => $spectra_opts->get_image( $spectra_opts->get_option( 'map_marker' ) ),
		'content_animations' => $spectra_opts->get_option( 'content_animations' ),
		'mobile_animations'  => $spectra_opts->get_option( 'mobile_animations' )
	);
	wp_localize_script( 'custom-scripts', 'theme_vars', $js_variables );


	/*--- Required Styles ---*/
	wp_enqueue_style( 'icomoon', get_stylesheet_directory_uri() . '/icons/icomoon.css' ); // Loads icons ICOMOON.
	wp_enqueue_style( 'magnific-popup', get_stylesheet_directory_uri() . '/css/magnific-popup.css' ); 
	wp_enqueue_style( 'owl-carousel', get_stylesheet_directory_uri() . '/css/owl.carousel.css' ); // Loads OWL CAROUSEL style.
	wp_enqueue_style( SPECTRA_THEME . '-style', get_stylesheet_uri() );	// Loads the main stylesheet.

	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_style( 'woocommerce-theme-style', get_stylesheet_directory_uri() . '/css/woocommerce-theme-style.css' );	// Loads woocommerce stylesheet.
	}
	
}

add_action( 'wp_enqueue_scripts', 'spectra_scripts_and_styles' );


// Fix for VC
function spectra_vc_fix() {
	global $spectra_opts;
	if ( function_exists('vc_remove_element') && $spectra_opts->get_option( 'ajaxed' ) && $spectra_opts->get_option( 'ajaxed' ) === 'on' ) {
		wp_enqueue_script( 'wpb_composer_front_js', plugins_url() . '/js_composer/assets/js/js_composer_front.js' , false, false, true);
	}
}
add_action( 'wp_enqueue_scripts', 'spectra_vc_fix' );


/* ----------------------------------------------------------------------
	TGM PLUGIN ACTIVATION 
/* ---------------------------------------------------------------------- */

require_once( 'inc/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'spectra_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
if ( ! function_exists( 'spectra_register_required_plugins' ) ) :
function spectra_register_required_plugins() {
 
	/**
	 * Array of plugin arrays. Required keys are name, slug and required.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
 		
 		/**
		 * Pre-packaged Plugins
		*/
		array(
			'name'                  => 'Rascals Themes - Spectra Plugin', // The plugin name
			'slug'                  => 'rascals_spectra_plugin', // The plugin slug (typically the folder name)
			'source'                => get_template_directory_uri() . '/plugins/rascals_spectra_plugin.zip', // The plugin source
			'required'              => true, // If false, the plugin is only 'recommended' instead of required
			'version'               => '1.3.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation'    => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'          => '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'               => 'WPBakery Visual Composer', // The plugin name
			'slug'               => 'js_composer', // The plugin slug (typically the folder name)
			'source'             => get_stylesheet_directory() . '/plugins/js_composer.zip', // The plugin source
			'required'           => true, // If false, the plugin is only 'recommended' instead of required
			'version'            => '4.12', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'               => 'MailChimp', // The plugin name
			'slug'               => 'mailchimp', // The plugin slug (typically the folder name)
			'source'             => get_stylesheet_directory() . '/plugins/mailchimp.zip', // The plugin source
			'required'           => false, // If false, the plugin is only 'recommended' instead of required
			'version'            => '1.4.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'       => '', // If set, overrides default API URL and points to an external URL
		),


		/**
		 * WordPress.org Plugins
		 */
		array(
			'name'               => 'Contact Form 7', // The plugin name
			'slug'               => 'contact-form-7', // The plugin slug (typically the folder name)
			'required'           => false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'               => 'WooCommerce', // The plugin name
			'slug'               => 'woocommerce', // The plugin slug (typically the folder name)
			'required'           => false, // If false, the plugin is only 'recommended' instead of required
		)
 
   );
 
	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'spectra';
 
	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'            => SPECTRA_THEME,           // Text domain - likely want to be the same as your theme.
		'default_path'      => '',                           // Default absolute path to pre-packaged plugins
		'menu'              => 'install-required-plugins',   // Menu slug
		'has_notices'       => true,                         // Show admin notices or not
		'is_automatic'      => false,            // Automatically activate plugins after installation or not
		'message'           => ''               // Message to output right before the plugins table
	);
 
	tgmpa( $plugins, $config );
 
}
spectra_register_required_plugins();
endif;


/* ----------------------------------------------------------------------
	WIDGETS AND SIDEBARS
/* ---------------------------------------------------------------------- */
function spectra_widgets_init() {

	global $spectra_opts;

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', SPECTRA_THEME ),
		'id'            => 'primary-sidebar',
		'description'   => __( 'Main sidebar that appears on the left or right.', SPECTRA_THEME ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s anim-css" data-delay="100">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Category Sidebar', SPECTRA_THEME ),
		'id'            => 'category-sidebar',
		'description'   => __( 'Category sidebar that appears on the left or right on category, archives, tag pages.', SPECTRA_THEME ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s anim-css" data-delay="100">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	if ( $spectra_opts->get_option( 'slide_sidebar' ) && $spectra_opts->get_option( 'slide_sidebar' ) == 'on' ) {
		register_sidebar( array(
			'name'          => __( 'Slide Sidebar', SPECTRA_THEME ),
			'id'            => 'slidebar-sidebar',
			'description'   => __( 'Slide sidebar that appear on the right after click on menu icon button.', SPECTRA_THEME ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s anim-css" data-delay="100">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}

	// Custom sidebars
	if ( $spectra_opts->get_option( 'custom_sidebars' ) ) {
			
			foreach ( $spectra_opts->get_option( 'custom_sidebars' ) as $sidebar ) {
				
				$id = sanitize_title_with_dashes( $sidebar[ 'name' ] );
				register_sidebar( array(
					'name'          => $sidebar[ 'name' ],
					'id'            => $id,
					'description'   => __( 'Custom sidebar created in admin options.', SPECTRA_THEME ),
					'before_widget' => '<aside id="%1$s" class="widget %2$s anim-css" data-delay="100">',
					'after_widget'  => '</aside>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
				));
			}
		}

}
add_action( 'widgets_init', 'spectra_widgets_init' );


/* ----------------------------------------------------------------------
	WOOCOMMERCE
/* ---------------------------------------------------------------------- */

if ( class_exists( 'WooCommerce' ) ) {

	global $spectra_opts;


	// If woocommerce page
	function spectra_woocommerce_page () {
        if(  function_exists ( 'is_woocommerce' ) && is_woocommerce()){
                return true;
        }
        $woocommerce_keys   =   array ( "woocommerce_shop_page_id" ,
                                        "woocommerce_terms_page_id" ,
                                        "woocommerce_cart_page_id" ,
                                        "woocommerce_checkout_page_id" ,
                                        "woocommerce_pay_page_id" ,
                                        "woocommerce_thanks_page_id" ,
                                        "woocommerce_myaccount_page_id" ,
                                        "woocommerce_edit_address_page_id" ,
                                        "woocommerce_view_order_page_id" ,
                                        "woocommerce_change_password_page_id" ,
                                        "woocommerce_logout_page_id" ,
                                        "woocommerce_lost_password_page_id" ) ;
        foreach ( $woocommerce_keys as $wc_page_id ) {
                if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
                        return true ;
                }
        }
        return false;
	}

	// Add body class if page is excluded
	if ( $spectra_opts->get_option( 'ajaxed' ) && $spectra_opts->get_option( 'ajaxed' ) === 'on' ) {

		if ( ! function_exists( 'wc_body_classes' ) ) {
			function wc_body_classes( $classes ) {

				if ( is_woocommerce() || is_shop() || is_product_category() || is_product_tag() || is_product() || is_cart() || is_checkout() || is_account_page() ){
					return array_merge( $classes, array( 'wp-ajax-exclude-page' ) );
				} else {
					return $classes;
				}

	    		
			}
			add_filter( 'body_class','wc_body_classes' );
		}
	}

	if ( ! function_exists( 'loop_columns' ) ) {
		function loop_columns() {

			// Shop page ID
			$shop_page_id = get_option( 'woocommerce_shop_page_id' );
			$shop_layout = get_post_meta( $shop_page_id, '_layout', true );
			if ( $shop_layout !== 'wide' && $shop_layout !== 'thin' && $shop_layout !== 'vc' ) {
	    		return 3; // 3 products per row
	    	} else {
	    		return 4;
	    	}
	   	}
	}


	add_filter( 'loop_shop_columns', 'loop_columns' );
}


/* ----------------------------------------------------------------------
	INCLUDE NECESSARY FILES
/* ---------------------------------------------------------------------- */

// Helpers
require_once( trailingslashit( get_template_directory() ) . '/inc/helpers.php' );
require_once( trailingslashit( get_template_directory() ) . '/inc/template-tags.php' );

// Add Theme Customizer functionality.
require_once( trailingslashit( get_template_directory() ) . '/inc/customizer.php' );

// Add Frontend styles and scripts
require_once( trailingslashit( get_template_directory() ) . '/inc/frontend.php' );

// One Click Import
if ( ! function_exists( 'spectra_demo_import' ) ) :
function spectra_demo_import() {
	require_once( trailingslashit( get_template_directory() ) . '/inc/import/init.php' );
}
spectra_demo_import();
endif;