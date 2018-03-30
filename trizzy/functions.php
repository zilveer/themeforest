<?php
/**
 * Trizzy functions and definitions
 *
 * @package Trizzy
 */
add_theme_support( 'woocommerce' );
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 860; /* pixels */
}

if ( ! function_exists( 'trizzy_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function trizzy_setup() {

   $catalogmode = ot_get_option('pp_woo_catalog','off');
    if ($catalogmode == "on") {
        remove_filter( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart',30 );
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
    }

    if(ot_get_option('pp_disablemm','off') == 'off') {
        add_action( 'wp_update_nav_menu_item', 'update_menu', 100, 3);
        add_filter( 'wp_edit_nav_menu_walker', 'modify_backend_walker' , 100);
    }
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Trizzy, use a find and replace
	 * to change 'trizzy' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'trizzy', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'trizzy' ),
		'shop' => __( 'Shop Menu', 'trizzy' ),
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
		'image', 'video', 'quote', 'gallery'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'trizzy_custom_background_args', array(
		'default-color' => 'e9e9e9',
		'default-image' => '',
	) ) );



}
add_action( 'after_setup_theme', 'trizzy_setup' );
endif; // trizzy_setup


/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
if ( ! function_exists( 'trizzy_widgets_init' ) ) :
function trizzy_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'trizzy' ),
        'id'            => 'sidebar-1',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="headline">',
        'after_title'   => '</h3><span class="line"></span><div class="clearfix"></div>',
    ) );
    register_sidebar( array(
		'name'          => __( 'Shop', 'trizzy' ),
		'id'            => 'shop',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="headline">',
		'after_title'   => '</h3><span class="line"></span><div class="clearfix"></div>',
	) );
	register_sidebar(array(
		'id' => 'footer1st',
		'name' => 'Footer 1st Column',
		'description' => '1st column for widgets in Footer.',
		'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title'  => '<h3 class="headline footer">',
		'after_title'   => '</h3><span class="line"></span><div class="clearfix"></div>',
		));
	register_sidebar(array(
		'id' => 'footer2nd',
		'name' => 'Footer 2nd Column',
		'description' => '2nd column for widgets in Footer.',
		'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title'  => '<h3 class="headline footer">',
		'after_title'   => '</h3><span class="line"></span><div class="clearfix"></div>',
		));
	register_sidebar(array(
		'id' => 'footer3rd',
		'name' => 'Footer 3rd Column',
		'description' => '3rd column for widgets in Footer.',
		'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title'  => '<h3 class="headline footer">',
		'after_title'   => '</h3><span class="line"></span><div class="clearfix"></div>',
		));
	register_sidebar(array(
		'id' => 'footer4th',
		'name' => 'Footer 4th Column',
		'description' => '4th column for widgets in Footer.',
		'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title'  => '<h3 class="headline footer">',
		'after_title'   => '</h3><span class="line"></span><div class="clearfix"></div>',
		));
         //custom sidebars:
 if (ot_get_option('incr_sidebars')):
    $pp_sidebars = ot_get_option('incr_sidebars');
    foreach ($pp_sidebars as $pp_sidebar) {
        register_sidebar(array(
            'name' => $pp_sidebar["title"],
            'id' => $pp_sidebar["id"],
            'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
            'after_widget' => '</div>',
            'before_title'  => '<h3 class="headline footer">',
            'after_title'   => '</h3><span class="line"></span><div class="clearfix"></div>',
            ));
    }
endif;
}
add_action( 'widgets_init', 'trizzy_widgets_init' );
endif;


/**
 * Enqueue scripts and styles.
 */
if ( ! function_exists( 'trizzy_scripts' ) ) :
function trizzy_scripts() {


    wp_enqueue_style( 'trizzy-base', get_template_directory_uri(). '/css/base.css' );
    wp_enqueue_style( 'trizzy-responsive', get_template_directory_uri(). '/css/responsive.css' );
    wp_enqueue_style( 'trizzy-font-awesome', get_template_directory_uri(). '/css/font-awesome.css' );
	wp_enqueue_style( 'trizzy-style', get_stylesheet_uri() );
    wp_deregister_style('currency-switcher');
    wp_deregister_style('wp-pagenavi',10);


	wp_enqueue_script( 'jpanelmenu', get_template_directory_uri() . '/js/jquery.jpanelmenu.js', array(), '20140612', true );
    wp_enqueue_script( 'showbizpro', get_template_directory_uri() . '/js/jquery.themepunch.showbizpro.min.js', array(), '20140612', true );
	wp_enqueue_script( 'themepunchplugins', get_template_directory_uri() . '/js/jquery.themepunch.plugins.min.js', array(), '20140612', true );
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array(), '20140612', true );
	wp_enqueue_script( 'hoverIntent', get_template_directory_uri() . '/js/hoverIntent.js', array(), '20140612', true );
	wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish.js', array(), '20140612', true );
	wp_enqueue_script( 'pureparallax', get_template_directory_uri() . '/js/jquery.pureparallax.js', array(), '20140612', true );
	wp_enqueue_script( 'selectric', get_template_directory_uri() . '/js/jquery.selectric.min.js', array(), '20140612', true );
	wp_enqueue_script( 'royalslider', get_template_directory_uri() . '/js/jquery.royalslider.min.js', array(), '20140612', true );
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array(), '20140612', true );
	wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/js/waypoints.min.js', array(), '20140612', true );
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array(), '20140612', true );
	wp_enqueue_script( 'counterup', get_template_directory_uri() . '/js/jquery.counterup.min.js', array(), '20140612', true );
	wp_enqueue_script( 'tooltips', get_template_directory_uri() . '/js/jquery.tooltips.min.js', array(), '20140612', true );
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), '20140612', true );
    wp_enqueue_script( 'puregrid', get_template_directory_uri() . '/js/puregrid.js', array(), '20140612', true );
	wp_enqueue_script( 'smoothscroll', get_template_directory_uri() . '/js/smoothscroll.js', array(), '20140612', true );
    wp_enqueue_script( 'stacktable', get_template_directory_uri() . '/js/stacktable.js', array(), '20140612', true );
    wp_enqueue_script( 'multipleselect', get_template_directory_uri() . '/js/jquery.multiple.select.js', array(), '20140612', true );
    //add check for contact page
    wp_enqueue_script( 'google-maps', 'http://maps.google.com/maps/api/js' );
	wp_enqueue_script( 'gmaps', get_template_directory_uri() . '/js/jquery.gmaps.min.js', array(), '20140612', true );
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array(), '20140612', true );
    

    $trizzyfonts = build_webfonts_links();
    if(!empty($trizzyfonts)) {
        $protocol = is_ssl() ? 'https' : 'http';
        $font_query_args = array(
            'family' => $trizzyfonts['fonts'],
            'subset' => $trizzyfonts['subsets'],
        );

        wp_enqueue_style('trizzy-gfont',
            add_query_arg($font_query_args, "$protocol://fonts.googleapis.com/css" ),
            array(), null
        );
    }

    wp_localize_script( 'custom', 'trizzy',
    array(
        'ajaxurl'=>admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('ajax-nonce'),
        'breakpoint' => ot_get_option('pp_menu_breakpoint','767'),
        'out_of_stock' => __( 'Out of stock','trizzy'),
        'retinalogo'=> ot_get_option('pp_logo_retina_upload'),
        'isotope'=> ot_get_option('pp_isotope_layout','masonry'),
        )
    );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'trizzy_scripts' );
endif;

add_action( 'wp_enqueue_scripts', 'load_trizzy_wc_scripts' );

function load_trizzy_wc_scripts() {
        if ( class_exists( 'WooCommerce' ) ) {
            global $wp_scripts;
            $gallerytype = ot_get_option('pp_product_default_gallery','off');
            if($gallerytype == 'off') {
                $wp_scripts->registered[ 'wc-add-to-cart-variation' ]->src = get_template_directory_uri() . '/woocommerce/js/add-to-cart-variation.js';
            }
        }
    }

if ( ! function_exists( 'build_webfonts_links' ) ) :
function build_webfonts_links() {
    $fonts_options = ot_get_option( 'trizzy_font', array(
        "Open Sans" => array(
            'font-name'=> 'Open Sans',
            'variants' => 'regular,400,300,600,700,',
            'subsets' => 'latin'
            )
        ));
   if(!empty($fonts_options)) {
    $phantomfonts = array();

    //building googlefonts link:
    $googlefontsarray = array();
    $output = array();
    foreach ($fonts_options as $key) {
        if(isset($key['font-name'])) { $font = $key['font-name']; } else { $font = ''; }
        if(isset($key['subsets'])) { $subsets = $key['subsets']; } else { $subsets = ''; }
        if(isset($key['variants'])) { $variants = $key['variants']; } else { $variants = ''; }
        if(!empty($variants)) {
            $ready_variants = ":".$variants;
        } else {
            $ready_variants = '';
        }
        if(!empty($subsets)) {
            $ready_subsets = $subsets;
        } else {
            $ready_subsets = '';
        }
            $font = str_replace(' ', '+', $font);
            $googlefontsarray['fonts'][] = $font.$ready_variants;
            $googlefontsarray['subsets'][] = $ready_subsets;
    }

    $output['fonts'] = implode("|", $googlefontsarray['fonts']);
    $output['subsets'] = implode(",", $googlefontsarray['subsets']);
    //let's clean duplicated subsets
    $arr = explode( "," , $output['subsets'] );
    $arr = array_unique( $arr );
    $output['subsets'] = implode("," , $arr);
    return $output;
    }
}
endif;


if ( ! function_exists( 'trizzy_load_admin_script' ) ) :
function trizzy_load_admin_script() {
    wp_enqueue_script( 'centum_ot_fonts', get_template_directory_uri() . '/inc/assets/ot_googlefonts_ajax.js' );
}
add_action('admin_enqueue_scripts', 'trizzy_load_admin_script');
endif;


add_filter( 'jpeg_quality', create_function( '', 'return 100;' ) );
/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require_once get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/customizer.php';


/**
 * Load Visual Composer compatibility file.
 */

if(function_exists('vc_map')) {
    require_once get_template_directory() . '/inc/vc.php';
    require_once get_template_directory() . '/inc/vc_modified_shortcodes.php';
}
/**
 * Load Shortcodes.
 */
require_once get_template_directory() . '/inc/shortcodes.php';

/**
 * Load Widgets.
 */
require_once get_template_directory() . '/inc/widgets.php';

/**
 * Megamenu
 */
require_once( get_template_directory() . '/inc/megamenu.php' );

/**
 * Megamenu
 */
require_once( get_template_directory() . '/inc/ptshortcodes.php' );

/**
 * Categories tax
 */
require_once("inc/Tax-meta-class/Tax-meta-class.php");
require_once("inc/categories-tax.php");


/**
 * WooCommerce related code
 */
 if ( class_exists( 'WooCommerce' ) ) {
require_once( get_template_directory() . '/inc/woocommerce.php' );
}
/**
 * Custom functions that act independently of the theme templates
 */
require_once( get_template_directory() . '/inc/tgmpa.php' );

require_once( get_template_directory() . '/inc/pointers-help.php' );

/**
 * Add default posts and comments RSS feed links to head
 */
add_theme_support( 'automatic-feed-links' );

/**
 * Enable support for Post Thumbnails
 */
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size(860, 0, true); //size of thumbs

add_image_size('cart-square-thumb',55, 55, true);     //slider
add_image_size('shop-square-thumb',80, 80, true);     //slider
add_image_size('shop-small-thumb', 96, 105, true);     //slider
add_image_size('blog-size', 420, 300, true);     //slider
add_image_size('portfolio-3col', 300, 214, true);     //slider
add_image_size('portfolio-4col', 220, 157, true);     //slider
add_image_size('portfolio-dyngrid', 280, 200, true);     //slider
add_image_size('team-thumb', 590, 320, true);     //slider


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
 * Loads the meta boxes for post formats
 */
add_filter( 'ot_post_formats', '__return_true' );


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



/* ----------------------------------------------------- */
/* Portfolio Custom Post Type */
/* ----------------------------------------------------- */

if (!function_exists('register_cpt_portfolio')) {
    add_action( 'init', 'register_cpt_portfolio' );
    function register_cpt_portfolio() {

        $labels = array(
            'name' => __( 'Portfolio','trizzy'),
            'singular_name' => __( 'Portfolio','trizzy'),
            'add_new' => __( 'Add New','trizzy' ),
            'add_new_item' => __( 'Add New Work','trizzy' ),
            'edit_item' => __( 'Edit Work','trizzy'),
            'new_item' => __( 'New Work','trizzy'),
            'view_item' => __( 'View Work','trizzy'),
            'search_items' => __( 'Search Portfolio','trizzy'),
            'not_found' => __( 'No portfolio found','trizzy'),
            'not_found_in_trash' => __( 'No works found in Trash','trizzy'),
            'parent_item_colon' => __( 'Parent work:','trizzy'),
            'menu_name' => __( 'Portfolio','trizzy'),
            );

        $args = array(
            'labels' => $labels,
            'hierarchical' => false,
            'description' => __('Display your works by filters','trizzy'),
            'supports' => array( 'title', 'editor', 'excerpt', 'revisions', 'thumbnail' ),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
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
}
/* ----------------------------------------------------- */
/* Filter Taxonomy */
/* ----------------------------------------------------- */
if (!function_exists('register_taxonomy_filters')) {
    add_action( 'init', 'register_taxonomy_filters' );

    function register_taxonomy_filters() {

        $labels = array(
            'name' => __( 'Filters', 'trizzy' ),
            'singular_name' => __( 'Filter', 'trizzy' ),
            'search_items' => __( 'Search Filters', 'trizzy' ),
            'popular_items' => __( 'Popular Filters', 'trizzy' ),
            'all_items' => __( 'All Filters', 'trizzy' ),
            'parent_item' => __( 'Parent Filter', 'trizzy' ),
            'parent_item_colon' => __( 'Parent Filter:', 'trizzy' ),
            'edit_item' => __( 'Edit Filter', 'trizzy' ),
            'update_item' => __( 'Update Filter', 'trizzy' ),
            'add_new_item' => __( 'Add New Filter', 'trizzy' ),
            'new_item_name' => __( 'New Filter', 'trizzy' ),
            'separate_items_with_commas' => __( 'Separate Filters with commas', 'trizzy' ),
            'add_or_remove_items' => __( 'Add or remove Filters', 'trizzy' ),
            'choose_from_most_used' => __( 'Choose from the most used Filters', 'trizzy' ),
            'menu_name' => __( 'Filters', 'trizzy' ),
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
}

if (!function_exists('trizzy_custom_taxonomy_post_class')) {
/*
 * Adds terms from a custom taxonomy to post_class
 */
add_filter( 'post_class', 'trizzy_custom_taxonomy_post_class', 10, 3 );

    function trizzy_custom_taxonomy_post_class( $classes, $class, $ID ) {
        $taxonomy = 'filters';
        $terms = get_the_terms( (int) $ID, $taxonomy );
        if( !empty( $terms ) ) {
            foreach( (array) $terms as $order => $term ) {
                if( !in_array( $term->slug, $classes ) ) {
                    $classes[] = $term->slug;
                }
            }
        }
        return $classes;
    }
}

/* ----------------------------------------------------- */
/* Testimonials Custom Post Type */
/* ----------------------------------------------------- */

if (!function_exists('register_cpt_testimonials')) {
    add_action( 'init', 'register_cpt_testimonials' );

    function register_cpt_testimonials() {

        $labels = array(
            'name' => __( 'Testimonials','trizzy'),
            'singular_name' => __( 'testimonial','trizzy'),
            'add_new' => __( 'Add New','trizzy' ),
            'add_new_item' => __( 'Add New Testimonial','trizzy' ),
            'edit_item' => __( 'Edit Testimonial','trizzy'),
            'new_item' => __( 'New Testimonial','trizzy'),
            'view_item' => __( 'View Testimonial','trizzy'),
            'search_items' => __( 'Search Testimonials','trizzy'),
            'not_found' => __( 'No testimonials found','trizzy'),
            'not_found_in_trash' => __( 'No testimonials found in Trash','trizzy'),
            'parent_item_colon' => __( 'Parent testimonial:','trizzy'),
            'menu_name' => __( 'Testimonials','trizzy'),
            );

        $args = array(
            'labels' => $labels,
            'hierarchical' => false,
            'description' => __('Display your works by filters','trizzy'),
            'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,

        //'menu_icon' => TEMPLATE_URL . 'work.png',
            'show_in_nav_menus' => false,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => true,
            'query_var' => true,
            'can_export' => true,
            'rewrite' => array( 'slug' => 'testimonial'),
            'capability_type' => 'post'
            );

        register_post_type( 'testimonial', $args );
    }
}


/* ----------------------------------------------------- */
/* Team Custom Post Type */
/* ----------------------------------------------------- */

if (!function_exists('register_cpt_team')) {
    add_action( 'init', 'register_cpt_team' );

    function register_cpt_team() {

        $labels = array(
            'name' => __( 'Team','trizzy'),
            'singular_name' => __( 'Team','trizzy'),
            'add_new' => __( 'Add New','trizzy' ),
            'add_new_item' => __( 'Add New Team Member','trizzy' ),
            'edit_item' => __( 'Edit Team Member','trizzy'),
            'new_item' => __( 'New Team Member','trizzy'),
            'view_item' => __( 'View Team Member','trizzy'),
            'search_items' => __( 'Search Team Members','trizzy'),
            'not_found' => __( 'No Team Members found','trizzy'),
            'not_found_in_trash' => __( 'No Team Members found in Trash','trizzy'),
            'parent_item_colon' => __( 'Parent member:','trizzy'),
            'menu_name' => __( 'Team','trizzy'),
            );

        $args = array(
            'labels' => $labels,
            'hierarchical' => false,
            'supports' => array( 'title', 'excerpt', 'editor', 'thumbnail', 'custom-fields' ),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
        //'menu_icon' => TEMPLATE_URL . 'work.png',
            'show_in_nav_menus' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'has_archive' => true,
            'query_var' => true,
            'can_export' => true,
            'rewrite' => array( 'slug' => 'team'),
            'capability_type' => 'post'
            );
        register_post_type( 'team', $args );
    }
}

if (function_exists('set_revslider_as_theme')) {
    set_revslider_as_theme();
}

add_action( 'vc_before_init', 'trizzy_vcSetAsTheme' );
function trizzy_vcSetAsTheme() {
    vc_set_as_theme(true);
}
?>