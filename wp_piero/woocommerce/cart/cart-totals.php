<?php
/**
 * Cart totals
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.6
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if ( get_option( 'woocommerce_enable_shipping_calc' ) === 'no' || ! WC()->cart->needs_shipping() ) {
	return;
}
?>
<div class="cshero-woo-shipping-wrapper clearfix">
	<div class="cshero-woo-shipping cshero-woo-column3 col-xs-12 col-sm-6 col-md-3 col-lg-3">
		<h3 class="woo-cart-title"><?php _e( 'Calculate Shipping', 'woocommerce' ); ?></h3>
		<?php do_action( 'woocommerce_before_shipping_calculator' ); ?>
		<form class="cshero-woo-shipping woocommerce-shipping-calculator" action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">
			<section>
				<p class="form-row form-row-wide" id="calc_shipping_country_field">
					<select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state" rel="calc_shipping_state">
						<option value=""><?php _e( 'Select a country&hellip;', 'woocommerce' ); ?></option>
						<?php
							foreach( WC()->countries->get_shipping_countries() as $key => $value )
								echo '<option value="' . esc_attr( $key ) . '"' . selected( WC()->customer->get_shipping_country(), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
						?>
					</select>
				</p>
				<p class="form-row form-row-wide" id="calc_shipping_state_field">
					<?php
						$current_cc = WC()->customer->get_shipping_country();
						$current_r  = WC()->customer->get_shipping_state();
						$states     = WC()->countries->get_states( $current_cc );
						// Hidden Input
						if ( is_array( $states ) && empty( $states ) ) {
							?><input type="hidden" name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php _e( 'State / county', 'woocommerce' ); ?>" /><?php
						// Dropdown Input
						} elseif ( is_array( $states ) ) {
							?><span>
								<select name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php _e( 'State / county', 'woocommerce' ); ?>">
									<option value=""><?php _e( 'Select a state&hellip;', 'woocommerce' ); ?></option>
									<?php
										foreach ( $states as $ckey => $cvalue )
											echo '<option value="' . esc_attr( $ckey ) . '" ' . selected( $current_r, $ckey, false ) . '>' . __( esc_html( $cvalue ), 'woocommerce' ) .'</option>';
									?>
								</select>
							</span><?php
						// Standard Input
						} else {
							?><input type="text" class="input-text" value="<?php echo esc_attr( $current_r ); ?>" placeholder="<?php _e( 'State / county', 'woocommerce' ); ?>" name="calc_shipping_state" id="calc_shipping_state" /><?php
						}
					?>
				</p>
				<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_city', false ) ) : ?>
					<p class="form-row form-row-wide" id="calc_shipping_city_field">
						<input type="text" class="input-text" value="<?php echo esc_attr( WC()->customer->get_shipping_city() ); ?>" placeholder="<?php _e( 'City', 'woocommerce' ); ?>" name="calc_shipping_city" id="calc_shipping_city" />
					</p>
				<?php endif; ?>
				<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_postcode', true ) ) : ?>
					<p class="form-row form-row-wide" id="calc_shipping_postcode_field">
						<input type="text" class="input-text" value="<?php echo esc_attr( WC()->customer->get_shipping_postcode() ); ?>" placeholder="<?php _e( 'Postcode / Zip', 'woocommerce' ); ?>" name="calc_shipping_postcode" id="calc_shipping_postcode" />
					</p>
				<?php endif; ?>
				<p><button type="submit" name="calc_shipping" value="1" class="btn btn-primary"><?php _e( 'Update Totals', 'woocommerce' ); ?></button></p>
				<?php wp_nonce_field( 'woocommerce-cart' ); ?>
			</section>
		</form>
		<?php do_action( 'woocommerce_after_shipping_calculator' ); ?>
	</div>
	<?php if ( WC()->cart->coupons_enabled() ) { ?>
		<div class="cshero-coupon cshero-woo-column3 col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<h3 class="woo-cart-title"><?php _e( 'COUPON CODE', 'woocommerce' ); ?></h3>
			<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>" /> <input type="submit" class="btn btn-default " name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>" />
			<?php do_action( 'woocommerce_cart_coupon' ); ?>
		</div>
	<?php } ?>
	<div class="cshero-cart-totals cshero-cart-total cshero-woo-column3 col-xs-12 col-sm-6 col-md-6 col-lg-6 <?php if ( WC()->customer->has_calculated_shipping() ) echo 'calculated_shipping'; ?>">
		<?php do_action( 'woocommerce_before_cart_totals' ); ?>
		<h3 class="woo-cart-title"><?php _e( 'Cart Totals', 'woocommerce' ); ?></h3>
		<table cellspacing="0">
			<tr class="cart-subtotal">
				<th><?php _e( 'Cart Subtotal', 'woocommerce' ); ?></th>
				<td><?php wc_cart_totals_subtotal_html(); ?></td>
			</tr>
			<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
				<tr class="cart-discount coupon-<?php echo esc_attr( $code ); ?>">
					<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
					<td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
				</tr>
			<?php endforeach; ?>
			
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
				<td><?php _e( 'Order Total', 'woocommerce' ); ?></th>
				<td><?php wc_cart_totals_order_total_html(); ?></td>
			</tr>
			<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>
		</table>
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
</div>