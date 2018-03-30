<?php get_header(); ?>      


<div class="container background row-fluid main-container">

		<!--BEGIN main content-->
		<section class="main-content span9">
        		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<!--BEGIN post -->
			<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">	              

				<!--BEGIN .entry-content -->
                <div class="entry-content span12" style="margin-left: 0">                	         

	            	<div class="entry-meta-top">

						<h4 class="date-of-post"><?php _e('On', 'framework'); ?> <span class="updated"><?php the_time( get_option('date_format') ); ?></span> <?php _e('by', 'framework'); ?> <span class="vcard author"><span class="fn"><?php the_author_posts_link(); ?></span></span></h4>

					</div>                	

                    <?php if( is_singular() ) { ?>
                    
                    	<h1 class="entry-title span12"><?php the_title(); ?></h1>
                    
                	<?php } else { ?>
                    
	                    <h1 class="entry-title">
	                        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'framework'), get_the_title()); ?>">      
	                            <?php the_title(); ?>
	                        </a>
	                    </h1>
	                    
                	<?php } ?>

					<?php 
				        $format = get_post_format(); 
				        if( false === $format ) { $format = 'standard'; }
				    ?>
				    
					<?php get_template_part( 'post', $format ); ?>
				
                    <div class="no-bottom">
                        <?php the_content(__('Read more &rarr;', 'framework')); ?>
                    </div>
                            
                    <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'framework').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

                    <span class="post-tags"><?php the_tags(__('Tags:', 'framework'), '', ''); ?></span>

                    <!--END .entry-content -->
                    </div>    

                    <div class="post-navigation">
	                    <div class="prev-post">
							<?php previous_post_link('%link'); ?>
						</div>
						<div class="next-post">
							<?php next_post_link('%link'); ?> 
						</div>                                                       
					</div>


                <!--END POST CONTENT -->
                </article>                        

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
        
        
		<!--END main content-->
		</section>

	<?php get_sidebar(); ?>

	</div>

<?php get_footer(); ?>