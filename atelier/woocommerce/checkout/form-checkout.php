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

?>

<?php wc_print_notices(); ?>

<?php sf_woo_help_bar(); ?>

<?php do_action( 'woocommerce_before_checkout_form', $checkout ); ?>

<?php
	// If checkout registration is disabled and not logged in, the user cannot checkout
	if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
		echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'swiftframework' ) );
		return;
	}

	// filter hook for include new pages inside the payment method
	$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() );
?>

	<form name="checkout" method="post" class="checkout woocommerce-checkout row" action="<?php echo esc_url( $get_checkout_url ); ?>">

		<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

			<div class="col-sm-7" id="customer_details">

				<div>

					<?php do_action( 'woocommerce_checkout_billing' ); ?>

				</div>

				<div>

					<?php do_action( 'woocommerce_checkout_shipping' ); ?>

				</div>

			</div>

			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

		<?php endif; ?>

		<div class="col-2 col-sm-5" id="review-order">

			<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

			<div id="order_review" class="woocommerce-checkout-review-order review-order-wrap">

				<h4 id="order_review_heading"><span><?php _e( 'Your Order', 'swiftframework' ); ?></span></h4>

				<?php do_action( 'woocommerce_checkout_order_review' ); ?>

			</div>

			<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

		</div>

	</form>

	<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>