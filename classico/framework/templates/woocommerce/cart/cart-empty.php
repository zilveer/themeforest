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

<?php do_action('woocommerce_cart_is_empty'); ?>

<div class="empty-cart-block">
	<i class="icon-shopping-cart"></i>
	
	<?php etheme_option('empty_cart_content'); ?>	
	<p><a class="btn active big filled" href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>"><span><?php _e('Return To Shop', ET_DOMAIN) ?></span></a></p>
	
</div>