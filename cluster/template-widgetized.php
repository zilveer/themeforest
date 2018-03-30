<?php
/**
 * Template Name: Widgetized
 *
 * @package StagFramework
 * @subpackage Cluster
 * @since 1.4.5
 */

get_header(); ?>

<div class="widgetized-sections">
	<?php
	
	while( have_posts() ): the_post();
		the_content();
	endwhile;

	?>
</div>

<?php get_footer(); ?>
