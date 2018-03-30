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
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// yit shortcode
if( isset( $product_in_a_row ) ) {
    $woocommerce_loop['product_in_a_row'] = $product_in_a_row;
}

if ( ! isset( $woocommerce_loop['view'] ) ) {
    $woocommerce_loop['view'] = yit_get_option( 'shop-view-type', 'grid' );
}

//product countdown compatibility

global $ywpc_loop;
if ( $ywpc_loop && $ywpc_loop == 'ywpc_widget' ) {
    $woocommerce_loop['view'] = 'grid';
}

// check if is mobile
$isMobile = YIT_Mobile()->isMobile();

// Set the products layout style
if( ! isset( $woocommerce_loop['products_layout'] ) || $woocommerce_loop['products_layout'] == 'default' ) {
    $woocommerce_loop['products_layout'] = yit_get_option( 'shop-layout-type' );
}

//force flip layout in masonry
if( $woocommerce_loop['view'] == 'masonry_item' || $isMobile ) {
    $woocommerce_loop['products_layout'] = 'flip';
}


?>
<li <?php post_class( ); ?> >


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
