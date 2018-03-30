<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 10/3/2015
 * Time: 9:41 AM
 */
if ( ! WC()->cart->coupons_enabled() && ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) ) {
	return;
}
?>
<h3 class="check-out-title"><?php esc_html_e('Returning customers?','g5plus-handmade') ?></h3>
