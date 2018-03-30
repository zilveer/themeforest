<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $mr_tailor_theme_options;

$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page' 		=> $posts_per_page,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related,
	'post__not_in'			=> array($product->id)
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= $columns;

if ( $products->have_posts() ) : ?>

    <div class="large-12 columns">
        <h2><?php _e( 'Related Products', 'woocommerce' ); ?></h2>
    </div>
    
    <?php $related_products_number = $products->post_count; ?>
    
    <?php if ( $related_products_number > 0 ) : ?>

    <div id="related-products-carousel" class="owl-carousel related products">

		<?php while ( $products->have_posts() ) : $products->the_post(); ?>
        	<ul><?php wc_get_template_part( 'content', 'product' ); ?></ul>
        <?php endwhile; // end of the loop. ?>      

    </div>
    
    <?php else : ?>
    
    <?php
        
        //$related_products_number = $products->post_count;
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
    
    <div class="related products">
    
    <div class="<?php echo $related_products_centered_column; ?> large-centered medium-centered small-centered columns">
        <div class="row">
            
            <?php while ( $products->have_posts() ) : $products->the_post(); ?>
            
                <div class="<?php echo $related_products_item_column; ?> columns">
                    <ul>
                        <?php wc_get_template_part( 'content', 'product' ); ?>
                    </ul>
                </div>
    
            <?php endwhile; // end of the loop. ?>
        
        </div>
    </div>
        
    </div>
    
    <?php endif; ?>
    
    <?php
    
	if ( ( !isset($mr_tailor_theme_options['related_products_per_view']) ) ) {
		$related_products_per_view = 4;
	} else {
		$related_products_per_view = $mr_tailor_theme_options['related_products_per_view'];
	}
	
	?>
    
    <script>
	jQuery(document).ready(function($) {

		"use strict";
		
		$("#related-products-carousel").owlCarousel({
			items:<?php echo $related_products_per_view; ?>,
			itemsDesktop : [1200,<?php echo $related_products_per_view; ?>],
			itemsDesktopSmall : [1000,3],
			itemsTablet: false,
			itemsMobile : [600,2],
			lazyLoad : true,
			/*autoHeight : true,*/
		});
	
	});
	</script>

<?php endif;

wp_reset_postdata();
