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

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

// Adding extra classes for responsive view
if ( handy_get_option('store_columns')=='3' ) {
		if ( pt_show_layout()!='layout-one-col' ) {
				$responsive_class = " col-xs-12 col-md-4 col-sm-6";
		} else {
				$responsive_class = " col-xs-12 col-md-4 col-sm-3";
		}
} elseif ( handy_get_option('store_columns')=='4' ) {
		if ( pt_show_layout()!='layout-one-col' ) {
				$responsive_class = " col-xs-12 col-md-3 col-sm-6";
		} else {
				$responsive_class = " col-xs-12 col-md-3 col-sm-4";
		}
}
$classes[] = $responsive_class;

// Adding extra class if list view
if ( handy_get_option('default_list_type')=='list' && ( is_shop() || is_product_category() || is_product_tag() ) ) {
		$classes[] = 'list-view';
}

// Extra class for lazyload
if ( handy_get_option('catalog_lazyload')=='on' ) {
		$classes[] = 'lazyload';
}
?>

<li <?php post_class($classes); ?> data-expand="-100">
	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * woocommerce_before_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item_title' );

	/**
	 * woocommerce_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	do_action( 'woocommerce_shop_loop_item_title' );

	/**
	 * woocommerce_after_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );

	/**
	 * woocommerce_after_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
</li>
