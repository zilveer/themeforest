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
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
    $woocommerce_loop['loop'] = 0;
}

/* fix yith catalog mode */
$ywctm_hide_cart_page = false;
global $YITH_WC_Catalog_Mode;
if ( isset( $YITH_WC_Catalog_Mode ) ) {
    $ywctm_hide_add_to_cart_loop = method_exists( $YITH_WC_Catalog_Mode, 'check_hide_add_cart_loop' ) && $YITH_WC_Catalog_Mode->check_hide_add_cart_loop();

    if($ywctm_hide_add_to_cart_loop && $product->product_type != 'variable') {
        add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 15 );
    }   else {
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 15 );
    }
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

// configuration
if ( ! yit_get_option('shop-view-show-price') ) remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price' );

// remove the shortcode from the short description, in list view
remove_filter( 'woocommerce_short_description', 'do_shortcode', 11 );
add_filter( 'woocommerce_short_description', 'strip_shortcodes' );

?>
<li <?php post_class(); ?>>

    <div class="product-thumbnail group">

        <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

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

        <div class="product-meta" <?php if ($woocommerce_loop['view'] == 'list') echo 'style="width: ' . yit_shop_small_w() . 'px;"'; ?>>

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
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action( 'woocommerce_after_shop_loop_item_title' );
            ?>
        </div>

        <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

    </div>

    <?php if ( yit_get_option('shop-view-show-description') ) : ?>
        <div class="description">
            <?php woocommerce_template_single_excerpt(); ?>
            <a href="<?php the_permalink() ?>" class="view-detail"><?php echo apply_filters('yit_details_button', __( 'Details', 'yit' )) ?></a>
            <?php do_action( 'yit_additional_info_on_list_view' ); ?>
        </div>
    <?php endif; ?>

</li>