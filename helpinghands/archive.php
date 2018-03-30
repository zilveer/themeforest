<?php
/**
 * Archive Page
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */
 
get_header();

?>

<div class="sd-blog-page">
	<div class="container">
		<div class="row"> 
			<!--left col-->
			<div class="col-md-<?php if ( $sd_data['sd_blog_layout'] == '2' ) echo '12'; else echo '8'; ?> <?php if ( $sd_data['sd_sidebar_location'] == '2' ) echo 'pull-right'; ?>">
				<div class="sd-left-col">
				<?php global $wp_query;
			   	      global $more;
			   	 	  $more = 0;
				?>
					<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'framework/inc/post-formats/content', get_post_format() ); ?>
					<?php endwhile; else: ?>
					<p>
						<?php _e( 'Sorry, no posts matched your criteria', 'sd-framework' ) ?>
						. </p>
					<?php endif; wp_reset_postdata(); ?>
					<!--pagination-->
					<?php if ( $sd_data['sd_pagination_type'] == '1' ) : ?>
						<?php if ( get_previous_posts_link() ) : ?>
						<div class="sd-nav-previous">
							<?php previous_posts_link( $sd_data['sd_blog_prev'] ); ?>
						</div>
						<?php endif; ?>
						<?php if ( get_next_posts_link() ) : ?>
						<div class="sd-nav-next">
							<?php next_posts_link( $sd_data['sd_blog_next'] ); ?>
						</div>
						<?php endif; ?>
					<?php else : sd_custom_pagination(); endif; ?>
					<!--pagination end--> 
					<!--pagination end--> 
				</div>
			</div>
			<!--left col end--> 
			<?php if ( $sd_data['sd_blog_layout'] !== '2' ) : ?>
			<!--sidebar-->
			<div class="col-md-4">
				<?php get_sidebar(); ?>
			</div>
			<!--sidebar end--> 
			<?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
