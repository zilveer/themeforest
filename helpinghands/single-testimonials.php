<?php
/**
 * Theme Single Post
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.1.3
 */

get_header(); 

global $sd_data;

?>
<div class="container sd-blog-page">
	<div class="row"> 
		<div class="col-md-<?php if ( $sd_data['sd_blog_layout'] == '2' ) { echo '12'; } else { echo '8'; } ?> <?php if ( $sd_data['sd_sidebar_location'] == '2' ) echo 'pull-right'; ?>">
			<div class="sd-left-col">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry sd-single-blog-entry clearfix ' ); ?>> 
						<?php get_template_part( 'framework/inc/post-formats/single', get_post_format() ); ?>
						<?php get_template_part( 'framework/inc/next-prev-single' ); ?>
					</article>
					<!-- sd-blog-entry -->
				<?php endwhile; else: ?>
					<p><?php _e( 'Sorry, no posts matched your criteria', 'sd-framework' ) ?>.</p>
				<?php endif; ?>

				<?php if ( $sd_data['sd_blog_comments'] == '1' ) : ?>
					<?php comments_template( '', true ); ?>
				<?php endif; ?>
			</div>
			<!-- sd-left-col -->
		</div>
		<!-- col-md-8 --> 
		<?php if ( $sd_data['sd_blog_layout'] !== '2' ) : ?>
		<div class="col-md-4">
			<?php get_sidebar(); ?>
		</div>
		<?php endif; ?>
	</div>
	<!-- row -->
</div>
<!-- sd-blog-page -->
<?php get_footer(); ?>