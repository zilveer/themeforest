<?php
	/**
	 * @package Foundry
	 * @author TommusRhodus
	 * @version 3.0.0
	 */
	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}
	
	global $product, $woocommerce_loop;
	
	if ( empty( $product ) || ! $product->exists() ) {
		return;
	}
	
	$related = $product->get_related( $posts_per_page );
	
	if ( sizeof( $related ) == 0 ) return;
	
	$args = apply_filters( 'woocommerce_related_products_args', array(
		'post_type'            => 'product',
		'ignore_sticky_posts'  => 1,
		'no_found_rows'        => 1,
		'posts_per_page'       => 3,
		'orderby'              => $orderby,
		'post__in'             => $related,
		'post__not_in'         => array( $product->id )
	) );
	
	$products = new WP_Query( $args );
	
	if ( $products->have_posts() ) : 
?>

<section class="pt0">
    <div class="container">
    
        <div class="row">
            <div class="col-sm-12">
                <h4 class="uppercase mb80 mb-xs-40"><?php _e( 'You May Also Like', 'foundry' ); ?></h4>
            </div>
        </div>

		<?php woocommerce_product_loop_start(); ?>
		
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
		
				<?php wc_get_template_part( 'content', 'product' ); ?>
		
			<?php endwhile; // end of the loop. ?>
		
		<?php woocommerce_product_loop_end(); ?>

    </div>
</section>

<?php endif;

wp_reset_postdata();