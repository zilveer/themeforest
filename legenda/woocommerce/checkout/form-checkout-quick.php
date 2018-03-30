<?php
/**
 * Quick Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

wc_print_notices();
?>
<div class="quick-checkout">
<div class="row-fluid">
	<div class="span6">
	<?php
		do_action( 'woocommerce_before_checkout_form', $checkout );
	?>
	</div>
</div>
<?php


// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', ETHEME_DOMAIN ) );
	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>

<form name="checkout" method="post" class="checkout" action="<?php echo esc_url( $get_checkout_url ); ?>">

<div class="row-fluid">
	<div class="span6">
		<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

			<div id="customer_details">

				<div>

					<?php do_action( 'woocommerce_checkout_billing' ); ?>

				</div>
				<div class="clear"></div>
				<hr>
				<div>

					<?php do_action( 'woocommerce_checkout_shipping' ); ?>

				</div>

			</div>

			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>


		<?php endif; ?>	
	</div>
	<div class="span6 order-review">
		<h3 id="order_review_heading"><?php _e( 'Your order', ETHEME_DOMAIN ); ?></h3>
		
		<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

		<div id="order_review" class="woocommerce-checkout-review-order">
			<?php do_action( 'woocommerce_checkout_order_review' ); ?>
		</div>

		<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
	</div>
</div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

</div>