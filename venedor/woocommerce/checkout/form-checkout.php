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

global $venedor_woo_version;

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

if (version_compare($venedor_woo_version, '2.5', '<')) {
    // filter hook for include new pages inside the payment method
    $get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() );
}
?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( version_compare($venedor_woo_version, '2.5', '<') ? $get_checkout_url : wc_get_checkout_url()); ?>" enctype="multipart/form-data">

    <div class="row">
        
	    <?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>
        
            <div class="col-md-7 col-sm-6">

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
            
            <div class="col-md-5 col-sm-6">

		        <h3 id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3>
                
        <?php else : ?>
        
            <div class="col-md-5 col-sm-6">

	    <?php endif; ?>

        <?php if ( version_compare($venedor_woo_version, '2.3', '<') ) { ?>
            <?php do_action( 'woocommerce_checkout_order_review' ); ?>
        <?php } else { ?>
            <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

            <div id="order_review" class="order-review woocommerce-checkout-review-order">
                <?php do_action( 'woocommerce_checkout_order_review' ); ?>
            </div>

	        <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
        <?php } ?>
        
        </div>
    
    </div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>