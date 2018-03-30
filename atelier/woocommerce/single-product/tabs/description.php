<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post;

$pb_active = sf_get_post_meta($post->ID, '_spb_js_status', true);
if ($pb_active != "true") {
$pb_active = false;
}
$product_description = sf_get_post_meta($post->ID, 'sf_product_description', true);
if ($product_description == "") {
	$product_description = $post->post_excerpt;
}
if (substr($product_description, 0, 4) === '[spb') {
	$product_description = "";
	$pb_active = true;
}
?>

<?php 
if ($pb_active) {
	echo do_shortcode(sf_add_formatting($product_description));
} else {
	the_content();
}
?>