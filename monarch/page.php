<?php

/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Monarch
 * @since Monarch 1.0
 */
   
get_header(); ?>

<?php get_template_part( 'header-panel' ); ?>

<!-- Content -->
<div class="content with-sb clearfix">

	<!-- Main -->
	<main class="main col-xs-12 col-sm-12 col-md-12 col-lg-7 col-bg-6" role="main">
		<?php
			// Start the loop.
			while ( have_posts() ) : the_post();
			
				// Include the page content template.
				get_template_part( 'content', 'page' );
			
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			
			// End the loop.
			endwhile;
		?>
	</main>

	<!-- Sidebar one and two -->
	<?php get_sidebar(); ?>

</div>

<?php get_footer(); ?>
