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
 * @version 2.5.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop;

// Store loop count we're currently on.
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid.
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Increase loop count.
$woocommerce_loop['loop']++;

$li_class = array();

//standard li class
$li_class[] = 'product-category product';

$sidebar = yit_get_sidebars();

if ( isset( $product_in_a_row ) && $product_in_a_row > 0 ){
    $li_class[] = 'col-sm-' . intval( 12 / intval( $product_in_a_row ) ) . ' col-xs-4';
    $woocommerce_loop['columns']    = intval( $product_in_a_row );
}
else if ( $sidebar['layout'] == 'sidebar-double' ) {
    $li_class[] = 'col-sm-6';
    $woocommerce_loop['columns']    = '2';
}
elseif ( $sidebar['layout'] == 'sidebar-right' || $sidebar['layout'] == 'sidebar-left' ) {
    $li_class[] = 'col-sm-4';
    $woocommerce_loop['columns']    = '3';
}
else {
    $li_class[] = 'col-sm-3';
    $woocommerce_loop['columns']    = '4';
}



// add class first/last
if ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 || $woocommerce_loop['columns'] == 1 ) {
    $li_class[] = 'first';
}
if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 ) {
    $li_class[] = 'last';
}

?>

<li <?php wc_product_cat_class( $li_class , $category ) ?> >

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