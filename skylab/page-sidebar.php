<?php
/**
 * Template Name: Page with Sidebar
 * Description: A Page Template that adds a sidebar to pages
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */

get_header(); ?>

	<div class="entry-header-wrapper">
		<header class="entry-header clearfix">
			<h1 class="entry-title"><?php single_post_title(); ?></h1>
		</header><!-- .entry-header -->
	</div>
	<div id="main" class="clearfix">

		<div id="primary">
			<div id="content" role="main">
			
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>