<?php
/**
 * @package Foundry
 * @author TommusRhodus
 * @version 3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );

?>
<hr class="mb24">
<div class="product_meta">
	<ul>

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<li><strong><?php _e( 'SKU:', 'foundry' ); ?></strong> <?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'foundry' ); ?></li>

	<?php endif; ?>

	<?php echo htmlspecialchars_decode($product->get_categories( ', ', '<li><strong>' . _n( 'Category:', 'Categories:', $cat_count, 'foundry' ) . '</strong> ', '.</li>' )); ?>

	<?php echo htmlspecialchars_decode($product->get_tags( ', ', '<li><strong>' . _n( 'Tag:', 'Tags:', $tag_count, 'foundry' ) . '</strong> ', '.</li>' )); ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>
	
	</ul>
</div>