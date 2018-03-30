<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

if ( ! WC()->cart->coupons_enabled() )
	return;

/*$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'wpdance' ) );
$info_message .= ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'wpdance' ) . '</a>';
wc_print_notice( $info_message, 'notice' );*/
?>

<form class="checkout_coupon" method="post">
	<p class="form-row form-row-first"><span class="question_coupon"><?php _e( 'Have a coupon', 'wpdance' ); ?></span></p>
	<p class="form-row">
		<input type="text" name="coupon_code" class="input-text"  id="coupon_code" value="" placeholder="<?php _e( 'Click here enter code', 'wpdance' ); ?>" />
	</p>

	<p class="form-row form-row-last">
		<input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'wpdance' ); ?>" />
	</p>

	<div class="clear"></div>
</form>