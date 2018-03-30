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
<div class="row">
	<div class="col-md-8">
		<h3 class="woo-cart-title"><?php esc_html_e( 'Your shopping cart', 'jakiro' ); ?></h3>
		<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">
		
		<?php do_action( 'woocommerce_before_cart_table' ); ?>
		
		<table class="table shop_table cart" cellspacing="0">
			<thead>
				<tr>
					<th class="product-remove">&nbsp;</th>
					<th class="product-thumbnail hidden-xs">&nbsp;</th>
					<th class="product-name"><?php esc_html_e( 'Product', 'jakiro' ); ?></th>
					<th class="product-price text-center"><?php esc_html_e( 'Price', 'jakiro' ); ?></th>
					<th class="product-quantity text-center"><?php esc_html_e( 'Quantity', 'jakiro' ); ?></th>
					<th class="product-subtotal text-center hidden-xs"><?php esc_html_e( 'Total', 'jakiro' ); ?></th>
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
		
							<td class="product-remove">
								<?php
									echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s">&times;</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), esc_html__( 'Remove this item', 'jakiro' ) ), $cart_item_key );
								?>
							</td>
		
							<td class="product-thumbnail hidden-xs">
								<?php
									$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
		
									if ( ! $_product->is_visible() )
										echo ($thumbnail);
									else
										printf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $thumbnail );
								?>
							</td>
		
							<td class="product-name">
								<?php
									if ( ! $_product->is_visible() )
										echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
									else
										echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $_product->get_title() ), $cart_item, $cart_item_key );
		
									// Meta data
									echo WC()->cart->get_item_data( $cart_item );
		
		               				// Backorder notification
		               				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
		               					echo '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'jakiro' ) . '</p>';
								?>
							</td>
		
							<td class="product-price text-center">
								<?php
									echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
								?>
							</td>
		
							<td class="product-quantity text-center">
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
		
									echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
								?>
							</td>
		
							<td class="product-subtotal hidden-xs text-center">
								<?php
									echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
								?>
							</td>
						</tr>
						<?php
					}
				}
		
				do_action( 'woocommerce_cart_contents' );
				?>
				<tr>
					<td colspan="6" class="actions">
						<a class="button btn woocommerce-contine-shoppong-btn" href="<?php echo esc_url(wc_get_page_permalink( 'shop' ))?>"><?php esc_html_e('Continue Shopping','jakiro') ?></a>
						<input type="submit" class="button update-cart-button" name="update_cart" value="<?php esc_html_e( 'Update Cart', 'jakiro' ); ?>" />
		
						<?php do_action( 'woocommerce_cart_actions' ); ?>
		
						<?php wp_nonce_field( 'woocommerce-cart' ); ?>
					</td>
				</tr>
		
				<?php do_action( 'woocommerce_after_cart_contents' ); ?>
			</tbody>
		</table>
		
		<?php do_action( 'woocommerce_after_cart_table' ); ?>
		
		</form>

		<?php if ( is_cart() ) : ?>
			<?php if(defined('WOOCOMMERCE_VERSION') && dh_get_theme_option('woo-cart-cross-sells',1)):?>
				<?php woocommerce_shipping_calculator(); ?>
			<?php endif; ?>
		<?php endif; ?>

		<div class="cart-cross-sell hidden-xs">
			<?php woocommerce_cross_sell_display( 3, 3 )?>
		</div>

	</div>
	<div class="col-md-4">
		<?php if ( WC()->cart->coupons_enabled() ) { ?>
			<h3 class="woo-cart-title"><?php esc_html_e( 'Coupon codes', 'jakiro' ); ?></h3>
			<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">
				<div class="coupon">

					<label for="coupon_code"><?php esc_html_e( 'Coupon', 'jakiro' ); ?>:</label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_html_e( 'Coupon code', 'jakiro' ); ?>" /> <input type="submit" class="button" name="apply_coupon" value="<?php esc_html_e( 'Apply Coupon', 'jakiro' ); ?>" />

					<?php do_action( 'woocommerce_cart_coupon' ); ?>

				</div>
				
			</form>
		<?php } ?>
		<div class="cart-collaterals">
			<?php do_action( 'woocommerce_cart_collaterals' ); ?>
		
		</div>
	</div>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
