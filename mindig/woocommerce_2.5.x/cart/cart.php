<?php
/**
 * Cart Page
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>


    <div class="row">
        <form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post" class="clearfix cart-page">

            <div class="col-sm-8 cart-list">


                <?php do_action( 'woocommerce_before_cart_table' ); ?>

                <table class="shop_table cart" cellspacing="0">
                    <thead>
                    <tr>
                        <th class="product-remove"></th>
                        <th class="product-name"><?php _e( 'Description', 'yit' ); ?></th>
                        <th class="product-quantity"><?php _e( 'Quantity', 'yit' ); ?></th>
                        <th class="product-subtotal"><?php _e( 'Subtotal', 'yit' ); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                    <?php
                    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                        $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                ?>
                                <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                                    <!-- Remove from cart link -->
                                    <td class="product-remove">
                                        <?php
                                        echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" title="%s" class="remove"></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'yit' ) ), $cart_item_key );
                                        ?>
                                    </td>
                                    <!-- Product Name -->
                                    <td class="product-name">
                                        <!-- The thumbnail -->
                                        <div class="product-thumbnail">
                                            <?php
                                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                                            if ( ! $_product->is_visible() )
                                                echo $thumbnail;
                                            else
                                                printf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $thumbnail );
                                            ?>
                                        </div>

                                        <div class="product-name-price">
                                            <div class="product-name">
                                                <?php
                                                if ( ! $_product->is_visible() )
                                                    echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
                                                else
                                                    echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $_product->get_title() ), $cart_item, $cart_item_key );

                                                // Meta data
                                                echo WC()->cart->get_item_data( $cart_item );

                                                // Backorder notification
                                                if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                                    echo '<p class="backorder_notification">' . __( 'Available on backorder', 'yit' ) . '</p>';
                                                }
                                                ?>
                                            </div>


                                            <!-- Product price -->
                                            <div class="product-price">
                                                <?php
                                                echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                                                ?>
                                            </div>
                                        </div>
                                    </td>


                                    <!-- Quantity inputs -->
                                    <td class="product-quantity">
                                        <?php
                                        if ( $_product->is_sold_individually() ) {
                                            $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                        }
                                        else {

                                            $product_quantity = woocommerce_quantity_input( array(
                                                'input_name'  => "cart[{$cart_item_key}][qty]",
                                                'input_value' => $cart_item['quantity'],
                                                'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
                                                'min_value'   => '0'
                                            ), $_product, false );
                                        }

                                        echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
                                        ?>
                                    </td>

                                    <!-- Product subtotal -->
                                    <td class="product-subtotal">
                                        <?php
                                        echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
                                        ?>
                                    </td>

                                </tr>
                            <?php
                            }
                        }

                    do_action( 'woocommerce_cart_contents' );
                    ?>

                    <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                    </tbody>
                </table>

                <?php do_action( 'woocommerce_after_cart_table' ); ?>

                <?php if ( yit_get_option( 'shop-shipping-coupon-position' ) == 'below-list' ) : ?>

                    <div class="row after-cart">

                        <div class="col-sm-7">

                            <?php woocommerce_shipping_calculator(); ?>

                        </div>

                        <?php if ( wc_coupons_enabled() ) : ?>
                            <div class="col-sm-5">
                                <h3 class="head"><?php _e( 'Promotional code', 'yit' ); ?></h3>
                                <table class="shop_table coupon" cellspacing="0">
                                    <tr>
                                        <td>
                                            <input name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php _e( 'Enter your promotional code', 'yit' ); ?>" />
                                            <input type="submit" class="btn btn-flat" name="apply_coupon" value="<?php _e( 'Apply', 'yit' ); ?>" />

                                            <?php do_action( 'woocommerce_cart_coupon' ); ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        <?php endif ?>
                    </div>
                <?php endif; ?>

                <?php wp_nonce_field( 'woocommerce-cart' ) ?>
            </div>


            <div class="col-sm-4 cart-user-info">

                <?php if ( yit_get_option( 'shop-shipping-coupon-position' ) == 'above-summary' ) : ?>

                    <?php woocommerce_shipping_calculator(); ?>

                    <?php if ( wc_coupons_enabled() ) : ?>
                        <h3 class="head"><?php _e( 'Promotional code', 'yit' ); ?></h3>
                        <table class="shop_table coupon above-summary" cellspacing="0">
                            <tr>
                                <td>
                                    <input name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php _e( 'Enter your promotional code', 'yit' ); ?>" />
                                    <input type="submit" class="btn btn-flat" name="apply_coupon" value="<?php _e( 'Apply', 'yit' ); ?>" />

                                    <?php do_action( 'woocommerce_cart_coupon' ); ?>
                                </td>
                            </tr>
                        </table>
                    <?php endif ?>
                <?php endif; ?>

                <div class="cart-collaterals">
                    <?php do_action( 'woocommerce_cart_collaterals' ); ?>
                </div>

            </div>

        </form>
    </div>

<?php do_action( 'woocommerce_after_cart' ); ?>