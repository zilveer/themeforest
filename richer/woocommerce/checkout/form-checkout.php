<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices(); 

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>

<div class="tabset vertical">
<ul class="tabs">
	<li class="tab">
		<a href="#billing" class="selected">
			<h6><?php _e('Billing Address' , 'richer'); ?></h6>
		</a>
	</li>
	<li class="tab">
		<a href="#shipping">
			<h6><?php _e('Shipping Address' , 'richer'); ?></h6>
		</a>
	</li>
	<li class="tab">
		<a href="#payment-container">
			<h6><?php _e('Review &amp; Payment' , 'richer'); ?></h6>
		</a>
	</li>
</ul>
<form name="checkout" method="post" class="checkout woocommerce-content-box" action="<?php echo esc_url( $get_checkout_url ); ?>">

	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

			<div class="panel" id="billing">

				<?php do_action( 'woocommerce_checkout_billing' ); ?>

				<a href="#shipping" class="default button medium continue-checkout"><?php _e('Continue', 'richer'); ?></a>

			</div>

			<div class="panel" id="shipping">

				<?php do_action( 'woocommerce_checkout_shipping' ); ?>

				<a href="#payment-container" class="default button small continue-checkout"><?php _e('Continue', 'richer'); ?></a>

			</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>
<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
	<div class="panel" id="payment-container">
		<div id="order_review" class="woocommerce-checkout-review-order">
			<?php do_action( 'woocommerce_checkout_order_review' ); ?>
		</div>
	</div>
<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>