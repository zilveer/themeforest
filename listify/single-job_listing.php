<?php
/**
 * The Template for displaying a single listing.
 *
 * @package Listify
 */

global $job_id;

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'single-job_listing' ); ?>

	<?php endwhile; ?>

<?php get_footer(); ?>
