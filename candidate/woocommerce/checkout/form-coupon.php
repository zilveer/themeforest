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

$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'candidate' ) );
$info_message .= ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'candidate' ) . '</a>';
wc_print_notice( $info_message, 'notice' );
?>

<form class="checkout_coupon checkout-coupon-form animate-onscroll" method="post" style="display:none; padding: 20px 0 30px;">
<div>
		<input type="text" name="coupon_code" class="input-text" placeholder="<?php _e( 'Coupon code', 'candidate' ); ?>" id="coupon_code" value="" />
		<input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'candidate' ); ?>" />

</div>
</form>