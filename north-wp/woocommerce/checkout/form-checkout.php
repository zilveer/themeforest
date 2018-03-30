<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

//wc_print_notices();
//
//do_action( 'woocommerce_before_checkout_form', $checkout );
//
// If checkout registration is disabled and not logged in, the user cannot checkout
//if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
//	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'north' ) );
//	return;
//}

?>
<section class="my_woocommerce_page page-padding">
	<ul id="shippingsteps" class="row full-width-row no-padding">
		<li class="first active small-12 large-4 columns"><span>1</span><a href="#" data-target="billing_shipping"><?php _e('Billing &amp; Shipping', 'north'); ?></a></li>
		<li class="small-12 large-4 columns"><span>2</span><a href="#" data-target="order_review"><?php _e('Your Order &amp; Payment', 'north'); ?></a></li>
		<li class="small-12 large-4 columns"><span>3</span><a href="#"><?php _e('Confirmation', 'north'); ?></a></li>
	</ul>
	<div class="row notification-row max_width">
		<div class="small-12 columns">
			<?php 
				wc_print_notices(); 
				 do_action( 'woocommerce_before_checkout_form', $checkout );
			?>
		</div>
	</div>
	<?php
	// If checkout registration is disabled and not logged in, the user cannot checkout
	if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
		echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'north' ) );
		return;
	}
	
	// filter hook for include new pages inside the payment method
	$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>

	<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
		<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>
		
			<section class="section" id="billing_shipping" <?php if (is_user_logged_in()) { echo 'style="display:block;"'; } ?>>
				<?php do_action( 'woocommerce_checkout_before_customer_details'); ?>
				<div class="row max_width">
	    	<div class="small-12 large-6 columns billing">
						<?php do_action('woocommerce_checkout_billing'); ?>
						<a href="#" class="button continue_shipping"><?php esc_html_e('Continue', 'north'); ?></a>
				</div>
				<div class="small-12 large-6 columns shipping">
						<?php do_action('woocommerce_checkout_shipping'); ?>
						<a href="#" class="button continue_shipping"><?php esc_html_e('Continue', 'north'); ?></a>
				</div>
				<?php do_action( 'woocommerce_checkout_after_customer_details'); ?>
				</div>
			</section>
		<?php endif; ?>
		<section class="section woocommerce-checkout-review-order" id="order_review">
			<div class="row max_width">
				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
				<?php do_action( 'woocommerce_checkout_order_review' ); ?>
				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
			</div>
		</section>
	</form>

	<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
</section>