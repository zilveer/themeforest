<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
global $cg_options, $woocommerce_loop;

$product_layout = $cg_options['product_layout'];
$woo_product_grid_count = $woocommerce_loop["columns"];
?>


<div class="product-wrap">
    <div class="row">
        <?php if ( !empty( $woo_product_grid_count ) ) { ?>
            <ul class="products woogrid col-xs-product-2 col-sm-product-3 col-md-product-3 col-lg-product-<?php echo $woo_product_grid_count; ?> <?php echo $product_layout; ?>">
            <?php } elseif ( isset( $cg_options['product_grid_count'] ) ) { ?>
                <ul class="products col-xs-product-2 col-sm-product-3 col-md-product-3 col-lg-product-<?php echo $cg_options['product_grid_count']; ?> <?php echo $product_layout; ?>">
                <?php } else { ?>
                    <ul class="products col-xs-product-2 col-sm-product-3 col-md-product-3 col-lg-product-4 <?php echo $product_layout; ?>">
                    <?php } ?>
