<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop, $yit_is_page, $yit_is_feature_tab;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

if( isset( $yit_is_page ) ) {
    $woocommerce_loop['yit_is_page'] = $yit_is_page;
}

if( isset( $yit_is_feature_tab ) ) {
    $woocommerce_loop['yit_is_feature_tab'] = $yit_is_feature_tab;
}

if ( !( isset( $woocommerce_loop['layout'] ) && ! empty( $woocommerce_loop['layout'] ) ) )
    $woocommerce_loop['layout'] = yit_get_option( 'shop-layout', 'with-hover' );
if ( !( isset( $woocommerce_loop['view'] ) && ! empty( $woocommerce_loop['view'] ) ) )
    $woocommerce_loop['view'] = yit_get_option( 'shop-view', 'grid' );

//product countdown compatibility
global $ywpc_loop;
if ( $ywpc_loop && $ywpc_loop == 'ywpc_widget' ) {
    $woocommerce_loop['view'] = 'grid';
}

// remove the shortcode from the short description, in list view
remove_filter( 'woocommerce_short_description', 'do_shortcode', 11 );
add_filter( 'woocommerce_short_description', 'strip_shortcodes' );

// changes for the "classic" layout
if ( $woocommerce_loop['layout'] == 'classic' ) {
    //remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart' );
    add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
}

// configuration
if ( ! yit_get_option('shop-view-show-price') ) remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price' );
?>
<li <?php post_class(); ?>>

    <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

    <div class="product-thumbnail group">

        <div class="thumbnail-wrapper">
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

        <?php if ( $woocommerce_loop['layout'] == 'classic' && yit_get_option('shop-view-show-shadow') ) : ?>
        <div class="product-shadow"></div>
        <?php endif; ?>

        <div class="product-meta">
            <?php
	            /**
	             * woocommerce_shop_loop_item_title hook
	             *
	             * @hooked woocommerce_template_loop_product_title - 10
	             */
	            do_action( 'woocommerce_shop_loop_item_title' );

                /**
                 * woocommerce_after_shop_loop_item_title hook
                 *
                 * @hooked woocommerce_template_loop_price - 10
                 */
                do_action( 'woocommerce_after_shop_loop_item_title' );
            ?>
        </div>

    </div>
    <?php do_action( 'woocommerce_after_shop_loop_item' );
	?>

</li>
