<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if (version_compare( WOOCOMMERCE_VERSION, "2.1.0" ) >= 0) {
wc_print_notices();
}

?>

<h4><?php _e( 'Your Shopping Bag is empty', 'swiftframework' ) ?></h4>

<p class="no-items"><?php _e( 'You currently have no items in your Shopping Bag.', 'swiftframework' ) ?></p>

<?php do_action('woocommerce_cart_is_empty'); ?>

<?php if (version_compare( WOOCOMMERCE_VERSION, "2.1.0" ) >= 0) { ?>
<a class="continue-shopping" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><?php _e( 'Continue shopping', 'swiftframework' ) ?></a>
<?php } else { ?>
<a class="continue-shopping" href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>"><?php _e( 'Continue shopping', 'swiftframework' ) ?></a>
<?php } ?>
