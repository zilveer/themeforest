<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$related = $product->get_related( $posts_per_page );

if ( empty( $related ) )
    { return; }

$args = apply_filters('woocommerce_related_products_args', array(
    'post_type'             => 'product',
    'ignore_sticky_posts'   => 1,
    'no_found_rows'         => 1,
    'orderby'               => $orderby,
    'post__in'              => $related,
    'post__not_in'          => array( $product->id )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= apply_filters( 'yit_related_shop_columns', $columns );

if ( $products->have_posts() ) : ?>
    <?php

        if(is_single()){
            $span_class ="";
        }
        else {
            if(yit_get_sidebar_layout() != 'sidebar-no') :
                $span_class= "span".  (yit_get_option( 'shop-sidebar-width' )  != '2' ? 9 : 10);
            else :
                $span_class= "span12";
            endif;
        }
    ?>
    <div class="related products <?php echo apply_filters( 'yit_related_tab_span_class', $span_class ) ?>">

        <?php printf( '<h2>%s</h2>', apply_filters( 'yit_related_products_title', __('Related Products', 'yit') ) ) ?>

        <ul class="products">

            <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                <?php wc_get_template_part( 'content', 'product' ); ?>

            <?php endwhile; // end of the loop. ?>

        </ul>

    </div>

<?php endif;

wp_reset_query();