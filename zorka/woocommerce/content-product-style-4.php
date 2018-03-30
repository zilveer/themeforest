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

global $zorka_product_layout;
if (!isset($zorka_product_layout) || $zorka_product_layout == '') {
    switch($woocommerce_loop['columns']) {
        case 4:
            $classes[] = 'col-md-3 col-sm-4 col-xs-6';
            break;
        case 3 :
            $classes[] = 'col-md-4  col-sm-4 col-xs-6';
            break;
        case 2:
            $classes[] = 'col-md-2 col-sm-4 col-xs-6';
            break;
        default:{
            $classes[] = 'col-'.$woocommerce_loop['columns'];
        }
    }
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
             */
            remove_action('woocommerce_before_shop_loop_item_title','zorka_woocommerce_template_loop_quick_view',15);
            remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
            add_action( 'woocommerce_before_shop_loop_item_title', 'zorka_template_loop_product_thumbnail', 10 );
            do_action( 'woocommerce_before_shop_loop_item_title', 330, 440 );
            ?>
            <div class="product-entry">
                <div class="entry-wrap">
                    <div class="entry-inner">
                        <a class="product-name" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <?php
                        /**
                         * woocommerce_after_shop_loop_item_title hook
                         *
                         * @hooked woocommerce_template_loop_rating - 5
                         * @hooked woocommerce_template_loop_price - 10
                         */
                        global $zorka_sc_product_show_rating;
                        if ( isset($zorka_sc_product_is_show_button) && $zorka_sc_product_is_show_button=='0')
                            remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
                        do_action( 'woocommerce_after_shop_loop_item_title' );
                        ?>
                        <div class="product-button clearfix">
                            <div class="product-button-inner">
                                <?php
                                /**
                                 * woocommerce_after_shop_loop_item hook
                                 *
                                 * @hooked woocommerce_template_loop_add_to_cart - 10
                                 */
                                do_action( 'woocommerce_after_shop_loop_item' );
                                ?>
                                <?php
                                    global $zorka_sc_product_is_show_button;
                                    if ( isset($zorka_sc_product_is_show_button) && $zorka_sc_product_is_show_button==1 && in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) : ?>
                                    <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>






