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
?>
<div class="woocommerce-login-fields">

	<?php
	$info_message  = apply_filters( 'woocommerce_checkout_login_message', __( 'Returning customer?', 'woocommerce' ) );

	//if we are using Login with Ajax then we want to use the uber modal to login or register
	if( listable_using_lwa() ) {
		$login_url = listable_get_login_url();
		$classes = listable_get_login_link_class();

		$info_message = '<div class="woocommerce-info lwa">' . $info_message;
		$info_message .= ' <a href="' . $login_url . '" class="' . $classes . '">' . __( 'Click here to login', 'woocommerce' ) . '</a>';
		$info_message .= '</div>';

		echo $info_message;
	} else {
		$info_message .= ' <a href="#" class="showlogin">' . __( 'Click here to login', 'woocommerce' ) . '</a>';
		wc_print_notice( $info_message, 'notice' );

		$defaults = array(
			'message'  => __( 'If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.', 'listable' ),
			'redirect' => wc_get_page_permalink( 'checkout' ),
			'hidden'   => true
		);

		$args = wp_parse_args( $args, $defaults );

		wc_get_template( 'custom/form-login.php', $args );
	} ?>

</div>
