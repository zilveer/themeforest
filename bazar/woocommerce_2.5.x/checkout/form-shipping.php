<?php
/**
 * Checkout shipping information form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version    2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

?>
<div class="woocommerce-shipping-fields">
<?php if ( WC()->cart->needs_shipping_address() === true ) : ?>

    <?php
    if ( empty( $_POST ) ) :
        $ship_to_different_address = yit_woocommerce_default_shiptoaddress() ? 1 : 0;
        $ship_to_different_address = apply_filters('woocommerce_ship_to_different_address_checked', $ship_to_different_address);
    else :
        $ship_to_different_address = $checkout->get_value('ship_to_different_address');
    endif;
    ?>
    <div class="clear"></div>

    <h3 id="shippingaddress-title"><?php _e('Shipping Address', 'yit'); ?></h3>

    <p class="form-row" id="ship-to-different-address">
        <input id="shiptobilling-checkbox" class="input-checkbox" <?php checked($ship_to_different_address, 1); ?> type="checkbox" name="ship_to_different_address" value="1" data-woocommerce-version="<?php echo WC_VERSION ?>"/>
        <label for="shiptobilling-checkbox" class="checkbox"><?php _e('Ship to different address?', 'yit'); ?></label>
    </p>

    <div class="clear"></div>


    <div class="shipping_address">

        <?php do_action('woocommerce_before_checkout_shipping_form', $checkout); ?>

        <?php foreach ($checkout->checkout_fields['shipping'] as $key => $field) : ?>

            <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

        <?php endforeach; ?>

        <?php do_action('woocommerce_after_checkout_shipping_form', $checkout); ?>

    </div>

<?php endif; ?>

<?php do_action( 'woocommerce_review_order_before_payment' ); ?>

<?php if( !yit_get_option('shop-checkout-multistep') ): ?>
    <?php do_action('woocommerce_before_order_notes', $checkout); ?>

    <?php if ( apply_filters( 'woocommerce_enable_order_notes_field', get_option( 'woocommerce_enable_order_comments', 'yes' ) === 'yes' ) ) : ?>

        <?php if ( ! WC()->cart->needs_shipping() || WC()->cart->ship_to_billing_address_only() ) : ?>

            <h3><?php _e('Additional Information', 'yit'); ?></h3>

        <?php endif; ?>

        <?php foreach ($checkout->checkout_fields['order'] as $key => $field) : ?>

            <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

        <?php endforeach; ?>

    <?php endif; ?>

    <?php do_action('woocommerce_after_order_notes', $checkout); ?>
<?php endif ?>

</div>