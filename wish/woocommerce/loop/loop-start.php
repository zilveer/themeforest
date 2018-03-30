<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
  // $redux_wish['products_per_row'] will set number of products per row and it is also defined in content-product.php
global $woocommerce_loop;
$redux_wish = wish_redux();
$redux_wish['products_per_row'] = 4;
$product_layout = $redux_wish['products_per_row'];
$woo_product_grid_count = $woocommerce_loop["columns"];
?>


<div class="product-wrap">
    <div class="row">
        <?php if ( !empty( $woo_product_grid_count ) ) { ?>
            <ul class="products shop-products woogrid col-xs-product-2 col-sm-product-3 col-md-product-3 col-lg-product-<?php echo $woo_product_grid_count; ?> <?php echo $product_layout; ?>">
            <?php } elseif ( isset( $redux_wish['products_per_row'] ) ) { ?>
                <ul class="products shop-products col-xs-product-2 col-sm-product-3 col-md-product-3 col-lg-product-<?php echo $redux_wish['products_per_row']; ?> <?php echo $product_layout; ?>">
                <?php } else { ?>
                    <ul class="products shop-products col-xs-product-2 col-sm-product-3 col-md-product-3 col-lg-product-4 <?php echo $product_layout; ?>">
                    <?php } ?>
