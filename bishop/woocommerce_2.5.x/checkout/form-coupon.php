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

if ( ! wc_coupons_enabled() ) {
	return;
}
$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'yit' ) . ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'yit' ) . '</a>' );

?>

<div class="woocommerce-info coupon-form">

	<?php echo $info_message ?>

<form class="checkout_coupon" method="post" style="display:none">

	<p class="form-row form-row-wide">
		<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'yit' ); ?>" id="coupon_code" value="" />
	</p>

	<p class="form-row form-row-wide submit-button">
		<input type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'yit' ); ?>" />
	</p>

	<div class="clear"></div>
</form>


</div>