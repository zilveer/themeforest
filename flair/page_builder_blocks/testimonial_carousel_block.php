<?php

class AQ_Testimonial_Carousel_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Testimonial Carousel',
			'size' => 'span12',
			'resizable' => 0,
			'block_description' => 'Add a carousel of<br />testimonials to the page.'
		);
		parent::__construct('aq_testimonial_carousel_block', $block_options);
	}//end construct
	
	function form($instance) {
		$defaults = array(
			'filter' => 'all'
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		$args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'testimonial-category'
		); 
			
		$filter_options = get_categories( $args );
	?>
	
		<p class="description">
			<label for="<?php echo $this->get_field_id('filter') ?>">
				Show Testimonials from a specific category?<br />
				<?php echo ebor_portfolio_field_select('filter', $block_id, $filter_options, $filter) ?>
			</label>
		</p>
	
	<?php
	}//end form
	
	function block($instance) {
		extract($instance);
	
		$query_args = array(
			'post_type' => 'testimonial',
			'posts_per_page' => -1
		);
		
		if (!( $filter == 'all' )) {
			if( function_exists( 'icl_object_id' ) ){
				$filter = (int)icl_object_id( $filter, 'testimonial-category', true);
			}
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'testimonial-category',
					'field' => 'id',
					'terms' => $filter
				)
			);
		}
	
		$testimonial_query = new WP_Query( $query_args );	
	?>
		
		<div class="testimonials owl-carousel thin text-center lead">
			
			<?php 
	    		if ( $testimonial_query->have_posts() ) : while ( $testimonial_query->have_posts() ) : $testimonial_query->the_post(); 
	    	?>
	    	
	    		<div class="item">
	    		  <?php echo htmlspecialchars_decode( get_the_content() ); ?><small><?php the_title(); ?></small>
	    		</div>
	    	
			<?php
	    		endwhile;
	    		else : 
	    			
	    			/**
	    			 * Display no posts message if none are found.
	    			 */
	    			get_template_part('loop/content','none');
	    			
	    		endif;
	    		wp_reset_query();
	    	?>

		</div>
			
	<?php	
	}//end block
	
}//end class