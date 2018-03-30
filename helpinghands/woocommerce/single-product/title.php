<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post;
global $product;
?>
<h2 itemprop="name" class="product_title entry-title sd-single-product-title"><?php the_title(); ?></h2>
<?php
	//$size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
	//echo $product->get_categories( ', ', '<span class="sd-posted-in">' . _n( '', '', $size, 'woocommerce' ) . ' ', '</span>' );
?>
