<?php get_header(); ?>
			
		<div class="container background row-fluid main-container">

			<!--BEGIN #main-content -->
			<section class="main-content span9">
	            		
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<!--BEGIN .post -->
					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">		                
	    
	                        <!--BEGIN .entry-content -->
	                        <div class="entry-content">
	                        
	                            <?php the_content(); ?>
	                            
	                        <!--END .entry-content -->
	                        </div>     
	                          
					<!--END .post-->  
					</div>

				<?php endwhile; ?>
	                
	            <?php comments_template('', true); ?>

				<?php else : ?>

					<!--BEGIN #post-0-->
					<div id="post-0" <?php post_class(); ?>>
					
						<h2 class="entry-title"><?php _e('Error 404 - Not Found', 'framework') ?></h2>
					
						<!--BEGIN .entry-content-->
						<div class="entry-content">
							<p><?php _e("Sorry, but you are looking for something that isn't here.", "framework") ?></p>
						<!--END .entry-content-->
						</div>
					
					<!--END #post-0-->
					</div>

				<?php endif; ?>

			<!--END main-content -->
			</section>


<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>