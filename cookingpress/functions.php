<?php
/**
 * CookingPress functions and definitions
 *
 * @package CookingPress
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


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 780; /* pixels */

if ( ! function_exists( 'cookingpress_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
// Include the class (unless you are using the script as a plugin)
//require_once( 'inc/wp-less.php' );

function cookingpress_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on CookingPress, use a find and replace
	 * to change 'cookingpress' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'cookingpress', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(360, 215, true); //size of thumbs

	add_image_size('recipe-thumb',210,150, true);
	add_image_size('slider-big',910,460,true);
	add_image_size('slider-medium',780,400,true);
	add_image_size('slider-thumb',80,80,true);

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'cookingpress' ),
		) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	}
endif; // cookingpress_setup
add_action( 'after_setup_theme', 'cookingpress_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function cookingpress_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Sidebar', 'cookingpress' ),
		'id'            => 'sidebar',
		'before_widget' => '<div id="%1$s" class="widget  %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3><span>',
		'after_title' => '</span></h3>',
		));

	register_sidebar(array(
		'id' => 'footer1st',
		'name' => 'Footer Left Column',
		'description' => '1st column for widgets in Footer.',
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3><span>',
		'after_title' => '</span></h3>',
		));

	register_sidebar(array(
		'id' => 'footer2nd',
		'name' => 'Footer Center Column',
		'description' => '2nd column for widgets in Footer.',
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3><span>',
		'after_title' => '</span></h3>',
		));

	register_sidebar(array(
		'id' => 'footer3rd',
		'name' => 'Footer Right Column',
		'description' => '3rd column for widgets in Footer.',
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3><span>',
		'after_title' => '</span></h3>',
		));
	    //custom sidebars:
	if (ot_get_option('incr_sidebars')):
	    $pp_sidebars = ot_get_option('incr_sidebars');
	    foreach ($pp_sidebars as $pp_sidebar) {
	        register_sidebar(array(
	            'name' => $pp_sidebar["title"],
	            'id' => $pp_sidebar["id"],
	            'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3><span>',
				'after_title' => '</span></h3>',
            ));
	    }
	endif;
}
add_action( 'widgets_init', 'cookingpress_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function cookingpress_scripts() {

	wp_enqueue_style( 'bootstrap',  get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'cookingpress-style',  get_stylesheet_uri());
	//wp_enqueue_style( 'cookingpress-theme-style',  get_template_directory_uri() . '/css/style.less' );
	wp_enqueue_style( 'flexslider',  get_template_directory_uri() . '/css/flexslider.css' );
	$layout = get_theme_mod( 'cp_layout_style', 'default' );
	switch ($layout) {
		case 'boxed':
			wp_enqueue_style( 'boxed',  get_template_directory_uri() . '/css/boxed.css' );
			break;
		case 'minimal':
			wp_enqueue_style( 'minimal',  get_template_directory_uri() . '/css/boxed.css' );
			break;
	}



	wp_enqueue_style( 'royalslider',  get_template_directory_uri() . '/css/royalslider.css' );
	wp_enqueue_style( 'rs-default',  get_template_directory_uri() . '/css/rs-default.css' );

	wp_enqueue_style( 'fontawesome',  get_template_directory_uri() . '/css/font-awesome.min.css' );

	wp_enqueue_style( 'typeplate',  get_template_directory_uri() . '/css/typeplate.css' );
	wp_dequeue_style('purethemes-shortcodes');


	wp_enqueue_script( 'cp-magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array(), '', true );
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/jquery.superfish.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'royalslider', get_template_directory_uri() . '/js/jquery.royalslider.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'chosen', get_template_directory_uri() . '/js/chosen.jquery.min.js', array( 'jquery' ), '', true );

	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '', true );

	wp_enqueue_script( 'cookingpress-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'cookingpress-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'cookingpress-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

	$tags = get_terms( 'ingredients',  array( 'orderby' => 'count', 'order' => 'DESC' ) );
	$tags_arr = array();
	foreach ($tags as $tag) {
		array_push($tags_arr, $tag->name);
	}
	wp_enqueue_script( 'jquery-ui-autocomplete' );
	wp_localize_script('custom', 'foodiepress_vars', array(
			'availabletags' => json_encode($tags_arr)
		)
	);
}
add_action( 'wp_enqueue_scripts', 'cookingpress_scripts' );

function cookingpress_admin_script() {
    global $pagenow;
    if (is_admin() && $pagenow == 'post-new.php' OR $pagenow == 'post.php') {
        if ( ! did_action( 'wp_enqueue_media' ) )
            wp_enqueue_media();

        wp_register_style('cp-css', get_template_directory_uri() . '/css/cp.admin.css');
        wp_enqueue_style('cp-css');
 
    }
}
add_action('admin_enqueue_scripts', 'cookingpress_admin_script');


/**
 * Set default background properties
 *
 * @since CookingPress 1.0
 */

$bgargs = array(
    'default-color' => 'ffffff',
    'default-image' => get_template_directory_uri() . '/images/bg/content-bg.gif',
    'default-repeat' => 'repeat',
    'default-position-x' => 'center'
    );
add_theme_support( 'custom-background', $bgargs );

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
     * Custom functions that act independently of the theme templates
     */
require( get_template_directory() . '/inc/tgmpa.php' );

/**
 * Load Jetpack compatibility file .
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Jetpack compatibility file .
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Load Jetpack compatibility file .
 */
require get_template_directory() . '/inc/widgets.php';


/**
 * Load Jetpack compatibility file .
 */

require_once( 'inc/cpslider/init.php'); // Typoslider
$cpslider = new CP_Slider();



/*function my_own_themes( $array ){
    $array['flowerstheme'] = array(
				'name'=>'Flowers Theme',
				'origin' => 'user'
				);
    return $array;
}
add_filter( 'foodiepress_themes', 'my_own_themes',10);*/

function my_own_themes( $array ){
	 unset($array['recipe1']);
	 unset($array['recipe2']);
	 
    return $array;
}
add_filter( 'foodiepress_themes', 'my_own_themes',10);
