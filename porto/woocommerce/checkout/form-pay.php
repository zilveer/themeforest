<?php
/**
 * Pay for order form
 *
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$porto_woo_version = porto_get_woo_version_number();

?>
<div class="featured-box align-left">
    <div class="box-content">
        <form id="order_review" method="post">

            <table class="shop_table">
                <thead>
                    <tr>
                        <th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
                        <th class="product-quantity"><?php _e( 'Qty', 'woocommerce' ); ?></th>
                        <th class="product-total"><?php _e( 'Totals', 'woocommerce' ); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ( sizeof( $order->get_items() ) > 0 ) : ?>
                        <?php foreach ( $order->get_items() as $item_id => $item ) : ?>
                            <?php
                            if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
                                continue;
                            }
                            ?>
                            <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ); ?>">
                                <td class="product-name">
                                    <?php
                                    echo apply_filters( 'woocommerce_order_item_name', esc_html( $item['name'] ), $item, false );

                                    do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order );
                                    $order->display_item_meta( $item );
                                    do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order );
                                    ?>
                                </td>
                                <td class="product-quantity"><?php echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times; %s', esc_html( $item['qty'] ) ) . '</strong>', $item ); ?></td>
                                <td class="product-subtotal"><?php echo $order->get_formatted_line_subtotal( $item ); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <?php if ( $totals = $order->get_order_item_totals() ) : ?>
                        <?php foreach ( $totals as $total ) : ?>
                            <tr>
                                <th scope="row" colspan="2"><?php echo $total['label']; ?></th>
                                <td class="product-total"><?php echo $total['value']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tfoot>
            </table>

            <div id="payment">
                <?php if ( $order->needs_payment() ) : ?>
                <ul class="wc_payment_methods payment_methods methods">
                    <?php if ( version_compare($porto_woo_version, '2.5', '<') ) : ?>
                        <?php
                        if ( $available_gateways = WC()->payment_gateways->get_available_payment_gateways() ) {
                            // Chosen Method
                            if ( sizeof( $available_gateways ) ) {
                                current( $available_gateways )->set_current();
                            }

                            foreach ( $available_gateways as $gateway ) {
                                ?>
                                <li class="payment_method_<?php echo $gateway->id; ?>">
                                    <input id="payment_method_<?php echo $gateway->id; ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />
                                    <label for="payment_method_<?php echo $gateway->id; ?>"><?php echo $gateway->get_title(); ?> <?php echo $gateway->get_icon(); ?></label>
                                    <?php
                                    if ( $gateway->has_fields() || $gateway->get_description() ) {
                                        echo '<div class="payment_box payment_method_' . $gateway->id . '" style="display:none;">';
                                        $gateway->payment_fields();
                                        echo '</div>';
                                    }
                                    ?>
                                </li>
                            <?php
                            }
                        } else {
                            echo '<li>' . __( 'Sorry, it seems that there are no available payment methods for your location. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) . '</li>';
                        }
                        ?>
                    <?php else : ?>
                        <?php
                        if ( ! empty( $available_gateways ) ) {
                            foreach ( $available_gateways as $gateway ) {
                                wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
                            }
                        } else {
                            echo '<li>' . apply_filters( 'woocommerce_no_available_payment_methods_message', __( 'Sorry, it seems that there are no available payment methods for your location. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) ) . '</li>';
                        }
                        ?>
                    <?php endif; ?>
                </ul>
                <?php endif; ?>

                <div class="form-row">
                    <?php if ( version_compare($porto_woo_version, '2.5', '<') ) : ?>
                        <?php wp_nonce_field( 'woocommerce-pay' ); ?>
                        <?php
                        $pay_order_button_text = apply_filters( 'woocommerce_pay_order_button_text', __( 'Pay for order', 'woocommerce' ) );

                        echo apply_filters( 'woocommerce_pay_order_button_html', '<input type="submit" class="button alt" id="place_order" value="' . esc_attr( $pay_order_button_text ) . '" data-value="' . esc_attr( $pay_order_button_text ) . '" />' );
                        ?>
                        <input type="hidden" name="woocommerce_pay" value="1" />
                    <?php else : ?>
                        <input type="hidden" name="woocommerce_pay" value="1" />

                        <?php wc_get_template( 'checkout/terms.php' ); ?>

                        <?php do_action( 'woocommerce_pay_order_before_submit' ); ?>

                        <?php echo apply_filters( 'woocommerce_pay_order_button_html', '<input type="submit" class="button alt" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '" />' ); ?>

                        <?php do_action( 'woocommerce_pay_order_after_submit' ); ?>

                        <?php wp_nonce_field( 'woocommerce-pay' ); ?>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>
</div>
