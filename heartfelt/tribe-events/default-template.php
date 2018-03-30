<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

get_header(); ?>

</div><!-- .hero_wrap -->

<div class="row content_row">

	<div class="large-12 columns">

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

		<div id="tribe-events-pg-template">
			<?php tribe_events_before_html(); ?>
			<?php tribe_get_view(); ?>
			<?php tribe_events_after_html(); ?>
		</div> <!-- #tribe-events-pg-template -->

		</main><!-- #main .site-main -->

	</div><!-- #primary .content-area -->

	</div><!-- .large-12 -->

  </div><!-- .row .content_row -->

<?php get_footer(); ?>