<?php
/**
 * List View Nav Template
 * This file loads the list view navigation.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/nav.php
 *
 * @package TribeEventsCalendar
 * @since  3.0
 * @author Modern Tribe Inc.
 *
 */
if ( !defined('ABSPATH') ) { die('-1'); } ?>

<h3 class="tribe-events-visuallyhidden"><?php _e( 'Events List Navigation', 'tribe-events-calendar' ) ?></h3>

<div class="wp-pagenavi">
	<div class="tribe-events-sub-nav">
		<ul>
			<!-- Previous Page Navigation -->
			<li class="tribe-events-nav-previous"><?php tribe_the_day_link('previous day') ?></li>

			<!-- Next Page Navigation -->
			<li class="tribe-events-nav-next"><?php tribe_the_day_link('next day') ?></li>
		</ul>
	</div>
</div>