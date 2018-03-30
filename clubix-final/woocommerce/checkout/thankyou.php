<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( $order ) : ?>

	<?php if ( $order->has_status( 'failed' ) ) : ?>

		<div class="alert alert-danger-empty"><div class="icon-alert"></div><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', LANGUAGE_ZONE ); ?></div>

		<div class="alert alert-warning-empty"><div class="icon-alert"></div><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php
			if ( is_user_logged_in() )
				_e( 'Please attempt your purchase again or go to your account page.', LANGUAGE_ZONE );
			else
				_e( 'Please attempt your purchase again.', LANGUAGE_ZONE );
		?></div>

		<p>
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', LANGUAGE_ZONE ) ?></a>
			<?php if ( is_user_logged_in() ) : ?>
			<a href="<?php echo esc_url( get_permalink( wc_get_page_permalink( 'myaccount' ) ) ); ?>" class="button pay"><?php _e( 'My Account', LANGUAGE_ZONE ); ?></a>
			<?php endif; ?>
		</p>

	<?php else : ?>

		<div class="alert alert-success-empty"><div class="icon-alert"></div><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', LANGUAGE_ZONE ), $order ); ?></div>

		<table class="shop_table order_details">
            <tfoot>
			<tr>
				<th scope="row"><?php _e( 'Order Number:', LANGUAGE_ZONE ); ?></th>
				<td><?php echo $order->get_order_number(); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php _e( 'Date:', LANGUAGE_ZONE ); ?></th>
				<td><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></td>
            </tr>
            <tr>
                <th scope="row"><?php _e( 'Total:', LANGUAGE_ZONE ); ?></th>
				<td><?php echo $order->get_formatted_order_total(); ?></td>
            </tr>
			<?php if ( $order->payment_method_title ) : ?>
            <tr>
                <th scope="row"><?php _e( 'Payment Method:', LANGUAGE_ZONE ); ?></th>
				<td><?php echo $order->payment_method_title; ?></td>
            </tr>
			<?php endif; ?>
            </tfoot>
		</table>
		<div class="clear"></div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
	<?php do_action( 'woocommerce_thankyou', $order->id ); ?>

<?php else : ?>

    <div class="alert alert-success-empty"><div class="icon-alert"></div><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', LANGUAGE_ZONE ), null ); ?></div>

<?php endif; ?>