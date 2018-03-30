<?php 
/**
 * Theme Normal Page
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

get_header(); 
?>
<!--left col-->

<div class="sd-blog-page">
	<div class="container">
		<div class="row"> 
			<div class="col-md-8 <?php if ( $sd_data['sd_sidebar_location'] == '2' ) echo 'pull-right'; ?>">
				<div class="sd-left-col">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry page-entry clearfix' ); ?>> 
							<div class="sd-entry-content">
								<?php the_content(); ?>
								<?php wp_link_pages( 'before=<strong class="page-navigation clearfix">&after=</strong>' ); ?>
							</div>
						</article>
					<?php endwhile; else: ?>
						<p> <?php _e( 'Sorry, no posts matched your criteria', 'sd-framework' ) ?>. </p>
					<?php endif; ?>
					<?php if ( $sd_data['sd_blog_comments'] == '1' ) : ?>
						<?php comments_template( '', true ); ?>
				<?php endif; ?>
				</div>
				<!-- sd-left-col -->
			</div>
			<!-- col-md-8 -->
			<div class="col-md-4">
				<?php get_sidebar(); ?>
			</div>
			<!-- col-md-4 --> 
		</div>
		<!-- row -->
	</div>
	<!-- container -->
</div>
<!-- sd-blog-page -->
<?php get_footer(); ?>
