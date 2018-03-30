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

<style>
	.page-title { display: none; }
</style>

<div class="row">
	<div class="large-10 text-center large-centered columns">

		<div class="cart-empty-banner cart-wishlist-empty-banner">
			<img id="cart-empty-img" alt="cart-empty-image"  width="194" height="156"  src="<?php echo get_template_directory_uri() . '/images/empty_cart.png'; ?>" data-interchange="[<?php echo get_template_directory_uri() . '/images/empty_cart.png'; ?>, (default)], [<?php echo get_template_directory_uri() . '/images/empty_cart_retina.png'; ?>, (retina)]">
		</div>
		
		<p class="cart-empty cart-wishlist-empty"><?php _e( 'Your cart is currently empty.', 'woocommerce' ) ?></p>
		
		<?php do_action( 'woocommerce_cart_is_empty' ); ?>
		
		<p class="return-to-shop"><a class="wc-backward" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><?php _e( 'Return To Shop', 'woocommerce' ) ?></a></p>

	</div><!-- .large-10-->
</div><!-- .row-->