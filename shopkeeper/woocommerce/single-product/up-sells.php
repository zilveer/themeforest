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

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $posts_per_page,
	'orderby'             => $orderby,
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->id ),
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

    <div class="large-12 columns">
        <h2><?php _e( 'You may also like&hellip;', 'woocommerce' ) ?></h2>
    </div>
    
    <?php $upsells_products_number = $products->post_count; ?>
    
    <?php if ( $upsells_products_number > 0 ) : ?>
    
    <div id="upsells-products-carousel" class="owl-carousel upsells products">

        <?php while ( $products->have_posts() ) : $products->the_post(); ?>    
            <ul><?php wc_get_template_part( 'content', 'product' ); ?></ul>    
        <?php endwhile; // end of the loop. ?>

    </div>
    
    <?php else : ?>
    
    <?php
        
        //$upsells_products_number = $products->post_count;
        switch ($upsells_products_number) {
        case 0:
            $upsells_products_centered_column ='large-12 medium-12 small-12';
            $upsells_products_item_column ='large-3 medium-3 small-6';
            break;
        case 1:
            $upsells_products_centered_column ='large-3 medium-4 small-6';
            $upsells_products_item_column ='large-12 medium-12 small-12';
            break;
        case 2:
            $upsells_products_centered_column ='large-6 medium-8 small-12';
            $upsells_products_item_column ='large-6 medium-6 small-6';
            break;
        case 3:
            $upsells_products_centered_column ='large-9 medium-12 small-12';
            $upsells_products_item_column ='large-4 medium-4 small-6';
            break;
        default:
            $upsells_products_centered_column ='large-12 medium-12 small-12';
            $upsells_products_item_column ='large-3 medium-3 small-6';
    }
        
    ?>
    
    
    <div class="upsells products">

    <div class="<?php echo $upsells_products_centered_column; ?> large-centered medium-centered small-centered columns">
        <div class="row">

            <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                <div class="<?php echo $upsells_products_item_column; ?> columns">
                    <ul>
                        <?php wc_get_template_part( 'content', 'product' ); ?>
                    </ul>
                </div>

            <?php endwhile; // end of the loop. ?>

        </div>
    </div>

	</div>
    
    <?php endif; ?>    

<?php endif;

wp_reset_postdata();
