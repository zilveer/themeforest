<?php

// [products_slider]
function shortcode_products_slider($atts, $content = null) {
	global $woocommerce;
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		'title' => '',
		'per_page'  => '12',
		'columns'  => '4',
		'layout'  => 'listing',
        'orderby' => 'date',
        'order' => 'desc'
	), $atts));
	ob_start();
	?>

    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if (class_exists('WooCommerce')) {
	?>
    
     <div class="woocommerce shortcode_products_slider">
         <div id="products-carousel-<?php echo $sliderrandomid ?>" class="owl-carousel related products">
            <?php
			
			$args = array(
				'post_type'				=> 'product',
				'post_status' 			=> 'publish',
				'ignore_sticky_posts'	=> 1,
				'orderby' 				=> $orderby,
				'order' 				=> $order,
				'posts_per_page' 		=> -1,
				'meta_query' 			=> array(
					array(
						'key' 		=> '_visibility',
						'value' 	=> array('catalog', 'visible'),
						'compare' 	=> 'IN'
					)
				)
			);
	
			if ( isset( $atts['ids'] ) ) {
				$ids = explode( ',', $atts['ids'] );
				$ids = array_map( 'trim', $ids );
				$args['post__in'] = $ids;
			}
            
            $products = new WP_Query( $args );
            
            if ( $products->have_posts() ) : ?>
                        
                <?php while ( $products->have_posts() ) : $products->the_post(); ?>
            
                    <ul><?php wc_get_template_part( 'content', 'product' ); ?></ul>
        
                <?php endwhile; // end of the loop. ?>
                
            <?php
            
            endif;
            
            ?>
        </div>
    </div>
    
    <?php } ?>
    
	<script>
	jQuery(document).ready(function($) {

		"use strict";
		
		$("#products-carousel-<?php echo $sliderrandomid ?>").owlCarousel({
			items:<?php echo $columns; ?>,
			itemsDesktop : [1200,<?php echo $columns; ?>],
			itemsDesktopSmall : [1000,3],
			itemsTablet: false,
			itemsMobile : [600,2],
			lazyLoad : true
		});
	
	});
	</script>

	<?php
    wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("products_slider", "shortcode_products_slider");

