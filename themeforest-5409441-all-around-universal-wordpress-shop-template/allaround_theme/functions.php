<?php
/**
 * @package WordPress
 * @subpackage AllAround Theme
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */

// Define constants
	define( 'THEME_NAME', 'AllAround' );
	define( 'ALLAROUND_PATH', get_template_directory_uri() );
	define( 'SERVER_PATH', get_template_directory() );

// TGM Plugin activation

require_once dirname( __FILE__ ) . '/lib/tgm-plugin-activation/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'allaround_register_required_plugins' );

function allaround_register_required_plugins() {

	$plugins = array(

		array(
			'name'     		=> 'Revolution Slider',
			'slug'     		=> 'revslider',
			'source'   		=> get_template_directory() . '/lib/plugins/revslider.zip',
			'required' 		=> true,
			'version' 		=> '4.6.5',
			'force_activation' 	=> false,
			'force_deactivation' 	=> false,
			'external_url' 		=> 'http://www.themepunch.com/codecanyon/revolution_wp/',
		),
		array(
			'name'     		=> 'WooCommerce',
			'slug'     		=> 'woocommerce',
			'required' 		=> false,
			'version' 		=> '2.2.10',
			'external_url' 		=> 'http://www.woothemes.com/woocommerce/'
		),
		array(
			'name'     		=> 'AllAround Content Slider',
			'slug'     		=> 'all_around',
			'source'   		=> get_template_directory() . '/lib/plugins/all_around.zip',
			'required' 		=> true,
			'version' 		=> '1.4.5',
			'force_activation' 	=> false,
			'force_deactivation' 	=> false,
			'external_url' 		=> 'http://www.shindiristudio.com/allaroundslider/',
		)

	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'allaround';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,
		'default_path' 		=> '',
		'parent_menu_slug' 	=> 'themes.php',
		'parent_url_slug' 	=> 'themes.php',
		'menu'         		=> 'install-required-plugins',
		'has_notices'      	=> true,
		'is_automatic'    	=> true,
		'message' 			=> '',
		'strings'      		=> array( )
	);

	tgmpa( $plugins, $config );

}

// Include files

	include_once('admin/index.php'); // Theme Options Framework
	include_once('includes/wp-functions.php');
	include_once('includes/js-load.php');
	include_once('includes/theme-style.php');
	include_once('includes/shortcodes.php');
	include_once('includes/post-metabox.php');
	include_once('includes/twitteroauth.php');


// WooCommerce Cart

function allaround_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	
	ob_start();

	printf('<a class="header_socials cart-style" href="%1$s" title="%2$s" style="opacity: 0.7;"><span>%3$s</span></a>', $woocommerce->cart->get_cart_url(), __('View your shopping cart', 'allaround'), $woocommerce->cart->cart_contents_count );

	$fragments['a.header_socials.cart-style'] = ob_get_clean();

	return $fragments;
}
add_filter('add_to_cart_fragments', 'allaround_woocommerce_header_add_to_cart_fragment');

?>