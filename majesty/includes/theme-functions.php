<?php

// text domain theme-majesty

/* Define Theme Version */
define( 'SAMA_THEME_VER', '1.3.8');

/* Define Parent Theme Constants */
define( 'SAMA_THEME_DIR', get_template_directory());
define( 'SAMA_THEME_URI', get_template_directory_uri() );
define( 'SAMA_INC_DIR', trailingslashit( SAMA_THEME_DIR ). 'includes' );

/* Define Child Theme Constants */
define( 'THEME_DIR', get_stylesheet_directory() );
define( 'THEME_URI', get_stylesheet_directory_uri() );


// used for global theme options
$majesty_options = sama_get_option_defaults();

// used for wp_kses
$majesty_allowed_tags = sama_allowed_html();

/*-----------------------------------------------------------------------------------*/
/* Load the theme-specific files, with support for overriding via a child theme.
/*-----------------------------------------------------------------------------------*/
$override_template = array(
	'includes/widgets/class-widget-tabs.php',
	'includes/widgets/class-widget-ads.php',
	'includes/widgets/class-widget-shareicon.php',
	'includes/widgets/class-widget-recent-comment-with-avater.php',
	'includes/widgets/class-widget-facebook.php',
	'includes/widgets/class-widget-flickr.php',
	'includes/widgets/class-recent-post.php',
	'includes/widgets/class-opening-time.php',
	'includes/widgets/class-menu-carousel.php',
	'includes/widgets/class-widget-instagram.php',
	'includes/widgets/class-widget-twitter.php',
	'includes/theme-top-slider.php',
);
$includes = array();
if ( ! is_admin() ) {
	if( $majesty_options['enable_advanced_custom_color'] ) {
		$load_custom_color = array(
			'/theme-custom-css-color.php',
		);
		$includes = array_merge($includes,$load_custom_color);
	}
	if( $majesty_options['enable_custom_fonts'] ) {
		$load_custom_fonts = array(
			'/theme-custom-fonts.php',
		);
		$includes = array_merge($includes,$load_custom_fonts);
	}

	if( $majesty_options['enable_typography'] ) {
		$load_custom_typography = array(
			'/theme-custom-typography.php',
		);
		$includes = array_merge($includes,$load_custom_typography);
	}
	
	$includes = array_merge($includes, array(
		'/theme-custom-css.php',
		'/woocommerce/woocommerce-functions.php',
		'/woocommerce/woocommerce-hook.php'
	));
	
	$override_template = array_merge($override_template, array(
		'includes/breadcrumb.php',
	));
}

if ( is_admin() ) {
	$includes_admin = array(
		'/theme-options/theme-options.php',
		'/tgm-plugin-activation/class-tgm-plugin-activation.php',
		'/tgm-plugin-activation/majesty-plugin.php',
		'/metabox/theme-metabox.php'
	);
	$includes = array_merge($includes,$includes_admin);
}

foreach ( $includes as $i ) {
	include(SAMA_INC_DIR . $i);
}

/*
 * This Template can be Override in Child Theme
 */
foreach ( $override_template as $i ) {
	locate_template( $i, true, true );
}
/*
 *	Initialising Visual shortcode editor
 */
if (class_exists('WPBakeryVisualComposerAbstract')) {
	function sama_requireVcExtend(){
		include_once( get_template_directory().'/includes/vc-extend/extend-vc.php');
	}
	add_action('init', 'sama_requireVcExtend',20);
}

function sama_ds_breadcrumb() {

	$breadcrumb = new SAMA_DS_WP_Breadcrumb();
}

//Set up the content width value based on the theme's design.
if ( ! isset( $content_width ) ) $content_width = 870;
function sama_content_width() {

	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 1170;
	} elseif( function_exists('is_project') && is_project() ) {
		$GLOBALS['content_width'] = 1170;
	} elseif( is_page() ) {
		if( is_page_template( 'page-templates/page-fullwidth.php' ) || is_page_template( 'page-templates/page-fullwidth-shortcode.php' ) ){
			$GLOBALS['content_width'] = 1170;
		} elseif( is_page_template( 'page-templates/page-2sidebar.php' ) ) {
			$GLOBALS['content_width'] = 570;
		}
	} elseif( is_single() ) {
		global $post;
		$post_layout = get_post_meta( $post->ID, '_sama_page_layout', true );
		if( $post_layout == '2sidebar' ) {
			$GLOBALS['content_width'] = 570;
		} elseif( $post_layout == 'fullwidth' ) {
			$GLOBALS['content_width'] = 1170;
		}
	}
}
add_action( 'template_redirect', 'sama_content_width' );

/**
 * used for used for wp_kses in visual composer template.
 *
 * @since 1.0
 *
 * @see get_url_in_content()
 *
 * @return array.
 */
function sama_allowed_html() {
	$allowed_tags = wp_kses_allowed_html('post');
	
	$allowed_link = array( 'data-toggle' => true, 'data-delete' => true );
	$allowed_tags['a'] = array_merge( $allowed_tags['a'], $allowed_link);
	
	$allowed_div = array(
		'class'					=> true,
		'id'					=> true,
		'style'					=> true,
		'align'					=> true,
		'title'					=> true,
		'role'					=> true,
		'data-animation'		=> true,
		'data-animation-delay' 	=> true,
		'data-year'				=> true,
		'data-month'			=> true,
		'data-days'				=> true,
		'data-days-label'		=> true,
		'data-hours-label'		=> true,
		'data-minutes-label'	=> true,
		'data-seconds-label'	=> true,
		'data-rtl'				=> true,
		'data-pagination'		=> true,
		'data-items'			=> true,
		'data-itemsdesktop'		=> true,
	);
	$allowed_tags['div'] = array_merge( $allowed_tags['div'], $allowed_div);
	$allowed_tags['i'] = array(
		'class'	=> true,
	);
	return $allowed_tags;
}

/*
 * Enqueues scripts and styles for front-end.
 * @since Majesty 1.2
 */
if ( ! function_exists ( 'sama_enqueue_scripts_styles' ) ) {
	function sama_enqueue_scripts_styles() {
		global $post, $majesty_options;
		$page_id = sama_get_current_page_id();
		
		// prettyphoto CSS & JS name like Visual Composer and isotope && font-awesome css
		// this used in visual composer
		wp_deregister_style('font-awesome');
		wp_deregister_script('prettyphoto');
		wp_deregister_style('prettyphoto');
		wp_deregister_style('isotope');
				
		if( ! $majesty_options['enable_custom_fonts'] ) {
			wp_enqueue_style( 'majesty-theme-fonts', sama_theme_default_google_fonts(), array(), '1.0.0' );
		}
		
		//	Register Styles
		// used in vc open table
		wp_register_style('datetimepicker', 	SAMA_THEME_URI .'/css/jquery.datetimepicker.min.css', '', SAMA_THEME_VER);
		wp_register_style('fullcalendar', 		SAMA_THEME_URI .'/css/fullcalendar.min.css', '', SAMA_THEME_VER);
		// USED to Display Controls for Youtube background Slider
		wp_register_style('jquery.mb.YTPlayer', SAMA_THEME_URI .'/css/jquery.mb.YTPlayer.min.css', '', SAMA_THEME_VER);
		wp_register_style('prettyphoto', 		SAMA_THEME_URI .'/css/prettyPhoto.min.css', '', SAMA_THEME_VER);
				
		//	Enqueue styles
		wp_enqueue_style('bootstrap-min', 		SAMA_THEME_URI .'/css/bootstrap/css/bootstrap.min.css', '', '3.3.4');
		if( is_rtl() ) {
			wp_enqueue_style('bootstrap-rtl', 			SAMA_THEME_URI .'/css/rtl/bootstrap-rtl.min.css', '', SAMA_THEME_VER);
		}
		wp_enqueue_style('font-awesome', 		SAMA_THEME_URI .'/css/font-awesome.min.css', '', '4.3.0');
		wp_enqueue_style('animate', 			SAMA_THEME_URI .'/css/animate.min.css', '', SAMA_THEME_VER);
		wp_enqueue_style('style', 				get_stylesheet_uri(), array('bootstrap-min'), SAMA_THEME_VER);
		if( is_rtl() ) {
			wp_enqueue_style('style-rtl', 			SAMA_THEME_URI .'/css/rtl/style-rtl.min.css', '', SAMA_THEME_VER);
		}
		wp_enqueue_style('themegrid', 			SAMA_THEME_URI .'/css/theme-grid.min.css', '', SAMA_THEME_VER);
		wp_enqueue_style('responsive', 			SAMA_THEME_URI .'/css/main-responsive.min.css', '', SAMA_THEME_VER);
		
		if( is_rtl() ) {
			wp_enqueue_style('main-responsive-rtl', SAMA_THEME_URI .'/css/rtl/main-responsive-rtl.min.css', '', SAMA_THEME_VER);
		}
		// Register Scripts
		/*
		 * Theme Plugins Contain
		 *   &  &   & Superfish Menu Plugin
		 * modernizr			ver 2.6.2 (Custom Build)
		 * Superfish Menu		ver 1.7.5
		 * hoverIntent			ver 1.8.1
		 * jquery.sticky		ver 1.0.2
		 * fluidvids			ver 2.4.1 
		 * easing 				ver 1.3.2
		 * singlePageNav 		ver 1.2.0
		 * placeholders			ver 4.0.1
		 * jRespond				ver 0.10
		 * appear
		 * 
		 */
		wp_register_script('datetimepicker',  	SAMA_THEME_URI .'/js/jquery.datetimepicker.js', array('jquery'), SAMA_THEME_VER, true);
		wp_register_script('theme-plugins',  	SAMA_THEME_URI .'/js/theme-plugins.js', array('jquery'), SAMA_THEME_VER, true);
		wp_register_script('google-maps', 		'https://maps.googleapis.com/maps/api/js?key='.esc_attr($majesty_options['gmaps_api']).'&amp;extension=.js', array('jquery'), SAMA_THEME_VER, true);
		wp_register_script('YTPlayer',  		SAMA_THEME_URI .'/js/jquery.mb.YTPlayer.min.js', array('jquery'), SAMA_THEME_VER, true); // 14-06-2015
		wp_register_script('jflickrfeed',  		SAMA_THEME_URI .'/js/jflickrfeed.min.js',  array('jquery'), SAMA_THEME_VER, true);
		wp_register_script('skippr',  			SAMA_THEME_URI .'/js/skippr.min.js', '', SAMA_THEME_VER, true);
		wp_register_script('owl-carousel',  	SAMA_THEME_URI .'/js/carousal/owl.carousel.min.js', array('jquery'), '1.3.3', true);
		wp_register_script('swiper',  			SAMA_THEME_URI .'/js/swiper.min.js', array('jquery'), '3.0.8', true);
		wp_register_script('interactive_bg',  	SAMA_THEME_URI .'/js/jquery.interactive_bg.min.js', array('jquery'), '1.0', true);
		wp_register_script('okvideo',  			SAMA_THEME_URI .'/js/okvideo.min.js', array('jquery'), '2.3.2', true);
		wp_register_script('isotope',  			SAMA_THEME_URI .'/js/jquery.isotope.js', '', '2.2.0', true);
		wp_register_script('movementbg',  		SAMA_THEME_URI .'/js/move-bg.js', array('jquery'), '1.0', true);
		wp_register_script('bgndgallery',  		SAMA_THEME_URI .'/js/bggallery/bgndGallery.min.js', array('jquery'), SAMA_THEME_VER, true);
		wp_register_script('countdownplugin',  	SAMA_THEME_URI .'/js/countdown/jquery.plugin.min.js', array('jquery'), '1.0.1', true);
		wp_register_script('countdown',  		SAMA_THEME_URI .'/js/countdown/jquery.countdown.min.js', array('countdownplugin'), '2.0.2', true);
		wp_register_script('theme-script',  	SAMA_THEME_URI .'/js/theme-scripts.min.js', array('jquery'), SAMA_THEME_VER, true);
		wp_register_script('bootstrap',  		SAMA_THEME_URI .'/js/bootstrap.min.js', array('jquery'), '3.3.5', true);
		wp_register_script('owl-single-product',SAMA_THEME_URI .'/js/owl-single-product.js', array('jquery'), SAMA_THEME_VER, true);
		// Parallax
		wp_register_script('skrollr',  			SAMA_THEME_URI .'/js/skrollr.min.js', array('jquery'), '0.6.30', true);
		wp_register_script('prettyphoto',  		SAMA_THEME_URI .'/js/jquery.prettyPhoto.js', array('jquery'), '3.1.6', true);
		
		
		wp_enqueue_script('theme-plugins');
		wp_enqueue_script('bootstrap');
		wp_enqueue_script('isotope'); // or used woo shortcode
				
		if( is_page_template( 'page-templates/page-builder.php') || is_page_template( 'page-templates/page-blank.php' ) ) {
			$slider_type = get_post_meta( $page_id, '_sama_slider_type', true );
			if( $slider_type == 'skipper' ) {
				wp_enqueue_script('skippr');
			} elseif ( $slider_type == 'bgndgallery' ) {
				wp_enqueue_script('bgndgallery');
			} elseif( $slider_type == 'youtubebg' ) {
				wp_enqueue_script('YTPlayer');
				wp_enqueue_style('jquery.mb.YTPlayer');
			} elseif( $slider_type == 'vimeobg' ) {
				wp_enqueue_script('okvideo');
			} elseif( $slider_type == 'movementbg' ) {
				wp_enqueue_script('movementbg');
			} elseif( $slider_type == 'interactivebg' ) {
				wp_enqueue_script('interactive_bg');
			} elseif( $slider_type == 'parallaxbg' ) {
				wp_enqueue_script('skrollr');
			} elseif( $slider_type == 'swiper' ) {
				wp_enqueue_script('swiper');
			}
		}
		
		// Single Shop
		if( function_exists( 'is_product' ) && is_product() ) {
			wp_enqueue_style('prettyphoto');
			wp_enqueue_script('prettyphoto');
			wp_enqueue_script('owl-carousel');
			wp_enqueue_script('owl-single-product');
		}
		
		// single team member
		if( is_singular('team-member') ) {
			wp_enqueue_script('owl-carousel');
			if( $majesty_options['related_bg_parallax'] == 'yes' && ! empty( $majesty_options['related_member_bg'] ) ) {
				wp_enqueue_script('skrollr');
			}
		}
		if( is_page() && isset($post->post_content) ) {
			
			if( has_shortcode( $post->post_content, 'vc_add_gmaps') || has_shortcode( $post->post_content, 'sama_gmaps') ) { 
				wp_enqueue_script('google-maps');
			}
			
			if( has_shortcode( $post->post_content, 'sama_lightbox') ) { 
				wp_enqueue_style('prettyphoto');
				wp_enqueue_script('prettyphoto');
			}
			
			if( has_shortcode( $post->post_content, 'sama_countdown') ) { 
				wp_enqueue_script('countdown');
			}
			
			if( has_shortcode( $post->post_content, 'vc_open_table') ) { 
				wp_enqueue_style('datetimepicker');
			}
			
			if( has_shortcode( $post->post_content, 'vc_restaurant_reservations') || has_shortcode( $post->post_content, 'booking-form') ) { 
				wp_enqueue_style( 'rtb-booking-form' );
				wp_enqueue_style( 'pickadate-default' );
				wp_enqueue_style( 'pickadate-date' );
				wp_enqueue_style( 'pickadate-time' );
				if( is_rtl() ) {
					wp_enqueue_script( 'pickadate-rtl' );
				}
			}
		}
			
		if( ! empty( $majesty_options['owl-carousel-pages'] ) && in_array( $page_id,  $majesty_options['owl-carousel-pages'] ) ) {
			wp_enqueue_script('owl-carousel');
		}
		if( ! empty( $majesty_options['countdow-pages'] ) && in_array( $page_id,  $majesty_options['countdow-pages'] ) ) {
			wp_enqueue_script('countdown');
		}
		if( ! empty( $majesty_options['prettyphoto-pages'] ) && in_array( $page_id,  $majesty_options['prettyphoto-pages'] ) ) {
			wp_enqueue_style('prettyphoto');
			wp_enqueue_script('prettyphoto');
		}
		
		// check if pages have parallax BG
		$run_function = sama_get_custom_header_background_img();
		if( $majesty_options['head_parallax'] = 'yes' && ! empty( $majesty_options['head_bg'] ) ) {
			wp_enqueue_script('skrollr');
		}
		
		if ( !is_front_page() && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script('comment-reply');
		}
		
		/*
		 * Events Page Full Cleander Plugin
		 * Enable FullCalendare css
		 */
		if( class_exists('WP_FullCalendar') ) {
			$calendare_pages = get_option( 'wpfc_scripts_limit' );
			if( $calendare_pages ) {
				$calendare_pages = explode(',', $calendare_pages );
				if( in_array( $page_id, $calendare_pages) ) {
					wp_enqueue_style('fullcalendar');
				}
			}
		}
		
		if( is_singular('post') ) {
			$postformat = get_post_format( get_the_ID() );
			if( $postformat == 'gallery' ) {
				wp_enqueue_script('owl-carousel');
			}	
			$lightbox = get_post_meta( get_the_ID(), '_sama_lightbox', true );
			if( ! empty( $lightbox ) && is_array( $lightbox ) && in_array('open', $lightbox ) ) {
				wp_enqueue_style('prettyphoto');
				wp_enqueue_script('prettyphoto');
			}
		}
		if( $majesty_options['enable_theme_color_style'] && ! empty( $majesty_options['themecolorstyle'] ) && ! $majesty_options['enable_advanced_custom_color']) {
			wp_enqueue_style(esc_attr($majesty_options['themecolorstyle']), SAMA_THEME_URI .'/css/themes/'. esc_attr($majesty_options['themecolorstyle']) .'.css', '', SAMA_THEME_VER);
		}
		
		$bookingpage = get_option('rtb-settings');
		if( $bookingpage && isset( $bookingpage['booking-page'] ) && $bookingpage['booking-page'] == $page_id ) {
			wp_enqueue_style( 'rtb-booking-form' );
			wp_enqueue_style( 'pickadate-default' );
			wp_enqueue_style( 'pickadate-date' );
			wp_enqueue_style( 'pickadate-time' );
			if( is_rtl() ) {
				wp_enqueue_script( 'pickadate-rtl' );
			}
		}
		
		wp_enqueue_script('theme-script');
		 
		if( $majesty_options['enable_custom_css'] ) {
			wp_enqueue_style('majesty-custom-css', THEME_URI .'/css/theme-custom-css.css', '', SAMA_THEME_VER);
		}
		// This used to load custom css file defined by user
		if( $majesty_options['enable_custom_js'] ) {
			wp_enqueue_script('majesty-custom-js', THEME_URI .'/js/theme-custom-js.js', '', SAMA_THEME_VER, true);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'sama_enqueue_scripts_styles', 100);

/*
 * Return URL for goole fonts used in theme
 *
 */
function sama_theme_default_google_fonts() {	
	$fonts_url = add_query_arg( 'family', urlencode( 'Fjalla One|Courgette|Herr Von Muellerhoff|Open Sans:300,400,600&subset=latin'), "//fonts.googleapis.com/css" );
	
	return $fonts_url;
}

/* 
 *	Contact Form 7  	Activate HTML5 fallback support
 *  This is important when using this plugin as reservations
 */
add_filter( 'wpcf7_support_html5_fallback', '__return_true' );

/*
 *	Disable Contact Form 7 Begin Loading
 * @see sama_enqueue_scripts_styles_contactform7()
 */
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

function sama_enqueue_scripts_styles_contactform7() {
	global $post, $majesty_options;
	$page_id = sama_get_current_page_id();
	
	// Contact Form 7
	if( ! empty( $majesty_options['contactform7-pages'] ) ) {
		
		if( in_array( $page_id,  $majesty_options['contactform7-pages'] ) ) {
			if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
					wpcf7_enqueue_scripts();
				}
			 
				if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
					wpcf7_enqueue_styles();
				}
		} else {
			// Disbale jQuery and css
			add_filter( 'wpcf7_load_js', '__return_false' );
			add_filter( 'wpcf7_load_css', '__return_false' );
		}
	} else {
		if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
			wpcf7_enqueue_scripts();
		}
			 
		if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
			wpcf7_enqueue_styles();
		}
	}
}
add_action( 'wp_enqueue_scripts', 'sama_enqueue_scripts_styles_contactform7', 10);

/*
 *	Admin Enqueue scripts  
 *	Used for VC Elments
 */
function sama_admin_enqueue_scripts_styles() {
	global $pagenow;
	if( $pagenow == 'edit.php' || $pagenow == 'post-new.php' || $pagenow == 'post.php' ) {
		// Used To hide metamox not required
		wp_enqueue_style('iconmoonvc', 			SAMA_THEME_URI .'/css/admin/iconmoon.css', '', SAMA_THEME_VER);
		wp_enqueue_script( 'postmetabox', SAMA_THEME_URI . '/js/admin/metabox.js', '', SAMA_THEME_VER, true);
	}	
}
add_action( 'admin_enqueue_scripts', 'sama_admin_enqueue_scripts_styles', 1000 );

/*
 * used in post format link
 * to get first URL
 */
if ( ! function_exists( 'sama_get_link_url' ) ) {
	/**
	 * Return the post URL.
	 *
	 * Falls back to the post permalink if no URL is found in the post.
	 *
	 * @since 1.0
	 *
	 * @see get_url_in_content()
	 *
	 * @return string The Link format URL.
	 */
	function sama_get_link_url() {
		$has_url = get_url_in_content( get_the_content() );

		return $has_url ? $has_url : false ;
	}
}

/**
 *	Sets up theme defaults and 
 *  registers the various WordPress features that theme support 
 *	
 * @since Majesty 1.0
 */
if ( ! function_exists ( 'themes_majesty_setup' ) ) {
	function themes_majesty_setup() {
		/*
		 * Make majesty available for translation.
		 *
		 * Translations can be added to the /languages/ directory.
		 * If you're building a theme based on majesty, use a find and
		 * replace to change 'majesty' to the name of your theme in all
		 * template files.
		 */
		
		load_theme_textdomain( 'theme-majesty', get_template_directory() . '/languages' );
		
		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();
		
		// Adds RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );
		
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		
		
		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
		) );
				
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'top-menu' 			=> esc_html__( 'Top Menu', 'theme-majesty' ),
			'top-menu-2' 	=> esc_html__( 'Second Top menu', 'theme-majesty' ),
		));
		
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		
		// Adds Support to woocommerce plugin
		add_theme_support( 'woocommerce' );
		
		// Enable support for Post Thumbnails, and declare two sizes.
		add_theme_support('post-thumbnails');
		
		add_image_size('majesty-thumb-60', 			60, 	60,  true); // Using in Blog Widget
		add_image_size('majesty-thumb-100', 		100, 	100, true); // Using to Display Woocommerce List
		add_image_size('majesty-thumb-450', 		450, 	450, true);
		add_image_size('majesty-thumb-555', 		555, 	555, true);
		add_image_size('majesty-thumb-600-360', 	600, 	360, true);
		add_image_size('majesty-thumb-1170', 		1170, 	500, true);
		add_image_size('majesty-thumb-818', 		818, 	350, true);
		add_image_size('majesty-thumb-585', 		450, 	585, true); // Shop masonry
		add_image_size('majesty-thumb-286', 		450, 	286, true);
		add_image_size('majesty-woo-slider-large', 	871, 	597, true); // Used In Woo Slider
		add_image_size('majesty-slider-thumb', 		228, 	114, true); // Slider With Thumbnails
		add_image_size('majesty-blog-thumb-masonry',550, 	1215, true);
		
		add_image_size('majesty-shop-400',400, 	400, true);
	}
}
add_action( 'after_setup_theme', 'themes_majesty_setup' );




/*
 *	Support title tag for Old Wordpress Version < 4.1
 */
if ( ! function_exists( '_wp_render_title_tag' ) ) {

	function sama_theme_slug_render_title() {
?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'sama_theme_slug_render_title' );
}


/**
 * Registers our main widget area.
 *
 * @since majesty 1.0
 */
if ( ! function_exists ( 'sama_widgets_init' ) ) {

	function sama_widgets_init() {
		// default sidebar
		register_sidebar( array(
			'name' 			=> esc_html__( 'Default Sidebar', 'theme-majesty' ),
			'id' 			=> 'sidebar',
			'description' 	=> esc_html__( 'Appears on all posts and pages.', 'theme-majesty' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</aside>',
			'before_title' 	=> '<h3 class="widget-title">',
			'after_title' 	=> '</h3><span class="sidebar_divider"></span>',
		));

		//Footer
		register_sidebars( 4, array(
			'name'          => 'Footer %d',
			'id'            => 'footer',
			'description' 	=> esc_html__( 'The sidebar for footer widget.', 'theme-majesty' ),
			'class'         => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="titleHeader clearfix"><h3 class="widget-title">',
			'after_title'   => '</h3></div>' 
		));
	}
}
add_action( 'widgets_init', 'sama_widgets_init' );

/*
 * Widget Tags
 * make largest and smallest fontsize for tags as same.
 *
 * @since majesty 1.0
 */
if ( ! function_exists ( 'sama_widget_tag_cloud_args' ) ) {

	function sama_widget_tag_cloud_args( $args ) {
		$args['largest'] = 13; // make largest and smallest the same - i don't like the varying font-size look
		$args['smallest'] = 13;
		$args['unit'] = 'px';
		return $args;
	}
}

add_filter( 'widget_tag_cloud_args', 'sama_widget_tag_cloud_args' ); // WP Default tag widget
add_filter( 'woocommerce_product_tag_cloud_widget_args', 'sama_widget_tag_cloud_args' );// Woocommerce Default widget

/*
 * Return Current Page ID
 * Used To get Background
 */
function sama_get_current_page_id() {
	$current_page = -1;
	
	if ( is_front_page() && is_home() ) {
		$page_for_posts = get_option( 'page_for_posts' );
		if( ! empty( $page_for_posts ) && $page_for_posts != -1 ) {
			$current_page = $page_for_posts;
		}
	} elseif ( is_front_page() ) {
		$page_id = get_option('page_on_front');
		if( ! empty( $page_id ) && $page_id != -1 ) {
			$current_page = $page_id;
		}
	} elseif ( is_home() ) {
		// Blog page
		$page_for_posts = get_option( 'page_for_posts' );
		if( ! empty( $page_for_posts ) && $page_for_posts != -1 ) {
			$current_page = $page_for_posts;
		}
	} elseif ( ( function_exists('is_projects_archive') && is_projects_archive() ) || ( function_exists('is_project_category') && is_project_category() ) ) {
		$projects_page_id = projects_get_page_id( 'projects' );
		if( ! empty( $projects_page_id ) && $projects_page_id != -1 ) {
			$current_page = projects_get_page_id( 'projects' );
		}
	} elseif( is_post_type_archive( 'team-member' ) ) {
		$team_member  = -1;
	} elseif( function_exists('is_shop') && is_shop() ) {
		$current_page = get_option( 'woocommerce_shop_page_id' );
	} elseif( function_exists('is_product_category') && is_product_category() ) {
		$current_page = get_option( 'woocommerce_shop_page_id' );
	} elseif( function_exists('is_product_tag') && is_product_tag() ) {
		$current_page = get_option( 'woocommerce_shop_page_id' );
	} elseif( function_exists( 'is_project' ) && is_project() ) {
		$current_page = get_the_ID();
	} elseif( is_404() ) {
		$current_page = -2;
	} elseif( is_page() ) {
		$current_page = get_the_ID();
	} elseif ( is_post_type_archive('post') ) {
		$page_for_posts = get_option( 'page_for_posts' );
		if( ! empty( $page_for_posts ) && $page_for_posts != -1 ) {
			$current_page = $page_for_posts;
		}
	}
	
	return $current_page;
}

/*
 *	Custom Header Background
 */
function sama_get_custom_header_background_img() {
	global $majesty_options;
	
	$img_url = '';
	$subtitle = '';
	$current_page = -1;
	$team_member  = false;
	$single_product_bg = false;
	$single_team_member_bg = false;
	$single_post_bg = false;
	if ( is_front_page() && is_home() ) {
		$page_for_posts = get_option( 'page_for_posts' );
		if( ! empty( $page_for_posts ) && $page_for_posts != -1 ) {
			$current_page = $page_for_posts;
		}
	} elseif ( is_front_page() ) {
		$page_id = get_option('page_on_front');
		if( ! empty( $page_id ) && $page_id != -1 ) {
			$current_page = $page_id;
		}
	} elseif ( is_home() ) {
		$page_for_posts = get_option( 'page_for_posts' );
		if( ! empty( $page_for_posts ) && $page_for_posts != -1 ) {
			$current_page = $page_for_posts;
		}
	} elseif( is_category() ) {
		if( $majesty_options['blog_cat_bg'] ) {
			$page_for_posts = get_option( 'page_for_posts' );
			if( ! empty( $page_for_posts ) && $page_for_posts != -1 ) {
				$current_page = $page_for_posts;
			}
		} else {
			$current_page = -1;
		}
	} elseif( is_tag() ) {
		if( $majesty_options['blog_tag_bg'] ) {
			$page_for_posts = get_option( 'page_for_posts' );
			if( ! empty( $page_for_posts ) && $page_for_posts != -1 ) {
				$current_page = $page_for_posts;
			}
		} else {
			$current_page = -1;
		}
	} elseif( is_author() ) {
		if( $majesty_options['blog_author_bg'] ) {
			$page_for_posts = get_option( 'page_for_posts' );
			if( ! empty( $page_for_posts ) && $page_for_posts != -1 ) {
				$current_page = $page_for_posts;
			}
		} else {
			$current_page = -1;
		}
	} elseif ( ( function_exists('is_projects_archive') && is_projects_archive() ) || ( function_exists('is_project_category') && is_project_category() ) ) {
		$projects_page_id = projects_get_page_id( 'projects' );
		if( ! empty( $projects_page_id ) && $projects_page_id != -1 ) {
			$current_page = projects_get_page_id( 'projects' );
		}
	} elseif( is_post_type_archive( 'team-member' ) ) {
		$team_member  = true;
	} elseif( is_tax('team-member-category') ) {
		if( $majesty_options['team_cat_bg'] ) {
			$team_member  = true;
		} else {
			$current_page = -1;
		}
	} elseif( function_exists('is_shop') && is_shop() ) {
		$current_page = get_option( 'woocommerce_shop_page_id' );
	} elseif( function_exists('is_product_category') && is_product_category() ) {
		if( $majesty_options['shop_cat_bg'] ) {
			$current_page = get_option( 'woocommerce_shop_page_id' );
		} else {
			$current_page = -1;
		}
	} elseif( function_exists('is_product_tag') && is_product_tag() ) {
		if( $majesty_options['shop_tag_bg'] ) {
			$current_page = get_option( 'woocommerce_shop_page_id' );
		} else {
			$current_page = -1;
		}
	} elseif( function_exists( 'is_project' ) && is_project() ) {
		$current_page = get_the_ID();
	} elseif( is_singular('product') ) {
		if( $majesty_options['shop_single_product_bg'] ) {
			$single_product_bg = true;
		} else {
			$current_page = -1;
		}
	} elseif( is_singular('team-member') ) {
		if( $majesty_options['team_single_post_bg'] ) {
			$single_team_member_bg = true;
		} else {
			$current_page = -1;
		}
	} elseif( is_singular('post') ) {
		if( $majesty_options['blog_single_post_bg'] ) {
			$single_post_bg = true;
		} else {
			$current_page = -1;
		}
	} elseif( is_404() ) {
		$current_page = -2;
		$majesty_options['menu_has_trans'] 	= true;
	} elseif( is_page() ) {
		$current_page = get_the_ID();
	}
	
	if( is_404() ) {
		$majesty_options['menu_has_trans'] 	= true;
	}
	if( $team_member ) {
		$img_url  = $majesty_options['team_mem_head_bg'];
		$subtitle = $majesty_options['team_mem_subtitle'];
		if( ! empty( $img_url ) ) {
			$majesty_options['menu_has_trans'] 	= true;
			$majesty_options['head_bg'] 			= $img_url;
			$majesty_options['head_sub_title'] 	= $subtitle;
			$majesty_options['head_display_icon'] = 'yes';
			$majesty_options['head_icon_css'] 	= 'icon-home-ico';
			$majesty_options['head_parallax'] 	= 'yes';
		}
	} elseif( $single_product_bg ) {
		// Used For Single Product Backgroud
		$img_url  = $majesty_options['shop_single_bg'];
		$subtitle = $majesty_options['shop_single_subtitle'];
		if( ! empty( $img_url ) ) {
			$majesty_options['menu_has_trans'] 	= true;
			$majesty_options['head_bg'] 			= $img_url;
			$majesty_options['head_sub_title'] 	= $subtitle;
			$majesty_options['head_display_icon'] = 'yes';
			$majesty_options['head_icon_css'] 	= 'icon-home-ico';
			$majesty_options['head_parallax'] 	= 'yes';
		}
	} elseif( $single_team_member_bg ) {
		// Used For Single Team member Backgroud
		$img_url  = $majesty_options['team_single_bg'];
		$role 	  = get_post_meta( get_the_ID(), '_byline', true);
		if( $role ) {
			$subtitle = $role;
		} else {
			$subtitle = $majesty_options['team_mem_subtitle'];
		}
		
		if( ! empty( $img_url ) ) {
			$majesty_options['menu_has_trans'] 	= true;
			$majesty_options['head_bg'] 			= $img_url;
			$majesty_options['head_sub_title'] 	= $subtitle;
			$majesty_options['head_display_icon'] = 'yes';
			$majesty_options['head_icon_css'] 	= 'icon-home-ico';
			$majesty_options['head_parallax'] 	= 'yes';
		}
	} elseif( $single_post_bg ) {
		// Used For Single Post Backgroud
		$img_url  = $majesty_options['blog_single_bg'];
		$subtitle = $majesty_options['blog_single_subtitle'];
		if( ! empty( $img_url ) ) {
			$majesty_options['menu_has_trans'] 	= true;
			$majesty_options['head_bg'] 			= $img_url;
			$majesty_options['head_sub_title'] 	= $subtitle;
			$majesty_options['head_display_icon'] = 'yes';
			$majesty_options['head_icon_css'] 	= 'icon-home-ico';
			$majesty_options['head_parallax'] 	= 'yes';
		}
	} elseif( $current_page != -1 ) {
		$has_custom_bg 	= get_post_meta( $current_page, '_sama_page_with_bg', true );
		$header_bg 		= get_post_meta( $current_page, '_sama_page_bg', true );
		if( $has_custom_bg && ! empty( $header_bg ) ) {
			$majesty_options['menu_has_trans'] 	= true;
			
			$sub_title 		= get_post_meta( $current_page, '_sama_page_subtitle', true );
			$display_icon 	= get_post_meta( $current_page, '_sama_page_display_icon', true );
			$icon_css 		= get_post_meta( $current_page, '_sama_page_icon_css', true );
			$has_parallax 	= get_post_meta( $current_page, '_sama_page_bg_parallax', true );
			
			$majesty_options['head_bg'] 			= $header_bg;
			$majesty_options['head_sub_title'] 	= $sub_title;
			$majesty_options['head_display_icon'] = $display_icon;
			$majesty_options['head_icon_css'] 	= $icon_css;
			$majesty_options['head_parallax'] 	= $has_parallax;
		}
	}
	if(  ! empty( $majesty_options['head_bg'] ) ) {
		return $majesty_options['head_bg'];
	} else {
		return false;
	}
}

/*
 *	Add Favicon To header
 *	@since 1.0
 */
if ( ! function_exists ( 'sama_add_favicon_to_head' ) ) {
	function sama_add_favicon_to_head() {
		global $majesty_options;
		
		if( ! empty( $majesty_options['favicon'] ) ) { ?>
			<link rel="shortcut icon" href="<?php echo esc_url( $majesty_options['favicon']['url'] ); ?>">
	<?php
		}
		if( ! empty( $majesty_options['apple_touch_icon_57'] ) ) { ?>
			<link rel="apple-touch-icon" href="<?php echo esc_url( $majesty_options['apple_touch_icon_57']['url'] ); ?>">
	<?php 
		}
		if( ! empty( $majesty_options['apple_touch_icon_72'] ) ) { ?>
			<link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url( $majesty_options['apple_touch_icon_72']['url'] ); ?>">
	<?php
		}
		if( ! empty( $majesty_options['apple_touch_icon_114'] ) ) { ?>
			<link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url( $majesty_options['apple_touch_icon_114']['url'] ); ?>">
	<?php 
		}
	}
}
add_action('wp_head', 'sama_add_favicon_to_head');

/*
 * Custom Excerpt Length
 * @since 1.0
 * @see excerpt_length filter.
 * @param int $length Change default wordpress Excerpt length for blog.
 * @return int.
 */
function sama_custom_excerpt_length( $length ) {
	global $majesty_options;
	$length = $majesty_options['blog_excerpt'];	
	return apply_filters('sama_custom_excerpt_length_filter', $length);
}
add_filter( 'excerpt_length', 'sama_custom_excerpt_length', 999 );

/*
 * More Link For Blog
 * @since 1.0
 * @see excerpt_more filter.
 * @param string $more display more text.
 * @return string.
 */
function sama_excerpt_more( $more ) {
	
	global $majesty_options;
	$blog_type 	= $majesty_options['blog_type'];
	if( $blog_type == 'blog-list-small-thumb' || $blog_type == 'blog-list-big-thumb') {
		$more = '...';
	} else {
		// blog grid
		$more = '';
	}
	
	return $more;
}
add_filter( 'excerpt_more', 'sama_excerpt_more' );


/*
 * Used in VC For Blog
 * since 1.0
 */
function sama_get_custom_excerpt($excerpt_length = 20, $new_more = '...') {
	
	$content = get_the_content();
	$content = strip_shortcodes($content);
	$content = str_replace(']]>', ']]&gt;', $content);
	$content = strip_tags($content);
	$excerpt_length = absint( $excerpt_length );
	$words = explode(' ', $content, $excerpt_length + 1);
	if( count( $words ) > $excerpt_length ) {
		array_pop($words);
		$content = implode(' ', $words);
	}
 
  // wrap it back up in p tags
  $output = '<p>'. $content .'</p>';
  
  return $output;
}


/*
 * Output HTML5 Time Format
 * @since 1.0
 * @return string html5 time format.
 */
function sama_output_html5_time_format() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	echo '<time class="entry-date" datetime="'. esc_attr( get_the_date( 'c', get_the_id() ) ) .'">'. esc_attr( get_the_date( '', get_the_id() ) ) .'</time>';
}

if ( ! function_exists( 'sama_paging_nav' ) ) {
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 *
	 * @since majesty 1.0
	 */
	function sama_paging_nav() {
		global $majesty_allowed_tags;
		
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $GLOBALS['wp_query']->max_num_pages,
			'current'  => $paged,
			'mid_size' => 2,
			'type'	   => 'list',
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => esc_html__('Previous', 'theme-majesty'),
			'next_text' => esc_html__('Next', 'theme-majesty'),
		) );

		if ( $links ) :
		?>
		<div class="col-md-12 clearfix">
			<nav class="navigation">
				<?php echo wp_kses( $links, $majesty_allowed_tags ); ?>
			</nav>
		</div>
		<?php
		endif;
	}
}

/*
 * Used to get css for blog
 * @since 1.0
 *
 * @param string $type column css for columns, article css for article, blog, image, content css for blog
 * @return string css class for blog.
 */
if ( ! function_exists( 'sama_get_css_for_blog' ) ) {
	
	function sama_get_css_for_blog( $type = 'blog' ) {
		global $majesty_options;
		
		$css_output = $css_sidebar = '';
		$blog_type 	= $majesty_options['blog_type'];
		$sidebar	= $majesty_options['blog_with_sidebar'];
		$blog_forced_full_width = array('blog-gird-full-width', 'blog-masonry-2-col', 'blog-masonry-3-col', 'blog-masonry-4-col', 'blog-masonry-full-width');
		
		if( in_array( $blog_type, $blog_forced_full_width ) ) {
			$css_sidebar = ' blog-full-width';
		} elseif( $sidebar ) {
			$css_sidebar = ' blog-with-sidebar';
		} else {
			$css_sidebar = ' blog-full-width';
		}
		
		if( $type == 'blog' ) {
			$css_output = 'blog-grid ' . esc_attr( $blog_type ) . $css_sidebar;
			if( $blog_type == 'blog-list-small-thumb' ) {
				$css_output = 'blog_list ' . esc_attr( $blog_type ) . $css_sidebar;
			}
			if( $blog_type == 'blog-list-big-thumb' || $blog_type == 'wpdefault'  ) {
				$css_output = 'blog_list_2 ' . esc_attr( $blog_type ) . $css_sidebar;
			}
			if( $blog_type == 'blog-masonry-4-col' ) {
				$css_output = 'masonary_blog masonry_four text-center ' . esc_attr( $blog_type ) . $css_sidebar;
			} elseif ( $blog_type == 'blog-masonry-3-col' ) {
				$css_output = 'masonary_blog masonry_three'; //col-st-6
			} elseif ( $blog_type == 'blog-masonry-2-col' ) {
				$css_output = 'masonary_blog masonry_two'; //col-st-6
			} elseif (  $blog_type == 'blog-masonry-full-width' ) {
				$css_output = 'masonary_blog masonry_full_width';
			}
		} elseif ( $type == 'article' ) {
			
			if ( $blog_type == 'blog-gird-4-col' || $blog_type == 'blog-gird-full-width' ) {
				$css_output = 'blog-item col-md-3 col-sm-4 col-xs-12 col-st-6';
			} elseif( $blog_type == 'blog-gird-3-col' ) {
				$css_output = 'blog-item col-md-4 col-sm-6 col-xs-12 col-st-6';
			} elseif( $blog_type == 'blog-gird-2-col' ) {
				$css_output = 'blog-item col-md-6 col-sm-6 col-xs-12 col-st-6';
			} elseif( $blog_type == 'blog-list-small-thumb' || $blog_type == 'blog-list-big-thumb'  || $blog_type == 'wpdefault'  ) {
				$css_output = 'blog_row';
			} elseif( $blog_type == 'blog-masonry-4-col' ) {
				$css_output = 'menu-item blog-item col-md-3 col-sm-4 col-xs-12'; //col-st-6
			} elseif ( $blog_type == 'blog-masonry-3-col' ) {
				$css_output = 'menu-item blog-item col-md-4 col-sm-6 col-xs-12'; //col-st-6
			} elseif ( $blog_type == 'blog-masonry-2-col' ) {
				$css_output = 'menu-item blog-item col-md-6 col-sm-6 col-xs-12'; //col-st-6
			} elseif (  $blog_type == 'blog-masonry-full-width' ) {
				$css_output = 'menu-item blog-item col-md-3 col-sm-4 col-xs-12';
			}
		} elseif( $type == 'thumbnail' ) {
			
			if ( $blog_type == 'blog-list-small-thumb' || $blog_type == 'blog-list-big-thumb' || $blog_type == 'wpdefault' ) {
				if( $blog_type == 'blog-list-big-thumb' || $blog_type == 'wpdefault' ) {
					$css_output  = 'blog-img col-md-12';
				} else {
					$css_output  = 'blog-img col-md-6 col-sm-6 col-xs-12';
				}
			}
		
		} elseif( $type == 'content' ) {
			if ( $blog_type == 'blog-list-small-thumb' || $blog_type == 'blog-list-big-thumb'  || $blog_type == 'wpdefault' ) {
				if( $blog_type == 'blog-list-big-thumb'  || $blog_type == 'wpdefault' ) {
					$css_output = 'blog-content col-md-12';
				} else {
					$css_output = 'blog-content col-md-6 col-sm-6 col-xs-12';
				}
			}
		}
		
		return $css_output;
	}
}

/*
 * used for blog masonry 3 columns to assign large image
 * Return array
 */
function sama_get_masonory_larg_3col () {
	$masonory_larg = array( 1,3,5,13,15, 17);	
	return $masonory_larg;
}

/*
 * used for blog masonry 2 columsn to assign large image
 * Return array
 */
function sama_get_masonory_larg_2col () {
	$masonory_larg = array( 1,3,9,11);
	return $masonory_larg;
}

/*
 * used for blog masonry Full Width to assign large image
 * Return array
 */
function sama_get_masonory_larg_fullwidth () {
	// 4 Columsn
	$masonory_larg = array( 1,4,7,15,18,21);
	return $masonory_larg;
}

/*
 * used for Shop masonry to assign large image
 * Return array
 */
function sama_shop_masonry_loop() {
	return array( 1, 7, 11, 17, 21, 27);
}

/*
 * Used to get Thumbnail blog size
 * @since 1.0
 *
 * @param string $type column css for columns, article css for article, blog, image, content css for blog
 * @return string css class for blog.
 */
if ( ! function_exists( 'sama_get_thumb_size_blog' ) ) {
	
	function sama_get_thumb_size_blog() {
		global $majesty_options;
		$masonory_larg_3c = sama_get_masonory_larg_3col();
		$masonory_larg_full_width = sama_get_masonory_larg_fullwidth();
		$masonory_larg_2c = sama_get_masonory_larg_2col();
		$thumb_size = 'majesty-thumb-450';
		if( is_archive() || is_search() ) {
			$blog_type 	= $majesty_options['blog_archive_type'];
			$blog_loop  = isset( $majesty_options['loop_masonry'] ) ? $majesty_options['loop_masonry'] : false;
			$sidebar	= $majesty_options['archive_with_sidebar'];
		} else {
			$blog_type 	= $majesty_options['blog_type'];
			$blog_loop  = isset( $majesty_options['loop_masonry'] ) ? $majesty_options['loop_masonry'] : false;
			$sidebar	= $majesty_options['blog_with_sidebar'];
		}
		
		if ( $blog_type == 'blog-masonry-3-col' ) {
			if( isset( $blog_loop ) && ( in_array( $blog_loop, $masonory_larg_3c ) ) ) {
				if( $majesty_options['blog_mas_thumb'] == 'masonrythumb' ) {
					$thumb_size = 'majesty-blog-thumb-masonry';
				} else {
					$thumb_size = 'full';
				}
			} else {
				$thumb_size = 'majesty-thumb-450';
			}
		} elseif( $blog_type == 'blog-masonry-full-width' ) {
			if( isset( $blog_loop ) && ( in_array( $blog_loop, $masonory_larg_full_width ) ) ) {
				if( $majesty_options['blog_mas_thumb'] == 'masonrythumb' ) {
					$thumb_size = 'majesty-blog-thumb-masonry';
				} else {
					$thumb_size = 'full';
				}
			} else {
				$thumb_size = 'majesty-thumb-450';
			}
		}  elseif( $blog_type == 'blog-masonry-2-col' ) {
			if( isset( $blog_loop ) && ( in_array( $blog_loop, $masonory_larg_2c ) ) ) {
				if( $majesty_options['blog_mas_thumb'] == 'masonrythumb' ) {
					$thumb_size = 'majesty-blog-thumb-masonry';
				} else {
					$thumb_size = 'full';
				}
			} else {
				$thumb_size = 'majesty-thumb-555';
			}
		} elseif( $blog_type == 'blog-masonry-4-col' ) {
			if( isset( $blog_loop ) && ( in_array( $blog_loop, $masonory_larg_full_width ) ) ) {
				if( $majesty_options['blog_mas_thumb'] == 'masonrythumb' ) {
					$thumb_size = 'majesty-blog-thumb-masonry';
				} else {
					$thumb_size = 'full';
				}
			} else {
				$thumb_size = 'majesty-thumb-450';
			}
		} elseif ( $blog_type == 'blog-gird-2-col' ) {
			$thumb_size = 'majesty-thumb-555'; 
		} elseif ( $blog_type == 'blog-list-small-thumb' ) {
			$thumb_size = 'majesty-thumb-600-360';
		} elseif ( $blog_type == 'blog-list-big-thumb' || $blog_type == 'wpdefault' ) {
			if ( $sidebar ) {
				$thumb_size = 'majesty-thumb-818';
			} else {
				$thumb_size = 'majesty-thumb-1170';
			}
			
		}
		return $thumb_size;
	}
	
}

/*
 * remove add width and height for image when using the_post_thumbnail()
 */
function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );

/*
 * Display navigation in post
 */
if ( ! function_exists( 'sama_post_nav' ) ) {
	/**
	 * Display navigation to next/previous post when applicable.
	 *
	 * @since Majest 1.2
	 */
	function sama_post_nav() {
		global $majesty_allowed_tags;
		
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}

		?>
		<nav class="page-navigation clearfix">
			<h3 class="sr-only sr-only-focusable"><?php _e( 'Post navigation', 'theme-majesty' ); ?></h3>
			<ul class="page-numbers-gold" >
				<?php
				if ( is_attachment() ) :
					echo '<li class="previous">';
					if( ! is_rtl() ) {
						previous_post_link( '%link', wp_kses( __( '<i class="fa fa-angle-double-left"></i> Previous Post', 'theme-majesty' ), $majesty_allowed_tags));
					} else {
						previous_post_link( '%link', wp_kses( __( '<i class="fa fa-angle-double-right"></i> Previous Post', 'theme-majesty' ), $majesty_allowed_tags));
					}
					echo '</li>';
				else :
					echo '<li class="previous">';
					if( ! is_rtl() ) {
						previous_post_link( '%link', wp_kses( __( '<i class="fa fa-angle-double-left"></i> Previous Post', 'theme-majesty' ), $majesty_allowed_tags));
					} else {
						previous_post_link( '%link', wp_kses( __( '<i class="fa fa-angle-double-right"></i> Previous Post', 'theme-majesty' ), $majesty_allowed_tags));
					}
					echo '</li><li class="next">';
					if( ! is_rtl() ) {
						next_post_link( '%link', wp_kses( __( 'Next Post <i class="fa fa-angle-double-right"></i>', 'theme-majesty' ), $majesty_allowed_tags));
					} else {
						next_post_link( '%link', wp_kses( __( 'Next Post <i class="fa fa-angle-double-left"></i>', 'theme-majesty' ), $majesty_allowed_tags));
					}
					echo '</li>';
				endif;
				?>
			</ul>
		</nav>
		<?php
	}
}

/*
 *	More Link
 */
if ( ! function_exists( 'sama_read_more_link' ) ) {

	function sama_read_more_link() {
		global $majesty_options;
		
		if( $majesty_options['btn_more_as'] == 'text' ) {
			echo '<div class="readmore"><a href="'. esc_url( get_permalink() ) .'" class="btn btn-gold post-more" title="'. esc_html__('Read More','theme-majesty'). '">'. esc_html__('Read More','theme-majesty'). '</a></div>';
		} else {
			$icon = 'right';
			$tooltip = 'right';
			if( is_rtl() ) {
				$icon 	 = 'left';
				$tooltip = 'left';
			}
			echo '<div class="readmore"><a href="'. esc_url( get_permalink() ) .'" class="btn btn-gold"  data-toggle="tooltip" data-placement="'. esc_attr($tooltip) .'" title="'. esc_html__('Read More','theme-majesty'). '"><i class="fa fa-arrow-'. esc_attr($icon) .'"></i></a></div>';			
		}
	}
}

/*
 * used to determine size of post thumbnail in single post
 */
function sama_single_post_thumbnail() {
	$post_layout 	= get_post_meta( get_the_ID(), '_sama_post_layout', true );
	$lightbox 		= get_post_meta( get_the_ID(), '_sama_lightbox', true );
	$lightbox 		= apply_filters('sama_open_thumbnail_with_lightbox', $lightbox);
	if ( ! empty( $post_layout ) && $post_layout == 'fullwidth' ) {
		$thumb_size = 'majesty-thumb-1170';
	} else {
		$thumb_size = 'majesty-thumb-818';
	}
	
	if( ! empty( $lightbox ) && is_array( $lightbox ) && in_array('open', $lightbox ) ) {
		$lightbox_title = 'false';
		$full_thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
		if (  in_array('display_title', $lightbox ) ) {
			$lightbox_title = 'true';
		}
?>
		<a class="thumb-with-lightbox" href="<?php echo esc_url( $full_thumb_url[0] ); ?>" data-display-title="<?php echo esc_attr($lightbox_title); ?>">
			<?php the_post_thumbnail($thumb_size, array('class'=>'img-responsive')); ?>
		</a>
<?php
		} else {
			the_post_thumbnail($thumb_size, array('class'=>'img-responsive'));
		}
}

/*
 * used to add css class for body
 * @since 1.2.2
 *
 * @return array of css class for body.
 */
function sama_css_class_for_body( $classes ) {
	global $majesty_options;
	
	if( is_page_template( 'page-templates/page-builder.php' )  ) {
		$menu_type 	= get_post_meta( sama_get_current_page_id(), '_sama_menu_type', true );
		if( $menu_type == 'vertical-menu' ) {
			$classes[] = 'cbp-spmenu-push';
		}
	}
	if( ! is_page_template( 'page-templates/page-blank.php' ) ) {
		if( is_page_template( 'page-templates/page-builder.php') && ( $majesty_options['enable_small_hedaer'] || (! empty( $majesty_options['pages_display_small_header'] ) && in_array( sama_get_current_page_id(), $majesty_options['pages_display_small_header']) ))) {
			$menu_type 	= get_post_meta( sama_get_current_page_id(), '_sama_menu_type', true );
			if( empty( $menu_type ) || $menu_type == false || $menu_type == 'light-center-transparent' ) {
				$classes[] = 'p-menu-light';
				$classes[] = 'p-menu-transparent';
				$classes[] = 'p-menu-top';
			} elseif( $menu_type == 'light-bottom-center' ) {
				$classes[] = 'p-menu-light';
				$classes[] = 'p-menu-solid';
				$classes[] = 'p-menu-bottom';
			} elseif( $menu_type == 'dark-default-transparent' || $menu_type == 'dark-center-transparent' ) {
				$classes[] = 'p-menu-dark';
				$classes[] = 'p-menu-transparent';
				$classes[] = 'p-menu-top';
				if( $menu_type == 'dark-center-transparent' ) {
					$classes[] = 'p-menu-center';
				}
			} elseif( $menu_type == 'dark-bottom-center' ) {
				$classes[] = 'p-menu-dark';
				$classes[] = 'p-menu-solid';
				$classes[] = 'p-menu-bottom';
			} elseif( $menu_type == 'light-default-solid' || $menu_type == 'light-center-solid' ) {
				$classes[] = 'p-menu-light';
				$classes[] = 'p-menu-solid';
				$classes[] = 'p-menu-top';
				if( $menu_type == 'light-center-solid' ) {
					$classes[] = 'p-menu-center';
				}
			} elseif( $menu_type == 'dark-default-solid' || $menu_type == 'dark-center-solid' ) {
				$classes[] = 'p-menu-dark';
				$classes[] = 'p-menu-solid';
				$classes[] = 'p-menu-top';
				if( $menu_type == 'dark-center-solid' ) {
					$classes[] = 'p-menu-center';
				}
			} elseif( $menu_type == 'vertical-menu' ) {
				$classes[] = 'p-menu-light';
				$classes[] = 'p-menu-transparent';
				$classes[] = 'p-menu-vertical-menu';
			} else {
				$classes[] = 'p-menu-light';
				$classes[] = 'p-menu-transparent';
				$classes[] = 'p-menu-top';
			}
		} elseif( $majesty_options['enable_small_hedaer'] || ( ! empty( $majesty_options['pages_display_small_header'] ) && in_array( sama_get_current_page_id(), $majesty_options['pages_display_small_header']) ) ) {
			if( $majesty_options['menu_has_trans'] ) {
				if( $majesty_options['menu_color'] == 'dark' ) {
					$classes[] = 'p-menu-dark';
					$classes[] = 'p-menu-transparent';
					$classes[] = 'p-menu-top';
				} else {
					$classes[] = 'p-menu-light';
					$classes[] = 'p-menu-transparent';
					$classes[] = 'p-menu-top';
				}
			} else {
				if( $majesty_options['menu_color'] == 'dark' ) {
					$classes[] = 'p-menu-dark';
					$classes[] = 'p-menu-solid';
					$classes[] = 'p-menu-top';
				} else {
					$classes[] = 'p-menu-light';
					$classes[] = 'p-menu-solid';
					$classes[] = 'p-menu-top';
				}
				if( $majesty_options['logo_position'] == 'center' ) {
					$classes[] = 'p-menu-center';
				}
			}
		}
	}
	
	if( $majesty_options['theme_layout'] == 'boxed') {
		if( $majesty_options['boxed_type'] == 'boxedbgrepeat' ) {
			$classes[] = 'boxed';
		} elseif( $majesty_options['boxed_type'] == 'boxedbgnorepeat' ) {
			$classes[] = 'boxed';
			$classes[] = 'boxed-image';
		} elseif( $majesty_options['boxed_type'] == 'boxedbgcolor' ) {
			$classes[] = 'boxed';
			$classes[] = 'boxed-color';
		}
	}
	
	
	
	if( function_exists('is_account_page') && is_account_page() && ! is_user_logged_in() ) {
		$classes[] = 'user-not-login';
	}
	/**/
	//$majesty_options['menu_has_trans'] 	= true;
	return $classes;
}
add_filter( 'body_class', 'sama_css_class_for_body' );

function sama_wrap_before_comment_form() {
	echo '<div class="form-group"><div class="row">';
}
add_action( 'comment_form_top', 'sama_wrap_before_comment_form' );

function sama_wrap_after_comment_form() {
	echo '</div></div>';
}
add_action( 'comment_form', 'sama_wrap_after_comment_form' );

/*
 *	Add more fields to Team members plugin by woothemes
 */
function sama_add_new_fields_team_members( $fields ) {
    $fields['facebook'] = array(
        'name'            => esc_html__( 'Facebook URL', 'theme-majesty' ),
        'type'            => 'text',
        'default'         => '',
		'description'     => '',
        'section'         => 'info'
    );
	$fields['googleplus'] = array(
        'name'            => esc_html__( 'Google + URL', 'theme-majesty' ),
        'type'            => 'text',
        'default'         => '',
		'description'     => '',
        'section'         => 'info'
    );
	$fields['linkedin'] = array(
        'name'            => esc_html__( 'Linked in URL', 'theme-majesty' ),
        'type'            => 'text',
        'default'         => '',
		'description'     => '',
        'section'         => 'info'
    );
    return $fields;
}
add_filter( 'woothemes_our_team_member_fields', 'sama_add_new_fields_team_members' );

remove_filter( 'the_content', 'woothemes_our_team_content' );


/*
 * Requie Mega Max Menu
 * add css to menu
 */
 
function sama_mega_menu_add_css( $classes ) {
	// Add top-menu css class to mega menu ul
	$classes['class'] = '%2$s mega-no-js top-menu';
	return $classes;
}
add_filter('megamenu_wrap_attributes', 'sama_mega_menu_add_css', 1, 10 );

/*
 * used to display breadcrumb in wp templates if enable
 */
function sama_get_theme_breadcrumb() {
	global $majesty_options;
	if( $majesty_options['display_breadcrumb'] ) {
		if( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
		woocommerce_breadcrumb();
		} else {
			sama_ds_breadcrumb();
		}
	}
}

/*
 * Used to Remove 
 * webkitallowfullscreen, mozallowfullscreen, frameborder="0"
 * This make Error in validate HTML5
 */

function sama_remove_oembed_attributes( $return, $data, $url ) {
	$find = array('webkitallowfullscreen', 'mozallowfullscreen','frameborder="0"');
	$output = str_replace( $find, '', $return );
	return $output;
}
add_filter('oembed_dataparse', 'sama_remove_oembed_attributes', 10, 3);

function sama_get_option_defaults() {
	$defaults = array(
		'theme_layout'					=> 'default', // default or boxed
		'boxed_type'					=> 'boxedbgcolor', // boxedbgrepeat, boxedbgnorepeat, boxedbgcolor
		'boxed_bg_img'					=> esc_url( SAMA_THEME_URI ). '/img/background/bg_9.jpg',
		'boxed_bg_color'				=> '#2a2a2a',
		'display_loader'				=> true,
		'loader_style'					=> 'loader', // loader2, // loader3
		'loader_logo'					=> esc_url( SAMA_THEME_URI ). '/img/logo-intro.png',
		'display_breadcrumb'			=> false,
		'logo-light-trans'				=> esc_url( SAMA_THEME_URI ). '/img/logo.png', // used for transparent slider & custom BG & DARK BG BLACK
		'logo-light-small'				=> esc_url( SAMA_THEME_URI ). '/img/logo-dark.png', // used for white background stacky header
		'logo-white-bg'					=> esc_url( SAMA_THEME_URI ). '/img/logo-white-bg.png', // used for sloid white background
		'logo-dark-small'				=> esc_url( SAMA_THEME_URI ). '/img/logo-dark-small.png',	// used for dark background stacky header
		'vertical-logo'					=> esc_url( SAMA_THEME_URI ). '/img/vertical-logo.png',	// used for vertical menu 
		'favicon'						=> '',
		'apple_touch_icon_57'			=> '',
		'apple_touch_icon_72'			=> '',
		'apple_touch_icon_114'			=> '',
		'menu_color'					=> 'light', // dark & light  /* This used for pages not have custom heading */
		'logo_position'					=> 'default', // default & center
		'pages_second_menu'				=> '',
		'pages_scroll_menu'				=> '',
		'blog_type'						=> 'wpdefault', //1- blog-gird-4-col, 2- blog-gird-full-width, 3- blog-gird-3-col 4- blog-gird-2-col 5- blog-list-small-thumb 6-  blog-list-big-thumb 7- wpdefault 8- blog-masonry-4-col 9- blog-masonry-3-col 10- blog-masonry-2-col 11- blog-masonry-full-width
		'blog_with_sidebar'				=> false,
		'blog_archive_type'				=> 'blog-list-big-thumb',
		'archive_with_sidebar'			=> true,
		'blog_excerpt'					=> 16,
		'btn_more_as'					=> 'text', // display icon or text default icon
		'blog_mas_thumb'				=> 'masonrythumb', // For masonry blog use full image or thumb value masonrythumb && full
		'single_gallery_at_top'			=> true,
		'single_display_share_icon'		=> true,
		'single_share_facebook'			=> true,
		'single_share_twitter'			=> true,
		'single_share_pinterest'		=> false,
		'single_share_gplus'			=> true,
		'single_share_linkedin'			=> false,
		'blog_single_post_bg'			=> false, // display header with background for single post
		'blog_single_bg'				=> '',
		'blog_single_subtitle'			=> 'All About Majesty',
		'blog_cat_bg'					=> false,
		'blog_tag_bg'					=> false,
		'blog_author_bg'				=> false,
		'team_mem_head_bg'				=> '',
		'team_mem_subtitle'				=> 'Every Thing You Know About Majesty',
		'display_email_at_team_archive' => false, // Display Team member Email address in Archive Page
		'team_cat_bg'					=> true,
		'team_single_post_bg'			=> true,
		'team_single_bg'				=> esc_url( SAMA_THEME_URI ). '/img/banner/team.jpg',
		'display_related_members'		=> true,
		'related_member_title'			=> 'OUR TEAM',
		'related_member_sub_title'		=> 'The Friendlist Professional Chef',
		'related_member_num'			=> 9,
		'related_member_order'			=> 'DESC', // dropdownmenu 'ASC', DESC
		'related_member_orderby'		=> 'date',	// dropdownmenu ID, author,title, name, date, rand, menu_order
		'related_member_display_email'	=> false,
		'related_member_bg'				=> 'white', // Field Drop down menu white, gray, background
		'related_bg_url'				=> '', // Field Upload
		'related_bg_parallax'			=> 'no', //dropdownmenu Yes // No
		'related_bg_trans'				=> 'transparent-bg-3', // Transparent
		'shop_type'						=> 'fullwidth', // fullwidth, shopwithsidebar shop-2col-withsidebar
		'shop_sid_pos'					=> 'left', // 'right'
		'products_per_page'				=> 12,
		'display_top_cart'				=> true,
		'shop_cat_bg'					=> false,
		'shop_tag_bg'					=> false,
		'shop_display_single_images'	=> 'owlcarousel', // display owlcarousel or default :: Description display images in single product using owl carouserl or woo plugin default
		'shop_display_share_icon'		=> true,
		'shop_share_facebook'			=> true,
		'shop_share_twitter'			=> true,
		'shop_share_pinterest'			=> false,
		'shop_share_gplus'				=> true,
		'shop_share_linkedin'			=> false,
		'shop_single_product_bg'		=> false,
		'shop_single_bg'				=> '',
		'shop_single_subtitle'			=> 'Come & Taste',
		'shop_display_rate_in_list2'	=> true,
		'shop_display_excerpt_in_list2'	=> true,
		'shop_display_thumbnail_in_list2'	=> true,
		'shop_display_ordering_result_count' => true,
		'shop_display_categories'		=> false,
		'shop_txt_link'					=> '',
		'footer_type'					=> 	'4col', //  1col, 2col, 2col-3-9, 2col-9-3, 3col, , 3col-6-3, 3col-3-6, 4col
		'display_foot_bottom'			=> true,
		'bottom_content'				=> '<img  src="'. esc_url( SAMA_THEME_URI ).'/img/footer_logo.png"  alt="logo"><p> 2015 ALL RIGHT RESERVED. DESIGNED BY <a target="_blank" href="'. esc_url('http://theme-majesty.com') .'">CREATIVE WP</a></p>',
		'enable_theme_color_style'		=> false,
		'themecolorstyle'				=> '',
		'enable_advanced_custom_color'	=> false,
		'majesty_main_color'			=> '#c59d5f',
		'majesty_body_color'			=> '#515151',
		'majesty_head_color'			=> '#262626',
		'majesty_icon_color'			=> '#e8e8e8',
		'majesty_calendar_color'		=> '#fcf8e3',
		'enable_typography'				=> false,
		'enable_custom_fonts'			=> false,
		'enable-font-opensans'			=> false,
		'font-opensans'					=> '',
		'font-opensans-style'			=> '',
		'font-opensans-subsets'			=> '',
		'enable-font-fjallaone'			=> false,
		'font-fjallaone'				=> '',
		'font-fjallaone-style'			=> '',
		'font-fjallaone-subsets'		=> '',
		'enable-font-courgette'			=> false,
		'font-courgette'				=> '',
		'font-courgette-style'			=> '',
		'font-courgette-subsets'		=> '',
		'enable_custom_css'				=> false,
		'enable_custom_js'				=> false,
		// owlCarousel
		'owl-carousel-pages'			=> '', // array
		'countdow-pages'				=> '', // array
		'prettyphoto-pages'				=> '', // array
		'contactform7-pages'			=> '', //not work
		// Add version 1.2.1
		'enable_small_hedaer'			=> false,
		'pages_display_small_header'	=> '',
		'phone_number'					=> '',
		'booking_page'					=> '',
		'header_more_links'				=> '',
		'head_facebook'					=> 'https://www.facebook.com/',
		'head_twitter'					=> 'https://twitter.com/',
		'head_gplus'					=> 'https://plus.google.com/',
		'head_vimeo'					=> '',
		'head_youtube'					=> '',
		'head_instagram'				=> '',
		'head_pinterest'				=> '',
		'head_tripadvisor'				=> 'http://www.tripadvisor.com/',
		'head_foursquare'				=> 'https://foursquare.com/',
		'small_hedaer_social_target'	=> '_self',
		
		// used to determine whats pages display background		
		'menu_has_trans'				=> false, // used in theme
		'shortcode_products_query'		=> '', // Used For Woocommerce ShortCode
		'shortcode_masonrry_loop'		=> '',
		'vc_woo_slider'					=> '',
		'vc_woo_filter'					=> '',
		'related_css'					=> '', //Used for woo
		'product_has_upsells'			=> false,
		'product_has_related'			=> false,
		'gmaps_api'						=> '',
	);
	
	// get theme options from Database
	$options = get_option('majesty', array());
	
	if( isset( $options['boxed_bg_img'] ) &&  is_array($options['boxed_bg_img']) ) {
		$options['boxed_bg_img'] = $options['boxed_bg_img']['url'];
	}
	if( isset( $options['loader_logo'] ) &&  is_array($options['loader_logo']) ) {
		$options['loader_logo'] = $options['loader_logo']['url'];
	}
	if( isset( $options['logo-light-trans'] ) &&  is_array($options['logo-light-trans']) ) {
		$options['logo-light-trans'] = $options['logo-light-trans']['url'];
	}
	if( isset( $options['logo-light-small'] ) &&  is_array($options['logo-light-small']) ) {
		$options['logo-light-small'] = $options['logo-light-small']['url'];
	}
	if( isset( $options['logo-white-bg'] ) &&  is_array($options['logo-white-bg']) ) {
		$options['logo-white-bg'] = $options['logo-white-bg']['url'];
	}
	if( isset( $options['logo-dark-small'] ) &&  is_array($options['logo-dark-small']) ) {
		$options['logo-dark-small'] = $options['logo-dark-small']['url'];
	}
	if( isset( $options['vertical-logo'] ) &&  is_array($options['vertical-logo']) ) {
		$options['vertical-logo'] = $options['vertical-logo']['url'];
	}
	if( isset( $options['blog_single_bg'] ) &&  is_array($options['blog_single_bg']) ) {
		$options['blog_single_bg'] = $options['blog_single_bg']['url'];
	}
	if( isset( $options['team_mem_head_bg'] ) &&  is_array($options['team_mem_head_bg']) ) {
		$options['team_mem_head_bg'] = $options['team_mem_head_bg']['url'];
	}
	if( isset( $options['team_single_bg'] ) &&  is_array($options['team_single_bg']) ) {
		$options['team_single_bg'] = $options['team_single_bg']['url'];
	}
	if( isset( $options['related_bg_url'] ) &&  is_array($options['related_bg_url']) ) {
		$options['related_bg_url'] = $options['related_bg_url']['url'];
	}
	if( isset( $options['shop_single_bg'] ) &&  is_array($options['shop_single_bg']) ) {
		$options['shop_single_bg'] = $options['shop_single_bg']['url'];
	}
	
	$majesty_options = wp_parse_args( $options, $defaults );
	return apply_filters('sama_majesty_options', $majesty_options);
}
?>