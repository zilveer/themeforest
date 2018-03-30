<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'aurum' ) );
	return;
}

# start: modified by Arlind Nushi
$has_login_form = !(is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ));
# end: modified by Arlind Nushi

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>

<div class="row">
	<div class="col-lg-12">
		<div class="page-title">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6">
					<h1>
						<?php the_title(); ?>
						<small><?php _e('Personal information and payment', 'aurum'); ?></small>
					</h1>
				</div>

				<?php if($has_login_form): ?>
				<div class="col-sm-3 login-button-env">
					<a class="login-button" href="#">
						<?php _e('Login Here <span>Returning Customers</span>', 'aurum'); ?>
					</a>
				</div>
				<?php endif; ?>

				<?php if (WC()->cart->coupons_enabled()): ?>
				<div class="col-sm-3 pull-right-md">
					<?php get_template_part('tpls/woocommerce-coupon-form'); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<?php woocommerce_checkout_login_form(); ?>

<div class="row">
	<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">

		<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>
		<div class="col-sm-7">
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

		</div>
		<?php endif; ?>

		<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

		<div class="col-sm-5">
			<div class="bordered-block">
				<h2 id="order_review_heading"><?php _e('Your Order', 'aurum'); ?></h2>

				<div id="order_review" class="woocommerce-checkout-review-order">
					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
				</div>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

	</form>
</div>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
