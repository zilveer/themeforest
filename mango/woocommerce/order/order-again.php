<?php
/**
 * Order again button
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<p class="order-again">
	<a href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'order_again', $order->id ) , 'woocommerce-order_again' ) ); ?>" class="button btn btn-custom4 btn-md min-width text-uppercase"><?php _e( 'Order Again', 'woocommerce' ); ?></a>
</p>