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

?>

<div class="col2-set" id="customer_login">

<?php
wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<table class="shop_table cart" cellspacing="0">
	<thead>
		<tr>
			<th class="product-name"><?php _e( 'Product', LANGUAGE_ZONE ); ?></th>
			<th class="product-price"><?php _e( 'Price', LANGUAGE_ZONE ); ?></th>
			<th class="product-quantity"><?php _e( 'Quantity', LANGUAGE_ZONE ); ?></th>
			<th class="product-subtotal"><?php _e( 'Total', LANGUAGE_ZONE ); ?></th>
            <th class="product-remove">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">



					<td class="product-thumbnail">
						<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

							if ( ! $_product->is_visible() )
								echo $thumbnail;
							else
								printf( '<a href="%s">%s</a>', $_product->get_permalink(), $thumbnail );
						?>

                        <div class="product-info">
						<?php
							if ( ! $_product->is_visible() )
								echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
							else
								echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink(), $_product->get_title() ), $cart_item, $cart_item_key );

							// Meta data
							echo WC()->cart->get_item_data( $cart_item );

               				// Backorder notification
               				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
               					echo '<p class="backorder_notification">' . __( 'Available on backorder', LANGUAGE_ZONE ) . '</p>';
						?>
                        </div>
					</td>

					<td class="product-price">
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
								), $_product, false );
							}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
						?>
					</td>

					<td class="product-subtotal">
						<?php
							echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
						?>
					</td>

                    <td class="product-remove">
                        <?php
                        echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s">&times;</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', LANGUAGE_ZONE ) ), $cart_item_key );
                        ?>
                    </td>

				</tr>
				<?php
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

    <div class="cart-collaterals clearfix">

        <div class="col-sm-6 row-left">
            <div class="woocommerce-content-box full-width">
            
            	<?php woocommerce_shipping_calculator(); ?>
	    		
	    		<?php if ( WC()->cart->coupons_enabled() ) { ?>
	                <h2><?php _e('Have A Promotional Code?',LANGUAGE_ZONE); ?></h2>
	
	                <div class="coupon">
	
	                    <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php _e( 'Coupon code', LANGUAGE_ZONE ); ?>" />
	                    <input type="submit" class="button btn btn-default small" name="apply_coupon" value="<?php _e( 'Apply', LANGUAGE_ZONE ); ?>" />
	
	                    <?php do_action( 'woocommerce_cart_coupon' ); ?>
	
	                    <div class="clear"></div>
	                </div>
                <?php } ?>

            </div>

        </div>

        <div class="woocommerce-content-box col-sm-6 row-right">

            <div class="cart-totals-container">

	            <?php do_action( 'woocommerce_cart_collaterals' ); ?>

                <button type="submit" class="button small btn btn-default" name="update_cart" value="<?php _e( 'Update Cart', LANGUAGE_ZONE ); ?>"><i class="fa fa-undo"></i> <?php _e( 'Update Cart', LANGUAGE_ZONE ); ?></button>
                <button type="submit" class="checkout-button button alt wc-forward small btn btn-default" name="proceed" value="<?php _e( 'Proceed to Checkout', LANGUAGE_ZONE ); ?>"><i class="fa fa-angle-right"></i> <?php _e( 'Proceed to Checkout', LANGUAGE_ZONE ); ?></button>

                <?php do_action( 'woocommerce_cart_actions' ); ?>

                <?php wp_nonce_field( 'woocommerce-cart' ); ?>

                <div class="clear"></div>

            </div>

        </div>

    </div>

</form>

<?php do_action( 'woocommerce_after_cart' ); ?>
</div>