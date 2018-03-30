<?php
/**
 * Order tracking form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;
?>
<div class="page-title">
	<h1>
		<?php the_title(); ?>
		<small><?php _e('Get the order details and notes', 'aurum'); ?></small>
	</h1>
</div>

<form action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" method="post" class="track_order">

	<p><?php _e( 'To track your order please enter your Order ID in the box below and press return. This was given to you on your receipt and in the confirmation email you should have received.', 'aurum' ); ?></p>

	<p class="form-row form-row-first form-group">
		<!-- <label for="orderid"><?php _e( 'Order ID', 'aurum' ); ?></label> -->
		<input class="input-text form-control" type="text" name="orderid" id="orderid" placeholder="<?php _e( 'Order ID - Found in your order confirmation email.', 'aurum' ); ?>" />
	</p>
	<p class="form-row form-row-last form-group">
		<!-- <label for="order_email"><?php _e( 'Billing Email', 'aurum' ); ?></label> -->
		<input class="input-text form-control" type="text" name="order_email" id="order_email" placeholder="<?php _e( 'Billing Email - Email you used during checkout.', 'aurum' ); ?>" />
	</p>
	<div class="clear"></div>

	<p class="form-row form-grpup">
		<input type="submit" class="button btn btn-primary" name="track" value="<?php _e( 'Track', 'aurum' ); ?>" />
	</p>
	<?php wp_nonce_field( 'woocommerce-order_tracking' ); ?>

</form>