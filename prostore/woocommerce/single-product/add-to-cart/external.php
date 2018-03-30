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
 * @package 	proStore/woocommerce/single-product/add-to-cart/external.php
 * @sub-package WooCommerce/Templates/single-product/add-to-cart/external.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php do_action('woocommerce_before_add_to_cart_button'); ?>

<p class="cart text-center clearfix"><a href="<?php echo $product_url; ?>" rel="nofollow" class="single_add_to_cart_button button alt"><em class="icon-forward"></em> <?php echo apply_filters('single_add_to_cart_text', $button_text, 'external'); ?></a></p>

<?php do_action('woocommerce_after_add_to_cart_button'); ?>