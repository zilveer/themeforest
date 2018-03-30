<?php function thb_product_single( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_product_single', $atts );
  extract( $atts );
			
	$args = array(
		'post_type' => 'product',
		'post_status' => 'publish',
		'ignore_sticky_posts'   => 1,
		'p'		=> $product_id
	);
	$products = new WP_Query( $args );
 	
 	ob_start();
 	
	if ( $products->have_posts() ) { while ( $products->have_posts() ) : $products->the_post(); ?>
		<div class="products">
			<?php wc_get_template_part( 'content', 'product' ); ?>
		</div>
	<?php endwhile;  }
	     
   $out = ob_get_contents();
   if (ob_get_contents()) ob_end_clean();
   
   wp_reset_query();
   wp_reset_postdata();
	   
  return $out;
}
add_shortcode('thb_product_single', 'thb_product_single');
