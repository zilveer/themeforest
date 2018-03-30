<?php

class AQ_Team_Feed_Block extends AQ_Block {
	
	//set and create block
	function __construct() {
		$block_options = array(
			'name' => 'Team Feed',
			'size' => 'span12',
			'resizable' => 0,
			'block_description' => 'Add a feed of<br />team posts to the page.'
		);
		parent::__construct('aq_team_feed_block', $block_options);
	}//end construct
	
	function form($instance) {
		$defaults = array(
			'pppage' => '6',
			'filter' => 'all',
			'wpautop' => 0
		);
		
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		$args = array(
			'orderby'                  => 'name',
			'hide_empty'               => 0,
			'hierarchical'             => 1,
			'taxonomy'                 => 'team-category'
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
				Show a specific Team Category?
				<?php echo ebor_portfolio_field_select('filter', $block_id, $filter_options, $filter) ?>
			</label>
		</p>
		
		<p class="description">
			<label for="<?php echo $this->get_field_id('wpautop') ?>">
				Disable Links?
				<?php echo aq_field_checkbox('wpautop', $block_id, $wpautop) ?>
			</label>
		</p>
		
	<?php
	}//end form
	
	function block($instance) {
		extract($instance);
		
		if(!( isset($wpautop) ))
			$wpautop = false;
	
		$query_args = array(
			'post_type' => 'team',
			'posts_per_page' => $pppage
		);
		
		if (!( $filter == 'all' )) {
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'team-category',
					'field' => 'id',
					'terms' => $filter
				)
			);
		}
	
		$team_query = new WP_Query( $query_args );	
		
		$type = ($wpautop) ? 'team-no-link' : 'team';
	?>
	
		<div class="pad45"></div>
			
		<div id="grid-container" class="cbp-l-grid-team">
		    <ul class="cbp-l-grid-team">
				<?php 
					if ( $team_query->have_posts() ) : while ( $team_query->have_posts() ) : $team_query->the_post(); 
					
						/**
						 * Get team member markup
						 */
						get_template_part('loop/content', $type);

					endwhile;
					else : 
						
						/**
						 * Display no posts message if none are found.
						 */
						get_template_part('loop/content','none');
						
					endif;
					wp_reset_query();
				?>
		    </ul>
		</div>
		
		<div class="pad60"></div>
			
	<?php	
	}//end block
	
}//end class