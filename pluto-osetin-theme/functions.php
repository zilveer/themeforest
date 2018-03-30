<?php
if(session_id() == '') session_start();
/**
 * This is the main file for this theme, it loads all the required libraries and settings
 */

if ( ! isset( $content_width ) ) {
  $content_width = 474;
}
/**
 * Pluto only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
  require get_template_directory() . '/inc/back-compat.php';
}

// Set the version for the theme
if (!defined('PLUTO_THEME_VERSION')) define('PLUTO_THEME_VERSION', '2.1.1');


/**
 * Activate required plugins using TGM PLUGIN ACTIVATOR CLASS
 */
require_once dirname( __FILE__ ) . '/inc/class-tgm-plugin-activation.php';
require_once dirname( __FILE__ ) . '/inc/activate-required-plugins.php';

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
add_action( 'vc_before_init', 'os_pluto_vc_set_as_theme' );
function os_pluto_vc_set_as_theme() {
  vc_set_as_theme();
}

/**
* Include ACF, options, gallery & Load acf data
*/
include_once( dirname( __FILE__ ) . '/inc/acf/advanced-custom-fields/acf.php' );
include_once( dirname( __FILE__ ) . '/inc/acf/acf-gallery/acf-gallery.php' );
include_once( dirname( __FILE__ ) . '/inc/acf/acf-options-page/acf-options-page.php' );
include_once( dirname( __FILE__ ) . '/inc/acf/acf-repeater/acf-repeater.php' );

// Comment these two lines out for development

// define( 'ACF_LITE', true );
include_once dirname( __FILE__ ) . '/inc/load-acf-data.php';


/**
 * Include helpers & shortcodes
 */
require_once dirname( __FILE__ ) . '/inc/osetin-helpers.php';
require_once dirname( __FILE__ ) . '/inc/shortcodes.php';



/* Include less css processing helper functions */
require_once( get_template_directory() . '/inc/wp-less.php');
require_once( get_template_directory() . '/inc/less-variables.php');



if ( ! function_exists( 'pluto_setup' ) ) :

function pluto_setup() {
  load_theme_textdomain( 'pluto', get_template_directory() . '/languages' );


  // Add RSS feed links to <head> for posts and comments.
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( "custom-header" );
  add_theme_support( "custom-background" );
  add_editor_style();

  // Enable support for Post Thumbnails, and declare two sizes.
  add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size( 672, 372, false );
  add_image_size( 'pluto-full-width', 1038, 576, false );
  add_image_size( 'pluto-index-width', 400, 700, false );
  add_image_size( 'pluto-fixed-height', 400, 300, true );
  add_image_size( 'pluto-fixed-height-image', 400, 700, true );
  add_image_size( 'pluto-top-featured-post', 200, 150, true );
  add_image_size( 'pluto-carousel-post', 600, 400, true );

  // This theme uses wp_nav_menu() in two locations.
  register_nav_menus( array(
    'side_menu' => __( 'Side menu', 'pluto' ),
  ) );

  /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support( 'html5', array(
    'search-form', 'comment-form', 'comment-list',
  ) );

  /*
   * Enable support for Post Formats.
   * See http://codex.wordpress.org/Post_Formats
   */
  add_theme_support( 'post-formats', array(
    'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
  ) );


  function os_search_filter($query) {
      if ($query->is_search) {
          $query->set('post_type', 'post');
      }
      return $query;
  }
  add_filter('pre_get_posts','os_search_filter');

}
endif; // pluto_setup
add_action( 'after_setup_theme', 'pluto_setup' );


// Add specific CSS class by filter
add_filter('body_class','osetin_menu_body_class');
function osetin_menu_body_class($classes) {
  // add body class depending on menu position
  switch(get_current_menu_position()){
    case "top":
      $classes[] = 'menu-position-top';

      switch(get_current_menu_style()){
        case "v1":
          $classes[] = 'menu-style-v1';
        break;
        case "v2":
          $classes[] = 'menu-style-v2 menu-fixed';
        break;
        default:
          $classes[] = 'menu-style-v2 menu-fixed';
        break;
      }

    break;
    case "right":
      $classes[] = 'menu-position-right';
    break;
    default:
      $classes[] = 'menu-position-left';
    break;
  }
  if(get_field('menu_open_style', 'option') == 'click'){
    $classes[] = 'menu-trigger-click';
  }else{
    $classes[] = 'menu-trigger-hover';
  }
  if(is_home() || is_page_template('page-photos.php') || is_page_template('page-masonry.php') || is_page_template('page-masonry-condensed.php') || is_page_template('page-masonry-condensed-facebook.php') || is_page_template('page-masonry-simple.php') || is_page_template('page-masonry-simple-facebook.php') || is_page_template('page-masonry-condensed-with-author.php') || is_page_template('page-masonry-condensed-fixed-height.php')){

    // MASONRY PAGE - first check if we want to show a sidebar on masonry page
    if(os_get_show_sidebar_on_masonry() == true){
      // add body class depending on sidebar position
      switch(get_field('sidebar_position', 'option')){
        case "left":
          $classes[] = 'sidebar-position-left';
        break;
        case "right":
          $classes[] = 'sidebar-position-right';
        break;
        case "none":
          $classes[] = 'no-sidebar';
        break;
        default:
          $classes[] = 'sidebar-position-left';
        break;
      }
    }else{
      $classes[] = 'no-sidebar';
    }
  }else{
    // OTHER PAGES
    // add body class depending on sidebar position
    switch(get_field('sidebar_position', 'option')){
      case "left":
        $classes[] = 'sidebar-position-left';
      break;
      case "right":
        $classes[] = 'sidebar-position-right';
      break;
      case "none":
        $classes[] = 'no-sidebar';
      break;
      default:
        $classes[] = 'sidebar-position-left';
      break;
    }
  }
  // if custom colors are enabled - check if we need to wrap widgets in a box
  if(get_field('enable_custom_colors', 'option') == true){
    if(get_field('put_widgets_in_the_box', 'option') == true){
      $classes[] = 'wrapped-widgets';
    }else{
      $classes[] = 'not-wrapped-widgets';
    }
  }else{
    if(in_array(os_get_current_color_scheme(), array('pinkman', 'space', 'sakura'))){
      $classes[] = 'wrapped-widgets';
    }else{
      $classes[] = 'not-wrapped-widgets';
    }
    if(in_array(os_get_current_color_scheme(), array('space', 'sakura'))){
      $classes[] = 'no-padded-sidebar';
    }
  }
  if(get_field('enable_ads_on_smartphones', 'option') != true){
    $classes[] = 'no-ads-on-smartphones';
  }
  if(get_field('enable_ads_on_tablets', 'option') != true){
    $classes[] = 'no-ads-on-tablets';
  }
  if(os_get_use_fixed_height_index_posts() == true){
    $classes[] = 'fixed-height-index-posts';
  }
  if(os_get_current_navigation_type() == 'infinite'){
    $classes[] = 'with-infinite-scroll';
  }elseif(os_get_current_navigation_type() == 'infinite_button'){
    $classes[] = 'with-infinite-button';
  }

  if(is_archive() || is_home() || get_field('page_fixed_width') == true || is_page_template('page-masonry.php') || is_page_template('page-masonry-condensed.php') || is_search() || is_page_template('page-photos.php') || is_page_template('page-masonry-condensed-facebook.php') || is_page_template('page-masonry-simple.php') || is_page_template('page-masonry-simple-facebook.php') || is_page_template('page-masonry-condensed-with-author.php') || is_page_template('page-masonry-condensed-fixed-height.php')){
    $classes[] = 'page-fluid-width';
  }else{
    $classes[] = 'page-fixed-width';
  }
  // return the $classes array
  return $classes;
}





// WOOCOMMERCE


/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
  require_once( get_template_directory() . '/inc/activate-woocommerce.php');
}

function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}



// USERPRO


/**
 * Check if UserPro is active
 **/
if ( in_array( 'userpro/index.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
  require_once( get_template_directory() . '/inc/activate-userpro.php');
}






// Include the Ajax library on the front end
add_action( 'wp_head', 'add_ajax_library' );

/**
 * Adds the WordPress Ajax Library to the frontend.
 */
function add_ajax_library() {

    $html = '<script type="text/javascript">';
        $html .= 'var ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '"';
    $html .= '</script>';

    echo $html;

} // end add_ajax_library


require_once dirname( __FILE__ ) . '/inc/infinite-scroll.php';

/**
 * Register Pluto widget areas.
 *
 * @since Pluto 1.0
 *
 * @return void
 */
function pluto_widgets_init() {
  require get_template_directory() . '/inc/widgets.php';

  register_sidebar( array(
    'name'          => __( 'Primary Sidebar', 'pluto' ),
    'id'            => 'sidebar-1',
    'description'   => __( 'Main sidebar that appears on the right.', 'pluto' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h1 class="widget-title">',
    'after_title'   => '</h1>',
  ) );
  register_sidebar( array(
    'name'          => __( 'Advert Under Menu', 'pluto' ),
    'id'            => 'sidebar-2',
    'description'   => __( 'Sidebar which appears under the menu.', 'pluto' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h1 class="widget-title">',
    'after_title'   => '</h1>',
  ) );
  register_sidebar( array(
    'name'          => __( 'Advert on Top', 'pluto' ),
    'id'            => 'sidebar-3',
    'description'   => __( 'Sidebar which appears on the top of the page.', 'pluto' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h1 class="widget-title">',
    'after_title'   => '</h1>',
  ) );
}
add_action( 'widgets_init', 'pluto_widgets_init' );



/**
 * TypeKit Fonts
 *
 * @since Pluto 1.0
 */
function pluto_load_typekit() {
  if ( wp_script_is( 'pluto_typekit', 'done' ) ) {
    echo '<script type="text/javascript">try{Typekit.load();}catch(e){}</script>';
  }
}

/**
 * myFonts.com Fonts
 *
 * @since Pluto 1.5.7
 */
function pluto_load_myfonts_script() {
  if ( get_field('myfonts_code', 'option') ) {
    the_field('myfonts_code', 'option');
  }
}


/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Pluto 1.0
 *
 * @return void
 */
function pluto_scripts() {

  // Add typekit font support
  if(get_field('font_library', 'option') == "adobe_typekit_fonts"){
    wp_enqueue_script( 'pluto_typekit', '//use.typekit.net/' . get_field('adobe_typekit_id', 'option') . '.js');
    add_action( 'wp_head', 'pluto_load_typekit' );
  }elseif(get_field('font_library', 'option') == "myfonts"){
    add_action( 'wp_head', 'pluto_load_myfonts_script' );
  }else{
    // Google Fonts support
    if(get_field('google_fonts_href', 'option')){
      wp_enqueue_style( 'pluto-google-font', get_field('google_fonts_href', 'option'), array(), null );
    }else{
      wp_enqueue_style( 'pluto-google-font', 'http://fonts.googleapis.com/css?family=Droid+Serif:400,700|Open+Sans:300,400,700', array(), null );
    }
  }


  // Flexslider
  wp_enqueue_script( 'pluto-flexslider', get_template_directory_uri() . '/assets/js/jquery.flexslider.min.js', array( 'jquery' ), PLUTO_THEME_VERSION, true );
  // Back to top link
  wp_enqueue_script( 'pluto-back-to-top', get_template_directory_uri() . '/assets/js/back-to-top.js', array( 'jquery' ), PLUTO_THEME_VERSION, true );

  // Init Lightbox
  if(get_field('disable_default_image_lightbox', 'option') != true){
    wp_enqueue_style( 'pluto-magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), PLUTO_THEME_VERSION );
    wp_enqueue_script( 'pluto-magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array( 'jquery' ), PLUTO_THEME_VERSION, true );
    wp_enqueue_script( 'pluto-magnific-popup-init', get_template_directory_uri() . '/assets/js/init-lightbox.js', array( 'jquery', 'pluto-magnific-popup' ), PLUTO_THEME_VERSION, true );
  }

  // Load our main stylesheet.
  wp_enqueue_style( 'pluto-style', get_stylesheet_uri() );
  // Load editor styles
  wp_enqueue_style( 'pluto-editor-style', get_template_directory_uri() . '/editor-style.css', array(), PLUTO_THEME_VERSION );

  // Color scheme

  if ( is_rtl() ) {
    // If theme uses right-to-left language
    wp_enqueue_style( 'pluto-main-less-rtl', get_template_directory_uri() . '/assets/less/include-list-rtl.less', array(), PLUTO_THEME_VERSION );
  }else{
    wp_enqueue_style( 'pluto-main-less', get_template_directory_uri() . '/assets/less/include-list.less', array(), PLUTO_THEME_VERSION );
  }

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }

  wp_enqueue_script( 'pluto-jquery-debounce', get_template_directory_uri() . '/assets/js/jquery.ba-throttle-debounce.min.js', array( 'jquery' ), PLUTO_THEME_VERSION, true );
  // infinite scroll helpers
  if(os_get_current_navigation_type() == 'infinite' || os_get_current_navigation_type() == 'infinite_button'){
    wp_enqueue_script( 'pluto-os-infinite-scroll', get_template_directory_uri() . '/assets/js/infinite-scroll.js', array( 'jquery', 'pluto-jquery-debounce' ), PLUTO_THEME_VERSION, true );
  }

  // Load isotope
  wp_enqueue_script( 'pluto-images-loaded', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', array( 'jquery' ), PLUTO_THEME_VERSION, true );
  wp_enqueue_script( 'pluto-isotope', get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', array( 'jquery', 'pluto-images-loaded' ), PLUTO_THEME_VERSION, true );
  wp_enqueue_script( 'pluto-jquery-mousewheel', get_template_directory_uri() . '/assets/js/jquery.mousewheel.js', array( 'jquery' ), PLUTO_THEME_VERSION, true );
  wp_enqueue_script( 'pluto-perfect-scrollbar', get_template_directory_uri() . '/assets/js/perfect-scrollbar.js', array( 'jquery', 'pluto-jquery-mousewheel' ), PLUTO_THEME_VERSION, true );

  // Load owl carousel plugin
  wp_enqueue_script( 'pluto-owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery', 'pluto-jquery-mousewheel' ), PLUTO_THEME_VERSION, true );
  wp_enqueue_style( 'pluto-owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.css', array(), PLUTO_THEME_VERSION );

  if(is_single()){
    // Load qrcode generator script only for single post
    wp_enqueue_script( 'pluto-qrcode', get_template_directory_uri() . '/assets/js/qrcode.min.js', array( 'jquery' ), PLUTO_THEME_VERSION, true );
    wp_enqueue_script( 'pluto-bootstrap-transition', get_template_directory_uri() . '/assets/js/bootstrap/transition.js', array( 'jquery' ), PLUTO_THEME_VERSION, true );
    wp_enqueue_script( 'pluto-bootstrap-modal', get_template_directory_uri() . '/assets/js/bootstrap/modal.js', array( 'jquery', 'pluto-bootstrap-transition' ), PLUTO_THEME_VERSION, true );
  }

  // if protect images checkbox in admin is set to true - load script
  if(get_field('protect_images_from_copying', 'option') === true){
    wp_enqueue_script( 'pluto-protect-images', get_template_directory_uri() . '/assets/js/image-protection.js', array( 'jquery' ), PLUTO_THEME_VERSION, true );
  }

  // Load default scripts for the theme
  wp_enqueue_script( 'pluto-script', get_template_directory_uri() . '/assets/js/functions.js', array( 'jquery' ), PLUTO_THEME_VERSION, true );
}



add_action( 'wp_enqueue_scripts', 'pluto_scripts' );