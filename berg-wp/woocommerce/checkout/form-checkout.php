<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     19.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


remove_filter('woocommerce_before_shop_loop', 'woocommerce_show_messages', 10, 2);
?>

<section class="menu shop" id="cart">
	<div class="shop-notices">
	<?php
		remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);
		do_action('woocommerce_before_checkout_form', $checkout);

		// If checkout registration is disabled and not logged in, the user cannot checkout
		if (!$checkout->enable_signup && !$checkout->enable_guest_checkout && !is_user_logged_in()) {
			echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );

			return;
		}

		// filter hook for include new pages inside the payment method
		$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() );
	?>
	</div>
	<form name="checkout" method="post" class="checkout form-horizontal woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">
	<?php if (sizeof($checkout->checkout_fields) > 0): ?>
		<?php do_action('woocommerce_checkout_before_customer_details'); ?>
		<div class="col2-set row" id="customer_details">
			<div class="col-1 col-md-6"><?php do_action( 'woocommerce_checkout_billing' ); ?></div>
			<div class="col-2 col-md-6"><?php do_action( 'woocommerce_checkout_shipping' ); ?></div>
		</div>
		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
		<!-- <hr/> -->
		<h3 id="order_review_heading" class="h4"><?php _e('Your order', 'woocommerce'); ?></h3>
	<?php endif; ?>

	<?php
	// remove_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review');
	// remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment');
	// remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
	?>

	<div id="order_review" class="woocommerce-checkout-review-order row">
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	</div>
	</form>
	<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
</section>