<section class="projects p0 bg-dark no-hover">

    <?php 
    	get_template_part('inc/content', 'portfolio-filter-full'); 
    	get_template_part('inc/content','post-loader-full'); 
    ?>
    
    <div class="row masonry masonryFlyIn">
    	<?php 
    		if ( have_posts() ) : while ( have_posts() ) : the_post();
    			
    			/**
    			 * Get blog posts by blog layout.
    			 */
    			get_template_part('loop/content-portfolio', 'full-masonry-2col');
    		
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