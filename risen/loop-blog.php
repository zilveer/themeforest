<?php
/**
 * Blog Loop
 *
 * This outputs blog post summaries for the Blog page template
 */

global $blog_query;

// if no query given, use default
$blog_query = isset( $blog_query ) ? $blog_query : $wp_query;

?>

<?php if ( $blog_query->have_posts() ) : ?>

	<div id="blog-posts">

		<?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>

		<?php get_template_part( 'short' ); ?>

		<?php endwhile; ?>

	</div>

<?php endif; ?>

<?php wp_reset_postdata(); ?>