<?php get_header(); ?>
			
			<!-- BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
			<?php if (have_posts()) : ?>

			<h1 class="page-title"><?php _e('Search Results for', 'zilla') ?> &#8220;<?php the_search_query(); ?>&#8221;</h1>

			<?php while (have_posts()) : the_post(); ?>
            
			<?php zilla_post_before(); ?>
			<!-- BEGIN .hentry -->
			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">				
			<?php zilla_post_start(); ?>
			
			<?php
			    $format = get_post_format();
			    $format = ($format) ? $format : 'standard';
			    				    
			    get_template_part( 'content', $format);
			    
			    if( $format == 'standard' || $format == 'gallery' || $format == 'video' || $format == 'audio' ) {
			        get_template_part( 'content', 'meta' ); 
			    }
			?>
				                
            <?php zilla_post_end(); ?>
			<!-- END .hentry-->  
			</div>
			<?php zilla_post_after(); ?>

			<?php endwhile; ?>

			<?php 
    		$pagination = zilla_get_option('post_pagination_type');
    		if( $pagination == 'loadmore' ) { 
    		    if( $wp_query->max_num_pages > 1 ) { ?>
    		        <a href="#" id="load-more" data-width="580"><?php _e('Load More', 'zilla'); ?></a>
    		    <?php }
    		} else { ?>
    		    <!-- BEGIN .navigation .page-navigation -->
        		<div class="navigation page-navigation">
    			    <div class="nav-next">
    				    <?php next_posts_link(__('Older Entries', 'framework')); ?>
    				</div>
    				<div class="nav-previous">
    				    <?php previous_posts_link(__('Newer Entries', 'framework')) ?>
    				</div>
    			<!-- END .navigation .page-navigation -->
        		</div>
    		<?php } ?>

			<?php else : ?>
				
				<h1 class="page-title"><?php _e('Your search did not match any entries', 'zilla') ?></h1 >
				
				<!-- BEGIN #post-0-->
				<div id="post-0" class="hentry">
					
					<!-- BEGIN .entry-content-->
					<div class="entry-content">
						<?php get_search_form(); ?>
						<p><?php _e('Suggestions:','zilla') ?></p>
						<ul>
							<li><?php _e('Make sure all words are spelled correctly.', 'zilla') ?></li>
							<li><?php _e('Try different keywords.', 'zilla') ?></li>
							<li><?php _e('Try more general keywords.', 'zilla') ?></li>
						</ul>
					<!-- END .entry-content-->
					</div>
					
				<!-- END #post-0-->
				</div>

			<?php endif; ?>
			<!-- END #primary .hfeed-->
			</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>