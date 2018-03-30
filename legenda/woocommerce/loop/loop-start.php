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
global $woocommerce_loop;
// Store column count for displaying the grid
$prodcuts_per = etheme_get_option('prodcuts_per_row');
if(empty($woocommerce_loop['columns'])) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', $prodcuts_per );
}
if ( !empty( $prodcuts_per ) && $prodcuts_per != '' ) {
	$columns = $prodcuts_per;
} else {
	$columns = $woocommerce_loop['columns'];
}

if(!empty($woocommerce_loop['shortcode_columns'])) {
	$columns = $woocommerce_loop['shortcode_columns'];
}

?>
<?php $view_mode = etheme_get_option('view_mode'); ?>
<?php
    if($view_mode == 'list' || $view_mode == 'list_grid') {
        $view_class = 'products-list';
    }else{
        $view_class = 'products-grid';
    }

?>
<div class="product-loop <?php echo $view_class; ?> product-count-<?php echo $columns; ?>">
