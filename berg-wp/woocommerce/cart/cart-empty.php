<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     19.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wc_print_notices();

?>

	<hr/>
<h2 class="cart-empty text-center" style="margin-top: 0; "><?php _e( 'Your cart is currently empty.', 'woocommerce' ) ?></h2>

<?php do_action( 'woocommerce_cart_is_empty' ); ?>

<p class="return-to-shop text-center"><a class="button wc-backward btn btn-md btn-color" href="<?php echo apply_filters( 'woocommerce_return_to_shop_redirect', get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"><?php _e( 'Return To Shop', 'woocommerce' ) ?></a></p>
<hr/>
