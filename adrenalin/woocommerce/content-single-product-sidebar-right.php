<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
global $cg_options;
$protocol = (!empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https:" : "http:";
$size_guide_title = '';
if ( isset( $cg_options['product_size_guide_title'] ) ) {
    $size_guide_title = $cg_options['product_size_guide_title'];
}

if ( !defined( 'ABSPATH' ) )
    exit; // Exit if accessed directly
?>

<?php
/**
 * woocommerce_before_single_product hook
 *
 * @hooked woocommerce_show_messages - 10
 */
do_action( 'woocommerce_before_single_product' );
?>
<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="row product-details-wrapper">
        <div class="col-lg-9 col-md-9 col-sm-9 product-listing-wrapper">
            <div class="single-product-details row">
                <div class="product-images col-lg-5 col-md-5 col-sm-5">
                    <?php
                    /**
                     * woocommerce_show_product_images hook
                     *
                     * @hooked woocommerce_show_product_sale_flash - 10
                     * @hooked woocommerce_show_product_images - 20
                     */
                    do_action( 'woocommerce_before_single_product_summary' );
                    ?>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7">
                    <div class="summary entry-summary">
                        <?php
                        /**
                         * woocommerce_single_product_summary hook
                         *
                         * @hooked woocommerce_template_single_title - 5
                         * @hooked woocommerce_template_single_price - 10
                         * @hooked woocommerce_template_single_excerpt - 20
                         * @hooked woocommerce_template_single_add_to_cart - 30
                         * @hooked woocommerce_template_single_meta - 40
                         * @hooked woocommerce_template_single_sharing - 50
                         */
                        do_action( 'woocommerce_single_product_summary' );
                        ?>
                    </div><!-- .summary -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <?php wc_get_template( 'single-product/tabs/tabs.php' ); ?>
                </div>
            </div>
            <div class="row">
                <div class="up-sells-bottom col-lg-12 col-md-12 col-sm-12">
                    <?php wc_get_template( 'single-product/up-sells-bottom.php' ); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <?php 
                        woocommerce_output_related_products();
                    ?>
                </div>
            </div>			
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 widget-area right-sidebar">
            <?php dynamic_sidebar( 'shop-sidebar' ); ?>
        </div>
    </div>
</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>