<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.10
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>
<div class="product-meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>
	
	<div class="inline-block text-left">

		<?php if ( $product->is_type( array( 'simple', 'variable' ) ) && get_option( 'woocommerce_enable_sku' ) == 'yes' && $product->get_sku() ) : ?>
			<span itemprop="productID" class="sku_wrapper"><span class="meta-heading"><?php _e( 'Product code:', 'dfd' ); ?></span> <span class="sku"><?php echo $product->get_sku(); ?></span>.</span>
		<?php endif; ?>

		<?php echo $product->get_categories( ', ', '<span class="posted_in"><span class="meta-heading">' . _n( 'Category:', 'Categories:', sizeof( get_the_terms( $post->ID, 'product_cat' ) ), 'dfd' ) . '</span> ', '.</span>' ); ?>

		<?php echo $product->get_tags( ', ', '<span class="tagged_as"><span class="meta-heading">' . _n( 'Tag:', 'Tags:', sizeof( get_the_terms( $post->ID, 'product_tag' ) ), 'dfd' ) . '</span> ', '.</span>' ); ?>

	</div>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>