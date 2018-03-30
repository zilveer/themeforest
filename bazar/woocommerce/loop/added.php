<?php
/**
 * Loop Price
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $product;
?>

<a class="added button alt cart" href="<?php echo get_permalink(wc_get_page_id('cart')) ?>" title="<?php echo apply_filters( 'yit_view_cart_label', __('View Cart', 'yit') ); ?>"><?php echo apply_filters( 'yit_added_to_cart_text', __( 'ADDED', 'yit' ) ) ?></a>