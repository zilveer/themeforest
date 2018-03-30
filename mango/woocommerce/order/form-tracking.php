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

	<p class="first-color"><?php _e( 'To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.', 'woocommerce' ); ?></p>

	<p class="form-row form-group form-row-first">
        <label class="input-desc" for="orderid"><?php _e( 'Order ID', 'woocommerce' ); ?></label>
        <input class="input-text form-control" type="text" name="orderid" id="orderid" placeholder="<?php _e( 'Found in your order confirmation email.', 'woocommerce' ); ?>" />
    </p>
	<p class="form-row form-group form-row-last">
        <label class="input-desc" for="order_email"><?php _e( 'Billing Email', 'woocommerce' ); ?></label>
        <input class="input-text form-control" type="text" name="order_email" id="order_email" placeholder="<?php _e( 'Email you used during checkout.', 'woocommerce' ); ?>" />
    </p>
	<div class="clear"></div>

	<p class="form-row form-group">
        <input type="submit" class="button btn btn-custom2 min-width" name="track" value="<?php _e( 'Track', 'woocommerce' ); ?>" />
    </p>
	<?php wp_nonce_field( 'woocommerce-order_tracking' ); ?>
</form>