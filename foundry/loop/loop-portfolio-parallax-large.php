<?php 
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		
		/**
		 * Get blog posts by blog layout.
		 */
		get_template_part('loop/content-portfolio', 'parallax-large');
	
	endwhile;	
	else : 
		
		/**
		 * Display no posts message if none are found.
		 */
		get_template_part('loop/content','none');
		
	endif;