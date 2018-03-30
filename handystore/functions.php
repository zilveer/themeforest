<?php
/* PlumTree functions and definitions */

/** Contents:
		- Additional image sizes.
		- Google Fonts for your site.
		- Handy Setup.
		- Enqueue scripts and styles.
		- Handy Init Sidebars.
		- Options Panel.
		- Adding features.
		- Backend notifications on theme activation.
**/

/* Set up the content width value based on the theme's design. */
if (!isset( $content_width )) $content_width = 1200;


/* Adding additional image sizes. */
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'product-extra-gallery-thumb', 70, 70, true );
	add_image_size( 'pt-cat-thumb', 25, 25, true );
	add_image_size( 'carousel-medium', 500, 500, true);
	add_image_size( 'carousel-large', 760, 500, true);
	add_image_size( 'pt-product-thumbs', 123, 123, true);
	add_image_size( 'pt-recent-posts-thumb', 263, 174, true);
	add_image_size( 'pt-sidebar-thumbs', 80, 80, true);
	add_image_size( 'pt-vendor-product-thumbs', 120, 120, true);
}


/* Setting Google Fonts for your site */
if ( ! class_exists( 'handyFonts' ) ) {
	class handyFonts {
		static function get_default_fonts() {
			$handy_default_fonts = array('Open Sans', 'Roboto', 'Lato');
			return $handy_default_fonts;
		}
	}
}


/* Handy Setup. Set up theme defaults and registers support for various WordPress features. */
if ( ! function_exists( 'plumtree_setup' ) ) {
	function plumtree_setup() {

		// Translation availability
		load_theme_textdomain( 'plumtree', get_template_directory() . '/languages' );

		// Add RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );

		add_theme_support( "title-tag" );

		// Custom Logo
		add_theme_support( 'custom-logo', array(
				'height' => 73,
				'width' => 225,
		) );

		// Enable support for Post Thumbnails.
		add_theme_support( 'post-thumbnails' );

		set_post_thumbnail_size( 1138, 450, true );

		// Nav menus.
		register_nav_menus( array(
			'header-top-nav'   => __( 'Top Menu', 'plumtree' ),
			'primary-nav'      => __( 'Primary Menu (Under Logo)', 'plumtree' ),
		) );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );

		// Enable support for Post Formats.
		add_theme_support( 'post-formats', array(
			'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
		) );

		// This theme allows users to set a custom background.
		add_theme_support( 'custom-background', array(
			'default-color' => 'FFFFFF',
		) );

		// Enable woocommerce support
		add_theme_support( 'woocommerce' );

		// Enable layouts support
		$pt_layouts = array(
				array('value' => 'one-col', 'label' => esc_html__('1 Column (no sidebars)', 'plumtree'), 'icon' => get_template_directory_uri().'/theme-options/images/one-col.png'),
				array('value' => 'two-col-left', 'label' => esc_html__('2 Columns, sidebar on left', 'plumtree'), 'icon' => get_template_directory_uri().'/theme-options/images/two-col-left.png'),
				array('value' => 'two-col-right', 'label' => esc_html__('2 Columns, sidebar on right', 'plumtree'), 'icon' => get_template_directory_uri().'/theme-options/images/two-col-right.png'),
		);
		add_theme_support( 'plumtree-layouts', apply_filters('pt_default_layouts', $pt_layouts) );

	}
}
add_action( 'after_setup_theme', 'plumtree_setup' );


/* Enqueue scripts and styles for the front end. */
function plumtree_scripts() {
	/* Get vendor store */
	$vendor_shop = '';
	if ( class_exists('WCV_Vendors') ) {
		$vendor_shop = urldecode( get_query_var( 'vendor_shop' ) );
	}

	//---- CSS Styles
	wp_enqueue_style( 'pt-basic', get_stylesheet_uri() );
	wp_enqueue_style( 'pt-grid-and-effects', get_template_directory_uri().'/css/grid-and-effects.css' );
	wp_enqueue_style( 'pt-icon-fonts', get_template_directory_uri() . '/css/icon-fonts.min.css' );
	wp_enqueue_style( 'pt-additional-styles', get_template_directory_uri().'/css/additional-styles.css' );
	wp_enqueue_style( 'pt-vc-styles', get_template_directory_uri().'/css/visual-composer-styles.css' );
	if ( class_exists('Woocommerce') && class_exists('WCV_Vendors') ) {
		wp_enqueue_style( 'pt-vendors-styles', get_template_directory_uri().'/css/vendor-styles.css' );
	}

	//---- JS libraries
	wp_enqueue_script( 'hoverIntent', array('jquery') );
	wp_enqueue_script( 'lazy-sizes', get_template_directory_uri() . '/js/lazysizes.js', array(), '1.5.0', false );
	wp_enqueue_script( 'easings', get_template_directory_uri() . '/js/easing.1.3.js', array('jquery'), '1.3', true );
	wp_enqueue_script( 'images-loaded', get_template_directory_uri() . '/js/imagesloaded.js', array('jquery'), '4.1.0', true );
	wp_enqueue_script( 'countdown', get_template_directory_uri() . '/js/countdown.js', array('jquery'), '2.0.2', true );
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'), '3.3.5', true );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), '1.3.3', true );
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/js/magnific-popup.js', array('jquery'), '1.1.0', true );
	wp_enqueue_script( 'select2', get_template_directory_uri() . '/js/select2.js', array('jquery'), '3.5.2', true );
	wp_enqueue_script( 'ion-checkradio', get_template_directory_uri() . '/js/ion.checkRadio.js', array('jquery'), '2.0', true );
	if ( is_archive() || is_home() ||
		 is_tax() ||
		 ( $vendor_shop && $vendor_shop!='' ) ||
		 is_page_template( 'page-templates/gallery-page.php' ) ||
		 is_page_template( 'page-templates/portfolio-page.php' ) ) {
			 wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/isotope.js', array('jquery'), '2.2.0', true );
	}
	wp_enqueue_script( 'pt-basic-js', get_template_directory_uri() . '/js/helper.js', array('jquery'), '1.0', true );

	//---- Comments script-----------
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'plumtree_scripts' );


/* Handy Init Sidebars. */
if (!function_exists('plumtree_widgets_init')){
	function plumtree_widgets_init() {
		// Default Sidebars
		register_sidebar( array(
			'name' => __( 'Blog Sidebar', 'plumtree' ),
			'id' => 'sidebar-blog',
			'description' => __( 'Appears on single blog posts and on Blog Page', 'plumtree' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title" itemprop="name">',
			'after_title' => '</h3>',
		) );
		if ( handy_get_option('header_top_panel') == 'on' ) {
			register_sidebar( array(
				'name' => __( 'Header Top Panel Sidebar', 'plumtree' ),
				'id' => 'top-sidebar',
				'description' => __( 'Located at the top of site', 'plumtree' ),
				'before_widget' => '<aside id="%1$s" class="%2$s right-aligned">',
				'after_widget' => '</aside>',
				'before_title' => '<!--',
				'after_title' => '-->',
			) );
		}
		register_sidebar( array(
			'name' => __( 'Header (Logo group) sidebar', 'plumtree' ),
			'id' => 'hgroup-sidebar',
			'description' => __( 'Located to the right from header', 'plumtree' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '',
			'after_title' => '',
		) );
		register_sidebar( array(
			'name' => __( 'Front Page Sidebar', 'plumtree' ),
			'id' => 'sidebar-front',
			'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'plumtree' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title itemprop="name">',
			'after_title' => '</h3>',
		) );
		register_sidebar( array(
			'name' => __( 'Pages Sidebar', 'plumtree' ),
			'id' => 'sidebar-pages',
			'description' => __( 'Appears on Pages', 'plumtree' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title itemprop="name">',
			'after_title' => '</h3>',
		) );
		if ( class_exists('Woocommerce') ) {
			register_sidebar( array(
				'name' => __( 'Shop Page Sidebar', 'plumtree' ),
				'id' => 'sidebar-shop',
				'description' => __( 'Appears on Products page', 'plumtree' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title itemprop="name">',
				'after_title' => '</h3>',
			) );
			register_sidebar( array(
				'name' => __( 'Single Product Page Sidebar', 'plumtree' ),
				'id' => 'sidebar-product',
				'description' => __( 'Appears on Single Products page', 'plumtree' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title itemprop="name">',
				'after_title' => '</h3>',
			) );
			if ( class_exists('WCV_Vendors') ) {
				register_sidebar( array(
					'name' => __( 'Vendor Shop Page Sidebar', 'plumtree' ),
					'id' => 'sidebar-vendor',
					'description' => __( 'Appears on Vendors Shop Page', 'plumtree' ),
					'before_widget' => '<aside id="%1$s" class="widget %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<h3 class="widget-title itemprop="name">',
					'after_title' => '</h3>',
				) );
			}
		}
	  // Footer Sidebars
	  register_sidebar( array(
	    'name' => __( 'Footer Sidebar Col#1', 'plumtree' ),
	    'id' => 'footer-sidebar-1',
	    'description' => __( 'Located in the footer of the site', 'plumtree' ),
	    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	    'after_widget' => '</aside>',
	    'before_title' => '<h3 class="widget-title itemprop="name">',
	    'after_title' => '</h3>',
		) );
	  register_sidebar( array(
	    'name' => __( 'Footer Sidebar Col#2', 'plumtree' ),
	    'id' => 'footer-sidebar-2',
	    'description' => __( 'Located in the footer of the site', 'plumtree' ),
	    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	    'after_widget' => '</aside>',
	    'before_title' => '<h3 class="widget-title itemprop="name">',
	    'after_title' => '</h3>',
	  ) );
	  register_sidebar( array(
	    'name' => __( 'Footer Sidebar Col#3', 'plumtree' ),
	    'id' => 'footer-sidebar-3',
	    'description' => __( 'Located in the footer of the site', 'plumtree' ),
	    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	    'after_widget' => '</aside>',
	    'before_title' => '<h3 class="widget-title itemprop="name">',
	    'after_title' => '</h3>',
	  ) );
	  register_sidebar( array(
	    'name' => __( 'Footer Sidebar Col#4', 'plumtree' ),
	    'id' => 'footer-sidebar-4',
	    'description' => __( 'Located in the footer of the site', 'plumtree' ),
	    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	    'after_widget' => '</aside>',
	    'before_title' => '<h3 class="widget-title itemprop="name">',
	    'after_title' => '</h3>',
	  ) );
	  // Custom Sidebars
	  register_sidebar( array(
	    'name' => __( 'Top Footer Sidebar', 'plumtree' ),
	    'id' => 'top-footer-sidebar',
	    'description' => __( 'Located in the footer of the site', 'plumtree' ),
	    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	    'after_widget' => '</aside>',
	    'before_title' => '<h3 class="widget-title itemprop="name">',
	    'after_title' => '</h3>',
	  ) );
	  if ( handy_get_option('filters_sidebar')=='on' ) {
			register_sidebar( array(
			    'name' => __( 'Special Filters Sidebar', 'plumtree' ),
		      'id' => 'filters-sidebar',
		      'description' => __( 'Located at the top of the products page', 'plumtree' ),
		      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		      'after_widget' => '</aside>',
		      'before_title' => '<h3 class="dropdown-filters-title">',
		      'after_title' => '</h3>',
		    ) );
		}
		if ( handy_get_option('front_page_special_sidebar')=='on' ) {
			register_sidebar( array(
			    'name' => __( 'Special Front Page Sidebar', 'plumtree' ),
		      'id' => 'front-special-sidebar',
		      'description' => __( 'Located at the bottom of the page (appears only when using Front Page Template)', 'plumtree' ),
		      'before_widget' => '<aside id="%1$s" class="widget %2$s col-xs-12 col-sm-6 col-md-3 lazyload" data-expand="-100" >',
		      'after_widget' => '</aside>',
		      'before_title' => '<h3 class="widget-title" itemprop="name">',
		      'after_title' => '</h3>',
		    ) );
		}
	}
	add_action( 'widgets_init', 'plumtree_widgets_init' );
}


/* Options Panel */
define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/theme-options/' );
require_once ( get_template_directory() . '/theme-options/options-framework.php' );

// Loads options.php from child or parent theme
$optionsfile = locate_template( 'options.php' );
load_template( $optionsfile );

function handy_prefix_options_menu_filter( $menu ) {
 	$menu['mode'] = 'menu';
 	$menu['page_title'] = esc_html__( 'Handy Theme Options', 'plumtree');
 	$menu['menu_title'] = esc_html__( 'Handy Theme Options', 'plumtree');
 	$menu['menu_slug'] = 'handy-theme-options';
 	return $menu;
}
add_filter( 'optionsframework_menu', 'handy_prefix_options_menu_filter' );


/* Adding features */
// Widgets
require_once( get_template_directory() . '/widgets/class-pt-widget-contacts.php');
require_once( get_template_directory() . '/widgets/class-pt-widget-socials.php');
require_once( get_template_directory() . '/widgets/class-pt-widget-search.php');
require_once( get_template_directory() . '/widgets/class-pt-widget-login.php');
require_once( get_template_directory() . '/widgets/class-pt-widget-most-viewed-posts.php');
require_once( get_template_directory() . '/widgets/class-pt-widget-recent-posts.php');
require_once( get_template_directory() . '/widgets/class-pt-widget-comments-with-avatars.php');
require_once( get_template_directory() . '/widgets/pay-icons/class-pt-widget-pay-icons.php');
if ( class_exists('Woocommerce') ) {
	require_once( get_template_directory() . '/widgets/class-pt-widget-cart.php');
	require_once( get_template_directory() . '/widgets/class-pt-widget-categories.php');
}
if ( handy_get_option('site_post_likes')=='on' ) {
	require_once( get_template_directory() . '/widgets/class-pt-widget-user-likes.php');
	require_once( get_template_directory() . '/widgets/class-pt-widget-popular-posts.php');
}
if ( class_exists('Woocommerce') && class_exists('WCV_Vendors') ) {
	require_once( get_template_directory() . '/widgets/class-pt-widget-vendors-products.php');
}

// Required functions
require_once( get_template_directory() . '/inc/pt-google-fonts.php');
require_once( get_template_directory() . '/inc/pt-theme-layouts.php');
require_once( get_template_directory() . '/inc/pt-functions.php');
require_once( get_template_directory() . '/inc/pt-login-register.php');
require_once( get_template_directory() . '/inc/pt-tgm-plugin-activation.php');
require_once( get_template_directory() . '/inc/pt-self-install.php');
if ( handy_get_option('blog_share_buttons')=='on' ||
	 handy_get_option('use_pt_shares_for_product')=='on' ) {
	require_once( get_template_directory() . '/inc/pt-share-buttons.php');
}
if ( handy_get_option('site_post_likes')=='on' ) {
	require_once( get_template_directory() . '/inc/pt-post-like.php');
}
if ( class_exists('Woocommerce') ) {
	require_once( get_template_directory() . '/inc/pt-woo-modification.php');
}
if ( class_exists('WCV_Vendors') ) {
	require_once( get_template_directory() . '/inc/pt-vendors-modification.php');
	if ( handy_get_option('show_wcv_favourite_vendors')=='on' ) {
		require_once( get_template_directory() . '/inc/pt-favourite-vendors.php');
	}
}
if ( handy_get_option('blog_pagination')=='infinite' ) {
	require_once( get_template_directory() . '/inc/pt-infinite-blog.php');
}
if ( handy_get_option('site_custom_colors') == 'on') {
	require_once( get_template_directory() . '/inc/pt-color-sheme.php');
}

// Adding pagebuilders custom shortcodes
if (class_exists('IG_Pb_Init')) {
  require_once( get_template_directory() . '/shortcodes/add_to_contentbuilder.php' );
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	require_once( get_template_directory() . '/shortcodes/composer_shortcodes/banner.php');
	require_once( get_template_directory() . '/shortcodes/composer_shortcodes/contact-member.php');
	require_once( get_template_directory() . '/shortcodes/composer_shortcodes/recent-post.php');
	require_once( get_template_directory() . '/shortcodes/composer_shortcodes/carousel.php');
	require_once( get_template_directory() . '/shortcodes/composer_shortcodes/sale-carousel.php');
	require_once( get_template_directory() . '/shortcodes/composer_shortcodes/testimonials.php');
	require_once( get_template_directory() . '/shortcodes/composer_shortcodes/woo-codes.php');
	require_once( get_template_directory() . '/shortcodes/composer_shortcodes/vendors-carousel.php');
	require_once( get_template_directory() . '/shortcodes/composer_shortcodes/promo-text.php');
}

// Add do_shortcode filter.
add_filter('widget_text', 'do_shortcode');

// Live preview with RTL
if( isset( $_GET['rtl_demo'] ) && $_GET['rtl_demo']=='true' ){
	function add_rtl_css() {
		wp_enqueue_style( 'plumtree-rtl', get_template_directory_uri().'/rtl.css' );
	}
	add_action( 'wp_enqueue_scripts', 'add_rtl_css' );
}

/* Backend notifications on theme activation */
//add_action('after_switch_theme', 'pt_add_alerts');
function pt_add_alerts () {
	add_action( 'admin_notices', 'pt_add_alert_text' );
}

function pt_add_alert_text() {
   echo ' <div class="notice error is-dismissible">
            <p><strong style="color: #DC3232;">Warning!</strong> It is strongly recommended to read our instructions before installing sample data, it may destroy your existing data!</p>
						<p>We also offer <strong>paid sample data installation</strong>. Please contact support on this matter!</p>
						<p><strong><a href="http://handystorehelp.themes.zone/#installing-sample-data" rel="nofollow" target="_blank">Read Instructions</a></strong>&nbsp;|&nbsp;
						<strong><a href="http://support.themes.zone/" rel="nofollow" target="_blank">Contact Support</a></strong></p>
          </div>';
}

/* Registers an editor stylesheet for the theme. */
function handy_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'handy_theme_add_editor_styles' );
