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
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wp;
$g5plus_options = &G5Plus_Global::get_options();

$current_url = home_url(add_query_arg(array(),$wp->request));
$both_button = '';
if (isset($g5plus_options['header_shopping_cart_button'])
	&& ($g5plus_options['header_shopping_cart_button']['view-cart'] == '1')
	&& ($g5plus_options['header_shopping_cart_button']['checkout'] == '1')) {
	$both_button = 'both-buttons';
}
$total_item = sizeof( WC()->cart->get_cart());

if (!isset($args) || !isset($args['list_class'])) {
	$args['list_class'] = '';
}
$cart_list_sub_class = array();
$cart_list_sub_class[] = 'cart_list_wrapper';
if ( sizeof( WC()->cart->get_cart() ) > 0 ) {
	$cart_list_sub_class[] = 'has-cart';
}

if ($total_item > 3) {
	$cart_list_sub_class[] = 'large-size';
}

?>
<?php do_action( 'woocommerce_before_mini_cart' ); ?>
<div class="widget_shopping_cart_icon">
	<i class="fa fa-shopping-cart"></i>
	<span class="total"><?php echo esc_html($total_item); ?></span>
</div>
<div class="<?php g5plus_the_attr_value($cart_list_sub_class) ?>">
	<ul class="cart_list product_list_widget <?php echo esc_attr($args['list_class']); ?>">
		<?php if ( ! WC()->cart->is_empty() ): ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

					$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
					$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('thumbnail'), $cart_item, $cart_item_key );
					$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

					?>
					<li>
						<div class="cart-left">
							<?php if ( ! $_product->is_visible() ) { ?>
								<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ); ?>
							<?php } else { ?>
								<a href="<?php echo get_permalink( $product_id ); ?>">
									<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) ?>
								</a>
							<?php } ?>
						</div>
						<div class="cart-right">
							<?php if ( ! $_product->is_visible() ) { ?>
								<?php echo esc_html($product_name); ?>
							<?php } else { ?>
								<a href="<?php echo get_permalink( $product_id ); ?>">
									<?php echo esc_html($product_name); ?>
								</a>
							<?php } ?>
							<?php echo WC()->cart->get_item_data( $cart_item ); ?>

							<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>

							<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="mini-cart-remove" title="%s"><i class="fa fa-remove"></i></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), esc_html__( 'Remove this item', 'woocommerce' ) ), $cart_item_key );?>
						</div>
					</li>
				<?php
				}
			}
			?>

		<?php else : ?>
			<li class="empty">
				<h4><?php esc_html_e( 'An empty cart', 'g5plus-academia' ); ?></h4>
				<p><?php esc_html_e( 'You have no item in your shopping cart', 'g5plus-academia' ); ?></p>
			</li>
		<?php endif; ?>

	</ul><!-- end product list -->

	<?php if ( ! WC()->cart->is_empty() )  : ?>
		<div class="mini-cart-footer clearfix">
			<div class="cart-total clearfix">
				<div class="cart-total-left">
					<a href="<?php echo esc_url($current_url); ?>?empty-cart">
						<i class="fa fa-remove"></i>
						<span><?php esc_html_e('Empty Cart', 'g5plus-academia'); ?></span>
					</a>
				</div>
				<div class="cart-total-right">
					<p class="total"><strong><?php esc_html_e( 'Sub Total', 'g5plus-academia' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>
				</div>
			</div>
			<div class="cart-button-wrapper">
				<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>
				<p class="buttons <?php echo esc_attr($both_button) ?>">
					<?php if (isset($g5plus_options['shopping_cart_button']) && ($g5plus_options['shopping_cart_button']['view-cart'] == '1')):?>
						<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button wc-forward"><i class="fa fa-shopping-cart"></i> <?php esc_html_e( 'View Cart', 'g5plus-academia' ); ?></a>
					<?php endif; ?>
					<?php if (isset($g5plus_options['shopping_cart_button']) && ($g5plus_options['shopping_cart_button']['checkout'] == '1')):?>
						<a href="<?php echo esc_url( wc_get_checkout_url()); ?>" class="button checkout wc-forward"><?php esc_html_e( 'Checkout', 'g5plus-academia' ); ?></a>
					<?php endif; ?>
				</p>
			</div>
		</div>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_mini_cart' ); ?>
</div>