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

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<table class="shop_table cart" cellspacing="0">
	<thead>
		<tr>
			<th class="product-name"><?php _e( 'Product', 'krown' ); ?></th>
			<th class="product-price"><?php _e( 'Price', 'krown' ); ?></th>
			<th class="product-quantity"><?php _e( 'Quantity', 'krown' ); ?></th>
			<th class="product-subtotal"><?php _e( 'Total', 'krown' ); ?></th>
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

						<!-- Product Name -->
						<td class="product-name">

							<?php

								$img_url = wp_get_attachment_image_src($_product->get_image_id(), 'medium');

								$retina = krown_retina();
								$img_obj = $retina === 'true' ? aq_resize($img_url[0], '120', '120', true, false) : aq_resize($img_url[0], '60', '60', true, false);

								$image = '<img src="' . $img_obj[0] . '" width="' . $img_obj[1] . '" height="' . $img_obj[2] . '" alt="" />';

								echo $image;

							?>

							<?php

							if ( ! $_product->is_visible() )
								echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
							else
								echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $_product->get_title() ), $cart_item, $cart_item_key );

							// Meta data
							echo WC()->cart->get_item_data( $cart_item );

                   			// Backorder notification
               				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
               					echo '<p class="backorder_notification">' . __( 'Available on backorder', 'krown' ) . '</p>';
							?>

						</td>

						<!-- Product price -->
						<td class="product-price">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							?>
						</td>

						<!-- Quantity inputs -->
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

						<!-- Product subtotal -->
						<td class="product-subtotal">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
							?>
						</td>


						<!-- Remove from cart link -->
						<td class="product-remove">
							<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s">&times;</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'krown' ) ), $cart_item_key );
							?>
						</td>

					</tr>
					<?php
				}
			}

		do_action( 'woocommerce_cart_contents' );
			?>
			</tbody>
		</table>

		<div class="krown-column-row wooc clearfix" style="padding-top:0; margin-top:-50px">

			<div class="krown-column-container span6 clearfix" style="padding-right:40px">

			<?php if ( WC()->cart->coupons_enabled() ) { ?>

				<div class="coupon clearfix">

					<input name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php _e( 'Coupon code', 'krown' ); ?>" style="width: auto;height: 48px;" /> <input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'krown' ); ?>" style="border: 1px solid transparent !important; top: -2px; position: relative; height: 47px; left: 10px;" />

					<?php do_action('woocommerce_cart_coupon'); ?>

				</div>

			<?php } ?>
		
			</div>

			<div class="krown-column-container span6 clearfix" style="padding-left:40px">

				<button type="submit" name="update_cart" value="1" class="update-button button" style="float: right; position: relative; height: 46px;"><?php _e( 'Update Cart', 'krown' ); ?></button>

				<?php do_action( 'woocommerce_cart_actions' ); ?>
				<?php wp_nonce_field( 'woocommerce-cart' ); ?>

			</div>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>

		</div>

	</form>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

<div class="cart-collaterals">

	<h3><?php _e('Cart Total', 'krown'); ?></h3>
	<?php do_action('woocommerce_cart_collaterals'); ?>

</div>

<?php do_action( 'woocommerce_after_cart' ); ?>