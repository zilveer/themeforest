<?php
/**
 * Checkout shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.2.0
 */
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="row">
	<?php if ( true === WC()->cart->needs_shipping_address() ) : ?>
		<?php
		if ( empty( $_POST ) ) {
			$ship_to_different_address = get_option( 'woocommerce_ship_to_destination' ) === 'shipping' ? 1 : 0;
			$ship_to_different_address = apply_filters( 'woocommerce_ship_to_different_address_checked', $ship_to_different_address );
		} else {
			$ship_to_different_address = $checkout->get_value( 'ship_to_different_address' );
		}
		?>
		<div class="col-md-12">
			<h3 id="ship-to-different-address">
				<input id="ship-to-different-address-checkbox" class="input-checkbox" <?php checked( $ship_to_different_address, 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" />
				<label for="ship-to-different-address-checkbox" class="checkbox"><?php esc_html_e( 'Ship to a different address?', 'crazyblog' ); ?></label>
			</h3>
		</div>
		<div class="shipping_address">
			<?php do_action( 'woocommerce_before_checkout_shipping_form', $checkout ); ?>
			<?php foreach ( $checkout->checkout_fields['shipping'] as $key => $field ) : ?>
				<?php
				if ( crazyblog_set( $field, 'data-check' ) == 'col12' ) {
					echo '<div class="col-md-12">';
				} else {
					echo '<div class="col-md-6">';
				}
				?>
				<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php
				if ( crazyblog_set( $field, 'data-check' ) == 'col12' ) {
					echo '</div>';
				} else {
					echo '</div>';
				}

			endforeach;
			?>
			<?php do_action( 'woocommerce_after_checkout_shipping_form', $checkout ); ?>
		</div>
	<?php endif; ?>
	<?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>
	<div class="col-md-12">
		<div class="oreder-note">
			<?php if ( apply_filters( 'woocommerce_enable_order_notes_field', get_option( 'woocommerce_enable_order_comments', 'yes' ) === 'yes' ) ) : ?>
				<?php if ( !WC()->cart->needs_shipping() || wc_ship_to_billing_address_only() ) : ?>
					<h3><?php esc_html_e( 'Additional Information', 'crazyblog' ); ?></h3>
				<?php endif; ?>
				<?php foreach ( $checkout->checkout_fields['order'] as $key => $field ) : ?>
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
	<?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>
</div>
