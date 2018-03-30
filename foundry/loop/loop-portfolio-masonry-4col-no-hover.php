<section class="projects pt48 no-hover">
    <div class="container">
    
        <?php 
        	get_template_part('inc/content', 'portfolio-filter'); 
        	get_template_part('inc/content','post-loader'); 
        ?>
        
        <div class="row masonry masonryFlyIn">
	        <?php 
	        	if ( have_posts() ) : while ( have_posts() ) : the_post();
	        		
	        		/**
	        		 * Get blog posts by blog layout.
	        		 */
	        		get_template_part('loop/content-portfolio', 'masonry-4col');
	        	
	        	endwhile;	
	        	else : 
	        		
	        		/**
	        		 * Display no posts message if none are found.
	        		 */
	        		get_template_part('loop/content','none');
	        		
	        	endif;
	        ?>
        </div>
         
    </div>
</section>