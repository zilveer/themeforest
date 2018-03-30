<?php
/**
 * Setup WooCommerce specific functions
 *
 * WARNING: This file is part of the PrimaShop parent theme.
 * Please do all modifications in the form of a child theme.
 *
 * @category   PrimaShop
 * @package    WooCommerce
 * @subpackage Function
 * @author     PrimaThemes
 * @link       http://www.primathemes.com
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Declare theme support for WooCommerce.
 *
 * @since PrimaShop 1.0
 */
add_theme_support( 'woocommerce' );

/**
 * Return WooCommerce shop page url.
 *
 * @since PrimaShop 1.0
 */
function prima_get_wc_shop_url() {
	return get_permalink(woocommerce_get_page_id('shop'));
}

/**
 * Echo WooCommerce shop page url.
 *
 * @since PrimaShop 1.0
 */
function prima_wc_shop_url() {
	echo prima_get_wc_shop_url();
}

/**
 * Return WooCommerce my account page url.
 *
 * @since PrimaShop 1.0
 */
function prima_get_wc_myaccount_url() {
	return get_permalink(woocommerce_get_page_id('myaccount'));
}

/**
 * Echo WooCommerce my account page url.
 *
 * @since PrimaShop 1.0
 */
function prima_wc_myaccount_url() {
	echo prima_get_wc_myaccount_url();
}

/**
 * Return WooCommerce cart page url.
 *
 * @since PrimaShop 1.0
 */
function prima_get_wc_cart_url() {
	global $woocommerce;
	return $woocommerce->cart->get_cart_url();
}

/**
 * Echo WooCommerce cart page url.
 *
 * @since PrimaShop 1.0
 */
function prima_wc_cart_url() {
	echo prima_get_wc_cart_url();
}

/**
 * Return WooCommerce checkout page url.
 *
 * @since PrimaShop 1.0
 */
function prima_get_wc_checkout_url() {
	global $woocommerce;
	return $woocommerce->cart->get_checkout_url();
}

/**
 * Echo WooCommerce checkout page url.
 *
 * @since PrimaShop 1.0
 */
function prima_wc_checkout_url() {
	echo prima_get_wc_checkout_url();
}

/**
 * Return WooCommerce cart subtotal.
 *
 * @since PrimaShop 1.1
 */
function prima_get_wc_cart_subtotal(){
	global $woocommerce;
	return $woocommerce->cart->get_cart_subtotal();
}

/**
 * Echo WooCommerce cart subtotal.
 *
 * @since PrimaShop 1.1
 */
function prima_wc_cart_subtotal() {
	echo prima_get_wc_cart_subtotal();
}

/**
 * Return WooCommerce cart total.
 *
 * @since PrimaShop 1.0
 */
function prima_get_wc_cart_total(){
	global $woocommerce;
	return $woocommerce->cart->get_total();
}

/**
 * Echo WooCommerce cart total.
 *
 * @since PrimaShop 1.0
 */
function prima_wc_cart_total() {
	echo prima_get_wc_cart_total();
}

/**
 * Return WooCommerce cart count.
 *
 * @since PrimaShop 1.0
 */
function prima_get_wc_cart_count(){
	global $woocommerce;
	return $woocommerce->cart->cart_contents_count;
}

/**
 * Echo WooCommerce cart count.
 *
 * @since PrimaShop 1.0
 */
function prima_wc_cart_count() {
	echo prima_get_wc_cart_count();
}

/**
 * Define image sizes when activating this theme
 *
 * @since PrimaShop 1.1
 */
add_action( 'prima-theme-settings-form-before', 'prima_wc_image_dimensions_setup' );
function prima_wc_image_dimensions_setup() {
	if ( !isset($_REQUEST['theme-activated']) || $_REQUEST['theme-activated'] != 'true' )
		return;
		
	if ( get_option( PRIMA_THEME_SETTINGS.'_image_setup' ) == 'yes' )
		return;
		
	$catalog = array(
		'width'		=> '300',
		'height'	=> '300',
		'crop'		=> 1 
	);
	update_option( 'shop_catalog_image_size', $catalog ); 
 
	$single = array(
		'width'		=> '500',
		'height'	=> '500',
		'crop'		=> 0
	);
	update_option( 'shop_single_image_size', $single );
 
	$thumbnail = array(
		'width'		=> '150',
		'height'	=> '150',
		'crop'		=> 1 
	);
	update_option( 'shop_thumbnail_image_size', $thumbnail );
	
	update_option( PRIMA_THEME_SETTINGS.'_image_setup', 'yes' );
}

/**
 * Custom WooCommerce product search.
 *
 * @since PrimaShop 1.0
 */
function prima_product_search( $id = 'searchform', $post_type = 'product' ) {
?>
	<form role="search" method="get" id="<?php echo $id ?>" action="<?php echo esc_url( home_url() ); ?>">
		<div>
			<label class="screen-reader-text" for="searchinput-<?php echo $post_type ?>"><?php _e('Search for:', 'primathemes'); ?></label>
			<input type="text" value="<?php the_search_query(); ?>" name="s" class="searchinput" id="searchinput-<?php echo $post_type ?>" placeholder="<?php _e('Search for products', 'primathemes'); ?>" />
			<input type="submit" class="searchsubmit" value="<?php _e('Search', 'primathemes'); ?>" />
			<input type="hidden" name="post_type" value="<?php echo $post_type ?>" />
		</div>
	</form>
<?php
}

/**
 * Return WooCommerce product category image.
 *
 * @since PrimaShop 1.0
 */
function prima_get_productcat_image( $args = array() ) {
	$defaults = array(
		'term_id' => false,
		'link_to' => false,
		'size' => false,
		'width' => 150,
		'height' => 150,
		'crop' => true,
		'default_image' => false,
		'image_class' => false,
		'output' => 'image',
		'before' => '',
		'after' => '',
		'link_to_post' => false,
		'meta_key' => false,
		'attachment' => false,
		'the_post_thumbnail' => false,
	);
	$args = wp_parse_args( $args, $defaults );
	if ( !$args['term_id'] )
		return false;
	$args['image_id'] = get_woocommerce_term_meta( $args['term_id'], 'thumbnail_id', true );
	if ( !$args['image_id'] )
		return false;
	return prima_get_image( $args );
}

/**
 * Echo WooCommerce product category image.
 *
 * @since PrimaShop 1.0
 */
function prima_productcat_image( $args = array() ) {
	echo prima_get_productcat_image( $args );
}

/**
 * Product Attribute Query class.
 *
 * @since PrimaShop 1.0
 */
global $woocommerce;
if ( ! is_object( $woocommerce ) || version_compare( $woocommerce->version, '2.2', '<' ) ) :
if ( class_exists( 'WC_Query' ) ) :
if ( !is_admin() || defined('DOING_AJAX') ) :
class Prima_Attr_Query extends WC_Query {
	function pre_get_posts( $q ) {
	    if ( !$q->is_main_query() || !$q->is_tax ) 
			return;
		$term = get_queried_object();
		if ( !isset($term->taxonomy) ) 
			return;
		if ( strpos($term->taxonomy, 'pa_') !== 0 ) 
			return;
	    $this->product_query( $q );
	    add_action('wp', array( &$this, 'get_products_in_view' ), 2);
	    remove_filter( 'pre_get_posts', array( &$this, 'pre_get_posts') );
	}
}
$Prima_Attr_Query = new Prima_Attr_Query();
endif;
endif;
endif;

/**
 * Register top navigation cart count to "add to cart fragments".
 */
add_filter('add_to_cart_fragments', 'prima_wc_top_nav_cartcount_fragment');
function prima_wc_top_nav_cartcount_fragment( $fragments ) {
	$fragments['#topnav ul.topnav-menu li a.topnav-cart-count'] = '<a class="topnav-cart-count" href="'.prima_get_wc_cart_url().'">'.prima_wc_top_nav_cartcount_text().'</a>';
	return $fragments;
}

/**
 * Register empty minicart notification to "add to cart fragments" for consistent user experience.
 *
 * @since PrimaShop 1.2
 */
add_filter('add_to_cart_fragments', 'prima_wc_top_nav_minicartempty_fragment');
function prima_wc_top_nav_minicartempty_fragment( $fragments ) {
	if ( prima_get_wc_cart_count() == 0 )
		$fragments['.minicart .widget_shopping_cart_content, .sb-slidebar.sb-right .widget_shopping_cart_content'] = '<div class="widget_shopping_cart_content"><p>'.__( 'Your cart is empty', 'primathemes' ).'</p><p class="buttons"><a class="button" href="'.prima_get_wc_shop_url().'">'.__( 'Visit Shop', 'primathemes' ).'</a></p></div>';
	return $fragments;
}

/* Cart Text Link helper */
function prima_wc_top_nav_cartcount_text() {
	$cart_text = prima_get_setting( 'topnav_cart_text' );
	if ( !trim( $cart_text ) ) $cart_text = __('My Cart (%d)', 'primathemes');
	$cart_text = str_replace( '%d', prima_get_wc_cart_count(), $cart_text ); /* backward compatibility */ 
	$cart_text = str_replace( '[cartcount]', prima_get_wc_cart_count(), $cart_text );
	$cart_text = str_replace( '[carttotal]', prima_get_wc_cart_subtotal(), $cart_text );
	return $cart_text;
} 
