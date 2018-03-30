<?php
/**
 * Lost password confirmation text.
 *
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();
wc_print_notice( __( 'Password reset email has been sent.', 'woocommerce' ) );
?>
<div class="featured-box align-left">
    <div class="box-content">
        <p><?php echo apply_filters( 'woocommerce_lost_password_message', __( 'A password reset email has been sent to the email address on file for your account, but may take several minutes to show up in your inbox. Please wait at least 10 minutes before attempting another reset.', 'woocommerce' ) ); ?></p>
    </div>
</div>
