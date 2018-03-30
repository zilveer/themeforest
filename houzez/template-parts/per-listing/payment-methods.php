<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 09/09/16
 * Time: 12:57 PM
 */
$price_listing_submission = houzez_option('price_listing_submission');
$property_id = isset( $_GET['prop-id'] ) ? $_GET['prop-id'] : '';
$terms_conditions = houzez_option('payment_terms_condition');
$allowed_html_array = array(
    'a' => array(
        'href' => array(),
        'title' => array()
    )
);
$enable_paypal = houzez_option('enable_paypal');
$enable_stripe = houzez_option('enable_stripe');
$enable_wireTransfer = houzez_option('enable_wireTransfer');
?>
<div class="method-select-block">

    <?php if( $enable_paypal != 0 ) { ?>
    <div class="method-row">
        <div class="method-select">
            <div class="radio">
                <label>
                    <input type="radio" class="payment-paypal" name="houzez_payment_type" value="paypal" checked>
                    <?php esc_html_e( 'Paypal', 'houzez'); ?>
                </label>
            </div>
        </div>
        <div class="method-type"><img src="<?php echo get_template_directory_uri(); ?>/images/paypal-icon.jpg" alt="paypal"></div>
    </div>
    <?php } ?>

    <?php if( $enable_stripe != 0 ) { ?>
    <div class="method-row">
        <div class="method-select">
            <div class="radio">
                <label>
                    <input type="radio" class="payment-stripe" name="houzez_payment_type" value="stripe">
                    <?php esc_html_e( 'Stripe', 'houzez'); ?>
                </label>
                <?php houzez_stripe_payment_perlisting( $property_id, $price_listing_submission ); ?>
            </div>
        </div>
        <div class="method-type"><img src="<?php echo get_template_directory_uri(); ?>/images/stripe-icon.jpg" alt="stripe"></div>
    </div>
    <?php } ?>

    <?php if( $enable_wireTransfer != 0 ) { ?>
    <div class="method-row">
        <div class="method-select">
            <div class="radio">
                <label>
                    <input type="radio" name="houzez_payment_type" value="direct_pay">
                    <?php esc_html_e( 'Direct Bank Transfer', 'houzez' ); ?>
                </label>
            </div>
        </div>
        <div class="method-type method-description">
            <p> <?php esc_html_e( 'Make your payment direct into your bank account. Please use order ID as the payment reference', 'houzez' ); ?> </p>
        </div>
    </div>
    <?php } ?>

</div>
<input type="hidden" id="houzez_property_id" name="houzez_property_id" value="<?php echo intval( $property_id ); ?>">
<input type="hidden" id="houzez_listing_price" name="houzez_listing_price" value="<?php echo esc_attr($price_listing_submission); ?>">
<button id="houzez_complete_order" type="button" class="btn btn-success btn-submit"> <?php esc_html_e( 'Complete Payment', 'houzez' ); ?> </button>
<span class="help-block"><?php echo sprintf( wp_kses(__( 'By clicking "Complete Payment" you agree to our <a href="%s">Terms & Conditions</a>', 'houzez' ), $allowed_html_array), get_permalink($terms_conditions) ); ?></span>