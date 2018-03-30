<?php
/**
 * Order tracking form
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

?>

<form action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" method="post" class="track_order">

	<p><?php _e( 'To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.', 'woocommerce' ); ?></p>

	
	<div class="field-row">
		<label for="orderid"><?php _e('Order ID','qns' ); ?></label>
		<input class="text_input" type="text" name="orderid" id="orderid" placeholder="<?php _e('Found in your order confirmation email.','qns' ); ?>" />
	</div>
	
	<div class="field-row">
		<label for="order_email"><?php _e('Billing Email','qns' ); ?></label>
		<input class="text_input" type="text" name="order_email" id="order_email" placeholder="<?php _e('Email you used during checkout.','qns' ); ?>" />
	</div>
	
	<p class="form-row"><input type="submit" class="button2" name="track" value="<?php _e('Track"','qns' ); ?>" /></p>
	
	<?php wp_nonce_field( 'woocommerce-order_tracking' ); ?>

</form>
