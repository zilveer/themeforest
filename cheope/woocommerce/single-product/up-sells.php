<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) return;

$args = array(
    'post_type'           => 'product',
    'ignore_sticky_posts' => 1,
    'posts_per_page'      => 4,
    'no_found_rows'       => 1,
    'orderby'             => 'rand',
    'post__in'            => $upsells,
    'post__not_in'        => array( $product->id )
);

$products = new WP_Query( $args );

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
    <div class="upsells products <?php echo $span_class ?>">

        <?php printf( '<h2>%s</h2>', apply_filters( 'yit_upsells_title', __('You may also like&hellip;', 'yit') ) ) ?>

        <ul class="products">

            <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                <?php wc_get_template_part( 'content', 'product' ); ?>

            <?php endwhile; // end of the loop. ?>

        </ul>

    </div>

<?php endif;

wp_reset_postdata();