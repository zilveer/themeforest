<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     19.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>


	<?php echo $product->get_categories( ' ', '<div class="product-category posted_in">', '</div>' ); ?>

	<?php echo $product->get_tags( ' ', '<div class="product-category tagged_as">', '</div>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>


</div>