<?php
/**
 * The Template for displaying all single blog posts.
 */
get_header();
wolf_post_before();
?>
	<div id="primary" class="content-area">
		<main id="content" class="site-content clearfix" role="main">
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post();

				$layout = wolf_get_single_blog_post_layout();
				get_template_part( 'partials/single/post', 'single-' . $layout . '-content' );

			endwhile; ?>
		</main><!-- main#content .site-content-->
	</div><!-- #primary .content-area -->
<?php
get_sidebar();
wolf_post_after();
get_footer();
