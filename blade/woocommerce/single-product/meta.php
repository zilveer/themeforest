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
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="grve-single-post-meta sku_wrapper"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span class="grve-h6 sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>

	<?php endif; ?>

	<div class="grve-single-post-meta grve-categories">
	 <?php
			echo '<ul class="grve-small-text">';
			echo wp_kses_post( $product->get_categories( '</li><li>', '<li>', '</li>' ) );
			echo '</ul>';

	?>
	</div>
	<div class="grve-single-post-meta grve-tags">
	 <?php
			echo '<ul class="grve-small-text">';
			echo wp_kses_post( $product->get_tags( '</li><li>', '<li>', '</li>' ) );
			echo '</ul>';
	?>
	</div>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
