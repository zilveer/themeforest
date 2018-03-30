<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/woocommerce/cart/empty.php
 * @sub-package WooCommerce/Templates/cart/empty.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<div class="panel">
	<p><?php _e('Your cart is currently empty.', 'woocommerce') ?></p>
</div>

<?php do_action('woocommerce_cart_is_empty'); ?>

<p class="submit-changes text-center">
	<a class="button large" href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>"><em class="icon-left-open"></em> <?php _e('Return To Shop', 'woocommerce') ?></a>
</p>