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

global $product, $woocommerce_loop;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

if ( ! ( isset( $woocommerce_loop['view'] ) && ! empty( $woocommerce_loop['view'] ) ) && ( yit_get_option( 'shop-enable-masonry' ) == 'no' ) ) {
    $woocommerce_loop['view'] = yit_get_option( 'shop-view-type', 'grid' );
}
elseif ( yit_get_option( 'shop-enable-masonry' ) == 'yes' ) {
    $woocommerce_loop['view'] = 'masonry_item';
}

global $yit_products_layout;
// Set the products layout style
if( ! isset( $yit_products_layout ) || $yit_products_layout == 'default' ) {
    $yit_products_layout = yit_get_option( 'shop-layout-type' );
}

//product countdown compatibility

global $ywpc_loop;
if ( $ywpc_loop && $ywpc_loop == 'ywpc_widget' ) {
    $woocommerce_loop['view'] = 'grid';
}

if ( yit_get_option('shop-enable') == 'no' || yit_get_option( 'shop-product-price' ) == 'no' )  remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price' );

?>
<li <?php post_class(); ?>>

    <div class="product-wrapper">

        <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

        <?php
        /**
         * woocommerce_before_shop_loop_item_title hook
         *
         * @hooked woocommerce_show_product_loop_sale_flash - 10
         * @hooked woocommerce_template_loop_product_thumbnail - 10
         */
        do_action( 'woocommerce_before_shop_loop_item_title' );
        ?>
        <div class="clearfix info-product <?php echo $yit_products_layout ?>">

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
            do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
        </div>

        <?php if ( $yit_products_layout == 'classic' ): ?>
            <div class="product-meta">
                <div class="product-meta-wrapper">

                    <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

                </div>
            </div>
        <?php endif; ?>

    </div>

</li>
