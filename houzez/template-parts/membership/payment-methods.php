<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 09/09/16
 * Time: 12:56 PM
 */
global $current_user;

$current_user = wp_get_current_user();
$userID = $current_user->ID;

$selected_package_id = isset( $_GET['selected_package'] ) ? $_GET['selected_package'] : '';
$pack_price = get_post_meta( $selected_package_id, 'fave_package_price', true );
$pack_title = get_the_title( $selected_package_id );
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

if( $pack_price > 0 ) {
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
    <div class="method-option">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="paypal_package_recurring" id="paypal_package_recurring" value="1">
                <?php esc_html_e( 'Set as recurring payment', 'houzez' ); ?>
            </label>
        </div>
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
                <?php houzez_stripe_payment_membership( $selected_package_id, $pack_price, $pack_title ); ?>
            </div>
        </div>
        <div class="method-type"><img src="<?php echo get_template_directory_uri(); ?>/images/stripe-icon.jpg" alt="stripe"></div>
    </div>
    <div class="method-option">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="stripe_package_recurring" id="stripe_package_recurring" value="1">
                <?php esc_html_e( 'Set as recurring payment', 'houzez' ); ?>
            </label>
        </div>
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
<?php } ?>

<input type="hidden" name="houzez_package_id" value="<?php echo esc_attr($selected_package_id); ?>">
<input type="hidden" name="houzez_package_price" value="<?php echo esc_attr($pack_price); ?>">
<?php if( $pack_price > 0 ) { ?>
    <button id="houzez_complete_membership" type="submit" class="btn btn-success btn-submit"> <?php esc_html_e( 'Complete Membership', 'houzez' ); ?> </button>
    <span class="help-block"><?php echo sprintf( wp_kses(__( 'By clicking "Complete Membership" you agree to our <a href="%s">Terms & Conditions</a>', 'houzez' ), $allowed_html_array), get_permalink($terms_conditions) ); ?></span>
<?php } else {
    if( is_user_logged_in() ) {
        if (houzez_user_had_free_package($userID)) { ?>

            <button id="houzez_complete_membership" type="submit"
                    class="btn btn-success btn-submit"> <?php esc_html_e('Complete Membership', 'houzez'); ?> </button>
            <span
                class="help-block"><?php echo sprintf(wp_kses(__('By clicking "Complete Membership" you agree to our <a href="%s">Terms & Conditions</a>', 'houzez'), $allowed_html_array), get_permalink($terms_conditions)); ?></span>

        <?php } else { ?>
            <span
                class="help-block free-membership-used"><?php esc_html_e('You have already used your free package, please choose different package.', 'houzez'); ?></span>
            <?php
        }
    } else { ?>
        <button id="houzez_complete_membership" type="submit"
                class="btn btn-success btn-submit"> <?php esc_html_e('Complete Membership', 'houzez'); ?> </button>
        <span
            class="help-block"><?php echo sprintf(wp_kses(__('By clicking "Complete Membership" you agree to our <a href="%s">Terms & Conditions</a>', 'houzez'), $allowed_html_array), get_permalink($terms_conditions)); ?></span>
<?php
    }
 } ?>