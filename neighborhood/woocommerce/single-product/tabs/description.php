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

$options = get_option('sf_neighborhood_options');
if (isset($options['enable_pb_product_pages'])) {
	$enable_pb_product_pages = $options['enable_pb_product_pages'];
} else {
	$enable_pb_product_pages = false;
}

$product_description = sf_get_post_meta($post->ID, 'sf_product_description', true);

?>

<?php 
if ($enable_pb_product_pages) {
		echo do_shortcode(sf_add_formatting($product_description));
	} else {
		the_content();
	}
?>