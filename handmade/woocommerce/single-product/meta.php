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

$weight = $product->get_weight();
$dimensions = $product->get_dimensions();

$availability      = $product->get_availability();
if (empty($availability['availability'])) {
    $availability['availability'] = __( 'In stock', 'woocommerce' );
    $availability['class'] = 'in-stock';
}
$availability_html = '<span class="product-stock-status ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</span>';

?>
<div class="product_meta">


    <?php do_action( 'woocommerce_product_meta_start' ); ?>
    <?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

        <span class="sku_wrapper"><label><?php esc_html_e( 'SKU:', 'g5plus-handmade' ); ?></label> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'g5plus-handmade' ); ?></span>.</span>

    <?php endif; ?>

    <span class="product-stock-status-wrapper"><label><?php esc_html_e('Availability:','g5plus-handmade') ?></label> <?php echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product ); ?></span>

    <?php if (!empty($dimensions)) : ?>
        <span><label><?php esc_html_e("Size:",'g5plus-handmade'); ?></label><span> <?php echo esc_html($product->get_dimensions());?></span></span>
    <?php endif; ?>

    <?php if (!empty($weight)) : ?>
        <span><label><?php esc_html_e("Shipping Weight:",'g5plus-handmade'); ?></label><span> <?php echo esc_html($weight) . ' ' .get_option( 'woocommerce_weight_unit' ) ?></span></span>
    <?php endif; ?>

    <?php echo  $product->get_categories( ', ', '<span class="posted_in">' . _n( '<label>Category:</label>', '<label>Categories:</label>', $cat_count, 'g5plus-handmade' ) . ' ', '.</span>' ); ?>

    <?php echo  $product->get_tags( ', ', '<span class="tagged_as">' . _n( '<label>Tag:</label>', '<label>Tags:</label>', $tag_count, 'g5plus-handmade' ) . ' ', '.</span>' ); ?>

    <?php do_action( 'woocommerce_product_meta_end' ); ?>


</div>
