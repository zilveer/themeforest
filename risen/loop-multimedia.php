<?php
/**
 * Multimedia (Sermons) Loop
 *
 * This outputs multimedia post summaries for multimedia page templates
 */

global $multimedia_query;

// if no query given, use default
$multimedia_query = isset( $multimedia_query ) ? $multimedia_query : $wp_query;

?>

<?php if ( $multimedia_query->have_posts() ) : ?>

	<div id="multimedia-posts">

		<?php while ( $multimedia_query->have_posts() ) : $multimedia_query->the_post(); ?>

		<?php get_template_part( 'short', 'multimedia' ); ?>

		<?php endwhile; ?>

	</div>

<?php endif; ?>

<?php wp_reset_postdata(); ?>
