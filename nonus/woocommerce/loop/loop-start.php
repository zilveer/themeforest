<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
global $woocommerce_loop;
// Store column count for displaying the grid
if(empty($woocommerce_loop['columns'])) {
    $woocommerce_loop['columns'] = apply_filters('loop_shop_columns', 1);
}

/* number of columns (2-6) */

$ct_shop_columns = 3;
$ct_prodcategory_columns = 3;


if(is_shop() || is_product_category() || is_product_tag()) {
    $woocommerce_loop['columns'] = $ct_shop_columns;
}
if(is_shop()) {
    $woocommerce_loop['columns'] = $ct_shop_columns;
}
if(is_product_category()) {
    $woocommerce_loop['columns'] = $ct_prodcategory_columns;
}
?>

<div class="clearfix"></div>
<ul class="products clearfix main-prodlist woocolumns-<?php echo $woocommerce_loop['columns']; ?>">