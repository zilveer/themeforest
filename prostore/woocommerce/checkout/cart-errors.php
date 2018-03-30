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
 * @package 	proStore/woocommerce/checkout/cart-errors.php
 * @sub-package WooCommerce/Templates/checkout/cart-errors.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php $woocommerce->show_messages(); ?>

<ul class="woocommerce_message alert alert-box">
	<li><span class="alert-color"><em class="icon-cancel"></em></span></li>
	<li><p><?php _e('There are some issues with the items in your cart (shown above). Please go back to the cart page and resolve these issues before checking out.', 'woocommerce') ?></p>
</li>
</ul>

<?php do_action('woocommerce_cart_has_errors'); ?>

<p class="submit-changes text-center"><a class="button large" href="<?php echo get_permalink(woocommerce_get_page_id('cart')); ?>"><?php _e('&larr; Return To Cart', 'woocommerce') ?></a></p>