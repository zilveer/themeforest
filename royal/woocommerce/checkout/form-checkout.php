<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

wc_print_notices();

?>
<div class="before-checkout-form">
	<?php
		do_action( 'woocommerce_before_checkout_form', $checkout );
	?>
</div>
<?php

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>






<form name="checkout" method="post" class="checkout" action="<?php echo esc_url( $get_checkout_url ); ?>">
	
	<div class="row">
		<div class="col-lg-7 col-md-7">
			<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>
		
				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
		
				<div class="col2-set" id="customer_details">
		
					<div class="col-1">
		
						<?php do_action( 'woocommerce_checkout_billing' ); ?>
		
					</div>
		
					<div class="col-2">
		
						<?php do_action( 'woocommerce_checkout_shipping' ); ?>
		
					</div>
		
				</div>
		
				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
		
			<?php endif; ?>
		</div>
		
		<div class="col-lg-5 col-md-5">
			<div class="order-review">
				<h3 class="step-title"><span><?php _e( 'Your order', 'woocommerce' ); ?></span></h3>
				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

				<div id="order_review" class="woocommerce-checkout-review-order">
					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
				</div>

				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
			</div>
		</div>
	</div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>