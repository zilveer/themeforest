<?php
/**
 * ADD TO CART DROPDOWN (gets inserted with ajax)
 *
 * @package Organique
 */

add_filter('woocommerce_add_to_cart_fragments', 'organique_add_to_cart_fragments');
function organique_add_to_cart_fragments( $fragments ) {
	$fragments['.js--cart-container'] = organique_add_to_cart_dropdown();
	return $fragments;
}

function organique_add_to_cart_dropdown() {
	ob_start();

	?>

	<div class="header-cart  js--cart-container">
		<span class="header-cart__text--price"><span class="header-cart__text"><?php _e( 'CART', 'organique_wp' ); ?></span> <?php echo WC()->cart->get_cart_subtotal(); ?></span>
		<a href="<?php echo WC()->cart->get_cart_url(); ?>" class="header-cart__items">
			<span class="header-cart__items-num"><?php echo WC()->cart->cart_contents_count; ?></span>
		</a>
		<!-- Open cart panel -->
		<div class="header-cart__open-cart">

			<?php
				if ( 0 === sizeof( WC()->cart->cart_contents ) ) :
					echo '<p class="header-cart__empty">' . __( 'No products in the cart.', 'organique_wp' ) . '</p>';
				else :
					foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) :
						$_product = $values['data'];
						if ( $_product->exists() && $values['quantity'] > 0 ) :
			?>

			<div class="header-cart__product  clearfix  js--cart-remove-target">
				<div class="header-cart__product-image">
					<?php
						$thumbnail = $_product->get_image( 'small-product-in-cart' );

						if ( ! $_product->is_visible() ) {
							echo $thumbnail;
						} else {
							printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), $thumbnail );
						}
					?>
				</div>
				<div class="header-cart__product-image--hover">
					<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="js--remove-item" title="%s"><span class="glyphicon  glyphicon-circle  glyphicon-remove"></span></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), _x( 'Remove this item', 'removing the item/product form the cart', 'organique_wp' ) ), $cart_item_key ); ?>
				</div>
				<div class="header-cart__product-title">
					<?php
						if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) ) {
							echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key );
						} else {
							printf('<a class="header-cart__link" href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), apply_filters('woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key ) );
						}

						// Backorder notification
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $values['quantity'] ) ) {
							echo '<p class="backorder_notification">' . __( 'Available on backorder', 'organique_wp' ) . '</p>';
						}
					?>
					<span class="header-cart__qty"><?php _e( 'Qty:', 'organique_wp' ); ?> <?php echo $values['quantity']; ?></span>
				</div>
				<div class="header-cart__price">
					<?php
						$product_price = get_option('woocommerce_tax_display_cart') == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();

						echo apply_filters('woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $values, $cart_item_key );
					?>
				</div>
			</div>

			<?php
						endif; // $_product->exists() && $values['quantity'] > 0
					endforeach; // WC()->cart->get_cart() as $cart_item_key => $values
			?>

			<hr class="header-cart__divider">

			<div class="header-cart__subtotal-box">
				<span class="header-cart__subtotal"><?php _e( 'CART SUBTOTAL:', 'organique_wp' ); ?></span>
				<span class="header-cart__subtotal-price"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
			</div>
			<a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="btn btn-darker"><?php _e( 'Proceed to checkout', 'organique_wp' ); ?></a>

			<?php
				endif; // 0 === sizeof( WC()->cart->cart_contents )
			?>
		</div>
	</div>

	<?php

	$html = ob_get_clean();

	return $html;
}