<?php
	
	/* ==================================================
	
	Swift Framework Main Functions
	
	================================================== */
	
	define('SF_TEMPLATE_PATH', get_template_directory());
	define('SF_INCLUDES_PATH', SF_TEMPLATE_PATH . '/includes');
	define('SF_WIDGETS_PATH', SF_INCLUDES_PATH . '/widgets');
	define('SF_LOCAL_PATH', get_template_directory_uri());
	
	
	/* INCLUDES
	================================================== */
	
	/* Add custom post types */
	require_once(SF_INCLUDES_PATH . '/custom-post-types/portfolio-type.php');
	require_once(SF_INCLUDES_PATH . '/custom-post-types/team-type.php');
	require_once(SF_INCLUDES_PATH . '/custom-post-types/clients-type.php');
	require_once(SF_INCLUDES_PATH . '/custom-post-types/testimonials-type.php');
	require_once(SF_INCLUDES_PATH . '/custom-post-types/jobs-type.php');
	require_once(SF_INCLUDES_PATH . '/custom-post-types/faqs-type.php');
	
	/* Add image resizer */
	require_once(SF_INCLUDES_PATH . '/plugins/aq_resizer.php');
	
	/* Include page builder */
	if (!class_exists('Vc_Manager')) {
	include(SF_INCLUDES_PATH . '/page-builder/swift-page-builder.php');
	}
	
	/* Add meta boxes */
	include(SF_INCLUDES_PATH . '/meta-box/meta-box.php');
	include(SF_INCLUDES_PATH . '/meta-boxes.php');
	
	/* Add taxonomy meta boxes */
	require_once(SF_INCLUDES_PATH . '/taxonomy-meta-class/Tax-meta-class.php');
	
	/* Add shortcodes */
	include(SF_INCLUDES_PATH . '/shortcodes.php');
	
	/* Add Custom Styles */
	include(SF_INCLUDES_PATH . '/sf-custom-styles.php');
	
	/* Add Content Display Functions */
	include(SF_INCLUDES_PATH . '/sf-content-display/sf-template-parts.php');
	include(SF_INCLUDES_PATH . '/sf-content-display/sf-post-formats.php');
	
	/* Include plugins */
	include(SF_INCLUDES_PATH . '/plugin-includes.php');	
	include(SF_INCLUDES_PATH . '/plugins/love-it-pro/love-it-pro.php');
	
	/* Include widgets */
	include(SF_WIDGETS_PATH . '/widget-flickr.php');
	include(SF_WIDGETS_PATH . '/widget-video.php');
	include(SF_WIDGETS_PATH . '/widget-posts.php');
	include(SF_WIDGETS_PATH . '/widget-portfolio.php');
	include(SF_WIDGETS_PATH . '/widget-portfolio-grid.php');
	include(SF_WIDGETS_PATH . '/widget-advertgrid.php');
	include(SF_WIDGETS_PATH . '/widget-infocus.php');
	
	/* Include theme updater */
	require_once(SF_INCLUDES_PATH . '/theme_update_check.php');
	$FlexformUpdateChecker = new ThemeUpdateChecker(
	    'flexform',
	    'https://kernl.us/api/v1/theme-updates/56699e21c965b8ee77f02604/'
	);	
	
	/* THEME OPTIONS FRAMEWORK
	================================================== */  
	
	require_once (SF_INCLUDES_PATH . '/sf-options.php');
	
	
	/* CUSTOMIZER OPTIONS
	================================================== */ 
	
	require_once (SF_INCLUDES_PATH . '/sf-customizer-options.php');
	

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
		
		$options = get_option('sf_flexform_options');
		$enable_responsive = $options['enable_responsive'];		
	
	    wp_register_style('bootstrap', SF_LOCAL_PATH . '/css/bootstrap.min.css', array(), NULL, 'screen');  
	    wp_register_style('bootstrap-responsive', SF_LOCAL_PATH . '/css/bootstrap-responsive.min.css', array(), NULL, 'screen');  
	    wp_register_style('fontawesome-css', '//netdna.bootstrapcdn.com/font-awesome/3.2.0/css/font-awesome.min.css', array(), NULL, 'screen');  
	    wp_register_style('main-css', get_stylesheet_directory_uri() . '/style.css', array(), NULL, 'screen');  
	    wp_register_style('responsive-css', SF_LOCAL_PATH . '/css/responsive.css', array(), NULL, 'screen');  
	
	    wp_enqueue_style('bootstrap');  
	    wp_enqueue_style('bootstrap-responsive');  
	    wp_enqueue_style('fontawesome-css'); 
	    wp_enqueue_style('main-css');  
	    
	    if ($enable_responsive) {
	    	wp_enqueue_style('responsive-css');  
	    }
	
	}
	
	add_action('wp_enqueue_scripts', 'sf_enqueue_styles');  
	
	function sf_enqueue_scripts() {
	    
	    wp_register_script('sf-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery', NULL, TRUE);
	    wp_register_script('sf-flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', 'jquery', NULL, TRUE);
	    wp_register_script('sf-isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', 'jquery', NULL, TRUE);
	    wp_register_script('sf-hoverIntent', get_template_directory_uri() . '/js/jquery.hoverIntent.min.js', 'jquery', NULL, TRUE);
	    wp_register_script('sf-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', 'jquery', NULL, TRUE);
	    wp_register_script('sf-carouFredSel', get_template_directory_uri() . '/js/jquery.carouFredSel-6.2.0-packed.js', 'jquery', NULL, TRUE); 
		wp_register_script('sf-prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', 'jquery', NULL, TRUE);
		wp_register_script('sf-viewjs', get_template_directory_uri() . '/js/view.min.js?auto', 'jquery', NULL, TRUE);
	    wp_register_script('sf-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', 'jquery', NULL , TRUE);
	    wp_register_script('sf-maps', '//maps.google.com/maps/api/js?sensor=false', 'jquery', NULL, TRUE);
	    wp_register_script('sf-respond', get_template_directory_uri() . '/js/respond.min.js', 'jquery', NULL, TRUE);
	    wp_register_script('sf-twitter-widgets', '//platform.twitter.com/widgets.js', NULL, NULL, TRUE);
	    wp_register_script('sf-functions', get_template_directory_uri() . '/js/functions.js', 'jquery', NULL, TRUE);
		
	    wp_enqueue_script('jquery');
		wp_enqueue_script('sf-bootstrap-js');
		wp_enqueue_script('sf-hoverIntent');
		wp_enqueue_script('sf-easing');
	    wp_enqueue_script('sf-flexslider');
	    wp_enqueue_script('sf-prettyPhoto');
	    wp_enqueue_script('sf-fitvids');
	    
	    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	    	if (!is_account_page()) {
	    		wp_enqueue_script('sf-viewjs');
	    	}
	    } else {
	    	wp_enqueue_script('sf-viewjs');
	    }
	    	    
	    if (!is_admin()) {
	    	wp_enqueue_script('sf-functions');
	    }
	    
	    if (is_singular()) {
	    	wp_enqueue_script('comment-reply');
	    }
	    
	    global $is_IE;
	    
	    if ( $is_IE ) {
	   		wp_enqueue_script('sf-respond');
		}
	}
	
	add_action('wp_enqueue_scripts', 'sf_enqueue_scripts');
	
	function sf_admin_scripts() {
	    wp_register_script('admin-functions', get_template_directory_uri() . '/js/sf-admin.js', 'jquery', '1.0', TRUE);
		wp_enqueue_script('admin-functions');
	}
	add_action('admin_init', 'sf_admin_scripts');
	
	
	function sf_load_custom_script() {
		global $include_maps, $include_isotope, $include_carousel;
		
		if ($include_maps) {
			wp_print_scripts('sf-maps');
		}
		
		if ($include_isotope) {
			wp_print_scripts('sf-isotope');
		}
		
		if ($include_carousel) {
			wp_print_scripts('sf-carouFredSel');
		}
		
		$options = get_option('sf_flexform_options');
				
	}
	
	add_action('wp_footer', 'sf_load_custom_script');
	
	
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
	
	function sf_maintenance_mode() {
		
		$options = get_option('sf_flexform_options');
		$custom_logo = $custom_logo_output = $maintenance_mode = "";
		if (isset($options['custom_admin_login_logo'])) {
		$custom_logo = $options['custom_admin_login_logo'];
		}
		if ($custom_logo) {		
		$custom_logo_output = '<img src="'. $custom_logo .'" alt="maintenance" style="margin: 0 auto; display: block;" />';
		} else {
		$custom_logo_output = '<img src="'. get_template_directory_uri() .'/images/custom-login-logo.png" alt="maintenance" style="margin: 0 auto; display: block;" />';
		}

		if (isset($options['enable_maintenance'])) {
		$maintenance_mode = $options['enable_maintenance'];
		} else {
		$maintenance_mode = false;
		}
		
		if ($maintenance_mode) {
		
		    if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) {
		        wp_die($custom_logo_output . '<p style="text-align:center">We are currently in maintenance mode, please check back shortly.</p>');
		    }
	    
	    }
	}
	add_action('get_header', 'sf_maintenance_mode');
	
	
	/* WOOCOMMERCE FILTER HOOKS
	================================================== */
		
	/************************************************
	*	WooCommerce Functions		       	     	* 
	/************************************************/
	
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);
	 
	function my_theme_wrapper_start() {
	  echo '<div class="page-content clearfix">';
	}
	 
	function my_theme_wrapper_end() {
	  echo '</div>';
	}
	add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
	 
	function woocommerce_header_add_to_cart_fragment( $fragments ) {
		global $woocommerce;
		
		ob_start();
		
		?>
		<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
		<?php
		
		$fragments['a.cart-contents'] = ob_get_clean();
		
		return $fragments;
		
	}
	
	
	/* CUSTOM ADMIN MENU ITEMS
	================================================== */
	
	if(!function_exists('sf_admin_bar_menu')) {
				
		function sf_admin_bar_menu() {
		
			global $wp_admin_bar;
			
			if ( current_user_can( 'manage_options' ) ) {
			
				$theme_options = array(
					'id' => '1',
					'title' => __('Theme Options'),
					'href' => admin_url('/admin.php?page=sf_theme_options'),
					'meta' => array('target' => 'blank')
				);
				
				$wp_admin_bar->add_menu($theme_options);
				
				$theme_customizer = array(
					'id' => '2',
					'title' => __('Color Customizer'),
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
	 		$options = get_option('sf_flexform_options');
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
	        /* RWMB */
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
			<?php
				echo "\n".'/*========== Asset Background Styles ==========*/'."\n";
				echo '.alt-bg {border-color: '.$section_divide_color.';}'. "\n";
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
				echo '.alt-ten {color: '.$alt_ten_text_color.';}'. "\n";
				echo '.alt-ten.full-width-text:after {border-top-color:'.$alt_ten_bg_color.';}'. "\n";
			?>
		</style>
	
	<?php }
	
	
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
	
		
	/* SHORTCODE PANEL SETUP
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
	    $plugins['swiftframework_shortcodes'] = get_template_directory_uri() . '/includes/sf_shortcodes/tinymce.editor.plugin.js';  
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
	

	/* WORDPRESS GALLERY MODS
	================================================== */
	
	add_filter( 'wp_get_attachment_link', 'sant_lightboxadd');
	 
	function sant_lightboxadd($content) {
	    $content = preg_replace("/<a/","<a class=\"view\" rel='gallery'",$content,1);
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
		
	
	/* WORDPRESS ADD CUSTOM POST TYPES TO ARCHIVE PAGE
	================================================== */
	function sf_add_cpt_tags_to_archive($query) {
		 if ( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
			 
			 // Get all your post types
			 $post_types = get_post_types();
			 
			 $query->set( 'post_type', $post_types );
			 
			 return $query;
		 }
	}
	add_filter('pre_get_posts', 'sf_add_cpt_tags_to_archive');
	
	
	/* SUBSCRIBER WIDGET FUNCTIONS
	================================================== */
	
	function get_twitter_follower_count($username) {
		$count = get_transient('follower_count');
		if ($count !== false) return $count;
		$count = 0;
		$data = wp_remote_get('http://api.twitter.com/1/users/show.json?screen_name=' . $username);
		if (!is_wp_error($data)) {
		$value = json_decode($data['body'],true);
		$count = $value['followers_count'];
		}
		set_transient('follower_count', $count, 60*60*6); // 6 hour cache
		$formatted_count = sf_social_number_format($count);
		return $formatted_count;
	}
	
	function get_facebook_fan_count($facebookID) {
		$count = get_transient('fan_count');
	    if ($count !== false) return $count;
	    $count = 0;
	    $data = wp_remote_get('http://api.facebook.com/restserver.php?method=facebook.fql.query&query=SELECT%20fan_count%20FROM%20page%20WHERE%20page_id='.$facebookID.'');
		if (is_wp_error($data)) {
		     return 'X';
		}else{
		     $count = strip_tags($data['body']);
		}
		set_transient('fan_count', $count, 60*60*6); // 12 hour cache
		$formatted_count = sf_social_number_format($count);
		return $formatted_count;
	}
	
	function get_youtube_subscriber_count($youtubeID) {		
		$subs_record = 'ytsubs_' . '_' . $youtubeID. '_' . 60 * 60 * 6;
		$cached = get_transient($subs_record);
		
		if ($cached !== false) {
			return $cached;
		} else {
			$xdoc = new DomDocument;
			$xdoc->Load("http://gdata.youtube.com/feeds/api/users/$youtubeID");
			$youtubeStats = $xdoc->getElementsByTagName('statistics')->item(0);
			$return = $youtubeStats->getAttribute('subscriberCount');
			$count = number_format($return);
			set_transient($subs_record, $count, 60 * 60 * 6); 
		}
		$formatted_count = sf_social_number_format($count);
		return $formatted_count;
	}
	
	function sf_social_number_format($number) {
        // first strip any formatting;
        $number = (0+str_replace(",","",$number));

        // is this a number?
        if(!is_numeric($number)) return false;

        // now filter it;
        if($number>1000000) return round(($number/1000000),2).'m';
        else if($number>1000) return round(($number/1000),2).'k';

        return number_format($number);
    }
	
	
	/* GET CUSTOM POST TYPE TAXONOMY LIST
	================================================== */

	function get_category_list( $category_name, $filter=0, $category_child = "" ){
		
		if (!$filter) { 
		
			$get_category = get_categories( array( 'taxonomy' => $category_name	));
			$category_list = array( '0' => 'All');
			
			foreach( $get_category as $category ){
				$category_list[] = $category->slug;
			}
				
			return $category_list;
		
        } else if ( $category_child != "" && $category_child != "All" ) {

            $childcategory = get_term_by( 'slug', $category_child, $category_name );
            $get_category  = get_categories( array(
                    'taxonomy' => $category_name,
                    'child_of' => $childcategory->term_id
                ) );
            $category_list = array( '0' => 'All' );

            foreach ( $get_category as $category ) {
                if ( isset( $category->cat_name ) ) {
                    $category_list[] = $category->cat_name;
                }
            }

            return $category_list;
		
		} else {
			
			$get_category = get_categories( array( 'taxonomy' => $category_name	));
			$category_list = array( '0' => 'All');
			
			foreach( $get_category as $category ){
				$category_list[] = $category->cat_name;
			}
				
			return $category_list;	
		
		}
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
		
		return '<iframe src="http://www.youtube.com/embed/'. $video_id[1] .'?wmode=transparent" allowfullscreen width="'. $width .'" height="'. $height .'" ></iframe>';
				
	}
	
	function video_vimeo($url, $width = 640, $height = 480){
	
		preg_match('/http:\/\/vimeo.com\/(\d+)$/', $url, $video_id);		
		
		return '<iframe src="http://player.vimeo.com/video/'. $video_id[1] .'?title=0&amp;byline=0&amp;portrait=0?wmode=transparent" width="'. $width .'" height="'. $height .'"></iframe>';
		
	}
	
	/* SWIFT SLIDER FUNCTIONS
	================================================== */
	
	function get_posts_slider() {
		
		global $post, $wp_query;
		
		$output = '';
		
		$options = get_option('sf_flexform_options');
		$posts_slider_type = get_post_meta($post->ID, 'sf_posts_slider_type', true);
		$posts_category = get_post_meta($post->ID, 'sf_posts_slider_category', true);
		$portfolio_category = get_post_meta($post->ID, 'sf_posts_slider_portfolio_category', true);
		$count = get_post_meta($post->ID, 'sf_posts_slider_count', true);
		
		$args = array();
		
		if ($posts_slider_type == "post") {
			$category_list = get_category_list('category');
			$slider_category = $category_list[$posts_category];
			if ($slider_category == "All") {$slider_category = "all";}
			if ($slider_category == "all") {$slider_category = '';}
			$category_slug = str_replace('_', '-', $slider_category);
			$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'category_name' => $category_slug,
				'posts_per_page' => $count
				);
		} else if ($posts_slider_type == "hybrid") {
			$args = array(
				'post_type' => array( 'post', 'portfolio'),
				'post_status' => 'publish',
				'posts_per_page' => $count
				);		
		} else {
			$category_list = get_category_list('portfolio-category');
			$slider_category = $category_list[$portfolio_category];
			if ($slider_category == "All") {$slider_category = "all";}
			if ($slider_category == "all") {$slider_category = '';}
			$category_slug = str_replace('_', '-', $slider_category);
			$args = array(
				'post_type' => 'portfolio',
				'post_status' => 'publish',
				'portfolio-category' => $category_slug,
				'posts_per_page' => $count
				);
		}
			
		$slider_items = new WP_Query( $args );
				
		if( $slider_items->have_posts() ) {
			
			$output .= '<!--// SWIFT SLIDER //-->'. "\n";
			$output .= '<div id="swift-slider" class="flexslider">'. "\n";
			$output .= '<div class="swift-slider-loading"></div>'. "\n";
			$output .= '<ul class="slides">'. "\n";
					
			while ( $slider_items->have_posts() ) : $slider_items->the_post();
				
   				$post_title = get_the_title();
				$post_permalink = get_permalink();
				$post_author = get_the_author_link();
				$post_date = get_the_date();
				$post_client = get_post_meta($post->ID, 'sf_portfolio_client', true);
				$post_categories = get_the_category_list(', ');
				if ($posts_slider_type == "portfolio") {
				$post_categories = get_the_term_list($post->ID, 'portfolio-category', '', ', ');
				}
				$post_comments = get_comments_number();
				$custom_excerpt = get_post_meta($post->ID, 'sf_custom_excerpt', true);
				$post_excerpt = '';
				if ($custom_excerpt != '') {
				$post_excerpt = custom_excerpt($custom_excerpt, 20);
				} else {
				$post_excerpt = excerpt(20);
				}
				$posts_slider_image = rwmb_meta('sf_posts_slider_image', 'type=image&size=full');
				$caption_position = get_post_meta($post->ID, 'sf_caption_position', true);
				
				$accent_color = get_option('accent_color', '#fb3c2d');
				$secondary_accent_color = get_option('secondary_accent_color', '#2e2e36');
				$secondary_accent_alt_color = get_option('secondary_accent_alt_color', '#ffffff');
				
				$media_image_url = "";
				
				foreach ($posts_slider_image as $detail_image) {
					$media_image_url = $detail_image['url'];
					break;
				}
												
				if (!$posts_slider_image) {
					$posts_slider_image = get_post_thumbnail_id();
					$media_image_url = wp_get_attachment_url( $posts_slider_image, 'full' );
				}
				
				
				if (!$caption_position) { $caption_position = "caption-right"; }
				
				$image = aq_resize( $media_image_url, 1920, NULL, true, false);
						  
				$output .= '<li>'. "\n";
				$output .= '<div class="slide-caption-container">'. "\n";
				if ($image) {
					$output .= '<div class="flex-caption '.$caption_position.'">'. "\n";
					$output .= '<div class="flex-caption-details">'. "\n";
					$output .= '<div class="caption-details-inner">'. "\n";
					$output .= '<div class="details clearfix">'. "\n";
					$output .= '<span class="date">'.$post_date.'</span>'. "\n";
					if ($post_client != "") {
					$output .= '<span class="item-client">'.__("Client: ", "swiftframework").$post_client.'</span>'. "\n";
					$output .= '<span class="item-categories">'.$post_categories.'</span>'. "\n";
					} else {
					$output .= '<span class="item-author">'.__("Posted by ", "swiftframework").$post_author.'</span>'. "\n";
					$output .= '<span class="item-categories">'.$post_categories.'</span>'. "\n";
					}
					$output .= '</div>';
					if ( comments_open() ) {
						$output .= '<div class="comment-chart chart" data-percent="1" data-count="'.$post_comments.'" data-barcolor="'.$secondary_accent_color.'"><span>0</span><i class="icon-comments"></i></div>'. "\n";
					}
					if (function_exists( 'lip_get_love_count' )) {
					$output .= '<div class="loveit-chart chart" data-percent="1" data-count="'.lip_get_love_count($post->ID).'" data-barcolor="'.$accent_color.'"><span>0</span><i class="icon-heart"></i></div>'. "\n";
					}
					$output .= '</div>'. "\n";
					$output .= '</div>'. "\n";
					$output .= '<div class="flex-caption-headline clearfix">'. "\n";
					$output .= '<h4><a href="'.$post_permalink.'"><span>'. $post_title .'</span><i class="icon-angle-right"></i></a></h4>'. "\n";
					$output .= '</div></div></div>'. "\n";
					$output .= '<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.$post_title.'" />'. "\n";
				} else {
					$output .= '<div class="flex-caption-large clearfix">'. "\n";
					$output .= '<h1><a href="'.$post_permalink.'">'. $post_title .'</a></h1>'. "\n";
					$output .= '<div class="excerpt">'. $post_excerpt .'</div>'. "\n";
					$output .= '<div class="cl-charts">'. "\n";
					if ( comments_open() ) {
						$output .= '<div class="comment-chart fw-chart chart" data-percent="1" data-count="'.$post_comments.'" data-barcolor="'.$secondary_accent_alt_color.'"><span>0</span><i class="icon-comments"></i></div>'. "\n";
					}
					if (function_exists( 'lip_get_love_count' )) {
					$output .= '<div class="loveit-chart fw-chart chart" data-percent="1" data-count="'.lip_get_love_count($post->ID).'" data-barcolor="'.$accent_color.'"><span>0</span><i class="icon-heart"></i></div>'. "\n";
					}	
					$output .= '</div>'. "\n";
					$output .= '<div class="details clearfix">'. "\n";
					$output .= '<span class="date">'.$post_date.'</span>'. "\n";
					if ($post_client != "") {
					$output .= '<span class="item-client">'.__("Client: ", "swiftframework").$post_client.'</span>'. "\n";
					$output .= '<span class="item-categories">'.$post_categories.'</span>'. "\n";
					} else {
					$output .= '<span class="item-author">'.__("Posted by ", "swiftframework").$post_author.'</span>'. "\n";
					$output .= '<span class="item-categories">'.$post_categories.'</span>'. "\n";
					}
					$output .= '</div></div></div>'. "\n";
				}
				$output .= '</li>'. "\n";
								    						
			endwhile;
			
			wp_reset_postdata();
					
			$output .= '</ul></div>'. "\n";
		}
		
		echo $output;
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
	
	
	/* LANGUAGE FLAGS
	================================================== */
	
	function language_flags() {
		if (function_exists('icl_get_languages')) {
		    $languages = icl_get_languages('skip_missing=0&orderby=code');
		    if(!empty($languages)){
		        foreach($languages as $l){
		            echo '<li>';
		            if($l['country_flag_url']){
		                if(!$l['active']) {
		                	echo '<a href="'.$l['url'].'"><img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" /><span class="language name">'.$l['translated_name'].'</span></a>'."\n";
		                } else {
		                	echo '<div class="current-language"><img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" /><span class="language name">'.$l['translated_name'].'</span></div>'."\n";
		                }
		            }
		            echo '</li>';
		        }
		    }
	    } else {
	    	//echo '<li><div>No languages set.</div></li>';
	    	$flags_url = get_template_directory_uri() . '/images/flags';
	    	echo '<li><a href="#">DEMO - EXAMPLE PURPOSES</a><li><a href="#"><img src="'.$flags_url.'/de.png" height="12" alt="de" width="18"><span class="language name">German</span></a></li><li><div class="current-language"><img src="'.$flags_url.'/en.png" height="12" alt="en" width="18"><span class="language name">English</span></div></li><li><a href="#"><img src="'.$flags_url.'/es.png" height="12" alt="es" width="18"><span class="language name">Spanish</span></a></li><li><a href="#"><img src="'.$flags_url.'/fr.png" height="12" alt="fr" width="18"><span class="language name">French</span></a></li>'."\n";
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
				                    '<a href="https://twitter.com/search?q=%23'.$hashtag['text'].'&src=hash" target="_blank">#'.$hashtag['text'].'</a>',
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
				        $content .= '<a class="reply" href="https://twitter.com/intent/tweet?in_reply_to='.$tweet['id_str'].'"><i class="icon-reply"></i></a>'. "\n";
				        $content .= '<a class="retweet" href="https://twitter.com/intent/retweet?tweet_id='.$tweet['id_str'].'"><i class="icon-retweet"></i></a>'. "\n";
				        $content .= '<a class="favorite" href="https://twitter.com/intent/favorite?tweet_id='.$tweet['id_str'].'"><i class="icon-star"></i></a>'. "\n";
				        
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
	        $template_name = get_post_meta( $item->object_id, '_wp_page_template', true );
	        $new_class =str_replace(".php","",$template_name);
	        array_push($classes, $new_class);
	    }   
	    return $classes;
	}
	add_filter('nav_menu_css_class', 'current_type_nav_class', 10, 2 );
	function current_type_nav_class($classes, $item) {
	    $post_type = get_query_var('post_type');
	    if ($item->attr_title != '' && $item->attr_title == $post_type) {
	        array_push($classes, 'current-menu-item');
	    };
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
	
	if ( function_exists('register_sidebar')) {
	
		$options = get_option('sf_flexform_options');
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
	        'before_title' => '<div class="widget-heading clearfix"><h4>',
	        'after_title' => '</h4></div>',
	    ));
	    register_sidebar(array(
	    	'id' => 'sidebar-2',
	        'name' => 'Sidebar Two',
	        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
	        'after_widget' => '</section>',
	        'before_title' => '<div class="widget-heading clearfix"><h4>',
	        'after_title' => '</h4></div>',
	    ));
		register_sidebar(array(
			'id' => 'sidebar-3',
			'name' => 'Sidebar Three',
			'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
			'after_widget' => '</section>',
			'before_title' => '<div class="widget-heading clearfix"><h4>',
			'after_title' => '</h4></div>',
		));
		register_sidebar(array(
			'id' => 'sidebar-4',
			'name' => 'Sidebar Four',
			'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
			'after_widget' => '</section>',
			'before_title' => '<div class="widget-heading clearfix"><h4>',
			'after_title' => '</h4></div>',
		));
		register_sidebar(array(
			'id' => 'sidebar-5',
		    'name' => 'Sidebar Five',
		    'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		    'after_widget' => '</section>',
		    'before_title' => '<div class="widget-heading clearfix"><h4>',
		    'after_title' => '</h4></div>',
		));
		register_sidebar(array(
			'id' => 'sidebar-6',
		    'name' => 'Sidebar Six',
		    'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		    'after_widget' => '</section>',
		    'before_title' => '<div class="widget-heading clearfix"><h4>',
		    'after_title' => '</h4></div>',
		));
		register_sidebar(array(
			'id' => 'sidebar-7',
			'name' => 'Sidebar Seven',
			'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
			'after_widget' => '</section>',
			'before_title' => '<div class="widget-heading clearfix"><h4>',
			'after_title' => '</h4></div>',
		));
		register_sidebar(array(
			'id' => 'sidebar-8',
			'name' => 'Sidebar Eight',
			'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
			'after_widget' => '</section>',
			'before_title' => '<div class="widget-heading clearfix"><h4>',
			'after_title' => '</h4></div>',
		));
	    register_sidebar(array(
	    	'id' => 'sidebar-9',
	        'name' => 'Footer Column 1',
	        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
	        'after_widget' => '</section>',
	        'before_title' => '<div class="widget-heading clearfix"><h5>',
	        'after_title' => '</h5></div>',
	    ));
	    if ($footer_config != "footer-9") {
	    register_sidebar(array(
	    	'id' => 'sidebar-10',
	        'name' => 'Footer Column 2',
	        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
	        'after_widget' => '</section>',
	        'before_title' => '<div class="widget-heading clearfix"><h5>',
	        'after_title' => '</h5></div>',
	    ));
	    register_sidebar(array(
	    	'id' => 'sidebar-11',
	        'name' => 'Footer Column 3',
	        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
	        'after_widget' => '</section>',
	        'before_title' => '<div class="widget-heading clearfix"><h5>',
	        'after_title' => '</h5></div>',
	    ));
	    if ($footer_config == "footer-1") {
	    register_sidebar(array(
	    	'id' => 'sidebar-12',
	        'name' => 'Footer Column 4',
	        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
	        'after_widget' => '</section>',
	        'before_title' => '<div class="widget-heading clearfix"><h5>',
	        'after_title' => '</h5></div>',
	    ));
	    }
	    }
	    register_sidebar(array(
	        'id' => 'woocommerce-sidebar',
	        'name' => 'WooCommerce Sidebar',
	        'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
	        'after_widget' => '</section>',
	        'before_title' => '<div class="widget-heading clearfix"><h4>',
	        'after_title' => '</h4></div>',
	    ));
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
	
	
	/* ADD TITLE BACK TO ATTACHMENT
	================================================== */
	function add_title_to_attachment_image( $attr, $attachment ) {
	    $attr['title'] = esc_attr( $attachment->post_title );
	    return $attr;
	}
	add_filter( 'wp_get_attachment_image_attributes', 'add_title_to_attachment_image', 10, 2 );
	
	
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
		$options = get_option('sf_flexform_options');
		$custom_logo = "";
		if (isset($options['custom_admin_login_logo'])) {
		$custom_logo = $options['custom_admin_login_logo'];
		}
		if ($custom_logo) {		
		echo '<style type="text/css">
		    .login h1 a { background-image:url('. $custom_logo .') !important; height: 95px!important; width: 100%!important; background-size: auto; }
		</style>';
		} else {
		echo '<style type="text/css">
		    .login h1 a { background-image:url('. get_template_directory_uri() .'/images/custom-login-logo.png) !important; height: 95px!important; width: 100%!important; background-size: auto; }
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
	    $pagenavi_options['next_text'] = __("Next <i class='icon-angle-right'></i>", "swiftframework");
	    $pagenavi_options['prev_text'] = __("<i class='icon-angle-left'></i> Previous", "swiftframework");
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
	        if($max_page > 1) {
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
	
?>