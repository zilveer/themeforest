<?php

/**
 * 
 * by www.unitedthemes.com
 */

?>

<?php if( is_page() ) { get_header(); } ?>

        <div class="grid-container">
    	
        <?php $grid = is_active_sidebar('page-widget-area') ? 'grid-75 tablet-grid-75 mobile-grid-100' : 'grid-100 tablet-grid-100 mobile-grid-100'; ?>
        
        <div id="primary" class="grid-parent <?php echo $grid; ?>">
        
            <?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'partials/content', 'page' ); ?>
			
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

			<?php endwhile; // end of the loop. ?>
         
       </div><!-- primary --> 
        
       <?php get_sidebar('page'); ?>
       
       </div><!-- grid-container -->    
   	   
       <div class="ut-scroll-up-waypoint" data-section="section-<?php echo $post->post_name; ?>"></div> 
        
<?php if( is_page() ) { get_footer(); } ?>