<?php
/**
 * Cart totals
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<h5 class="cart-title"><?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?></h5>

			<p><?php wc_cart_totals_shipping_html(); ?></p>

			<h5 class="cart-content"><?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?></h5>

		<?php elseif ( WC()->cart->needs_shipping() ) : ?>

			<h5 class="cart-title"><?php _e( 'Shipping', 'woocommerce' ); ?></h5>
			<h5 class="cart-content"><?php woocommerce_shipping_calculator(); ?></h5>
			

		<?php endif; ?>
<div class="cart-total3 <?php if ( WC()->customer->has_calculated_shipping() ) echo 'calculated_shipping'; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<h3><?php _e( 'Cart', 'mukam' ); ?><span><?php _e('Totals', 'mukam'); ?></span></h3>

		<div class="cart-container">
			<h5 class="cart-title"><?php _e( 'Cart Subtotal', 'woocommerce' ); ?></h5>
			<h5 class="cart-content"><?php wc_cart_totals_subtotal_html(); ?></h5>
			<div class="clearfix"></div>
		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			
			<h5 class="cart-title"><th><?php wc_cart_totals_coupon_label( $coupon ); ?></h5>
			<h5 class="cart-content"><?php wc_cart_totals_coupon_html( $coupon ); ?></h5>
			
		<?php endforeach; ?>

		

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<h5 class="cart-title"><?php echo esc_html( $fee->name ); ?></h5>
			<h5 class="cart-content"><?php wc_cart_totals_fee_html( $fee ); ?></h5>

		<?php endforeach; ?>

		<?php if ( WC()->cart->tax_display_cart == 'excl' ) : ?>
			<?php if ( get_option( 'woocommerce_tax_total_display' ) == 'itemized' ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
					<h5 class="cart-title"><?php echo esc_html( $tax->label ); ?></h5>
					<h5 class="cart-content"><?php echo wp_kses_post( $tax->formatted_amount ); ?></h5>

				<?php endforeach; ?>
			<?php else : ?>
				<h5 class="cart-title"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></h5>
				<h5 class="cart-content"><?php echo wc_cart_totals_taxes_total_html(); ?></h5>

			<?php endif; ?>
		<?php endif; ?>



		<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

		
			<h5 class="cart-title"><?php _e( 'Order Total', 'woocommerce' ); ?></h5>
			<h5 class="cart-content"><?php wc_cart_totals_order_total_html(); ?></h5>
	

		<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

		</div>
	<?php if ( WC()->cart->get_cart_tax() ) : ?>
		<p><small><?php

			$estimated_text = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
				? sprintf( ' ' . __( ' (taxes estimated for %s)', 'woocommerce' ), WC()->countries->estimated_for_prefix() . __( WC()->countries->countries[ WC()->countries->get_base_country() ], 'woocommerce' ) )
				: '';

			printf( __( 'Note: Shipping and taxes are estimated%s and will be updated during checkout based on your billing and shipping information.', 'woocommerce' ), $estimated_text );

		?></small></p>
	<?php endif; ?>

	<div class="wc-proceed-to-checkout">

		<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>

	</div>
	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>