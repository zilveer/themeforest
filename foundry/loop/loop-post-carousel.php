<section class="p0 bg-dark">
    <div class="blog-carousel">
    	<?php 
    		if ( have_posts() ) : while ( have_posts() ) : the_post();
    			
    			/**
    			 * Get blog posts by blog layout.
    			 */
    			get_template_part('loop/content-post', 'carousel');
    		
    		endwhile;	
    		else : 
    			
    			/**
    			 * Display no posts message if none are found.
    			 */
    			get_template_part('loop/content','none');
    			
    		endif;
    	?>	
    </div>
</section>