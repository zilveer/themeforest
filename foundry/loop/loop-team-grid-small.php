<?php global $wp_query; ?>

<div class="row">
	<?php 
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			
			/**
			 * Get blog posts by blog layout.
			 */
			get_template_part('loop/content', 'team-grid-small');
			
			if( ( $wp_query->current_post + 1 ) % 4 == 0 ){
				echo '</div><div class="row">';
			}
		
		endwhile;	
		else : 
			
			/**
			 * Display no posts message if none are found.
			 */
			get_template_part('loop/content','none');
			
		endif;
	?>
</div>