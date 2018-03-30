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



// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', esc_html__('You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() );

$col_class = 'col-md-12';

if (  WC()->cart->coupons_enabled() ) {
    $col_class = 'col-md-9';
}

?>

<div class="row">
    <?php if (WC()->cart->coupons_enabled()): ?>
        <div class="col-md-3">
            <?php do_action( 'woocommerce_before_checkout_form', $checkout );  ?>
        </div>
    <?php endif; ?>
    <div class="<?php echo esc_attr($col_class) ?>">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <?php do_action('woocommerce_checkout_login_form',$checkout); ?>
            <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">
                <?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

                    <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

                    <?php do_action( 'woocommerce_checkout_billing' ); ?>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading-shipping-address">
                            <a data-toggle="collapse" data-parent="#accordion" href="#shipping-address" aria-expanded="false" aria-controls="shipping-address">
                                <?php esc_html_e("Shipping Address",'zorka'); ?>
                            </a>
                        </div>
                        <div id="shipping-address" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-shipping-address">
                            <div class="panel-body">
                                <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                                <a  data-toggle="collapse" data-parent="#accordion" href="#review-order" aria-expanded="false"   class="button"><?php esc_html_e("Continue",'zorka'); ?></a>
                            </div>
                        </div>
                    </div>
                    <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
                <?php endif; ?>
                <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading-review-order">
                        <a data-toggle="collapse" data-parent="#accordion" href="#review-order" aria-expanded="false" aria-controls="review-order">
                            <?php esc_html_e('Your order', 'woocommerce' ); ?>
                        </a>
                    </div>
                    <div id="review-order" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-review-order">
                        <div class="panel-body">
                            <div id="order_review" class="woocommerce-checkout-review-order">
                                <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
            </form>
        </div>
    </div>
</div>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
