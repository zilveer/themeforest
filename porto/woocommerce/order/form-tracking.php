<?php
/**
 * Order tracking form
 *
 * @version 1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" method="post" class="track_order featured-box align-left m-t-none">
            <div class="box-content">
                <p><?php _e( 'To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.', 'woocommerce' ); ?></p>

                <p class="form-row"><label for="orderid"><?php _e( 'Order ID', 'woocommerce' ); ?></label> <input class="input-text" type="text" name="orderid" id="orderid" placeholder="<?php esc_attr_e( 'Found in your order confirmation email.', 'woocommerce' ); ?>" /></p>
                <p class="form-row"><label for="order_email"><?php _e( 'Billing Email', 'woocommerce' ); ?></label> <input class="input-text" type="text" name="order_email" id="order_email" placeholder="<?php esc_attr_e( 'Email you used during checkout.', 'woocommerce' ); ?>" /></p>
                <div class="clear"></div>

                <p class="form-row clearfix"><input type="submit" class="button btn-lg pt-right" name="track" value="<?php esc_attr_e( 'Track', 'woocommerce' ); ?>" /></p>
                <?php wp_nonce_field( 'woocommerce-order_tracking' ); ?>
            </div>
        </form>
    </div>
</div>
