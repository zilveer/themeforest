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
<?php if ( ! is_user_logged_in() && $checkout->enable_signup ) : ?>
    <div class="panel panel-default" style="display: none;">
        <div class="panel-heading" role="tab" id="heading-create-account">
            <a data-toggle="collapse" data-parent="#accordion" href="#create-account" aria-expanded="false" aria-controls="create-account">
                <?php esc_html_e("Create an Account",'zorka'); ?>
            </a>
        </div>
        <div id="create-account" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-create-account">
            <div class="panel-body">
                <?php if ( $checkout->enable_guest_checkout ) : ?>

                    <p class="form-row form-row-wide create-account">
                        <input class="input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true) ?> type="checkbox" name="createaccount" value="1" /> <label for="createaccount" class="checkbox"><?php esc_html_e('Create an account?', 'woocommerce' ); ?></label>
                    </p>

                <?php endif; ?>

                <?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

                <?php if ( ! empty( $checkout->checkout_fields['account'] ) ) : ?>

                    <div class="create-account">

                        <p><?php esc_html_e('Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'woocommerce' ); ?></p>

                        <?php foreach ( $checkout->checkout_fields['account'] as $key => $field ) : ?>

                            <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

                        <?php endforeach; ?>

                        <div class="clear"></div>

                    </div>

                <?php endif; ?>

                <?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
                <a  data-toggle="collapse" data-parent="#accordion" href="#billing-address" aria-expanded="false" class="button"><?php esc_html_e("Continue",'zorka'); ?></a>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php
$class_in = '';
$expanded = 'false';
if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
    $class_in = 'in';
    $expanded = 'true';
}
?>

<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading-billing-address">
        <a data-toggle="collapse" data-parent="#accordion" href="#billing-address" aria-expanded="<?php echo esc_attr($expanded); ?>" aria-controls="billing-address">
            <?php if ( WC()->cart->ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>
                <?php esc_html_e('Billing &amp; Shipping', 'woocommerce' ); ?>
            <?php else : ?>
                <?php esc_html_e('Billing Details', 'woocommerce' ); ?>
            <?php endif; ?>
        </a>
    </div>
    <div id="billing-address" class="panel-collapse collapse <?php echo esc_attr($class_in) ?>" role="tabpanel" aria-labelledby="heading-billing-address">
        <div class="panel-body">
            <?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

            <?php foreach ( $checkout->checkout_fields['billing'] as $key => $field ) : ?>

                <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

            <?php endforeach; ?>

            <?php do_action('woocommerce_after_checkout_billing_form', $checkout ); ?>
            <a  data-toggle="collapse" data-parent="#accordion" href="#shipping-address" aria-expanded="false"   class="button"><?php esc_html_e("Continue",'zorka'); ?></a>
        </div>
    </div>
</div>
