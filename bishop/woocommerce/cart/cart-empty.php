<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<div class="cart-empty col-sm-12">


    <div class="empty-img"><img src="<?php echo get_template_directory_uri() ?>/images/cart-empty.png" /></div>

    <div class="empty-message"><p><?php _e( 'Your shopping bag is currently empty.', 'yit' ) ?></p></div>

    <?php do_action( 'woocommerce_cart_is_empty' ); ?>

    <div class="empty-button"><p>
            <a class="btn btn-alternative" href="<?php echo apply_filters( 'woocommerce_return_to_shop_redirect', get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"><?php _e( 'Start To Shop', 'yit' ) ?></a>
        </p></div>

</div>