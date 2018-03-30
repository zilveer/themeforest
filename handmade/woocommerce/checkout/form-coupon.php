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

$info_message = apply_filters( 'woocommerce_checkout_coupon_message', esc_html__( 'Have a coupon?', 'g5plus-handmade' ) . ' <a href="#" class="showcoupon">' . esc_html__( 'Click here to enter your code', 'g5plus-handmade' ) . '</a>' );
//wc_print_notice( $info_message, 'notice' );
?>
<div class="woocommerce-checkout-info">
	<?php echo wp_kses_post($info_message); ?>
</div>

<form class="checkout_coupon" method="post" style="display:none">

	<p class="form-row form-row-first">
		<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'g5plus-handmade' ); ?>" id="coupon_code" value="" />
	</p>

	<p class="form-row form-row-last">
		<input type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'g5plus-handmade' ); ?>" />
	</p>

	<div class="clear"></div>
</form>
