<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default for Visual Composer use.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 */
get_header();
wolf_page_before();
?>
	<div id="primary" class="content-area">
		<main class="site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'partials/page', 'content' ); ?>

			<?php endwhile; ?>

		</main><!-- main#content .site-content-->
	</div><!-- #primary .content-area -->
<?php
wolf_page_after();
get_footer();
?>