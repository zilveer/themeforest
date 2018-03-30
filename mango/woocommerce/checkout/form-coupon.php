<?php
/**
 * Checkout coupon form
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.2
 */

if ( !defined ( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( !WC ()->cart->coupons_enabled () ) {
    return;
}
global $mango_count_checkout_tabs, $mango_settings;
$info_message = apply_filters ( 'woocommerce_checkout_coupon_message', __ ( 'Have a coupon?', 'woocommerce' ) . __ ( 'Click here to enter your code', 'woocommerce' ) . '</a>' );
?>
<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading-coupon">
	
	 <?php if($mango_settings['mango_show_collapse_tabs']==1){ ?>
        <h2 class="panel-title">
	 <?php } else{ ?>
			<h2 class="panel-title title-pan">
	<?php } ?>
            <a data-toggle="collapse" href="#collapse-coupon" aria-expanded="true" aria-controls="collapse-coupon">
                <?php
                wc_print_notice ( $info_message, 'notice' );
                ?>
              <?php if($mango_settings['mango_show_collapse_tabs']==1){
				?>
                <span class="panel-icon"><i class="fa fa-angle-down"></i></span>
				<?php } else{ ?>
					<span class="panel-icon"></span>
					<?php
				}?>
            </a>
             <?php if($mango_settings['mango_show_collapse_tabs']==1){ ?>
			 <span class="step-box"><?php echo $mango_count_checkout_tabs; ?></span>
			 <?php } else{ ?>
				 <span class=""></span>
			<?php } ?>
        </h2>
        <?php $mango_count_checkout_tabs ++; ?>
    </div>
	
	<?php if($mango_settings['mango_show_collapse_tabs']==1){
	$collapse='panel-collapse collapse';
	?>
   <div id="collapse-coupon" class="<?php echo $collapse; ?>" role="tabpanel" aria-labelledby="heading-coupon">
	<?php }
	else{?>
    <div id="" class="" role="tabpanel" aria-labelledby="heading-coupon">
	<?php } ?>
        <div class="panel-body">
            <form class="checkout_coupon" method="post">

                <p class="form-row form-group form-row-first">
                    <label class="input-desc" for="coupon_code"><?php _e ( 'Coupon code', 'woocommerce' ); ?></label>
                    <input type="text" name="coupon_code" class="input-text form-control"
                           placeholder="<?php _e ( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value=""/>
                </p>

                <p class="form-row form-group form-row-last">
                    <input type="submit" class="button btn btn-custom2 min-width-sm" name="apply_coupon"
                    value="<?php _e ( 'Apply Coupon', 'woocommerce' ); ?>"/>
                </p>

                <div class="clear"></div>
            </form>
        </div>
    </div>
</div>