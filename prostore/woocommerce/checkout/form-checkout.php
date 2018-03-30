<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/woocommerce/checkout/form-checkout.php
 * @sub-package WooCommerce/Templates/checkout/form-checkout.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?> 
<?php global $woocommerce; ?>

<?php $woocommerce_checkout = $woocommerce->checkout(); ?>

<?php $woocommerce->show_messages(); ?>

<?php do_action('woocommerce_before_checkout_form');

// If checkout registration is disabled and not logged in, the user cannot checkout
if (get_option('woocommerce_enable_signup_and_login_from_checkout')=="no" && get_option('woocommerce_enable_guest_checkout')=="no" && !is_user_logged_in()) :
	echo apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce'));
	return;
endif;

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', $woocommerce->cart->get_checkout_url() ); ?>

<form name="checkout" method="post" class="checkout" action="<?php echo esc_url( $get_checkout_url ); ?>">

	<?php if ( sizeof( $woocommerce_checkout->checkout_fields ) > 0 ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details'); ?>

		<div class="row container" id="customer_details">

			<div class="six columns">

				<?php do_action('woocommerce_checkout_billing'); ?>

			</div>

			<div class="six columns">

				<?php do_action('woocommerce_checkout_shipping'); ?>

		<?php do_action( 'woocommerce_checkout_after_customer_details'); ?>

		<h4 id="order_review_heading"><em class="icon-edit"></em> <?php _e('Your order', 'woocommerce'); ?></h4>

	<?php endif; ?>

	<?php do_action('woocommerce_checkout_order_review'); ?>

</form>

<?php do_action('woocommerce_after_checkout_form'); ?>