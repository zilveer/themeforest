<?php
/**
 * Loop Add to Cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     20.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;
if ( ! $product->is_in_stock() ) : ?>
    <span class="onsale out-of-stock-button"><?php echo apply_filters( 'out_of_stock_add_to_cart_text', esc_html__( 'Out of stock', 'wp_nuvo' ) ); ?></span>
<?php else :
    echo apply_filters( 'woocommerce_loop_add_to_cart_link',
        sprintf( '<span class="add-to-cart-button-outer"><span class="add-to-cart-button-inner"><a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="btn add-to-cart-button %s product_type_%s"><span>%s</span></a></span></span>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( $product->id ),
            esc_attr( $product->get_sku() ),
            $product->is_purchasable() ? 'add_to_cart_button' : '',
            esc_attr( $product->product_type ),
            esc_html( $product->add_to_cart_text() )
        ),
        $product );

endif;
?>