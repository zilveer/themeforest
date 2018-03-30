<?php

	/*
	*
	*	Atelier Functions
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.com
	*
	*	VARIABLE DEFINITIONS
	*	PLUGIN INCLUDES
	*	THEME UPDATER
	*	THEME SUPPORT
	*	THUMBNAIL SIZES
	*	CONTENT WIDTH
	*	LOAD THEME LANGUAGE
	*	sf_custom_content_functions()
	*	sf_include_framework()
	*	sf_enqueue_styles()
	*	sf_enqueue_scripts()
	*	sf_load_custom_scripts()
	*	sf_admin_scripts()
	*	sf_layerslider_overrides()
	*
	*/


	/* VARIABLE DEFINITIONS
	================================================== */
	define('SF_TEMPLATE_PATH', get_template_directory());
	define('SF_INCLUDES_PATH', SF_TEMPLATE_PATH . '/includes');
	define('SF_FRAMEWORK_PATH', SF_TEMPLATE_PATH . '/swift-framework');
	define('SF_WIDGETS_PATH', SF_INCLUDES_PATH . '/widgets');
	define('SF_LOCAL_PATH', get_template_directory_uri());

	/* PLUGIN INCLUDES
	================================================== */
	require_once(SF_INCLUDES_PATH . '/plugins/aq_resizer.php');
	include_once(SF_INCLUDES_PATH . '/plugin-includes.php');
	require_once(SF_INCLUDES_PATH . '/theme_update_check.php');
	$AtelierUpdateChecker = new ThemeUpdateChecker(
	    'atelier',
	    'https://kernl.us/api/v1/theme-updates/564c90177ad3303b210d6b47/'
	);
	
	/* THEME SETUP
	================================================== */
	if (!function_exists('sf_atelier_setup')) {
		function sf_atelier_setup() {

			/* SF THEME OPTION CHECK
			================================================== */
			if ( get_option( 'sf_theme' ) == false ) {
				update_option( 'sf_theme', 'atelier' );
			}

			/* THEME SUPPORT
			================================================== */
			add_theme_support( 'structured-post-formats', array('audio', 'gallery', 'image', 'link', 'video') );
			add_theme_support( 'post-formats', array('aside', 'chat', 'quote', 'status') );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'woocommerce' );
			add_theme_support( 'swiftframework', array(
				'swift-smartscript'			=> true,
				'slideout-menu'				=> true,
				'page-heading-woocommerce'	=> false,
				'pagination-fullscreen'		=> false,
				'bordered-button'			=> true,
				'3drotate-button'			=> false,
				'rounded-button'			=> true,
				'product-inner-heading'		=> true,
				'product-summary-tabs'		=> false,
				'product-layout-opts'		=> true,
				'mobile-shop-filters' 		=> true,
				'mobile-logo-override'		=> true,
				'product-multi-masonry'		=> true,
				'product-preview-slider'	=> true,
				'super-search-config'		=> true,
				'advanced-row-styling'		=> true,
				'gizmo-icon-font'			=> false,
				'icon-mind-font'			=> true,
				'nucleo-general-font'		=> false,
				'nucleo-interface-font'		=> false,
				'menu-new-badge'			=> true,
				'advanced-map-styles'		=> true,
				'minimal-team-hover'		=> false,
				'pushnav-menu'				=> false,
				'split-nav-menu'			=> false,
				'max-mega-menu'				=> false,
				'page-heading-woo-description' => false,
				'header-aux-modals'			=> false,
				'hamburger-css' 			=> false
			) );

			/* THUMBNAIL SIZES
			================================================== */
			set_post_thumbnail_size( 220, 150, true);
			add_image_size( 'widget-image', 94, 70, true);
			add_image_size( 'thumb-square', 250, 250, true);
			add_image_size( 'thumb-image', 600, 450, true);
			add_image_size( 'thumb-image-twocol', 900, 675, true);
			add_image_size( 'thumb-image-onecol', 1800, 1200, true);
			add_image_size( 'blog-image', 1280, 9999);
			add_image_size( 'gallery-image', 1000, 9999);
			add_image_size( 'large-square', 1200, 1200, true);
			add_image_size( 'full-width-image-gallery', 1280, 720, true);

			/* CONTENT WIDTH
			================================================== */
			if ( ! isset( $content_width ) ) $content_width = 1140;

			/* LOAD THEME LANGUAGE
			================================================== */
			load_theme_textdomain('swiftframework', SF_TEMPLATE_PATH.'/language');

		}
		add_action( 'after_setup_theme', 'sf_atelier_setup' );
	}


	/* THEME FRAMEWORK FUNCTIONS
	================================================== */
	include_once( SF_FRAMEWORK_PATH . '/core/sf-sidebars.php' );
	include_once( SF_FRAMEWORK_PATH . '/widgets/widget-twitter.php' );
	include_once( SF_FRAMEWORK_PATH . '/widgets/widget-flickr.php' );
	include_once( SF_FRAMEWORK_PATH . '/widgets/widget-instagram.php' );
	include_once( SF_FRAMEWORK_PATH . '/widgets/widget-video.php' );
	include_once( SF_FRAMEWORK_PATH . '/widgets/widget-posts.php' );
	include_once( SF_FRAMEWORK_PATH . '/widgets/widget-portfolio.php' );
	include_once( SF_FRAMEWORK_PATH . '/widgets/widget-portfolio-grid.php' );
	include_once( SF_FRAMEWORK_PATH . '/widgets/widget-advertgrid.php' );
	include_once( SF_FRAMEWORK_PATH . '/widgets/widget-infocus.php' );
	include_once( SF_FRAMEWORK_PATH . '/widgets/widget-comments.php' );
	include_once( SF_FRAMEWORK_PATH . '/widgets/widget-mostloved.php' );
	require_once(SF_INCLUDES_PATH . '/overrides/sf-theme-overrides.php');
	
	include_once(SF_INCLUDES_PATH . '/meta-box/meta-box.php');
	include_once(SF_INCLUDES_PATH . '/meta-boxes.php');
	
	if (!function_exists('sf_include_framework')) {
		function sf_include_framework() {
			require_once(SF_INCLUDES_PATH . '/overrides/sf-theme-functions.php');
			require_once(SF_INCLUDES_PATH . '/sf-customizer-options.php');
			include_once(SF_INCLUDES_PATH . '/sf-custom-styles.php');
			include_once(SF_INCLUDES_PATH . '/sf-styleswitcher/sf-styleswitcher.php');
			require_once(SF_INCLUDES_PATH . '/overrides/sf-spb-overrides.php');
			require_once(SF_FRAMEWORK_PATH . '/swift-framework.php');			
			include_once(SF_INCLUDES_PATH . '/overrides/sf-framework-overrides.php');
		}
		add_action('init', 'sf_include_framework', 5);
	}


	/* THEME OPTIONS FRAMEWORK
	================================================== */
	require_once(SF_INCLUDES_PATH . '/sf-colour-scheme.php');
	if (!function_exists('sf_include_theme_options')) {
		function sf_include_theme_options() {
			if (!class_exists( 'ReduxFramework' )) {
			    require_once( SF_INCLUDES_PATH . '/options/framework.php' );
			}
			require_once( SF_INCLUDES_PATH . '/option-extensions/loader.php' );
			require_once( SF_INCLUDES_PATH . '/sf-options.php' );
			global $sf_atelier_options, $sf_options;
			$sf_options = $sf_atelier_options;
		}
		add_action('init', 'sf_include_theme_options', 10);
	}

	
	/* THEME OPTIONS VAR RETRIEVAL
	================================================== */
	if (!function_exists('sf_get_theme_opts')) {
		function sf_get_theme_opts() {
			global $sf_atelier_options;
			return $sf_atelier_options;
		}
	}
	
	
	/* LOVE IT INCLUDE
	================================================== */
	if (!function_exists('sf_love_it_include')) {
		function sf_love_it_include() {
			global $sf_options;
			$disable_loveit = false;
			if (isset($sf_options['disable_loveit'])) {
			$disable_loveit = $sf_options['disable_loveit'];
			}

			if (!$disable_loveit) {
			include_once(SF_INCLUDES_PATH . '/plugins/love-it-pro/love-it-pro.php');
			}
		}
		add_action('init', 'sf_love_it_include', 20);
	}


	/* LOAD STYLESHEETS
	================================================== */
	if (!function_exists('sf_enqueue_styles')) {
		function sf_enqueue_styles() {

			global $sf_options, $is_IE;
			$enable_min_styles = $sf_options['enable_min_styles'];
			$enable_responsive = $sf_options['enable_responsive'];
			$enable_rtl = $sf_options['enable_rtl'];
            //$upload_dir = wp_upload_dir();

            //FONTELLO ICONS 
//            if ( get_option('sf_fontello_icon_codes') && get_option('sf_fontello_icon_codes') != '' ){
//				wp_register_style('sf-fontello',  $upload_dir['baseurl'] . '/redux/custom-icon-fonts/fontello_css/fontello-embedded.css', array(), NULL, 'all');
//				wp_enqueue_style('sf-fontello');
//		    }

		    wp_register_style('sf-style', get_stylesheet_directory_uri() . '/style.css', array(), NULL, 'all');
		    wp_register_style('bootstrap', SF_LOCAL_PATH . '/css/bootstrap.min.css', array(), NULL, 'all');
		    wp_register_style('fontawesome', SF_LOCAL_PATH .'/css/font-awesome.min.css', array(), NULL, 'all');
		    wp_register_style('sf-main', SF_LOCAL_PATH . '/css/main.css', array(), NULL, 'all');
		    wp_register_style('sf-rtl', SF_LOCAL_PATH . '/rtl.css', array(), NULL, 'all');
		    wp_register_style('sf-rtl-min', SF_LOCAL_PATH . '/rtl.min.css', array(), NULL, 'all');
		    wp_register_style('sf-woocommerce', SF_LOCAL_PATH . '/css/sf-woocommerce.css', array(), NULL, 'all');
		    wp_register_style('sf-edd', SF_LOCAL_PATH . '/css/sf-edd.css', array(), NULL, 'all');
		    wp_register_style('sf-responsive', SF_LOCAL_PATH . '/css/responsive.css', array(), NULL, 'all');
		    wp_register_style('sf-responsive-min', SF_LOCAL_PATH . '/css/responsive.css', array(), NULL, 'all');
		    wp_register_style('sf-combined-min', SF_LOCAL_PATH . '/css/sf-combined.min.css', array(), NULL, 'all');

			if ( $enable_min_styles && !$is_IE ) {
				wp_enqueue_style('sf-combined-min');
				
				if (sf_edd_activated()) {
					wp_enqueue_style('sf-edd');
				}

				if (is_rtl() || $enable_rtl || isset($_GET['RTL'])) {
			    	wp_enqueue_style('sf-rtl-min');
			    }

			    if ($enable_responsive) {
			    	wp_enqueue_style('sf-responsive-min');
			    }
				wp_enqueue_style('sf-style');
			} else {
			    wp_enqueue_style('bootstrap');
			    wp_enqueue_style('fontawesome');
			    wp_enqueue_style('sf-main');

			    if (sf_woocommerce_activated()) {
			    	wp_enqueue_style('sf-woocommerce');
			    }
			    
			    if (sf_edd_activated()) {
			    	wp_enqueue_style('sf-edd');
			    }

			    if (is_rtl() || $enable_rtl || isset($_GET['RTL'])) {
			    	wp_enqueue_style('sf-rtl');
			    }

			    if ($enable_responsive) {
			    	wp_enqueue_style('sf-responsive');
			    }

				wp_enqueue_style('sf-style');

			}
		}
		add_action('wp_enqueue_scripts', 'sf_enqueue_styles');
	}


	/* LOAD FRONTEND SCRIPTS
	================================================== */
	if (!function_exists('sf_enqueue_scripts')) {
		function sf_enqueue_scripts() {

			// Variables
			global $sf_options, $post;
		    $enable_rtl = $sf_options['enable_rtl'];
		    $enable_smoothscroll = $sf_options['enable_smoothscroll'];
		    $enable_min_scripts = $sf_options['enable_min_scripts'];
			$post_type = get_query_var('post_type');
			$product_zoom = $sf_options['enable_product_zoom'];
			if ( isset($_GET['product_zoom']) ) {
				$product_zoom = true;
			}

			// Page Content Meta
			$page_has_map = false;
			if ( $post ) {
				$page_has_map      = sf_get_post_meta( $post->ID, 'sf_page_has_map', true );
			}
			if ( is_page_template('template-directory-submit.php') || ( isset( $post ) && get_post_type( $post->ID ) == 'directory' ) ) {
				$page_has_map = true;	
			}
			$gmaps_api_key = get_option('sf_gmaps_api_key');

		    // Register Scripts
		    wp_register_script('sf-bootstrap-js', SF_LOCAL_PATH . '/js/combine/bootstrap.min.js', 'jquery', NULL, TRUE);
		    wp_register_script('sf-isotope', SF_LOCAL_PATH . '/js/combine/jquery.isotope.min.js', 'jquery', NULL, TRUE);
		    wp_register_script('sf-imagesLoaded', SF_LOCAL_PATH . '/js/combine/imagesloaded.js', 'jquery', NULL, TRUE);
		    wp_register_script('sf-owlcarousel', SF_LOCAL_PATH . '/js/combine/owl.carousel.min.js', 'jquery', NULL, TRUE);
			wp_register_script('sf-jquery-ui', SF_LOCAL_PATH . '/js/combine/jquery-ui-1.11.4.custom.min.js', 'jquery', NULL, TRUE);
			wp_register_script('sf-ilightbox', SF_LOCAL_PATH . '/js/combine/ilightbox.min.js', 'jquery', NULL, TRUE);
		    wp_register_script('google-maps', '//maps.google.com/maps/api/js?key=' . $gmaps_api_key, 'jquery', NULL, TRUE);
		    wp_register_script('sf-elevatezoom', SF_LOCAL_PATH . '/js/combine/jquery.elevateZoom.min.js', 'jquery', NULL, TRUE);
		    wp_register_script('sf-infinite-scroll',  SF_LOCAL_PATH . '/js/combine/jquery.infinitescroll.min.js', 'jquery', NULL, TRUE);
		    wp_register_script('sf-theme-scripts', SF_LOCAL_PATH . '/js/combine/theme-scripts.js', 'jquery', NULL, TRUE);
		    wp_register_script('sf-theme-scripts-min', SF_LOCAL_PATH . '/js/sf-scripts.min.js', 'jquery', NULL, TRUE);
		    wp_register_script('jquery-cookie', SF_LOCAL_PATH . '/js/jquery.cookie.js', 'jquery', NULL, FALSE);
		    wp_register_script('sf-functions', SF_LOCAL_PATH . '/js/functions.js', 'jquery', NULL, TRUE);
		    wp_register_script('sf-functions-min', SF_LOCAL_PATH . '/js/functions.min.js', 'jquery', NULL, TRUE);
		    wp_register_script('sf-smoothscroll', SF_LOCAL_PATH . '/js/sscr.js', '', NULL, FALSE);


			// jQuery
		    wp_enqueue_script('jquery');
			wp_enqueue_script('jquery-cookie');
			
		    if ( $enable_smoothscroll ) {
		    	wp_enqueue_script('sf-smoothscroll');
		    }

		    if ( !is_admin() ) {

		    	// Theme Scripts
		    	if ($enable_min_scripts) {
		    		wp_enqueue_script('sf-theme-scripts-min');
		    		if ( $page_has_map ) {
		    			wp_enqueue_script('google-maps');
		    		}
		    		wp_enqueue_script('sf-functions-min');
		    	} else {
		    		wp_enqueue_script('sf-bootstrap-js');
		    		wp_enqueue_script('sf-jquery-ui');

		    		wp_enqueue_script('sf-owlcarousel');
		    		wp_enqueue_script('sf-theme-scripts');
		    		wp_enqueue_script('sf-ilightbox');

		    		if ( $page_has_map ) {
		    			wp_enqueue_script('google-maps');
		    		}

		    		wp_enqueue_script('sf-isotope');
		    		wp_enqueue_script('sf-imagesLoaded');
		    		wp_enqueue_script('sf-infinite-scroll');

		    		if ( $product_zoom ) {
		    			wp_enqueue_script('sf-elevatezoom');
		    		}

		    		wp_enqueue_script('sf-functions');
		    	}

		    }
		}
		add_action('wp_enqueue_scripts', 'sf_enqueue_scripts');
	}

	function sf_custom_bwp_minify_remove() {

		global $is_IE;

		if ($is_IE) {
			return array('');
		}
	}
	add_filter('bwp_minify_allowed_styles', 'sf_custom_bwp_minify_remove');


	/* LOAD BACKEND SCRIPTS
	================================================== */
	function sf_admin_scripts() {
	    wp_register_script('admin-functions', get_template_directory_uri() . '/js/sf-admin.js', 'jquery', '1.0', TRUE);
		wp_enqueue_script('admin-functions');
        $upload_dir = wp_upload_dir();
		
		//FONTELLO ICONS 
//        if ( get_option('sf_fontello_icon_codes') && get_option('sf_fontello_icon_codes') != '' ){
//			wp_register_style('sf-fontello',  $upload_dir['baseurl'] . '/redux/custom-fonts/fontello_css/fontello-embedded.css', array(), NULL, 'all');
//			wp_enqueue_style('sf-fontello');
//		}
			
	}
	add_action('admin_enqueue_scripts', 'sf_admin_scripts');


	/* WOO CHECKOUT BUTTON
	================================================== */
	if ( ! function_exists( 'woocommerce_button_proceed_to_checkout' ) ) {
		function woocommerce_button_proceed_to_checkout() {
			$checkout_url = WC()->cart->get_checkout_url();
			?>
			<a class="sf-button standard sf-icon-reveal checkout-button accent" href="<?php echo esc_url($checkout_url); ?>">
				<i class="fa-long-arrow-right"></i>
				<span class="text"><?php _e( 'Proceed to Checkout', 'swiftframework' ); ?></span>
			</a>
			<?php
		}
	}

	/* CHECK THEME FEATURE SUPPORT
    ================================================== */
    if ( !function_exists( 'sf_theme_supports' ) ) {
        function sf_theme_supports( $feature ) {
        	$supports = get_theme_support( 'swiftframework' );
        	$supports = $supports[0];
    		if ($supports[ $feature ] == "") {
    			return false;
    		} else {
        		return isset( $supports[ $feature ] );
        	}
        }
    }

    /* SIDEBAR FILTERS
	================================================== */
	function sf_atelier_sidebar_before_title() {
		return '<div class="widget-heading title-wrap clearfix"><h3 class="spb-heading"><span>';
	}
	add_filter('sf_sidebar_before_title', 'sf_atelier_sidebar_before_title');

	function sf_atelier_sidebar_after_title() {
		return '</span></h3></div>';
	}
	add_filter('sf_sidebar_after_title', 'sf_atelier_sidebar_after_title');


	/* FOOTER FILTERS
	================================================== */
	function sf_atelier_footer_before_title() {
		return '<div class="widget-heading title-wrap clearfix"><h3 class="spb-heading"><span>';
	}
	add_filter('sf_footer_before_title', 'sf_atelier_footer_before_title');

	function sf_atelier_footer_after_title() {
		return '</span></h3></div>';
	}
	add_filter('sf_footer_after_title', 'sf_atelier_footer_after_title');
	
	
	/* EDD FILTERS
	================================================== */
	remove_filter( 'the_title', 'edd_microdata_title', 10, 2 );
