<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 === ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 === $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 === $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}
if ( ! isset( $woocommerce_loop['view'] ) ) {
    $woocommerce_loop['view'] = yit_get_option( 'shop-view-type', 'grid' );
}

// check if is mobile
$isMobile = YIT_Mobile()->isMobile();

$woocommerce_loop['shown_product'] = true;

// Set the products layout style
if( ! isset( $woocommerce_loop['products_layout'] ) || $woocommerce_loop['products_layout'] == 'default' ) {
    $woocommerce_loop['products_layout'] = yit_get_option( 'shop-layout-type' );
}

//force flip layout in masonry
if( $woocommerce_loop['view'] == 'masonry_item' || $isMobile ) {
    $woocommerce_loop['products_layout'] = 'flip';
}

//product countdown compatibility

global $ywpc_loop;
if ( $ywpc_loop && $ywpc_loop == 'ywpc_widget' ) {
    $woocommerce_loop['view'] = 'grid';
}

$classes[] = $woocommerce_loop['view'];

// Set column
if ( ( is_shop() || is_product_category() || is_product_taxonomy() ) && ! $isMobile ) {
    $classes[] = 'col-sm-' . intval( 12/ intval( yit_get_option( 'shop-num-column' ) ) );
    $woocommerce_loop['columns'] = intval( yit_get_option( 'shop-num-column' ) );
}
else if ( isset( $product_in_a_row ) && $product_in_a_row > 0 ){
    $classes[] = 'col-sm-' . intval( 12 / intval( $product_in_a_row ) ) . ' col-xs-6';
    $woocommerce_loop['columns']    = intval( $product_in_a_row );
}
else {

    $sidebar = yit_get_sidebars();

    if ( $sidebar['layout'] == 'sidebar-double' ) {
        $classes[] = 'col-sm-6 col-xs-6';
        $woocommerce_loop['columns']    = '2';
    }
    elseif ( $sidebar['layout'] == 'sidebar-right' || $sidebar['layout'] == 'sidebar-left' ) {
        $classes[] = 'col-sm-4 col-xs-6';
        $woocommerce_loop['columns']    = '3';
    }
    else {
        $classes[] = 'col-sm-3 col-xs-6';
        $woocommerce_loop['columns']    = '4';
    }
}



?>
<li <?php post_class( $classes ); ?> >


    <div class="clearfix product-wrapper <?php echo $woocommerce_loop['products_layout'] ?>">

        <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

        <div class="thumb-wrapper <?php echo $woocommerce_loop['products_layout'] ?>">

            <?php
            /**
             * woocommerce_before_shop_loop_item_title hook
             *
             * @hooked woocommerce_show_product_loop_sale_flash - 10
             * @hooked woocommerce_template_loop_product_thumbnail - 10
             */
            do_action( 'woocommerce_before_shop_loop_item_title' );
            ?>

        </div>

        <div class="product-meta">
            <?php

            /**
             * woocommerce_shop_loop_item_title hook.
             *
             * @hooked woocommerce_template_loop_product_title - 10
             */
            do_action( 'woocommerce_shop_loop_item_title' );

            /**
             * woocommerce_after_shop_loop_item_title hook
             *
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
        </div>


        <div class="product-actions-wrapper">
            <div class="product-actions">
                <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
            </div>
        </div>
    </div>

</li>
