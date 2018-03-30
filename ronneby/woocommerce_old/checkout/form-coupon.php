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
?>
<div class="checkout-coupon-wrap">
<?php
$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'dfd' ) . ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'dfd' ) . '</a>' );
wc_print_notice( $info_message, 'notice' );
?>

	<form class="checkout_coupon" method="post" style="display:none">

		<p class="form-row form-row-first">
			<input type="text" name="coupon_code" class="input-text" placeholder="<?php _e( 'Coupon code', 'dfd' ); ?>" id="coupon_code" value="" />
		</p>

		<p class="form-row form-row-last">
			<input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'dfd' ); ?>" />
		</p>

		<div class="clear"></div>
	</form>
</div>
<div class="clear"></div>