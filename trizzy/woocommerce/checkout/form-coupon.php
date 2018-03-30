<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! WC()->cart->coupons_enabled() ) {
	return;
}

$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'trizzy' ) . ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'trizzy' ) . '</a>' );
wc_print_notice( $info_message, 'notice' );
?>

<form class="checkout_coupon" method="post" style="display:none">

	<p class="form-row form-row-first apply-coupon">
		<input type="text" name="coupon_code" class="input-text" placeholder="<?php _e( 'Coupon code', 'trizzy' ); ?>" id="coupon_code" value="" />
		<input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'trizzy' ); ?>" />
	</p>

	<div class="clear"></div>
</form>