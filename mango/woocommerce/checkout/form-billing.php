<?php
/**
 * Checkout billing information form
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.1.2
 */

if ( !defined ( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/** @global WC_Checkout $checkout */

global $mango_count_checkout_tabs, $mango_settings;
//print_r($mango_settings);
?>

<div class="woocommerce-billing-fields panel panel-default">
    <?php if ( WC ()->cart->ship_to_billing_address_only () && WC ()->cart->needs_shipping () ) : ?>
        <?php $title = __ ( 'Billing &amp; Shipping', 'woocommerce' ); ?>
    <?php else : ?>
        <?php $title = __ ( 'Billing Details', 'woocommerce' ); ?>
    <?php endif; ?>
 <div class="panel-heading" role="tab" id="heading-billing">
 	 <?php if($mango_settings['mango_show_collapse_tabs']==1){ ?>
        <h2 class="panel-title">
	 <?php } else{ ?>
			<h2 class="panel-title title-pan">
	<?php } ?>
            <a data-toggle="collapse" href="#collapse-billing" aria-expanded="true" aria-controls="collapse-billing">
                <?php echo $title; ?>			
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
        <?php $mango_count_checkout_tabs ++; ?>
    </div>
    <!-- End .panel-heading -->
	<?php if($mango_settings['mango_show_collapse_tabs']==1){ ?>
    <div id="collapse-billing" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-billing">
	<?php }
	else{ ?>
	    <div id="" class="" role="tabpanel" aria-labelledby="heading-billing">
	<?php } ?>
		<div class="panel-body">
            <?php do_action ( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

            <?php foreach ( $checkout->checkout_fields[ 'billing' ] as $key => $field ) : ?>
                <?php
                //$field[ 'class' ][ ] = "form-group";
                $field[ 'label_class' ][ ] = 'input-desc';
                ?>
                <?php woocommerce_form_field ( $key, $field, $checkout->get_value ( $key ) ); ?>

            <?php endforeach; ?>

            <?php do_action ( 'woocommerce_after_checkout_billing_form', $checkout ); ?>

            <?php if ( !is_user_logged_in () && $checkout->enable_signup ) : ?>

                <?php if ( $checkout->enable_guest_checkout ) : ?>

                    <p class="form-row form-row-wide create-account checkbox">
                        <label for="createaccount" class="checkbox custom-checkbox-wrapper">
                    <span class="custom-checkbox-container">
                        <input class="input-checkbox"
                               id="createaccount" <?php checked ( ( true === $checkout->get_value ( 'createaccount' ) || ( true === apply_filters ( 'woocommerce_create_account_default_checked', false ) ) ), true ) ?>
                               type="checkbox" name="createaccount" value="1"/>
                        <span class="custom-checkbox-icon"></span>
                            </span>
                            <span><?php _e ( 'Create an account?', 'woocommerce' ); ?></span>
                        </label>
                    </p>
                <?php endif; ?>

                <?php do_action ( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

                <?php if ( !empty( $checkout->checkout_fields[ 'account' ] ) ) : ?>

                    <div class="create-account">

                        <p><?php _e ( 'Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'woocommerce' ); ?></p>

                        <?php foreach ( $checkout->checkout_fields[ 'account' ] as $key => $field ) : ?>
                            <?php
                            //$field[ 'class' ][ ] = "form-group";
                            $field[ 'label_class' ][ ] = 'input-desc';
                            woocommerce_form_field ( $key, $field, $checkout->get_value ( $key ) ); ?>

                        <?php endforeach; ?>

                        <div class="clear"></div>

                    </div>

                <?php endif; ?>

                <?php do_action ( 'woocommerce_after_checkout_registration_form', $checkout ); ?>

            <?php endif; ?>
        </div>
    </div>
</div>