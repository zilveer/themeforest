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

?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

	<?php if ( ! WC()->cart->is_empty() ) : ?>

		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="cart_list product_list_widget <?php echo $args['list_class']; ?>">

		<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

					$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
					$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
					$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					?>
					
					<tr>
						
						<td class="product-thumbnail">

							<?php if ( ! $_product->is_visible() ) : ?>
								<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
							<?php else : ?>
								<a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>">
									<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
								</a>
							<?php endif; ?>

						</td>
                        
                        <td class="product-name">                        
                            <?php if ( ! $_product->is_visible() ) : ?>
								<?php echo $product_name; ?>
							<?php else : ?>
								<a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>">
									<?php echo $product_name; ?>
								</a>
							<?php endif; ?>                  
                            <?php echo WC()->cart->get_item_data( $cart_item ); ?>
                            <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
                        </td>
                        
                        <td class="product-remove">
							<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
								'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
								esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
								__( 'Remove this item', 'woocommerce' ),
								esc_attr( $product_id ),
								esc_attr( $_product->get_sku() )
							), $cart_item_key );
							?>
                        </td>

					</tr>
					
					<?php
				}
			}
		?>

		</table><!-- end product list -->

	<?php else : ?>

		<style>
			#minicart-offcanvas h2 { display: none; }
		</style>

		<div class="cart-empty-offcanvas-banner offcanvas-empty-banner">
			<span id="empty-cart-offcanvas-box"></span>
		</div>
		
		<p class="cart-empty-text offcanvas-empty-text"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></p>

	<?php endif; ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>

	<p class="total"><strong class="subtotal_name"><?php _e( 'Subtotal', 'woocommerce' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<p class="buttons">
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button view_cart wc-forward"><?php _e( 'View Cart', 'woocommerce' ); ?></a>
		<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button checkout wc-forward"><?php _e( 'Checkout', 'woocommerce' ); ?></a>
	</p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
