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

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
?>
<dl class="product-data">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
		<dt itemprop="productID" class="sku_wrapper"><?php _e( 'SKU:', 'woocommerce' ); ?></dt> <dd class="sku"><?php echo $product->get_sku(); ?></dd>
	<?php endif; ?>

	<?php echo $product->get_categories( ', ', _n( '<dt>Category:</dt><dd>', '<dt>Categories:</dt><dd>', $cat_count, 'woocommerce' ) . ' ', '.</dd>' ); ?>

	<?php echo $product->get_tags( ', ', _n( '<dt>Tag:</dt><dd>', '<dt>Tags:</dt><dd>', $tag_count, 'woocommerce' ) . ' ', '.</dd>' ); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</dl>