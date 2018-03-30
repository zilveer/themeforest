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
 * @package 	proStore/woocommerce/single-product/sale-flash.php
 * @sub-package WooCommerce/Templates/single-product/sale-flash.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php global $post, $product; ?>
<?php if ($product->is_on_sale()) : ?>
	<?php if(is_single()) $class = "single_sale"; ?>
	
	<?php echo apply_filters('woocommerce_sale_flash', '<span class="onsale '.$class.'">'.__('Sale!', 'woocommerce').'</span>', $post, $product); ?>

<?php endif; ?>