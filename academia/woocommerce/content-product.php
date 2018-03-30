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
$g5plus_woocommerce_loop = G5Plus_Global::get_woocommerce_loop();

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;



// Extra post classes
$classes = array();
$classes[] = 'product-item-wrap';
$product_rating = isset($g5plus_woocommerce_loop['rating']) ? $g5plus_woocommerce_loop['rating'] : '';
if ($product_rating === '') {
	$product_rating = G5Plus_Global::get_option('product_show_rating','0');
}

if ($product_rating == 0) {
    $classes[] = 'rating-disable';
}
if(G5Plus_Global::get_option('product_show_count_comment','0')=='0'){
    $classes[] = 'count-comment-disable';
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
             * @hooked g5plus_woocomerce_template_loop_link - 20
             *
             */
            do_action( 'woocommerce_before_shop_loop_item_title' );
            ?>
			<div class="product-actions">
				<?php
				/**
				 * g5plus_woocommerce_product_action hook
				 *
                 * @hooked g5plus_woocomerce_template_loop_compare - 5
                 * @hooked g5plus_woocomerce_template_loop_quick_view - 10
				 * @hooked woocommerce_template_loop_add_to_cart - 20
                 * @hooked g5plus_woocomerce_template_loop_wishlist - 25
				 */
				do_action( 'g5plus_woocommerce_product_actions' );
				?>
			</div>
        </div>
        <div class="product-info">

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
             * @hooked woocommerce_template_loop_rating - 15
             */
            do_action( 'woocommerce_after_shop_loop_item_title' );
            ?>
        </div>
    </div>
</div>

