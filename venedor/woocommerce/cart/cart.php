<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $woocommerce, $venedor_woo_version;

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( version_compare($venedor_woo_version, '2.5', '<') ? WC()->cart->get_cart_url() : wc_get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<table class="shop_table cart" cellspacing="0">
	<thead>
		<tr class="mobile-hide">
			<th class="product-wrap"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th class="product-price"><?php _e( 'Price', 'woocommerce' ); ?></th>
			<th class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
			<th class="product-subtotal"><?php _e( 'Total', 'woocommerce' ); ?></th>
		</tr>
        <?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>
        <tr class="mobile-row">
            <th colspan="4"><?php echo sizeof( $woocommerce->cart->get_cart() ); echo ' '; _e( 'Product(s) In Your Cart', 'venedor' ); ?></th>
        </tr>
        <?php endif; ?>
	</thead>
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
            
			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>
				<tr class = "<?php echo esc_attr( apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
					
                    <td class="product-wrap">
                        <div class="product-thumbnail">
                        <?php
                            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                            if ( ! $_product->is_visible() ) {
                                echo $thumbnail;
                            } else {
                                if ( version_compare($venedor_woo_version, '2.3', '<') ) {
                                    printf('<a href="%s">%s</a>', $_product->get_permalink(), $thumbnail );
                                } else {
                                    printf('<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $thumbnail );
                                }
                            }
                        ?>
                        </div>
                        <div class="product-detail">
                            <div class="product-name">
						    <?php
							if ( ! $_product->is_visible() ) {
								echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
                            } else {
                                if ( version_compare($venedor_woo_version, '2.3', '<') ) {
    								echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink(), $_product->get_title() ), $cart_item, $cart_item_key );
                                } else {
                                    echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $_product->get_title() ), $cart_item, $cart_item_key );
                                }
                            }
                            ?>
                            </div>
                            <?php
							// Meta data
							echo WC()->cart->get_item_data( $cart_item );

                   			// Backorder notification
                   			if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
                   				echo '<p class="backorder_notification">' . __( 'Available on backorder', 'woocommerce' ) . '</p>';
						?>
                        </div>
					</td>

					<td class="product-price">
                        <span class="mobile-show"><?php _e('Price', 'woocommerce') ?>: </span>
						<?php
							echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						?>
					</td>

					<td class="product-quantity">
						<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								$product_quantity = woocommerce_quantity_input( array(
									'input_name'  => "cart[{$cart_item_key}][qty]",
									'input_value' => $cart_item['quantity'],
									'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
                                    'min_value'   => '0'
								), $_product, false );
							}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
						?>
					</td>

					<td class="product-subtotal">
                        <span class="mobile-show"><?php _e('Total', 'woocommerce') ?>: </span>
						<?php
							echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
						?>
                        <!-- Remove from cart link -->
                        <div class="product-remove">
                        <?php
                            echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                '<a href="%s" class="btn-arrow remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                esc_url( WC()->cart->get_remove_url( $cart_item_key )),
                                __( 'Remove this item', 'woocommerce' ),
                                esc_attr( $product_id ),
                                esc_attr( $_product->get_sku() )
                            ), $cart_item_key );
                        ?>
                        </div>
                    </td>
				</tr>
				<?php
			}
		}
		
        do_action( 'woocommerce_cart_contents' );
		?>
        <tr>
            <td colspan="4" class="actions clearfix" style="text-align: right">
                <button class="button btn-lg m-sm" value="<?php _e( 'Update Cart', 'woocommerce' ); ?>" name="update_cart" type="submit"><?php _e( 'Update Cart', 'woocommerce' ); ?></button>
                <?php
                ob_start();
                do_action( 'woocommerce_proceed_to_checkout' );
                $proceed_btn = ob_get_contents();
                ob_end_clean();
                echo str_replace('checkout-button', 'checkout-button btn-lg btn-special m-sm', $proceed_btn);
                ?>
            </td>
        </tr>
        
        <?php do_action( 'woocommerce_after_cart_contents' ); ?>
    </tbody>
</table>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

<div class="cart-collaterals">

    <div class="row">

        <?php if ( version_compare($venedor_woo_version, '2.3.8', '<') ) : ?>
        
        <div class="col-md-7">

            <?php if ( version_compare($venedor_woo_version, '2.3', '<') || is_cart() ) : ?>
                <?php woocommerce_shipping_calculator(); ?>
            <?php endif; ?>

            <?php if ( version_compare($venedor_woo_version, '2.5', '<') ? WC()->cart->coupons_enabled() : wc_coupons_enabled() ) { ?>

                <div class="coupon-code">

                    <h2><?php _e( 'Coupon code', 'woocommerce' ); ?></h2>
                    <div class="coupon">

                        <p class="form-row input-field">

                            <label for="coupon_code"><span class="fa fa-cut"></span><?php _e('Coupon code', 'woocommerce') ?> <span class="required">*</span></label>
                            <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php _e('Coupon code', 'woocommerce') ?>" />

                        </p>

                        <p class="clearfix button-row">
                            <button class="button btn-lg" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>" name="apply_coupon" type="submit"><?php _e( 'Apply Coupon', 'woocommerce' ); ?></button>
                        </p>

                        <?php do_action('woocommerce_cart_coupon'); ?>

                    </div>

                </div>

            <?php } ?>
            
        </div>

        <div class="col-md-5">
        
            <?php woocommerce_cart_totals(); ?>
            
            <div class="proceed-buttons button-row">

                <?php if ( version_compare($venedor_woo_version, '2.3', '<') ) { ?>

                    <button class="button btn-lg" value="<?php _e( 'Update Cart', 'woocommerce' ); ?>" name="update_cart" type="submit"><?php _e( 'Update Cart', 'woocommerce' ); ?></button>

                    <button class="button btn-special wc-forward btn-lg" value="<?php _e( 'Proceed to Checkout', 'woocommerce' ); ?>" name="proceed" type="submit"><?php _e( 'Proceed to Checkout', 'woocommerce' ); ?></button>
                
                    <?php do_action('woocommerce_proceed_to_checkout'); ?>

                <?php } else { ?>

                    <?php do_action( 'woocommerce_cart_actions' ); ?>

                <?php } ?>
            
            </div>
            
        </div>

        <?php else : ?>

            <?php if ( is_cart() ) : ?>
                <div class="col-md-6">
                    <?php woocommerce_shipping_calculator(); ?>
                </div>
            <?php endif; ?>

            <?php if ( WC()->cart->coupons_enabled() ) { ?>
                <div class="col-md-6">

                    <div class="coupon-code">

                        <h2><?php _e( 'Coupon code', 'woocommerce' ); ?></h2>
                        <div class="coupon">

                            <p class="form-row input-field">

                                <label for="coupon_code"><span class="fa fa-cut"></span><?php _e('Coupon code', 'woocommerce') ?> <span class="required">*</span></label>
                                <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php _e('Coupon code', 'woocommerce') ?>" />

                            </p>

                            <p class="clearfix button-row">
                                <button class="button btn-lg" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>" name="apply_coupon" type="submit"><?php _e( 'Apply Coupon', 'woocommerce' ); ?></button>
                            </p>

                            <?php do_action('woocommerce_cart_coupon'); ?>

                        </div>

                    </div>
                </div>
            <?php } ?>

        <?php endif; ?>
        
    </div>

	<?php do_action('woocommerce_cart_collaterals'); ?>

</div>

<?php wp_nonce_field( 'woocommerce-cart' ); ?>

</form>

<?php do_action( 'woocommerce_after_cart' ); ?>
