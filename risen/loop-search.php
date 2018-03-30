<?php
/**
 * Search Loop
 *
 * This outputs post summaries for various types
 */

global $search_query;

// if no query given, use default
$search_query = isset( $search_query ) ? $search_query : $wp_query;

?>

<?php if ( $search_query->have_posts() ) : ?>

	<div id="search-posts">

		<?php while ( $search_query->have_posts() ) : $search_query->the_post(); ?>

		<?php get_template_part( 'short', str_replace( 'risen_', '', get_post_type() ) ); // see short-*.php templates?>

		<?php endwhile; ?>

	</div>

<?php endif; ?>

<?php wp_reset_postdata(); ?>