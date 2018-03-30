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

$checkoutType = etheme_get_option('checkout_page');
//$checkoutType = 'default';

if($checkoutType == 'default') {
	require_once('form-checkout-default.php');
	return;
} else if ($checkoutType == 'quick') {
	require_once('form-checkout-quick.php');
	return;
}


// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', ETHEME_DOMAIN ) );
	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>



<ul class="checkout-steps-nav">
	<?php if (!is_user_logged_in()): ?>
		<li id="tostep1"><a href="#" class="button filled active" data-step="1"><?php _e('Checkout method', ETHEME_DOMAIN) ?></a></li>
		<?php if ( ! empty( $checkout->checkout_fields['account'] ) ) : ?>
			<li id="tostep2"><a href="#" class="button" data-step="2"><?php _e('Create an account', ETHEME_DOMAIN) ?></a></li>
		<?php endif ?>
	<?php endif ?>
	<li id="tostep3"><a href="#" class="button <?php if (is_user_logged_in()): ?>filled active<?php endif; ?>" data-step="3"><?php _e('Billing Address', ETHEME_DOMAIN) ?></a></li>
	<li id="tostep4"><a href="#" class="button" data-step="4"><?php _e('Shipping Address', ETHEME_DOMAIN) ?></a></li>
	<li id="tostep5"><a href="#" class="button" data-step="5"><?php _e('Your order', ETHEME_DOMAIN) ?></a></li>
</ul>

	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

		<div class="checkout-steps">
			<?php if (!is_user_logged_in()): ?>	
				<div class="checkout-step active" id="step1">

					<h3 class="step-title"><?php _e('Checkout Method', ETHEME_DOMAIN); ?></h3>

					<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

					<div class="row-fluid">
						<div class="span5 new-customers">
							<h5><?php _e('New Customers', ETHEME_DOMAIN) ?></h5>
							
							<p><?php _e('Register with us for future convenience: fast and easy check out, easy access to your orders history and statuses', ETHEME_DOMAIN) ?></p>

							<form class="checkout-methods">
								<?php if ($checkout->enable_guest_checkout): ?>
			                        <div class="method-radio">
			                            <input type="radio"  id="method1" checked name="method" value="1">
			                            <label for="method1"><?php _e('Checkout as Guest', ETHEME_DOMAIN) ?></label>
			                            <div class="clear"></div>
			                        </div>
								<?php endif ?>
		                        <div class="method-radio">
		                            <input type="radio" id="method2" <?php if (!$checkout->enable_guest_checkout): ?> checked <?php endif; ?> name="method" value="2">
		                            <label for="method2"><?php _e('Create an Account', ETHEME_DOMAIN) ?></label>
		                            <div class="clear"></div>
		                        </div>
		                        <div class="clear"></div>
		                    </form>

		                    <button class="button active fl-r continue-checkout" data-next="<?php if ( ! empty( $checkout->checkout_fields['account'] ) ) : ?>2<?php else: ?>3<?php endif; ?>"><?php _e('Continue', ETHEME_DOMAIN) ?></button>
							<div class="clear"></div>
						</div>

						<div class="span5 offset2">
							<h5><?php _e('Returning Customers', ETHEME_DOMAIN) ?></h5>
							<p><?php _e('If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing & Shipping section.', ETHEME_DOMAIN) ?></p>

							<?php 
							if ( !is_user_logged_in()  ||  $checkout->enable_signup ) 
								woocommerce_login_form(
									array(
										'redirect' => get_permalink( woocommerce_get_page_id( 'checkout') ),
										'hidden'   => false
									)
								);
							?>

							<?php remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 ); // remove login form before checkout ?>
							<?php  do_action( 'woocommerce_before_checkout_form', $checkout ); // COUPON FORM ?>

						</div>
					</div>

					<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

				</div> <!-- //step1 -->

				<form name="checkout" method="post" class="checkout" action="<?php echo esc_url( $get_checkout_url ); ?>">
					<?php if ( ! empty( $checkout->checkout_fields['account'] ) ) : ?>
						<div class="checkout-step" id="step2">
	
							<h3 class="step-title"><?php _e('Create an Account', ETHEME_DOMAIN); ?></h3>
	
							<?php if ($checkout->enable_signup ) : ?>
	
								<?php if ( $checkout->enable_guest_checkout ) : ?>
	
									<p class="form-row form-row-wide hidden">
										<input class="input-checkbox" id="createaccount" <?php checked($checkout->get_value('createaccount'), true) ?> type="checkbox" name="createaccount" value="1" /> <label for="createaccount" class="checkbox"><?php _e( 'Create an account?', ETHEME_DOMAIN ); ?></label>
									</p>
	
								<?php endif; ?>
	
							<?php endif; ?>
	
							<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>
	
							<div class="et-create-account">
	
								<div class="row-fluid">
									<div class="span4">
	
										<p><?php _e( 'Create an account by entering the information below. If you are a returning customer please login at the top of the page.', ETHEME_DOMAIN ); ?></p>
	
										
										<?php  foreach ($checkout->checkout_fields['account'] as $key => $field) : ?>
	
											<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
	
										<?php endforeach; ?>	
									</div>
								</div>
								
	                    		<a href="#" class="button active arrow-right fl-r continue-checkout" data-next="3"><?php _e('Continue', ETHEME_DOMAIN) ?></a>
							
								<div class="clear"></div>
	
							</div>
	
							<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	
						</div> <!-- //step2 -->
					<?php else: ?>
							<?php if ($checkout->enable_signup ) : ?>
								<?php if ( $checkout->enable_guest_checkout ) : ?>
									<p class="form-row form-row-wide hidden">
										<input class="input-checkbox" id="createaccount" <?php checked($checkout->get_value('createaccount'), true) ?> type="checkbox" name="createaccount" value="1" /> <label for="createaccount" class="checkbox"><?php _e( 'Create an account?', ETHEME_DOMAIN ); ?></label>
									</p>
								<?php endif; ?>
							<?php endif; ?>
					<?php endif; ?>

			<?php else: ?>
				<form name="checkout" method="post" class="checkout" action="<?php echo esc_url( $get_checkout_url ); ?>">
			<?php endif; // first two steps only for loogged users ?>

				<div class="checkout-step <?php if (is_user_logged_in()): ?>active<?php endif; ?>" id="step3">
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
				</div> <!-- //step3 -->

				<div class="checkout-step" id="step4">
					<?php do_action( 'woocommerce_checkout_shipping' ); ?>
				</div> <!-- //step4 -->

				<div class="checkout-step" id="step5">
					<h3 class="step-title"><?php _e('Your Order', ETHEME_DOMAIN); ?></h3>
					<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

					<div id="order_review" class="woocommerce-checkout-review-order">
						<?php do_action( 'woocommerce_checkout_order_review' ); ?>
					</div>

					<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
				</div> <!-- //step5 -->
			</form>
		</div>

	<?php endif; ?>

	


<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>