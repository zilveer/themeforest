<?php

/* Set global options variable */
global $r_option, $woocommerce;

/* Get theme data */
$theme_data = wp_get_theme('eprom');
$version = $theme_data->Version;
$name = $theme_data->Name;

/* Set theme constants */
define('THEME_NAME', $name);
define('SHORT_NAME', 'eprom');
define('THEME_VERSION', $version);
define('RPANEL_VERSION', '3.4.0');
define('FRAMEWORK', 'R-Frame 2.0.0');
define('COPYRIGHT', 'Copyright &copy; 2010-2014 Rascals Themes. Powered by R-Panel.');

/* Set path constants */
define('THEME', get_template_directory());
define('ADMIN', get_template_directory() . '/framework/admin');
define('THEME_SCRIPTS', get_template_directory() . '/framework/scripts');

/* Set URI path constants */
define('THEME_URI', get_template_directory_uri());
define('ADMIN_URI', get_template_directory_uri() . '/framework/admin');
define('THEME_SCRIPTS_URI', get_template_directory_uri() . '/framework/scripts');


/* Translate
------------------------------------------------------------------------*/
 
/* Make theme available for translation
   Translations can be filed in the /languages/ directory */
load_theme_textdomain( SHORT_NAME, get_template_directory() . '/languages' );

/* QTranslate */
if ( function_exists( 'qtrans_getLanguage' ) ) 
	define( 'QTRANS', true );
else
	define( 'QTRANS', false );


/* Set global options
------------------------------------------------------------------------*/

/* Theme options */
$r_option = get_option( SHORT_NAME . '_general_settings' );

/* Show activation message */
define( 'SHOW_ACTIVATION', true );

/* Set debug */
define( 'THEME_DEBUG', false );


/* Set theme skin
 ------------------------------------------------------------------------*/
if ( ! isset( $r_option['skin'] ) || $r_option['skin'] == '' ) 
	$r_option['skin'] = 'dark.css';
define( 'SKIN_CSS_URI', THEME_URI . '/styles/' . $r_option['skin'] );
define( 'SKIN_IMG_URI', THEME_URI . '/styles/img_' . substr($r_option['skin'], 0, -4) );


/* WooCommerce
------------------------------------------------------------------------*/

if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
}

if ( is_woocommerce_activated() ) {

	/* Add theme support */
	add_theme_support( 'woocommerce' );

	/* If theme lightbox is enabled, disable the WooCommerce lightbox and make product images theme lightbox galleries */
   	update_option( 'woocommerce_enable_lightbox', false );

	/* Disable default WooCommerce style */
	if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );
	} else {
		define( 'WOOCOMMERCE_USE_CSS', false );
	}

	/* Ajax Fragments */
	add_filter( 'add_to_cart_fragments', 'r_header_fragments' );

	function r_header_fragments( $fragments ) {
		global $woocommerce;
		ob_start();
		r_cart_details();
		$fragments['a.cart-parent'] = ob_get_clean();
		return $fragments;
	}

	// Handle cart in header fragment for ajax add to cart
	function r_cart_details() {
		global $woocommerce;
		?>
		<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', SHORT_NAME ); ?>" class="cart-parent">
			<span>
		<?php
		echo $woocommerce->cart->get_cart_total();
		echo '<span class="contents">' . sprintf( _n( '%d item', '%d items', $woocommerce->cart->get_cart_contents_count(), SHORT_NAME ), $woocommerce->cart->get_cart_contents_count() ) . '</span>';
		?>
		</span>
		</a>
		<?php
		}
	}


/* Register Theme Menu
------------------------------------------------------------------------*/
function r_register_menus() {
	
	register_nav_menus(
		array(
			'top_menu' => __( 'Top Menu', SHORT_NAME ),
			'main' => __( 'Main Menu', SHORT_NAME ),
			'footer_menu' => __( 'Footer Menu', SHORT_NAME )
			)
		
	);
}

add_action( 'init', 'r_register_menus' );


/* Add panel to admin bar
------------------------------------------------------------------------*/
function add_admin_bar_link() {
	global $wp_admin_bar;
	
	if ( ! is_super_admin() || ! is_admin_bar_showing() ) 
		return;

	/* Add the main siteadmin menu item */
	$wp_admin_bar->add_menu(
		array( 
			'id' => 'r_theme_settings', 
			'title' => _x( 'Theme Settings', 'Admin Panel', SHORT_NAME ), 
			'href' => get_bloginfo('wpurl') .'/wp-admin/admin.php?page=panel-main.php'
			)
		);
}

add_action( 'admin_bar_menu', 'add_admin_bar_link', 1000 );


/* Theme classes
------------------------------------------------------------------------*/
 
/* R-Menu */
get_template_part( 'framework/classes/r_menu', '' );


/* Theme functions
------------------------------------------------------------------------*/

/* Resize script */
if ( ! function_exists( 'mr_image_resize' ) ) {
	get_template_part( 'framework/functions/mr-image-resize', '' );
}

/* WP-pagenavi */
get_template_part( 'framework/functions/wp_pagenavi', '' );

/* Small helpers functions */
get_template_part( 'framework/functions/functions', '' );

/* Shortcodes */
get_template_part( 'framework/functions/shortcodes', '' );


/* Theme Scripts
------------------------------------------------------------------------*/
get_template_part( 'framework/scripts/scripts', '' );


/* Admin
------------------------------------------------------------------------*/
 
/* Classes */
if ( ! class_exists( 'R_Custom_Post' ) ) 
	get_template_part( 'framework/admin/custom_post/classes/class', 'r-custom-posts' );

/* Custom posts */

/* Artists */
if ( class_exists( 'R_Custom_Post' ) ) 
	get_template_part( 'framework/admin/options/artists', '' );

/* Releases */
if ( class_exists( 'R_Custom_Post' ) ) 
	get_template_part( 'framework/admin/options/releases', '' );

/* Events Manager */
if ( class_exists( 'R_Custom_Post' ) )
	get_template_part( 'framework/admin/options/events_manager', '' );

/* Gallery */
if ( class_exists( 'R_Custom_Post' ) )
	get_template_part( 'framework/admin/options/gallery', '' );

/* Nivo Slider */
if ( class_exists( 'R_Custom_Post' ) ) 
	get_template_part( 'framework/admin/options/slider', '' );

/* Tracks Manager */
if ( class_exists( 'R_Custom_Post' ) ) 
	get_template_part( 'framework/admin/options/tracks', '' );

if (is_admin()) {

	/* Shortcode manager */
	get_template_part( 'framework/admin/shortcodes_manager/shortcodes_manager', '' );

	/* Metaboxes */
	if ( ! class_exists( 'R_Metabox' ) ) 
		get_template_part( 'framework/admin/metabox/classes/class', 'r-metabox' );
	if ( class_exists( 'R_Metabox' ) ) 
		get_template_part( 'framework/admin/options/metaboxes', '' );
	
}

/* General Settings */
if( ! class_exists( 'R_Panel' ) )
	get_template_part( 'framework/admin/panel/classes/class', 'r-panel' );
if ( class_exists( 'R_Panel' ) )
	get_template_part( 'framework/admin/options/theme_settings', '' );


/* Widgets
------------------------------------------------------------------------*/

/* Register sidebars */
get_template_part( 'framework/widgets/sidebars', '' );

/* Rascals widgets array */
$rascals_widgets = array( 'r_comments', 'r_flickr', 'r_posts', 'r_twitter' );

/* Includes rascals widgets */
foreach ( $rascals_widgets as $widget ) {
	get_template_part( 'framework/widgets/' . $widget, '' );
	// include_once(THEME . '/framework/widgets/' . $widget . '.php');	
}


/* If theme settings doesn't exist or is empty
------------------------------------------------------------------------*/

/* Activated theme */
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' && SHOW_ACTIVATION == true ) {
	wp_redirect( admin_url() . 'admin.php?autosave&page=panel-main.php' ); 
	exit;
}

/* Settings error */
function settings_error() {
	wp_die('<h1>Error:</h1><p>Your template is not stored basic settings it is necessary to work properly. Go to the "Theme Settings", and save default settings.</p>', 'Maintenance Mode');
}
if ( ! isset( $r_option['theme_name'] ) )
	add_action('get_header', 'settings_error');


/* Maintenance mode
------------------------------------------------------------------------*/
function activate_maintenance_mode() {

	global $r_option;
	
	//If the current user is NOT an 'Administrator' or NOT 'Super Admin' then display Maintenance Page.
	if ( ! ( current_user_can( 'administrator' ) || current_user_can( 'super admin' ) ) ) {
		wp_die( $r_option['maintenance_text'], 'Maintenance Mode' );
	}
}
if ( isset( $r_option['maintenance_mode'] ) && $r_option['maintenance_mode'] == 'on' )
	add_action( 'get_header', 'activate_maintenance_mode' );

?>