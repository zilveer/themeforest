<?php
/**
 * Checkout Payment Section
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $mango_count_checkout_tabs, $mango_settings;
?>

<?php if ( !is_ajax () ) : ?>
    <?php do_action ( 'woocommerce_review_order_before_payment' ); ?>
<?php endif; ?>
<?php if( !is_ajax()){ ?>
<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading-payment">
 	 <?php if($mango_settings['mango_show_collapse_tabs']==1){ ?>
        <h2 class="panel-title">
	 <?php } else{ ?>
		<h2 class="panel-title title-pan">
	<?php } ?>
            <a data-toggle="collapse" href="#collapse-payment" aria-expanded="true" aria-controls="collapse-payment">
                <?php _e ( "Payment Information", 'mango' ); ?>
				<?php if($mango_settings['mango_show_collapse_tabs']==1){ ?>
                <span class="panel-icon"><i class="fa fa-angle-down"></i></span>
				<?php }else{ ?>
				<span class="panel-icon"></span>
				<?php } ?>
            </a>
             <?php if($mango_settings['mango_show_collapse_tabs']==1){ ?>
            <span class="step-box"><?php echo $mango_count_checkout_tabs; ?></span>
			 <?php } else{ ?>
			<span class=""></span>
			<?php } ?>
        </h2>
    </div>
    <!-- End .panel-heading -->
    <?php $mango_count_checkout_tabs ++; ?>


	<?php if($mango_settings['mango_show_collapse_tabs']==1){ ?>
    <div id="collapse-payment" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-payment">
	<?php
	}else{
	?>
    <div id="" class="" role="tabpanel" aria-labelledby="heading-payment">
	<?php } ?>

     <div class="panel-body">
        <?php } ?>
        <div id="payment" class="woocommerce-checkout-payment">
            <?php if ( WC ()->cart->needs_payment () ) : ?>
                <ul class="payment_methods methods">
                        <?php
                        if ( !empty( $available_gateways ) ) {
                            foreach ( $available_gateways as $gateway ) {
                                wc_get_template ( 'checkout/payment-method.php', array ( 'gateway' => $gateway ) );
                            }
                        } else {
                            if ( !WC ()->customer->get_country () ) {
                                $no_gateways_message = __ ( 'Please fill in your details above to see available payment methods.', 'woocommerce' );
                            } else {
                                $no_gateways_message = __ ( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' );
                            }

                            echo '<p>' . apply_filters ( 'woocommerce_no_available_payment_methods_message', $no_gateways_message ) . '</p>';
                        }
                        ?>
                    </ul>
                <?php endif; ?>
                <div class="form-row place-order">
                    <noscript><?php _e ( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ); ?>
                        <br/><input type="submit" class="button alt button alt btn btn-custom2 min-width-sm" name="woocommerce_checkout_update_totals"
                                    value="<?php _e ( 'Update totals', 'woocommerce' ); ?>"/></noscript>

                    <?php wp_nonce_field ( 'woocommerce-process_checkout' ); ?>

                    <?php do_action ( 'woocommerce_review_order_before_submit' ); ?>

                    <?php echo apply_filters ( 'woocommerce_order_button_html', '<input type="submit" class="button alt btn btn-custom2 min-width-sm" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr ( $order_button_text ) . '" data-value="' . esc_attr ( $order_button_text ) . '" />' ); ?>

                    <?php if ( wc_get_page_id ( 'terms' ) > 0 && apply_filters ( 'woocommerce_checkout_show_terms', true ) ) : ?>
                        <div class="checkbox form-row terms">
                            <label for="terms" class="checkbox custom-checkbox-wrapper">
                            <span class="custom-checkbox-container">
                                <input type="checkbox"
                                       name="terms" <?php checked ( apply_filters ( 'woocommerce_terms_is_checked_default', isset( $_POST[ 'terms' ] ) ), true ); ?>
                                       id="terms">
                                <span class="custom-checkbox-icon"></span>
                            </span>
                                <span><?php printf ( __ ( 'I&rsquo;ve read and accept the <a href="%s" target="_blank">terms &amp; conditions</a>', 'woocommerce' ), esc_url ( wc_get_page_permalink ( 'terms' ) ) ); ?></span>
                            </label>
                        </div>
                    <?php endif; ?>

                    <?php do_action ( 'woocommerce_review_order_after_submit' ); ?>
                </div>
                <div class="clear"></div>
            </div>
<?php if(!is_ajax()){ ?>
        </div>
    </div>
</div>
<?php } ?>
<?php if ( !is_ajax () ) : ?>
    <?php do_action ( 'woocommerce_review_order_after_payment' ); ?>
<?php endif; ?>