<?php
define('THEMEUMNAME', wp_get_theme()->get( 'Name' ));
define('THMCSS', get_template_directory_uri().'/css/');
define('THMJS', get_template_directory_uri().'/js/');


// Re-define meta box path and URL
if ( ! defined( 'RWMB_URL' ) )
	define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/lib/meta-box' ) );
if ( ! defined( 'RWMB_DIR' ) )
	define( 'RWMB_DIR', trailingslashit(  get_template_directory() . '/lib/meta-box' ) );

// Include the meta box script
require_once RWMB_DIR . 'meta-box.php';
require_once (get_template_directory().'/lib/metabox.php');


/*-------------------------------------------------------
*			Custom Widgets and VC shortocde Include
*-------------------------------------------------------*/
require_once( get_template_directory()  . '/lib/vc-addons/fontawesome-helper.php');
require_once( get_template_directory()  . '/lib/vc-addons/shortcode-helper.php');
require_once( get_template_directory()  . '/lib/vc-addons/event-counter.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-title.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-button.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-latest-post.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-feature-box.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-person.php');
require_once( get_template_directory()  . '/lib/vc-addons/pricing-table.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-action.php');
require_once( get_template_directory()  . '/lib/vc-addons/themeum-clients.php');
require_once( get_template_directory()  . '/lib/vc-addons/wc-latest-products.php');

require_once( get_template_directory()  . '/lib/widgets/popular-news.php');


/*-------------------------------------------------------
 *				Redux Framework Options Added
 *-------------------------------------------------------*/

global $themeum_options; 

if ( !class_exists( 'ReduxFramework' ) ) {
	require_once( get_template_directory() . '/admin/framework.php' );
	require_once( get_template_directory()  . '/lib/main-function/import-functions.php');
}

if ( !isset( $redux_demo ) ) {
	require_once( get_template_directory() . '/theme-options/admin-config.php' );
}

/*-------------------------------------------*
 *				Register Navigation
 *------------------------------------------*/
register_nav_menus( array(
	'primary' => esc_html__( 'Primary Menu', 'eventum' )
) );

/*-------------------------------------------*
 *				title tag
 *------------------------------------------*/
add_theme_support( 'title-tag' );
add_theme_support( 'post-formats', array( 'link', 'quote' ) );


/*-------------------------------------------*
 *				woocommerce support
 *------------------------------------------*/
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}


/*-------------------------------------------*
 *				navwalker
 *------------------------------------------*/
//Main Navigation
require_once( get_template_directory()  . '/lib/menu/admin-megamenu-walker.php');
require_once( get_template_directory()  . '/lib/menu/meagmenu-walker.php');
require_once( get_template_directory()  . '/lib/menu/mobile-navwalker.php');
//Admin mega menu
add_filter( 'wp_edit_nav_menu_walker', function( $class, $menu_id ){
	return 'Themeum_Megamenu_Walker';
}, 10, 2 );



/*-------------------------------------------*
 *				Startup Register
 *------------------------------------------*/
require_once( get_template_directory()  . '/lib/main-function/eventum-register.php');


/*-------------------------------------------------------
 *			Themeum Core
 *-------------------------------------------------------*/
require_once( get_template_directory()  . '/lib/main-function/themeum-core.php');



/*-----------------------------------------------------
 * 				Custom Excerpt Length
 *----------------------------------------------------*/

if(!function_exists('the_excerpt_max_charlength')):

	function the_excerpt_max_charlength($charlength) {
		$excerpt = get_the_excerpt();
		$charlength++;

		if ( mb_strlen( $excerpt ) > $charlength ) {
			$subex = mb_substr( $excerpt, 0, $charlength - 5 );
			$exwords = explode( ' ', $subex );
			$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
			if ( $excut < 0 ) {
				return mb_substr( $subex, 0, $excut );
			} else {
				return $subex;
			}

		} else {
			return $excerpt;
		}
	}

endif;


// Remove Redux Ads
if(!function_exists('redux_ads_custom_admin_styles')):
function redux_ads_custom_admin_styles() { ?>
	<style type="text/css">
	.rAds {
		display: none !important;
	}
	</style>
<?php }
add_action('admin_head', 'redux_ads_custom_admin_styles');
endif;
