<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $woocommerce;
?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>


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
					<div class="cart-item">
					
						<div class="featured-image">
							<?php if( has_post_thumbnail($product_id) ) {
								echo get_the_post_thumbnail( $product_id, 'thumbnail' ); 
								} else {
								echo woocommerce_placeholder_img( 'shop_thumbnail' );
								} ?>
							
						</div>
					<div class="item-content">
													<h6><a href="<?php echo get_permalink( $product_id ); ?>"><?php echo $product_name; ?></a></h6>
													<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="price">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
													
								
						<div class="remove-item">
								<?php
									echo apply_filters('woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="delete parent-color" title="%s">%s</a>', esc_url($woocommerce->cart->get_remove_url($cart_item_key)), __('Remove', 'candidate'), '<i class="icons remove-shopping-item icon-cancel-circled"></i>'), $cart_item_key);
								?>
														
						</div>
					</div>
	
					</div>
					<?php
				}
			}
		?>

	<?php else : ?>
		<div class="cart-item empty"><?php _e( 'No products in the cart.', 'candidate' ); ?></div>
		
	<?php endif; ?>


<?php if ( ! WC()->cart->is_empty() ) : ?>

	<div class="cart-item">
		<h6><?php _e( 'Cart subtotal', 'candidate' ); ?>: <?php echo WC()->cart->get_cart_subtotal(); ?></h6>
	</div>
	
	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<div class="cart-item">
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button wc-forward"><?php _e( 'View Cart', 'candidate' ); ?></a>
		<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button donate checkout wc-forward"><?php _e( 'Checkout', 'candidate' ); ?></a>
	</div>


<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>