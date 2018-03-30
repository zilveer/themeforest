<?php get_header(); ?>

<div class="maincontainer">
	   		<div class="pagetitle"><h1><?php the_title(); ?></h1></div>
			<div class="contentwrapper1">

 				 <div class="contentleft">
				  
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

							<div class="entry">
							<?php 
								if ( has_post_thumbnail() ) {
								echo the_post_thumbnail(medium);
								} else {
									// the current post lacks a thumbnail
								}
								 the_content();
									wp_link_pages(array('before' => '<p>'.__('Pages:','bw_themes'),'after' => '</p>', 'next_or_number' => 'number')); ?>
							</div>

							<?php edit_post_link(__('Edit this Page', 'bw_themes' ),'','.'); ?>
					</div>
					<div class="clear"></div>
					<?php comments_template();
					endwhile; ?>

					

					<?php else : ?>

						<p><?php _e('Sorry, no posts matched your criteria.', 'bw_themes'); ?></p>

					<?php endif; ?>
				</div><!-- END DIV contentleft -->
				<div class="contentright">
					<?php get_sidebar(); ?>
				</div>		
			</div><!-- END DIV contentwrapper -->
			<div class="footerwrapper">
				<?php get_footer(); ?>
