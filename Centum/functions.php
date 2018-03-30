<?php
/**
 * Centum functions and definitions
 *
 * @package Centum
 */




/**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_false' );



/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Show New Layout
 */
add_filter( 'ot_show_new_layout', '__return_false' );


/**
 * Custom Theme Option page
 */
add_filter( 'ot_use_theme_options', '__return_true' );

/**
 * Meta Boxes
 */
add_filter( 'ot_meta_boxes', '__return_true' );



/**
 * Required: include OptionTree.
 */
require( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );

/**
 * Theme Options
 */
load_template( trailingslashit( get_template_directory() ) . 'inc/theme-options.php' );

/**
 * Meta Boxes
 */
load_template( trailingslashit( get_template_directory() ) . 'inc/meta-boxes.php' );


add_theme_support( 'woocommerce' );
add_filter( 'woocommerce_enqueue_styles', '__return_false' );


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1200; /* pixels */
}

if ( ! function_exists( 'centum_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function centum_setup() {

	$catalogmode = ot_get_option('pp_woo_catalog','off');
    
    if ($catalogmode == "on") {
        remove_filter( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart',30 );
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
    }

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Centum, use a find and replace
	 * to change 'centum' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'centum', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'mainmenu' => __( 'Menu', 'centum' ),
	) );
	

    do_action( 'purethemes-testimonials' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'gallery','video','audio' 
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'centum_custom_background_args', array(
		'default-color' => 'e9e9e9',
		'default-image' => '',
	) ) );
}
endif; // centum_setup
add_action( 'after_setup_theme', 'centum_setup' );

add_filter('widget_text', 'do_shortcode');

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function centum_widgets_init() {
	register_sidebar(array(
        'id' => 'sidebar',
        'name' => 'Sidebar Area',
        'before_widget' => '<div id="%1$s" class="widget  %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="headline no-margin"><h4>',
        'after_title' => '</h4></div>',
        ));
    if ( function_exists('woocommerce_get_page_id') ) {
	     register_sidebar(array(
	        'id' => 'shop',
	        'name' => 'Shop',
	        'before_widget' => '<div id="%1$s" class="widget  %2$s">',
	        'after_widget' => '</div>',
	        'before_title' => '<div class="headline no-margin"><h4>',
	        'after_title' => '</h4></div>',
        ));
    }
    register_sidebar(array(
        'id' => 'footer1',
        'name' => 'Footer 1st Column',
        'description' => '1st column for widgets in Footer.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="footer-headline"><h4>',
        'after_title' => '</h4></div>',
    ));
    register_sidebar(array(
        'id' => 'footer2',
        'name' => 'Footer 2nd Column',
        'description' => '2nd column for widgets in Footer.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="footer-headline"><h4>',
        'after_title' => '</h4></div>',
    ));
    register_sidebar(array(
        'id' => 'footer3',
        'name' => 'Footer 3rd Column',
        'description' => '3rd column for widgets in Footer.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
         'before_title' => '<div class="footer-headline"><h4>',
        'after_title' => '</h4></div>',
    ));
    register_sidebar(array(
        'id' => 'footer4',
        'name' => 'Footer 4th Column',
        'description' => '4th column for widgets in Footer.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="footer-headline"><h4>',
        'after_title' => '</h4></div>',
    ));
    
    if (ot_get_option('incr_sidebars')):
    	$pp_sidebars = ot_get_option('incr_sidebars');
	    foreach ($pp_sidebars as $pp_sidebar) {
		    register_sidebar(array(
		        'name' => $pp_sidebar["title"],
		        'id' => $pp_sidebar["id"],
		        'before_widget' => '<div id="%1$s" class="widget  %2$s">',
		        'after_widget' => '</div>',
		        'before_title' => '<div class="headline no-margin"><h4>',
		        'after_title' => '</h4></div>',
	        ));
		}
	endif;
}
add_action( 'widgets_init', 'centum_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function centum_scripts() {
    wp_enqueue_style( 'centum-base', get_template_directory_uri().'/css/base.css' );
    wp_enqueue_style( 'centum-skeleton', get_template_directory_uri().'/css/skeleton.css' );
	wp_enqueue_style( 'centum-style', get_stylesheet_uri() );
    
    $style = get_theme_mod( 'centum_layout_style', 'boxed' );
    wp_enqueue_style( 'centum-boxed', get_template_directory_uri().'/css/'.$style.'.css' );
    $scheme = get_theme_mod( 'centum_scheme_switch', 'light' ) ;
    wp_enqueue_style( 'centum-scheme', get_template_directory_uri().'/css/'.$scheme.'.css' );
  
    
    wp_dequeue_style('purethemes-shortcodes');
    wp_enqueue_script( 'royalslider', get_template_directory_uri() . '/js/jquery.royalslider.min.js', array(), '', true );
    wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'tooltip', get_template_directory_uri() . '/js/tooltip.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'effects', get_template_directory_uri() . '/js/effects.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'mfp', get_template_directory_uri() . '/js/mfp.min.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'carousel', get_template_directory_uri() . '/js/carousel.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'stacktable', get_template_directory_uri() . '/js/stacktable.js', array(), '20140612', true );
    wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    wp_localize_script( 'custom', 'centum',
    array(
        'home_slider_scale_mode' => ot_get_option('home_royal_image_scale_mode','none'),
        'home_royal_delay' => ot_get_option('home_royal_delay',5000),
        'home_slider_loop' => ot_get_option('home_royal_loop','on') == 'on' ? true : false,
        'home_slider_autoplay' => ot_get_option('home_royal_autoplay','on') == 'on' ? true : false,
        'home_slider_arrows_hide' => ot_get_option('home_slider_arrows_hide','off') == 'on' ? true : false,
        'retinalogo' => ot_get_option('logo_retina_upload'),
        
        )
    );

}
add_action( 'wp_enqueue_scripts', 'centum_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Shortcodes file.
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Load Shortcodes
 */
require_once( get_template_directory() . '/inc/ptshortcodes.php' );

/**
 * Load Widgets file.
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Load tgmpa file.
 */
require get_template_directory() . '/inc/tgmpa.php';

/**
 * Load tgmpa file.
 */
require get_template_directory() . '/inc/woocommerce.php';

/**
 * Load Envato.
 */
require get_template_directory() . '/inc/github.php';


if(function_exists('vc_map')) {
    require_once get_template_directory() . '/inc/vc.php';
    require_once get_template_directory() . '/inc/vc_modified_shortcodes.php';
}

add_theme_support('post-thumbnails');
set_post_thumbnail_size(700, 330, true); //size of thumbs
add_image_size('small-thumb', 49, 49, true);
add_image_size('slider', 372, 255, true);

//set to 472
add_image_size('portfolio-main', 940, 0, true);
add_image_size('portfolio-medium', 580, 366, true);
add_image_size('portfolio-thumb', 380, 240, true);


add_image_size('cart-square-thumb',55, 55, true);     //shop
add_image_size('shop-square-thumb',80, 80, true);     //shop
add_image_size('shop-small-thumb', 96, 105, true);     //shop




/* ----------------------------------------------------- */
/* Work Custom Post Type */
/* ----------------------------------------------------- */


add_action( 'init', 'register_cpt_portfolio' );

function register_cpt_portfolio() {

    $labels = array(
        'name' => __( 'Portfolio','centum'),
        'singular_name' => __( 'Portfolio','centum'),
        'add_new' => __( 'Add New','centum' ),
        'add_new_item' => __( 'Add New Work','centum' ),
        'edit_item' => __( 'Edit Work','centum'),
        'new_item' => __( 'New Work','centum'),
        'view_item' => __( 'View Work','centum'),
        'search_items' => __( 'Search Portfolio','centum'),
        'not_found' => __( 'No portfolio found','centum'),
        'not_found_in_trash' => __( 'No works found in Trash','centum'),
        'parent_item_colon' => __( 'Parent work:','centum'),
        'menu_name' => __( 'Portfolio','centum'),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Display your works by filters',
        'supports' => array( 'title', 'editor', 'excerpt', 'revisions', 'thumbnail' ),

        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,

        //'menu_icon' => TEMPLATE_URL . 'work.png',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array( 'slug' => 'portfolio'),
        'capability_type' => 'post'
    );

    register_post_type( 'portfolio', $args );
}

/* ----------------------------------------------------- */
/* Filter Taxonomy */
/* ----------------------------------------------------- */

add_action( 'init', 'register_taxonomy_filters' );

function register_taxonomy_filters() {

    $labels = array(
        'name' => __( 'Filters', 'centum' ),
        'singular_name' => __( 'Filter', 'centum' ),
        'search_items' => __( 'Search Filters', 'centum' ),
        'popular_items' => __( 'Popular Filters', 'centum' ),
        'all_items' => __( 'All Filters', 'centum' ),
        'parent_item' => __( 'Parent Filter', 'centum' ),
        'parent_item_colon' => __( 'Parent Filter:', 'centum' ),
        'edit_item' => __( 'Edit Filter', 'centum' ),
        'update_item' => __( 'Update Filter', 'centum' ),
        'add_new_item' => __( 'Add New Filter', 'centum' ),
        'new_item_name' => __( 'New Filter', 'centum' ),
        'separate_items_with_commas' => __( 'Separate Filters with commas', 'centum' ),
        'add_or_remove_items' => __( 'Add or remove Filters', 'centum' ),
        'choose_from_most_used' => __( 'Choose from the most used Filters', 'centum' ),
        'menu_name' => __( 'Filters', 'centum' ),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => false,
        'hierarchical' => true,

        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( 'filters', array('portfolio'), $args );
}

define('SK_PRODUCT_ID',455);
define('SK_ENVATO_PARTNER', 'gSO66qF4N4sYIQ28MBf0zygRwZrZe+9q8S+oh0oMqcc=');
define('SK_ENVATO_SECRET', 'RqjBt/YyaTOjDq+lKLWhL10sFCMCJciT9SPUKLBBmso=');