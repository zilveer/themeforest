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

$info_message  = apply_filters( 'woocommerce_checkout_login_message', esc_html__( 'Returning customer?', 'g5plus-handmade' ) );
$info_message .= ' <a href="#" class="showlogin">' . esc_html__( 'Click here to login', 'g5plus-handmade' ) . '</a>';
//wc_print_notice( $info_message, 'notice' );
?>
<div class="woocommerce-checkout-info">
	<?php echo wp_kses_post($info_message); ?>
</div>
<?php
	woocommerce_login_form(
		array(
			'message'  => esc_html__( 'If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.', 'g5plus-handmade' ),
			'redirect' => wc_get_page_permalink( 'checkout' ),
			'hidden'   => true
		)
	);
?>
