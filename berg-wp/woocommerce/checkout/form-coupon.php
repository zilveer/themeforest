<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     19.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! WC()->cart->coupons_enabled() ) {
	return;
}



$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'woocommerce' ) . ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'woocommerce' ) . '</a>' );
wc_print_notice( $info_message, 'notice' );
?>


<div class="row">
	<form class="checkout_coupon" method="post" style="display:none">
		<div class="col-md-6">
			<div class="row">
				<p class="form-row form-row-first">
					<input type="text" name="coupon_code" class="input-text form-control" placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />
				</p>

				<p class="form-row form-row-last">
					<input type="submit" class="btn btn-default" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>" />
				</p>
			</div>
		</div>
		<div class="clear"></div>
		<div class="col-md-12"><hr/></div>
	</form>
</div>
