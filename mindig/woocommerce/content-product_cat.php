<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product_cat.php.
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
	exit;
}

global $woocommerce_loop;

// yit shortcode
if( isset( $product_in_a_row ) ) {
	$woocommerce_loop['product_in_a_row'] = $product_in_a_row;
}

?>

<li <?php wc_product_cat_class( '' , $category ) ?> >

    <?php do_action( 'woocommerce_before_subcategory', $category ); ?>

    <a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" class="product-category-link">

        <div class="category-thumb">
	<?php

	/**
	 * woocommerce_before_subcategory_title hook.
	 *
	 * @hooked woocommerce_subcategory_thumbnail - 10
	 */
	do_action( 'woocommerce_before_subcategory_title', $category );

	/**
	 * woocommerce_shop_loop_subcategory_title hook.
	 *
	 * @hooked woocommerce_template_loop_category_title - 10
	 */
	do_action( 'woocommerce_shop_loop_subcategory_title', $category , isset( $show_counter ) ? $show_counter : 0 );

	/**
	 * woocommerce_after_subcategory_title hook.
	 */
	do_action( 'woocommerce_after_subcategory_title', $category );
    ?>

    </a>

    <?php do_action( 'woocommerce_after_subcategory', $category ); ?>

</li>