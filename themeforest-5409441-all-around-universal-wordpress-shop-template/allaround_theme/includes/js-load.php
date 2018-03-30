<?php
/**
 * @package WordPress
 * @subpackage AllAround Theme
 * @author Shindiri Studio (http://www.shindiristudio.com) & http://www.mihajlovicnenad.com/
 */

// Load styles
function allaround_styles_init() {
    if( !is_admin() ){
		wp_enqueue_style('all-around-header-style', get_template_directory_uri() . "/css/header_style.css", false, '1.0', 'screen');
		wp_enqueue_style('all-around-columns', get_template_directory_uri() . "/css/columns.css", false, '1.0', 'screen');
		wp_enqueue_style('all-around-prettyphoto', get_template_directory_uri() . "/css/prettyPhoto.css", false, '1.0', 'screen');
		wp_enqueue_style('all-around-css', get_template_directory_uri() . "/style.css", false, '1.0', 'screen');
		wp_enqueue_style('all-around-responsive', get_template_directory_uri() . "/css/responsive.css", false, '1.0', 'screen');
		wp_enqueue_style('all-around-paralax-banner', get_template_directory_uri() . "/css/parallax_banner_style.css", false, '1.0', 'screen');
		wp_enqueue_style('all-around-widgets', get_template_directory_uri() . "/css/widgets.css", false, '1.0', 'screen');
    }
}
add_action('wp_print_styles', 'allaround_styles_init');


// Enqueue Java scripts
function allaround_scripts_init() {
	if ( !is_admin() ) {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'js-jquery-animate-colors', get_template_directory_uri() . '/js/jquery.animate-colors.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'js-prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'js-jquery-zoom', get_template_directory_uri() . '/js/jquery.zoom.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'js-initialization', get_template_directory_uri() . '/js/initialization.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'jquery-ui-core');
		wp_enqueue_script( 'jquery-ui-widget');
		wp_enqueue_script( 'js-jquery-ui-rcarousel', get_template_directory_uri() . '/js/jquery.ui.rcarousel.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'js-jquery-jcarousel', get_template_directory_uri() . '/js/jquery.jcarousel.min.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'js-common', get_template_directory_uri() . '/js/common.js', array( 'jquery' ), '1.0', true );	
		wp_localize_script( 'js-common', 'AllAround', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'color' => get_transient( 'custom_color' ), 'lightercolor' => get_transient( 'custom_color_lighter' ) ) );
	}

	global $allaround_postmeta;
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && ( is_product() or is_product_category() or is_product_tag() ) ) $allaround_postmeta['slider'] = 0;
	if ( $allaround_postmeta['slider'] == 1) {
		if ( $allaround_postmeta['allaround_slider_type'] == 'Revolution' ) {   
		 
		}
		elseif ( $allaround_postmeta['allaround_slider_type'] == 'iCarousel' ) {
			wp_enqueue_script( 'js-jplayer', get_template_directory_uri() . '/js/jplayer.min.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_script( 'js-easing-1-3', get_template_directory_uri() . '/js/jquerry.easing.1.3.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_script( 'js-modernizr', get_template_directory_uri() . '/js/modernizr.custom.53451.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_script( 'js-orbit-ini', get_template_directory_uri() . '/js/orbit.ini.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_script( 'js-orbit', get_template_directory_uri() . '/js/orbit.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_script( 'js-swipe', get_template_directory_uri() . '/js/swipe.min.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_style('all-around-orbit', get_template_directory_uri() . '/css/orbit.css', false, '1.0', 'screen');
		}
		elseif ( $allaround_postmeta['allaround_slider_type'] == '3DSlider' ) {
			wp_enqueue_script( 'js-jquery-gallery', get_template_directory_uri() . '/js/jquery.gallery.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_script( 'js-gallery', get_template_directory_uri() . '/js/gallery.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_script( 'js-easing-1-3', get_template_directory_uri() . '/js/jquerry.easing.1.3.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_script( 'js-modernizr', get_template_directory_uri() . '/js/modernizr.custom.53451.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_style( 'all-around-3dgalstyle', get_template_directory_uri() . '/css/3d_gal_style.css', false, '1.0', 'screen');
		}
	}
	
}
add_action( 'wp_enqueue_scripts', 'allaround_scripts_init' );

function allaround_get_post_meta() {
	if ( is_404() or ( is_admin() && !is_edit_page() ) ) return;
	global $allaround_postmeta;
	$post_id = get_the_ID();
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		if ( is_shop() && !is_product_category() && !is_product_tag() ) $post_id = get_option('woocommerce_shop_page_id');
	}
	$check_data = get_post_meta($post_id, OPTIONS.'_default_meta', true);
	if ( $check_data == '' OR $check_data == 'none' ) {
		$allaround_postmeta = get_option(OPTIONS.'_default_meta');
	} else {
		$allaround_postmeta = $check_data;
	}
}

add_action( 'get_header', 'allaround_get_post_meta' );
?>