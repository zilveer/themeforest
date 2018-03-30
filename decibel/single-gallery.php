<?php
/**
 * The Template for displaying all single gallery posts.
 */
get_header();
wolf_post_before();
?>
	<div id="primary" class="content-area">
		<main id="content" class="site-content clearfix" role="main">
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php wolf_post_start(); ?>

				<div class="entry-content">
					<?php //the_content(); ?>
					<?php echo wolf_featured_gallery();  ?>
				</div><!-- entry-content -->

			</article><!-- article.post -->
				<?php wolf_post_end(); ?>
				<?php wolf_post_nav(); ?>

				<?php
				if ( wolf_get_theme_option( 'gallery_comments' ) )
					comments_template();
				?>
		<?php endwhile; ?>
		</main><!-- main#content .site-content-->
	</div><!-- #primary .content-area -->
<?php
wolf_post_after();
get_footer();
?>
