<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper"><?php _e( 'SKU:', 'woocommerce' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'n/a', 'woocommerce' ); ?></span>.</span>

	<?php endif; ?>

	<?php
		$size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
		echo $product->get_categories( ' ', '<div class="btn-list">' . _n( '<div class="btn  btn--small  btn--secondary">Category</div>', '<div class="btn  btn--small  btn--secondary">Categories</div>', $size, 'bucket' ) . ' ', '</div>' );
	?>

	<?php
		$size = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
		echo $product->get_tags( ' ', '<div class="btn-list">' . _n( '<div class="btn  btn--small  btn--secondary">Tag:</div>', '<div class="btn  btn--small  btn--secondary">Tags:</div>', $size, 'bucket' ) . ' ', '</div>' );
	?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>