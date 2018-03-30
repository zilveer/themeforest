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

<?php if ( WC()->cart->needs_shipping() && ! WC()->cart->ship_to_billing_address_only() ) : ?>

	<?php
		if ( empty( $_POST ) ) {

			$ship_to_different_address = get_option( 'woocommerce_ship_to_billing' ) == 'no' ? 1 : 0;
			$ship_to_different_address = apply_filters( 'woocommerce_ship_to_different_address_checked', $ship_to_different_address );

		} else {

			$ship_to_different_address = $checkout->get_value( 'ship_to_different_address' );

		}
	?>

	<h3 class="step-title"><?php _e( 'Shipping Address', ETHEME_DOMAIN ); ?></h3>

	<p class="form-row" id="ship-to-different-address">
		<input id="ship-to-different-address-checkbox" class="input-checkbox" <?php checked( $ship_to_different_address, 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" />
		<label for="ship-to-different-address-checkbox" class="checkbox"><?php _e( 'Ship to a different address?', ETHEME_DOMAIN ); ?></label>
	</p>

	<div class="shipping_address">

		<?php do_action('woocommerce_before_checkout_shipping_form', $checkout); ?>

		<?php foreach ($checkout->checkout_fields['shipping'] as $key => $field) : ?>

			<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

		<?php endforeach; ?>

		<?php do_action('woocommerce_after_checkout_shipping_form', $checkout); ?>

	</div>

<?php endif; ?>

<?php do_action('woocommerce_before_order_notes', $checkout); ?>

<?php if (get_option('woocommerce_enable_order_comments')!='no') : ?>

	<?php if (WC()->cart->ship_to_billing_address_only()) : ?>

		<h3><?php _e( 'Additional Information', ETHEME_DOMAIN ); ?></h3>

	<?php endif; ?>

	<?php foreach ($checkout->checkout_fields['order'] as $key => $field) : ?>

		<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

	<?php endforeach; ?>

<?php endif; ?>

<?php do_action('woocommerce_after_order_notes', $checkout); ?>

<?php if (etheme_get_option('checkout_page') == 'stepbystep'): ?>
	<a href="#" class="button active fl-r continue-checkout" data-next="5"><?php _e('Continue', ETHEME_DOMAIN) ?></a>
<?php endif ?>