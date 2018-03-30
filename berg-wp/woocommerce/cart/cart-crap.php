<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     19.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<header class="section-header"><h2><?php _e( 'Cart', 'woocommerce' ); ?></h2></header>

<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

<div class="container-fluid">
	<div class="row">
		<div class="cart-products">
			<div class="container">
				<div class="row cart-header">
					<div class="col-xs-4 col-sm-5">
						<h5 class="product-name"><?php _e('Product name', 'woocommerce'); ?></h5>
					</div>
					<div class="col-xs-2">
						<h5 class="product-price"><?php _e('Unit price', 'woocommerce'); ?></h5>
					</div>
					<div class="col-xs-2">
						<h5 class="product-quantity"><?php _e('Quantity', 'woocommerce'); ?></h5>
					</div>
					<div class="col-xs-2">
						<h5 class="product-subtotal"><?php _e('Subtotal', 'woocommerce'); ?></h5>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>
			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
			?>
			<div class="row cart-item">
				<div class="col-xs-4 col-sm-5 product-name">
					<?php
					$thumbnail = apply_filters( 'woocommerce_in_cart_product_thumbnail', $_product->get_image(''), $cart_item, $cart_item_key );
					?>
					<a href="<?php echo $_product->get_permalink(); ?>" class="product-thumbnail"><?php echo get_the_post_thumbnail( $_product->id, 'shop_thumbnail'); ?></a>
					<?php
						if (! $_product->is_visible()) {
							echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
						} else {
							echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a class="name" href="%s">%s</a>', $_product->get_permalink(), $_product->get_title() ), $cart_item, $cart_item_key );
						}

						// Meta data
						echo WC()->cart->get_item_data( $cart_item );

						// Backorder notification
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
							echo '<p class="backorder_notification">' . __( 'Available on backorder', 'woocommerce' ) . '</p>';
						}
					?>
				</div>

				<div class="col-xs-2 product-position product-price">
					<span class="amount"><?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?></span>		
				</div>

				<div class="col-xs-2 product-position product-quantity">
					<?php
						if ($_product->is_sold_individually()) {
							$product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
						} else {
							$product_quantity = woocommerce_quantity_input(array(
								'input_name'  => "cart[{$cart_item_key}][qty]",
								'input_value' => $cart_item['quantity'],
								'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
								'min_value'   => '0'
							), $_product, false);
						}

						echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key);
					?>
				</div>

				<div class="col-xs-2 product-position product-subtotal">
					<span class="amount">
					<?php
						echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key);
					?>
					</span>
				</div>

				<div class="col-xs-1 product-position product-remove">
					<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s"><i class="icon-close"></i></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key ); ?>
				</div>
			</div>


			<?php } ?>

			<?php if ( WC()->cart->coupons_enabled() ) : ?>
			<div class="row cart-buttons">
				<div class="col-xs-12">
					<div class="coupon-code">
						<input name="coupon_code" id="coupon_code" type="text" placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>" class="form-control">
						<input type="submit" class="btn btn-dark-o button" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>" />

						<?php do_action('woocommerce_cart_coupon'); ?>

					</div>
					<div class="product-btn"> 
						<a href="#" class="btn btn-color"><?php _e( 'Proceed to checkout', 'woocommerce' ); ?></a>
					</div>
				</div>
			</div>
			<?php endif; ?>
			
			<?php woocommerce_cart_totals(); ?>

		</div>
	</div>

</div>

</form>

<div class="cart-collaterals">

	<?php do_action( 'woocommerce_cart_collaterals' ); ?>

	<?php woocommerce_cart_totals(); ?>

	<?php woocommerce_shipping_calculator(); ?>

</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
