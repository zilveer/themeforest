<?php
	
	/* ==================================================
	
	Swift Framework Main Functions
	
	================================================== */
	
	
	/* VARIABLE DEFINITIONS
	================================================== */ 
	define('SF_TEMPLATE_PATH', get_template_directory());
	define('SF_INCLUDES_PATH', SF_TEMPLATE_PATH . '/includes');
	define('SF_FRAMEWORK_PATH', SF_INCLUDES_PATH . '/swift-framework');
	define('SF_WIDGETS_PATH', SF_INCLUDES_PATH . '/widgets');
	define('SF_LOCAL_PATH', get_template_directory_uri());
	
	
	/* CHECK FOR IMPORTER PLUGIN
	================================================== */ 
	if ( ! function_exists( 'sf_is_neighborhood' ) ) {
		function sf_is_neighborhood() {
			return true;
		}
	}
	
	
	/* CHECK WOOCOMMERCE IS ACTIVE
	================================================== */ 
	if ( ! function_exists( 'sf_woocommerce_activated' ) ) {
		function sf_woocommerce_activated() {
			if ( class_exists( 'woocommerce' ) ) {
				return true;
			} else {
				return false;
			}
		}
	}
	
	
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
	
	
	/* INCLUDES
	================================================== */
	
	/* Add custom post types */
	require_once(SF_INCLUDES_PATH . '/custom-post-types/portfolio-type.php');
	require_once(SF_INCLUDES_PATH . '/custom-post-types/team-type.php');
	require_once(SF_INCLUDES_PATH . '/custom-post-types/clients-type.php');
	require_once(SF_INCLUDES_PATH . '/custom-post-types/testimonials-type.php');
	require_once(SF_INCLUDES_PATH . '/custom-post-types/jobs-type.php');
	require_once(SF_INCLUDES_PATH . '/custom-post-types/faqs-type.php');
	require_once(SF_INCLUDES_PATH . '/custom-post-types/sf-post-type-permalinks.php' );
	
	/* Add image resizer */
	require_once(SF_INCLUDES_PATH . '/plugins/aq_resizer.php');

	/* Add taxonomy meta boxes */
	require_once(SF_INCLUDES_PATH . '/taxonomy-meta-class/Tax-meta-class.php');
	
	/* Include plugins */
	include(SF_INCLUDES_PATH . '/plugin-includes.php');	
	include(SF_INCLUDES_PATH . '/plugins/love-it-pro/love-it-pro.php');

	/* Include widgets */
	include(SF_WIDGETS_PATH . '/widget-twitter.php');
	include(SF_WIDGETS_PATH . '/widget-flickr.php');
	include(SF_WIDGETS_PATH . '/widget-video.php');
	include(SF_WIDGETS_PATH . '/widget-posts.php');
	include(SF_WIDGETS_PATH . '/widget-portfolio.php');
	include(SF_WIDGETS_PATH . '/widget-portfolio-grid.php');
	include(SF_WIDGETS_PATH . '/widget-advertgrid.php');
	include(SF_WIDGETS_PATH . '/widget-infocus.php');
	
	
	/* THEME OPTIONS FRAMEWORK
	================================================== */  
	require_once (SF_FRAMEWORK_PATH . '/sf-options.php');
	
	
	/* COLOUR CUSTOMISATION OPTIONS
	================================================== */  
	require_once (SF_FRAMEWORK_PATH . '/sf-colour-scheme.php');
	
	
	/* THEME FRAMEWORK FUNCTIONS
    ================================================== */
    if ( ! function_exists( 'sf_include_framework' ) ) {
        function sf_include_framework() {
            require_once( SF_FRAMEWORK_PATH . '/swift-framework.php' );
        }
        add_action( 'init', 'sf_include_framework', 10 );
    }



	/* THEME SUPPORT
	================================================== */  	
		
	add_theme_support( 'structured-post-formats', array(
	    'audio', 'gallery', 'image', 'link', 'video'
	) );
	add_theme_support( 'post-formats', array(
	    'aside', 'chat', 'quote', 'status'
	) );
	
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	set_post_thumbnail_size( 220, 150, true);
	add_image_size( 'widget-image', 94, 70, true);
	add_image_size( 'thumb-image', 600, 450, true);
	add_image_size( 'thumb-image-twocol', 900, 675, true);
	add_image_size( 'thumb-image-onecol', 1280, 960, true);
	add_image_size( 'blog-image', 1280, 9999);
	add_image_size( 'full-width-image', 1280, 720, true);
	add_image_size( 'full-width-image-gallery', 1280, 720, true);
	
	
	/* CONTENT WIDTH
	================================================== */
	
	if ( ! isset( $content_width ) ) $content_width = 1170;
	
	
	/* LOAD THEME LANGUAGE
	================================================== */
	
	load_theme_textdomain('swiftframework', SF_TEMPLATE_PATH.'/language');
	
	$locale = get_locale();
	$locale_file = SF_TEMPLATE_PATH."/language/$locale.php";
	
	if (is_readable($locale_file)) {
		require_once($locale_file);
	}
	
	
	/* LOAD STYLES & SCRIPTS
	================================================== */
		
	function sf_enqueue_styles() {  
		
		$options = get_option('sf_neighborhood_options');
		$enable_responsive = $options['enable_responsive'];		
	
	    wp_enqueue_style('bootstrap', SF_LOCAL_PATH . '/css/bootstrap.min.css', array(), NULL, 'all');  
	    wp_enqueue_style('bootstrap-responsive', SF_LOCAL_PATH . '/css/bootstrap-responsive.min.css', array(), NULL, 'all');  
	    wp_enqueue_style('fontawesome', SF_LOCAL_PATH . '/css/font-awesome.min.css', array(), '4.6.3', 'all');  
	    wp_enqueue_style('main-css', get_stylesheet_directory_uri() . '/style.css', array(), NULL, 'all');  
	    wp_register_style('responsive-css', SF_LOCAL_PATH . '/css/responsive.css', array(), NULL, 'screen');  
		//wp_register_style('sf-rtl', SF_LOCAL_PATH . '/rtl.css', array(), NULL, 'all');
	
	    if ($enable_responsive) {
	    	wp_enqueue_style('responsive-css');  
	    }
		//wp_enqueue_style('sf-rtl');
	}
	
	add_action('wp_enqueue_scripts', 'sf_enqueue_styles', 99);  
	
	function sf_enqueue_scripts() {
	    
	    $options = get_option('sf_neighborhood_options');
	    $enable_product_zoom = $options['enable_product_zoom'];
	    $enable_min_scripts = false;
	    if (isset($options['enable_min_scripts'])) {	
	    $enable_min_scripts = $options['enable_min_scripts'];
	    }
	    $gmaps_api_key = "";
	    if (isset($options['gmaps_api_key'])) {
	    	$gmaps_api_key = $options['gmaps_api_key'];
	    }
	    
	    wp_register_script('sf-bootstrap-js', SF_LOCAL_PATH . '/js/combine/bootstrap.min.js', 'jquery', NULL, TRUE);
	    wp_register_script('sf-transit', SF_LOCAL_PATH . '/js/combine/jquery.transit.min.js', 'jquery', NULL, TRUE);
	    wp_register_script('sf-flexslider', SF_LOCAL_PATH . '/js/combine/jquery.flexslider-min.js', 'jquery', NULL, TRUE);
	    wp_register_script('sf-lightslider', SF_LOCAL_PATH . '/js/combine/lightslider.min.js', 'jquery', NULL, TRUE);
	   	wp_register_script('sf-imagesLoaded', SF_LOCAL_PATH . '/js/combine/imagesloaded.js', 'jquery', NULL, TRUE);
	    wp_register_script('sf-isotope', SF_LOCAL_PATH . '/js/combine/jquery.isotope.min.js', 'jquery', NULL, TRUE);
	    wp_register_script('sf-hoverIntent', SF_LOCAL_PATH . '/js/combine/jquery.hoverIntent.min.js', 'jquery', NULL, TRUE);
	    wp_register_script('sf-easing', SF_LOCAL_PATH . '/js/combine/jquery.easing.js', 'jquery', NULL, TRUE);
	 	wp_register_script('sf-owlcarousel', SF_LOCAL_PATH . '/js/combine/owl.carousel.min.js', 'jquery', NULL, TRUE);
	    wp_register_script('sf-jquery-ui', SF_LOCAL_PATH . '/js/combine/jquery-ui-1.10.2.custom.min.js', 'jquery', NULL, TRUE);
		wp_register_script('sf-stellar', SF_LOCAL_PATH . '/js/combine/jquery.stellar.min.js', 'jquery', NULL, TRUE);
		wp_register_script('sf-ilightbox', SF_LOCAL_PATH . '/js/combine/ilightbox.min.js', 'jquery', NULL, TRUE);
	    wp_register_script('sf-fitvids', SF_LOCAL_PATH . '/js/combine/jquery.fitvids.js', 'jquery', NULL , TRUE);
		wp_register_script('sf-zoom', SF_LOCAL_PATH . '/js/combine/jquery.zoom.min.js', 'jquery', NULL, TRUE);
		wp_register_script('sf-theme-scripts-min', SF_LOCAL_PATH . '/js/sf-scripts.min.js', 'jquery', NULL, TRUE);

	    wp_register_script('google-maps', '//maps.google.com/maps/api/js?key=' . $gmaps_api_key, 'jquery', NULL, TRUE);
	    
	    wp_register_script('sf-functions', SF_LOCAL_PATH . '/js/functions.js', 'jquery', NULL, TRUE);
		wp_register_script('sf-functions-min', SF_LOCAL_PATH . '/js/functions.min.js', 'jquery', NULL, TRUE);
		
		
		// ENQUEUE		
		if ($enable_min_scripts) {
			
			wp_enqueue_script('sf-theme-scripts-min');   
			wp_enqueue_script('google-maps');
			
			if (!is_admin()) {
				wp_enqueue_script('sf-functions-min');
			}
		
		} else {
		    
			wp_enqueue_script('sf-bootstrap-js');
			wp_enqueue_script('sf-transit');
			wp_enqueue_script('sf-hoverIntent');
			wp_enqueue_script('sf-easing');
		    wp_enqueue_script('sf-flexslider');
		    wp_enqueue_script('sf-lightslider');
		    wp_enqueue_script('sf-stellar');
		    wp_enqueue_script('sf-ilightbox');
		    wp_enqueue_script('sf-fitvids');
		    
		    if ( sf_woocommerce_activated() ) {
		    	if (is_product() && $enable_product_zoom) {
		    		wp_enqueue_script('sf-elevatezoom');
		    		wp_enqueue_script('sf-zoom');
		    	}
		    }
		    
		   	wp_enqueue_script('sf-imagesLoaded');
		   	wp_enqueue_script('sf-isotope');
	    	wp_enqueue_script('sf-owlcarousel');
		    	    
		   	wp_enqueue_script('google-maps');
		   
		    if (!is_admin()) {
		    	wp_enqueue_script('sf-functions');
		    }
		    
	    }
	    
	    if (is_singular()) {
	    	wp_enqueue_script('comment-reply');
	    }
	}
	add_action('wp_enqueue_scripts', 'sf_enqueue_scripts');
	
	function sf_admin_scripts() {
	    wp_register_script('admin-functions', get_template_directory_uri() . '/js/sf-admin.js', 'jquery', '1.0', TRUE);
		wp_enqueue_script('admin-functions');
	}
	add_action('admin_init', 'sf_admin_scripts');
	
	
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
	    
	    
	/* MAINTENANCE MODE
	================================================== */
	if ( ! function_exists( 'sf_maintenance_mode' ) ) {
	    function sf_maintenance_mode() {
	        $options = get_option('sf_neighborhood_options');
	        $custom_logo        = array();
	        $custom_logo_output = $maintenance_mode = "";
	        if ( isset( $options['custom_admin_login_logo'] ) ) {
	            $custom_logo = $options['custom_admin_login_logo'];
	        }
	        if ( isset( $custom_logo['url'] ) ) {
	            $custom_logo_output = '<img src="' . $custom_logo['url'] . '" alt="maintenance" style="margin: 0 auto; display: block;" />';
	        } else {
	            $custom_logo_output = '<img src="' . get_template_directory_uri() . '/images/custom-login-logo.png" alt="maintenance" style="margin: 0 auto; display: block;" />';
	        }
	
	        if ( isset( $options['enable_maintenance'] ) ) {
	            $maintenance_mode = $options['enable_maintenance'];
	        } else {
	            $maintenance_mode = false;
	        }
	        
	        if ( $maintenance_mode == 2 ) {
	
	            $holding_page     = __( $options['maintenance_mode_page'], 'swiftframework' );
	            $current_page_URL = sf_current_page_url();
	            $holding_page_URL = get_permalink( $holding_page );
	
	            if ( $current_page_URL != $holding_page_URL ) {
	                if ( ! current_user_can( 'edit_themes' ) || ! is_user_logged_in() ) {
	                    wp_redirect( $holding_page_URL );
	                    exit;
	                }
	            }
	
	        } else if ( $maintenance_mode == 1 ) {
	            if ( ! current_user_can( 'edit_themes' ) || ! is_user_logged_in() ) {
	                wp_die( $custom_logo_output . '<p style="text-align:center">' . __( 'We are currently in maintenance mode, please check back shortly.', 'swiftframework' ) . '</p>', get_bloginfo( 'name' ) );
	            }
	        }
	    }
	    add_action( 'get_header', 'sf_maintenance_mode' );
	}
	
	
	/* GET CURRENT PAGE URL
	================================================== */
	function sf_current_page_url() {
		$pageURL = 'http';
		if( isset($_SERVER["HTTPS"]) ) {
			if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
	
	
	/* BETTER WORDPRESS MINIFY FILTER
	================================================== */
	
	add_filter('bwp_minify_style_ignore', 'sf_bwm_exclude_css');
	
	function sf_bwm_exclude_css($excluded)
	{
		$excluded = array('fontawesome-css');
		return $excluded;
	}
	
	
	/* REVSLIDER RETURN FUNCTION
	================================================== */
	
	function return_slider($revslider_shortcode) {
	    ob_start();
	    putRevSlider($revslider_shortcode);
	    return ob_get_clean();
	}
	
	/* CUSTOM ADMIN MENU ITEMS
	================================================== */
	
	if(!function_exists('sf_admin_bar_menu')) {
				
		function sf_admin_bar_menu() {
		
			global $wp_admin_bar;
			
			if ( current_user_can( 'manage_options' ) ) {
			
				$theme_options = array(
					'id' => '1',
					'title' => __('Theme Options', 'swiftframework'),
					'href' => admin_url('/admin.php?page=sf_theme_options'),
					'meta' => array('target' => 'blank')
				);
				
				$wp_admin_bar->add_menu($theme_options);
				
				$theme_customizer = array(
					'id' => '2',
					'title' => __('Color Customizer', 'swiftframework'),
					'href' => admin_url('/customize.php'),
					'meta' => array('target' => 'blank')
				);
				
				$wp_admin_bar->add_menu($theme_customizer);
			
			}
			
		}
		
		add_action('admin_bar_menu', 'sf_admin_bar_menu', 99);
	}
	

	/* ADMIN CUSTOM POST TYPE ICONS
	================================================== */
	
	add_action( 'admin_head', 'sf_admin_css' );
	function sf_admin_css() {
	    ?>
	    
	    <?php
	 		// Alt Background
	 		$options = get_option('sf_neighborhood_options');
	 		$section_divide_color = get_option('section_divide_color', '#e4e4e4');
	 		$alt_one_bg_color = $options['alt_one_bg_color'];
	 		$alt_one_text_color = $options['alt_one_text_color'];
	 		if (isset($options['alt_one_bg_image'])) {
	 		$alt_one_bg_image = $options['alt_one_bg_image'];
	 		}
	 		$alt_one_bg_image_size = $options['alt_one_bg_image_size'];
	 		$alt_two_bg_color = $options['alt_two_bg_color'];
	 		$alt_two_text_color = $options['alt_two_text_color'];
	 		if (isset($options['alt_two_bg_image'])) {
	 		$alt_two_bg_image = $options['alt_two_bg_image'];
	 		}
	 		$alt_two_bg_image_size = $options['alt_two_bg_image_size'];
	 		$alt_three_bg_color = $options['alt_three_bg_color'];
	 		$alt_three_text_color = $options['alt_three_text_color'];
	 		if (isset($options['alt_three_bg_image'])) {
	 		$alt_three_bg_image = $options['alt_three_bg_image'];
	 		}
	 		$alt_three_bg_image_size = $options['alt_three_bg_image_size'];
	 		$alt_four_bg_color = $options['alt_four_bg_color'];
	 		$alt_four_text_color = $options['alt_four_text_color'];
	 		if (isset($options['alt_four_bg_image'])) {
	 		$alt_four_bg_image = $options['alt_four_bg_image'];
	 		}
	 		$alt_four_bg_image_size = $options['alt_four_bg_image_size'];
	 		$alt_five_bg_color = $options['alt_five_bg_color'];
	 		$alt_five_text_color = $options['alt_five_text_color'];
	 		if (isset($options['alt_five_bg_image'])) {
	 		$alt_five_bg_image = $options['alt_five_bg_image'];
	 		}
	 		$alt_five_bg_image_size = $options['alt_five_bg_image_size'];
	 		$alt_six_bg_color = $options['alt_six_bg_color'];
	 		$alt_six_text_color = $options['alt_six_text_color'];
	 		if (isset($options['alt_six_bg_image'])) {
	 		$alt_six_bg_image = $options['alt_six_bg_image'];
	 		}
	 		$alt_six_bg_image_size = $options['alt_six_bg_image_size'];
	 		$alt_seven_bg_color = $options['alt_seven_bg_color'];
	 		$alt_seven_text_color = $options['alt_seven_text_color'];
	 		if (isset($options['alt_seven_bg_image'])) {
	 		$alt_seven_bg_image = $options['alt_seven_bg_image'];
	 		}
	 		$alt_seven_bg_image_size = $options['alt_seven_bg_image_size'];
	 		$alt_eight_bg_color = $options['alt_eight_bg_color'];
	 		$alt_eight_text_color = $options['alt_eight_text_color'];
	 		if (isset($options['alt_eight_bg_image'])) {
	 		$alt_eight_bg_image = $options['alt_eight_bg_image'];
	 		}
	 		$alt_eight_bg_image_size = $options['alt_eight_bg_image_size'];
	 		$alt_nine_bg_color = $options['alt_nine_bg_color'];
	 		$alt_nine_text_color = $options['alt_nine_text_color'];
	 		if (isset($options['alt_nine_bg_image'])) {
	 		$alt_nine_bg_image = $options['alt_nine_bg_image'];
	 		}
	 		$alt_nine_bg_image_size = $options['alt_nine_bg_image_size'];
	 		$alt_ten_bg_color = $options['alt_ten_bg_color'];
	 		$alt_ten_text_color = $options['alt_ten_text_color'];
	 		if (isset($options['alt_ten_bg_image'])) {
	 		$alt_ten_bg_image = $options['alt_ten_bg_image'];
	 		}
	 		$alt_ten_bg_image_size = $options['alt_ten_bg_image_size'];  	
	    ?>
	    	    
	    <style type="text/css" media="screen">
	    	
	        #menu-posts-slide .wp-menu-image img {
	        	width: 16px;
	        }
	        #toplevel_page_sf_theme_options .wp-menu-image img {
	        	width: 11px;
	        	margin-top: -2px;
	        	margin-left: 3px;
	        }
	        .toplevel_page_sf_theme_options #adminmenu li#toplevel_page_sf_theme_options.wp-has-current-submenu a.wp-has-current-submenu, .toplevel_page_sf_theme_options #adminmenu #toplevel_page_sf_theme_options .wp-menu-arrow div, .toplevel_page_sf_theme_options #adminmenu #toplevel_page_sf_theme_options .wp-menu-arrow {
	        	background: #222;
	        	border-color: #222;
	        }
	        #wpbody-content {
	        	min-height: 815px;
	        }
	        /* META BOX CUSTOM */
            .rwmb-field {
            	margin: 10px 0;
            }
            .rwmb-field > h3 {
            	margin: 10px 0;
            	border-bottom: 1px solid #e4e4e4;
            	padding-bottom: 10px !important;
            }
            .rwmb-label label {
            	padding-right: 10px;
            	vertical-align: top;
            }
            .rwmb-checkbox-wrapper .description {
            	display: block;
            	margin: 6px 0 8px;
            }
            .rwmb-input .rwmb-slider {
                background: #f7f7f7;
                border: 1px solid #e3e3e3;
            }
            .meta-box-sortables select, .rwmb-input > input, .rwmb-media-view .rwmb-add-media {
            	margin-bottom: 5px;
            }
            .meta-altbg-preview {
            	max-width: 200px;
                padding: 10px;
                text-align: center;
                margin-left: 25%;
            }
            .rwmb-input .rwmb-slider {
                background: #f7f7f7;
                border: 1px solid #e3e3e3;
            }

            .rwmb-slider.ui-slider-horizontal .ui-slider-range-min {
                background: #fe504f!important;
            }

            .rwmb-slider-value-label {
                vertical-align: 0;
            }

            .rwmb-images img {
                max-width: 150px;
                max-height: 150px;
                width: auto;
                height: auto;
            }

            h2.meta-box-section {
                border-bottom: 1px solid #e4e4e4;
                padding-bottom: 10px !important;
                margin-top: 20px !important;
                font-size: 18px !important;
                color: #444;
            }

            .rwmb-meta-box div:first-child h2.meta-box-section {
                margin-top: 0 !important;
            }

            /* META BOX TABS */
            .sf-meta-tabs-wrap {
                height: auto;
                overflow: hidden;
            }

            .rwmb-meta-box {
                padding: 20px 10px;
            }

            .sf-meta-tabs-wrap.all-hidden {
                display: none;
            }

            #sf-tabbed-meta-boxes {
                position: relative;
                z-index: 1;
                float: right;
                width: 80%;
                border-left: 1px solid #e3e3e3;
            }

            #sf-tabbed-meta-boxes > div > .hndle, #sf-tabbed-meta-boxes > div > .handlediv {
                display: none !important;
            }

            #sf-tabbed-meta-boxes .inside {
                display: block !important;
            }

            #sf-tabbed-meta-boxes > div {
                border-left: 0;
                border-right: 0;
                border-bottom: 0;
                margin-bottom: 0;
                padding-bottom: 20px;
            }

            /*#sf-tabbed-meta-boxes > div.hide-if-js {
                   display: none!important;
            }*/
            #sf-meta-box-tabs {
                margin: 0;
                width: 20%;
                position: relative;
                z-index: 2;
                float: left;
                margin-right: -1px;
            }

            #sf-meta-box-tabs li {
                margin-bottom: -1px;
            }

            #sf-meta-box-tabs li.user-hidden {
                display: none !important;
            }

            #sf-meta-box-tabs li > a {
                display: block;
                background: #f7f7f7;
                padding: 12px;
                line-height: 150%;
                border: 1px solid #e5e5e5;
                -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .04);
                box-shadow: 0 1px 1px rgba(0, 0, 0, .04);
                text-decoration: none;
            }

            #sf-meta-box-tabs li > a:hover {
                color: #222;
                background: #fff;
            }

            #sf-meta-box-tabs li > a.active {
                border-right-color: #fff;
                background: #fff;
                box-shadow: none;
            }

            .closed #sf-meta-box-tabs, .closed #sf-tabbed-meta-boxes {
                display: none;
            }
            
            #sf-tabbed-meta-boxes .inside .rwmb-meta-box .rwmb-field:first-of-type > h3 {
            		margin-top: -10px;
            }
            
			<?php
				echo "\n".'/*========== Asset Background Styles ==========*/'."\n";
				echo '.alt-one {background-color: '.$alt_one_bg_color.';}'. "\n";
				if (isset($options['alt_one_bg_image']) && $alt_one_bg_image != "") {
					if ($alt_one_bg_image_size == "cover") {
						echo '.alt-one {background-image: url('.$alt_one_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-one {background-image: url('.$alt_one_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-one {color: '.$alt_one_text_color.';}'. "\n";
				echo '.alt-one.full-width-text:after {border-top-color:'.$alt_one_bg_color.';}'. "\n";
				echo '.alt-two {background-color: '.$alt_two_bg_color.';}'. "\n";
				if (isset($options['alt_two_bg_image']) && $alt_two_bg_image != "") {
					if ($alt_two_bg_image_size == "cover") {
						echo '.alt-two {background-image: url('.$alt_two_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-two {background-image: url('.$alt_two_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-two {color: '.$alt_two_text_color.';}'. "\n";
				echo '.alt-two.full-width-text:after {border-top-color:'.$alt_two_bg_color.';}'. "\n";	
				echo '.alt-three {background-color: '.$alt_three_bg_color.';}'. "\n";
				if (isset($options['alt_three_bg_image']) && $alt_three_bg_image != "") {
					if ($alt_three_bg_image_size == "cover") {
						echo '.alt-three {background-image: url('.$alt_three_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-three {background-image: url('.$alt_three_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-three {color: '.$alt_three_text_color.';}'. "\n";
				echo '.alt-three.full-width-text:after {border-top-color:'.$alt_three_bg_color.';}'. "\n";	
				echo '.alt-four {background-color: '.$alt_four_bg_color.';}'. "\n";
				if (isset($options['alt_four_bg_image']) && $alt_four_bg_image != "") {
					if ($alt_four_bg_image_size == "cover") {
						echo '.alt-four {background-image: url('.$alt_four_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-four {background-image: url('.$alt_four_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-four {color: '.$alt_four_text_color.';}'. "\n";
				echo '.alt-four.full-width-text:after {border-top-color:'.$alt_four_bg_color.';}'. "\n";	
				echo '.alt-five {background-color: '.$alt_five_bg_color.';}'. "\n";
				if (isset($options['alt_five_bg_image']) && $alt_five_bg_image != "") {
					if ($alt_five_bg_image_size == "cover") {
						echo '.alt-five {background-image: url('.$alt_five_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-five {background-image: url('.$alt_five_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-five {color: '.$alt_five_text_color.';}'. "\n";
				echo '.alt-five.full-width-text:after {border-top-color:'.$alt_five_bg_color.';}'. "\n";			
				echo '.alt-six {background-color: '.$alt_six_bg_color.';}'. "\n";
				if (isset($options['alt_six_bg_image']) && $alt_six_bg_image != "") {
					if ($alt_six_bg_image_size == "cover") {
						echo '.alt-six {background-image: url('.$alt_six_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-six {background-image: url('.$alt_six_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-six {color: '.$alt_six_text_color.';}'. "\n";
				echo '.alt-six.full-width-text:after {border-top-color:'.$alt_six_bg_color.';}'. "\n";
				echo '.alt-seven {background-color: '.$alt_seven_bg_color.';}'. "\n";
				if (isset($options['alt_seven_bg_image']) && $alt_seven_bg_image != "") {
					if ($alt_seven_bg_image_size == "cover") {
						echo '.alt-seven {background-image: url('.$alt_seven_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-seven {background-image: url('.$alt_seven_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-seven {color: '.$alt_seven_text_color.';}'. "\n";
				echo '.alt-seven.full-width-text:after {border-top-color:'.$alt_seven_bg_color.';}'. "\n";
				echo '.alt-eight {background-color: '.$alt_eight_bg_color.';}'. "\n";
				if (isset($options['alt_eight_bg_image']) && $alt_eight_bg_image != "") {
					if ($alt_eight_bg_image_size == "cover") {
						echo '.alt-eight {background-image: url('.$alt_eight_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-eight {background-image: url('.$alt_eight_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-eight {color: '.$alt_eight_text_color.';}'. "\n";
				echo '.alt-eight.full-width-text:after {border-top-color:'.$alt_eight_bg_color.';}'. "\n";
				echo '.alt-nine {background-color: '.$alt_nine_bg_color.';}'. "\n";
				if (isset($options['alt_nine_bg_image']) && $alt_nine_bg_image != "") {
					if ($alt_nine_bg_image_size == "cover") {
						echo '.alt-nine {background-image: url('.$alt_nine_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-nine {background-image: url('.$alt_nine_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-nine {color: '.$alt_nine_text_color.';}'. "\n";
				echo '.alt-nine.full-width-text:after {border-top-color:'.$alt_nine_bg_color.';}'. "\n";
				
				
				echo '.alt-ten {background-color: '.$alt_ten_bg_color.';}'. "\n";
				if (isset($options['alt_ten_bg_image']) && $alt_ten_bg_image != "") {
					if ($alt_ten_bg_image_size == "cover") {
						echo '.alt-ten {background-image: url('.$alt_ten_bg_image.'); background-repeat: no-repeat; background-position: center center; background-size:cover;}'. "\n";
					} else {
						echo '.alt-ten {background-image: url('.$alt_ten_bg_image.'); background-repeat: repeat; background-position: center center; background-size:auto;}'. "\n";
					}	
				}
				echo '.alt-ten {color: '.$alt_nine_text_color.';}'. "\n";
				echo '.alt-ten.full-width-text:after {border-top-color:'.$alt_ten_bg_color.';}'. "\n";
			?>
		</style>
	
	<?php }
	

	/* PLUGIN OPTION PARAMS
    ================================================== */
    if ( ! function_exists( 'sf_option_parameters' ) ) {
        function sf_option_parameters() {
           	$options = get_option('sf_neighborhood_options');
           	$lightbox_nav = "default";
           	$lightbox_thumbs = "true";
           	$lightbox_skin = "light";
           	$lightbox_sharing = "true";
           	
           	if (isset($options['lightbox_nav'])) {
            	$lightbox_nav             = $options['lightbox_nav'];
            }
            if (isset($options['lightbox_thumbs'])) {
            	$lightbox_thumbs          = $options['lightbox_thumbs'];
            }
            if (isset($options['lightbox_skin'])) {
            	$lightbox_skin            = $options['lightbox_skin'];
           	}
           	if (isset($options['lightbox_sharing'])) {
            	$lightbox_sharing         = $options['lightbox_sharing'];
            }
            ?>
            <div id="sf-option-params"
                 data-lightbox-nav="<?php echo $lightbox_nav; ?>"
                 data-lightbox-thumbs="<?php echo $lightbox_thumbs; ?>"
                 data-lightbox-skin="<?php echo $lightbox_skin; ?>"
                 data-lightbox-sharing="<?php echo $lightbox_sharing; ?>"></div>

        <?php
        }

        add_action( 'wp_footer', 'sf_option_parameters' );
    }
	
	
	/* BETTER SEO PAGE TITLE
	================================================== */
	
	add_filter( 'wp_title', 'filter_wp_title' );
	/**
	 * Filters the page title appropriately depending on the current page
	 *
	 * This function is attached to the 'wp_title' fiilter hook.
	 *
	 * @uses	get_bloginfo()
	 * @uses	is_home()
	 * @uses	is_front_page()
	 */
	function filter_wp_title( $title ) {
		global $page, $paged;
	
		if ( is_feed() )
			return $title;
	
		$site_description = get_bloginfo( 'description' );
	
		$filtered_title = $title . get_bloginfo( 'name' );
		$filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? ' | ' . $site_description: '';
		$filtered_title .= ( 2 <= $paged || 2 <= $page ) ? ' | ' . sprintf( __( 'Page %s' ), max( $paged, $page ) ) : '';
	
		return $filtered_title;
	}
	
	
	/* SET SIDEBAR GLOBAL
	================================================== */
		
	function sf_set_sidebar_global($sidebar_config) {
		
		global $sidebars, $sf_sidebar_config;
		
		if (($sidebar_config == "left-sidebar") || ($sidebar_config == "right-sidebar")) {
		$sidebars = 'one-sidebar';
		$sf_sidebar_config = 'one-sidebar';
		} else if ($sidebar_config == "both-sidebars") {
		$sidebars = 'both-sidebars';
		$sf_sidebar_config = 'both-sidebars';
		} else {
		$sidebars = 'no-sidebars';
		$sf_sidebar_config = 'no-sidebars';
		}
	}
	
	
	/* WORDPRESS GALLERY MODS
	================================================== */
	
	add_filter( 'wp_get_attachment_link', 'sant_lightboxadd');
	 
	function sant_lightboxadd($content) {
	    $content = preg_replace("/<a/","<a class=\"lightbox\" data-rel='ilightbox[gallery]'",$content,1);
	    return $content;
	}
	
	add_filter( 'gallery_style', 'custom_gallery_styling', 99 );
	
	function custom_gallery_styling() {
	    return "<div class='gallery'>";
	}
	
	
	/* WORDPRESS TAG CLOUD WIDGET MODS
	================================================== */
	
	add_filter( 'widget_tag_cloud_args', 'sf_tag_cloud_args' );
	
	function sf_tag_cloud_args( $args ) {
		$args['largest'] = 12;
		$args['smallest'] = 12;
		$args['unit'] = 'px';
		$args['format'] = 'list';
		return $args;
	}
	
	
	/* WORDPRESS CATEGORY WIDGET MODS
	================================================== */
	
	add_filter('wp_list_categories', 'sf_category_widget_mod');
	
	function sf_category_widget_mod($output) {
		$output = str_replace('</a> (',' <span>(',$output);
		$output = str_replace(')',')</span></a> ',$output);
		return $output;
	}
	
	
	/* WORDPRESS ARCHIVES WIDGET MODS
	================================================== */
	
	add_filter('wp_get_archives', 'sf_archives_widget_mod');
	
	function sf_archives_widget_mod($output) {
		$output = str_replace('</a> (',' <span>(',$output);
		$output = str_replace(')',')</span></a> ',$output);
		return $output;
	}

	
	/* GET WOOCOMMERCE FILTERS
	================================================== */
	
	function get_woo_product_filters_array() {
		
		global $woocommerce;
		
		$attribute_array = array();
		
		$transient_name = 'wc_attribute_taxonomies';
		
		if ( false === ( $attribute_taxonomies = get_transient( $transient_name ) ) ) {

			global $wpdb;

			$attribute_taxonomies = $wpdb->get_results( "SELECT * FROM " . $wpdb->prefix . "woocommerce_attribute_taxonomies" );

			set_transient( $transient_name, $attribute_taxonomies );
		}

		$attribute_taxonomies = apply_filters( 'woocommerce_attribute_taxonomies', $attribute_taxonomies );
		
		$attribute_array['product_cat'] = __('Product Category', 'swiftframework');
		$attribute_array['price'] = __('Price', 'swiftframework');
				
		if ( $attribute_taxonomies ) {
			foreach ( $attribute_taxonomies as $tax ) {
				$attribute_array[$tax->attribute_name] = $tax->attribute_name;
			}
		}
		
		return $attribute_array;	
	}
		
	
	
	/* TWEET FUNCTIONS
	================================================== */
	
	function sf_get_tweets($twitterID, $count) {
	
		$content = "";
				
		if (function_exists('getTweets')) {
						
			$tweets = getTweets($twitterID, $count);
					
			if(is_array($tweets)){
						
				foreach($tweets as $tweet){
										
					$content .= '<li>';
				
				    if(is_array($tweet) && isset($tweet['text']) && $tweet['text']){
				    	
				    	$content .= '<div class="tweet-text">';
				    	
				        $the_tweet = $tweet['text'];
				        /*
				        Twitter Developer Display Requirements
				        https://dev.twitter.com/terms/display-requirements
				
				        2.b. Tweet Entities within the Tweet text must be properly linked to their appropriate home on Twitter. For example:
				          i. User_mentions must link to the mentioned user's profile.
				         ii. Hashtags must link to a twitter.com search with the hashtag as the query.
				        iii. Links in Tweet text must be displayed using the display_url
				             field in the URL entities API response, and link to the original t.co url field.
				        */
				
				        // i. User_mentions must link to the mentioned user's profile.
				        if(isset($tweet['entities']['user_mentions']) && is_array($tweet['entities']['user_mentions'])){
				            foreach($tweet['entities']['user_mentions'] as $key => $user_mention){
				                $the_tweet = preg_replace(
				                    '/@'.$user_mention['screen_name'].'/i',
				                    '<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>',
				                    $the_tweet);
				            }
				        }
				
				        // ii. Hashtags must link to a twitter.com search with the hashtag as the query.
				        if(isset($tweet['entities']['hashtags']) && is_array($tweet['entities']['hashtags'])){
				            foreach($tweet['entities']['hashtags'] as $key => $hashtag){
				                $the_tweet = preg_replace(
				                    '/#'.$hashtag['text'].'/i',
				                    '<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&amp;src=hash" target="_blank">#'.$hashtag['text'].'</a>',
				                    $the_tweet);
				            }
				        }
				
				        // iii. Links in Tweet text must be displayed using the display_url
				        //      field in the URL entities API response, and link to the original t.co url field.
				        if(isset($tweet['entities']['urls']) && is_array($tweet['entities']['urls'])){
				            foreach($tweet['entities']['urls'] as $key => $link){
				                $the_tweet = preg_replace(
				                    '`'.$link['url'].'`',
				                    '<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>',
				                    $the_tweet);
				            }
				        }
				        
				        // Custom code to link to media
				        if(isset($tweet['entities']['media']) && is_array($tweet['entities']['media'])){
				            foreach($tweet['entities']['media'] as $key => $media){
				                $the_tweet = preg_replace(
				                    '`'.$media['url'].'`',
				                    '<a href="'.$media['url'].'" target="_blank">'.$media['url'].'</a>',
				                    $the_tweet);
				            }
				        }
				
				        $content .= $the_tweet;
						
						$content .= '</div>';
				
				        // 3. Tweet Actions
				        //    Reply, Retweet, and Favorite action icons must always be visible for the user to interact with the Tweet. These actions must be implemented using Web Intents or with the authenticated Twitter API.
				        //    No other social or 3rd party actions similar to Follow, Reply, Retweet and Favorite may be attached to a Tweet.
				        // 4. Tweet Timestamp
				        //    The Tweet timestamp must always be visible and include the time and date. e.g., “3:00 PM - 31 May 12”.
				        // 5. Tweet Permalink
				        //    The Tweet timestamp must always be linked to the Tweet permalink.
				        
				       	$content .= '<div class="twitter_intents">'. "\n";
				        $content .= '<a class="reply" href="https://twitter.com/intent/tweet?in_reply_to='.$tweet['id_str'].'"><i class="fa-reply"></i></a>'. "\n";
				        $content .= '<a class="retweet" href="https://twitter.com/intent/retweet?tweet_id='.$tweet['id_str'].'"><i class="fa-retweet"></i></a>'. "\n";
				        $content .= '<a class="favorite" href="https://twitter.com/intent/favorite?tweet_id='.$tweet['id_str'].'"><i class="fa-star"></i></a>'. "\n";
				        
				        $date = strtotime($tweet['created_at']); // retrives the tweets date and time in Unix Epoch terms
				        $blogtime = current_time('U'); // retrives the current browser client date and time in Unix Epoch terms
				        $dago = human_time_diff($date, $blogtime) . ' ' . sprintf(__('ago', 'swiftframework')); // calculates and outputs the time past in human readable format
						$content .= '<a class="timestamp" href="https://twitter.com/'.$twitterID.'/status/'.$tweet['id_str'].'" target="_blank">'.$dago.'</a>'. "\n";
						$content .= '</div>'. "\n";
				    } else {
				        $content .= '<a href="http://twitter.com/'.$twitterID.'" target="_blank">@'.$twitterID.'</a>';
				    }
				    $content .= '</li>';
				}
			}
			return $content;
		} else {
			return '<li><div class="tweet-text">Please install the oAuth Twitter Feed Plugin and follow the theme documentation to set it up.</div></li>';
		}	

	}
	
	function sf_hyperlinks($text) {
		    $text = preg_replace('/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
		    $text = preg_replace('/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);
		    // match name@address
		    $text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text);
		        //mach #trendingtopics. Props to Michael Voigt
		    $text = preg_replace('/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)#{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/#search?q=$2\" class=\"twitter-link\">#$2</a>$3 ", $text);
		    return $text;
		}
		
	function sf_twitter_users($text) {
	       $text = preg_replace('/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)@{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/$2\" class=\"twitter-user\">@$2</a>$3 ", $text);
	       return $text;
	}

    function sf_encode_tweet($text) {
            $text = mb_convert_encoding( $text, "HTML-ENTITIES", "UTF-8");
            return $text;
    }
	
	
	/* VIDEO EMBED FUNCTIONS
	================================================== */
	
	function video_embed($url, $width = 640, $height = 480) {
		if (strpos($url,'youtube')){
			return video_youtube($url, $width, $height);
		} else {
			return video_vimeo($url, $width, $height);
		}
	}
	
	function video_youtube($url, $width = 640, $height = 480){
	
		preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $video_id);
		
		return '<iframe itemprop="video" src="http://www.youtube.com/embed/'. $video_id[1] .'?wmode=transparent" width="'. $width .'" height="'. $height .'" allowfullscreen></iframe>';
				
	}
	
	function video_vimeo($url, $width = 640, $height = 480){
	
		preg_match('/http:\/\/vimeo.com\/(\d+)$/', $url, $video_id);		
		
		return '<iframe itemprop="video" src="http://player.vimeo.com/video/'. $video_id[1] .'?title=0&amp;byline=0&amp;portrait=0" width="'. $width .'" height="'. $height .'" allowfullscreen></iframe>';
		
	}
	
		
	/* MAP EMBED FUNCTIONS
	================================================== */

	function map_embed($address) {
	    if (!is_string($address))die("All Addresses must be passed as a string");
	    
	    $address = str_replace(" ", "+", $address); // replcae all the white space with "+" sign to match with google search pattern
	     
	    $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=$address";
	     
	    $response = @file_get_contents($url);	    

	    if ($response === FALSE) {
	    	return "error";
	    }
	    
	    $json = json_decode($response,TRUE); //generate array object from the response from the web   

		if ($json['status'] === "OVER_QUERY_LIMIT") {
			return "over_limit";
		}
		
		if ($json['status'] === "ZERO_RESULTS") {
			return "unknown_address";
		}
		
	    $_coords['lat'] = $json['results'][0]['geometry']['location']['lat'];
	    $_coords['long'] = $json['results'][0]['geometry']['location']['lng'];
	    
	    return $_coords;
	}
	
		
	/* FEATURED IMAGE TITLE
	================================================== */
	
	function sf_featured_img_title() {
	  global $post;
	  $sf_thumbnail_id = get_post_thumbnail_id($post->ID);
	  $sf_thumbnail_image = get_posts(array('p' => $sf_thumbnail_id, 'post_type' => 'attachment', 'post_status' => 'any'));
	  if ($sf_thumbnail_image && isset($sf_thumbnail_image[0])) {
	    return $sf_thumbnail_image[0]->post_title;
	  }
	}
	
	
	/* GET ATTACHMENT ID FROM URL
	================================================== */
	
	function sf_get_attachment_id_from_url( $attachment_url = '' ) {
	 
		global $wpdb;
		$attachment_id = false;
	 
		// If there is no url, return.
		if ( '' == $attachment_url )
			return;
	 
		// Get the upload directory paths
		$upload_dir_paths = wp_upload_dir();
	 
		// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
		if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
	 
			// If this is the URL of an auto-generated thumbnail, get the URL of the original image
			$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
	 
			// Remove the upload path base directory from the attachment URL
			$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
	 
			// Finally, run a custom database query to get the attachment ID from the modified attachment URL
			$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
	 
		}
	 
		return $attachment_id;
	}
	
	
	/* ICON LIST
	================================================== */ 
	if ( ! function_exists( 'sf_get_icons_list' ) ) {
		function sf_get_icons_list($type = "") {
			
			// VARIABLES
			$icon_list = $fa_list = "";
			
			// FONT AWESOME
			$fa_list = '<li><i class="fa-500px"></i><span class="icon-name">fa-500px</span></li><li><i class="fa-adjust"></i><span class="icon-name">fa-adjust</span></li><li><i class="fa-adn"></i><span class="icon-name">fa-adn</span></li><li><i class="fa-align-center"></i><span class="icon-name">fa-align-center</span></li><li><i class="fa-align-justify"></i><span class="icon-name">fa-align-justify</span></li><li><i class="fa-align-left"></i><span class="icon-name">fa-align-left</span></li><li><i class="fa-align-right"></i><span class="icon-name">fa-align-right</span></li><li><i class="fa-amazon"></i><span class="icon-name">fa-amazon</span></li><li><i class="fa-ambulance"></i><span class="icon-name">fa-ambulance</span></li><li><i class="fa-anchor"></i><span class="icon-name">fa-anchor</span></li><li><i class="fa-android"></i><span class="icon-name">fa-android</span></li><li><i class="fa-angellist"></i><span class="icon-name">fa-angellist</span></li><li><i class="fa-angle-double-down"></i><span class="icon-name">fa-angle-double-down</span></li><li><i class="fa-angle-double-left"></i><span class="icon-name">fa-angle-double-left</span></li><li><i class="fa-angle-double-right"></i><span class="icon-name">fa-angle-double-right</span></li><li><i class="fa-angle-double-up"></i><span class="icon-name">fa-angle-double-up</span></li><li><i class="fa-angle-down"></i><span class="icon-name">fa-angle-down</span></li><li><i class="fa-angle-left"></i><span class="icon-name">fa-angle-left</span></li><li><i class="fa-angle-right"></i><span class="icon-name">fa-angle-right</span></li><li><i class="fa-angle-up"></i><span class="icon-name">fa-angle-up</span></li><li><i class="fa-apple"></i><span class="icon-name">fa-apple</span></li><li><i class="fa-archive"></i><span class="icon-name">fa-archive</span></li><li><i class="fa-area-chart"></i><span class="icon-name">fa-area-chart</span></li><li><i class="fa-arrow-circle-down"></i><span class="icon-name">fa-arrow-circle-down</span></li><li><i class="fa-arrow-circle-left"></i><span class="icon-name">fa-arrow-circle-left</span></li><li><i class="fa-arrow-circle-o-down"></i><span class="icon-name">fa-arrow-circle-o-down</span></li><li><i class="fa-arrow-circle-o-left"></i><span class="icon-name">fa-arrow-circle-o-left</span></li><li><i class="fa-arrow-circle-o-right"></i><span class="icon-name">fa-arrow-circle-o-right</span></li><li><i class="fa-arrow-circle-o-up"></i><span class="icon-name">fa-arrow-circle-o-up</span></li><li><i class="fa-arrow-circle-right"></i><span class="icon-name">fa-arrow-circle-right</span></li><li><i class="fa-arrow-circle-up"></i><span class="icon-name">fa-arrow-circle-up</span></li><li><i class="fa-arrow-down"></i><span class="icon-name">fa-arrow-down</span></li><li><i class="fa-arrow-left"></i><span class="icon-name">fa-arrow-left</span></li><li><i class="fa-arrow-right"></i><span class="icon-name">fa-arrow-right</span></li><li><i class="fa-arrow-up"></i><span class="icon-name">fa-arrow-up</span></li><li><i class="fa-arrows"></i><span class="icon-name">fa-arrows</span></li><li><i class="fa-arrows-alt"></i><span class="icon-name">fa-arrows-alt</span></li><li><i class="fa-arrows-h"></i><span class="icon-name">fa-arrows-h</span></li><li><i class="fa-arrows-v"></i><span class="icon-name">fa-arrows-v</span></li><li><i class="fa-asterisk"></i><span class="icon-name">fa-asterisk</span></li><li><i class="fa-at"></i><span class="icon-name">fa-at</span></li><li><i class="fa-automobile"></i><span class="icon-name">fa-automobile</span></li><li><i class="fa-backward"></i><span class="icon-name">fa-backward</span></li><li><i class="fa-balance-scale"></i><span class="icon-name">fa-balance-scale</span></li><li><i class="fa-ban"></i><span class="icon-name">fa-ban</span></li><li><i class="fa-bank"></i><span class="icon-name">fa-bank</span></li><li><i class="fa-bar-chart"></i><span class="icon-name">fa-bar-chart</span></li><li><i class="fa-bar-chart-o"></i><span class="icon-name">fa-bar-chart-o</span></li><li><i class="fa-barcode"></i><span class="icon-name">fa-barcode</span></li><li><i class="fa-bars"></i><span class="icon-name">fa-bars</span></li><li><i class="fa-battery-0"></i><span class="icon-name">fa-battery-0</span></li><li><i class="fa-battery-1"></i><span class="icon-name">fa-battery-1</span></li><li><i class="fa-battery-2"></i><span class="icon-name">fa-battery-2</span></li><li><i class="fa-battery-3"></i><span class="icon-name">fa-battery-3</span></li><li><i class="fa-battery-4"></i><span class="icon-name">fa-battery-4</span></li><li><i class="fa-battery-empty"></i><span class="icon-name">fa-battery-empty</span></li><li><i class="fa-battery-full"></i><span class="icon-name">fa-battery-full</span></li><li><i class="fa-battery-half"></i><span class="icon-name">fa-battery-half</span></li><li><i class="fa-battery-quarter"></i><span class="icon-name">fa-battery-quarter</span></li><li><i class="fa-battery-three-quarters"></i><span class="icon-name">fa-battery-three-quarters</span></li><li><i class="fa-bed"></i><span class="icon-name">fa-bed</span></li><li><i class="fa-beer"></i><span class="icon-name">fa-beer</span></li><li><i class="fa-behance"></i><span class="icon-name">fa-behance</span></li><li><i class="fa-behance-square"></i><span class="icon-name">fa-behance-square</span></li><li><i class="fa-bell"></i><span class="icon-name">fa-bell</span></li><li><i class="fa-bell-o"></i><span class="icon-name">fa-bell-o</span></li><li><i class="fa-bell-slash"></i><span class="icon-name">fa-bell-slash</span></li><li><i class="fa-bell-slash-o"></i><span class="icon-name">fa-bell-slash-o</span></li><li><i class="fa-bicycle"></i><span class="icon-name">fa-bicycle</span></li><li><i class="fa-binoculars"></i><span class="icon-name">fa-binoculars</span></li><li><i class="fa-birthday-cake"></i><span class="icon-name">fa-birthday-cake</span></li><li><i class="fa-bitbucket"></i><span class="icon-name">fa-bitbucket</span></li><li><i class="fa-bitbucket-square"></i><span class="icon-name">fa-bitbucket-square</span></li><li><i class="fa-bitcoin"></i><span class="icon-name">fa-bitcoin</span></li><li><i class="fa-black-tie"></i><span class="icon-name">fa-black-tie</span></li><li><i class="fa-bold"></i><span class="icon-name">fa-bold</span></li><li><i class="fa-bolt"></i><span class="icon-name">fa-bolt</span></li><li><i class="fa-bomb"></i><span class="icon-name">fa-bomb</span></li><li><i class="fa-book"></i><span class="icon-name">fa-book</span></li><li><i class="fa-bookmark"></i><span class="icon-name">fa-bookmark</span></li><li><i class="fa-bookmark-o"></i><span class="icon-name">fa-bookmark-o</span></li><li><i class="fa-briefcase"></i><span class="icon-name">fa-briefcase</span></li><li><i class="fa-btc"></i><span class="icon-name">fa-btc</span></li><li><i class="fa-bug"></i><span class="icon-name">fa-bug</span></li><li><i class="fa-building"></i><span class="icon-name">fa-building</span></li><li><i class="fa-building-o"></i><span class="icon-name">fa-building-o</span></li><li><i class="fa-bullhorn"></i><span class="icon-name">fa-bullhorn</span></li><li><i class="fa-bullseye"></i><span class="icon-name">fa-bullseye</span></li><li><i class="fa-bus"></i><span class="icon-name">fa-bus</span></li><li><i class="fa-buysellads"></i><span class="icon-name">fa-buysellads</span></li><li><i class="fa-cab"></i><span class="icon-name">fa-cab</span></li><li><i class="fa-calculator"></i><span class="icon-name">fa-calculator</span></li><li><i class="fa-calendar"></i><span class="icon-name">fa-calendar</span></li><li><i class="fa-calendar-check-o"></i><span class="icon-name">fa-calendar-check-o</span></li><li><i class="fa-calendar-minus-o"></i><span class="icon-name">fa-calendar-minus-o</span></li><li><i class="fa-calendar-o"></i><span class="icon-name">fa-calendar-o</span></li><li><i class="fa-calendar-plus-o"></i><span class="icon-name">fa-calendar-plus-o</span></li><li><i class="fa-calendar-times-o"></i><span class="icon-name">fa-calendar-times-o</span></li><li><i class="fa-camera"></i><span class="icon-name">fa-camera</span></li><li><i class="fa-camera-retro"></i><span class="icon-name">fa-camera-retro</span></li><li><i class="fa-car"></i><span class="icon-name">fa-car</span></li><li><i class="fa-caret-down"></i><span class="icon-name">fa-caret-down</span></li><li><i class="fa-caret-left"></i><span class="icon-name">fa-caret-left</span></li><li><i class="fa-caret-right"></i><span class="icon-name">fa-caret-right</span></li><li><i class="fa-caret-square-o-down"></i><span class="icon-name">fa-caret-square-o-down</span></li><li><i class="fa-caret-square-o-left"></i><span class="icon-name">fa-caret-square-o-left</span></li><li><i class="fa-caret-square-o-right"></i><span class="icon-name">fa-caret-square-o-right</span></li><li><i class="fa-caret-square-o-up"></i><span class="icon-name">fa-caret-square-o-up</span></li><li><i class="fa-caret-up"></i><span class="icon-name">fa-caret-up</span></li><li><i class="fa-cart-arrow-down"></i><span class="icon-name">fa-cart-arrow-down</span></li><li><i class="fa-cart-plus"></i><span class="icon-name">fa-cart-plus</span></li><li><i class="fa-cc"></i><span class="icon-name">fa-cc</span></li><li><i class="fa-cc-amex"></i><span class="icon-name">fa-cc-amex</span></li><li><i class="fa-cc-diners-club"></i><span class="icon-name">fa-cc-diners-club</span></li><li><i class="fa-cc-discover"></i><span class="icon-name">fa-cc-discover</span></li><li><i class="fa-cc-jcb"></i><span class="icon-name">fa-cc-jcb</span></li><li><i class="fa-cc-mastercard"></i><span class="icon-name">fa-cc-mastercard</span></li><li><i class="fa-cc-paypal"></i><span class="icon-name">fa-cc-paypal</span></li><li><i class="fa-cc-stripe"></i><span class="icon-name">fa-cc-stripe</span></li><li><i class="fa-cc-visa"></i><span class="icon-name">fa-cc-visa</span></li><li><i class="fa-certificate"></i><span class="icon-name">fa-certificate</span></li><li><i class="fa-chain"></i><span class="icon-name">fa-chain</span></li><li><i class="fa-chain-broken"></i><span class="icon-name">fa-chain-broken</span></li><li><i class="fa-check"></i><span class="icon-name">fa-check</span></li><li><i class="fa-check-circle"></i><span class="icon-name">fa-check-circle</span></li><li><i class="fa-check-circle-o"></i><span class="icon-name">fa-check-circle-o</span></li><li><i class="fa-check-square"></i><span class="icon-name">fa-check-square</span></li><li><i class="fa-check-square-o"></i><span class="icon-name">fa-check-square-o</span></li><li><i class="fa-chevron-circle-down"></i><span class="icon-name">fa-chevron-circle-down</span></li><li><i class="fa-chevron-circle-left"></i><span class="icon-name">fa-chevron-circle-left</span></li><li><i class="fa-chevron-circle-right"></i><span class="icon-name">fa-chevron-circle-right</span></li><li><i class="fa-chevron-circle-up"></i><span class="icon-name">fa-chevron-circle-up</span></li><li><i class="fa-chevron-down"></i><span class="icon-name">fa-chevron-down</span></li><li><i class="fa-chevron-left"></i><span class="icon-name">fa-chevron-left</span></li><li><i class="fa-chevron-right"></i><span class="icon-name">fa-chevron-right</span></li><li><i class="fa-chevron-up"></i><span class="icon-name">fa-chevron-up</span></li><li><i class="fa-child"></i><span class="icon-name">fa-child</span></li><li><i class="fa-chrome"></i><span class="icon-name">fa-chrome</span></li><li><i class="fa-circle"></i><span class="icon-name">fa-circle</span></li><li><i class="fa-circle-o"></i><span class="icon-name">fa-circle-o</span></li><li><i class="fa-circle-o-notch"></i><span class="icon-name">fa-circle-o-notch</span></li><li><i class="fa-circle-thin"></i><span class="icon-name">fa-circle-thin</span></li><li><i class="fa-clipboard"></i><span class="icon-name">fa-clipboard</span></li><li><i class="fa-clock-o"></i><span class="icon-name">fa-clock-o</span></li><li><i class="fa-clone"></i><span class="icon-name">fa-clone</span></li><li><i class="fa-close"></i><span class="icon-name">fa-close</span></li><li><i class="fa-cloud"></i><span class="icon-name">fa-cloud</span></li><li><i class="fa-cloud-download"></i><span class="icon-name">fa-cloud-download</span></li><li><i class="fa-cloud-upload"></i><span class="icon-name">fa-cloud-upload</span></li><li><i class="fa-cny"></i><span class="icon-name">fa-cny</span></li><li><i class="fa-code"></i><span class="icon-name">fa-code</span></li><li><i class="fa-code-fork"></i><span class="icon-name">fa-code-fork</span></li><li><i class="fa-codepen"></i><span class="icon-name">fa-codepen</span></li><li><i class="fa-coffee"></i><span class="icon-name">fa-coffee</span></li><li><i class="fa-cog"></i><span class="icon-name">fa-cog</span></li><li><i class="fa-cogs"></i><span class="icon-name">fa-cogs</span></li><li><i class="fa-columns"></i><span class="icon-name">fa-columns</span></li><li><i class="fa-comment"></i><span class="icon-name">fa-comment</span></li><li><i class="fa-comment-o"></i><span class="icon-name">fa-comment-o</span></li><li><i class="fa-commenting"></i><span class="icon-name">fa-commenting</span></li><li><i class="fa-commenting-o"></i><span class="icon-name">fa-commenting-o</span></li><li><i class="fa-comments"></i><span class="icon-name">fa-comments</span></li><li><i class="fa-comments-o"></i><span class="icon-name">fa-comments-o</span></li><li><i class="fa-compass"></i><span class="icon-name">fa-compass</span></li><li><i class="fa-compress"></i><span class="icon-name">fa-compress</span></li><li><i class="fa-connectdevelop"></i><span class="icon-name">fa-connectdevelop</span></li><li><i class="fa-contao"></i><span class="icon-name">fa-contao</span></li><li><i class="fa-copy"></i><span class="icon-name">fa-copy</span></li><li><i class="fa-copyright"></i><span class="icon-name">fa-copyright</span></li><li><i class="fa-creative-commons"></i><span class="icon-name">fa-creative-commons</span></li><li><i class="fa-credit-card"></i><span class="icon-name">fa-credit-card</span></li><li><i class="fa-crop"></i><span class="icon-name">fa-crop</span></li><li><i class="fa-crosshairs"></i><span class="icon-name">fa-crosshairs</span></li><li><i class="fa-css3"></i><span class="icon-name">fa-css3</span></li><li><i class="fa-cube"></i><span class="icon-name">fa-cube</span></li><li><i class="fa-cubes"></i><span class="icon-name">fa-cubes</span></li><li><i class="fa-cut"></i><span class="icon-name">fa-cut</span></li><li><i class="fa-cutlery"></i><span class="icon-name">fa-cutlery</span></li><li><i class="fa-dashboard"></i><span class="icon-name">fa-dashboard</span></li><li><i class="fa-dashcube"></i><span class="icon-name">fa-dashcube</span></li><li><i class="fa-database"></i><span class="icon-name">fa-database</span></li><li><i class="fa-dedent"></i><span class="icon-name">fa-dedent</span></li><li><i class="fa-delicious"></i><span class="icon-name">fa-delicious</span></li><li><i class="fa-desktop"></i><span class="icon-name">fa-desktop</span></li><li><i class="fa-deviantart"></i><span class="icon-name">fa-deviantart</span></li><li><i class="fa-diamond"></i><span class="icon-name">fa-diamond</span></li><li><i class="fa-digg"></i><span class="icon-name">fa-digg</span></li><li><i class="fa-dollar"></i><span class="icon-name">fa-dollar</span></li><li><i class="fa-dot-circle-o"></i><span class="icon-name">fa-dot-circle-o</span></li><li><i class="fa-download"></i><span class="icon-name">fa-download</span></li><li><i class="fa-dribbble"></i><span class="icon-name">fa-dribbble</span></li><li><i class="fa-dropbox"></i><span class="icon-name">fa-dropbox</span></li><li><i class="fa-drupal"></i><span class="icon-name">fa-drupal</span></li><li><i class="fa-edit"></i><span class="icon-name">fa-edit</span></li><li><i class="fa-eject"></i><span class="icon-name">fa-eject</span></li><li><i class="fa-ellipsis-h"></i><span class="icon-name">fa-ellipsis-h</span></li><li><i class="fa-ellipsis-v"></i><span class="icon-name">fa-ellipsis-v</span></li><li><i class="fa-empire"></i><span class="icon-name">fa-empire</span></li><li><i class="fa-envelope"></i><span class="icon-name">fa-envelope</span></li><li><i class="fa-envelope-o"></i><span class="icon-name">fa-envelope-o</span></li><li><i class="fa-envelope-square"></i><span class="icon-name">fa-envelope-square</span></li><li><i class="fa-eraser"></i><span class="icon-name">fa-eraser</span></li><li><i class="fa-eur"></i><span class="icon-name">fa-eur</span></li><li><i class="fa-euro"></i><span class="icon-name">fa-euro</span></li><li><i class="fa-exchange"></i><span class="icon-name">fa-exchange</span></li><li><i class="fa-exclamation"></i><span class="icon-name">fa-exclamation</span></li><li><i class="fa-exclamation-circle"></i><span class="icon-name">fa-exclamation-circle</span></li><li><i class="fa-exclamation-triangle"></i><span class="icon-name">fa-exclamation-triangle</span></li><li><i class="fa-expand"></i><span class="icon-name">fa-expand</span></li><li><i class="fa-expeditedssl"></i><span class="icon-name">fa-expeditedssl</span></li><li><i class="fa-external-link"></i><span class="icon-name">fa-external-link</span></li><li><i class="fa-external-link-square"></i><span class="icon-name">fa-external-link-square</span></li><li><i class="fa-eye"></i><span class="icon-name">fa-eye</span></li><li><i class="fa-eye-slash"></i><span class="icon-name">fa-eye-slash</span></li><li><i class="fa-eyedropper"></i><span class="icon-name">fa-eyedropper</span></li><li><i class="fa-facebook"></i><span class="icon-name">fa-facebook</span></li><li><i class="fa-facebook-f"></i><span class="icon-name">fa-facebook-f</span></li><li><i class="fa-facebook-official"></i><span class="icon-name">fa-facebook-official</span></li><li><i class="fa-facebook-square"></i><span class="icon-name">fa-facebook-square</span></li><li><i class="fa-fast-backward"></i><span class="icon-name">fa-fast-backward</span></li><li><i class="fa-fast-forward"></i><span class="icon-name">fa-fast-forward</span></li><li><i class="fa-fax"></i><span class="icon-name">fa-fax</span></li><li><i class="fa-feed"></i><span class="icon-name">fa-feed</span></li><li><i class="fa-female"></i><span class="icon-name">fa-female</span></li><li><i class="fa-fighter-jet"></i><span class="icon-name">fa-fighter-jet</span></li><li><i class="fa-file"></i><span class="icon-name">fa-file</span></li><li><i class="fa-file-archive-o"></i><span class="icon-name">fa-file-archive-o</span></li><li><i class="fa-file-audio-o"></i><span class="icon-name">fa-file-audio-o</span></li><li><i class="fa-file-code-o"></i><span class="icon-name">fa-file-code-o</span></li><li><i class="fa-file-excel-o"></i><span class="icon-name">fa-file-excel-o</span></li><li><i class="fa-file-image-o"></i><span class="icon-name">fa-file-image-o</span></li><li><i class="fa-file-movie-o"></i><span class="icon-name">fa-file-movie-o</span></li><li><i class="fa-file-o"></i><span class="icon-name">fa-file-o</span></li><li><i class="fa-file-pdf-o"></i><span class="icon-name">fa-file-pdf-o</span></li><li><i class="fa-file-photo-o"></i><span class="icon-name">fa-file-photo-o</span></li><li><i class="fa-file-picture-o"></i><span class="icon-name">fa-file-picture-o</span></li><li><i class="fa-file-powerpoint-o"></i><span class="icon-name">fa-file-powerpoint-o</span></li><li><i class="fa-file-sound-o"></i><span class="icon-name">fa-file-sound-o</span></li><li><i class="fa-file-text"></i><span class="icon-name">fa-file-text</span></li><li><i class="fa-file-text-o"></i><span class="icon-name">fa-file-text-o</span></li><li><i class="fa-file-video-o"></i><span class="icon-name">fa-file-video-o</span></li><li><i class="fa-file-word-o"></i><span class="icon-name">fa-file-word-o</span></li><li><i class="fa-file-zip-o"></i><span class="icon-name">fa-file-zip-o</span></li><li><i class="fa-files-o"></i><span class="icon-name">fa-files-o</span></li><li><i class="fa-film"></i><span class="icon-name">fa-film</span></li><li><i class="fa-filter"></i><span class="icon-name">fa-filter</span></li><li><i class="fa-fire"></i><span class="icon-name">fa-fire</span></li><li><i class="fa-fire-extinguisher"></i><span class="icon-name">fa-fire-extinguisher</span></li><li><i class="fa-firefox"></i><span class="icon-name">fa-firefox</span></li><li><i class="fa-flag"></i><span class="icon-name">fa-flag</span></li><li><i class="fa-flag-checkered"></i><span class="icon-name">fa-flag-checkered</span></li><li><i class="fa-flag-o"></i><span class="icon-name">fa-flag-o</span></li><li><i class="fa-flash"></i><span class="icon-name">fa-flash</span></li><li><i class="fa-flask"></i><span class="icon-name">fa-flask</span></li><li><i class="fa-flickr"></i><span class="icon-name">fa-flickr</span></li><li><i class="fa-floppy-o"></i><span class="icon-name">fa-floppy-o</span></li><li><i class="fa-folder"></i><span class="icon-name">fa-folder</span></li><li><i class="fa-folder-o"></i><span class="icon-name">fa-folder-o</span></li><li><i class="fa-folder-open"></i><span class="icon-name">fa-folder-open</span></li><li><i class="fa-folder-open-o"></i><span class="icon-name">fa-folder-open-o</span></li><li><i class="fa-font"></i><span class="icon-name">fa-font</span></li><li><i class="fa-fonticons"></i><span class="icon-name">fa-fonticons</span></li><li><i class="fa-forumbee"></i><span class="icon-name">fa-forumbee</span></li><li><i class="fa-forward"></i><span class="icon-name">fa-forward</span></li><li><i class="fa-foursquare"></i><span class="icon-name">fa-foursquare</span></li><li><i class="fa-frown-o"></i><span class="icon-name">fa-frown-o</span></li><li><i class="fa-futbol-o"></i><span class="icon-name">fa-futbol-o</span></li><li><i class="fa-gamepad"></i><span class="icon-name">fa-gamepad</span></li><li><i class="fa-gavel"></i><span class="icon-name">fa-gavel</span></li><li><i class="fa-gbp"></i><span class="icon-name">fa-gbp</span></li><li><i class="fa-ge"></i><span class="icon-name">fa-ge</span></li><li><i class="fa-gear"></i><span class="icon-name">fa-gear</span></li><li><i class="fa-gears"></i><span class="icon-name">fa-gears</span></li><li><i class="fa-genderless"></i><span class="icon-name">fa-genderless</span></li><li><i class="fa-get-pocket"></i><span class="icon-name">fa-get-pocket</span></li><li><i class="fa-gg"></i><span class="icon-name">fa-gg</span></li><li><i class="fa-gg-circle"></i><span class="icon-name">fa-gg-circle</span></li><li><i class="fa-gift"></i><span class="icon-name">fa-gift</span></li><li><i class="fa-git"></i><span class="icon-name">fa-git</span></li><li><i class="fa-git-square"></i><span class="icon-name">fa-git-square</span></li><li><i class="fa-github"></i><span class="icon-name">fa-github</span></li><li><i class="fa-github-alt"></i><span class="icon-name">fa-github-alt</span></li><li><i class="fa-github-square"></i><span class="icon-name">fa-github-square</span></li><li><i class="fa-gittip"></i><span class="icon-name">fa-gittip</span></li><li><i class="fa-glass"></i><span class="icon-name">fa-glass</span></li><li><i class="fa-globe"></i><span class="icon-name">fa-globe</span></li><li><i class="fa-google"></i><span class="icon-name">fa-google</span></li><li><i class="fa-google-plus"></i><span class="icon-name">fa-google-plus</span></li><li><i class="fa-google-plus-square"></i><span class="icon-name">fa-google-plus-square</span></li><li><i class="fa-google-wallet"></i><span class="icon-name">fa-google-wallet</span></li><li><i class="fa-graduation-cap"></i><span class="icon-name">fa-graduation-cap</span></li><li><i class="fa-gratipay"></i><span class="icon-name">fa-gratipay</span></li><li><i class="fa-group"></i><span class="icon-name">fa-group</span></li><li><i class="fa-h-square"></i><span class="icon-name">fa-h-square</span></li><li><i class="fa-hacker-news"></i><span class="icon-name">fa-hacker-news</span></li><li><i class="fa-hand-grab-o"></i><span class="icon-name">fa-hand-grab-o</span></li><li><i class="fa-hand-lizard-o"></i><span class="icon-name">fa-hand-lizard-o</span></li><li><i class="fa-hand-o-down"></i><span class="icon-name">fa-hand-o-down</span></li><li><i class="fa-hand-o-left"></i><span class="icon-name">fa-hand-o-left</span></li><li><i class="fa-hand-o-right"></i><span class="icon-name">fa-hand-o-right</span></li><li><i class="fa-hand-o-up"></i><span class="icon-name">fa-hand-o-up</span></li><li><i class="fa-hand-paper-o"></i><span class="icon-name">fa-hand-paper-o</span></li><li><i class="fa-hand-peace-o"></i><span class="icon-name">fa-hand-peace-o</span></li><li><i class="fa-hand-pointer-o"></i><span class="icon-name">fa-hand-pointer-o</span></li><li><i class="fa-hand-rock-o"></i><span class="icon-name">fa-hand-rock-o</span></li><li><i class="fa-hand-scissors-o"></i><span class="icon-name">fa-hand-scissors-o</span></li><li><i class="fa-hand-spock-o"></i><span class="icon-name">fa-hand-spock-o</span></li><li><i class="fa-hand-stop-o"></i><span class="icon-name">fa-hand-stop-o</span></li><li><i class="fa-hdd-o"></i><span class="icon-name">fa-hdd-o</span></li><li><i class="fa-header"></i><span class="icon-name">fa-header</span></li><li><i class="fa-headphones"></i><span class="icon-name">fa-headphones</span></li><li><i class="fa-heart"></i><span class="icon-name">fa-heart</span></li><li><i class="fa-heart-o"></i><span class="icon-name">fa-heart-o</span></li><li><i class="fa-heartbeat"></i><span class="icon-name">fa-heartbeat</span></li><li><i class="fa-history"></i><span class="icon-name">fa-history</span></li><li><i class="fa-home"></i><span class="icon-name">fa-home</span></li><li><i class="fa-hospital-o"></i><span class="icon-name">fa-hospital-o</span></li><li><i class="fa-hotel"></i><span class="icon-name">fa-hotel</span></li><li><i class="fa-hourglass"></i><span class="icon-name">fa-hourglass</span></li><li><i class="fa-hourglass-1"></i><span class="icon-name">fa-hourglass-1</span></li><li><i class="fa-hourglass-2"></i><span class="icon-name">fa-hourglass-2</span></li><li><i class="fa-hourglass-3"></i><span class="icon-name">fa-hourglass-3</span></li><li><i class="fa-hourglass-end"></i><span class="icon-name">fa-hourglass-end</span></li><li><i class="fa-hourglass-half"></i><span class="icon-name">fa-hourglass-half</span></li><li><i class="fa-hourglass-o"></i><span class="icon-name">fa-hourglass-o</span></li><li><i class="fa-hourglass-start"></i><span class="icon-name">fa-hourglass-start</span></li><li><i class="fa-houzz"></i><span class="icon-name">fa-houzz</span></li><li><i class="fa-html5"></i><span class="icon-name">fa-html5</span></li><li><i class="fa-i-cursor"></i><span class="icon-name">fa-i-cursor</span></li><li><i class="fa-ils"></i><span class="icon-name">fa-ils</span></li><li><i class="fa-image"></i><span class="icon-name">fa-image</span></li><li><i class="fa-inbox"></i><span class="icon-name">fa-inbox</span></li><li><i class="fa-indent"></i><span class="icon-name">fa-indent</span></li><li><i class="fa-industry"></i><span class="icon-name">fa-industry</span></li><li><i class="fa-info"></i><span class="icon-name">fa-info</span></li><li><i class="fa-info-circle"></i><span class="icon-name">fa-info-circle</span></li><li><i class="fa-inr"></i><span class="icon-name">fa-inr</span></li><li><i class="fa-instagram"></i><span class="icon-name">fa-instagram</span></li><li><i class="fa-institution"></i><span class="icon-name">fa-institution</span></li><li><i class="fa-internet-explorer"></i><span class="icon-name">fa-internet-explorer</span></li><li><i class="fa-intersex"></i><span class="icon-name">fa-intersex</span></li><li><i class="fa-ioxhost"></i><span class="icon-name">fa-ioxhost</span></li><li><i class="fa-italic"></i><span class="icon-name">fa-italic</span></li><li><i class="fa-joomla"></i><span class="icon-name">fa-joomla</span></li><li><i class="fa-jpy"></i><span class="icon-name">fa-jpy</span></li><li><i class="fa-jsfiddle"></i><span class="icon-name">fa-jsfiddle</span></li><li><i class="fa-key"></i><span class="icon-name">fa-key</span></li><li><i class="fa-keyboard-o"></i><span class="icon-name">fa-keyboard-o</span></li><li><i class="fa-krw"></i><span class="icon-name">fa-krw</span></li><li><i class="fa-language"></i><span class="icon-name">fa-language</span></li><li><i class="fa-laptop"></i><span class="icon-name">fa-laptop</span></li><li><i class="fa-lastfm"></i><span class="icon-name">fa-lastfm</span></li><li><i class="fa-lastfm-square"></i><span class="icon-name">fa-lastfm-square</span></li><li><i class="fa-leaf"></i><span class="icon-name">fa-leaf</span></li><li><i class="fa-leanpub"></i><span class="icon-name">fa-leanpub</span></li><li><i class="fa-legal"></i><span class="icon-name">fa-legal</span></li><li><i class="fa-lemon-o"></i><span class="icon-name">fa-lemon-o</span></li><li><i class="fa-level-down"></i><span class="icon-name">fa-level-down</span></li><li><i class="fa-level-up"></i><span class="icon-name">fa-level-up</span></li><li><i class="fa-life-bouy"></i><span class="icon-name">fa-life-bouy</span></li><li><i class="fa-life-buoy"></i><span class="icon-name">fa-life-buoy</span></li><li><i class="fa-life-ring"></i><span class="icon-name">fa-life-ring</span></li><li><i class="fa-life-saver"></i><span class="icon-name">fa-life-saver</span></li><li><i class="fa-lightbulb-o"></i><span class="icon-name">fa-lightbulb-o</span></li><li><i class="fa-line-chart"></i><span class="icon-name">fa-line-chart</span></li><li><i class="fa-link"></i><span class="icon-name">fa-link</span></li><li><i class="fa-linkedin"></i><span class="icon-name">fa-linkedin</span></li><li><i class="fa-linkedin-square"></i><span class="icon-name">fa-linkedin-square</span></li><li><i class="fa-linux"></i><span class="icon-name">fa-linux</span></li><li><i class="fa-list"></i><span class="icon-name">fa-list</span></li><li><i class="fa-list-alt"></i><span class="icon-name">fa-list-alt</span></li><li><i class="fa-list-ol"></i><span class="icon-name">fa-list-ol</span></li><li><i class="fa-list-ul"></i><span class="icon-name">fa-list-ul</span></li><li><i class="fa-location-arrow"></i><span class="icon-name">fa-location-arrow</span></li><li><i class="fa-lock"></i><span class="icon-name">fa-lock</span></li><li><i class="fa-long-arrow-down"></i><span class="icon-name">fa-long-arrow-down</span></li><li><i class="fa-long-arrow-left"></i><span class="icon-name">fa-long-arrow-left</span></li><li><i class="fa-long-arrow-right"></i><span class="icon-name">fa-long-arrow-right</span></li><li><i class="fa-long-arrow-up"></i><span class="icon-name">fa-long-arrow-up</span></li><li><i class="fa-magic"></i><span class="icon-name">fa-magic</span></li><li><i class="fa-magnet"></i><span class="icon-name">fa-magnet</span></li><li><i class="fa-mail-forward"></i><span class="icon-name">fa-mail-forward</span></li><li><i class="fa-mail-reply"></i><span class="icon-name">fa-mail-reply</span></li><li><i class="fa-mail-reply-all"></i><span class="icon-name">fa-mail-reply-all</span></li><li><i class="fa-male"></i><span class="icon-name">fa-male</span></li><li><i class="fa-map"></i><span class="icon-name">fa-map</span></li><li><i class="fa-map-marker"></i><span class="icon-name">fa-map-marker</span></li><li><i class="fa-map-o"></i><span class="icon-name">fa-map-o</span></li><li><i class="fa-map-pin"></i><span class="icon-name">fa-map-pin</span></li><li><i class="fa-map-signs"></i><span class="icon-name">fa-map-signs</span></li><li><i class="fa-mars"></i><span class="icon-name">fa-mars</span></li><li><i class="fa-mars-double"></i><span class="icon-name">fa-mars-double</span></li><li><i class="fa-mars-stroke"></i><span class="icon-name">fa-mars-stroke</span></li><li><i class="fa-mars-stroke-h"></i><span class="icon-name">fa-mars-stroke-h</span></li><li><i class="fa-mars-stroke-v"></i><span class="icon-name">fa-mars-stroke-v</span></li><li><i class="fa-maxcdn"></i><span class="icon-name">fa-maxcdn</span></li><li><i class="fa-meanpath"></i><span class="icon-name">fa-meanpath</span></li><li><i class="fa-medium"></i><span class="icon-name">fa-medium</span></li><li><i class="fa-medkit"></i><span class="icon-name">fa-medkit</span></li><li><i class="fa-meh-o"></i><span class="icon-name">fa-meh-o</span></li><li><i class="fa-mercury"></i><span class="icon-name">fa-mercury</span></li><li><i class="fa-microphone"></i><span class="icon-name">fa-microphone</span></li><li><i class="fa-microphone-slash"></i><span class="icon-name">fa-microphone-slash</span></li><li><i class="fa-minus"></i><span class="icon-name">fa-minus</span></li><li><i class="fa-minus-circle"></i><span class="icon-name">fa-minus-circle</span></li><li><i class="fa-minus-square"></i><span class="icon-name">fa-minus-square</span></li><li><i class="fa-minus-square-o"></i><span class="icon-name">fa-minus-square-o</span></li><li><i class="fa-mobile"></i><span class="icon-name">fa-mobile</span></li><li><i class="fa-mobile-phone"></i><span class="icon-name">fa-mobile-phone</span></li><li><i class="fa-money"></i><span class="icon-name">fa-money</span></li><li><i class="fa-moon-o"></i><span class="icon-name">fa-moon-o</span></li><li><i class="fa-mortar-board"></i><span class="icon-name">fa-mortar-board</span></li><li><i class="fa-motorcycle"></i><span class="icon-name">fa-motorcycle</span></li><li><i class="fa-mouse-pointer"></i><span class="icon-name">fa-mouse-pointer</span></li><li><i class="fa-music"></i><span class="icon-name">fa-music</span></li><li><i class="fa-navicon"></i><span class="icon-name">fa-navicon</span></li><li><i class="fa-neuter"></i><span class="icon-name">fa-neuter</span></li><li><i class="fa-newspaper-o"></i><span class="icon-name">fa-newspaper-o</span></li><li><i class="fa-object-group"></i><span class="icon-name">fa-object-group</span></li><li><i class="fa-object-ungroup"></i><span class="icon-name">fa-object-ungroup</span></li><li><i class="fa-odnoklassniki"></i><span class="icon-name">fa-odnoklassniki</span></li><li><i class="fa-odnoklassniki-square"></i><span class="icon-name">fa-odnoklassniki-square</span></li><li><i class="fa-opencart"></i><span class="icon-name">fa-opencart</span></li><li><i class="fa-openid"></i><span class="icon-name">fa-openid</span></li><li><i class="fa-opera"></i><span class="icon-name">fa-opera</span></li><li><i class="fa-optin-monster"></i><span class="icon-name">fa-optin-monster</span></li><li><i class="fa-outdent"></i><span class="icon-name">fa-outdent</span></li><li><i class="fa-pagelines"></i><span class="icon-name">fa-pagelines</span></li><li><i class="fa-paint-brush"></i><span class="icon-name">fa-paint-brush</span></li><li><i class="fa-paper-plane"></i><span class="icon-name">fa-paper-plane</span></li><li><i class="fa-paper-plane-o"></i><span class="icon-name">fa-paper-plane-o</span></li><li><i class="fa-paperclip"></i><span class="icon-name">fa-paperclip</span></li><li><i class="fa-paragraph"></i><span class="icon-name">fa-paragraph</span></li><li><i class="fa-paste"></i><span class="icon-name">fa-paste</span></li><li><i class="fa-pause"></i><span class="icon-name">fa-pause</span></li><li><i class="fa-paw"></i><span class="icon-name">fa-paw</span></li><li><i class="fa-paypal"></i><span class="icon-name">fa-paypal</span></li><li><i class="fa-pencil"></i><span class="icon-name">fa-pencil</span></li><li><i class="fa-pencil-square"></i><span class="icon-name">fa-pencil-square</span></li><li><i class="fa-pencil-square-o"></i><span class="icon-name">fa-pencil-square-o</span></li><li><i class="fa-phone"></i><span class="icon-name">fa-phone</span></li><li><i class="fa-phone-square"></i><span class="icon-name">fa-phone-square</span></li><li><i class="fa-photo"></i><span class="icon-name">fa-photo</span></li><li><i class="fa-picture-o"></i><span class="icon-name">fa-picture-o</span></li><li><i class="fa-pie-chart"></i><span class="icon-name">fa-pie-chart</span></li><li><i class="fa-pied-piper"></i><span class="icon-name">fa-pied-piper</span></li><li><i class="fa-pied-piper-alt"></i><span class="icon-name">fa-pied-piper-alt</span></li><li><i class="fa-pinterest"></i><span class="icon-name">fa-pinterest</span></li><li><i class="fa-pinterest-p"></i><span class="icon-name">fa-pinterest-p</span></li><li><i class="fa-pinterest-square"></i><span class="icon-name">fa-pinterest-square</span></li><li><i class="fa-plane"></i><span class="icon-name">fa-plane</span></li><li><i class="fa-play"></i><span class="icon-name">fa-play</span></li><li><i class="fa-play-circle"></i><span class="icon-name">fa-play-circle</span></li><li><i class="fa-play-circle-o"></i><span class="icon-name">fa-play-circle-o</span></li><li><i class="fa-plug"></i><span class="icon-name">fa-plug</span></li><li><i class="fa-plus"></i><span class="icon-name">fa-plus</span></li><li><i class="fa-plus-circle"></i><span class="icon-name">fa-plus-circle</span></li><li><i class="fa-plus-square"></i><span class="icon-name">fa-plus-square</span></li><li><i class="fa-plus-square-o"></i><span class="icon-name">fa-plus-square-o</span></li><li><i class="fa-power-off"></i><span class="icon-name">fa-power-off</span></li><li><i class="fa-print"></i><span class="icon-name">fa-print</span></li><li><i class="fa-puzzle-piece"></i><span class="icon-name">fa-puzzle-piece</span></li><li><i class="fa-qq"></i><span class="icon-name">fa-qq</span></li><li><i class="fa-qrcode"></i><span class="icon-name">fa-qrcode</span></li><li><i class="fa-question"></i><span class="icon-name">fa-question</span></li><li><i class="fa-question-circle"></i><span class="icon-name">fa-question-circle</span></li><li><i class="fa-quote-left"></i><span class="icon-name">fa-quote-left</span></li><li><i class="fa-quote-right"></i><span class="icon-name">fa-quote-right</span></li><li><i class="fa-ra"></i><span class="icon-name">fa-ra</span></li><li><i class="fa-random"></i><span class="icon-name">fa-random</span></li><li><i class="fa-rebel"></i><span class="icon-name">fa-rebel</span></li><li><i class="fa-recycle"></i><span class="icon-name">fa-recycle</span></li><li><i class="fa-reddit"></i><span class="icon-name">fa-reddit</span></li><li><i class="fa-reddit-square"></i><span class="icon-name">fa-reddit-square</span></li><li><i class="fa-refresh"></i><span class="icon-name">fa-refresh</span></li><li><i class="fa-registered"></i><span class="icon-name">fa-registered</span></li><li><i class="fa-remove"></i><span class="icon-name">fa-remove</span></li><li><i class="fa-renren"></i><span class="icon-name">fa-renren</span></li><li><i class="fa-reorder"></i><span class="icon-name">fa-reorder</span></li><li><i class="fa-repeat"></i><span class="icon-name">fa-repeat</span></li><li><i class="fa-reply"></i><span class="icon-name">fa-reply</span></li><li><i class="fa-reply-all"></i><span class="icon-name">fa-reply-all</span></li><li><i class="fa-retweet"></i><span class="icon-name">fa-retweet</span></li><li><i class="fa-rmb"></i><span class="icon-name">fa-rmb</span></li><li><i class="fa-road"></i><span class="icon-name">fa-road</span></li><li><i class="fa-rocket"></i><span class="icon-name">fa-rocket</span></li><li><i class="fa-rotate-left"></i><span class="icon-name">fa-rotate-left</span></li><li><i class="fa-rotate-right"></i><span class="icon-name">fa-rotate-right</span></li><li><i class="fa-rouble"></i><span class="icon-name">fa-rouble</span></li><li><i class="fa-rss"></i><span class="icon-name">fa-rss</span></li><li><i class="fa-rss-square"></i><span class="icon-name">fa-rss-square</span></li><li><i class="fa-rub"></i><span class="icon-name">fa-rub</span></li><li><i class="fa-ruble"></i><span class="icon-name">fa-ruble</span></li><li><i class="fa-rupee"></i><span class="icon-name">fa-rupee</span></li><li><i class="fa-safari"></i><span class="icon-name">fa-safari</span></li><li><i class="fa-save"></i><span class="icon-name">fa-save</span></li><li><i class="fa-scissors"></i><span class="icon-name">fa-scissors</span></li><li><i class="fa-search"></i><span class="icon-name">fa-search</span></li><li><i class="fa-search-minus"></i><span class="icon-name">fa-search-minus</span></li><li><i class="fa-search-plus"></i><span class="icon-name">fa-search-plus</span></li><li><i class="fa-sellsy"></i><span class="icon-name">fa-sellsy</span></li><li><i class="fa-send"></i><span class="icon-name">fa-send</span></li><li><i class="fa-send-o"></i><span class="icon-name">fa-send-o</span></li><li><i class="fa-server"></i><span class="icon-name">fa-server</span></li><li><i class="fa-share"></i><span class="icon-name">fa-share</span></li><li><i class="fa-share-alt"></i><span class="icon-name">fa-share-alt</span></li><li><i class="fa-share-alt-square"></i><span class="icon-name">fa-share-alt-square</span></li><li><i class="fa-share-square"></i><span class="icon-name">fa-share-square</span></li><li><i class="fa-share-square-o"></i><span class="icon-name">fa-share-square-o</span></li><li><i class="fa-shekel"></i><span class="icon-name">fa-shekel</span></li><li><i class="fa-sheqel"></i><span class="icon-name">fa-sheqel</span></li><li><i class="fa-shield"></i><span class="icon-name">fa-shield</span></li><li><i class="fa-ship"></i><span class="icon-name">fa-ship</span></li><li><i class="fa-shirtsinbulk"></i><span class="icon-name">fa-shirtsinbulk</span></li><li><i class="fa-shopping-cart"></i><span class="icon-name">fa-shopping-cart</span></li><li><i class="fa-sign-in"></i><span class="icon-name">fa-sign-in</span></li><li><i class="fa-sign-out"></i><span class="icon-name">fa-sign-out</span></li><li><i class="fa-signal"></i><span class="icon-name">fa-signal</span></li><li><i class="fa-simplybuilt"></i><span class="icon-name">fa-simplybuilt</span></li><li><i class="fa-sitemap"></i><span class="icon-name">fa-sitemap</span></li><li><i class="fa-skyatlas"></i><span class="icon-name">fa-skyatlas</span></li><li><i class="fa-skype"></i><span class="icon-name">fa-skype</span></li><li><i class="fa-slack"></i><span class="icon-name">fa-slack</span></li><li><i class="fa-sliders"></i><span class="icon-name">fa-sliders</span></li><li><i class="fa-slideshare"></i><span class="icon-name">fa-slideshare</span></li><li><i class="fa-smile-o"></i><span class="icon-name">fa-smile-o</span></li><li><i class="fa-soccer-ball-o"></i><span class="icon-name">fa-soccer-ball-o</span></li><li><i class="fa-sort"></i><span class="icon-name">fa-sort</span></li><li><i class="fa-sort-alpha-asc"></i><span class="icon-name">fa-sort-alpha-asc</span></li><li><i class="fa-sort-alpha-desc"></i><span class="icon-name">fa-sort-alpha-desc</span></li><li><i class="fa-sort-amount-asc"></i><span class="icon-name">fa-sort-amount-asc</span></li><li><i class="fa-sort-amount-desc"></i><span class="icon-name">fa-sort-amount-desc</span></li><li><i class="fa-sort-asc"></i><span class="icon-name">fa-sort-asc</span></li><li><i class="fa-sort-desc"></i><span class="icon-name">fa-sort-desc</span></li><li><i class="fa-sort-down"></i><span class="icon-name">fa-sort-down</span></li><li><i class="fa-sort-numeric-asc"></i><span class="icon-name">fa-sort-numeric-asc</span></li><li><i class="fa-sort-numeric-desc"></i><span class="icon-name">fa-sort-numeric-desc</span></li><li><i class="fa-sort-up"></i><span class="icon-name">fa-sort-up</span></li><li><i class="fa-soundcloud"></i><span class="icon-name">fa-soundcloud</span></li><li><i class="fa-space-shuttle"></i><span class="icon-name">fa-space-shuttle</span></li><li><i class="fa-spinner"></i><span class="icon-name">fa-spinner</span></li><li><i class="fa-spoon"></i><span class="icon-name">fa-spoon</span></li><li><i class="fa-spotify"></i><span class="icon-name">fa-spotify</span></li><li><i class="fa-square"></i><span class="icon-name">fa-square</span></li><li><i class="fa-square-o"></i><span class="icon-name">fa-square-o</span></li><li><i class="fa-stack-exchange"></i><span class="icon-name">fa-stack-exchange</span></li><li><i class="fa-stack-overflow"></i><span class="icon-name">fa-stack-overflow</span></li><li><i class="fa-star"></i><span class="icon-name">fa-star</span></li><li><i class="fa-star-half"></i><span class="icon-name">fa-star-half</span></li><li><i class="fa-star-half-empty"></i><span class="icon-name">fa-star-half-empty</span></li><li><i class="fa-star-half-full"></i><span class="icon-name">fa-star-half-full</span></li><li><i class="fa-star-half-o"></i><span class="icon-name">fa-star-half-o</span></li><li><i class="fa-star-o"></i><span class="icon-name">fa-star-o</span></li><li><i class="fa-steam"></i><span class="icon-name">fa-steam</span></li><li><i class="fa-steam-square"></i><span class="icon-name">fa-steam-square</span></li><li><i class="fa-step-backward"></i><span class="icon-name">fa-step-backward</span></li><li><i class="fa-step-forward"></i><span class="icon-name">fa-step-forward</span></li><li><i class="fa-stethoscope"></i><span class="icon-name">fa-stethoscope</span></li><li><i class="fa-sticky-note"></i><span class="icon-name">fa-sticky-note</span></li><li><i class="fa-sticky-note-o"></i><span class="icon-name">fa-sticky-note-o</span></li><li><i class="fa-stop"></i><span class="icon-name">fa-stop</span></li><li><i class="fa-street-view"></i><span class="icon-name">fa-street-view</span></li><li><i class="fa-strikethrough"></i><span class="icon-name">fa-strikethrough</span></li><li><i class="fa-stumbleupon"></i><span class="icon-name">fa-stumbleupon</span></li><li><i class="fa-stumbleupon-circle"></i><span class="icon-name">fa-stumbleupon-circle</span></li><li><i class="fa-subscript"></i><span class="icon-name">fa-subscript</span></li><li><i class="fa-subway"></i><span class="icon-name">fa-subway</span></li><li><i class="fa-suitcase"></i><span class="icon-name">fa-suitcase</span></li><li><i class="fa-sun-o"></i><span class="icon-name">fa-sun-o</span></li><li><i class="fa-superscript"></i><span class="icon-name">fa-superscript</span></li><li><i class="fa-support"></i><span class="icon-name">fa-support</span></li><li><i class="fa-table"></i><span class="icon-name">fa-table</span></li><li><i class="fa-tablet"></i><span class="icon-name">fa-tablet</span></li><li><i class="fa-tachometer"></i><span class="icon-name">fa-tachometer</span></li><li><i class="fa-tag"></i><span class="icon-name">fa-tag</span></li><li><i class="fa-tags"></i><span class="icon-name">fa-tags</span></li><li><i class="fa-tasks"></i><span class="icon-name">fa-tasks</span></li><li><i class="fa-taxi"></i><span class="icon-name">fa-taxi</span></li><li><i class="fa-television"></i><span class="icon-name">fa-television</span></li><li><i class="fa-tencent-weibo"></i><span class="icon-name">fa-tencent-weibo</span></li><li><i class="fa-terminal"></i><span class="icon-name">fa-terminal</span></li><li><i class="fa-text-height"></i><span class="icon-name">fa-text-height</span></li><li><i class="fa-text-width"></i><span class="icon-name">fa-text-width</span></li><li><i class="fa-th"></i><span class="icon-name">fa-th</span></li><li><i class="fa-th-large"></i><span class="icon-name">fa-th-large</span></li><li><i class="fa-th-list"></i><span class="icon-name">fa-th-list</span></li><li><i class="fa-thumb-tack"></i><span class="icon-name">fa-thumb-tack</span></li><li><i class="fa-thumbs-down"></i><span class="icon-name">fa-thumbs-down</span></li><li><i class="fa-thumbs-o-down"></i><span class="icon-name">fa-thumbs-o-down</span></li><li><i class="fa-thumbs-o-up"></i><span class="icon-name">fa-thumbs-o-up</span></li><li><i class="fa-thumbs-up"></i><span class="icon-name">fa-thumbs-up</span></li><li><i class="fa-ticket"></i><span class="icon-name">fa-ticket</span></li><li><i class="fa-times"></i><span class="icon-name">fa-times</span></li><li><i class="fa-times-circle"></i><span class="icon-name">fa-times-circle</span></li><li><i class="fa-times-circle-o"></i><span class="icon-name">fa-times-circle-o</span></li><li><i class="fa-tint"></i><span class="icon-name">fa-tint</span></li><li><i class="fa-toggle-down"></i><span class="icon-name">fa-toggle-down</span></li><li><i class="fa-toggle-left"></i><span class="icon-name">fa-toggle-left</span></li><li><i class="fa-toggle-off"></i><span class="icon-name">fa-toggle-off</span></li><li><i class="fa-toggle-on"></i><span class="icon-name">fa-toggle-on</span></li><li><i class="fa-toggle-right"></i><span class="icon-name">fa-toggle-right</span></li><li><i class="fa-toggle-up"></i><span class="icon-name">fa-toggle-up</span></li><li><i class="fa-trademark"></i><span class="icon-name">fa-trademark</span></li><li><i class="fa-train"></i><span class="icon-name">fa-train</span></li><li><i class="fa-transgender"></i><span class="icon-name">fa-transgender</span></li><li><i class="fa-transgender-alt"></i><span class="icon-name">fa-transgender-alt</span></li><li><i class="fa-trash"></i><span class="icon-name">fa-trash</span></li><li><i class="fa-trash-o"></i><span class="icon-name">fa-trash-o</span></li><li><i class="fa-tree"></i><span class="icon-name">fa-tree</span></li><li><i class="fa-trello"></i><span class="icon-name">fa-trello</span></li><li><i class="fa-tripadvisor"></i><span class="icon-name">fa-tripadvisor</span></li><li><i class="fa-trophy"></i><span class="icon-name">fa-trophy</span></li><li><i class="fa-truck"></i><span class="icon-name">fa-truck</span></li><li><i class="fa-try"></i><span class="icon-name">fa-try</span></li><li><i class="fa-tty"></i><span class="icon-name">fa-tty</span></li><li><i class="fa-tumblr"></i><span class="icon-name">fa-tumblr</span></li><li><i class="fa-tumblr-square"></i><span class="icon-name">fa-tumblr-square</span></li><li><i class="fa-turkish-lira"></i><span class="icon-name">fa-turkish-lira</span></li><li><i class="fa-tv"></i><span class="icon-name">fa-tv</span></li><li><i class="fa-twitch"></i><span class="icon-name">fa-twitch</span></li><li><i class="fa-twitter"></i><span class="icon-name">fa-twitter</span></li><li><i class="fa-twitter-square"></i><span class="icon-name">fa-twitter-square</span></li><li><i class="fa-umbrella"></i><span class="icon-name">fa-umbrella</span></li><li><i class="fa-underline"></i><span class="icon-name">fa-underline</span></li><li><i class="fa-undo"></i><span class="icon-name">fa-undo</span></li><li><i class="fa-university"></i><span class="icon-name">fa-university</span></li><li><i class="fa-unlink"></i><span class="icon-name">fa-unlink</span></li><li><i class="fa-unlock"></i><span class="icon-name">fa-unlock</span></li><li><i class="fa-unlock-alt"></i><span class="icon-name">fa-unlock-alt</span></li><li><i class="fa-unsorted"></i><span class="icon-name">fa-unsorted</span></li><li><i class="fa-upload"></i><span class="icon-name">fa-upload</span></li><li><i class="fa-usd"></i><span class="icon-name">fa-usd</span></li><li><i class="fa-user"></i><span class="icon-name">fa-user</span></li><li><i class="fa-user-md"></i><span class="icon-name">fa-user-md</span></li><li><i class="fa-user-plus"></i><span class="icon-name">fa-user-plus</span></li><li><i class="fa-user-secret"></i><span class="icon-name">fa-user-secret</span></li><li><i class="fa-user-times"></i><span class="icon-name">fa-user-times</span></li><li><i class="fa-users"></i><span class="icon-name">fa-users</span></li><li><i class="fa-venus"></i><span class="icon-name">fa-venus</span></li><li><i class="fa-venus-double"></i><span class="icon-name">fa-venus-double</span></li><li><i class="fa-venus-mars"></i><span class="icon-name">fa-venus-mars</span></li><li><i class="fa-viacoin"></i><span class="icon-name">fa-viacoin</span></li><li><i class="fa-video-camera"></i><span class="icon-name">fa-video-camera</span></li><li><i class="fa-vimeo"></i><span class="icon-name">fa-vimeo</span></li><li><i class="fa-vimeo-square"></i><span class="icon-name">fa-vimeo-square</span></li><li><i class="fa-vine"></i><span class="icon-name">fa-vine</span></li><li><i class="fa-vk"></i><span class="icon-name">fa-vk</span></li><li><i class="fa-volume-down"></i><span class="icon-name">fa-volume-down</span></li><li><i class="fa-volume-off"></i><span class="icon-name">fa-volume-off</span></li><li><i class="fa-volume-up"></i><span class="icon-name">fa-volume-up</span></li><li><i class="fa-warning"></i><span class="icon-name">fa-warning</span></li><li><i class="fa-wechat"></i><span class="icon-name">fa-wechat</span></li><li><i class="fa-weibo"></i><span class="icon-name">fa-weibo</span></li><li><i class="fa-weixin"></i><span class="icon-name">fa-weixin</span></li><li><i class="fa-whatsapp"></i><span class="icon-name">fa-whatsapp</span></li><li><i class="fa-wheelchair"></i><span class="icon-name">fa-wheelchair</span></li><li><i class="fa-wifi"></i><span class="icon-name">fa-wifi</span></li><li><i class="fa-wikipedia-w"></i><span class="icon-name">fa-wikipedia-w</span></li><li><i class="fa-windows"></i><span class="icon-name">fa-windows</span></li><li><i class="fa-won"></i><span class="icon-name">fa-won</span></li><li><i class="fa-wordpress"></i><span class="icon-name">fa-wordpress</span></li><li><i class="fa-wrench"></i><span class="icon-name">fa-wrench</span></li><li><i class="fa-xing"></i><span class="icon-name">fa-xing</span></li><li><i class="fa-xing-square"></i><span class="icon-name">fa-xing-square</span></li><li><i class="fa-y-combinator"></i><span class="icon-name">fa-y-combinator</span></li><li><i class="fa-y-combinator-square"></i><span class="icon-name">fa-y-combinator-square</span></li><li><i class="fa-yahoo"></i><span class="icon-name">fa-yahoo</span></li><li><i class="fa-yc"></i><span class="icon-name">fa-yc</span></li><li><i class="fa-yc-square"></i><span class="icon-name">fa-yc-square</span></li><li><i class="fa-yelp"></i><span class="icon-name">fa-yelp</span></li><li><i class="fa-yen"></i><span class="icon-name">fa-yen</span></li><li><i class="fa-youtube"></i><span class="icon-name">fa-youtube</span></li><li><i class="fa-youtube-play"></i><span class="icon-name">fa-youtube-play</span></li><li><i class="fa-youtube-square"></i><span class="icon-name">fa-youtube-square</span></li>';
			
			// OUTPUT
			if ($type == "font-awesome" || $type == "") {
			$icon_list .= $fa_list;
			}
			
			// APPLY FILTERS
			$icon_list = apply_filters('sf_icons_list', $icon_list);
			
			return $icon_list;
		}
	}
	
	
	/* LANGUAGE FLAGS
	================================================== */
	
	if (! function_exists( 'language_flags' )) {
	function language_flags() {
		
		$language_output = "";
		
		if (function_exists('icl_get_languages')) {
		    $languages = icl_get_languages('skip_missing=0&orderby=code');
		    if(!empty($languages)){
		        foreach($languages as $l){
		            $language_output .= '<li>';
		            if($l['country_flag_url']){
		                if(!$l['active']) {
		                	$language_output .= '<a href="'.$l['url'].'"><img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" /><span class="language name">'.$l['translated_name'].'</span></a>'."\n";
		                } else {
		                	$language_output .= '<div class="current-language"><img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" /><span class="language name">'.$l['translated_name'].'</span></div>'."\n";
		                }
		            }
		            $language_output .= '</li>';
		        }
		    }
	    } else {
	    	//echo '<li><div>No languages set.</div></li>';
	    	$flags_url = get_template_directory_uri() . '/images/flags';
	    	$language_output .= '<li><a href="#">DEMO - EXAMPLE PURPOSES</a><li><a href="#"><span class="language name">German</span></a></li><li><div class="current-language"><span class="language name">English</span></div></li><li><a href="#"><span class="language name">Spanish</span></a></li><li><a href="#"><span class="language name">French</span></a></li>'."\n";
	    }
	    
	    return $language_output;
	}
	}
	
	
	/* PAGINATION
	================================================== */
	
	function pagination() {
		global $wp_query;
		
		$big = 999999999; // need an unlikely integer
		
		return paginate_links( array(
			'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages
		) );
	}
	
	
	/* LATEST TWEET FUNCTION
	================================================== */
	
	function latestTweet($count, $twitterID) {
	
		global $include_twitter;
		$include_twitter = true;
		
		$content = "";
		
		if (function_exists('getTweets')) {
						
			$tweets = getTweets($twitterID, $count);
		
			if(is_array($tweets)){
						
				foreach($tweets as $tweet){
										
					$content .= '<li>';
				
				    if($tweet['text']){
				    	
				    	$content .= '<div class="tweet-text">';
				    	
				        $the_tweet = $tweet['text'];
				        /*
				        Twitter Developer Display Requirements
				        https://dev.twitter.com/terms/display-requirements
				
				        2.b. Tweet Entities within the Tweet text must be properly linked to their appropriate home on Twitter. For example:
				          i. User_mentions must link to the mentioned user's profile.
				         ii. Hashtags must link to a twitter.com search with the hashtag as the query.
				        iii. Links in Tweet text must be displayed using the display_url
				             field in the URL entities API response, and link to the original t.co url field.
				        */
				
				        // i. User_mentions must link to the mentioned user's profile.
				        if(is_array($tweet['entities']['user_mentions'])){
				            foreach($tweet['entities']['user_mentions'] as $key => $user_mention){
				                $the_tweet = preg_replace(
				                    '/@'.$user_mention['screen_name'].'/i',
				                    '<a href="http://www.twitter.com/'.$user_mention['screen_name'].'" target="_blank">@'.$user_mention['screen_name'].'</a>',
				                    $the_tweet);
				            }
				        }
				
				        // ii. Hashtags must link to a twitter.com search with the hashtag as the query.
				        if(is_array($tweet['entities']['hashtags'])){
				            foreach($tweet['entities']['hashtags'] as $key => $hashtag){
				                $the_tweet = preg_replace(
				                    '/#'.$hashtag['text'].'/i',
				                    '<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&amp;src=hash" target="_blank">#'.$hashtag['text'].'</a>',
				                    $the_tweet);
				            }
				        }
				
				        // iii. Links in Tweet text must be displayed using the display_url
				        //      field in the URL entities API response, and link to the original t.co url field.
				        if(is_array($tweet['entities']['urls'])){
				            foreach($tweet['entities']['urls'] as $key => $link){
				                $the_tweet = preg_replace(
				                    '`'.$link['url'].'`',
				                    '<a href="'.$link['url'].'" target="_blank">'.$link['url'].'</a>',
				                    $the_tweet);
				            }
				        }
				        
				        // Custom code to link to media
				        if(isset($tweet['entities']['media']) && is_array($tweet['entities']['media'])){
				            foreach($tweet['entities']['media'] as $key => $media){
				                $the_tweet = preg_replace(
				                    '`'.$media['url'].'`',
				                    '<a href="'.$media['url'].'" target="_blank">'.$media['url'].'</a>',
				                    $the_tweet);
				            }
				        }
				
				        $content .= $the_tweet;
						
						$content .= '</div>';
				
				        // 3. Tweet Actions
				        //    Reply, Retweet, and Favorite action icons must always be visible for the user to interact with the Tweet. These actions must be implemented using Web Intents or with the authenticated Twitter API.
				        //    No other social or 3rd party actions similar to Follow, Reply, Retweet and Favorite may be attached to a Tweet.
				        // 4. Tweet Timestamp
				        //    The Tweet timestamp must always be visible and include the time and date. e.g., “3:00 PM - 31 May 12”.
				        // 5. Tweet Permalink
				        //    The Tweet timestamp must always be linked to the Tweet permalink.
				        
				       	$content .= '<div class="twitter_intents">'. "\n";
				        $content .= '<a class="reply" href="https://twitter.com/intent/tweet?in_reply_to='.$tweet['id_str'].'"><i class="fa-reply"></i></a>'. "\n";
				        $content .= '<a class="retweet" href="https://twitter.com/intent/retweet?tweet_id='.$tweet['id_str'].'"><i class="fa-retweet"></i></a>'. "\n";
				        $content .= '<a class="favorite" href="https://twitter.com/intent/favorite?tweet_id='.$tweet['id_str'].'"><i class="fa-star"></i></a>'. "\n";
				        
				        $date = strtotime($tweet['created_at']); // retrives the tweets date and time in Unix Epoch terms
				        $blogtime = current_time('U'); // retrives the current browser client date and time in Unix Epoch terms
				        $dago = human_time_diff($date, $blogtime) . ' ' . sprintf(__('ago', 'swiftframework')); // calculates and outputs the time past in human readable format
						$content .= '<a class="timestamp" href="https://twitter.com/'.$twitterID.'/status/'.$tweet['id_str'].'" target="_blank">'.$dago.'</a>'. "\n";
						$content .= '</div>'. "\n";
				    } else {
				        $content .= '<a href="http://twitter.com/'.$twitterID.'" target="_blank">@'.$twitterID.'</a>';
				    }
				    $content .= '</li>';
				}
			}
			return $content;
		} else {
			return '<li><div class="tweet-text">Please install the oAuth Twitter Feed Plugin and follow the theme documentation to set it up.</div></li>';
		}	
	}
	
		
	/* CONTENT RETURN FUNCTIONS
	================================================== */
	
	function get_the_content_with_formatting() {
	    $content = get_the_content();
	    $content = apply_filters('the_content', $content);
	    $content = str_replace(']]>', ']]&gt;', $content);
	    return $content;
	}
	function sf_add_formatting($content) {
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		return $content;
	}
	
	
	/* SHORTCODE FIX
	================================================== */
	
	function sf_shortcode_fix($content){   
	    $array = array (
	        '<p>[' => '[', 
	        ']</p>' => ']', 
	        ']<br />' => ']'
	    );
	
	    $content = strtr($content, $array);
	    return $content;
	}
	add_filter('the_content', 'sf_shortcode_fix');
	
	
	/* CATEGORY REL FIX
	================================================== */
		 
	function add_nofollow_cat( $text) {
	    $strings = array('rel="category"', 'rel="category tag"', 'rel="whatever may need"');
	    $text = str_replace('rel="category tag"', "", $text);
	    return $text;
	}
	add_filter( 'the_category', 'add_nofollow_cat' );
	
	
	/* POST DETAIL META
	================================================== */
	if ( ! function_exists( 'sf_post_detail_meta' ) ) {
	    function sf_post_detail_meta() {
	        global $post;
	        $options = get_option('sf_neighborhood_options');
	        $site_name = apply_filters('sf_schema_meta_site_name', get_bloginfo( 'name' ));
	        $post_title = get_the_title();
	        $post_date = get_the_date('Y-m-d g:i:s');
	        $modified_date = get_the_modified_date('Y-m-d g:i:s');
	        $permalink = get_permalink();
	        $author = get_the_author();
	        
	        $post_image = get_post_thumbnail_id();
	       	$image_meta = array();
	       	$post_image_url = $post_image_alt = "";
	        $post_image_width = $post_image_height = 0;
	        
	        if ( $post_image != "" ) {
		        $post_image_meta = sf_get_attachment_meta( $post_image );
		        if ( isset($post_image_meta) ) {
		        	$post_image_alt = esc_attr( $post_image_meta['alt'] );
		        } 
		        $post_thumb_id = get_post_thumbnail_id();
		        $post_image_url = wp_get_attachment_url( $post_thumb_id );
		        $post_image_meta = wp_get_attachment_metadata( $post_thumb_id );
		        $post_image_width = isset($post_image_meta['width']) ? $post_image_meta['width'] : 0;
		        $post_image_height = isset($post_image_meta['height']) ? $post_image_meta['height'] : 0;
	        }
	        $logo = array();
	        $logo_width = $logo_height = 0;
	        if ( isset($options['logo_upload']) ) {
	        	$logo = $options['logo_upload'];
	        	if ( isset($logo['width']) ) {
	        		$logo_width = $logo['width'];
	        	}
	        	if ( isset($logo['height']) ) {
	        		$logo_height = $logo['height'];
	        	}
	        }
	        
	        ?>
	        
	        <div class="article-meta hide">
	        	<div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
	        		<?php if ( !empty($logo) ) { ?>
						<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
							<img src="<?php echo $logo; ?>" alt="<?php echo $site_name; ?>" />
							<meta itemprop="url" content="<?php echo $logo; ?>">
							<meta itemprop="width" content="<?php echo $logo_width; ?>">
							<meta itemprop="height" content="<?php echo $logo_height; ?>">
						</div>
					<?php } ?>
					<meta itemprop="name" content="<?php echo $site_name; ?>">
				</div>
	        	<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php echo $permalink; ?>"/>
	        	<div itemprop="headline"><?php echo $post_title; ?></div>
	        	<meta itemprop="datePublished" content="<?php echo $post_date; ?>"/>
	        	<meta itemprop="dateModified" content="<?php echo $modified_date; ?>"/>
	        	<?php if ( $post_image != "" ) { ?>
	        	<div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
					<meta itemprop="url" content="<?php echo $post_image_url; ?>">
					<meta itemprop="width" content="<?php echo $post_image_width; ?>">
					<meta itemprop="height" content="<?php echo $post_image_height; ?>">
				</div>
	        	<?php } ?>
	        	<h3 itemprop="author" itemscope itemtype="https://schema.org/Person">
	        		<span itemprop="name"><?php echo $author; ?></span>
	        	</h3>
	        </div>
	        
	    <?php
	    }
	}
	add_action( 'sf_post_article_start', 'sf_post_detail_meta', 5 );
	
	
	/* CUSTOM MENU SETUP
	================================================== */
	
	add_action( 'after_setup_theme', 'setup_menus' );
	function setup_menus() {
		// This theme uses wp_nav_menu() in four locations.
		register_nav_menus( array(
		'main_navigation' => __( 'Main Menu', "swiftframework" ),
		'top_bar_menu' => __( 'Top Bar Menu', "swiftframework" )
		) );
	}
	add_filter('nav_menu_css_class', 'mbudm_add_page_type_to_menu', 10, 2 );
	//If a menu item is a page then add the template name to it as a css class 
	function mbudm_add_page_type_to_menu($classes, $item) {
	    if($item->object == 'page'){
	        $template_name = sf_get_post_meta( $item->object_id, '_wp_page_template', true );
	        $new_class =str_replace(".php","",$template_name);
	        array_push($classes, $new_class);
	    }   
	    return $classes;
	}
		
	
	/* EXCERPT
	================================================== */
	
	function new_excerpt_length($length) {
	    return 60;
	}
	add_filter('excerpt_length', 'new_excerpt_length');
	
	// Blog Widget Excerpt
	function excerpt($limit) {
	      $excerpt = explode(' ', get_the_excerpt(), $limit);
	      if (count($excerpt)>=$limit) {
	        array_pop($excerpt);
	        $excerpt = implode(" ",$excerpt).'...';
	      } else {
	        $excerpt = implode(" ",$excerpt).'';
	      } 
	      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	      return '<p>' . $excerpt . '</p>';
	    }
	
	function content($limit) {
	      $content = explode(' ', get_the_content(), $limit);
	      if (count($content)>=$limit) {
	        array_pop($content);
	        $content = implode(" ",$content).'...';
	      } else {
	        $content = implode(" ",$content).'';
	      } 
	      $content = preg_replace('/\[.+\]/','', $content);
	      $content = apply_filters('the_content', $content); 
	      $content = str_replace(']]>', ']]&gt;', $content);
	      return $content;
	}
	
	function custom_excerpt($custom_content, $limit) {
		$content = explode(' ', $custom_content, $limit);
		if (count($content)>=$limit) {
		  array_pop($content);
		  $content = implode(" ",$content).'...';
		} else {
		  $content = implode(" ",$content).'';
		} 
		$content = preg_replace('/\[.+\]/','', $content);
		$content = apply_filters('the_content', $content); 
		$content = str_replace(']]>', ']]&gt;', $content);
		return $content;
	}	
	
	/* REGISTER SIDEBARS
	================================================== */
	if (!function_exists('sf_register_sidebars')) {
		function sf_register_sidebars() {
			if ( function_exists('register_sidebar')) {
			
				$options = get_option('sf_neighborhood_options');
				if (isset($options['footer_layout'])) {
				$footer_config = $options['footer_layout'];
				} else {
				$footer_config = 'footer-1';
				}
			    register_sidebar(array(
			    	'id' => 'sidebar-1',
			        'name' => 'Sidebar One',
			        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
			        'after_widget' => '</section>',
			        'before_title' => '<div class="widget-heading clearfix"><h4><span>',
			        'after_title' => '</span></h4></div>',
			    ));
			    register_sidebar(array(
			    	'id' => 'sidebar-2',
			        'name' => 'Sidebar Two',
			        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
			        'after_widget' => '</section>',
			        'before_title' => '<div class="widget-heading clearfix"><h4><span>',
			        'after_title' => '</span></h4></div>',
			    ));
				register_sidebar(array(
					'id' => 'sidebar-3',
					'name' => 'Sidebar Three',
					'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
					'after_widget' => '</section>',
					'before_title' => '<div class="widget-heading clearfix"><h4><span>',
					'after_title' => '</span></h4></div>',
				));
				register_sidebar(array(
					'id' => 'sidebar-4',
					'name' => 'Sidebar Four',
					'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
					'after_widget' => '</section>',
					'before_title' => '<div class="widget-heading clearfix"><h4><span>',
					'after_title' => '</span></h4></div>',
				));
				register_sidebar(array(
					'id' => 'sidebar-5',
				    'name' => 'Sidebar Five',
				    'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
				    'after_widget' => '</section>',
				    'before_title' => '<div class="widget-heading clearfix"><h4><span>',
				    'after_title' => '</span></h4></div>',
				));
				register_sidebar(array(
					'id' => 'sidebar-6',
				    'name' => 'Sidebar Six',
				    'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
				    'after_widget' => '</section>',
				    'before_title' => '<div class="widget-heading clearfix"><h4><span>',
				    'after_title' => '</span></h4></div>',
				));
				register_sidebar(array(
					'id' => 'sidebar-7',
					'name' => 'Sidebar Seven',
					'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
					'after_widget' => '</section>',
					'before_title' => '<div class="widget-heading clearfix"><h4><span>',
					'after_title' => '</span></h4></div>',
				));
				register_sidebar(array(
					'id' => 'sidebar-8',
					'name' => 'Sidebar Eight',
					'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
					'after_widget' => '</section>',
					'before_title' => '<div class="widget-heading clearfix"><h4><span>',
					'after_title' => '</span></h4></div>',
				));
			    register_sidebar(array(
			    	'id' => 'sidebar-9',
			        'name' => 'Footer Column 1',
			        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
			        'after_widget' => '</section>',
			        'before_title' => '<div class="widget-heading clearfix"><h4><span>',
			        'after_title' => '</span></h4></div>',
			    ));
			    register_sidebar(array(
			    	'id' => 'sidebar-10',
			        'name' => 'Footer Column 2',
			        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
			        'after_widget' => '</section>',
			        'before_title' => '<div class="widget-heading clearfix"><h4><span>',
			        'after_title' => '</span></h4></div>',
			    ));
			    register_sidebar(array(
			    	'id' => 'sidebar-11',
			        'name' => 'Footer Column 3',
			        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
			        'after_widget' => '</section>',
			        'before_title' => '<div class="widget-heading clearfix"><h4><span>',
			        'after_title' => '</span></h4></div>',
			    ));
			    if ($footer_config == "footer-1") {
			    register_sidebar(array(
			    	'id' => 'sidebar-12',
			        'name' => 'Footer Column 4',
			        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
			        'after_widget' => '</section>',
			        'before_title' => '<div class="widget-heading clearfix"><h4><span>',
			        'after_title' => '</span></h4></div>',
			    ));
			    }
			    register_sidebar(array(
			        'id' => 'woocommerce-sidebar',
			        'name' => 'WooCommerce Sidebar',
			        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
			        'after_widget' => '</section>',
			        'before_title' => '<div class="widget-heading clearfix"><h4><span>',
			        'after_title' => '</span></h4></div>',
			    ));
			} 
		}
		add_action( 'after_setup_theme', 'sf_register_sidebars', 10);
	}
	
	function sf_sidebars_array() {
	 	$sidebars = array();
	 	
	 	foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
	 		$sidebars[ucwords($sidebar['id'])] = $sidebar['name'];
	 	}
	 	return $sidebars;
	}
	
	
	/* ADD SHORTCODE FUNCTIONALITY TO WIDGETS
	================================================== */
	
	add_filter('widget_text', 'do_shortcode');
	
	
	/* NAVIGATION CHECK
	================================================== */
	
	//functions tell whether there are previous or next 'pages' from the current page
	//returns 0 if no 'page' exists, returns a number > 0 if 'page' does exist
	//ob_ functions are used to suppress the previous_posts_link() and next_posts_link() from printing their output to the screen
	
	function has_previous_posts() {
		ob_start();
		previous_posts_link();
		$result = strlen(ob_get_contents());
		ob_end_clean();
		return $result;
	}
	
	function has_next_posts() {
		ob_start();
		next_posts_link();
		$result = strlen(ob_get_contents());
		ob_end_clean();
		return $result;
	}
	
	
	/* REMOVE CERTAIN HEAD TAGS
	================================================== */
	
	add_action('init', 'remheadlink');
	function remheadlink() {
		remove_action('wp_head', 'index_rel_link');
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wlwmanifest_link');
	}
	
	
	/* CUSTOM LOGIN LOGO
	================================================== */
	
	function sf_custom_login_logo() {
		$options = get_option('sf_neighborhood_options');
		$custom_logo = "";
		if (isset($options['custom_admin_login_logo'])) {
		$custom_logo = $options['custom_admin_login_logo'];
		}
		if ($custom_logo) {		
		echo '<style type="text/css">
		    .login h1 a { background-image:url('. $custom_logo .') !important; height: 95px!important; width: 100%!important; background-size: auto!important; }
		</style>';
		} else {
		echo '<style type="text/css">
		    .login h1 a { background-image:url('. get_template_directory_uri() .'/images/custom-login-logo.png) !important; height: 95px!important; width: 100%!important; background-size: auto!important; }
		</style>';
		}
	}
	
	add_action('login_head', 'sf_custom_login_logo');
		
	
	/* COMMENTS
	================================================== */
	
	// Custom callback to list comments in the your-theme style
	function custom_comments($comment, $args, $depth) {
	  $GLOBALS['comment'] = $comment;
	    $GLOBALS['comment_depth'] = $depth;
	  ?>
	    <li id="comment-<?php comment_ID() ?>" <?php comment_class('clearfix') ?>>
	        <div class="comment-wrap clearfix">
	            <div class="comment-avatar">
	            	<?php if(function_exists('get_avatar')) { echo get_avatar($comment, '100'); } ?>
	            	<?php if ($comment->comment_author_email == get_the_author_meta('email')) { ?>
	            	<span class="tooltip"><?php _e("Author", "swiftframework"); ?><span class="arrow"></span></span>
	            	<?php } ?>
	            </div>
	    		<div class="comment-content">
	            	<div class="comment-meta">
	            			<?php
	            				printf('<span class="comment-author">%1$s</span> <span class="comment-date">%2$s</span>',
	            					get_comment_author_link(),
	            					get_comment_date()
	            				);
	                        	edit_comment_link(__('Edit', 'swiftframework'), '<span class="edit-link">', '</span><span class="meta-sep"> |</span>');
	                        ?>
	                        <?php if($args['type'] == 'all' || get_comment_type() == 'comment') :
	                        	comment_reply_link(array_merge($args, array(
	                            	'reply_text' => __('Reply','swiftframework'),
	                            	'login_text' => __('Log in to reply.','swiftframework'),
	                            	'depth' => $depth,
	                            	'before' => '<span class="comment-reply">',
	                            	'after' => '</span>'
	                        	)));
	                        endif; ?>
	    			</div>
	      			<?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'swiftframework') ?>
	            	<div class="comment-body">
	                	<?php comment_text() ?>
	            	</div>
	    		</div>
	        </div>
	<?php } // end custom_comments
	
	// Custom callback to list pings
	function custom_pings($comment, $args, $depth) {
	       $GLOBALS['comment'] = $comment;
	        ?>
	            <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
	                <div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'swiftframework'),
	                        get_comment_author_link(),
	                        get_comment_date(),
	                        get_comment_time() );
	                        edit_comment_link(__('Edit', 'swiftframework'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
	    <?php if ($comment->comment_approved == '0') _e('\t\t\t\t\t<span class="unapproved">Your trackback is awaiting moderation.</span>\n', 'swiftframework') ?>
	            <div class="comment-content">
	                <?php comment_text() ?>
	            </div>
	<?php } // end custom_pings
	
	
	
	/* PAGINATION
	================================================== */
	
	 
	/* Function that Rounds To The Nearest Value.
	   Needed for the pagenavi() function */
	function round_num($num, $to_nearest) {
	   /*Round fractions down (http://php.net/manual/en/function.floor.php)*/
	   return floor($num/$to_nearest)*$to_nearest;
	}
	 
	/* Function that performs a Boxed Style Numbered Pagination (also called Page Navigation).
	   Function is largely based on Version 2.4 of the WP-PageNavi plugin */
	function pagenavi($query, $before = '', $after = '') {
	    
	    wp_reset_query();
	    global $wpdb, $paged;
	    
	    $pagenavi_options = array();
	    //$pagenavi_options['pages_text'] = ('Page %CURRENT_PAGE% of %TOTAL_PAGES%:');
	    $pagenavi_options['pages_text'] = ('');
	    $pagenavi_options['current_text'] = '%PAGE_NUMBER%';
	    $pagenavi_options['page_text'] = '%PAGE_NUMBER%';
	    $pagenavi_options['first_text'] = ('First Page');
	    $pagenavi_options['last_text'] = ('Last Page');
	    $pagenavi_options['next_text'] = __("Next <i class='fa-angle-right'></i>", "swiftframework");
	    $pagenavi_options['prev_text'] = __("<i class='fa-angle-left'></i> Previous", "swiftframework");
	    $pagenavi_options['dotright_text'] = '...';
	    $pagenavi_options['dotleft_text'] = '...';
	    $pagenavi_options['num_pages'] = 5; //continuous block of page numbers
	    $pagenavi_options['always_show'] = 0;
	    $pagenavi_options['num_larger_page_numbers'] = 0;
	    $pagenavi_options['larger_page_numbers_multiple'] = 5;
	 
	 	$output = "";
	 	
	    //If NOT a single Post is being displayed
	    /*http://codex.wordpress.org/Function_Reference/is_single)*/
	    if (!is_single()) {
	        $request = $query->request;
	        //intval — Get the integer value of a variable
	        /*http://php.net/manual/en/function.intval.php*/
	        $posts_per_page = intval(get_query_var('posts_per_page'));
	        //Retrieve variable in the WP_Query class.
	        /*http://codex.wordpress.org/Function_Reference/get_query_var*/
	        if ( get_query_var('paged') ) {
	        $paged = get_query_var('paged');
	        } elseif ( get_query_var('page') ) {
	        $paged = get_query_var('page');
	        } else {
	        $paged = 1;
	        }
	        $numposts = $query->found_posts;
	        $max_page = $query->max_num_pages;
	 
	        //empty — Determine whether a variable is empty
	        /*http://php.net/manual/en/function.empty.php*/
	        if(empty($paged) || $paged == 0) {
	            $paged = 1;
	        }
	 
	        $pages_to_show = intval($pagenavi_options['num_pages']);
	        $larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
	        $larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
	        $pages_to_show_minus_1 = $pages_to_show - 1;
	        $half_page_start = floor($pages_to_show_minus_1/2);
	        //ceil — Round fractions up (http://us2.php.net/manual/en/function.ceil.php)
	        $half_page_end = ceil($pages_to_show_minus_1/2);
	        $start_page = $paged - $half_page_start;
	 
	        if($start_page <= 0) {
	            $start_page = 1;
	        }
	 
	        $end_page = $paged + $half_page_end;
	        if(($end_page - $start_page) != $pages_to_show_minus_1) {
	            $end_page = $start_page + $pages_to_show_minus_1;
	        }
	        if($end_page > $max_page) {
	            $start_page = $max_page - $pages_to_show_minus_1;
	            $end_page = $max_page;
	        }
	        if($start_page <= 0) {
	            $start_page = 1;
	        }
	 
	        $larger_per_page = $larger_page_to_show*$larger_page_multiple;
	        //round_num() custom function - Rounds To The Nearest Value.
	        $larger_start_page_start = (round_num($start_page, 10) + $larger_page_multiple) - $larger_per_page;
	        $larger_start_page_end = round_num($start_page, 10) + $larger_page_multiple;
	        $larger_end_page_start = round_num($end_page, 10) + $larger_page_multiple;
	        $larger_end_page_end = round_num($end_page, 10) + ($larger_per_page);
	 
	        if($larger_start_page_end - $larger_page_multiple == $start_page) {
	            $larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
	            $larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
	        }
	        if($larger_start_page_start <= 0) {
	            $larger_start_page_start = $larger_page_multiple;
	        }
	        if($larger_start_page_end > $max_page) {
	            $larger_start_page_end = $max_page;
	        }
	        if($larger_end_page_end > $max_page) {
	            $larger_end_page_end = $max_page;
	        }
	        if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
	            /*http://php.net/manual/en/function.str-replace.php */
	            /*number_format_i18n(): Converts integer number to format based on locale (wp-includes/functions.php*/
	            $pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
	            $pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
	            $output .= $before.'<ul class="pagenavi">'."\n";
	 
	            if(!empty($pages_text)) {
	                $output .= '<li><span class="pages">'.$pages_text.'</span></li>';
	            }
	            //Displays a link to the previous post which exists in chronological order from the current post.
	            /*http://codex.wordpress.org/Function_Reference/previous_post_link*/
	            if ($paged > 1) {
	            $output .= '<li class="prev">' . get_previous_posts_link($pagenavi_options['prev_text']) . '</li>';
	 			}
	 			
	            if ($start_page >= 2 && $pages_to_show < $max_page) {
	                $first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
	                //esc_url(): Encodes < > & " ' (less than, greater than, ampersand, double quote, single quote).
	                /*http://codex.wordpress.org/Data_Validation*/
	                //get_pagenum_link():(wp-includes/link-template.php)-Retrieve get links for page numbers.
	                $output .= '<li><a href="'.esc_url(get_pagenum_link()).'" class="first" title="'.$first_page_text.'">1</a></li>';
	                if(!empty($pagenavi_options['dotleft_text'])) {
	                    $output .= '<li><span class="expand">'.$pagenavi_options['dotleft_text'].'</span></li>';
	                }
	            }
	 
	            if($larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page) {
	                for($i = $larger_start_page_start; $i < $larger_start_page_end; $i+=$larger_page_multiple) {
	                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
	                    $output .= '<li><a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a></li>';
	                }
	            }
	 
	            for($i = $start_page; $i  <= $end_page; $i++) {
	                if($i == $paged) {
	                    $current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
	                    $output .= '<li><span class="current">'.$current_page_text.'</span></li>';
	                } else {
	                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
	                    $output .= '<li><a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a></li>';
	                }
	            }
	 
	            if ($end_page < $max_page) {
	                if(!empty($pagenavi_options['dotright_text'])) {
	                    $output .= '<li><span class="expand">'.$pagenavi_options['dotright_text'].'</span></li>';
	                }
	                $last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
	                $output .= '<li><a href="'.esc_url(get_pagenum_link($max_page)).'" class="last" title="'.$last_page_text.'">'.$max_page.'</a></li>';
	            }
	            $output .= '<li class="next">' . get_next_posts_link($pagenavi_options['next_text'], $max_page) . '</li>';
	 
	            if($larger_page_to_show > 0 && $larger_end_page_start < $max_page) {
	                for($i = $larger_end_page_start; $i <= $larger_end_page_end; $i+=$larger_page_multiple) {
	                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
	                    $output .= '<li><a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a></li>';
	                }
	            }
	            $output .= '</ul>'.$after."\n";
	        }
	    }
	    
	    return $output;
	}	
	
	/* SHORTCODE GENERATOR SETUP
    ================================================== */
    
    // Create TinyMCE's editor button & plugin for Swift Framework Shortcodes
    add_action('init', 'sf_sc_button'); 
    
    function sf_sc_button() {  
       if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
       {  
         add_filter('mce_external_plugins', 'add_tinymce_plugin');  
         add_filter('mce_buttons', 'register_button');  
       }  
    } 
    
    function register_button($button) {  
        array_push($button, 'separator', 'swiftframework_shortcodes' );  
        return $button;  
    }
    
    function add_tinymce_plugin($plugins) {  
        $plugins['swiftframework_shortcodes'] = get_template_directory_uri() . '/includes/swift-framework/sf-shortcodes/tinymce.editor.plugin.js';  
        return $plugins;  
    } 
    
    function sf_custom_mce_styles( $args ) {
                
        $style_formats = array (
            array( 'title' => 'Impact Text', 'selector' => 'p', 'classes' => 'impact-text' ),
        );
        
        $args['style_formats'] = json_encode( $style_formats );
        
        return $args;
    }
     
    add_filter('tiny_mce_before_init', 'sf_custom_mce_styles');
    
    function sf_mce_add_buttons( $buttons ){
        array_splice( $buttons, 1, 0, 'styleselect' );
        return $buttons;
    }
    add_filter( 'mce_buttons_2', 'sf_mce_add_buttons' );
    
    function sf_add_editor_styles() {
        add_editor_style( '/css/editor-style.css' );
    }
    add_action( 'init', 'sf_add_editor_styles' );

?>
