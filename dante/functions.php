<?php
	
	/*
	*
	*	Dante Functions
	*	------------------------------------------------
	*	Swift Framework
	* 	Copyright Swift Ideas 2016 - http://www.swiftideas.net
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
	
	
	/* CHECK WPML IS ACTIVE
	================================================== */ 
	if ( ! function_exists( 'sf_wpml_activated' ) ) {
		function sf_wpml_activated() {
			if ( function_exists('icl_object_id') ) {
				return true;
			} else {
				return false;
			}
		}
	}
	
	
	/* PLUGIN INCLUDES
	================================================== */
	$options = get_option('sf_dante_options');
	$disable_loveit = false;
	if (isset($options['disable_loveit']) && $options['disable_loveit'] == 1) {
	$disable_loveit = true;
	}
	require_once(SF_INCLUDES_PATH . '/plugins/aq_resizer.php');
	include_once(SF_INCLUDES_PATH . '/plugin-includes.php');
	
	// Love it
	if (!$disable_loveit) {
	include_once(SF_INCLUDES_PATH . '/plugins/love-it-pro/love-it-pro.php');
	}
	
	// Auto-update
	require_once(SF_INCLUDES_PATH . '/theme_update_check.php');
	$NeighborhoodUpdateChecker = new ThemeUpdateChecker(
	    'dante',
	    'https://kernl.us/api/v1/theme-updates/5667fe730a25612471e649f2/'
	);
	
	// Revslider
	if ( function_exists('set_revslider_as_theme') ) {
		set_revslider_as_theme();
	}
	
	
	/* THEME SETUP
	================================================== */
	if (!function_exists('sf_dante_setup')) {
		function sf_dante_setup() { 	
		
			/* THEME SUPPORT
			================================================== */  			
			add_theme_support( 'structured-post-formats', array('audio', 'gallery', 'image', 'link', 'video') );
			add_theme_support( 'post-formats', array('aside', 'chat', 'quote', 'status') );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'woocommerce' );
			
			
			/* THUMBNAIL SIZES
			================================================== */  	
			set_post_thumbnail_size( 220, 150, true);
			add_image_size( 'widget-image', 94, 70, true);
			add_image_size( 'thumb-square', 250, 250, true);
			add_image_size( 'thumb-image', 600, 450, true);
			add_image_size( 'thumb-image-twocol', 900, 675, true);
			add_image_size( 'thumb-image-onecol', 1800, 1200, true);
			add_image_size( 'blog-image', 1280, 9999);
			add_image_size( 'full-width-image-gallery', 1280, 720, true);
			
			
			/* CONTENT WIDTH
			================================================== */
			if ( ! isset( $content_width ) ) $content_width = 1140;
			
			
			/* LOAD THEME LANGUAGE
			================================================== */
			load_theme_textdomain('swiftframework', SF_TEMPLATE_PATH.'/language');
			
		}
		add_action( 'after_setup_theme', 'sf_dante_setup' );
	}
	
	/* META BOX FRAMEWORK
	================================================== */
	include_once(SF_FRAMEWORK_PATH . '/meta-box/meta-box.php');
	include_once(SF_FRAMEWORK_PATH . '/meta-boxes.php');
	
	
	/* CONTENT FUNCTIONS
	================================================== */
	if (!function_exists('sf_custom_content')) {
		function sf_custom_content_functions() {
			include_once(SF_INCLUDES_PATH . '/sf-header.php');
			include_once(SF_INCLUDES_PATH . '/sf-page-heading.php');
			include_once(SF_INCLUDES_PATH . '/sf-blog.php');
			include_once(SF_INCLUDES_PATH . '/sf-portfolio.php');
			include_once(SF_INCLUDES_PATH . '/sf-portfolio-detail.php');
			include_once(SF_INCLUDES_PATH . '/sf-products.php');
			include_once(SF_INCLUDES_PATH . '/sf-post-formats.php');
		}
		add_action('init', 'sf_custom_content_functions', 0);
	}
	
	
	/* SWIFT FRAMEWORK
	================================================== */ 
	if (!function_exists('sf_include_framework')) {
		function sf_include_framework() {
			require_once(SF_INCLUDES_PATH . '/sf-theme-functions.php');
			require_once(SF_INCLUDES_PATH . '/sf-comments.php');
			require_once(SF_INCLUDES_PATH . '/sf-formatting.php');
			require_once(SF_INCLUDES_PATH . '/sf-media.php');
			require_once(SF_INCLUDES_PATH . '/sf-menus.php');
			require_once(SF_INCLUDES_PATH . '/sf-pagination.php');
			require_once(SF_INCLUDES_PATH . '/sf-sidebars.php');
			require_once(SF_INCLUDES_PATH . '/sf-customizer-options.php');
			include_once(SF_INCLUDES_PATH . '/sf-custom-styles.php');
			include_once(SF_INCLUDES_PATH . '/sf-styleswitcher/sf-styleswitcher.php');
			require_once(SF_FRAMEWORK_PATH . '/swift-framework.php');
		}
		add_action('init', 'sf_include_framework', 0);
	}
	
	
	/* THEME OPTIONS FRAMEWORK
	================================================== */  
	require_once(SF_INCLUDES_PATH . '/sf-colour-scheme.php');
	if (!function_exists('sf_include_theme_options')) {
		function sf_include_theme_options() {
			require_once(SF_INCLUDES_PATH . '/sf-options.php');
		}
		add_action('after_setup_theme', 'sf_include_theme_options', 10);
	}
	
	
	/* LOAD STYLESHEETS
	================================================== */
	if (!function_exists('sf_enqueue_styles')) {
		function sf_enqueue_styles() {  
			
			$options = get_option('sf_dante_options');
			$enable_responsive = $options['enable_responsive'];		
		
		    wp_register_style('bootstrap', SF_LOCAL_PATH . '/css/bootstrap.min.css', array(), NULL, 'all');
		    wp_register_style('fontawesome', SF_LOCAL_PATH .'/css/font-awesome.min.css', array(), NULL, 'all');
		    wp_register_style('ssgizmo', SF_LOCAL_PATH .'/css/ss-gizmo.css', array(), NULL, 'all');
		    wp_register_style('sf-main', get_stylesheet_directory_uri() . '/style.css', array(), NULL, 'all'); 
		    wp_register_style('sf-responsive', SF_LOCAL_PATH . '/css/responsive.css', array(), NULL, 'all');
			
		    wp_enqueue_style('bootstrap');  
		    wp_enqueue_style('ssgizmo');
		    wp_enqueue_style('fontawesome'); 
		    wp_enqueue_style('sf-main');  
		    
		    if ($enable_responsive) {
		    	wp_enqueue_style('sf-responsive');  
		    }
		
		}		
		add_action('wp_enqueue_scripts', 'sf_enqueue_styles', 99);  
	}
	
	
	/* LOAD FRONTEND SCRIPTS
	================================================== */
	if (!function_exists('sf_enqueue_scripts')) {
		function sf_enqueue_scripts() {
			
			$options = get_option('sf_dante_options');
			$enable_min_scripts = false;
			if (isset($options['enable_min_scripts'])) {	
			$enable_min_scripts = $options['enable_min_scripts'];
			}
			if (isset($options['enable_product_zoom'])) {	
				$enable_product_zoom = $options['enable_product_zoom'];	
			}
			$gmaps_api_key = "";
			if (isset($options['gmaps_api_key'])) {
				$gmaps_api_key = $options['gmaps_api_key'];
			}
			$post_type = get_query_var('post_type');
			
		    wp_register_script('sf-bootstrap-js', SF_LOCAL_PATH . '/js/combine/bootstrap.min.js', 'jquery', NULL, TRUE);
		    wp_register_script('sf-flexslider', SF_LOCAL_PATH . '/js/combine/jquery.flexslider-min.js', 'jquery', NULL, TRUE);
		    wp_register_script('sf-isotope', SF_LOCAL_PATH . '/js/combine/jquery.isotope.min.js', 'jquery', NULL, TRUE);
		    wp_register_script('sf-imagesLoaded', SF_LOCAL_PATH . '/js/combine/imagesloaded.js', 'jquery', NULL, TRUE);
		    wp_register_script('sf-easing', SF_LOCAL_PATH . '/js/combine/jquery.easing.js', 'jquery', NULL, TRUE);
		    wp_register_script('sf-owlcarousel', SF_LOCAL_PATH . '/js/combine/owl.carousel.min.js', 'jquery', NULL, TRUE); 
			wp_register_script('sf-jquery-ui', SF_LOCAL_PATH . '/js/combine/jquery-ui-1.10.2.custom.min.js', 'jquery', NULL, TRUE);
			wp_register_script('sf-ilightbox', SF_LOCAL_PATH . '/js/combine/ilightbox.min.js', 'jquery', NULL, TRUE);
		    wp_register_script('sf-fitvids', SF_LOCAL_PATH . '/js/combine/jquery.fitvids.js', 'jquery', NULL , TRUE);
		    wp_register_script('google-maps', '//maps.google.com/maps/api/js?key=' . $gmaps_api_key, 'jquery', NULL, TRUE);
		    wp_register_script('sf-elevatezoom', SF_LOCAL_PATH . '/js/combine/jquery.elevateZoom.min.js', 'jquery', NULL, TRUE);
		    wp_register_script('sf-infinite-scroll',  SF_LOCAL_PATH . '/js/combine/jquery.infinitescroll.min.js', 'jquery', NULL, TRUE);
		    wp_register_script('sf-theme-scripts', SF_LOCAL_PATH . '/js/theme-scripts.js', 'jquery', NULL, TRUE);
		    wp_register_script('sf-functions', SF_LOCAL_PATH . '/js/functions.js', 'jquery', NULL, TRUE);
			
		    wp_enqueue_script('jquery');
		    
    		wp_enqueue_script('sf-bootstrap-js');
    	    wp_enqueue_script('sf-jquery-ui');
    	    wp_enqueue_script('sf-flexslider');
    		wp_enqueue_script('sf-easing');
    		wp_enqueue_script('sf-owlcarousel');
    	    wp_enqueue_script('sf-theme-scripts');
    	    wp_enqueue_script('sf-ilightbox');
    	    
		    if ( !is_singular('tribe_events') && $post_type != 'tribe_events' && !is_post_type_archive('events') && !is_post_type_archive('tribe_events')) {
		    	wp_enqueue_script('google-maps');
		    }
		    wp_enqueue_script('sf-isotope');
		    wp_enqueue_script('sf-imagesLoaded');
		    wp_enqueue_script('sf-infinite-scroll');
		
		
			if ($enable_product_zoom) {
				wp_enqueue_script('sf-elevatezoom');
			}
	   	
    	    if (!is_admin()) {
    	    	wp_enqueue_script('sf-functions');
    	    }
		    
		   	if (is_singular() && comments_open()) {
		    	wp_enqueue_script('comment-reply');
		    }
		}
		add_action('wp_enqueue_scripts', 'sf_enqueue_scripts');
	}
	
	/* REQUIRED IE8 COMPATIBILITY SCRIPTS
	================================================== */
	if (!function_exists('sf_html5_ie_scripts')) {	
	    function sf_html5_ie_scripts() {
	        $theme_url = get_template_directory_uri();
	        $ie_scripts = '';
	        
	        $ie_scripts .= '<!--[if lt IE 9]>';
	        $ie_scripts .= '<script data-cfasync="false" src="'.$theme_url.'/js/respond.min.js"></script>';
	        $ie_scripts .= '<script data-cfasync="false" src="'.$theme_url.'/js/html5shiv.js"></script>';
	        $ie_scripts .= '<script data-cfasync="false" src="'.$theme_url.'/js/excanvas.compiled.js"></script>';
	        $ie_scripts .= '<script data-cfasync="false" src="'.$theme_url.'/js/background_size_emu.js"></script>';
	        $ie_scripts .= '<![endif]-->';
	        echo $ie_scripts;
	    }
	    add_action('wp_head', 'sf_html5_ie_scripts');
	}
	
	/* LOAD BACKEND SCRIPTS
	================================================== */
	function sf_admin_scripts() {
	    wp_register_script('admin-functions', get_template_directory_uri() . '/js/sf-admin.js', 'jquery', '1.0', TRUE);
		wp_enqueue_script('admin-functions');
	}
	add_action('admin_init', 'sf_admin_scripts');
	
	
	/* LAYERSLIDER OVERRIDES
	================================================== */
	function sf_layerslider_overrides() {
		// Disable auto-updates
		$GLOBALS['lsAutoUpdateBox'] = false;
	}
	add_action('layerslider_ready', 'sf_layerslider_overrides');
	
	
	/* PERFORMANCE FRIENDLY GET META FUNCTION
    ================================================== */
    if ( !function_exists( 'sf_get_post_meta' ) ) {
	    function sf_get_post_meta( $id, $key = "", $single = false ) {

	        $GLOBALS['sf_post_meta'] = isset( $GLOBALS['sf_post_meta'] ) ? $GLOBALS['sf_post_meta'] : array();
	        if ( ! isset( $id ) ) {
	            return;
	        }
	        if ( ! is_array( $id ) ) {
	            if ( ! isset( $GLOBALS['sf_post_meta'][ $id ] ) ) {
	                //$GLOBALS['sf_post_meta'][ $id ] = array();
	                $GLOBALS['sf_post_meta'][ $id ] = get_post_meta( $id );
	            }
	            if ( ! empty( $key ) && isset( $GLOBALS['sf_post_meta'][ $id ][ $key ] ) && ! empty( $GLOBALS['sf_post_meta'][ $id ][ $key ] ) ) {
	                if ( $single ) {
	                    return maybe_unserialize( $GLOBALS['sf_post_meta'][ $id ][ $key ][0] );
	                } else {
	                    return array_map( 'maybe_unserialize', $GLOBALS['sf_post_meta'][ $id ][ $key ] );
	                }
	            }

	            if ( $single ) {
	                return '';
	            } else {
	                return array();
	            }

	        }

	        return get_post_meta( $id, $key, $single );
	    }
    }
    
	
	/* SIDEKICK INTEGRATION
	================================================== */
	define('SK_SUBSCRIPTION_ID', 1699);
	define('SK_ENVATO_PARTNER', 'fsvfcYeV+/o2Fuah92iLO99cU0KXi3EpbTcYYZ2PSsY=');
	define('SK_ENVATO_SECRET', 'RqjBt/YyaTOjDq+lKLWhL10sFCMCJciT9SPUKLBBmso=');
	
	