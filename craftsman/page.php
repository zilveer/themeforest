<?php
/**
 * The template for displaying all pages
 */
?>

<?php get_header(); ?>

		<div id="container" class="row-inner">
			<div id="content">

				<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
					<div class="entry-content clearfix">
						<?php the_content(); ?>
					</div><!-- .entry-content -->
				</article>

				<?php if (ot_get_option('page_comments') != 'off') {
					echo '<div class="row-inner"><div class="vc_span12 wpb_column column_container">';
						comments_template( '', true );
					echo '</div></div>';
				} ?>
				<?php endwhile; ?>

			</div><!-- #content -->
		</div><!-- #container -->
		
<?php get_footer(); ?>