<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php

global $woocommerce;

$my_account = get_permalink( wc_get_page_id( 'myaccount' ) );
$shop_page = get_permalink( wc_get_page_id( 'shop' ) );

if ( $order ) : ?>

<div class="checkout-confirmation">

	<?php if ( in_array( $order->status, array( 'failed' ) ) || $order->has_status( 'failed' ) ) : ?>

		<p><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'swiftframework' ); ?></p>

		<p><?php
			if ( is_user_logged_in() )
				_e( 'Please attempt your purchase again or go to your account page.', 'swiftframework' );
			else
				_e( 'Please attempt your purchase again.', 'swiftframework' );
		?></p>

		<p>
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'swiftframework' ) ?></a>
			<?php if ( is_user_logged_in() ) : ?>
			<a href="<?php echo esc_url( $my_account ); ?>" class="button pay"><?php _e( 'My Account', 'swiftframework' ); ?></a>
			<?php endif; ?>
		</p>

	<?php else : ?>
		
		<p class="thank-you"><?php _e( 'Thank you. Your order has been received.', 'swiftframework' ); ?></p>

		<ul class="order_details">
			<li class="order">
				<?php _e( 'Order:', 'swiftframework' ); ?>
				<?php echo esc_attr($order->get_order_number()); ?>
			</li>
			<li class="date">
				<?php _e( 'Date:', 'swiftframework' ); ?>
				<?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?>
			</li>
			<li class="total">
				<?php _e( 'Total:', 'swiftframework' ); ?>
				<?php echo $order->get_formatted_order_total(); ?>
			</li>
			<?php if ( $order->payment_method_title ) : ?>
			<li class="method">
				<?php _e( 'Payment method:', 'swiftframework' ); ?>
				<?php echo esc_attr($order->payment_method_title); ?>
			</li>
			<?php endif; ?>
		</ul>
		<div class="clear"></div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
	<?php do_action( 'woocommerce_thankyou', $order->id ); ?>
	
	<a class="continue-shopping" href="<?php echo esc_url( $shop_page ); ?>"><?php _e('Continue shopping', 'swiftframework'); ?></a>
	
</div>

<?php else : ?>

<div class="checkout-confirmation">
	
	<?php sf_woo_help_bar(); ?>

	<p class="thank-you"><?php _e( 'Thank you. Your order has been received.', 'swiftframework' ); ?></p>

	<a class="continue-shopping accent" href="<?php echo esc_url( $shop_page ); ?>"><?php _e('Continue shopping', 'swiftframework'); ?></a>
	
</div>

<?php endif; ?>