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

	<?php if ( $product->is_type( array( 'simple', 'variable' ) ) && get_option( 'woocommerce_enable_sku' ) == 'yes' && $product->get_sku() ) : ?>
		<p><span itemprop="productID" class="sku_wrapper"><?php _e( 'SKU:', 'woocommerce' ); ?> <span class="sku"><?php echo $product->get_sku(); ?></span></span></p>
	<?php endif; ?>

	<?php
		$size = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
		if($size > 1) {
			$cat_text = __('Categories:','woocommerce' );
		} else {
			$cat_text = __('Category:','woocommerce' );
		}
		echo $product->get_categories( ', ', '<p><span class="posted_in">' . $cat_text . '</span> ', '</p>' );
	?>

	<?php
		$size = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
		if($size > 1) {
			$tag_text = __('Tags:','woocommerce' );
		} else {
			$tag_text = __('Tag:','woocommerce' );
		}
		echo $product->get_tags( ', ', '<span class="tagged_as">' . $tag_text . '</span> ', '' );
	?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>