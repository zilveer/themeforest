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
 * @package 	proStore/woocommerce/single-product/price.php
 * @sub-package WooCommerce/Templates/single-product/price.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php global $post, $product; ?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<h4><p itemprop="price" class="price"><?php echo $product->get_price_html(); ?></p></h4>

	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

</div>