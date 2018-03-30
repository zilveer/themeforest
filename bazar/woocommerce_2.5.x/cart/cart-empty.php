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

<p><?php _e('Your cart is currently empty.', 'yit' ) ?></p>

<?php do_action('woocommerce_cart_is_empty'); ?>

<p><a class="button" href="<?php echo apply_filters( 'yit_empty_cart_redirect', get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"><?php _e('&larr; Return To Shop', 'yit') ?></a></p>
