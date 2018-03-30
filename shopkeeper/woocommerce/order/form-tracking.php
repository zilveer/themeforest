<?php
/**
 * Order tracking form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post;
?>

<style>
	
	.woocommerce .woocommerce-error,
	.woocommerce-page .woocommerce-error
	{
		width: 703px;
		margin: 10px auto 20px !important;
		max-width: 100%;
	}
	
</style>

<div class="row">
	<div class="large-10 large-centered columns">
		<div class="track-order-container">
			
			<p class="track-order-description"><?php _e( 'To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.', 'woocommerce' ); ?></p>
		
			<form action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" method="post" class="track_order_form custom_border">
			 
				<p class="input_box"><label for="orderid"><?php _e( 'Order ID', 'woocommerce' ); ?></label> <input class="input-text" type="text" name="orderid" id="orderid" placeholder="<?php _e( 'Found in your order confirmation email.', 'woocommerce' ); ?>" /></p>
				<p class="input_box last"><label for="order_email"><?php _e( 'Billing Email', 'woocommerce' ); ?></label> <input class="input-text" type="text" name="order_email" id="order_email" placeholder="<?php _e( 'Email you used during checkout.', 'woocommerce' ); ?>" /></p>
				<div class="clear"></div>
			
				<p class="form-row"><input type="submit" class="button" name="track" value="<?php _e( 'Track', 'woocommerce' ); ?>" /></p>
				<?php wp_nonce_field( 'woocommerce-order_tracking' ); ?>
			
			</form>
			
			
		</div><!-- .track-order-container-->
	</div><!-- .large-->
</div><!-- .row-->
