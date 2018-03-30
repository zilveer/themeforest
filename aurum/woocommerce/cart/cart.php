<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.8
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

# start: modified by Arlind Nushi
$cart_items_count = WC()->cart->get_cart_contents_count();
# end: modified by Arlind Nushi

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

<div class="page-title">
	<div class="row">
		<div class="<?php echo WC()->cart->coupons_enabled() ? 'col-lg-6 col-md-6 col-sm-6' : 'col-sm-12'; ?>">
			<h1>
				<?php the_title(); ?>
				<small><?php echo sprintf( _n( "You've got one item in the cart", "You've got %d items in the cart", $cart_items_count, 'aurum' ), $cart_items_count); ?></small>
			</h1>
		</div>

		<?php
		if ( WC()->cart->coupons_enabled() ) {
			?>
			<div class="col-lg-6 col-md-6 col-sm-6">
				<?php get_template_part('tpls/woocommerce-coupon-form'); ?>
			</div>
			<?php
		} ?>
	</div>
</div>

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<table class="shop_table cart view-cart" cellspacing="0">
	<thead>
		<tr>
			<th class="product-name"><?php _e( 'Product', 'aurum' ); ?></th>
			<th></th>
			<th class="product-quantity"><?php _e( 'Quantity', 'aurum' ); ?></th>
			<th class="product-subtotal"><?php _e( 'Total', 'aurum' ); ?></th>
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

					<td class="item-image">
						<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove-item" title="%s"></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'aurum' ) ), $cart_item_key );
						?>
						<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( apply_filters( 'lab_wc_cart_image_size', 'shop-thumb-2' ) ), $cart_item, $cart_item_key );

							if ( ! $_product->is_visible() )
								echo $thumbnail;
							else
								printf( '<a href="%s">%s</a>', $_product->get_permalink($cart_item), $thumbnail );
						?>
					</td>

					<td>
						<h3>
							<?php
								if ( ! $_product->is_visible() )
									echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
								else
									echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink($cart_item), $_product->get_title() ), $cart_item, $cart_item_key );
							?>
						</h3>

						<?php
						# start: modified by Arlind Nushi
						echo '<span class="price">';
							echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						echo '</span>';
						# end: modified by Arlind Nushi

						// Meta data
						echo WC()->cart->get_item_data( $cart_item );

           				// Backorder notification
           				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
           					echo '<p class="backorder_notification">' . __( 'Available on backorder', 'aurum' ) . '</p>';
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

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
						?>
					</td>

					<td class="product-subtotal price">
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
		<tr class="hidden">
			<td colspan="6" class="actions">

				<input type="submit" class="button" name="update_cart" value="<?php _e( 'Update Cart', 'aurum' ); ?>" />
				<input type="submit" class="checkout-button button alt wc-forward" name="proceed" value="<?php _e( 'Proceed to Checkout', 'aurum' ); ?>" />

				<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>

				<?php wp_nonce_field( 'woocommerce-cart' ); ?>
			</td>
		</tr>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>

<div class="row cart-bottom-details">

	<div class="col-md-offset-8 col-md-4">

		<div class="cart-collaterals">

			<?php do_action( 'woocommerce_cart_collaterals' ); ?>

			<?php #woocommerce_cart_totals(); ?>

			<div class="row cart-totals">
				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
					<a class="btn btn-default btn-lg btn-block" href="#update-cart" id="update-cart-btn"><?php _e('Update Cart', 'aurum'); ?></a>
				</div>

				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-6">
					<a class="btn btn-primary btn-lg btn-block" href="#proceed" id="proceed-to-checkout"><?php _e('Checkout', 'aurum'); ?></a>
				</div>
			</div>

		</div>

		<?php woocommerce_shipping_calculator(); ?>

	</div>
</div>

<?php do_action( 'woocommerce_cart_actions' ); ?>

<?php do_action( 'woocommerce_after_cart' ); ?>
