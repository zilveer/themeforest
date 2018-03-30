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

if ( ! WC()->cart->coupons_enabled() )
	return;

$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', LANGUAGE_ZONE ) . ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', LANGUAGE_ZONE ) . '</a>' );
wc_print_notice( $info_message, 'notice' );
?>

<form class="checkout_coupon" method="post" style="display:none">

	<p class="form-row form-row-first">
		<input type="text" name="coupon_code" class="input-text" placeholder="<?php _e( 'Coupon code', LANGUAGE_ZONE ); ?>" id="coupon_code" value="" />
	</p>

	<p class="form-row form-row-last">
		<input type="submit" class="button btn btn-default small" name="apply_coupon" value="<?php _e( 'Apply Coupon', LANGUAGE_ZONE ); ?>" />
	</p>

	<div class="clear"></div>
</form>