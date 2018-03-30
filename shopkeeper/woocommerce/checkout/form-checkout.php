<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

?>

<style>
	.page-title {
		margin-bottom: 24px;
	}
	
	@media only screen and (min-width: 641px) {
		.page-title {
			margin-bottom: 26px;
		}
	}

	@media only screen and (min-width: 1025px) {
		.page-title {
			margin-bottom:25px;
		}	
	}
	
	.page-title:after {
		display: none;
	}
</style>

<?php
do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>
    
<div class="row">
    <div class="xxlarge-9 xlarge-10 large-12 large-centered columns">	
	
        <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>">
        
            <?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>
        
                <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
				<div class="row">
					
					<div class="large-7 columns">
						<div class="checkout_left_wrapper">
			
							<div class="col2-set" id="customer_details">
					
								<div class="col-1">
					
									<?php do_action( 'woocommerce_checkout_billing' ); ?>
					
								</div>
					
								<div class="col-2">
					
									<?php do_action( 'woocommerce_checkout_shipping' ); ?>
					
								</div>
					
							</div>
				
							<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
							
						</div><!--.checkout_left_wrapper-->
					</div><!--.large-7-->
			
					<div class="large-5 columns">
						<div class="checkout_right_wrapper custom_border">
							<div class="order_review_wrapper">
								
								<h3 id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3>
								
								<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

								<div id="order_review" class="woocommerce-checkout-review-order">
									<?php do_action( 'woocommerce_checkout_order_review' ); ?>
								</div>

								<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
								
							</div><!--.order_review_wrapper-->
						</div><!--.checkout_right_wrapper-->
					</div><!--.large-5-->

				</div><!--.row-->
					
            <?php endif; ?>
            
        </form>
   
    </div><!-- .columns -->
</div><!-- .row -->

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>