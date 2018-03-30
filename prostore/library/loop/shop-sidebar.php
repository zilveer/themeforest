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
 * @package 	proStore/library/loop/shop-sidebar.php
 * @file	 	1.0
 */
?>
<?php

	global $data, $prefix, $woocommerce, $sidebar_min_icon;
	
	$blocks = $data[$prefix."woocommerce_layout_sidebar_blocks"]['enabled'];	

?>
			
<h3 class="section-title clearfix">
	<span><?php echo $data[$prefix."woocommerce_layout_sidebar_title"]; ?></span> 
	<?php if($data[$prefix."woocommerce_layout_sidebar_toggle"]=="1") { ?>
		<em class="icon-<?php echo $sidebar_min_icon; ?>-open"></em>
	<?php } ?>
</h3>	

<?php
	if($blocks) : 
			
		foreach($blocks as $key=>$value) {						
			switch($key) {				
				case "product_search" :
					the_widget('WooCommerce_Widget_Product_Search', array('title'=>'Search products'), array('before_title'=>'<h6>', 'after_title'=>'</h6>'));				
					break;
				case "product_cat" :
					the_widget('WooCommerce_Widget_Product_Categories', array('title'=>'Categories'), array('before_title'=>'<h6>', 'after_title'=>'</h6>'));				
					break;
				case "price_filter" :
					the_widget('WooCommerce_Widget_Price_Filter', array('title'=>'Price Filter'), array('before_title'=>'<h6>', 'after_title'=>'</h6>'));
					break;
				case "attribute_filter" :
					$attribute_taxonomies = $woocommerce->get_attribute_taxonomies();
					if ( $attribute_taxonomies ) :
						foreach ($attribute_taxonomies as $tax) :
							if (taxonomy_exists( $woocommerce->attribute_taxonomy_name($tax->attribute_name))) :							
								
								the_widget('WooCommerce_Widget_Layered_Nav', array('title'=>ucfirst($tax->attribute_name), 'attribute'=>$tax->attribute_name,'display_type'=>'list'), array('before_title'=>'<h6>', 'after_title'=>'</h6>'));							
		
							endif;
						endforeach;
					endif;					
					break;
			}
		}
				
	endif;
?>
