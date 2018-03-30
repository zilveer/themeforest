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

$meta_query = WC()->query->get_meta_query();

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
            <h4><?php echo $cg_options['upsell_title'] ?></h4>
        <?php } else { ?>
            <h4><?php _e( 'Complete the look', 'commercegurus' ) ?></h4>
        <?php } ?>

        <ul class="up-sell-grid"> 

            <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                <?php wc_get_template_part( 'content', 'product-upsells' ); ?>

            <?php endwhile; // end of the loop.  ?>

        </ul>

    </div>

    <?php
endif;

wp_reset_postdata();
