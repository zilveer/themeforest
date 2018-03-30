<?php function thb_product_singlepage( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_product_singlepage', $atts );
  extract( $atts );
			
	$args = array(
		'posts_per_page'      => 1,
		'post_type'           => 'product',
		'post_status'         => 'publish',
		'ignore_sticky_posts' => 1,
		'no_found_rows'       => 1,
		'p'		=> $product_id
	);
	$single_product = new WP_Query( $args );
 	$preselected_id = '0';
	// check if sku is a variation
	if ( isset( $atts['sku'] ) && $single_product->have_posts() && $single_product->post->post_type === 'product_variation' ) {
		$variation = new WC_Product_Variation( $single_product->post->ID );
		$attributes = $variation->get_variation_attributes();
		// set preselected id to be used by JS to provide context
		$preselected_id = $single_product->post->ID;
		// get the parent product object
		$args = array(
			'posts_per_page'      => 1,
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'no_found_rows'       => 1,
			'p'                   => $single_product->post->post_parent
		);
		$single_product = new WP_Query( $args );
	?>
		<script type="text/javascript">
			jQuery( document ).ready( function( $ ) {
				var $variations_form = $( '[data-product-page-preselected-id="<?php echo esc_attr( $preselected_id ); ?>"]' ).find( 'form.variations_form' );
				<?php foreach( $attributes as $attr => $value ) { ?>
					$variations_form.find( 'select[name="<?php echo esc_attr( $attr ); ?>"]' ).val( '<?php echo $value; ?>' );
				<?php } ?>
			});
		</script>
	<?php
	}
 	ob_start();
 	
	while ( $single_product->have_posts() ) : $single_product->the_post(); wp_enqueue_script( 'wc-single-product' ); ?>
		<div class="single-product single-product-shortcode full-height-content" data-product-page-preselected-id="<?php echo esc_attr( $preselected_id ); ?>">	
			<?php wc_get_template_part( 'content', 'single-product' ); ?>
		</div>
	<?php endwhile; // end of the loop.
	
	wp_reset_postdata();
	   
	$out = ob_get_contents();
	if (ob_get_contents()) ob_end_clean();
	return $out;
}
add_shortcode('thb_product_singlepage', 'thb_product_singlepage');