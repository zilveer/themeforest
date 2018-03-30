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

		<div class="grve-h4 grve-align-center"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'woocommerce' ); ?></div>

		<div class="grve-h4 grve-align-center"><?php
			if ( is_user_logged_in() )
				esc_html_e( 'Please attempt your purchase again or go to your account page.', 'woocommerce' );
			else
				esc_html_e( 'Please attempt your purchase again.', 'woocommerce' );
		?></div>

		<p class="grve-align-center">
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ) ?></a>
			<?php if ( is_user_logged_in() ) : ?>
			<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My Account', 'woocommerce' ); ?></a>
			<?php endif; ?>
		</p>

	<?php else : ?>

		<div class="grve-h2 grve-align-center"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); ?></div>

		<ul class="order_details">
			<li class="order">
				<span class="grve-link-text grve-heading-color"><?php esc_html_e( 'Order Number:', 'woocommerce' ); ?></span>
				<strong><?php echo wp_kses_post( $order->get_order_number() ); ?></strong>
			</li>
			<li class="date">
				<span class="grve-link-text grve-heading-color"><?php esc_html_e( 'Date:', 'woocommerce' ); ?></span>
				<strong><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></strong>
			</li>
			<li class="total">
				<span class="grve-link-text grve-heading-color"><?php esc_html_e( 'Total:', 'woocommerce' ); ?></span>
				<strong class="grve-text-primary-1"><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></strong>
			</li>
			<?php if ( $order->payment_method_title ) : ?>
			<li class="method">
				<span class="grve-link-text grve-heading-color"><?php esc_html_e( 'Payment Method:', 'woocommerce' ); ?></span>
				<strong><?php echo wp_kses_post( $order->payment_method_title ); ?></strong>
			</li>
			<?php endif; ?>
		</ul>
		<div class="clear"></div>

	<?php endif; ?>

	<div class="grve-thankyou-content">
		<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
		<?php do_action( 'woocommerce_thankyou', $order->id ); ?>
	</div>

<?php else : ?>

	<div class="grve-h2 grve-align-center"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></div>

<?php endif;
	
//Omit closing PHP tag to avoid accidental whitespace output errors.
