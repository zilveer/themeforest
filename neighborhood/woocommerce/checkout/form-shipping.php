<?php
/**
 * Checkout shipping information form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>

<?php if ( version_compare( WOOCOMMERCE_VERSION, "2.1.0" ) >= 0 ) { ?>

	<?php if ( WC()->cart->needs_shipping_address() === true ) : ?>

		<?php
			if ( empty( $_POST ) ) {

				$ship_to_different_address = get_option( 'woocommerce_ship_to_billing' ) == 'no' ? 1 : 0;
				$ship_to_different_address = apply_filters( 'woocommerce_ship_to_different_address_checked', $ship_to_different_address );

			} else {

				$ship_to_different_address = $checkout->get_value( 'ship_to_different_address' );

			}
		?>

		<p id="ship-to-different-address">
			<input id="ship-to-different-address-checkbox" class="input-checkbox" <?php checked( $ship_to_different_address, 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" />
			<label for="ship-to-different-address-checkbox" class="checkbox"><?php _e( 'Ship to a different address?', 'swiftframework' ); ?></label>
		</p>

		<div class="shipping_address">

			<h4 class="lined-heading"><span><?php _e( 'Shipping Address', 'swiftframework' ); ?></span></h4>

			<?php do_action( 'woocommerce_before_checkout_shipping_form', $checkout ); ?>

			<?php foreach ( $checkout->checkout_fields['shipping'] as $key => $field ) : ?>

				<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

			<?php endforeach; ?>

			<?php do_action( 'woocommerce_after_checkout_shipping_form', $checkout ); ?>

		</div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

	<?php if ( apply_filters( 'woocommerce_enable_order_notes_field', get_option( 'woocommerce_enable_order_comments', 'yes' ) === 'yes' ) ) : ?>

		<?php if ( ! WC()->cart->needs_shipping() || WC()->cart->ship_to_billing_address_only() ) : ?>

			<h3><?php _e( 'Additional Information', 'swiftframework' ); ?></h3>

		<?php endif; ?>

		<?php foreach ( $checkout->checkout_fields['order'] as $key => $field ) : ?>

			<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

		<?php endforeach; ?>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>

<?php } else { ?>

	<?php if ( ( $woocommerce->cart->needs_shipping() || get_option('woocommerce_require_shipping_address') == 'yes' ) && ! $woocommerce->cart->ship_to_billing_address_only() ) : ?>

		<?php
			if ( empty( $_POST ) ) :

				$shiptobilling = (get_option('woocommerce_ship_to_same_address')=='yes') ? 1 : 0;
				$shiptobilling = apply_filters('woocommerce_shiptobilling_default', $shiptobilling);

			else :

				$shiptobilling = $checkout->get_value('shiptobilling');

			endif;
		?>

		<p class="form-row" id="shiptobilling">
			<input id="shiptobilling-checkbox" class="input-checkbox" <?php checked($shiptobilling, 1); ?> type="checkbox" name="shiptobilling" value="1" />
			<label for="shiptobilling-checkbox" class="checkbox"><?php _e( 'Ship to billing address?', 'swiftframework' ); ?></label>
		</p>

		<div class="shipping_address">

			<h4 class="lined-heading"><span><?php _e( 'Shipping Address', 'swiftframework' ); ?></span></h4>

			<?php do_action('woocommerce_before_checkout_shipping_form', $checkout); ?>

			<?php foreach ($checkout->checkout_fields['shipping'] as $key => $field) : ?>

				<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

			<?php endforeach; ?>

			<?php do_action('woocommerce_after_checkout_shipping_form', $checkout); ?>

		</div>

	<?php endif; ?>

	<?php do_action('woocommerce_before_order_notes', $checkout); ?>

	<?php if (get_option('woocommerce_enable_order_comments')!='no') : ?>

		<?php if ($woocommerce->cart->ship_to_billing_address_only()) : ?>

			<h3><?php _e( 'Additional Information', 'swiftframework' ); ?></h3>

		<?php endif; ?>

		<?php foreach ($checkout->checkout_fields['order'] as $key => $field) : ?>

			<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

		<?php endforeach; ?>

	<?php endif; ?>

	<?php do_action('woocommerce_after_order_notes', $checkout); ?>

<?php } ?>