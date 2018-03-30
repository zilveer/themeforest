<?php function thb_product( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_product', $atts );
  extract( $atts );
	global $woocommerce;
			
	$args = array();
	
	if ($product_sort == "latest-products") {
		$args = array(
				'post_type' => 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'   => 1,
				'posts_per_page' => $item_count
			);	    
	} else if ($product_sort == "featured-products") {			
		$args = array(
			    'post_type' => 'product',
			    'post_status' => 'publish',
				'ignore_sticky_posts'   => 1,
			    'meta_key' => '_featured',
			    'meta_value' => 'yes',
			    'posts_per_page' => $item_count
			);
	} else if ($product_sort == "top-rated") {
		add_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
				
		$args = array(
		    'post_type' => 'product',
		    'post_status' => 'publish',
				'ignore_sticky_posts'   => 1,
		    'posts_per_page' => $item_count
		);
		
	
	} else if ($product_sort == "sale-products") {
		$args = array(
			    'post_type' => 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'   => 1,
				'posts_per_page' => $item_count,
				'meta_query'     => array(
	        'relation' => 'OR',
	        array( // Simple products type
	            'key'           => '_sale_price',
	            'value'         => 0,
	            'compare'       => '>',
	            'type'          => 'numeric'
	        ),
	        array( // Variable products type
	            'key'           => '_min_variation_sale_price',
	            'value'         => 0,
	            'compare'       => '>',
	            'type'          => 'numeric'
	        )
	    	)
			);
	} else if ($product_sort == "by-category"){
		$args = array(
				'post_type' => 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'   => 1,
				'product_cat' => $cat,
				'posts_per_page' => $item_count
			);	    
	} else if ($product_sort == "by-id"){
		$product_id_array = explode(',', $product_ids);
		$args = array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'ignore_sticky_posts'   => 1,
			'post__in'		=> $product_id_array
		);	    
	} else {
		$args = array(
				'post_type' => 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'   => 1,
				'posts_per_page' => $item_count,
				'meta_key' 		=> 'total_sales',
				'orderby' 		=> 'meta_value'
			);	    
	}
 	$args['meta_query'] = $woocommerce->query->get_meta_query();
 	ob_start();
 	$products = new WP_Query( $args );
 	switch($columns) {
 		case 2:
 			$col = 'medium-6';
 			break;
 		case 3:
 			$col = 'medium-4';
 			break;
 		case 4:
 			$col = 'medium-3';
 			break;
		case 6:
 			$col = 'medium-2';
 			break;
 	}
 	$catalog_mode = ot_get_option('shop_catalog_mode', 'off');
 	
	if ( $products->have_posts() ) { ?>
	   
		<?php if ($carousel == "yes") { ?>
			
			<div class="carousel-container">
				<div class="carousel products slick row" data-columns="<?php echo esc_attr($columns); ?>" data-navigation="true">				
					
					<?php while ( $products->have_posts() ) : $products->the_post(); ?>
							<?php $product = wc_get_product( $products->post->ID ); ?>
							<?php wc_get_template_part( 'content', 'product' ); ?>
					
						<?php endwhile; // end of the loop. ?>
										
				</div>
			</div>
			
		<?php } else {  ?> 
			
		<div class="products shortcode row">
		
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
				<?php set_query_var( 'thb_columns', $col ); ?>
				<?php wc_get_template_part( 'content', 'product' ); ?>
		
			<?php endwhile; // end of the loop. ?>
		 
		</div>
		
		<?php } ?>
	   
	<?php }
	     
   $out = ob_get_contents();
   if (ob_get_contents()) ob_end_clean();
   
   wp_reset_query();
   wp_reset_postdata();
   remove_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
	   
  return $out;
}
add_shortcode('thb_product', 'thb_product');
