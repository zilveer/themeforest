<?php
/**
 * @author Stylish Themes
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }


/************************************************************/
/* Define Theme's Constants */
/************************************************************/
if ( !defined( 'THEMEROOT' ) ) {
    define('THEMEROOT', get_template_directory_uri());
}

if ( !defined( 'THEMEDIR' ) ) {
    define('THEMEDIR', get_template_directory());
}

define('IMAGES', THEMEROOT . '/assets/img');

if ( !defined( 'LANGUAGE_ZONE' ) ) {
    define( 'LANGUAGE_ZONE', 'clubix' );
}

if ( !defined( 'LANGUAGE_ZONE_ADMIN' ) ) {
    define( 'LANGUAGE_ZONE_ADMIN', 'clubix' );
}


/************************************************************/
/* Theme Setup Function */
/************************************************************/
add_action( 'after_setup_theme', 'clubix_theme_setup' );

function clubix_theme_setup() {

    // Load textdomain for translation
    load_theme_textdomain( 'clubix', get_template_directory() . '/lang' );

    // Set a max with for the uploaded images.
    if (!isset($content_width)) $content_width = 1028;


    // Set the vc_path to the new folder
    if ( function_exists('vc_set_template_dir') ) {
        $dir = get_template_directory() . '/vc_templates/';
        vc_set_template_dir($dir);
    }
    if(function_exists('vc_set_as_theme')) vc_set_as_theme(true);


    // Add Theme Support for Post Formats, Post Thumbnails and Automatic Feed Links
    if (function_exists('add_theme_support')) {


        // This theme supports a variety of post formats
        add_theme_support('post-formats', array('video', 'audio', 'gallery'));


        // Add theme support for post-thumbnails & declare its size
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(350, 350, true);


        // Adds RSS feed links to <head> for posts and comments
        add_theme_support('automatic-feed-links');

        add_theme_support( 'woocommerce' );

        // This theme styles the visual editor with editor-style.css to match the theme style
        add_editor_style();


        // Add special field to image for audio/video post
        add_filter( 'attachment_fields_to_edit', 'zen_attachment_fields_to_edit', 10, 2 );
        add_action( 'edit_attachment', 'zen_save_attachment_fields' );
    }


    if ( function_exists( 'add_image_size' ) ) {

        add_image_size('blog_image_1', 300, 300, true);

        add_image_size('blog_image_2', 890, 9999);

        add_image_size('song_single', 663, 9999);

        add_image_size('album_list_1', 400, 400, true);

        add_image_size('event_list_1', 400, 550, true);

        add_image_size('front_boxes', 350, 262, true);

    }


    // Load custom Scripts and Styles for Haze.
    add_action('wp_enqueue_scripts', 'clubix_load_custom_scripts');
    add_action('wp_enqueue_scripts', 'clubix_load_custom_styles');


    // Set widgets to accept shortcodes
    add_filter('widget_text', 'do_shortcode');


    // Comments filters
    add_filter('comment_form_defaults', 'zen_custom_comment_form');
    add_filter('comment_form_default_fields', 'zen_custom_comment_fields');


    // Register Menus
    add_action('init', 'register_clubix_menu');


    // Add Google Analytics
    add_action('wp_head','zen_google_analytics');


    // TODO: Nu uita sa scoti asta
    //add_filter('show_admin_bar', '__return_false');

    if(function_exists('vc_disable_frontend')) {
        vc_disable_frontend();
    }

}


/************************************************************/
/* Theme Scripts Function */
/************************************************************/
function clubix_load_custom_scripts() {
    
    if( function_exists( 'is_cart' ) && is_cart() ) {
    	wp_enqueue_script( 'select2' );
    }

    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrapJS', THEMEROOT . '/assets/js/bootstrap.min.js', array(), '1.0', true);
    wp_enqueue_script('jPlayer', THEMEROOT . '/assets/js/jquery.jplayer.min.js', array(), '1.0', true);
    wp_enqueue_script('onePluginsJS', THEMEROOT . '/assets/js/plugins.js', array(), '1.0', true);
    wp_enqueue_script('oneMainJS', THEMEROOT . '/assets/js/main.js', array(), '1.0', true);
    wp_enqueue_script('playersSettings', THEMEROOT . '/assets/js/player.settings.js', array(), '1.0', true);
    wp_enqueue_script('countdown', THEMEROOT . '/assets/js/jquery.countdown.min.js', array(), '1.0', true);

    wp_enqueue_script('google-maps-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDeTTrTo74H7d_CJ4IvP0GLSP7BvZmFD_E&callback=initMap', array(), '1.0', true);

}

/************************************************************/
/* Theme Styles Function */
/************************************************************/
function clubix_load_custom_styles() {

	if( function_exists( 'is_cart' ) && is_cart() ) {
		wp_enqueue_style( 'select2', plugins_url( 'woocommerce/assets/css/select2.css' ) );
	}

    wp_enqueue_style( 'master', THEMEROOT . '/assets/css/master.css');
    //wp_enqueue_style( 'base-color', THEMEROOT . '/assets/css/base-color.css');
    wp_enqueue_style( 'new', THEMEROOT . '/assets/css/new.css');
    wp_enqueue_style( 'style', get_stylesheet_uri());

    wp_dequeue_style( 'woocommerce_chosen_styles' );

}

/************************************************************/
/* Add Google Analytics */
/************************************************************/
function zen_google_analytics() {
    global $clx_data;

    if(!empty($clx_data['jscode'])) {
        print_r(stripslashes($clx_data['jscode']));
    }
}

/************************************************************/
/* Theme Menus Function */
/************************************************************/
function register_clubix_menu(){
    register_nav_menus(array(
        'main-menu' => __('Main Menu', LANGUAGE_ZONE_ADMIN)
    ));
}

/************************************************************/
/* Add custom field for audio/video posts */
/************************************************************/
function zen_attachment_fields_to_edit( $fields, $post ) {

    if ( strpos( get_post_mime_type( $post->ID ), 'image' ) !== false ) {
        $video_url = get_post_meta( $post->ID, 'zen_video_url', true );

        $fields['zen_video_url'] = array(
            'label' 		=> __('Video URL: ', LANGUAGE_ZONE_ADMIN),
            'input' 		=> 'text',
            'value'			=> $video_url ? $video_url : '',
            'show_in_edit' 	=> true
        );

    }

    return $fields;
}
function zen_save_attachment_fields( $attachment_id ) {

    // video url
    if ( isset( $_REQUEST['attachments'][$attachment_id]['zen_video_url'] ) ) {

        $location = esc_url($_REQUEST['attachments'][$attachment_id]['zen_video_url']);
        update_post_meta( $attachment_id, 'zen_video_url', $location );
    }

}


/************************************************************/
/* Remove ReduxFramework Demo Mode */
/************************************************************/
function removeDemoModeLink() { // Be sure to rename this function to something more unique
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
    }
}
add_action('init', 'removeDemoModeLink');


/************************************************************/
/* Set the excerpt length */
/************************************************************/
function custom_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/************************************************************/
/**
 * WooCommerce Support
 * @since 1.2.0
 */
/************************************************************/
if (defined( 'WOOCOMMERCE_VERSION' )) {
    if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
        add_filter( 'woocommerce_enqueue_styles', '__return_false' );
    } else {
        define( 'WOOCOMMERCE_USE_CSS', false );
    }
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'zen_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'zen_wrapper_end', 10);

function zen_wrapper_start() {
    echo '<div class="container"><div class="row"><div class="content-container"><div class="content-container-inner clearfix">';
}

function zen_wrapper_end() {
    echo '</div></div></div></div>';
}


/* ??? */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
add_action( 'zen_shop_breadcrumbs', 'woocommerce_breadcrumb', 20);
add_filter( 'woocommerce_show_page_title' , '__return_false' );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
/* ??? */

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 5);
add_action( 'clx_before_shop_loop_buttons', 'zen_woo_loop_product_info', 10);
add_action( 'woocommerce_single_product_summary', 'zen_woo_single_product_border', 15);

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
add_action( 'clx_before_shop_loop_buttons', 'woocommerce_template_loop_add_to_cart', 5 );

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );

function zen_woo_loop_product_info() {
    $output = '<a href="'.get_permalink().'" class="show_details_button">'.__('More info',LANGUAGE_ZONE).'</a>';

    echo $output;
}

function zen_woo_single_product_border() {
    $output = '<div class="clear"></div>';
    $output .= '<div class="product-border"></div>';

    echo $output;
}

add_action( 'woocommerce_before_cart_table', 'zen_before_cart_table', 10);
function zen_before_cart_table(){
    echo '<div class="woocommerce-content-box clearfix">';
}

add_action( 'woocommerce_after_cart_table', 'zen_after_cart_table', 10);
function zen_after_cart_table(){
    echo '</div>';
}

/************************************************************/
/* End WooCommerce Support */
/************************************************************/


/************************************************************/
/* Theme Includes Helpers */
/************************************************************/
require_once(THEMEDIR.'/lib/functions/core-functions.php');
require_once(THEMEDIR.'/lib/functions/color-handler.php');
require_once(THEMEDIR.'/lib/functions/filters_and_actions.php');
require_once(THEMEDIR.'/lib/functions/helpers.php');
require_once(THEMEDIR.'/lib/functions/comments-helpers.php');

// Post Type Rulz
require_once(THEMEDIR.'/lib/functions/clubix-posttypes.php');

// Shortcodes Rulz
require_once(THEMEDIR.'/lib/functions/clubix-shortcodes.php');

// Metaboxes Rulz
define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/admin/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/admin/meta-box' ) );

require_once(RWMB_DIR . 'meta-box.php');
require_once(THEMEDIR . '/lib/functions/clubix-metaboxes.php');

// Meta Box Show/Hide
require_once(THEMEDIR . '/admin/meta-box-show-hide/meta-box-show-hide.php');

// Widgets Rulz
require_once(THEMEDIR .'/lib/functions/clubix-widgets.php');

// Redux Framework
if (class_exists('ReduxFramework')) {
    require_once(THEMEDIR .'/admin/redux-framework/options-init.php');
}

// TGM Activation Plugin
require_once(THEMEDIR . '/admin/tgm/tgm-init.php');



/***********************************************************************************************/
/* Add Sidebar Support */
/***********************************************************************************************/
if (function_exists('register_sidebar')) {

    register_sidebar(
        array(
            'name' => __( 'Main Sidebar', LANGUAGE_ZONE_ADMIN ),
            'id' => 'main-sidebar',
            'description' => __( 'Appears on posts and pages, which has its own widgets', LANGUAGE_ZONE_ADMIN ),
            'before_widget' => '<div id="%1$s" class="container-row widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="row"><div class="col-sm-12"><h3 style="text-transform: uppercase;font-size: 22px;font-weight: 400;margin-top: 0;margin-bottom:10px;">',
            'after_title' => '</h3><div class="underline-bg"><div class="underline template-based-element-background-color"></div></div></div></div>'
        )
    );

    global $clx_data;

    $col_class = 'col-sm-3';
    if(isset($clx_data)) { $col_class = 'col-sm-'.(12 / $clx_data['footer-columns']); }

    register_sidebar(
        array(
            'name' => __( 'Footer Sidebar', LANGUAGE_ZONE_ADMIN ),
            'id' => 'footer-sidebar',
            'description' => __( 'Appears on footer, which has its own widgets.', LANGUAGE_ZONE_ADMIN ),
            'before_widget' => '<div class="'.$col_class.'"><div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div></div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>'
        )
    );
}


/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require THEMEDIR . '/admin/tcm-theme-lock/class-tcm-theme-lock.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tcm_theme_lock() {

    $plugin = new Tcm_Theme_Lock();
    $plugin->run();

}
run_tcm_theme_lock();

// Force WooCommerce "Ship to billing address" option to checked by default
//add_filter( 'woocommerce_ship_to_different_address_checked', '__return_true' );
