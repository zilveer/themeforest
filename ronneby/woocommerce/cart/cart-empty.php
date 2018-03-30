<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wc_print_notices();

?>

<div class="cart-empty-page row">
	<div class="info-wrap-empty">
		<h1 class="info-background-empty"><?php _e('Oops', 'dfd'); ?></h1>
		<div class="info-content-empty">
			<div class="icon-empty">
				<i class="dfd-icon-trolley_close"></i>
			</div>
			<div class="info-empty">
				<p class="cart-empty-text"><?php _e( 'Your cart is empty', 'dfd' ) ?></p>
				<p class="cart-empty-subtext"><?php _e( 'You may check out all the available products and buy some in the shop.', 'dfd' ) ?></p>
				<?php do_action( 'woocommerce_cart_is_empty' ); ?>
				<p class="button-on-page"><a class="wc-backward" href="<?php echo apply_filters( 'woocommerce_return_to_shop_redirect', get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"><?php _e( 'Return to shop', 'dfd' ) ?></a></p>
			</div>
		</div>
	</div>
	<div class="container-shortcodes">
		<?php echo do_shortcode('[top_rated_products per_page="4" columns="4"]') ?>
	</div>
</div>