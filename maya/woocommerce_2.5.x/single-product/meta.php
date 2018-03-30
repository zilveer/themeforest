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
		<span itemprop="productID" class="sku_wrapper"><?php _e( 'SKU:', 'yiw' ); ?> <span class="sku"><?php echo $product->get_sku(); ?></span>.</span>
	<?php endif; ?>
	
	<?php echo $product->get_categories( ', ', ' <span class="posted_in">'.__('Category:', 'yiw' ).' ', '.</span>'); ?>
	
	<?php echo $product->get_tags( ', ', ' <span class="tagged_as">'.__('Tags:', 'yiw' ).' ', '.</span>'); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>