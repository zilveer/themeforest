<?php
/**
 * Side Area Mini-cart
 *
 * Contains the markup for the mini-cart, used by the sidearea cart
 *
 * @author 	Greatives Team
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<div class="grve-scroller">
	<ul class="grve-mini-cart <?php echo esc_attr( $args['list_class'] ); ?>">

		<?php if ( ! WC()->cart->is_empty() ) : ?>

			<?php
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

						$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
						$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
						$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						?>
						<li class="grve-cart-item grve-border">

							<a class="grve-product-thumb" href="<?php echo esc_url( get_permalink( $product_id ) ); ?>">
								<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
							</a>
							<div class="cart-item-content">
								<a class="grve-link-text" href="<?php echo esc_url( get_permalink( $product_id ) ); ?>"><?php echo wp_kses_post($product_name); ?></a>
								<?php echo WC()->cart->get_item_data( $cart_item ); ?>
								<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
							</div>
						</li>
						<?php
					}
				}
			?>

		<?php else : ?>

			<li class="grve-empty-cart">
				<div class="grve-empty-icon-wrapper">
					<i class="grve-icon-close-sm grve-text-primary-1"></i>
					<i class="grve-icon-cart"></i>
				</div>
				<div class="grve-h6"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></div>
				<a class="grve-link-text" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>"><?php esc_html_e( 'Return To Shop', 'woocommerce' ) ?></a>
			</li>

		<?php endif; ?>

	</ul><!-- end product list -->
</div>

<?php if ( ! WC()->cart->is_empty() ) : ?>
<div class="grve-buttons-wrapper">
	<div class="grve-cart-total grve-h6"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?> : <?php echo WC()->cart->get_cart_subtotal(); ?></div>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<div class="grve-total-btn">
		<a class="grve-btn grve-woo-btn grve-fullwidth-btn grve-bg-grey grve-bg-hover-black" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>"><span><?php esc_html_e( 'View Cart', 'woocommerce' ); ?></span></a>
		<a class="grve-btn grve-woo-btn grve-fullwidth-btn grve-bg-primary-1 grve-bg-hover-black" href="<?php echo esc_url( WC()->cart->get_checkout_url() ); ?>"><span><?php esc_html_e( 'Checkout', 'woocommerce' ); ?></span></a>
	</div>
</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' );
	
//Omit closing PHP tag to avoid accidental whitespace output errors.
