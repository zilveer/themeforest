<?php
/**
 * Day View Loop
 * This file sets up the structure for the day loop
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/loop.php
 *
 * @package TribeEventsCalendar
 * @since  3.0
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); } ?>

<?php

global $post, $wp_query;
$current_timeslot = null;

$GLOBALS['more'] = false;

$GLOBALS['wpv_pretty_tribe_date_headers'] = true;
$GLOBALS['wpv_pretty_tribe_date_headers_first'] = true;

?>

<div class="tribe-events-loop hfeed vcalendar clearfix">
	<div class="tribe-events-day-time-slot">

	<?php while ( have_posts() ) : the_post(); ?>
		<?php do_action( 'tribe_events_inside_before_loop'); ?>

		<?php if ( $current_timeslot != $post->timeslot ) : $current_timeslot = $post->timeslot; ?>
			<?php if( !$GLOBALS['wpv_pretty_tribe_date_headers_first'] ): ?>
				</section><!-- .tribe-events-day-time-slot -->
			<?php endif ?>

			<span class='tribe-events-list-separator-month'><span><?php echo $current_timeslot; ?></span></span>
			<section class="wpv-tribe-events-block clearfix">
		<?php endif; ?>

		<!-- Event  -->
		<div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?>">
			<?php tribe_get_template_part( 'list/single', 'event' ) ?>
		</div><!-- .hentry .vevent -->


		<?php do_action( 'tribe_events_inside_after_loop' ); ?>
		<?php $GLOBALS['wpv_pretty_tribe_date_headers_first'] = false; ?>
	<?php endwhile; ?>

	</section><!-- .tribe-events-day-time-slot -->
</div><!-- .tribe-events-loop -->
