<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! WC()->cart->coupons_enabled() )
	return;

$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'woocommerce' ) );
$info_message .= ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'woocommerce' ) . '</a>';
?>

<div class="checkout_coupon_box">
		
	<?php wc_print_notice( $info_message, 'notice' ); ?>

	<div class="row">
		<div class="xlarge-9 large-11 xlarge-centered large-centered text-center columns">
			
			<form class="checkout_coupon" method="post" style="display:none">
				<div class="checkout_coupon_inner">
					<input type="text" name="coupon_code" class="input-text" placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />
					<input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>" />
					<div class="clear"></div>
				</div>
			</form>
		</div><!-- .large-8-->
	</div><!-- .row-->
	
</div><!-- .checkout_coupon_box-->