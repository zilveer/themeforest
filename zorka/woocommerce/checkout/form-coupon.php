<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! WC()->cart->coupons_enabled() ) {
	return;
}

$info_message = apply_filters( 'woocommerce_checkout_coupon_message', esc_html__('Have a coupon?', 'woocommerce' ) . ' <a href="#" class="showcoupon">' . esc_html__('Click here to enter your code', 'woocommerce' ) . '</a>' );
?>
<form class="checkout_coupon" method="post">
    <h3><?php esc_html_e('Have a coupon?', 'woocommerce' ) ?></h3>
    <p class="form-row form-row-wide text-center">
        <input type="text" name="coupon_code" class="input-text text-center" placeholder="<?php esc_html_e('Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />
    </p>
	<p class="form-row form-row-wide text-center">
		<input type="submit" class="button" name="apply_coupon" value="<?php esc_html_e('Apply Coupon', 'woocommerce' ); ?>" />
	</p>
	<div class="clear"></div>
</form>
