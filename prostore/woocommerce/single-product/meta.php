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
 * @package 	proStore/woocommerce/single-product/meta.php
 * @sub-package WooCommerce/Templates/single-product/meta.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php global $post, $product, $data, $prefix; ?>

<div class="product_meta <?php if($data[$prefix."woocommerce_responsive_meta"]!="1") {echo "hide-for-small";} ?>">

	<?php if ( $product->is_type( array( 'simple', 'variable' ) ) && get_option('woocommerce_enable_sku') == 'yes' && $product->get_sku() ) : ?>
		<span itemprop="productID" class="sku"><?php _e('SKU:', 'woocommerce'); ?> <?php echo $product->get_sku(); ?>.</span>
	<?php endif; ?>

	<?php echo $product->get_categories( ', ', ' <span class="posted_in"><em class="icon-archive"></em> '.__('<strong>Category :</strong>', 'woocommerce').' ', '.</span>'); ?>
	
	<?php echo $product->get_tags( ', ', ' <span class="tagged_as"><em class="icon-tag"></em> '.__('<strong>Tags :</strong>', 'woocommerce').' ', '.</span>'); ?>

</div>