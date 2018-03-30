<?php get_header(); ?>
			
			<!--BEGIN #primary .hfeed-->
			<div id="primary" class="hfeed">
			<?php if (have_posts()) : ?>

			<h1 class="page-title"><?php printf( __('Search Results for: %s', 'framework'), get_search_query()); ?></h1>

			<?php while (have_posts()) : the_post(); ?>

				<!--BEGIN .hentry -->
				<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">				
					
					<?php
					    // Determine post format and get appropriate file
					    $format = get_post_format();
					    if( $format == '' ) {
					        get_template_part( 'includes/standard' );
					    } else {
					        get_template_part( 'includes/' . $format );
					    }
					?>
                
				<!--END .hentry-->  
				</div>

			<?php endwhile; ?>

			<!--BEGIN .navigation .page-navigation -->
			<div class="navigation page-navigation">
				<div class="nav-next"><?php next_posts_link(__('&larr; Older Entries', 'framework')) ?></div>
				<div class="nav-previous"><?php previous_posts_link(__('Newer Entries &rarr;', 'framework')) ?></div>
			<!--END .navigation ,page-navigation -->
			</div>

			<?php else : ?>
				
				<h1 class="page-title"><?php _e('Your search did not match any entries','framework') ?></h1 >
				
				<!--BEGIN #post-0-->
				<div id="post-0">
					
					<!--BEGIN .entry-header-->
					<div class="entry-header">
					<!--END .entry-header-->
					</div>
										
					<!--BEGIN .entry-content-->
					<div class="entry-content">
						<?php get_search_form(); ?>
						<p><?php _e('Suggestions:','framework') ?></p>
						<ul>
							<li><?php _e('Make sure all words are spelled correctly.', 'framework') ?></li>
							<li><?php _e('Try different keywords.', 'framework') ?></li>
							<li><?php _e('Try more general keywords.', 'framework') ?></li>
						</ul>
					<!--END .entry-content-->
					</div>
					
					<!--BEGIN .entry-footer-->
					<div class="entry-footer">
					<!--END .entry-footer-->
					</div>
					
				<!--END #post-0-->
				</div>

			<?php endif; ?>
			<!--END #primary .hfeed-->
			</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>