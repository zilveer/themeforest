<?php get_header(); ?>
		
		<div class="container background row-fluid main-container">

			<!--BEGIN #main-content -->
			<section class="main-content span9">

				<h3 class="page-title"><span class="the-page-title"><?php _e('Search Results for', 'framework') ?> &#8220;<?php the_search_query(); ?>&#8221;</span>							
				</h3>


        	<ul class="posts-list">	    	
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
				<!--BEGIN post -->
				<li <?php post_class(); ?> id="post-<?php the_ID(); ?>">

					<!--BEGIN .entry-content -->
		            <div class="entry-content span12">

		            	<div class="entry-meta-top">

					<h4 class="date-of-post"><?php _e('On', 'framework'); ?> <span class="updated"><?php the_time( get_option('date_format') ); ?></span> <?php _e('by', 'framework'); ?> <span class="vcard author"><?php the_author_posts_link(); ?></span></h4>

				</div>

                <?php if( is_singular() ) { ?>
                    
                    <h1 class="entry-title span12"><?php the_title(); ?></h1>
                    
                <?php } else { ?>
                    
                    <h1 class="entry-title span12">
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

                <div class="the-content">
                    <?php the_content(__('Read more', 'framework')); ?>
                </div>

                <?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'framework').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

		            <!--END .entry-content -->
		            </div>
						
				<!--END post-->  
				</li>
					
				<?php endwhile; ?>

			</ul>

			<!--BEGIN .navigation-->
			<div class="navigation-posts">
            
				<div class="nav-prev"><?php next_posts_link(__('&larr; Older Entries', 'framework')) ?></div>
				<div class="nav-next"><?php previous_posts_link(__('Newer Entries &rarr;', 'framework')) ?></div>
                
			<!--END .navigation-->
			</div>

			<?php else : ?>
	
			<h1 class="page-title"><?php _e('Your search did not match any entries', 'framework') ?></h1 >
				
				<!--BEGIN #post-0-->
				<div id="post-0">
					
					<!--BEGIN .entry-content-->
					<div class="entry-content">
					    <p><?php _e('You searched: ', 'framework'); ?>&#8220;<?php the_search_query(); ?>&#8221;</p>
						<p><?php _e('Suggestions:','framework') ?></p>
						<ul>
							<li><?php _e('Make sure all words are spelled correctly.', 'framework') ?></li>
							<li><?php _e('Try different keywords.', 'framework') ?></li>
							<li><?php _e('Try more general keywords.', 'framework') ?></li>
						</ul>
						<?php get_search_form(); ?>
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