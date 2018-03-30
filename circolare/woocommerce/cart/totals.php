<?php
/**
 * Cart totals
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$available_methods = $woocommerce->shipping->get_available_shipping_methods();
?>
<div class="cart_totals <?php if ( $woocommerce->customer->has_calculated_shipping() ) echo 'calculated_shipping'; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<?php if ( ! $woocommerce->shipping->enabled || $available_methods || ! $woocommerce->customer->get_shipping_country() || ! $woocommerce->customer->has_calculated_shipping() ) : ?>

		<table class="subtotals-table" cellspacing="0" cellpadding="0">
			<tbody>

				<tr class="cart-subtotal">
					<td colspan="4" class="product-price">&nbsp;</td>
					<td class="product-quantity"><span class="summary"><?php _e( 'Cart Subtotal', 'woocommerce' ); ?></span></td>
					<td class="product-subtotal"><span class="summary"><?php echo $woocommerce->cart->get_cart_subtotal(); ?></span></td>
				</tr>

				<?php if ( $woocommerce->cart->get_discounts_before_tax() ) : ?>

					<tr class="discount">
						<td colspan="4" class="product-price">&nbsp;</td>
						<td class="product-quantity"><span class="summary"><?php _e( 'Cart Discount', 'woocommerce' ); ?></span> <a href="<?php echo add_query_arg( 'remove_discounts', '1', $woocommerce->cart->get_cart_url() ) ?>"><?php _e( '[Remove]', 'woocommerce' ); ?></a></td>
						<td class="product-subtotal"><span class="summary">-<?php echo $woocommerce->cart->get_discounts_before_tax(); ?></span></td>
					</tr>

				<?php endif; ?>

				<?php if ( $woocommerce->cart->needs_shipping() && $woocommerce->cart->show_shipping() && ( $available_methods || get_option( 'woocommerce_enable_shipping_calc' ) == 'yes' ) ) : ?>

					<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

					<tr class="shipping">
						<td colspan="4" class="product-price">&nbsp;</td>
						<td class="product-quantity"><span class="summary"><?php _e( 'Shipping', 'woocommerce' ); ?></span></td>
						<td class="product-subtotal"><?php woocommerce_get_template( 'cart/shipping-methods.php', array( 'available_methods' => $available_methods ) ); ?></td>
					</tr>

					<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

				<?php endif ?>

				<?php foreach ( $woocommerce->cart->get_fees() as $fee ) : ?>

					<tr class="fee fee-<?php echo $fee->id ?>">
						<td colspan="4" class="product-price">&nbsp;</td>
						<td class="product-quantity"><span class="summary"><?php echo $fee->name ?></span></td>
						<td class="product-subtotal"><span class="summary"><?php
							if ( $woocommerce->cart->tax_display_cart == 'excl' )
								echo woocommerce_price( $fee->amount );
							else
								echo woocommerce_price( $fee->amount + $fee->tax );
						?></span></td>
					</tr>

				<?php endforeach; ?>

				<?php
					// Show the tax row if showing prices exclusive of tax only
					if ( $woocommerce->cart->tax_display_cart == 'excl' ) {
						foreach ( $woocommerce->cart->get_tax_totals() as $code => $tax ) {
							echo '<tr class="tax-rate tax-rate-' . $code . '">
								<td colspan="4" class="product-price">&nbsp;</td>
								<td class="product-quantity"><span class="summary">' . $tax->label . '</span></td>
								<td class="product-subtotal"><span class="summary">' . $tax->formatted_amount . '</span></td>
							</tr>';
						}
					}
				?>

				<?php if ( $woocommerce->cart->get_discounts_after_tax() ) : ?>

					<tr class="discount">
						<td colspan="4" class="product-price">&nbsp;</td>
						<td class="product-quantity"><span class="summary"><?php _e( 'Order Discount', 'woocommerce' ); ?></span> <a href="<?php echo add_query_arg( 'remove_discounts', '2', $woocommerce->cart->get_cart_url() ) ?>"><?php _e( '[Remove]', 'woocommerce' ); ?></a></td>
						<td class="product-subtotal"><span class="summary">-<?php echo $woocommerce->cart->get_discounts_after_tax(); ?></span></td>
					</tr>

				<?php endif; ?>

				<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

				<tr class="total">
					<td colspan="4" class="product-price">&nbsp;</td>
					<td class="product-quantity"><span class="summary"><?php _e( 'Order Total', 'woocommerce' ); ?></span></td>
					<td class="product-subtotal"><span class="summary"><?php echo $woocommerce->cart->get_total(); ?></span>
						<?php
							// If prices are tax inclusive, show taxes here
							if (  $woocommerce->cart->tax_display_cart == 'incl' ) {
								$tax_string_array = array();

								foreach ( $woocommerce->cart->get_tax_totals() as $code => $tax ) {
									$tax_string_array[] = sprintf( '%s %s', $tax->formatted_amount, $tax->label );
								}

								if ( ! empty( $tax_string_array ) ) {
									echo '<small class="includes_tax">' . sprintf( __( '(Includes %s)', 'woocommerce' ), implode( ', ', $tax_string_array ) ) . '</small>';
								}
							}
						?>
					</td>
				</tr>

				<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

			</tbody>
		</table>

		<?php if ( $woocommerce->cart->get_cart_tax() ) : ?>

			<p><small><?php

				$estimated_text = ( $woocommerce->customer->is_customer_outside_base() && ! $woocommerce->customer->has_calculated_shipping() ) ? sprintf( ' ' . __( ' (taxes estimated for %s)', 'woocommerce' ), $woocommerce->countries->estimated_for_prefix() . __( $woocommerce->countries->countries[ $woocommerce->countries->get_base_country() ], 'woocommerce' ) ) : '';

				printf( __( 'Note: Shipping and taxes are estimated%s and will be updated during checkout based on your billing and shipping information.', 'woocommerce' ), $estimated_text );

			?></small></p>

		<?php endif; ?>

	<?php elseif( $woocommerce->cart->needs_shipping() ) : ?>

		<?php if ( ! $woocommerce->customer->get_shipping_state() || ! $woocommerce->customer->get_shipping_postcode() ) : ?>

			<div class="woocommerce-info">

				<p><?php _e( 'No shipping methods were found; please recalculate your shipping and enter your state/county and zip/postcode to ensure there are no other available methods for your location.', 'woocommerce' ); ?></p>

			</div>

		<?php else : ?>

			<?php

				$customer_location = $woocommerce->countries->countries[ $woocommerce->customer->get_shipping_country() ];

				echo apply_filters( 'woocommerce_cart_no_shipping_available_html',
					'<div class="woocommerce-error alert-error"><p>' .
					sprintf( __( 'Sorry, it seems that there are no available shipping methods for your location (%s).', 'woocommerce' ) . ' ' . __( 'If you require assistance or wish to make alternate arrangements please contact us.', 'woocommerce' ), $customer_location ) .
					'</p></div>'
				);

			?>

		<?php endif; ?>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>