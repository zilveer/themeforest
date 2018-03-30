<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
?>
<?php
global $majesty_options;
$layout = $majesty_options['shortcode_products_query'];
if( ! empty( $layout ) && $majesty_options['vc_woo_filter'] != 'true' ) {
	if( $layout == 'list' || $layout == 'list2' ) {
		
	} elseif( $layout == '3col' ) {
		echo '<div class="woocommerce-columns woocommerce-3columns">';
	} elseif( $layout == '4col' ) {
		echo '<div class="woocommerce-columns woocommerce-4columns">';
	} elseif( $layout == 'masonry' ) {
		echo '<div class="text-center masonry_menu masonry_columm menu-items masonry-items">';
	} elseif( $layout == 'masonryfullwidth' ) {
		echo '<div class="text-center masonry_menu masonry_columm_full menu-items masonry-items">';
	} elseif( $layout == 'grid' || $layout == 'grid4col' || $layout == 'gridfullwidth' ) {
		if( $layout == 'grid4col' ) {
			echo '<div class="menu_grid our-menu text-center shop-grid-4col"><div class="menu-type">';
		} else {
			echo '<div class="menu_grid our-menu text-center"><div class="menu-type">';
		}
	}
}
?>
<ul class="products">