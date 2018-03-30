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

global $woocommerce;



$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'homeshop' ) );
$info_message .= ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'homeshop' ) . '</a>';

?>





	<div class="row">
                    	
		<div class="col-lg-12 col-md-12 col-sm-12">
			
			<div class="carousel-heading no-margin">
				<h4><?php _e( 'Coupon code', 'homeshop' ); ?></h4>
			</div>

			
			<div class="page-content">

			<?php //wc_print_notice( $info_message, 'notice' ); ?>
			
			<form class="checkout_coupon" method="post" style="display:block !important">

			
			<table class="coupon-table">
				<tbody><tr>
					<td><input type="text" name="coupon_code" id="coupon_code" placeholder="<?php _e( 'Enter your coupon code', 'homeshop' ); ?>" value="" ></td>
					<td class="fit-cell"><input type="submit" name="apply_coupon" style="padding: 5px 15px;" class="big green" value="<?php _e( 'Save', 'homeshop' ); ?>"></td>
				</tr>
			</tbody></table>

				<div class="clear"></div>
			</form>

			</div>
			
		</div>
                          
	</div>


