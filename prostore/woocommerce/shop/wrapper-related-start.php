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
 * @package 	proStore/woocommerce/shop/wrapper-related-start.php
 * @sub-package 
 * @file		1.0
 * @file(Woo)	
 */
?>
<?php 

	global $product, $woocommerce_loop, $data, $prefix;
	
	$related = $product->get_related();
	$upsells = $product->get_upsells();

	$class="six";
	if ( sizeof($related) == 0 || sizeof( $upsells) == 0 || $data[$prefix."woocommerce_product_related"]!="1" || $data[$prefix."woocommerce_product_maylike"]!="1") {
		$class = "twelve";
	} else {
		$class = "six";
	}
?>

<div class="related_products_wrapper <?php if($data[$prefix."woocommerce_responsive_related"]!="1") { echo "hide-for-small"; } ?>">
	<div class="row container">
		<?php if(sizeof($upsells) != 0 && $data[$prefix."woocommerce_product_maylike"]=="1") { ?>
			<div class="<?php echo $class; ?> columns">
				<h4><em class="icon-heart"></em> Products you may like</h4>	
				<?php do_action('custom_related_section_upsell'); ?>
			</div>
		<?php } ?>
		<?php if(sizeof($related) != 0 && $data[$prefix."woocommerce_product_related"]=="1") { ?>			
			<div class="<?php echo $class; ?> columns">
				<h4><em class="icon-link"></em> Related products</h4>
				<?php do_action('custom_related_section_products'); ?>
			</div>
		<?php } ?>
	</div>
</div>