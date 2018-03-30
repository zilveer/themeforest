<?php
/**
 * Functions and definitions
 *
 */

/*----------------------------------------------------*/
/*	Set content width based on theme design
/*----------------------------------------------------*/
if ( ! isset( $content_width ) ) {
	$content_width = 815; /* pixels */
}

/*----------------------------------------------------*/
/*	Defaults and registers support for various WP features
/*----------------------------------------------------*/
if ( ! function_exists( 'heartfelt_setup' ) ) :

/**
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function heartfelt_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	load_theme_textdomain( 'heartfelt', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'home-blog-thumbnails', 245, 245, true );
	add_image_size( 'full-width-thumbnails', 1100, 400, true );
	add_image_size( 'page-thumbnails', 815, 355, true );

   /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'top_header' => __( 'Header Top Menu', 'heartfelt' ),
		'bottom_header' => __( 'Header Bottom Menu', 'heartfelt' ),
	) );

	// Enable support for Post Formats.
	// add_theme_support( 'post-formats', array( 'gallery', 'video', 'quote' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'heartfelt_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );
}
endif; // heartfelt_setup
add_action( 'after_setup_theme', 'heartfelt_setup' );

/*----------------------------------------------------*/
/*	Register widget area.
/*----------------------------------------------------*/
function heartfelt_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Inner Sidebar', 'heartfelt' ),
		'id'            => 'sidebar',
		'description'   => 'Displays on all inner pages that have a sidebar.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	register_sidebar( array(
		'name'          => __( 'Home Hero', 'heartfelt' ),
		'id'            => 'home_hero',
		'description'   => 'Displays in the top section of the home page.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s large-4 columns"><div class="hero_content">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	register_sidebar( array(
		'name'          => __( 'Forums Sidebar', 'heartfelt' ),
		'id'            => 'forums',
		'description'   => 'Displays on all forums pages that have a sidebar.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	register_sidebar( array(
		'name'          => __( 'Shop Sidebar', 'heartfelt' ),
		'id'            => 'shop',
		'description'   => 'Displays on all shop pages that have a sidebar.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	register_sidebar( array(
		'name'          => __( 'Footer Left', 'heartfelt' ),
		'id'            => 'footer-left',
		'description'   => 'Displays widgets in the footer left column.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	register_sidebar( array(
		'name'          => __( 'Footer Middle', 'heartfelt' ),
		'id'            => 'footer-middle',
		'description'   => 'Displays widgets in the footer middle column.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	register_sidebar( array(
		'name'          => __( 'Footer Right', 'heartfelt' ),
		'id'            => 'footer-right',
		'description'   => 'Displays widgets in the footer right column.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));

}
add_action( 'widgets_init', 'heartfelt_widgets_init' );

/*----------------------------------------------------*/
/*  Foundation Setup
/*----------------------------------------------------*/
if ( ! function_exists( 'heartfelt_foundation_scripts' ) ) :

    function heartfelt_foundation_scripts() {
        wp_enqueue_style( 'heartfelt-foundation-style', get_template_directory_uri() . '/app.css' );
        wp_enqueue_script( 'heartfelt-foundation-js', get_template_directory_uri() . '/js/foundation.min.js', array( 'jquery' ), '5.4.7', true );
        wp_enqueue_script( 'heartfelt-modernizr', get_template_directory_uri() . '/js/vendor/modernizr.js', array(), '2.8.3', true );
    }

endif; // heartfelt_foundation_scripts
add_action( 'wp_enqueue_scripts', 'heartfelt_foundation_scripts', 10 );

// Fixes admin bar overlap
if ( ! function_exists( 'heartfelt_admin_bar_position' ) ) :

    function heartfelt_admin_bar_position() {
      if ( is_admin_bar_showing() ) { ?>
		<style>
		.fixed{ margin-top: 32px; }
		.pace .pace-progress{ margin-top: 32px; }
		@media screen and (max-width: 600px){
			.top-bar{ margin-top: 46px; }
			.fixed{ margin-top: 32px; }
			#wpadminbar { position: fixed !important; }
		}
		</style>
      <?php }
    }

endif; // heartfelt_admin_bar_position
add_action('wp_head', 'heartfelt_admin_bar_position');

// Foundation Navigation - http://goo.gl/mTkWbg
class heartfelt_foundation_walker extends Walker_Nav_Menu {

    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
        $element->has_children = !empty($children_elements[$element->ID]);
        $element->classes[] = ($element->current || $element->current_item_ancestor) ? 'active' : '';
        $element->classes[] = ($element->has_children) ? 'has-dropdown' : '';

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= "\n<ul class=\"sub-menu dropdown\">\n";
    }

} // end custom walker

/*----------------------------------------------------*/
/*	Enqueue scripts and styles
/*----------------------------------------------------*/
function heartfelt_scripts() {

	/**
	 * Get the theme's version number for cache busting
	 */
	$heartfelt = wp_get_theme();

	wp_enqueue_style( 'google-font-open-sans', '//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700', array(), '', 'all' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.3.0', 'all' );
	wp_enqueue_style( 'rescue_animate', get_template_directory_uri() . '/css/animate.css', array(), '', 'all' );
	wp_enqueue_style( 'heartfelt-featherlight-lightbox-style', get_template_directory_uri() . '/css/featherlight.min.css', array(), '', 'all' );

	wp_enqueue_script( 'heartfelt-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '', true );
	wp_enqueue_script( 'rescue_wow', get_template_directory_uri() . '/js/wow.min.js', array ('jquery'), '1.1.2', true );
	wp_enqueue_script( 'heartfelt-featherlight-lightbox-script', get_template_directory_uri() . '/js/featherlight.min.js', array(), '', true );
	wp_enqueue_script( 'heartfelt-custom-universal', get_template_directory_uri() . '/js/custom_universal.js', array('jquery'), '', true );

	if ( is_page_template( 'template-home.php' ) ) { // only load these on the home page template
		wp_enqueue_style( 'heartfelt-carousel-style', get_template_directory_uri() . '/css/owl.carousel.css', array(), '', 'all' );
		wp_enqueue_style( 'heartfelt-carousel-theme', get_template_directory_uri() . '/css/owl.theme.default.css', array(), '', 'all' );
		wp_enqueue_script( 'heartfelt-easing', get_template_directory_uri() . '/js/jquery.easing.min.js', array(), '', true );
		wp_enqueue_script( 'heartfelt-owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), '', true );
		wp_enqueue_script( 'heartfelt-custom_home', get_template_directory_uri() . '/js/custom_home.js', array('jquery'), '', true );
	}

	if ( is_page_template( 'template-contact.php' ) ) { // only load on the contact page template
		// Load Google API key if provided. Google requires new site to use API
		$key = sanitize_text_field( get_theme_mod( 'google_map_api_key', customizer_library_get_default( 'google_map_api_key' ) ) );
		$api_key = ! empty( $key ) ? 'key=' . $key : '';
		
		wp_enqueue_script('rescue_googlemap',  get_template_directory_uri() . '/js/google-map.js', array('jquery'), '1.0', true );
		wp_enqueue_script('rescue_googlemap_api', 'https://maps.googleapis.com/maps/api/js?' . $api_key, array('jquery'), '1.0', true );

	}

	if ( get_theme_mod( 'page_loader_choice' ) ) {
		wp_enqueue_script( 'heartfelt-pace-script', get_template_directory_uri() . '/js/pace.min.js', array('jquery'), '', true );
		wp_enqueue_script( 'heartfelt-pace-options', get_template_directory_uri() . '/js/pace-options.js', array('jquery'), '', false );
	} // end page_loader_choice

	wp_enqueue_style( 'heartfelt-styles', get_stylesheet_uri(), array(), $heartfelt['Version'] );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'heartfelt_scripts' );

/*----------------------------------------------------*/
/*	bbpress Forum Search - http://goo.gl/3Ksieh
/*----------------------------------------------------*/
add_filter( 'template_include', 'heartfelt_custom_maybe_load_bbpress_tpl', 99 );

function heartfelt_custom_maybe_load_bbpress_tpl ( $tpl ) {
	if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
		$tpl = locate_template( 'bbpress.php' );
	}
	return $tpl;
} // End heartfelt_custom_maybe_load_bbpress_tpl()

add_filter( 'bbp_get_template_stack', 'heartfelt_custom_deregister_bbpress_template_stack' );

function heartfelt_custom_deregister_bbpress_template_stack ( $stack ) {
	if ( 0 < count( $stack ) ) {
		$stylesheet_dir = get_stylesheet_directory();
		$template_dir = get_template_directory();
		foreach ( $stack as $k => $v ) {
			if ( $stylesheet_dir == $v || $template_dir == $v ) {
				unset( $stack[$k] );
			}
		}
	}
	return $stack;
} // End heartfelt_custom_deregister_bbpress_template_stack()

/*----------------------------------------------------*/
/*	The Events Calendar
/*----------------------------------------------------*/
function heartfelt_tribe_events_breakpoint() {
  return 600;
}
add_filter( 'tribe_events_mobile_breakpoint', 'heartfelt_tribe_events_breakpoint' );

/*----------------------------------------------------*/
/*	Customizer
/*----------------------------------------------------*/
if ( file_exists ( get_template_directory() . '/customizer/customizer-library/customizer-library.php' ) ) :

// Helper library for the theme customizer.
require get_template_directory() . '/customizer/customizer-library/customizer-library.php';

// Define options for the theme customizer.
require get_template_directory() . '/customizer/customizer-options.php';

// Output inline styles based on theme customizer selections.
require get_template_directory() . '/customizer/styles.php';

// Additional filters and actions based on theme customizer selections.
require get_template_directory() . '/customizer/mods.php';

endif;

/*----------------------------------------------------*/
/*	Prompt Recommended Plugins
/*----------------------------------------------------*/
require_once get_template_directory() . '/inc/tgm/tgm.php';

/*----------------------------------------------------*/
/*	Custom template tags for this theme
/*----------------------------------------------------*/
require_once get_template_directory() . '/inc/template-tags.php';

/*----------------------------------------------------*/
/*	Custom functions that act independently of the theme
/*----------------------------------------------------*/
require_once get_template_directory() . '/inc/extras.php';

/*----------------------------------------------------*/
/*	Load Jetpack compatibility file
/*----------------------------------------------------*/
require_once get_template_directory() . '/inc/jetpack.php';

/*----------------------------------------------------*/
/*	Woocommerce
/*----------------------------------------------------*/
require_once get_template_directory() . '/woocommerce/functions.php';
