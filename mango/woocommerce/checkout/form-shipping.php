<?php
/**
 * Checkout shipping information form
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.2.0
 */

if ( !defined ( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
global $mango_count_checkout_tabs, $mango_settings;
?>
<?php if ( WC ()->cart->needs_shipping_address () === true ) : ?>
    <div class="woocommerce-shipping-fields panel panel-default">
        <?php
        if ( empty( $_POST ) ) {

            $ship_to_different_address = get_option ( 'woocommerce_ship_to_destination' ) === 'shipping' ? 1 : 0;
            $ship_to_different_address = apply_filters ( 'woocommerce_ship_to_different_address_checked', $ship_to_different_address );

        } else {
            $ship_to_different_address = $checkout->get_value ( 'ship_to_different_address' );
        }
        ?>
        <div class="panel-heading" role="tab" id="heading-shipping">
 	 <?php if($mango_settings['mango_show_collapse_tabs']==1){ ?>
        <h2 class="panel-title">
	 <?php } else{ ?>
		<h2 class="">
	<?php } ?>
            <a data-toggle="collapse" href="#collapse-shipping" aria-expanded="true"
                   aria-controls="collapse-shipping">
				   
				   <?php if($mango_settings['mango_show_collapse_tabs']==1){ ?>
                 <?php _e ( 'Ship to a different address?', 'woocommerce' ); ?>
					<?php } else{ ?>
					<div class="shiptodiff"><?php _e ( '', 'woocommerce' ); ?></div>
					<?php } ?>
				 
				<?php if($mango_settings['mango_show_collapse_tabs']==1){ ?>
                <span class="panel-icon"><i class="fa fa-angle-down"></i></span>
				<?php } else { ?>
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
        <div id="collapse-shipping" class="panel-collapse collapse" role="tabpanel"
             aria-labelledby="heading-shipping">
	<?php } else{ ?>
        <div id="" class="" role="tabpanel"
             aria-labelledby="heading-shipping">
	<?php } ?>

            <div class="panel-body">
                <div id="ship-to-different-address" class="checkbox">
                    <label for="ship-to-different-address-checkbox" class="custom-checkbox-wrapper">
                            <span class="custom-checkbox-container">
                                <input id="ship-to-different-address-checkbox"
                                       class="input-checkbox" <?php checked ( $ship_to_different_address, 1 ); ?>
                                       type="checkbox" name="ship_to_different_address" value="1"/>
                                <span class="custom-checkbox-icon"></span>
                            </span>
                        <span><?php _e ( 'Ship to a different address?', 'woocommerce' ); ?></span>
                    </label>
                </div>
                <div class="shipping_address">

                    <?php do_action ( 'woocommerce_before_checkout_shipping_form', $checkout ); ?>

                    <?php foreach ( $checkout->checkout_fields[ 'shipping' ] as $key => $field ) : ?>
                        <?php
                        //$field[ 'class' ][ ] = "form-group";
                        $field[ 'label_class' ][ ] = 'input-desc';
                        woocommerce_form_field ( $key, $field, $checkout->get_value ( $key ) ); ?>

                    <?php endforeach; ?>

                    <?php do_action ( 'woocommerce_after_checkout_shipping_form', $checkout ); ?>

                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php do_action ( 'woocommerce_before_order_notes', $checkout ); ?>
<?php if ( apply_filters ( 'woocommerce_enable_order_notes_field', get_option ( 'woocommerce_enable_order_comments', 'yes' ) === 'yes' ) ) : ?>
    <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="heading-order-notes">
 	 <?php if($mango_settings['mango_show_collapse_tabs']==1){ ?>
        <h2 class="panel-title">
	 <?php } else{ ?>
			<h2 class="panel-title title-pan">
	<?php } ?>
                <a data-toggle="collapse" href="#collapse-order-notes" aria-expanded="true"
                   aria-controls="collapse-order-notes">
                    <?php _e ( 'Order Notes', 'woocommerce' ); ?>
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
        <div id="collapse-order-notes" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-order-notes">
	<?php }
	else { ?>
        <div id="" class="" role="tabpanel" aria-labelledby="heading-order-notes">
	<?php } ?>
            <div class="panel-body">
                <?php if ( !WC ()->cart->needs_shipping () || WC ()->cart->ship_to_billing_address_only () ) : ?>

                    <h3><?php _e ( 'Additional Information', 'woocommerce' ); ?></h3>

                <?php endif; ?>

                <?php foreach ( $checkout->checkout_fields[ 'order' ] as $key => $field ) :
                    $field[ 'class' ][ ] = "form-group";
                    $field[ 'label_class' ][ ] = 'input-desc';
                    $field['input_class'][] = 'form-control';
                    woocommerce_form_field ( $key, $field, $checkout->get_value ( $key ) ); ?>

                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php do_action ( 'woocommerce_after_order_notes', $checkout ); ?>