<?php
/**
 * Review order table
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.3.0
 */

if ( !defined ( 'ABSPATH' ) ) {
    exit;
}
global $mango_count_checkout_tabs, $mango_settings;
?>
<?php if(!is_ajax()){ ?>
<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading-mango_order_review">
 	 <?php if($mango_settings['mango_show_collapse_tabs']==1){ ?>
        <h2 class="panel-title">
	 <?php } else{ ?>
			<h2 class="panel-title title-pan">
	<?php } ?>
            <a data-toggle="collapse" href="#collapse-mango_order_review" aria-expanded="true" aria-controls="collapse-mango_order_review">
                <?php _e ( 'Your order', 'woocommerce' ); ?>
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
<!--    woocommerce-checkout-review-order-->

	<?php if($mango_settings['mango_show_collapse_tabs']==1){ ?>
    <div id="collapse-mango_order_review" class=" panel-collapse collapse" role="tabpanel" aria-labelledby="heading-mango_order_review">
	<?php }
	else{ ?>
    <div id="" class="" role="tabpanel" aria-labelledby="heading-mango_order_review">
	<?php } ?>
        <div class="panel-body">
		<?php } ?>
            <table class="table table-responsive shop_table woocommerce-checkout-review-order-table">
                <thead>
                <tr>
                    <th class="product-name"><?php _e ( 'Product', 'woocommerce' ); ?></th>
                    <th class="product-total"><?php _e ( 'Total', 'woocommerce' ); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                do_action ( 'woocommerce_review_order_before_cart_contents' );

                foreach ( WC ()->cart->get_cart () as $cart_item_key => $cart_item ) {
                    $_product = apply_filters ( 'woocommerce_cart_item_product', $cart_item[ 'data' ], $cart_item, $cart_item_key );

                    if ( $_product && $_product->exists () && $cart_item[ 'quantity' ] > 0 && apply_filters ( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                        ?>
                        <tr class="<?php echo esc_attr ( apply_filters ( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                            <td class="product-name">
                                <?php echo apply_filters ( 'woocommerce_cart_item_name', $_product->get_title (), $cart_item, $cart_item_key ) . '&nbsp;'; ?>
                                <?php echo apply_filters ( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf ( '&times; %s', $cart_item[ 'quantity' ] ) . '</strong>', $cart_item, $cart_item_key ); ?>
                                <?php echo WC ()->cart->get_item_data ( $cart_item ); ?>
                            </td>
                            <td class="product-total">
                                <?php echo apply_filters ( 'woocommerce_cart_item_subtotal', WC ()->cart->get_product_subtotal ( $_product, $cart_item[ 'quantity' ] ), $cart_item, $cart_item_key ); ?>
                            </td>
                        </tr>
                    <?php
                    }
                }

                do_action ( 'woocommerce_review_order_after_cart_contents' );
                ?>
                </tbody>
                <tfoot>

                <tr class="cart-subtotal">
                    <th><?php _e ( 'Subtotal', 'woocommerce' ); ?></th>
                    <td><?php wc_cart_totals_subtotal_html (); ?></td>
                </tr>

                <?php foreach ( WC ()->cart->get_coupons () as $code => $coupon ) : ?>
                    <tr class="cart-discount coupon-<?php echo esc_attr ( $code ); ?>">
                        <th><?php wc_cart_totals_coupon_label ( $coupon ); ?></th>
                        <td><?php wc_cart_totals_coupon_html ( $coupon ); ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php if ( WC ()->cart->needs_shipping () && WC ()->cart->show_shipping () ) : ?>

                    <?php do_action ( 'woocommerce_review_order_before_shipping' ); ?>

                    <?php wc_cart_totals_shipping_html (); ?>

                    <?php do_action ( 'woocommerce_review_order_after_shipping' ); ?>

                <?php endif; ?>

                <?php foreach ( WC ()->cart->get_fees () as $fee ) : ?>
                    <tr class="fee">
                        <th><?php echo esc_html ( $fee->name ); ?></th>
                        <td><?php wc_cart_totals_fee_html ( $fee ); ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php if ( WC ()->cart->tax_display_cart === 'excl' ) : ?>
                    <?php if ( get_option ( 'woocommerce_tax_total_display' ) === 'itemized' ) : ?>
                        <?php foreach ( WC ()->cart->get_tax_totals () as $code => $tax ) : ?>
                            <tr class="tax-rate tax-rate-<?php echo sanitize_title ( $code ); ?>">
                                <th><?php echo esc_html ( $tax->label ); ?></th>
                                <td><?php echo wp_kses_post ( $tax->formatted_amount ); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr class="tax-total">
                            <th><?php echo esc_html ( WC ()->countries->tax_or_vat () ); ?></th>
                            <td><?php echo wc_price ( WC ()->cart->get_taxes_total () ); ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endif; ?>

                <?php do_action ( 'woocommerce_review_order_before_order_total' ); ?>

                <tr class="order-total">
                    <th><?php _e ( 'Total', 'woocommerce' ); ?></th>
                    <td><?php wc_cart_totals_order_total_html (); ?></td>
                </tr>

                <?php do_action ( 'woocommerce_review_order_after_order_total' ); ?>

                </tfoot>
            </table>
<?php if(!is_ajax()){ ?>
        </div>
    </div>
</div>
<?php } ?>