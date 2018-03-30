<?php
/**
 * Checkout shipping information form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $venedor_woo_version;

?>
<div class="woocommerce-shipping-fields">
    <?php if ( true === WC()->cart->needs_shipping_address() ) : ?>

	    <?php
			if ( empty( $_POST ) ) {

				$ship_to_different_address = get_option( 'woocommerce_ship_to_destination' ) === 'shipping' ? 1 : 0;
				$ship_to_different_address = apply_filters( 'woocommerce_ship_to_different_address_checked', $ship_to_different_address );

			} else {

				$ship_to_different_address = $checkout->get_value( 'ship_to_different_address' );

			}
	    ?>
        
        <h3 class="checkbox" id="ship-to-different-address">
            <label>
                <input id="ship-to-different-address-checkbox" class="input-checkbox" <?php checked( $ship_to_different_address, 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" /> <?php _e( 'Ship to a different address?', 'woocommerce' ); ?>
            </label>
        </h3>

	    <div class="shipping_address">

		    <?php do_action('woocommerce_before_checkout_shipping_form', $checkout); ?>

		    <?php foreach ($checkout->checkout_fields['shipping'] as $key => $field) : ?>

			    <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

		    <?php endforeach; ?>

		    <?php do_action('woocommerce_after_checkout_shipping_form', $checkout); ?>

	    </div>

    <?php endif; ?>

    <?php do_action('woocommerce_before_order_notes', $checkout); ?>

	<?php if ( apply_filters( 'woocommerce_enable_order_notes_field', get_option( 'woocommerce_enable_order_comments', 'yes' ) === 'yes' ) ) : ?>

		<?php if ( ! WC()->cart->needs_shipping() || (version_compare($venedor_woo_version, '2.5', '<') ? WC()->cart->ship_to_billing_address_only() : wc_ship_to_billing_address_only()) ) : ?>

		    <h3><?php _e( 'Additional Information', 'woocommerce' ); ?></h3>

	    <?php endif; ?>

	    <?php foreach ($checkout->checkout_fields['order'] as $key => $field) : 
            
            if (isset($field['type']) && $field['type'] == 'textarea') $field['class'][] = 'textarea-field';
            else $field['class'][] = ' input-field';
        ?>

		    <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

	    <?php endforeach; ?>

    <?php endif; ?>

    <?php do_action('woocommerce_after_order_notes', $checkout); ?>
</div>