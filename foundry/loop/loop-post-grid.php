<?php global $wp_query; ?>

<section>
	<div class="container">
	
		<div class="row mb40">
		    <?php 
		    	if ( have_posts() ) : while ( have_posts() ) : the_post();
		    		
		    		if( $wp_query->current_post % 3 == 0 && !( $wp_query->current_post == 0 ) ){
		    			echo '</div><div class="row mb40">';
		    		}
		    		
		    		/**
		    		 * Get blog posts by blog layout.
		    		 */
		    		get_template_part('loop/content-post', 'grid');
		    	
		    	endwhile;	
		    	else : 
		    		
		    		/**
		    		 * Display no posts message if none are found.
		    		 */
		    		get_template_part('loop/content','none');
		    		
		    	endif;
		    ?>
		</div>
		
		<div class="row">
		    <?php
		    	/**
		    	 * Post pagination, use ebor_pagination() first and fall back to default
		    	 */
		    	echo function_exists('ebor_pagination') ? ebor_pagination() : posts_nav_link();
		    ?>
		</div>
	
	</div>
</section>