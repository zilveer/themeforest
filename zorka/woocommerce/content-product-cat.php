<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $woocommerce_loop, $zorka_product_layout;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
    $woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
    $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Increase loop count
$woocommerce_loop['loop']++;


// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
    $classes[] = 'first';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
    $classes[] = 'last';
}
$classes[] = 'product-category';
$classes[] = 'product';

if($zorka_product_layout!='slider')
{
    if ($woocommerce_loop['columns']==3)
        $classes[] = 'col-md-4';
    if ($woocommerce_loop['columns']==4)
        $classes[] = 'col-md-3';
    if ($woocommerce_loop['columns']==5)
        $classes[] = 'col-5';
}

$class = join(' ',$classes);

?>
<div class="<?php echo esc_attr($class) ?>">

    <?php do_action( 'woocommerce_before_subcategory', $category ); ?>

    <a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">

        <div class="entry-thumbnail title">
            <?php
            /**
             * woocommerce_before_subcategory_title hook
             *
             * @hooked woocommerce_subcategory_thumbnail - 10
             */
            do_action( 'woocommerce_before_subcategory_title', $category );
            ?>
            <div class="entry-thumbnail-hover">
                <div class="entry-hover-wrapper">
                    <div class="entry-hover-inner">

                        <i class="pe-7s-link"></i>

                    </div>
                </div>
            </div>
        </div>

        <h6 class="category-title">
            <?php echo wp_kses_post($category->name); ?>
        </h6>
        <h6 class="category-items">
            <?php
            if ( $category->count > 0 )
                echo wp_kses_post($category->count). esc_html__(' Items','zorka'); //apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
            ?>
        </h6>

        <?php
        /**
         * woocommerce_after_subcategory_title hook
         */
        do_action( 'woocommerce_after_subcategory_title', $category );
        ?>

    </a>

    <?php do_action( 'woocommerce_after_subcategory', $category ); ?>

</div>
