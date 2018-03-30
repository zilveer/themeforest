<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @since  2.1
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); }

$event_id = get_the_ID();

?>

<?php while ( have_posts() ) :  the_post(); ?>
<div class="clearfix">
	<div id="tribe-events-content" class="tribe-events-single">

		<!-- Notices -->
		<?php tribe_events_the_notices() ?>

		<!-- Event content -->
		<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
		<div class="tribe-events-single-event-description tribe-events-content entry-content description">
			<?php the_content(); ?>
			<?php WpvTemplates::share( 'tribe' ) ?>
		</div><!-- .tribe-events-single-event-description -->
		<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>

		<?php if( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>

	</div><!-- #tribe-events-content -->
	<div class="wpv-tribe-events-meta">
		<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
			<?php tribe_get_template_part( 'modules/meta' ) ?>
			<?php if ( function_exists( 'tribe_events_recurrence_tooltip' ) ) echo tribe_events_recurrence_tooltip() // xss ok ?>
		<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
	</div>
</div>
<?php endwhile; ?>
