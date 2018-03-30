<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
    $woocommerce_loop['loop'] = 0;

$woocommerce_loop_columns  = 4;


// Ensure visibility
if ( ! $product || ! $product->is_visible() )
    return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop_columns || 1 == $woocommerce_loop_columns ) {
    $classes[] = 'first';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop_columns ) {
    $classes[] = 'last';
}
$classes[] = 'product-item-wrapper';

global $zorka_product_layout;
if (!isset($zorka_product_layout) || $zorka_product_layout == '') {
    $classes[] = 'col-md-3 col-sm-4 col-xs-6';
}

?>
<div <?php post_class( $classes ); ?>>
    <div class="product-item-inner">
        <div class="product-thumb">
            <?php
            /**
             * woocommerce_before_shop_loop_item_title hook
             *
             * @hooked woocommerce_show_product_loop_sale_flash - 10
             * @hooked woocommerce_template_loop_product_thumbnail - 10
             * @hooked zorka_woocommerce_template_loop_quick_view - 15
             * @hooked zorka_woocommerce_template_loop_link - 20
             */
            do_action( 'woocommerce_before_shop_loop_item_title' );
            ?>
        </div>

        <?php
        $cat_name = '';
        $terms = wc_get_product_terms( get_the_ID(), 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) );
        if ($terms) {
            $cat_link = get_term_link( $terms[0], 'product_cat' );
            $cat_name = $terms[0]->name;
        }
        ?>
        <?php if (!empty($cat_name)) : ?>
            <div class="product-cat">
                <a href="<?php echo esc_url($cat_link) ?>" ><?php echo esc_html($cat_name);?></a>
            </div>
        <?php endif; ?>

        <a class="product-name" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        <?php
        /**
         * woocommerce_after_shop_loop_item_title hook
         *
         * @hooked woocommerce_template_loop_rating - 5
         * @hooked woocommerce_template_loop_price - 10
         */
        do_action( 'woocommerce_after_shop_loop_item_title' );
        ?>
        <div class="product-button clearfix">
            <div class="product-button-inner">
            <?php if ( in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) : ?>
                <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
            <?php endif; ?>
            <?php

            /**
             * woocommerce_after_shop_loop_item hook
             *
             * @hooked woocommerce_template_loop_add_to_cart - 10
             */
            do_action( 'woocommerce_after_shop_loop_item' );
            ?>
            </div>
        </div>
    </div>
</div>
