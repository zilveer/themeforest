<?php
/*
Template Name: Fullwidth
*/
?>
<?php get_header(); ?>

<?php get_template_part('inc_section'); ?>

<div class="row">

	<div class="twelve columns content content-single content-fullwidth">

		<article class="post">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<?php if(ci_setting('featured_single_show')=='enabled'): ?>
					<?php the_post_thumbnail('ci_fullwidth'); ?>
				<?php endif; ?>

				<div class="post-body row">
					<div class="post-copy-wrap twelve columns">
						<div class="post-copy post-page group">
							<h2><?php the_title(); ?></h2>
							<?php the_content(); ?>
							<?php wp_link_pages(); ?>
						</div>
					</div><!-- /post-body-wrap -->
				</div><!-- /post-body -->
			<?php endwhile; endif; ?>

			<?php comments_template(); ?>
		</article><!-- /article -->

	</div><!-- /content -->

</div><!-- /row -->

<?php get_footer(); ?>