<?php

class AQ_Clients_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Clients',
			'size' => 'span12',
			'resizable' => 0,
			'block_description' => 'Add your client logos<br />to the page.'
		);
		parent::__construct('aq_clients_block', $block_options);
	}//end construct
	
	function form($instance) {
		$defaults = array(
			'pppage' => '10',
			'filter' => 'all'
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		$args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'client-category'
		); 
			
		$filter_options = get_categories( $args );
	?>
	
	<p class="description">
		<label for="<?php echo $this->get_field_id('pppage') ?>">
			Posts Per Page
			<?php echo aq_field_input('pppage', $block_id, $pppage, $size = 'full', $type = 'number') ?>
		</label>
	</p>
	
	<p class="description">
		<label for="<?php echo $this->get_field_id('filter') ?>">
			Show Clients from a specific category?<br />
			<?php echo ebor_portfolio_field_select('filter', $block_id, $filter_options, $filter) ?>
		</label>
	</p>
		
	<?php
	}//end form
	
	function block($instance) {
		extract($instance);
	
		$query_args = array(
			'post_type' => 'client',
			'posts_per_page' => $pppage
		);
		
		if (!( $filter == 'all' )) {
			if( function_exists( 'icl_object_id' ) ){
				$filter = (int)icl_object_id( $filter, 'client-category', true);
			}
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'client-category',
					'field' => 'id',
					'terms' => $filter
				)
			);
		}
	
		$clients_query = new WP_Query( $query_args );	
	?>
		
		<div class="wow fadeIn pad45" data-wow-offset="80">
			<div id="clients-carousel" class="clients-carousel">
			
				<?php 
					if ( $clients_query->have_posts() ) : while ( $clients_query->have_posts() ) : $clients_query->the_post(); 
						
						get_template_part('loop/content','client');
						
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
		</div>	
		<div class="pad45"></div>
			
	<?php	
	}//end block
	
}//end class