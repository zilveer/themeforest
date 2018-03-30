<?php 
/* 
Template Name: Custom Archive
*/ 
?>

<?php get_header(); ?>
		
		<div id="content" class="filter-posts">
			
			<!-- grab the posts -->
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<div data-id="post-<?php the_ID(); ?>" data-type="post-<?php the_ID(); ?>" class="post-<?php the_ID(); ?> post page clearfix project">
					
					<div class="frame frame-full">
						<div class="title-wrap">
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
						</div>
						
						<div class="post-content post-content-full">
							<?php the_content(); ?>
								
							<div id="archive">
								<div class="columnize">
									<h3><?php _e('By Day','cr'); ?></h3>
									<ul>
										<?php wp_get_archives('type=daily&limit=25'); ?>
									</ul>	
								</div>
								
								<div class="columnize">
									<h3><?php _e('Recent Posts','cr'); ?></h3>
									<ul>
										<?php wp_get_archives('type=postbypost&limit=20'); ?>
									</ul>
								</div>
								
								<div class="columnize">
									<h3><?php _e('Contributors','cr'); ?></h3>
									<ul>
										<?php wp_list_authors('show_fullname=1&optioncount=1&orderby=post_count&order=DESC'); ?>
									</ul>
									
									<h3><?php _e('Pages','cr'); ?></h3>
									<ul>
										<?php wp_list_pages('sort_column=menu_order&title_li='); ?>
									</ul>
									
									<h3><?php _e('Categories','cr'); ?></h3>
									<ul>
										<?php wp_list_categories('orderby=name&title_li='); ?> 
									</ul>
								</div>
								
								<div class="columnize columnize-last">				
									<h3><?php _e('By Month','cr'); ?></h3>
									<ul>
										<?php wp_get_archives('type=monthly&limit=12'); ?>
									</ul>
									
									<h3><?php _e('By Year','cr'); ?></h3>
									<ul>
										<?php wp_get_archives('type=yearly&limit=12'); ?>
									</ul>
								</div>
							</div>
							
						</div>
					</div><!-- frame -->
					
			</div><!--writing post-->				
			
			<?php endwhile; ?>
			<?php endif; ?>
	
		</div><!--content-->
		
		<!-- grab the sidebar -->
		<?php get_sidebar(); ?>

		<!-- grab footer -->
		<?php get_footer(); ?>
	</div><!--main-->
