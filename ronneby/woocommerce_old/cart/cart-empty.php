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

<div class="cart-empty-page">
	
	<h1><?php _e('Empty', 'dfd'); ?></h1>
	
	<p class="cart-empty-text"><?php _e( 'Your cart is currently', 'dfd' ) ?></p>
	
	<p class="cart-empty-subtext"><?php _e( 'You may check out all the available products and buy some in the shop.', 'dfd' ) ?></p>

	<?php do_action( 'woocommerce_cart_is_empty' ); ?>

	<p class="return-to-shop"><a class="button wc-backward" href="<?php echo apply_filters( 'woocommerce_return_to_shop_redirect', get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"><?php _e( 'Return To Shop', 'dfd' ) ?></a></p>

</div>