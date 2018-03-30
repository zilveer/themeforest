<?php
/**
 * Cart totals
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.3.6
 */

if ( !defined ( 'ABSPATH' ) ) {
    exit;
}
global $mango_settings;
$cart_version = mango_cart_version (); 
?>
<?php if ( $cart_version == "v_1" ) {
    $c = "col-md-4 pull-right";
} elseif ( $cart_version == "v_2" ) {
    $c = "";
} ?>
<div class="cart_totals <?php echo esc_attr($c); ?> <?php if ( WC ()->customer->has_calculated_shipping () ) echo 'calculated_shipping'; ?>">

    <?php do_action ( 'woocommerce_before_cart_totals' ); ?>
    <?php if ( $cart_version == "v_2" ) { ?>
        <h2 class="title-border-tb big text-center"><?php _e ( 'Subtotal', 'woocommerce' ); ?></h2>
    <?php } ?>
    <div class="<?php echo ( $cart_version == "v_1" ) ? "shop-continue-box" : "cart2-total-container" ?>">
        <div class="cart-subtotal subtotal-row">
            <?php if ( $cart_version == "v_1" ) { ?><span><?php _e ( 'Subtotal', 'woocommerce' ); ?></span> <?php } ?>
            <span
                class="<?php echo ( $cart_version == "v_2" ) ?"cart2-subtotal" : ""; ?>"><?php wc_cart_totals_subtotal_html (); ?></span>
        </div>

        <?php foreach ( WC ()->cart->get_coupons () as $code => $coupon ) : ?>
            <div class="subtotal-row cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                <span><?php wc_cart_totals_coupon_label ( $coupon ); ?></span>
                <span><?php wc_cart_totals_coupon_html ( $coupon ); ?></span>
            </div>
        <?php endforeach; ?>

        <?php foreach ( WC ()->cart->get_fees () as $fee ) : ?>
            <div class="fee subtotal-row">
                <span><?php echo esc_html ( $fee->name ); ?></span>
                <span><?php wc_cart_totals_fee_html ( $fee ); ?></span>
            </div>
        <?php endforeach; ?>

        <?php if ( WC ()->cart->tax_display_cart == 'excl' ) : ?>
            <?php if ( get_option ( 'woocommerce_tax_total_display' ) == 'itemized' ) : ?>
                <?php foreach ( WC ()->cart->get_tax_totals () as $code => $tax ) : ?>
                    <div class="subtotal-row tax-rate tax-rate-<?php echo sanitize_title ( $code ); ?>">
                        <span><?php echo esc_html ( $tax->label ); ?></span>
                        <span><?php echo wp_kses_post ( $tax->formatted_amount ); ?></span>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="tax-total subtotal-row">
                    <span><?php echo esc_html ( WC ()->countries->tax_or_vat () ); ?></span>
                    <span><?php wc_cart_totals_taxes_total_html (); ?></span>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php do_action ( 'woocommerce_cart_totals_before_order_total' ); ?>

        <div class="order-total grandtotal-row">
            <span><?php _e ( 'Grand Total', 'mango' ); ?></span>
            <span><?php wc_cart_totals_order_total_html (); ?></span>
        </div>

        <?php do_action ( 'woocommerce_cart_totals_after_order_total' ); ?>

        <?php if ( WC ()->cart->get_cart_tax () ) : ?>
            <p>
                <small><?php

                    $estimated_text = WC ()->customer->is_customer_outside_base () && !WC ()->customer->has_calculated_shipping ()
                        ? sprintf ( ' ' . __ ( ' (taxes estimated for %s)', 'woocommerce' ), WC ()->countries->estimated_for_prefix () .  WC ()->countries->countries[ WC ()->countries->get_base_country () ] ) : '';

                    printf ( __ ( 'Note: Shipping and taxes are estimated%s and will be updated during checkout based on your billing and shipping information.', 'woocommerce' ), $estimated_text );

                    ?></small>
            </p>
        <?php endif; ?>

        <div class="wc-proceed-to-checkout">

            <?php do_action ( 'woocommerce_proceed_to_checkout' ); ?>

        </div>

        <?php do_action ( 'woocommerce_after_cart_totals' ); ?>

    </div>
</div>