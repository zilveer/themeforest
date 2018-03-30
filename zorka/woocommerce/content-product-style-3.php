<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 3/28/15
 * Time: 4:28 PM
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

// Extra post classes
$classes = array('product-item-wrapper');

if (woocommerce_version_check('2.6','<')) {

	// Store loop count we're currently on
	if ( empty( $woocommerce_loop['loop'] ) )
		$woocommerce_loop['loop'] = 0;

	// Store column count for displaying the grid
	if ( empty( $woocommerce_loop['columns'] ) )
		$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );


	// Increase loop count
	$woocommerce_loop['loop']++;

	// Extra post classes
	if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
		$classes[] = 'first';
	}
	if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
		$classes[] = 'last';
	}
}

?>
<div <?php post_class( $classes ); ?>>
    <div class="product-item-inner second-style">
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
        <div class="product-info">
            <a class="product-name" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <?php
            /**
             * woocommerce_after_shop_loop_item_title hook
             *
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action( 'woocommerce_after_shop_loop_item_title' );
            if ( get_option( 'woocommerce_enable_review_rating' ) != 'no' ){
                echo  sprintf('<div class="rating-wrap">%s</div>',$product->get_rating_html());
            }
            ?>

        </div>
        <div class="clearfix"></div>
    </div>
</div>