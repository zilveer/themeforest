<?php
/**
 * Checkout billing information form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/** @global WC_Checkout $checkout */
?>
<div class="woocommerce-billing-fields">
<?php if (  WC()->cart->ship_to_billing_address_only() &&  WC()->cart->needs_shipping() ) : ?>

    <h3><?php _e('Billing &amp; Shipping', 'yit'); ?></h3>

<?php else : ?>

    <h3><?php _e( apply_filters( 'woocommerce_checkout_billing_address_title', 'Billing Address') , 'yit'); ?></h3>

<?php endif; ?>

<?php do_action('woocommerce_before_checkout_billing_form', $checkout); ?>

<?php foreach ($checkout->checkout_fields['billing'] as $key => $field) : ?>

    <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

<?php endforeach; ?>

<?php do_action('woocommerce_after_checkout_billing_form', $checkout); ?>

<?php if( !yit_get_option('shop-checkout-multistep') ): ?>
    <?php if (!is_user_logged_in() && $checkout->enable_signup)  : ?>

        <?php if ($checkout->enable_guest_checkout) : ?>

            <p class="form-row">
                <input class="input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true) ?> type="checkbox" name="createaccount" value="1" /> <label for="createaccount" class="checkbox"><?php _e('Create an account?', 'yit'); ?></label>
            </p>

        <?php endif; ?>

        <?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

        <?php if ( ! empty( $checkout->checkout_fields['account'] ) ) : ?>

            <div class="create-account">

                <p><?php _e( 'Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'yit' ); ?></p>

                <?php foreach ( $checkout->checkout_fields['account'] as $key => $field ) : ?>

                    <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

                <?php endforeach; ?>

                <div class="clear"></div>

            </div>

        <?php endif; ?>

        <?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>

    <?php endif; ?>
<?php else: ?>
    <?php if ( ( WC()->cart->needs_shipping() || get_option('woocommerce_require_shipping_address') == 'yes' ) && ! WC()->cart->ship_to_billing_address_only() ) : ?>

        <?php
        if ( empty( $_POST ) ) :

            $shiptobilling = yit_woocommerce_default_shiptobilling() ? 1 : 0;
            $shiptobilling = apply_filters('woocommerce_shiptobilling_default', $shiptobilling);

        else :

            $shiptobilling = $checkout->get_value('ship_to_billing');

        endif;
        ?>

        <p class="form-row" id="shiptobilling_bill">
            <input id="shiptobilling_bill-checkbox" class="input-checkbox" <?php checked($shiptobilling, 1); ?> type="checkbox" name="ship_to_billing" value="1" />
            <label for="shiptobilling_bill-checkbox" class="checkbox"><?php _e('Ship to billing address?', 'yit'); ?></label>
        </p>
    <?php endif ?>
<?php endif; ?>

</div>