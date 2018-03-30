<?php
/**
 * Template Name: Blog
 *
 * A custom page template for blog page.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress

 */
?>
<?php get_header(); ?>


		
		<div id="content">

			<div class="post-wrap">

				<?php if ( get_query_var('paged') ) {
                        	$paged = get_query_var('paged');
                		} elseif ( get_query_var('page') ) {
                        	$paged = get_query_var('page');
                		} else {
                        	$paged = 1;
                		}
				$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'paged' => $paged
				);		
				query_posts($args); 
				global $more; $more = 0;
				?>
				
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				
					<div <?php post_class('post'); ?>>
						<!-- uses the post format -->
						<?php
							if(!get_post_format()) {
							   get_template_part('format', 'standard');
							} else {
							   get_template_part('format', get_post_format());
							};
						?>
					</div><!-- post-->
	
				
				<?php endwhile; ?>
			</div><!-- post wrap -->
				<?php if(is_single()) { } else { ?>	
					<!-- post navigation -->
					<div class="post-nav">
						<div class="postnav-left"><?php previous_posts_link(__('Newer Posts', 'cr')) ?></div>
						<div class="postnav-right"><?php next_posts_link(__('Older Posts', 'cr')) ?></div>	
						<div style="clear:both;"> </div>
					</div><!-- end post navigation -->
				<?php } ?>
				<?php else: ?>
				
				<?php endif; wp_reset_query();?><!-- end posts -->

		</div><!--content-->
		
		<!-- grab the sidebar -->
		<?php get_sidebar(); ?>
	
		<!-- grab footer -->
		<?php get_footer(); ?>