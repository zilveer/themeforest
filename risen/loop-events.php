<?php
/**
 * Events Loop
 *
 * This outputs event post summaries for the Events page template
 */

global $events_query;

// if no query given, use default
$events_query = isset( $events_query ) ? $events_query : $wp_query;

?>

<?php if ( $events_query->have_posts() ) : ?>

	<div id="event-posts">

		<?php while ( $events_query->have_posts() ) : $events_query->the_post(); ?>

		<?php get_template_part( 'short', 'event' ); ?>

		<?php endwhile; ?>

	</div>

<?php endif; ?>

<?php wp_reset_postdata(); ?>