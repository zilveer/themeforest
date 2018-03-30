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

$info_message = apply_filters( 'woocommerce_checkout_coupon_message', esc_html__( 'Have a coupon?', 'jakiro' ) . ' <a href="#" class="showcoupon">' . esc_html__( 'Click here to enter your code', 'jakiro' ) . '</a>' );
$col = 'col-sm-5';
if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	$col = 'col-sm-12';
}
?>
<div class="<?php echo esc_attr($col)?>">
	<div class="woocommerce-info woocommerce-info-coupon"><?php echo dh_print_string( $info_message ); ?></div>
	<form class="checkout_coupon" method="post" style="display:none">

		<p class="form-row form-row-first">
			<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_html_e( 'Coupon code', 'jakiro' ); ?>" id="coupon_code" value="" />
		</p>

		<p class="form-row form-row-last">
			<input type="submit" class="button" name="apply_coupon" value="<?php esc_html_e( 'Apply Coupon', 'jakiro' ); ?>" />
		</p>

		<div class="clear"></div>
	</form>
</div>
