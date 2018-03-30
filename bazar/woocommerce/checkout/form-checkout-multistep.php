<?php
/**
 * Checkout Form Multistep
 *
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

wp_enqueue_script('yit_checkout', YIT_CORE_ASSETS_URL . '/js/yit/jquery.yit_checkout.js');

$woocommerce_ship_to_billing = yit_woocommerce_default_shiptobilling();
/* fix check default billing to address step 2*/
$labelShipp = __( 'Shipping Address &rarr;', 'yit' );
$labelPay = __( 'Payment Method &rarr;', 'yit' );
$next_step2 = $woocommerce_ship_to_billing ? "4" : "3";
$label_step2 = $woocommerce_ship_to_billing ? $labelPay : $labelShipp;
$alter_label_step2 = $woocommerce_ship_to_billing ? $labelShipp : $labelPay;
/*-fix prev button step 4---------*/
$labelBillingPrev = __('&larr; Billing Address', 'yit');
$labelShippingPrev = __('&larr; Shipping Method', 'yit');
$next_step4 = $woocommerce_ship_to_billing ? "2" : "3";
$label_step4 = $woocommerce_ship_to_billing ? $labelBillingPrev : $labelShippingPrev;
$alter_label_step4 = $woocommerce_ship_to_billing ? $labelShippingPrev : $labelBillingPrev;
/*-----------*/

remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

$order_button_text = __( 'Place Order', 'yit' );

wc_print_notices(); ?>

<?php remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 ); ?>
<?php do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
    echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'yit' ) );
    return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', wc_get_checkout_url() );
$data_step_1 = ( !is_user_logged_in() && get_option('woocommerce_enable_signup_and_login_from_checkout')=="yes" ) ? 'data-step="1"': '';  ?>

<div id="checkout_multistep">

<div id="multistep_resume">
	<div><span class="checkout_progress"><img src="<?php echo get_stylesheet_directory_uri() ?>/woocommerce/images/multistep_cart.png" alt="<?php _e('Checkout Progress', 'yit') ?>" /> <?php _e('Checkout Progress', 'yit') ?></span></div>
	<div><a href="#" <?php echo $data_step_1 ?> class="<?php if(!is_user_logged_in()): ?>current <?php else: ?>user_logged_in <?php endif ?>multistep_section"><?php _e('Login', 'yit') ?></a></div>
	<div><a href="#" data-step="2" class="<?php if(is_user_logged_in()): ?>current <?php endif ?>multistep_section"><?php _e('Billing Address', 'yit') ?></a></div>
	<?php if ( ( WC()->cart->needs_shipping() || get_option('woocommerce_require_shipping_address') == 'yes' ) ) : ?>
	<div><a href="#" data-step="3" class="multistep_section"><?php _e('Shipping Address', 'yit') ?></a></div>
	<?php endif; ?>
	<div><a id="multistep_section_payment_method" href="#" data-step="4" class="multistep_section"><?php _e('Payment Method', 'yit') ?></a></div>
	<div><a href="#" data-step="5" class="multistep_section"><?php _e('Order Review', 'yit') ?></a></div>
</div>

<div class="clear"></div>

<div class="row">
	<div id="multistep_progress" class="span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9 ?> progress progress-striped">
		<div class="bar" style="width: 0%;"></div>
	</div>
</div>

<div id="multistep_steps" class="row">

	<!-- step 1 -->
	<?php if (!is_user_logged_in() && get_option('woocommerce_enable_signup_and_login_from_checkout')=="yes") : ?>
	<div class="current multistep_step span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9 ?> user_not_logged_in" id="multistep_step1" data-step="1">
    	<div class="box_style">

            <div class="row">
                <?php wc_get_template('checkout/form-login.php', array('woocommerce'=>WC())) ?>

                <?php if( get_option('woocommerce_enable_guest_checkout')=="yes" ): ?>
                <input type="submit" class="button next" name="next[]" value="<?php _e('Checkout as Guest', 'yit'); ?>" data-next="2" />
                <?php endif ?>
            </div>

            <div class="clear"></div>
    	</div>
	</div>
	<?php elseif( !is_user_logged_in() ): ?>
        <div class="multistep_step user_not_logged_in guest_checkout" id="multistep_step1" data-step="1"></div>
    <?php else: ?>
	    <div class="multistep_step user_logged_in" id="multistep_step1" data-step="1"></div>
	<?php endif ?>


	<form name="checkout" method="post" class="checkout" action="<?php echo esc_url( $get_checkout_url ); ?>">

	<?php do_action( 'woocommerce_checkout_before_customer_details'); ?>

	<!-- step 2 -->
	<div class="<?php if (is_user_logged_in() || ( !is_user_logged_in() && get_option('woocommerce_enable_signup_and_login_from_checkout')!="yes") ): ?>current <?php endif ?>multistep_step span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9 ?>" id="multistep_step2" data-step="2">
    	<div class="box_style">

			<?php do_action('woocommerce_checkout_billing'); ?>

            <?php if ( !is_user_logged_in() && get_option('woocommerce_enable_signup_and_login_from_checkout')=="yes" ): ?>
            <input type="submit" class="button prev" name="login" value="<?php _e('&larr; Login', 'yit'); ?>" data-next="1" />
            <?php endif ?>

            <input type="submit" class="button next" name="login" value="<?php echo $label_step2; ?>" data-next="<?php echo $next_step2; ?>" data-alternativelabel="<?php echo $alter_label_step2; ?>" />

        	<div class="clear"></div>
        </div>
	</div>


	<!-- step 3 -->
	<div class="multistep_step span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9 ?>" id="multistep_step3" data-step="3">
    	<div class="box_style">

			<?php do_action('woocommerce_checkout_shipping'); ?>

			<input type="submit" class="button prev" name="login" value="<?php _e('&larr; Billing Address', 'yit'); ?>" data-next="2" />
			<input type="submit" class="button next" name="login" value="<?php _e('Payment Method &rarr;', 'yit'); ?>" data-next="4" />

        	<div class="clear"></div>
        </div>
	</div>

	<?php do_action( 'woocommerce_checkout_after_customer_details'); ?>

	<!-- step 4 -->
	<div class="multistep_step span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9 ?>" id="multistep_step4" data-step="4">
    	<div id="order_review" class="box_style woocommerce-checkout-review-order">

            <h3><?php _e('Payment Method', 'yit'); ?></h3>

			<?php woocommerce_checkout_payment(); ?>

            <input type="submit" class="button prev" name="login" value="<?php echo $label_step4; ?>" data-next="<?php echo $next_step4;?>" data-alternativelabel="<?php  echo $alter_label_step4?>" />
            <input type="submit" class="button next" name="login" value="<?php _e('Order Review &rarr;', 'yit'); ?>" data-next="5" />

            <div class="clear"></div>
        </div>
    </div>

	<!-- step 5 -->
	<div class="multistep_step span<?php echo yit_get_sidebar_layout() == 'sidebar-no' ? 12 : 9 ?>" id="multistep_step5" data-step="5">
    	<div class="box_style">

            <h3 id="order_review_heading"><?php _e('Your order', 'yit'); ?></h3>
            <?php do_action('woocommerce_checkout_order_review'); ?>

            <?php $checkout = WC()->checkout(); ?>
            <?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

            <?php if ( get_option( 'woocommerce_enable_order_comments' ) != 'no' ) : ?>

                <h3><?php _e('Additional Information', 'yit'); ?></h3>

                <?php foreach ($checkout->checkout_fields['order'] as $key => $field) : ?>

                    <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

                <?php endforeach; ?>

            <?php endif; ?>

            <?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>

            <div class="form-row place-order">

                <noscript><?php _e( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'yit' ); ?><br/><input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php _e( 'Update totals', 'yit' ); ?>" /></noscript>

                <?php wp_nonce_field( 'woocommerce-process_checkout' ); ?>

                <?php do_action( 'woocommerce_review_order_before_submit' ); ?>

                <input type="submit" class="button prev" name="login" value="<?php _e('&larr; Payment Method', 'yit'); ?>" data-next="4" />

                <?php echo apply_filters( 'woocommerce_order_button_html', '<input type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '" />' ); ?>

                <?php if ( wc_get_page_id( 'terms' ) > 0 && apply_filters( 'woocommerce_checkout_show_terms', true ) ) : ?>
                    <p class="form-row terms">
                        <label for="terms" class="checkbox"><?php printf( __( 'I&rsquo;ve read and accept the <a href="%s" target="_blank">terms &amp; conditions</a>', 'yit' ), esc_url( get_permalink( wc_get_page_id( 'terms' ) ) ) ); ?></label>
                        <input type="checkbox" class="input-checkbox" name="terms" <?php checked( apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST['terms'] ) ), true ); ?> id="terms" />
                    </p>
                <?php endif; ?>

                <?php do_action( 'woocommerce_review_order_after_submit' ); ?>

            </div>

            <div class="clear"></div>

    	</div>
	</div>

</form>
</div>


</div>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>


<script type="text/javascript" charset="utf-8">
jQuery(document).ready(function(){
    <?php if ( is_plugin_active('woocommerce-gateway-stripe/gateway-stripe.php') || is_plugin_active('woocommerce-gateway-stripe-connect/gateway-stripe.php') ) : ?>
        jQuery(document).on('click', '#multistep_steps #order_review input#place_order', function() { return stripeFormHandler(); });
    <?php endif; ?>
    jQuery('#checkout_multistep').yit_checkout();
});
</script>