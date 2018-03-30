<?php
/**
 * Template Name: Widgetized
 *
 * Blank template for displaying widgets for homepage and other pages.
 *
 * @package StagFramework
 * @subpackage Crux
 */

get_header() ?>

	<main id="main" class="site-main" role="main"<?php stag_markup_helper( array( 'context' => 'content' ) ); ?>>
		<div class="widgetized-sections">
			<?php

			while( have_posts() ): the_post();
				the_content();
			endwhile;

			?>
		</div>
	</main>

<?php get_footer(); ?>
