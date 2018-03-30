<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<ul class="cart_list product_list_widget <?php echo ! empty( $args['list_class'] ) ? $args['list_class'] : ''; ?>">

	<?php if ( ! WC()->cart->is_empty() ) : ?>

		<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					
					$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
					$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( apply_filters( 'aurum_mini_cart_thumb_size', 'shop_thumbnail' ) ), $cart_item, $cart_item_key );
					$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<li>
					<?php if ( ! $_product->is_visible() ) { ?>
						<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
					<?php } else { ?>
						<a href="<?php echo get_permalink( $product_id ); ?>" class="product-img">
							<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
						</a>
					<?php } ?>

						<div class="product-details">
							<a href="<?php echo get_permalink( $product_id ); ?>"><?php echo $product_name; ?></a>

							<?php echo WC()->cart->get_item_data( $cart_item ); ?>

							<?php if( get_data( 'shop_cart_show_quantity' ) ): ?>
								<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity block">' . sprintf( __('Quantity:', 'aurum') . ' %s &times; <span class="price">%s</span>', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
							<?php endif; ?>

							<div class="price-total">
								<?php echo WC()->cart->get_cart_subtotal(); ?>
							</div>
						</div>
					</li>
					<?php
				}
			}
		?>

	<?php else : ?>

		<li class="empty"><?php _e( 'No products in the cart.', 'aurum' ); ?></li>

	<?php endif; ?>

</ul><!-- end product list -->

<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<div class="cart-bottom">
		<div class="row">
			<div class="col-sm-6 omega">
				<a href="<?php echo WC()->cart->get_cart_url(); ?>" class="button btn btn-default btn-large btn-block wc-forward"><?php _e( 'View Cart', 'aurum' ); ?></a>
			</div>
			<div class="col-sm-6 alpha">
				<a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="button btn btn-primary btn-large btn-block checkout wc-forward"><?php _e( 'Checkout', 'aurum' ); ?></a>
			</div>
		</div>

		<p class="total">
			<strong><?php _e( 'Subtotal', 'aurum' ); ?>:</strong>
			<?php echo WC()->cart->get_cart_subtotal(); ?>
		</p>
	</div>


<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
