<?php
/**
 * Checkout login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}

$info_message  = apply_filters( 'woocommerce_checkout_login_message', esc_html__( 'Returning customer?', 'jakiro' ) );
$info_message .= ' <a href="#" class="showlogin">' . esc_html__( 'Click here to login', 'jakiro' ) . '</a>';
?>
<div class="col-sm-7">
	<div class="woocommerce-info woocommerce-info-login"><?php echo dh_print_string( $info_message ); ?></div>
	<?php
		woocommerce_login_form(
			array(
				'message'  => esc_html__( 'If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.', 'jakiro' ),
				'redirect' => wc_get_page_permalink( 'checkout' ),
				'hidden'   => true
			)
		);
	?>
</div>
