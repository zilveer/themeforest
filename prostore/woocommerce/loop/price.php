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
 * @package 	proStore/woocommerce/loop/price.php
 * @sub-package WooCommerce/Templates/loop/price.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php global $product; ?>

<div class="price_wrapper">
	<?php if ($price_html = $product->get_price_html()) : ?>
		<span class="price"><?php echo $price_html; ?></span>
	<?php endif; ?>
</div>