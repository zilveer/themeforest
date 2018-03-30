<?php
/**
 * Template Name: Front Page
 *
 * @package Reorder
 * @subpackage Reorder
 * @since Reorder 1.0
 */
get_header();
?>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">
		<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

				// Include the page content template.
				get_template_part( 'content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				// if ( comments_open() || get_comments_number() ) {
					// comments_template();
				// }
			endwhile;
		?>
	</div><!-- #content -->
</div><!-- #primary -->

<?php
get_footer();
