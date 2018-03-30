<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if ( !defined( 'ABSPATH' ) )
    exit; // Exit if accessed directly
global $cg_options;
global $product, $woocommerce, $woocommerce_loop;

$posts_per_page = 10;
$columns = '';
$orderby = '';

$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 )
    return;

$meta_query = $woocommerce->query->get_meta_query();

$args = array(
    'post_type' => 'product',
    'ignore_sticky_posts' => 1,
    'no_found_rows' => 1,
    'posts_per_page' => $posts_per_page,
    'orderby' => $orderby,
    'post__in' => $upsells,
    'post__not_in' => array( $product->id ),
    'meta_query' => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) :
    ?>

    <div class="upsells products">
        <?php if ( $cg_options['upsell_title'] ) { ?>
            <h2><?php echo $cg_options['upsell_title'] ?></h2>
        <?php } else { ?>
            <h2><?php _e( 'Complete the look', 'commercegurus' ) ?></h2>
        <?php } ?>
        <?php woocommerce_product_loop_start(); ?>

        <?php while ( $products->have_posts() ) : $products->the_post(); ?>

            <?php wc_get_template_part( 'content', 'product' ); ?>

        <?php endwhile; // end of the loop. ?>

        <?php woocommerce_product_loop_end(); ?>
    </div>

    <?php
endif;

wp_reset_postdata();
