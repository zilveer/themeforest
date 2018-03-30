<?php
/**
 * Checkout login form
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.0.0
 */

if ( !defined ( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
global $mango_count_checkout_tabs;

if ( is_user_logged_in () || 'no' === get_option ( 'woocommerce_enable_checkout_login_reminder' ) ) {
    return;
}

$info_message = apply_filters ( 'woocommerce_checkout_login_message', __ ( 'Returning customer?', 'woocommerce' ) );
$info_message .= __ ( 'Click here to login', 'woocommerce' ); ?>
<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading-login">
        <h2 class="panel-title">
            <a data-toggle="collapse" href="#collapse-login" aria-expanded="true" aria-controls="collapse-login">
                <?php wc_print_notice ( $info_message, 'notice' ); ?>
                <span class="panel-icon"><i class="fa fa-angle-down"></i></span>
            </a>
            <span class="step-box"><?php echo $mango_count_checkout_tabs; ?></span>
        </h2>
    </div>
    <div id="collapse-login" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-login">
        <div class="panel-body">
            <?php
            $mango_count_checkout_tabs ++;
            woocommerce_login_form (
                array (
                    'message' => __ ( 'If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.', 'woocommerce' ),
                    'redirect' => wc_get_page_permalink ( 'checkout' ),
                    'hidden' => false
                )
            );
            ?>
        </div>
    </div>
</div>