<?php
/**
 * Cart totals
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cart_totals_inner_class =  'cart_totals_inner col-lg-5 col-xs-12 col-md-6';
if ( get_option( 'woocommerce_enable_shipping_calc' ) === 'no' || ! WC()->cart->needs_shipping() ) {
	$cart_totals_inner_class =  'cart_totals_inner col-lg-5 col-xs-12 col-md-6';
}

?>
<div class="container">
	<div class="cart_totals row <?php if ( WC()->customer->has_calculated_shipping() ) echo 'calculated_shipping'; ?>">

		<?php do_action( 'woocommerce_before_cart_totals' ); ?>
		<div class="<?php echo esc_attr($cart_totals_inner_class); ?>">

			<h2 class="p-font"><?php esc_html_e( 'Cart Totals', 'woocommerce' ); ?></h2>

			<table cellspacing="0">

				<tr class="cart-subtotal">
					<th><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
					<td><?php wc_cart_totals_subtotal_html(); ?></td>
				</tr>

				<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
					<tr class="cart-discount coupon-<?php echo esc_attr( $code ); ?>">
						<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
						<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
					</tr>
				<?php endforeach; ?>

				<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

					<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

					<?php wc_cart_totals_shipping_html(); ?>

					<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

				<?php endif; ?>

				<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
					<tr class="fee">
						<th><?php echo esc_html( $fee->name ); ?></th>
						<td><?php wc_cart_totals_fee_html( $fee ); ?></td>
					</tr>
				<?php endforeach; ?>

				<?php if ( WC()->cart->tax_display_cart == 'excl' ) : ?>
					<?php if ( get_option( 'woocommerce_tax_total_display' ) == 'itemized' ) : ?>
						<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
							<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
								<th><?php echo esc_html( $tax->label ); ?></th>
								<td><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
							</tr>
						<?php endforeach; ?>
					<?php else : ?>
						<tr class="tax-total">
							<th><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
							<td><?php echo wc_cart_totals_taxes_total_html(); ?></td>
						</tr>
					<?php endif; ?>
				<?php endif; ?>

				<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

				<tr class="order-total">
					<th><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
					<td><?php wc_cart_totals_order_total_html(); ?></td>
				</tr>

				<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

			</table>

			<?php if ( WC()->cart->get_cart_tax() ) : ?>
				<p><small><?php

						$estimated_text = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
							? sprintf( ' ' . esc_html__( ' (taxes estimated for %s)', 'woocommerce' ), WC()->countries->estimated_for_prefix() . WC()->countries->countries[ WC()->countries->get_base_country() ] )
							: '';

						printf( esc_html__( 'Note: Shipping and taxes are estimated%s and will be updated during checkout based on your billing and shipping information.', 'woocommerce' ), $estimated_text );

						?></small></p>
			<?php endif; ?>


		</div>
		<?php do_action( 'woocommerce_after_cart_totals' ); ?>

	</div>
</div>

