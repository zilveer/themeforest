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

if (!isset($product)) return;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );

$weight = $product->get_weight();
$dimensions = $product->get_dimensions();

?>
<div class="product_meta">


    <?php do_action( 'woocommerce_product_meta_start' ); ?>
    <?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

        <span class="sku_wrapper"><label><?php esc_html_e('SKU:', 'woocommerce' ); ?></label> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__('N/A', 'woocommerce' ); ?></span>.</span>

    <?php endif; ?>

    <span class="product-stock-status-wrapper"><label><?php esc_html_e('Availability:','zorka') ?></label> <span class="product-stock-status" itemprop="stock"><?php echo ($product->is_in_stock()) ? esc_html__('In Stock','woocommerce') : esc_html__('Out Of Stock', 'woocommerce' ); ?></span></span>

    <?php if (!empty($dimensions)) : ?>
        <span><label><?php esc_html_e("Size:",'zorka'); ?></label><span> <?php echo esc_html($product->get_dimensions());?></span></span>
    <?php endif; ?>

    <?php if (!empty($weight)) : ?>
        <span><label><?php esc_html_e("Shipping Weight:",'zorka'); ?></label><span> <?php echo esc_html($weight) . ' ' .get_option( 'woocommerce_weight_unit' ) ?></span></span>
    <?php endif; ?>

    <?php echo  $product->get_categories( ', ', '<span class="posted_in">' . _n( '<label>Category:</label>', '<label>Categories:</label>', $cat_count, 'woocommerce' ) . ' ', '.</span>' ); ?>

    <?php echo  $product->get_tags( ', ', '<span class="tagged_as">' . _n( '<label>Tag:</label>', '<label>Tags:</label>', $tag_count, 'woocommerce' ) . ' ', '.</span>' ); ?>



    <?php do_action( 'woocommerce_product_meta_end' ); ?>


</div>
