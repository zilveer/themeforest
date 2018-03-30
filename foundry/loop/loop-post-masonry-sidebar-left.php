<section class="bg-secondary">
    <div class="container">
    	<div class="row">
    	
	    	<?php get_sidebar(); ?>
	    
	        <div class="col-md-9">
	        
	            <?php get_template_part('inc/content','post-loader'); ?>
	            
	            <div class="row masonry masonryFlyIn mb40">
	                <?php 
	                	if ( have_posts() ) : while ( have_posts() ) : the_post();
	                		
	                		/**
	                		 * Get blog posts by blog layout.
	                		 */
	                		get_template_part('loop/content-post', 'masonry-2col');
	                	
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
        
        </div>
    </div>
</section>