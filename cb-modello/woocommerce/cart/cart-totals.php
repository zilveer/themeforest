<?php
/**
 * Cart totals
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

?>
<div class="cart_totals <?php if ( WC()->customer->has_calculated_shipping() ) echo 'calculated_shipping'; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<fieldset>
		<label class="col-xs-6"><?php _e( 'Cart Subtotal', 'woocommerce' ); ?></label>
		<span class="col-xs-6 value"><?php wc_cart_totals_subtotal_html(); ?></span>
	</fieldset>


	<?php foreach ( WC()->cart->get_coupons( 'cart' ) as $code => $coupon ) : ?>
		<fieldset>
			<label class="col-xs-6"><?php _e( 'Coupon:', 'woocommerce' ); ?> <?php echo esc_html( $code ); ?></label>
			<span class="col-xs-6 value"><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
		</fieldset>
	<?php endforeach; ?>

	<?php  if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

		<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

		<?php wc_cart_totals_shipping_html(); ?>

		<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

	<?php endif; ?>

	<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
		<fieldset>
			<label class="col-xs-6"><?php echo esc_html( $fee->name ); ?></label>
			<span class="col-xs-6 value"><?php wc_cart_totals_fee_html( $fee ); ?></span>
		</fieldset>
	<?php endforeach; ?>
	

	<?php if ( WC()->cart->tax_display_cart == 'excl' ) : ?>
		<?php if ( get_option( 'woocommerce_tax_total_display' ) == 'itemized' ) : ?>
			<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
				<fieldset>
					<label class="col-xs-6"><?php echo esc_html( $tax->label ); ?></label>
					<span class="col-xs-6 value"><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
				</fieldset>
			<?php endforeach; ?>
		<?php else : ?>
			<fieldset>
				<label class="col-xs-6"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></label>
				<span class="col-xs-6 value"><?php wc_cart_totals_taxes_total_html(); ?></span>
			</fieldset>
		<?php endif; ?>
	<?php endif; ?>

	<?php foreach ( WC()->cart->get_coupons( 'order' ) as $code => $coupon ) : ?>
		<fieldset>
			<label class="col-xs-6"><?php _e( 'Coupon:', 'woocommerce' ); ?> <?php echo esc_html( $code ); ?></label>
			<span class="col-xs-6 value"><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
		</fieldset>
	<?php endforeach; ?>
	
	

	<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

	<fieldset>
		<label class="col-xs-6"><?php _e( 'Order Total', 'woocommerce' ); ?></label>
		<span class="col-xs-6 value"><?php wc_cart_totals_order_total_html(); ?></span>
	</fieldset>

	<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>



	<?php if ( WC()->cart->get_cart_tax() ) : ?>
		<p><small><?php

				$estimated_text = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
					? sprintf( ' ' . __( ' (taxes estimated for %s)', 'woocommerce' ), WC()->countries->estimated_for_prefix() . __( WC()->countries->countries[ WC()->countries->get_base_country() ], 'woocommerce' ) )
					: '';

				printf( __( 'Note: Shipping and taxes are estimated%s and will be updated during checkout based on your billing and shipping information.', 'woocommerce' ), $estimated_text );

				?></small></p>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
