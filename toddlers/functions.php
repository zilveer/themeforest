<?php
/*-----------------------------------------------------------------------------------*/
//                         TODDLERS BY UNFAMO.US
/*-----------------------------------------------------------------------------------*/

define('UNF_FRAMEWORK_DIRECTORY', get_template_directory() . '/library/');
define('UNF_THEME_NAME', 'toddlers');

/*-----------------------------------------------------------------------------------*/
// Redux Framework
/*-----------------------------------------------------------------------------------*/

require UNF_FRAMEWORK_DIRECTORY . '/admin/admin-init.php';

/*-----------------------------------------------------------------------------------*/
// Bones & Brew Frameworks
/*-----------------------------------------------------------------------------------*/

require_once( 'library/brew.php' );
require_once( 'library/bones.php' ); // where menus are added and edited.

/*-----------------------------------------------------------------------------------*/
// WP Enqueue Styles and Scripts
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'toddlers_scripts_and_styles' ) ) {
    function toddlers_scripts_and_styles() {
       global $wp_styles;
		if (!is_admin()) {

		// REGISTER CSS
	    wp_register_style( 'compiled', get_template_directory_uri() . '/library/css/compiled.css', array(), '', 'all' );
	    wp_register_style( 'wp-style', get_stylesheet_uri() );
	    wp_register_style( 'fontello', get_template_directory_uri() . '/library/css/fontello.css', array(), '' );


		// REGISTER JS
	    wp_register_script( 'bootstrap-js', get_template_directory_uri() . '/library/js/bootstrap.min.js', array(), 'v3.3.1', true );
	    wp_register_script( 'fitvids', get_template_directory_uri() . '/library/js/fitvids.js', array(), '1.1', true );
	    wp_register_script( 'modernizr', get_template_directory_uri() . '/library/js/modernizr.custom.min.js', array(), '2.5.3', false );
	    wp_register_script( 'theme-js', get_template_directory_uri() . '/library/js/scripts.js', array( 'jquery' ), '', true );


		// ENQUEUE CSS
	    wp_enqueue_style( 'compiled' );
	    wp_enqueue_style( 'wp-style' );
	    wp_enqueue_style( 'fontello' );

		// ENQUEUE JS
	    wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'bootstrap-js' );
		wp_enqueue_script( 'fitvids' );
		wp_enqueue_script( 'modernizr' );
		wp_enqueue_script( 'theme-js' );

		if ( is_page_template( 'page-contact.php' ) ) {
			wp_register_script( 'mapsapi', 'https://maps.google.com/maps/api/js?sensor=false&key=AIzaSyAcOhnbQuyxlkdkDgqxGSkdJWW5OxVyFW0', array(), '', FALSE );
			wp_enqueue_script( 'mapsapi' );
		    wp_register_script( 'initmap', get_template_directory_uri() . '/library/js/initmap.min.js', array(), '', FALSE);
		    wp_enqueue_script( 'initmap' );
		}

	    // Comments JS
	    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
			wp_enqueue_script( 'comment-reply' );
	    }


		wp_register_script( 'slider-js', get_template_directory_uri() . '/library/unf/slider/idangerous.swiper.min.js', array('jquery'),'',false  );
		wp_register_style( 'slider-css', get_template_directory_uri() . '/library/unf/slider/idangerous.swiper.css','','', 'screen' );
		wp_enqueue_script( 'slider-js' );
		wp_enqueue_style( 'slider-css' );

		}
    }
	// OK, RUN!
	add_action( 'wp_enqueue_scripts', 'toddlers_scripts_and_styles', 999 );
}

/*-----------------------------------------------------------------------------------*/
// Sidebars
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'toddlers_register_sidebars' ) ) {
	function toddlers_register_sidebars() {

		register_sidebar(array(
			'id' => 'sidebar',
			'name' => __( 'Blog Sidebar', 'toddlers' ),
			'description' => __( 'The primary sidebar.', 'toddlers' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s blogpagewidget orange"><div class="widgetnails"></div>',
			'after_widget' => '<div class="widgetnails widgetnailsbottom"></div></div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));

		register_sidebar(array(
			'id' => 'homesidebar',
			'name' => __( 'Home Sidebar', 'toddlers' ),
			'description' => __( 'The home sidebar.', 'toddlers' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s homepagewidget orange"><div class="widgetnails"></div>',
			'after_widget' => '<div class="widgetnails widgetnailsbottom"></div></div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));


		register_sidebar(array(
			'id' => 'pagesidebar',
			'name' => __( 'Page Sidebar', 'toddlers' ),
			'description' => __( 'Pages sidebar.', 'toddlers' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s pagespagewidget orange"><div class="widgetnails"></div>',
			'after_widget' => '<div class="widgetnails widgetnailsbottom"></div></div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));

		register_sidebar(array(
			'id' => 'singlesidebar',
			'name' => __( 'Blog Posts Sidebar', 'toddlers' ),
			'description' => __( 'Posts sidebar.', 'toddlers' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s postpagewidget orange"><div class="widgetnails"></div>',
			'after_widget' => '<div class="widgetnails widgetnailsbottom"></div></div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));

		register_sidebar(array(
			'id' => 'contactsidebar',
			'name' => __( 'Contact Page Sidebar', 'toddlers' ),
			'description' => __( 'The first (primary) sidebar.', 'toddlers' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s contactpagewidget orange"><div class="widgetnails"></div>',
			'after_widget' => '<div class="widgetnails widgetnailsbottom"></div></div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));

		register_sidebar(array(
			'id' => 'shopsidebar',
			'name' => __( 'Shop Sidebar', 'toddlers' ),
			'description' => __( 'WooCommerce Pages Sidebar.', 'toddlers' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s shoppagewidget orange"><div class="widgetnails"></div>',
			'after_widget' => '<div class="widgetnails widgetnailsbottom"></div></div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));

		register_sidebar(array(
			'id' => 'eventssidebar',
			'name' => __( 'Events Sidebar', 'toddlers' ),
			'description' => __( 'Event Pages Sidebar.', 'toddlers' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s eventwidget orange"><div class="widgetnails"></div>',
			'after_widget' => '<div class="widgetnails widgetnailsbottom"></div></div>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));

	}
}

/*-----------------------------------------------------------------------------------*/
// Dynamic CSS - Adds Dynamic CSS to header
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'add_toddlers_dynamic_css' ) ) {
	function add_toddlers_dynamic_css() {
		require_once ( UNF_FRAMEWORK_DIRECTORY . 'dynamic-css.php');
	}
	add_action('wp_head', 'add_toddlers_dynamic_css');
}

/*-----------------------------------------------------------------------------------*/
// ACF - For Homepage Slider & CTA Fields
/*-----------------------------------------------------------------------------------*/

if (!defined('ACF_LITE')) define('ACF_LITE', true);
include_once( UNF_FRAMEWORK_DIRECTORY . 'acf/advanced-custom-fields/acf.php' );
include_once( UNF_FRAMEWORK_DIRECTORY . 'acf/acf-repeater/acf-repeater.php' );

// UNF-Slider
include_once(UNF_FRAMEWORK_DIRECTORY .'unf/slider/slider-fields.php' );
// Teacher List Fields
include_once(UNF_FRAMEWORK_DIRECTORY .'unf/staff-fields.php' );


/*-----------------------------------------------------------------------------------*/
// Bootstrap navwalker
/*-----------------------------------------------------------------------------------*/
include_once( 'library/navwalker.php' );
require_once( 'library/mobilenavwalker.php' );

/*-----------------------------------------------------------------------------------*/
// SVG Uploads
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'unf_mime_types' ) ) {
	function unf_mime_types( $mimes ){
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
	add_filter( 'upload_mimes', 'unf_mime_types' );
}

/*-----------------------------------------------------------------------------------*/
// Turn off comments on pages by default
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'default_comments_off' ) ) {
	function default_comments_off( $data ) {
	    if( $data['post_type'] == 'page' && $data['post_status'] == 'auto-draft' ) {
	        $data['comment_status'] = 0;
	    }
	    return $data;
	}
	// Turn Comments off for Pages by default
	add_filter( 'wp_insert_post_data', 'default_comments_off' );
}

/*-----------------------------------------------------------------------------------*/
// Run Shortcodes inside Text Widgets
/*-----------------------------------------------------------------------------------*/
add_filter( 'widget_text', 'do_shortcode' );

/*-----------------------------------------------------------------------------------*/
// Turn Comments off for Attachments
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'filter_media_comment_status' ) ) {
	function filter_media_comment_status( $open, $post_id ) {
		$post = get_post( $post_id );
		if( $post->post_type == 'attachment' ) {
			return false;
		}
		return $open;
	}
	add_filter( 'comments_open', 'filter_media_comment_status', 10 , 2 );
}

/*-----------------------------------------------------------------------------------*/
// International Language Support
/*-----------------------------------------------------------------------------------*/
add_action('after_setup_theme', 'theme_setup');
function theme_setup(){
    load_theme_textdomain('toddlers', UNF_FRAMEWORK_DIRECTORY . '/languages');
}

/*-----------------------------------------------------------------------------------*/
// Comment Layout
/*-----------------------------------------------------------------------------------*/
require_once ( UNF_FRAMEWORK_DIRECTORY . 'bones-comments-layout.php');

/*-----------------------------------------------------------------------------------*/
// Remove Topic Alt tag from TagCloud Widget
/*-----------------------------------------------------------------------------------*/

add_filter('widget_tag_cloud_args','set_tag_cloud_args');
function set_tag_cloud_args($args) {
$args['topic_count_text_callback'] = 'custom_tag_text_callback';
return $args; }

function custom_tag_text_callback( $count ) {
 return '';
}

/*-----------------------------------------------------------------------------------*/
/* Content Editor Styles
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'toddlers_add_editor_styles' ) ) {
	function toddlers_add_editor_styles() {
	    add_editor_style( 'editor-style.css' );
	}
	add_action( 'after_setup_theme', 'toddlers_add_editor_styles' );
}

/*-----------------------------------------------------------------------------------*/
// WooCommerce
/*-----------------------------------------------------------------------------------*/
/************* Theme Support ***************/
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
/************* Minicart Counter ***************/
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
function woocommerce_header_add_to_cart_fragment( $fragments ) {
  global $woocommerce;
  ob_start();
  ?>
  <span class="badge pull-right cart-count"><?php echo (int)$woocommerce->cart->cart_contents_count; ?></span>
  <?php
  $fragments['span.cart-count'] = ob_get_clean();
  return $fragments;
}
/************* Change number or products per row ***************/
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 4; // 4 products per row
	}
}

/*-----------------------------------------------------------------------------------*/
// Force Removal of BS Shortcodes Bootstrap Files
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'unf_remove_bs_scripts' ) ) {
	function unf_remove_bs_scripts() {
	    wp_dequeue_style( 'bs_shortcodes' );
	    wp_deregister_style( 'bs_shortcodes' );

	    wp_dequeue_style( 'bs_bootstrap' );
	    wp_deregister_style( 'bs_bootstrap' );

	    wp_dequeue_script( 'bs_shortcodes' );
	    wp_deregister_script( 'bs_shortcodes' );

	    wp_dequeue_script( 'bs_bootstrap' );
	    wp_deregister_script( 'bs_bootstrap' );

	}
	add_action( 'wp_enqueue_scripts', 'unf_remove_bs_scripts', 20 );
}


/*-----------------------------------------------------------------------------------*/
// THUMBNAIL SIZE OPTIONS
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'unf_register_image_sizes' ) ) {
	add_action( 'init', 'unf_register_image_sizes' );
	function unf_register_image_sizes() {
		add_image_size( 'post-featured', 630, 9999 );
		add_image_size( 'post-featured-compact', 240, 240, true );
		add_image_size( 'homeslide', 1108, 386, true );
		add_image_size( 'homemobileslide', 368, 368, true );
		add_image_size( 'shopbannerslide', 720, 300, true );
	}
}

/*-----------------------------------------------------------------------------------*/
// TGM Plugin Activation
/*-----------------------------------------------------------------------------------*/
require_once ( UNF_FRAMEWORK_DIRECTORY . 'class-tgm-plugin-activation.php');
/************* PLUGINS LIST ***************/
require_once ( UNF_FRAMEWORK_DIRECTORY . 'required-plugins.php');
add_action( 'tgmpa_register', 'toddlers_required_plugins' );

/*-----------------------------------------------------------------------------------*/
// Widgets
/*-----------------------------------------------------------------------------------*/
include_once (UNF_FRAMEWORK_DIRECTORY .'unf/opentimeswidget.php');
include_once (UNF_FRAMEWORK_DIRECTORY .'unf/contactwidget.php');
include_once (UNF_FRAMEWORK_DIRECTORY .'unf/recentposts.php');

/*-----------------------------------------------------------------------------------*/
// oEmbed & Excerpts - sets width of auto embeds
/*-----------------------------------------------------------------------------------*/

if (!isset($content_width)){
	$content_width = 630;
}

/*-----------------------------------------------------------------------------------*/
// Catch First Image - used in image post format
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'catch_that_image' ) ) {
	function catch_that_image() {
	  global $post, $posts;
	  $first_img = '';
	  ob_start();
	  ob_end_clean();
	  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	  $first_img = $matches[1][0];
	  if(empty($first_img)) {
	    $first_img = get_template_directory_uri() . '/library/img/noimage.png';
	  }
	  return $first_img;
	}
}

/*-----------------------------------------------------------------------------------*/
// format quote box
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'unf_quote_content' ) ) {
	add_filter( 'the_content', 'unf_quote_content' );
	function unf_quote_content( $content ) {
		/* Check if we're displaying a 'quote' post. */
		if ( has_post_format( 'quote' ) ) {
			/* Match any <blockquote> elements. */
			preg_match( '/<blockquote.*?>/', $content, $matches );
			/* If no <blockquote> elements were found, wrap the entire content in one. */
			if ( empty( $matches ) )
				$content = "<blockquote>{$content}</blockquote>";
		}
		return $content;
	}
}

/*-----------------------------------------------------------------------------------*/
// Fancy Gallery for Gallery Post Format
/*-----------------------------------------------------------------------------------*/

include_once (UNF_FRAMEWORK_DIRECTORY .'unf/galleryshortcode.php');


/*-----------------------------------------------------------------------------------*/
// GET FIRST VIDEO FROM POST
/*-----------------------------------------------------------------------------------*/

include_once (UNF_FRAMEWORK_DIRECTORY .'unf/getfirstvideo.php');

/*-----------------------------------------------------------------------------------*/
// POST EXCERPT SIZE
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'unf_post_excerpt' ) ) {
	function unf_post_excerpt() {
		$output = substr(get_the_excerpt(), 0,150);
		$output = apply_filters('wptexturize', $output);
		$output = apply_filters('convert_chars', $output);
		$output = $output;
	echo '<p>'.$output . '<span class="excerptdots">...</span>'.'</p>';
	}
}
if ( ! function_exists( 'unf_post_excerpt_long' ) ) {
	function unf_post_excerpt_long() {
		$output = substr(get_the_excerpt(), 0,220);
		$output = apply_filters('wptexturize', $output);
		$output = apply_filters('convert_chars', $output);
		$output = $output;
	echo '<p>'.$output . '<span class="excerptdots">...</span>'.'</p>';
	}
}

/*-----------------------------------------------------------------------------------*/
// WP TITLE
/*-----------------------------------------------------------------------------------*/

add_theme_support("title-tag");

if ( ! function_exists( '_wp_render_title_tag' ) ) :
    function toddlers_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
}
add_action( 'wp_head', 'toddlers_render_title' );
endif;

/*-----------------------------------------------------------------------------------*/
// WooCommerce Columns
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'unf_woo_shop_columns' ) ) {
	function unf_woo_shop_columns( $columns ) {
		global $unf_options;
		if (isset($unf_options['unf_woo_products_per_row'])) {
			$unf_woo_per_row = $unf_options['unf_woo_products_per_row'];
		} else {
			$unf_woo_per_row = 3;
		}
	    return $unf_woo_per_row;
	}
	add_filter( 'loop_shop_columns', 'unf_woo_shop_columns' );
}

global $unf_options;
	if (isset($unf_options['unf_woo_products_per_page'])) {
		$unf_woo_per_page = $unf_options['unf_woo_products_per_page'];
	} else {
		$unf_woo_per_page = 12;
	}

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$unf_woo_per_page.';' ), $unf_woo_per_page );


/**
 * Safe add_query_arg
 *
 * Safe add_query_arg, using esc_url
 *
 * @param $param1 string|array Either newkey or an associative_array.
 * @param $param2 string Either newvalue or oldquery or URI.
 * @param $param3 string Old query or URI.
 * @return string
 */
function smk_add_query_arg(){
	$args       = func_get_args();
	$total_args = count( $args );
	$uri        = $_SERVER['REQUEST_URI'];

	if( 3 <= $total_args ){
		$uri = add_query_arg( $args[0], $args[1], $args[2] );
	}
	elseif( 2 == $total_args ){
		$uri = add_query_arg( $args[0], $args[1] );
	}
	elseif( 1 == $total_args ){
		$uri = add_query_arg( $args[0] );
	}

	return esc_url( $uri );
}

/**
 * Safe remove_query_arg
 *
 * Safe remove_query_arg, using esc_url
 *
 * @param $key string|array Query key or keys to remove.
 * @param $query bool|string When false uses the $_SERVER value.
 * @return string
 */
function smk_remove_query_arg( $key, $query = false ){
	return esc_url( remove_query_arg($key, $query) );
}