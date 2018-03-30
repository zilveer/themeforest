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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
if ( 4 == $woocommerce_loop['columns'] )
    //$classes[] = 'col-sm-3';
    $caca = '';
else if ( 3 == $woocommerce_loop['columns'] )
    //$classes[] = 'col-sm-4';
    $caca = '';
else if ( 2 == $woocommerce_loop['columns'] )
    //$classes[] = 'col-sm-6';
    $caca = '';
else
    //$classes[] = 'col-sm-3';
    $caca = '';

$classes[] = 'col-sm-4 col-xs-6';
?>

<li <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

    <div class="product-container">

        <div class="product-buttons">
            <div class="product-buttons-container clearfix">

                <?php do_action( 'clx_before_shop_loop_buttons' ); ?>

            </div>
        </div>

        <?php

        /**
         * woocommerce_before_shop_loop_item_title hook
         *
         * @hooked woocommerce_show_product_loop_sale_flash - 10
         * @hooked woocommerce_template_loop_product_thumbnail - 10
         */
        do_action( 'woocommerce_before_shop_loop_item_title' );
        ?>


        <div class="product-details">

            <h3><?php the_title(); ?></h3>

            <?php
                /**
                 * woocommerce_after_shop_loop_item_title hook
                 *
                 * @hooked woocommerce_template_loop_rating - 5
                 * @hooked woocommerce_template_loop_price - 10
                 */
                do_action( 'woocommerce_after_shop_loop_item_title' );
            ?>

        </div>

        <?php
            /**
             * woocommerce_after_shop_loop_item
             *
             * @hooked the_buy_button :)
             */
            do_action( 'woocommerce_after_shop_loop_item' );
        ?>

    </div>

</li>
<?php global $woocommerce_loop; ?>
<?php
    if ( ((int)$woocommerce_loop['loop']) % ((int)$woocommerce_loop['columns']) == 0) { echo '<div class="clear"></div>'; }
?>
