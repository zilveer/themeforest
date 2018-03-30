<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop, $product;

if ( isset( $woocommerce_loop['style'] ) )
    $style = $woocommerce_loop['style'];
else
    $style = yiw_get_option( 'shop_products_style', 'ribbon' );

if( $product->get_price() === '' && $product->product_type!=='external' || ! $product->is_purchasable()) return;
?>

<div class="buttons">
    <?php
    $is_whislist = function_exists( 'yith_wcwl_is_wishlist' ) && yith_wcwl_is_wishlist();
    $is_quick_view_enabled = ( function_exists( 'YITH_WCQV_Frontend' ) && get_option( 'yith-wcqv-enable' ) == 'yes' );
    $overwrite_details = false ;
    if ( $is_quick_view_enabled && ! $is_whislist ) {

        $quick_view = YITH_WCQV_Frontend();

        $position = isset($quick_view->position) ? $quick_view->position : 'add-cart';

        if ( $position == 'add-cart' ) {
            $overwrite_details = true;
        }
    }
    ?>

    <?php if ( ( $style == 'traditional' ) && !$is_whislist && !$overwrite_details ) : ?>
        <a href="<?php echo get_permalink($product->id); ?>" class="details"><?php echo yiw_get_option( 'shop_button_details_label' ) ?></a>
    <?php elseif( $overwrite_details ) : ?>
        <?php   YITH_WCQV_Frontend()->yith_add_quick_view_button(); ?>
    <?php endif; ?>
    <?php

    echo apply_filters( 'woocommerce_loop_add_to_cart_link',
        sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="add-to-cart %s">%s</a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $quantity ) ? $quantity : 1 ),
            esc_attr( $product->id ),
            esc_attr( $product->get_sku() ),
            esc_attr( isset( $class ) ? $class : 'button' ),
            esc_html( $product->add_to_cart_text() )
        ),
        $product );

    ?></div>