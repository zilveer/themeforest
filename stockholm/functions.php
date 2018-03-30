<?php
//$qode_toolbar = true;
//$qode_landing = true;

load_theme_textdomain( 'qode', get_template_directory().'/languages' );

if(isset($qode_toolbar)) {
	add_action('after_setup_theme', 'qodeStartSession', 1);
	add_action('wp_logout', 'qodeEndSession');
	add_action('wp_login', 'qodeEndSession');

	/* Start session */
	if (!function_exists('qodeStartSession')) {
		function qodeStartSession() {
			if(!session_id()) {
				session_start();
			}
			if (!empty($_GET['animation']))
				$_SESSION['qode_animation'] = $_GET['animation'];
			if (isset($_SESSION['qode_animation']))
				if ($_SESSION['qode_animation'] == "off")
					$_SESSION['qode_animation'] = "";
		}}

	/* End session */

	if (!function_exists('qodeEndSession')) {
		function qodeEndSession() {
			session_destroy ();
		}
	}
}

add_filter('widget_text', 'do_shortcode');

define('QODE_ROOT', get_template_directory_uri());
define('QODE_VAR_PREFIX', 'qode_');
include_once('framework/qode-framework.php');
include_once('includes/shortcodes/shortcodes.php');
include_once('includes/import/qode-import.php');
//include_once('export/qode-export.php');
include_once('includes/custom-fields-post-formats.php');
include_once('includes/qode-breadcrumbs.php');
include_once('includes/nav_menu/qode-menu.php');
include_once('includes/sidebar/qode-custom-sidebar.php');
include_once('includes/qode-custom-post-types.php');
include_once('includes/qode-like.php' );
include_once('includes/qode-custom-taxonomy-field.php');
include_once('includes/header/qode-header-functions.php');
include_once('includes/title/qode-title-functions.php');
include_once('includes/qode-portfolio-functions.php');
include_once('includes/qode-product-list.php');
include_once('includes/qode-loading-spinners.php');
/* Include comment functionality */
include_once('includes/comment/comment.php');
/* Include sidebar functionality */
include_once('includes/sidebar/sidebar.php');
/* Include pagination functionality */
include_once('includes/pagination/pagination.php');
/* Include qode carousel select box for visual composer */
include_once('includes/qode_carousel/qode-carousel.php');
/* Include font awesome icons list */
include_once('includes/font_awesome/font-awesome.php');
include_once('includes/elegant_icons/elegant-icons.php');
include_once('includes/linear_icons/linear-icons.php');
/** Include the TGM_Plugin_Activation class. */
require_once dirname( __FILE__ ) . '/includes/plugins/class-tgm-plugin-activation.php';
/* Include visual composer initialization */
include_once('includes/plugins/visual-composer.php');
/* Include activation for layer slider */
include_once('includes/plugins/layer-slider.php');
/* Include activation for revolution slider */
include_once('includes/plugins/revolution-slider.php');
/* Include activation for envato wordpress toolkit */
include_once('includes/plugins/envato-wordpress-toolkit.php');
/* Include activation for select twitter feed */
include_once('includes/plugins/select-twitter-feed.php');
/* Include activation for select instagram feed */
include_once('includes/plugins/select-instagram-feed.php');
include_once('widgets/call_to_action_widget.php');

//does woocommerce function exists?
if(function_exists("is_woocommerce")){
	//include woocommerce configuration
	require_once( 'woocommerce/woocommerce_configuration.php' );
	//include cart dropdown widget
	include_once('widgets/woocommerce-dropdown-cart.php');
}

add_filter( 'call_to_action_widget', 'do_shortcode');


if (!function_exists('qode_styles')) {
	/**
	 * Function that includes theme's core styles
	 */
	function qode_styles() {
		global $qode_options;
		global $qode_toolbar;
        global $qode_landing;

		//init variables
		$responsiveness = 'yes';
		$vertical_area 	= "no";

		//include theme's core styles
		wp_enqueue_style("qode_default_style", QODE_ROOT . "/style.css");
		wp_enqueue_style("qode_stylesheet", QODE_ROOT . "/css/stylesheet.min.css");

		//define files afer which style dynamic needs to be included. It should be included last so it can override other files
		$style_dynamic_deps_array = array();
		if(qode_is_woocommerce_installed()) {
			$style_dynamic_deps_array = array('qode_woocommerce', 'qode_woocommerce_responsive');
		}

		if (file_exists(dirname(__FILE__) ."/css/style_dynamic.css") && qode_is_css_folder_writable() && !is_multisite()) {
			wp_enqueue_style("qode_style_dynamic", QODE_ROOT . "/css/style_dynamic.css", $style_dynamic_deps_array, filemtime(dirname(__FILE__) ."/css/style_dynamic.css")); //it must be included after woocommerce styles so it can override it
		} else {
			wp_enqueue_style("qode_style_dynamic", QODE_ROOT . "/css/style_dynamic.php", $style_dynamic_deps_array); //it must be included after woocommerce styles so it can override it
		}

		//include font-awesome styles
		wp_enqueue_style("qode_font-awesome", QODE_ROOT . "/css/font-awesome/css/font-awesome.min.css");

		//include elegant font styles
		wp_enqueue_style("qode_elegant-icons", QODE_ROOT . "/css/elegant-icons/style.min.css");

		//include linear-icons styles
		wp_enqueue_style("qode_linear-icons", QODE_ROOT . "/css/linear-icons/style.css");

		//include mediaelement style
		wp_enqueue_style('wp-mediaelement');

		//does responsive option exists?
		if (isset($qode_options['responsiveness'])) {
			$responsiveness = $qode_options['responsiveness'];
		}

		//is responsive option turned on?
		if ($responsiveness != "no") {
			//include proper styles
			wp_enqueue_style("qode_responsive", QODE_ROOT . "/css/responsive.min.css");
			
			if (file_exists(dirname(__FILE__) ."/css/style_dynamic_responsive.css") && qode_is_css_folder_writable() && !is_multisite()){
            	wp_enqueue_style("qode_style_dynamic_responsive", QODE_ROOT . "/css/style_dynamic_responsive.css", array(), filemtime(dirname(__FILE__) ."/css/style_dynamic_responsive.css"));
			} else {
            	wp_enqueue_style("qode_style_dynamic_responsive", QODE_ROOT . "/css/style_dynamic_responsive.php");
			}
		}

		//does left menu option exists?
		if (isset($qode_options['vertical_area'])){
			$vertical_area = $qode_options['vertical_area'];
		}

		//is left menu activated and is responsive turned on?
		if($vertical_area == "yes" && $responsiveness != "no"){
			wp_enqueue_style("qode_vertical_responsive", QODE_ROOT . "/css/vertical_responsive.min.css");
		}

		//is toolbar turned on?
		if (isset($qode_toolbar)) {
			//include toolbar specific styles
			wp_enqueue_style("qode_toolbar", QODE_ROOT . "/css/toolbar.css");
		}

        //is landing turned on?
        if (isset($qode_landing)) {
            //include toolbar specific styles
            wp_enqueue_style("qode_landing_fancybox", get_home_url() . "/demo-files/landing/css/jquery.fancybox.css");
            wp_enqueue_style("qode_landing", get_home_url() . "/demo-files/landing/css/landing_stylesheet_stripped.css");
        }

		//include Visual Composer styles
		if (qode_visual_composer_installed()) {
			wp_enqueue_style( 'js_composer_front' );
		}

		if (file_exists(dirname(__FILE__) ."/css/custom_css.css") && qode_is_css_folder_writable() && !is_multisite()){
        	wp_enqueue_style("qode_custom_css", QODE_ROOT . "/css/custom_css.css", array(), filemtime(dirname(__FILE__) ."/css/custom_css.css"));
		} else {
        	wp_enqueue_style("qode_custom_css", QODE_ROOT . "/css/custom_css.php");
       	}
	}

	add_action('wp_enqueue_scripts', 'qode_styles');
}


if(!function_exists('qode_browser_specific_styles')) {
	/**
	 * Function that includes browser specific styles. Works for Chrome on Mac and for webkit browsers
	 */
	function qode_browser_specific_styles() {
		global $is_chrome;
		global $is_safari;

		//check Chrome version
		preg_match( "#Chrome/(.+?)\.#", $_SERVER['HTTP_USER_AGENT'], $match );
		if(!empty($match)) {
			$chrome_version = $match[1];
		} else{
			$chrome_version = 0;
		}

		//is Mac OS X?
		$mac_os = strpos($_SERVER['HTTP_USER_AGENT'], "Macintosh; Intel Mac OS X");

		//is Chrome on Mac with version greater than 21
		if($is_chrome && ($mac_os !== false) && ($chrome_version > 21)) {
			//include mac specific styles
			wp_enqueue_style("qode_mac_stylesheet", QODE_ROOT . "/css/mac_stylesheet.css");
		}

		//is Chrome or Safari?
		if($is_chrome || $is_safari) {
			//include style for webkit browsers only
			wp_enqueue_style("qode_webkit", QODE_ROOT . "/css/webkit_stylesheet.css");
		}
	}

	add_action('wp_enqueue_scripts', 'qode_browser_specific_styles');
}

/* Page ID */

if(!function_exists('qode_init_page_id')) {
	function qode_init_page_id() {
		global $wp_query;
		global $qode_page_id;

		$qode_page_id = $wp_query->get_queried_object_id();
	}
}

add_action('get_header', 'qode_init_page_id');

if(!function_exists('qode_google_fonts_styles')) {
	/**
	 * Function that includes google fonts defined anywhere in the theme
	 */
	function qode_google_fonts_styles() {
		global $qode_options;
        global $qode_toolbar;

		$font_weight_str = '100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic';
		$available_font_options = array(
			'google_fonts',
			'menu_google_fonts',
			'dropdown_google_fonts',
			'dropdown_wide_google_fonts',
			'dropdown_google_fonts_thirdlvl',
			'fixed_google_fonts',
			'sticky_google_fonts',
			'mobile_google_fonts',
			'h1_google_fonts',
			'h2_google_fonts',
			'h3_google_fonts',
			'h4_google_fonts',
			'h5_google_fonts',
			'h6_google_fonts',
			'text_google_fonts',
			'blockquote_font_family',
			'page_title_google_fonts',
            'page_subtitle_google_fonts',
            'page_breadcrumb_google_fonts',
            'blog_large_image_title_font_family',
            'blog_large_image_ql_title_font_family',
            'blog_masonry_title_font_family',
            'blog_masonry_ql_title_font_family',
            'blog_single_title_font_family',
            'blog_single_ql_title_font_family',
            'blog_list_info_font_family',
            'blog_large_image_ql_author_font_family',
            'blog_masonry_author_font_family',
            'contact_form_heading_font_family',
            'contact_form_section_title_font_family',
            'contact_form_section_subtitle_font_family',
            'pricing_tables_active_text_font_family',
            'pricing_tables_title_font_family',
            'pricing_tables_period_font_family',
            'pricing_tables_price_font_family',
            'pricing_tables_currency_font_family',
            'pricing_tables_button_font_family',
            'message_title_google_fonts',
            'pagination_font_family',
            'button_title_google_fonts',
            'testimonials_text_font_family',
            'testimonials_author_font_family',
            'tabs_nav_font_family',
            'footer_top_text_font_family',
            'footer_top_link_font_family',
            'footer_bottom_text_font_family',
            'footer_bottom_link_font_family',
            'footer_title_font_family',
            'sidebar_title_font_family',
            'sidebar_link_font_family',
            'side_area_title_google_fonts',
            'sidearea_link_font_family',
            'vertical_menu_google_fonts',
            'vertical_dropdown_google_fonts',
            'vertical_dropdown_google_fonts_thirdlvl',
            'popup_menu_google_fonts',
            'popup_menu_google_fonts_2nd',
            'popup_menu_3rd_font_family',
            'portfolio_single_big_title_font_family',
            'portfolio_single_small_title_font_family',
            'portfolio_single_meta_title_font_family',
            'portfolio_single_meta_text_font_family',
            'top_header_text_font_family',
            'portfolio_filter_title_font_family',
            'portfolio_filter_font_family',
            'portfolio_title_standard_list_font_family',
            'portfolio_category_standard_list_font_family',
            'portfolio_title_list_font_family',
            'portfolio_category_list_font_family',
            'expandable_label_font_family',
            '404_title_font_family',
            '404_text_font_family',
            'woo_products_category_font_family',
            'woo_products_title_font_family',
            'woo_products_price_font_family',
            'woo_products_sale_font_family',
            'woo_products_out_of_stock_font_family',
            'woo_products_sorting_result_font_family',
            'woo_products_list_add_to_cart_font_family',
            'woo_product_single_meta_title_font_family',
            'woo_product_single_meta_info_font_family',
            'woo_product_single_title_font_family',
            'woo_products_single_add_to_cart_font_family',
            'woo_product_single_price_font_family',
            'woo_product_single_related_font_family',
            'gf_title_font_family',
            'gf_label_font_family',
            'gf_description_font_family',
			'vc_grid_portfolio_filter_font_family',
			'vc_grid_button_title_google_fonts',
			'vc_grid_load_more_button_title_google_fonts',
			'blog_chequered_with_image_title_font_family',
			'blog_chequered_with_bgcolor_title_font_family',
			'blog_animated_title_font_family',
			'blog_centered_title_font_family',
			'blog_centered_info_font_family',
			'testimonials_title_font_family',
			'testimonials_author_job_font_family',
			'woo_products_standard_category_font_family',
			'woo_products_standard_title_font_family',
			'woo_products_standard_price_font_family',
			'woo_products_standard_list_add_to_cart_font_family'
		);

		//define available font options array
		$fonts_array = array();
		foreach($available_font_options as $font_option) {
			//is font set and not set to default and not empty?
			if(isset($qode_options[$font_option]) && $qode_options[$font_option] !== '-1' && $qode_options[$font_option] !== '') {
				$font_option_string = $qode_options[$font_option].':'.$font_weight_str;
				if(!in_array($font_option_string, $fonts_array)) {
					$fonts_array[] = $font_option_string;
				}
			}
		}

		//add google fonts set in slider
		$args = array( 'post_type' => 'slides', 'posts_per_page' => -1);
		$loop = new WP_Query( $args );

		//for each slide defined
		while ( $loop->have_posts() ) : $loop->the_post();

			//is font family for title option chosen?
			if(get_post_meta(get_the_ID(), "qode_slide-title-font-family", true) != "") {
				$slide_title_font_string = get_post_meta(get_the_ID(), "qode_slide-title-font-family", true) . ":".$font_weight_str;
				if(!in_array($slide_title_font_string, $fonts_array)) {
					//include that font
					array_push($fonts_array, $slide_title_font_string);
				}
			}

			//is font family defined for slide's text?
			if(get_post_meta(get_the_ID(), "qode_slide-text-font-family", true) != "") {
				$slide_text_font_string = get_post_meta(get_the_ID(), "qode_slide-text-font-family", true) . ":".$font_weight_str;
				if(!in_array($slide_text_font_string, $fonts_array)) {
					//include that font
					array_push($fonts_array, $slide_text_font_string);
				}
			}

			//is font family defined for slide's subtitle?
			if(get_post_meta(get_the_ID(), "qode_slide-subtitle-font-family", true) != "") {
				$slide_subtitle_font_string = get_post_meta(get_the_ID(), "qode_slide-subtitle-font-family", true) .":".$font_weight_str;
				if(!in_array($slide_subtitle_font_string, $fonts_array)) {
					//include that font
					array_push($fonts_array, $slide_subtitle_font_string);
				}
			}
		endwhile;

		wp_reset_query();

		$fonts_array = array_diff($fonts_array, array("-1:".$font_weight_str));
		$google_fonts_string = implode( '|', $fonts_array);

		$default_font_string = 'Raleway:'.$font_weight_str.'|Crete+Round:'.$font_weight_str;

		//is google font option checked anywhere in theme?
		if(count($fonts_array) > 0) {
			//include all checked fonts
			printf("<link href='//fonts.googleapis.com/css?family=".$default_font_string."|%s&#038;subset=latin,latin-ext' rel='stylesheet' type='text/css' />\r\n", str_replace(' ', '+', $google_fonts_string));
		} else {
			//include default google font that theme is using
			printf("<link href='//fonts.googleapis.com/css?family=".$default_font_string."' rel='stylesheet' type='text/css' />\r\n");
		}
    }

	add_action('wp_enqueue_scripts', 'qode_google_fonts_styles');
}


if (!function_exists('qode_scripts')) {
	/**
	 * Function that includes all necessary scripts
	 */
	function qode_scripts() {
		global $qode_options;
		global $is_chrome;
		global $is_opera;
		global $qode_toolbar;
        global $qode_landing;
		global $wp_scripts;

		//init variables
		$smooth_scroll 	= true;
		$has_ajax 		= false;
		$qode_animation = "";

		//is smooth scroll option turned on?
		if(isset($qode_options['smooth_scroll']) && $qode_options['smooth_scroll'] == "no"){
			$smooth_scroll = false;
		}

		//init theme core scripts
		wp_enqueue_script("jquery");
		wp_enqueue_script("wp-mediaelement");
		wp_enqueue_script("qode_plugins", QODE_ROOT."/js/plugins.js",array(),false,true);
		wp_enqueue_script("carouFredSel", QODE_ROOT."/js/jquery.carouFredSel-6.2.1.js",array(),false,true);
		wp_enqueue_script("one_page_scroll", QODE_ROOT."/js/jquery.fullPage.min.js",array(),false,true);
		wp_enqueue_script("lemmonSlider", QODE_ROOT."/js/lemmon-slider.js",array(),false,true);
		wp_enqueue_script("mousewheel", QODE_ROOT."/js/jquery.mousewheel.min.js",array(),false,true);
		wp_enqueue_script("touchSwipe", QODE_ROOT."/js/jquery.touchSwipe.min.js",array(),false,true);
		wp_enqueue_script("isotope", QODE_ROOT."/js/jquery.isotope.min.js",array(),false,true);

		//is google map enabled on contact page template?
		if($qode_options['enable_google_map'] == "yes") {
			//include google map api script
            if($qode_options['google_maps_api_key'] != '') {
                $google_maps_api_key = $qode_options['google_maps_api_key'];
                wp_enqueue_script('google_map_api', '//maps.googleapis.com/maps/api/js?key=' . $google_maps_api_key, array(), false, true);
            } else {
                wp_enqueue_script('google_map_api', '//maps.googleapis.com/maps/api/js', array(), false, true);
            }
		}

		if (file_exists(dirname(__FILE__) ."/js/default_dynamic.js") && qode_is_js_folder_writable() && !is_multisite()) {
			wp_enqueue_script("qode_default_dynamic", QODE_ROOT."/js/default_dynamic.js",array(), filemtime(dirname(__FILE__) ."/js/default_dynamic.js"),true);
		} else {
			wp_enqueue_script("qode_default_dynamic", QODE_ROOT."/js/default_dynamic.php", array(), false, true);
		}

		wp_enqueue_script("qode_default", QODE_ROOT."/js/default.min.js", array(), false, true);

		if (file_exists(dirname(__FILE__) ."/js/custom_js.js") && qode_is_js_folder_writable() && !is_multisite()) {
			wp_enqueue_script("qode_custom_js", QODE_ROOT."/js/custom_js.js",array(), filemtime(dirname(__FILE__) ."/js/custom_js.js"),true);
		} else {
			wp_enqueue_script("qode_custom_js", QODE_ROOT."/js/custom_js.php", array(), false, true);
		}

		//is Chome or Opera and is smooth scrolling turned on?
		if(($is_chrome || $is_opera) && $smooth_scroll){
			//include smooth scroll script
			wp_enqueue_script("smoothScroll", QODE_ROOT."/js/SmoothScroll.js",array(),false,true);
		}
		
		//include comment reply script
		$wp_scripts->add_data('comment-reply', 'group', 1);
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		//is ajax set in session?
		if (isset($_SESSION['qode_stockholm_page_transitions'])) {
			$qode_animation = $_SESSION['qode_stockholm_page_transitions'];
		}
		if (($qode_options['page_transitions'] != "0") && (empty($qode_animation) || ($qode_animation != "no"))) {
			$has_ajax = true;
		} elseif (!empty($qode_animation) && ($qode_animation != "no"))
			$has_ajax = true;

		if ($has_ajax) {
			wp_enqueue_script("ajax", QODE_ROOT."/js/ajax.min.js",array(),false,true);
		}

		//include Visual Composer script
		if (qode_visual_composer_installed()) {
			wp_enqueue_script( 'wpb_composer_front_js' );
		}

		//is google recaptcha turned on?
		if($qode_options['use_recaptcha'] == "yes") {
			//include recaptcha for ajax
			wp_enqueue_script("recaptcha_ajax", "http://www.google.com/recaptcha/api/js/recaptcha_ajax.js", array(), false, true);
		}

		//is toolbar enabled?
		if(isset($qode_toolbar)) {
			//include toolbar specific script
			wp_enqueue_script("qode_toolbar", QODE_ROOT."/js/toolbar.js",array(),false,true);
		}

        //is landing enabled?
        if(isset($qode_landing)) {
            wp_enqueue_script("qode_landing_fancybox", get_home_url() . "/demo-files/landing/js/jquery.fancybox.js",array(),false,true);
            wp_enqueue_script("qode_landing", get_home_url() . "/demo-files/landing/js/landing_default.js",array(),false,true);
        }

	}

	add_action('wp_enqueue_scripts', 'qode_scripts');
}

if(!function_exists('qode_browser_specific_scripts')) {
	/**
	 * Function that loads browser specific scripts
	 */
	function qode_browser_specific_scripts() {
		global $is_IE;

		//is ie?
		if ($is_IE) {
			wp_enqueue_script("qode_html5", QODE_ROOT."/js/html5.js",array(),false,false);
		}
	}

	add_action('wp_enqueue_scripts', 'qode_browser_specific_scripts');
}

if(!function_exists('qode_woocommerce_assets')) {
	/**
	 * Function that includes all necessary scripts for WooCommerce if installed
	 */
	function qode_woocommerce_assets() {
		global $qode_options;

		//is woocommerce installed?
		if(qode_is_woocommerce_installed()) {
			//get woocommerce specific scripts
			wp_enqueue_script("qode_woocommerce_script", QODE_ROOT."/js/woocommerce.js",array(),false,true);
			wp_enqueue_script("qode_select2", QODE_ROOT."/js/select2.min.js",array(),false,true);

			//include theme's woocommerce styles
			wp_enqueue_style("qode_woocommerce", QODE_ROOT . "/css/woocommerce.min.css");

			//is responsive option turned on?
			if($qode_options['responsiveness'] == 'yes') {
				//include theme's woocommerce responsive styles
				wp_enqueue_style("qode_woocommerce_responsive", QODE_ROOT . "/css/woocommerce_responsive.min.css");
			}
		}
	}

	add_action('wp_enqueue_scripts', 'qode_woocommerce_assets');
}

if (!function_exists('qode_admin_jquery')) {
	/**
	 * Function that includes scripts for admin
	 */
	function qode_admin_jquery() {
		wp_enqueue_script('jquery');
		wp_enqueue_style('qode-admin-style', QODE_ROOT.'/css/admin/admin-style.css', false, '1.0', 'screen');
		wp_enqueue_style('qode_admin_colorstyle', QODE_ROOT.'/css/admin/colorpicker.css', false, '1.0', 'screen');
		wp_register_script('qode_admin_colorpickers', QODE_ROOT.'/js/admin/colorpicker.js', array('jquery'), '1.0.0', false );
		wp_enqueue_script('qode_admin_colorpickers');
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_media();
		wp_enqueue_script('thickbox');
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-accordion');
		wp_register_script('qode_admin_default', QODE_ROOT.'/js/admin/default.js', array('jquery'), '1.0.0', false );
		wp_enqueue_script('qode_admin_default');
		wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');
	}

	add_action('admin_enqueue_scripts', 'qode_admin_jquery');
}

//defined content width variable
if (!isset( $content_width )) $content_width = 1060;

if (!function_exists('qode_register_menus')) {
	/**
	 * Function that registers menu locations
	 */
	function qode_register_menus() {
        global $qode_options;

        if((isset($qode_options['header_bottom_appearance']) && $qode_options['header_bottom_appearance'] != "stick_with_left_right_menu") || (isset($qode_options['vertical_area']) && $qode_options['vertical_area'] == "yes")){
            //header and left menu location
            register_nav_menus(
                array('top-navigation' => __( 'Top Navigation', 'qode')
                )
            );
        }

		//popup menu location
		register_nav_menus(
			array('popup-navigation' => __( 'Fullscreen Navigation', 'qode')
			)
		);

        if((isset($qode_options['header_bottom_appearance']) && $qode_options['header_bottom_appearance'] == "stick_with_left_right_menu") && (isset($qode_options['vertical_area']) && $qode_options['vertical_area'] == "no")){
            //header left menu location
            register_nav_menus(
                array('left-top-navigation' => __( 'Left Top Navigation', 'qode')
                )
            );

            //header right menu location
            register_nav_menus(
                array('right-top-navigation' => __( 'Right Top Navigation', 'qode')
                )
            );
        }
	}

	add_action( 'after_setup_theme', 'qode_register_menus' );
}

if ( function_exists( 'add_theme_support' ) ) {
	//add support for feed links
	add_theme_support( 'automatic-feed-links' );

	//add support for post formats
	add_theme_support('post-formats', array('gallery', 'link', 'quote', 'video', 'audio'));

	//add theme support for post thumbnails
	add_theme_support( 'post-thumbnails' );

	//define thumbnail sizes
	add_image_size( 'portfolio-square', 550, 550, true );
	add_image_size( 'portfolio-landscape', 800, 600, true );
	add_image_size( 'portfolio-portrait', 600, 800, true );
	add_image_size( 'portfolio-default', 550, 498, true ); // and for blog masonry and latest post boxes type
	add_image_size( 'menu-featured-post', 345, 198, true );
	add_image_size( 'qode-carousel_slider', 400, 260, true );
	add_image_size( 'portfolio_slider', 480, 434, true );
	add_image_size( 'portfolio_masonry_regular', 500, 500, true );
	add_image_size( 'portfolio_masonry_wide', 1000, 500, true );
	add_image_size( 'portfolio_masonry_tall', 500, 1000, true );
	add_image_size( 'portfolio_masonry_large', 1000, 1000, true );
    add_image_size( 'portfolio_masonry_with_space', 700);
	add_image_size( 'latest_post_small_image', 125, 112, true );
	add_image_size( 'blog_image_in_grid', 1100);
}

if (!function_exists('qode_generate_dynamic_css_and_js')){
	/**
	 * Function that gets content of dynamic assets files and puts that in static ones
	 */
	function qode_generate_dynamic_css_and_js() {

		$qode_options = get_option('qode_options_stockholm');
		if(qode_is_css_folder_writable()) {
			$css_dir = get_template_directory().'/css/';

			ob_start();
			include_once('css/style_dynamic.php');
			$css = ob_get_clean();
			file_put_contents($css_dir.'style_dynamic.css', $css, LOCK_EX);

			ob_start();
			include_once('css/style_dynamic_responsive.php');
			$css = ob_get_clean();
			file_put_contents($css_dir.'style_dynamic_responsive.css', $css, LOCK_EX);

			ob_start();
			include_once('css/custom_css.php');
			$css = ob_get_clean();
			file_put_contents($css_dir.'custom_css.css', $css, LOCK_EX);
		}

		if(qode_is_js_folder_writable()) {
			$js_dir = get_template_directory().'/js/';

			ob_start();
			include_once('js/default_dynamic.php');
			$js = ob_get_clean();
			file_put_contents($js_dir.'default_dynamic.js', $js, LOCK_EX);

			ob_start();
			include_once('js/custom_js.php');
			$js = ob_get_clean();
			file_put_contents($js_dir.'custom_js.js', $js, LOCK_EX);
		}
	}
	if(!is_multisite()) {
		add_action('qode_after_theme_option_save', 'qode_generate_dynamic_css_and_js');
	}

}

if (!function_exists('ajax_classes')) {
	/**
	 * Function that adds classes on body for ajax transitions
	 */
	function ajax_classes($classes) {
		global $qode_options;

		//init variables
		$qode_animation="";

		//is ajax set in session
		if (isset($_SESSION['qode_animation'])) {
			$qode_animation = $_SESSION['qode_animation'];
		}

		//is ajax animation turned off in options or in session?
		if(($qode_options['page_transitions'] === "0") && ($qode_animation == "no")) {
			$classes[] = '';
		}

		//is up down animation type set?
		elseif($qode_options['page_transitions'] === "1" && (empty($qode_animation) || ($qode_animation != "no"))) {
			$classes[] = 'ajax_updown';
			$classes[] = 'page_not_loaded';
		}

		//is fade animation type set?
		elseif($qode_options['page_transitions'] === "2" && (empty($qode_animation) || ($qode_animation != "no"))) {
			$classes[] = 'ajax_fade';
			$classes[] = 'page_not_loaded';
		}

		//is up down fade animation type set?
		elseif($qode_options['page_transitions'] === "3" && (empty($qode_animation) || ($qode_animation != "no"))) {
			$classes[] = 'ajax_updown_fade';
			$classes[] = 'page_not_loaded';
		}

		//is left / right animation type set?
		elseif($qode_options['page_transitions'] === "4" && (empty($qode_animation) || ($qode_animation != "no"))) {
			$classes[] = 'ajax_leftright';
			$classes[] = 'page_not_loaded';
		}

		//is animation set only in session?
		elseif(!empty($qode_animation) && $qode_animation != "no") {
			$classes[] = 'page_not_loaded';
		}

		//animation is turned off both in options nad in session
		else {
			$classes[] ="";
		}

		return $classes;
	}

	add_filter('body_class','ajax_classes');
}

if (!function_exists('boxed_class')) {
	/**
	 * Function that adds classes on body for boxed layout
	 */
	function boxed_class($classes) {
		global $qode_options;

		//is boxed layout turned on?
		if(isset($qode_options['boxed']) && $qode_options['boxed'] == "yes") {
			$classes[] = 'boxed';
		} else {
			$classes[] ="";
		}

		return $classes;
	}

	add_filter('body_class','boxed_class');
}

if (!function_exists('theme_version_class')) {
	/**
	 * Function that adds classes on body for version of theme
	 */
	function theme_version_class($classes) {
		$current_theme = wp_get_theme();

		//is child theme activated?
		if($current_theme->parent()) {
			//add child theme version
			$classes[] = 'select-child-theme-ver-'.$current_theme->get('Version');

			//get parent theme
			$current_theme = $current_theme->parent();
		}

		if($current_theme->exists() && $current_theme->get('Version') != "") {
			$classes[] = 'select-theme-ver-'.$current_theme->get('Version');
		}

		return $classes;
	}

	add_filter('body_class','theme_version_class');
}

if (!function_exists('vertical_menu_class')) {
	/**
	 * Function that adds classes on body element for left menu area
	 */
	function vertical_menu_class($classes) {
		global $qode_options;
		global $wp_query;

		//is left menu area turned on?
		if(isset($qode_options['vertical_area']) && $qode_options['vertical_area'] =='yes') {
			$classes[] = 'vertical_menu_enabled';
		}

		//get current page id
		$id = $wp_query->get_queried_object_id();

		if(qode_is_woocommerce_page()) {
			$id = get_option('woocommerce_shop_page_id');
		}

		if(isset($qode_options['vertical_area_transparency']) && $qode_options['vertical_area_transparency'] =='yes' && get_post_meta($id, "qode_page_vertical_area_transparency", true) != "no"){
			$classes[] = ' vertical_menu_transparency vertical_menu_transparency_on';
		}else if(get_post_meta($id, "qode_page_vertical_area_transparency", true) == "yes"){
			$classes[] = ' vertical_menu_transparency vertical_menu_transparency_on';
		}
		return $classes;
	}

	add_filter('body_class','vertical_menu_class');
}

if (!function_exists('paspartu_class')) {
	/**
	 * Function that adds classes on body element for passepartout
	 */

	function paspartu_class($classes) {
		global $qode_options;

		//is passepartout turned on?
		if(isset($qode_options['paspartu']) && $qode_options['paspartu'] =='yes') {
			$classes[] = 'paspartu_enabled';
		}

		return $classes;
	}

	add_filter('body_class','paspartu_class');
}




if (!function_exists('menu_hover_class')) {
	/**
	 * Function that adds classes on body element if hover animation for first level menu is enabled
	 */

	function menu_hover_class($classes) {
		global $qode_options;

		if(isset($qode_options['vertical_area']) && $qode_options['vertical_area'] =='yes') {
			if(isset($qode_options['enable_vertical_menu_hover_animation']) && $qode_options['enable_vertical_menu_hover_animation'] =='yes') {
				if(isset($qode_options['vertical_menu_hover_type']) && $qode_options['vertical_menu_hover_type'] !='') {
					$classes[] = "menu-animation-" . $qode_options['vertical_menu_hover_type'];
				}
			}
		} else {
			if(isset($qode_options['enable_menu_hover_animation']) && $qode_options['enable_menu_hover_animation'] =='yes') {
				if(isset($qode_options['menu_hover_type']) && $qode_options['menu_hover_type'] !='') {
					$classes[] = "menu-animation-" . $qode_options['menu_hover_type'];
				}
			}
		}

		if(isset($qode_options['enable_fullscreen_menu_hover_animation']) && $qode_options['enable_fullscreen_menu_hover_animation'] =='yes') {
			if(isset($qode_options['fullscreen_menu_hover_type']) && $qode_options['fullscreen_menu_hover_type'] !='') {
				$classes[] = "fs-menu-animation-" . $qode_options['fullscreen_menu_hover_type'];
			}
		}

		return $classes;
	}

	add_filter('body_class','menu_hover_class');
}

if (!function_exists('popup_menu_class')) {
	/**
	 * Function that adds classes for popup menu appearance on body element, if popup menu is enabled
	 */

	function popup_menu_class($classes) {
		global $qode_options;

		if(isset($qode_options['enable_popup_menu']) && $qode_options['enable_popup_menu'] =='yes') {

			if(isset($qode_options['popup_menu_appearance']) && $qode_options['popup_menu_appearance'] !='') {
				$classes[] = "popup-menu-" . $qode_options['popup_menu_appearance'];
			} else {
				$classes[] = "popup-menu-fade"; //default type was fade
			}
		}

		return $classes;
	}

	add_filter('body_class','popup_menu_class');
}

if (!function_exists('side_area_class')) {
	/**
	 * Function that adds classes side area type
	 */

	function side_area_class($classes) {
		global $qode_options;

		if(isset($qode_options['enable_side_area']) && $qode_options['enable_side_area'] =='yes') {

			if(isset($qode_options['side_area_appear_type']) && $qode_options['side_area_appear_type'] !='') {
				$classes[] = $qode_options['side_area_appear_type'];
			} else {
				$classes[] = "side_area_uncovered"; //default type was uncovered
			}
		}

		return $classes;
	}

	add_filter('body_class','side_area_class');
}

if (!function_exists('smooth_scroll_class')) {
    /**
     * Function that adds classes for smooth scroll
     */
    function smooth_scroll_class($classes) {
        global $qode_options;
        global $is_chrome;
        global $is_opera;

        $smooth_scroll = false;
        if(isset($qode_options['smooth_scroll']) && $qode_options['smooth_scroll'] == "yes"){
            $smooth_scroll = true;
        }
        //is Chome or Opera and is smooth scrolling turned on?
        if(($is_chrome || $is_opera) && $smooth_scroll){
            $classes[] = "smooth_scroll";
        }

        return $classes;
    }
    add_filter('body_class','smooth_scroll_class');
}

if(!function_exists('qode_wp_title')) {
	/**
	 * Function that sets page's title. Hooks to wp_title filter
	 * @param $title string current page title
	 * @param $sep string title separator
	 * @return string changed title text if SEO plugins aren't installed
	 *
	 * @since 4.3
	 * @version 0.2
	 */
	function qode_wp_title($title, $sep) {
		global $qode_options;

		//is SEO plugin installed?
		if(qode_seo_plugin_installed()) {
			//don't do anything, seo plugin will take care of it
		} else {
			//get current post id
			$id = qode_get_page_id();
			$sep = ' | ';
			$title_prefix = get_bloginfo('name');
			$title_suffix = '';

			//is WooCommerce installed and is current page shop page?
			if(qode_is_woocommerce_installed() && qode_is_woocommerce_shop()) {
				//get shop page id
				$id = qode_get_woo_shop_page_id();
			}

			//set unchanged title variable so we can use it later
			$unchanged_title = $title;

			//is qode seo enabled?
			if(isset($qode_options['disable_qode_seo']) && $qode_options['disable_qode_seo'] !== 'yes') {
				//get current post seo title
				$seo_title = get_post_meta($id, "qode_seo_title", true);

				//is current post seo title set?
				if($seo_title !== '') {
					$title_suffix = $seo_title;
				}
			}

			//title suffix is empty, which means that it wasn't set by qode seo
			if(empty($title_suffix)) {
				//if current page is front page append site description, else take original title string
				$title_suffix = is_front_page() ? get_bloginfo('description') : $unchanged_title;
			}

			//concatenate title string
			$title  = $title_prefix.$sep.$title_suffix;

			//return generated title string
			return $title;
		}
	}

	add_filter('wp_title', 'qode_wp_title', 10, 2);
}

if(!function_exists('qode_is_content_below_header')) {
	/**
	 * Function that check is content below header on page
	 * @param none
	 * @return true/false
	 */
	function qode_is_content_below_header() {
		global $qode_options;
		$page_id = qode_get_page_id();

		$content_below_header = false;
		if(get_post_meta($page_id, "qode_enable_content_top_margin", true) === 'yes'){
			$content_below_header = true;
		}elseif(get_post_meta($page_id, "qode_enable_content_top_margin", true) === 'no'){
			$content_below_header = false;
		}else{
			if(isset($qode_options['enable_content_top_margin']) && ($qode_options['enable_content_top_margin'] === 'yes')){
				$content_below_header = true;
			}elseif(isset($qode_options['enable_content_top_margin']) && ($qode_options['enable_content_top_margin'] === 'no')){
				$content_below_header = false;
			}
		}

		return $content_below_header;
	}
}

if(!function_exists('qode_ajax_meta')) {
	/**
	 * Function that echoes meta data for ajax
	 *
	 * @since 4.3
	 * @version 0.2
	 */
	function qode_ajax_meta() {
		global $qode_options;

		$seo_description = get_post_meta(qode_get_page_id(), "qode_seo_description", true);
		$seo_keywords = get_post_meta(qode_get_page_id(), "qode_seo_keywords", true);
		?>

		<div class="seo_title"><?php wp_title(''); ?></div>

		<?php if($seo_description !== ''){ ?>
			<div class="seo_description"><?php echo esc_html($seo_description); ?></div>
		<?php } else if($qode_options['meta_description']){?>
			<div class="seo_description"><?php echo esc_html($qode_options['meta_description']); ?></div>
		<?php } ?>
		<?php if($seo_keywords !== ''){ ?>
			<div class="seo_keywords"><?php echo esc_html($seo_keywords); ?></div>
		<?php }else if($qode_options['meta_keywords']){?>
			<div class="seo_keywords"><?php echo esc_html($qode_options['meta_keywords']); ?></div>
		<?php }
	}

	add_action('qode_ajax_meta', 'qode_ajax_meta');
}

if(!function_exists('qode_header_meta')) {
	/**
	 * Function that echoes meta data if our seo is enabled
	 */
	function qode_header_meta() {
		global $qode_options;

		if(isset($qode_options['disable_qode_seo']) && $qode_options['disable_qode_seo'] == 'no') {
			$seo_description = get_post_meta(qode_get_page_id(), "qode_seo_description", true);
			$seo_keywords = get_post_meta(qode_get_page_id(), "qode_seo_keywords", true);
			?>

			<?php if($seo_description) { ?>
				<meta name="description" content="<?php echo esc_html($seo_description); ?>">
			<?php } else if($qode_options['meta_description']){ ?>
				<meta name="description" content="<?php echo esc_html($qode_options['meta_description']); ?>">
			<?php } ?>

			<?php if($seo_keywords) { ?>
				<meta name="keywords" content="<?php echo esc_html($seo_keywords); ?>">
			<?php } else if($qode_options['meta_keywords']){ ?>
				<meta name="keywords" content="<?php echo esc_html($qode_options['meta_keywords']); ?>">
			<?php }
		}
	}

	add_action('qode_header_meta', 'qode_header_meta');
}

if(!function_exists('qode_get_page_id')) {
	/**
	 * Function that returns current page / post id.
	 * Checks if current page is woocommerce page and returns that id if it is.
	 * Checks if current page is any archive page (category, tag, date, author etc.) and returns -1 because that isn't
	 * page that is created in WP admin.
	 *
	 * @return int
	 *
	 * @version 0.1
	 *
	 * @see qode_is_woocommerce_installed()
	 * @see qode_is_woocommerce_shop()
	 */
	function qode_get_page_id() {
		if(qode_is_woocommerce_installed() && (qode_is_woocommerce_shop() || is_singular('product'))) {	
			return qode_get_woo_shop_page_id();
		}

		if(is_archive() || is_404() || is_search()) {
			return -1;
		}

		return get_queried_object_id();
	}
}

if (!function_exists('elements_animation_on_touch_class')) {
	/**
	 * Function that adds classes on body when touch is disabled on touch devices
	 * @param $classes array classes array
	 * @return array array with added classes
	 */
	function elements_animation_on_touch_class($classes) {
		global $qode_options;

		//check if current client is on mobile
		$isMobile = (bool)preg_match('#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet'.
			'|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]'.
			'|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', $_SERVER['HTTP_USER_AGENT'] );

		//are animations turned off on touch and client is on mobile?
		if(isset($qode_options['elements_animation_on_touch']) && $qode_options['elements_animation_on_touch'] == "no" && $isMobile == true) {
			$classes[] = 'no_animation_on_touch';
		} else {
			$classes[] ="";
		}

		return $classes;
	}

	add_filter('body_class','elements_animation_on_touch_class');
}

if (!function_exists('qode_excerpt_more')) {
	/**
	 * Function that adds three dotes on the end excerpt
	 * @param $more
	 * @return string
	 */
	function qode_excerpt_more( $more ) {
		return '...';
	}

	add_filter('excerpt_more', 'qode_excerpt_more');
}

if (!function_exists('qode_excerpt_length')) {
	/**
	 * Function that changes excerpt length based on theme options
	 * @param $length int original value
	 * @return int changed value
	 */
	function qode_excerpt_length( $length ) {
		global $qode_options;

		if($qode_options['number_of_chars']){
			return $qode_options['number_of_chars'];
		} else {
			return 45;
		}
	}

	add_filter( 'excerpt_length', 'qode_excerpt_length', 999 );
}

if (!function_exists('the_excerpt_max_charlength')) {
	/**
	 * Function that sets character length for social share shortcode
	 * @param $charlength string original text
	 * @return string shortened text
	 */
	function the_excerpt_max_charlength($charlength) {
		global $qode_options;

		if(isset($qode_options['twitter_via']) && !empty($qode_options['twitter_via'])) {
			$via = " via " . $qode_options['twitter_via'] . " ";
		} else {
			$via = 	"";
		}

		$excerpt = get_the_excerpt();
		$charlength = 140 - (mb_strlen($via) + $charlength);

		if ( mb_strlen( $excerpt ) > $charlength ) {
			$subex = mb_substr( $excerpt, 0, $charlength);
			$exwords = explode( ' ', $subex );
			$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
			if ( $excut < 0 ) {
				return mb_substr( $subex, 0, $excut );
			} else {
				return $subex;
			}
		} else {
			return $excerpt;
		}
	}
}

if(!function_exists('qode_excerpt')) {
	/**
	 * Function that cuts post excerpt to the number of word based on previosly set global
	 * variable $word_count, which is defined in qode_set_blog_word_count function
	 */
	function qode_excerpt() {
		global $qode_options, $word_count, $post;

		if($word_count != '0') {
			$word_count = isset($word_count) && $word_count !== "" ? $word_count : $qode_options['number_of_chars'];
			$post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content);
			$clean_excerpt = strlen($post_excerpt) && strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;

			$excerpt_word_array = explode (' ', $clean_excerpt);
			$excerpt_word_array = array_slice ($excerpt_word_array, 0, $word_count);
			$excerpt = implode (' ', $excerpt_word_array).'...';

			//is excerpt different than empty string?
			if($excerpt !== '') {
				echo '<p class="post_excerpt">'.$excerpt.'</p>';
			}
		}
	}
}

if(!function_exists('qode_set_blog_word_count')) {
	/**
	 * Function that sets global blog word count variable used by qode_excerpt function
	 */
	function qode_set_blog_word_count($word_count_param) {
		global $word_count;

		$word_count = $word_count_param;
	}
}

if (!function_exists('comparePortfolioImages')) {
	/**
	 * Function that compares two portfolio image for sorting
	 * @param $a int first image
	 * @param $b int second image
	 * @return int result of comparison
	 */
	function comparePortfolioImages($a, $b){
		if (isset($a['portfolioimgordernumber']) && isset($b['portfolioimgordernumber'])) {
			if ($a['portfolioimgordernumber'] == $b['portfolioimgordernumber']) {
				return 0;
			}
			return ($a['portfolioimgordernumber'] < $b['portfolioimgordernumber']) ? -1 : 1;
		}

		return 0;
	}
}

if (!function_exists('comparePortfolioOptions')){
	/**
	 * Function that compares two portfolio options for sorting
	 * @param $a int first option
	 * @param $b int second option
	 * @return int result of comparison
	 */
	function comparePortfolioOptions($a, $b){
		if (isset($a['optionlabelordernumber']) && isset($b['optionlabelordernumber'])) {
			if ($a['optionlabelordernumber'] == $b['optionlabelordernumber']) {
				return 0;
			}
			return ($a['optionlabelordernumber'] < $b['optionlabelordernumber']) ? -1 : 1;
		}

		return 0;
	}
}

if (!function_exists('qode_gallery_upload_get_images')){
	function qode_gallery_upload_get_images(){
		$ids=$_POST['ids'];
		$ids=explode(",",$ids);
		foreach($ids as $id):
			$image = wp_get_attachment_image_src($id,'thumbnail', true);
			echo '<li class="qode-gallery-image-holder"><img src="'.$image[0].'"/></li>';
		endforeach;
		exit;  
	}
}

add_action( 'wp_ajax_qode_gallery_upload_get_images', 'qode_gallery_upload_get_images');

if (!function_exists('qode_hex2rgb')) {
	/**
	 * Function that transforms hex color to rgb color
	 * @param $hex string original hex string
	 * @return array array containing three elements (r, g, b)
	 */
	function qode_hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);

		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		//return implode(",", $rgb); // returns the rgb values separated by commas
		return $rgb; // returns an array with the rgb values
	}
}

if(!function_exists('qode_addslashes')) {
	/**
	 * Function that checks if magic quotes are turned on (for older versions of php) and returns escaped string
	 * @param $str string string to be escaped
	 * @return string escaped string
	 */
	function qode_addslashes($str) {
		//is magic quotes turned off in php.ini?
		if(!get_magic_quotes_gpc()) {
			//apply addslashes
			$str = addslashes($str);
		}

		//return escaped string
		return $str;
	}
}

if(!function_exists('qode_get_attachment_meta')) {
	/**
	 * Function that returns attachment meta data from attachment id
	 * @param $attachment_id
	 * @param array $keys sub array of attachment meta
	 * @return array|mixed
	 */
	function qode_get_attachment_meta($attachment_id, $keys = array()) {
		$meta_data = array();

		//is attachment id set?
		if(!empty($attachment_id)) {
			//get all post meta for given attachment id
			$meta_data = get_post_meta($attachment_id, '_wp_attachment_metadata', true);

			//is subarray of meta array keys set?
			if(is_array($keys) && count($keys)) {
				$sub_array = array();

				//for each defined key
				foreach($keys as $key) {
					//check if that key exists in all meta array
					if(array_key_exists($key, $meta_data)) {
						//assign key from meta array for current key to meta subarray
						$sub_array[$key] = $meta_data[$key];
					}
				}

				//we want meta array to be subarray because that is what used whants to get
				$meta_data = $sub_array;
			}
		}

		//return meta array
		return $meta_data;
	}
}

if(!function_exists('qode_get_attachment_id_from_url')) {
	/**
	 * Function that retrieves attachment id for passed attachment url
	 * @param $attachment_url
	 * @return null|string
	 */
	function qode_get_attachment_id_from_url($attachment_url) {
		global $wpdb;
		$attachment_id = '';

		//is attachment url set?
		if($attachment_url !== '') {
			//prepare query

			$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$attachment_url'";

			//get attachment id
			$attachment_id = $wpdb->get_var($query);
		}

		//return id
		return $attachment_id;
	}
}

if(!function_exists('qode_get_attachment_meta_from_url')) {
	/**
	 * Function that returns meta array for give attachment url
	 * @param $attachment_url
	 * @param array $keys sub array of attachment meta
	 * @return array|mixed
	 *
	 * @see qode_get_attachment_id_from_url()
	 * @see qode_get_attachment_meta()
	 *
	 * @version 0.1
	 */
	function qode_get_attachment_meta_from_url($attachment_url, $keys = array()) {
		$attachment_meta = array();

		//get attachment id for attachment url
		$attachment_id 	= qode_get_attachment_id_from_url($attachment_url);

		//is attachment id set?
		if(!empty($attachment_id)) {
			//get post meta
			$attachment_meta = qode_get_attachment_meta($attachment_id, $keys);
		}

		//return post meta
		return $attachment_meta;
	}
}

if(!function_exists('qode_get_image_dimensions')) {
	/**
	 * Function that returns image sizes array. First looks in post_meta table if attachment exists in the database,
	 * if it doesn't than it uses getimagesize PHP function to get image sizes
	 * @param $url string url of the image
	 * @return array array of image sizes that containes height and width
	 *
	 * @see qode_get_attachment_meta_from_url()
	 * @uses getimagesize
	 *
	 * @version 0.1
	 */
	function qode_get_image_dimensions($url) {
		$image_sizes = array();

		//is url passed?
		if($url !== '') {
			//get image sizes from posts meta if attachment exists
			$image_sizes = qode_get_attachment_meta_from_url($url, array('width', 'height'));

			//image does not exists in post table, we have to use PHP way of getting image size
			if(!count($image_sizes)) {
				//can we open file by url?
				if(ini_get('allow_url_fopen') == 1 && file_exists($url)) {
					list($width, $height, $type, $attr) = getimagesize($url);
				} else {
					//we can't open file directly, have to locate it with relative path.
					$image_obj = parse_url($url);
					$image_relative_path = $_SERVER['DOCUMENT_ROOT'].$image_obj['path'];

					if(file_exists($image_relative_path)) {
						list($width, $height, $type, $attr) = getimagesize($image_relative_path);
					}
				}

				//did we get width and height from some of above methods?
				if(isset($width) && isset($height)) {
					//set them to our image sizes array
					$image_sizes = array(
						'width' => $width,
						'height' => $height
					);
				}
			}
		}

		return $image_sizes;
	}
}

if(!function_exists('qode_is_archive_page')) {
	/**
	 * Function that checks if current page archive page, search, 404 or default home blog page
	 * @return bool
	 *
	 * @see is_archive()
	 * @see is_search()
	 * @see is_404()
	 * @see is_front_page()
	 * @see is_home()
	 */
	function qode_is_archive_page() {
		return is_archive() || is_search() || is_404() || (is_front_page() && is_home());
	}
}

if(!function_exists('qode_is_woocommerce_installed')) {
	/**
	 * Function that checks if woocommerce is installed
	 * @return bool
	 */
	function qode_is_woocommerce_installed() {
		return function_exists('is_woocommerce');
	}
}

if(!function_exists('qode_is_woocommerce_page')) {
	/**
	 * Function that checks if current page is woocommerce shop, product or product taxonomy
	 * @return bool
	 *
	 * @see is_woocommerce()
	 */
	function qode_is_woocommerce_page() {
		return function_exists('is_woocommerce') && is_woocommerce();
	}
}

if(!function_exists('qode_is_woocommerce_shop')) {
	/**
	 * Function that checks if current page is shop or product page
	 * @return bool
	 *
	 * @see is_shop()
	 */
	function qode_is_woocommerce_shop() {
		return function_exists('is_shop') && is_shop();
	}
}

if(!function_exists('qode_get_woo_shop_page_id')) {
	/**
	 * Function that returns shop page id that is set in WooCommerce settings page
	 * @return int id of shop page
	 */
	function qode_get_woo_shop_page_id() {
		if(qode_is_woocommerce_installed()) {
			return get_option('woocommerce_shop_page_id');
		}
	}
}

if(!function_exists('qode_is_product_category')) {
	function qode_is_product_category() {
		return function_exists('is_product_category') && is_product_category();
	}
}

if(!function_exists('qode_get_page_template_name')) {
	/**
	 * Returns current template file name without extension
	 * @return string name of current template file
	 */
	function qode_get_page_template_name() {
		$file_name = '';
		$file_name_without_ext = preg_replace('/\\.[^.\\s]{3,4}$/', '', basename(get_page_template()));

		if($file_name_without_ext !== '') {
			$file_name = $file_name_without_ext;
		}

		return $file_name;
	}
}

if(!function_exists('qode_is_main_menu_set')) {
	/**
	 * Function that checks if any of main menu locations are set.
	 * Checks whether top-navigation location is set, or left-top-navigation and right-top-navigation is set
	 * @return bool
	 *
	 * @version 0.1
	 */
	function qode_is_main_menu_set() {
		$has_top_nav = has_nav_menu('top-navigation');
		$has_divided_nav = has_nav_menu('left-top-navigation') && has_nav_menu('right-top-navigation');

		return $has_top_nav || $has_divided_nav;
	}
}

if(!function_exists('qode_is_contact_page_template')) {
	/**
	 * Checks if current template page is contact page.
	 * @param string current page. Optional parameter. If not passed qode_get_page_template_name() function will be used
	 * @return bool
	 *
	 * @see qode_get_page_template_name()
	 */
	function qode_is_contact_page_template($current_page = '') {
		if($current_page == '' && !is_archive()) {
			$current_page = qode_get_page_template_name();
		}

		return in_array($current_page, array('contact-page'));
	}
}

if (!function_exists('modify_read_more_link')) {
	add_filter( 'the_content_more_link', 'modify_read_more_link' );

	function modify_read_more_link() {
		return '<a class="more-link" href="'.get_permalink().'"><span>'.__("READ MORE", "qode").'</span></a>';
	}
}

if(!function_exists('qode_seo_plugin_installed')) {
	/**
	 * Function that checks if popular seo plugins are installed
	 * @return bool
	 */
	function qode_seo_plugin_installed() {
		//is YOAST installed?
		if(defined('WPSEO_VERSION')) {
			return true;
		}

		return false;
	}
}

if(!function_exists('qode_remove_yoast_json_on_ajax')) {
    /**
     * Function that removes yoast json ld script
     * that stops page transition to work on home page
     * Hooks to wpseo_json_ld_output in order to disable json ld script
     * @return bool
     *
     * @param $data array json ld data that is being passed to filter
     *
     * @version 0.2
     */
    function qode_remove_yoast_json_on_ajax($data) {
        //is current request made through ajax?
        if(qode_is_ajax()) {
            //disable json ld script
            return array();
        }

        return $data;
    }

    //is yoast installed and it's version is greater or equal of 1.6?
    if(defined('WPSEO_VERSION') && version_compare(WPSEO_VERSION, '1.6') >= 0) {
        add_filter('wpseo_json_ld_output', 'qode_remove_yoast_json_on_ajax');
    }
}

if(!function_exists('qode_is_ajax')) {
	/**
	 * Function that checks if current request is ajax request
	 * @return bool whether it's ajax request or not
	 *
	 * @version 0.1
	 */
	function qode_is_ajax() {
		return !empty( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ]) && strtolower( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ]) == 'xmlhttprequest';
	}
}

if(!function_exists('qode_is_wpml_installed')) {
	/**
	 * Function that checks if WPML plugin is installed
	 * @return bool
	 *
	 * @version 0.1
	 */
	function qode_is_wpml_installed() {
		return defined('ICL_SITEPRESS_VERSION');
	}
}

if(!function_exists('qode_is_css_folder_writable')) {
	/**
	 * Function that checks if css folder is writable
	 * @return bool
	 *
	 * @version 0.1
	 * @uses is_writable()
	 */
	function qode_is_css_folder_writable() {
		$css_dir = get_template_directory().'/css';

		return is_writable($css_dir);
	}
}

if(!function_exists('qode_is_js_folder_writable')) {
	/**
	 * Function that checks if js folder is writable
	 * @return bool
	 *
	 * @version 0.1
	 * @uses is_writable()
	 */
	function qode_is_js_folder_writable() {
		$js_dir = get_template_directory().'/js';

		return is_writable($js_dir);
	}
}

if(!function_exists('qode_assets_folders_writable')) {
	/**
	 * Function that if css and js folders are writable
	 * @return bool
	 *
	 * @version 0.1
	 * @see qode_is_css_folder_writable()
	 * @see qode_is_js_folder_writable()
	 */
	function qode_assets_folders_writable() {
		return qode_is_css_folder_writable() && qode_is_js_folder_writable();
	}
}

if(!function_exists('qode_writable_assets_folders_notice')) {
	/**
	 * Function that prints notice that css and js folders aren't writable. Hooks to admin_notices action
	 *
	 * @version 0.1
	 * @link http://codex.wordpress.org/Plugin_API/Action_Reference/admin_notices
	 */
	function qode_writable_assets_folders_notice() {
		global $pagenow;

		$is_theme_options_page = isset($_GET['page']) && strstr($_GET['page'], 'qode_theme_menu');

		if($pagenow === 'admin.php' && $is_theme_options_page) {
			if(!qode_assets_folders_writable()) { ?>
				<div class="error">
					<p><?php _e('Note that writing permissions aren\'t set for folders containing css and js files on your server.
					We recommend setting writing permissions in order to optimize your site performance.
					For further instructions, please refer to our <a target="_blank" href="http://demo.select-themes.com/stockholm-help/#!/getting_started">documentation</a>.', 'qode'); ?></p>
				</div>
			<?php }
		}
	}

	add_action('admin_notices', 'qode_writable_assets_folders_notice');
}

if(!function_exists('qode_localize_no_ajax_pages')) {
	/**
	 * Function that outputs no_ajax_obj javascript variable that is used default_dynamic.php.
	 * It is used for no ajax pages functionality
	 *
	 * Function hooks to wp_enqueue_scripts and uses wp_localize_script
	 *
	 * @see http://codex.wordpress.org/Function_Reference/wp_localize_script
	 *
	 * @uses qode_get_posts_without_ajax()
	 * @uses qode_get_pages_without_ajax()
	 * @uses qode_get_wpml_pages_for_current_page()
	 * @uses qode_get_woocommerce_pages()
	 *
	 * @version 0.1
	 */
	function qode_localize_no_ajax_pages() {
		global $qode_options;

		//is ajax enabled?
		if(qode_is_ajax_enabled()) {
			$no_ajax_pages = array();

            //get posts that have ajax disabled and merge with main array
			$no_ajax_pages = array_merge($no_ajax_pages, qode_get_objects_without_ajax());

			//is wpml installed?
			if(qode_is_wpml_installed()) {
				//get translation pages for current page and merge with main array
				$no_ajax_pages = array_merge($no_ajax_pages, qode_get_wpml_pages_for_current_page());
			}

			//is woocommerce installed?
			if(qode_is_woocommerce_installed()) {
				//get all woocommerce pages and products and merge with main array
				$no_ajax_pages = array_merge($no_ajax_pages, qode_get_woocommerce_pages());
			}

			//do we have some internal pages that won't to be without ajax?
			if (isset($qode_options['internal_no_ajax_links'])) {
				//get array of those pages
				$options_no_ajax_pages_array = explode(',', $qode_options['internal_no_ajax_links']);

				if(is_array($options_no_ajax_pages_array) && count($options_no_ajax_pages_array)) {
					$no_ajax_pages = array_merge($no_ajax_pages, $options_no_ajax_pages_array);
				}
			}

			//add logout url to main array
			$no_ajax_pages[] = htmlspecialchars_decode(wp_logout_url());

			//finally localize script so we can use it in default_dynamic
			wp_localize_script( 'qode_default_dynamic', 'no_ajax_obj', array(
				'no_ajax_pages' => $no_ajax_pages
			));
		}
	}

	add_action('wp_enqueue_scripts', 'qode_localize_no_ajax_pages');
}

if(!function_exists('qode_get_woocommerce_pages')) {
	/**
	 * Function that returns all url woocommerce pages
	 * @return array array of WooCommerce pages
	 *
	 * @version 0.1
	 */
	function qode_get_woocommerce_pages() {
		$woo_pages_array = array();

		if(qode_is_woocommerce_installed()) {
			if(get_option('woocommerce_shop_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option('woocommerce_shop_page_id')); }
			if(get_option('woocommerce_cart_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option('woocommerce_cart_page_id')); }
			if(get_option('woocommerce_checkout_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option('woocommerce_checkout_page_id')); }
			if(get_option('woocommerce_pay_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option(' woocommerce_pay_page_id ')); }
			if(get_option('woocommerce_thanks_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option(' woocommerce_thanks_page_id ')); }
			if(get_option('woocommerce_myaccount_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option(' woocommerce_myaccount_page_id ')); }
			if(get_option('woocommerce_edit_address_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option(' woocommerce_edit_address_page_id ')); }
			if(get_option('woocommerce_view_order_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option(' woocommerce_view_order_page_id ')); }
			if(get_option('woocommerce_terms_page_id') != ''){ $woo_pages_array[] = get_permalink(get_option(' woocommerce_terms_page_id ')); }

			$woo_products = get_posts(array('post_type' => 'product','post_status' => 'publish', 'posts_per_page' => '-1') );

			foreach($woo_products as $product) {
				$woo_pages_array[] = get_permalink($product->ID);
			}
		}

		return $woo_pages_array;
	}
}

if(!function_exists('qode_get_objects_without_ajax')) {
	/**
	 * Function that returns urls of objects that have ajax disabled.
	 * Works for posts, pages and portfolio pages.
	 * @return array array of urls of posts that have ajax disabled
	 *
	 * @version 0.1
	 */
	function qode_get_objects_without_ajax() {
		$posts_without_ajax = array();

		$posts_args =  array(
			'post_type'  => array('post', 'portfolio_page', 'page'),
			'post_status' => 'publish',
			'meta_key' => 'qode_show-animation',
			'meta_value' => 'no_animation'
		);

		$posts_query = new WP_Query($posts_args);

		if($posts_query->have_posts()) {
			while($posts_query->have_posts()) {
				$posts_query->the_post();
				$posts_without_ajax[] = get_permalink(get_the_ID());
			}
		}

		wp_reset_postdata();

		return $posts_without_ajax;
	}
}

if(!function_exists('qode_get_wpml_pages_for_current_page')) {
	/**
	 * Function that returns urls translated pages for current page.
	 * @return array array of url urls translated pages for current page.
	 *
	 * @version 0.1
	 */
	function qode_get_wpml_pages_for_current_page() {
		$wpml_pages_for_current_page = array();

		if(qode_is_wpml_installed()) {
			$language_pages = icl_get_languages('skip_missing=0');

			foreach($language_pages as $key => $language_page) {
				$wpml_pages_for_current_page[] = $language_page["url"];
			}
		}

		return $wpml_pages_for_current_page;
	}
}

if(!function_exists('qode_is_ajax_enabled')) {
	/**
	 * Function that checks if ajax is enabled.
	 * @return bool
	 *
	 * @version 0.1
	 */
	function qode_is_ajax_enabled() {
		global $qode_options;

		$has_ajax = false;

		if(isset($qode_options['page_transitions']) && $qode_options['page_transitions'] !== '0') {
			$has_ajax = true;
		}

		return $has_ajax;
	}
}

function rewrite_rules_on_theme_activation() {
	flush_rewrite_rules();
}

//when theme is switched flush rewrite rules
add_action( 'after_switch_theme', 'rewrite_rules_on_theme_activation' );

if(!function_exists('qode_visual_composer_installed')) {
	/**
	 * Function that checks if visual composer installed
	 * @return bool
	 */
	function qode_visual_composer_installed() {
		//is Visual Composer installed?
		if(class_exists('WPBakeryVisualComposerAbstract')) {
			return true;
		}

		return false;
	}
}

if(!function_exists('qode_visual_composer_custom_shortcodce_css')){
	function qode_visual_composer_custom_shortcodce_css(){
		if(qode_visual_composer_installed()){
			if(is_page() || is_single() || is_singular('portfolio_page')){
				$shortcodes_custom_css = get_post_meta( qode_get_page_id(), '_wpb_shortcodes_custom_css', true );
				if ( ! empty( $shortcodes_custom_css ) ) {
					echo '<style type="text/css" data-type="vc_shortcodes-custom-css-'.qode_get_page_id().'">';
					echo get_post_meta( qode_get_page_id(), '_wpb_shortcodes_custom_css', true );
					echo '</style>';
				}
				$post_custom_css = get_post_meta( qode_get_page_id(), '_wpb_post_custom_css', true );
				if ( ! empty( $post_custom_css ) ) {
					echo '<style type="text/css" data-type="vc_custom-css-'.qode_get_page_id().'">';
					echo get_post_meta( qode_get_page_id(), '_wpb_post_custom_css', true );
					echo '</style>';
				}
			}
		}
	}
	add_action('qode_visual_composer_custom_shortcodce_css', 'qode_visual_composer_custom_shortcodce_css');
}


if (!function_exists('qode_vc_grid_elements_enabled')) {

	/**
	 * Function that checks if Visual Composer Grid Elements are enabled
	 *
	 * @return bool
	 */
	function qode_vc_grid_elements_enabled() {

		global $qode_options;
		$vc_grid_enabled = false;

		if (isset($qode_options['enable_grid_elements']) && $qode_options['enable_grid_elements'] == 'yes') {

			$vc_grid_enabled = true;

		}

		return $vc_grid_enabled;

	}

}

if(!function_exists('qode_visual_composer_grid_elements')) {

	/**
	 * Removes Visual Composer Grid Elements post type if VC Grid option disabled
	 * and enables Visual Composer Grid Elements post type
	 * if VC Grid option enabled
	 */
	function qode_visual_composer_grid_elements() {

		global $qode_options;

		if(!qode_vc_grid_elements_enabled()){

			remove_action( 'init', 'vc_grid_item_editor_create_post_type' );

		}
	}

	add_action('vc_after_init', 'qode_visual_composer_grid_elements', 12);
}

if(!function_exists('qode_grid_elements_ajax_disable')) {
	/**
	 * Function that disables ajax transitions if grid elements are enabled in theme options
	 */
	function qode_grid_elements_ajax_disable() {
		global $qode_options;

		if(qode_vc_grid_elements_enabled()) {
			$qode_options['page_transitions'] = '0';
		}
	}

	add_action('wp', 'qode_grid_elements_ajax_disable');
}


if(!function_exists('qode_get_vc_version')) {
	/**
	 * Return Visual Composer version string
	 *
	 * @return bool|string
	 */
	function qode_get_vc_version() {
		if(qode_visual_composer_installed()) {
			return WPB_VC_VERSION;
		}

		return false;
	}
}

/*=================================================================================
 * #Contact Form 7 helper functions
 *=================================================================================*/
if(!function_exists('qode_contact_form_7_installed')) {
	/**
	 * Function that checks if contact form 7 installed
	 * @return bool
	 */
	function qode_contact_form_7_installed() {
		//is Contact Form 7 installed?
		if(defined('WPCF7_VERSION')) {
			return true;
		}

		return false;
	}
}



if(!function_exists('qode_attachment_field_custom_size')) {

	function qode_attachment_field_custom_size($form_fields, $post){
		$field_value = get_post_meta($post->ID, 'qode_portfolio_single_predefined_size', true);
		$form_fields['qode_portfolio_single_predefined_size'] = array(
			'label' => 'Masonry Size',
			'input' => 'text',
			'value' => $field_value ? $field_value : ''
		);
		$form_fields["qode_portfolio_single_predefined_size"]["extra_rows"] = array(
			"row1" => "Enter 'large' (twice the size of default image) or 'huge' (three times the size of default image) for Masonry Gallery templates on Portfolio Single Pages."
		);

		return $form_fields;
	}
}
add_filter( 'attachment_fields_to_edit', 'qode_attachment_field_custom_size', 10, 2 );


if(!function_exists('qode_attachment_field_custom_size_save')) {
	function qode_attachment_field_custom_size_save($post, $attachment)
	{
		if (isset($attachment['qode_portfolio_single_predefined_size'])) {
			update_post_meta($post['ID'], 'qode_portfolio_single_predefined_size', $attachment['qode_portfolio_single_predefined_size']);
		}
		return $post;
	}
}

add_filter( 'attachment_fields_to_save', 'qode_attachment_field_custom_size_save', 10, 2 );