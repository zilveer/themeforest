<?php

/**

 * Single Product Meta

 *

 * @author 		WooThemes

 * @package 	WooCommerce/Templates

 * @version     1.6.4

 */



if ( ! defined( 'ABSPATH' ) ) {

	exit; // Exit if accessed directly

}



global $post, $product;



$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );

$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );



?>

<div class="product_meta mango">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<div class="sku_wrapper product-tags"><span><?php _e( 'SKU:', 'woocommerce' ); ?></span><i class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'woocommerce' ); ?></i>.</div>

	<?php endif; ?>

	<?php echo $product->get_categories( '', '<div class="product-tags">' . _n( '<span>'. __('Category','woocommerce'). ':</span>', '<span>'. __('Categories','woocommerce'). ':</span>', $cat_count, 'mango' ).' ', '</div>' ); ?>

	<?php echo $product->get_tags( '', '<div class="product-tags">'._n( '<span>'. __('Tag','woocommerce'). ':</span>', '<span>'. __('Tags','woocommerce'). ':</span>', $tag_count, 'mango' ) . ' ','</div>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>