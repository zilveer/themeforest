<?php
/**
 * Checkout Form
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.3.0
 */

if (!defined('ABSPATH')) {
    exit;
}

wc_print_notices();

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout
if (!$checkout->enable_signup && !$checkout->enable_guest_checkout && !is_user_logged_in()) {
    echo apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce'));
    return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters('woocommerce_get_checkout_url', WC()->cart->get_checkout_url()); ?>

<form name="checkout" method="post" class="checkout woocommerce-checkout"
      action="<?php echo esc_url($get_checkout_url); ?>" enctype="multipart/form-data">

    <?php if (sizeof($checkout->checkout_fields) > 0) : ?>

        <?php do_action('woocommerce_checkout_before_customer_details'); ?>


        <div class="checkout_actions">
            <div class="woo_step address">
                <h1 class="transi"><span><?php _e('1. Shipping and Billing Address', 'cb-modello'); ?></span></h1>

                <div class="woo_step_in" style="display: block;">
                    <div class="col2-set" id="customer_details">
                        <?php do_action('woocommerce_checkout_billing'); ?>
                    </div>

                    <div class="col-2">
                        <?php do_action('woocommerce_checkout_shipping'); ?>
                        <div class="step_buttons">
                            <?php /*?><a class="button submit step_back"><?php _e('Back','cb-modello');?></a>*/ ?>
                            <a class="button submit step_continue"><?php _e('Continue', 'cb-modello'); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="woo_step place_order">
                <h1 class="transi"><span><?php _e('2. Pay and Place Order', 'cb-modello'); ?></span></h1>

                <div class="woo_step_in">

                    <?php do_action('woocommerce_checkout_before_order_review'); ?>

                    <div id="order_review" class="woocommerce-checkout-review-order">
                        <?php do_action('woocommerce_checkout_order_review'); ?>
                    </div>

                    <?php do_action('woocommerce_checkout_after_order_review'); ?>
                </div>
            </div>
        </div>


        <?php do_action('woocommerce_checkout_after_customer_details'); ?>



    <?php endif; ?>


</form>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>
