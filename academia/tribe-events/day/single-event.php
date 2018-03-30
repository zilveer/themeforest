<?php
/**
 * Day View Single Event
 * This file contains one event in the day view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/day/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$venue_details = tribe_get_venue_details();

// Venue microformats
$has_venue = ( $venue_details ) ? ' vcard' : '';
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

?>

<!-- Event Cost -->
<?php if ( tribe_get_cost() ) : ?>
	<div class="tribe-events-event-cost">
		<span><?php echo tribe_get_cost( null, true ); ?></span>
	</div>
<?php endif; ?>

<!-- Event Title -->
<?php do_action( 'tribe_events_before_the_event_title' ) ?>
<h2 class="p-font fs-18 fw-medium line-28 spacing-20 tribe-events-list-event-title summary">
	<a class="url heading-color" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
		<?php the_title() ?>
	</a>
</h2>
<?php do_action( 'tribe_events_after_the_event_title' ) ?>

<!-- Event Meta -->
<?php do_action( 'tribe_events_before_the_meta' ) ?>
<div class="tribe-events-event-meta <?php echo esc_attr( $has_venue . $has_venue_address ); ?>">

	<!-- Schedule & Recurrence Details -->
	<div class="tribe-updated published time-details">
		<?php echo tribe_events_event_schedule_details(); ?>
	</div>

	<?php if ( $venue_details ):?>
		<?php if(! empty( $venue_details['address'])):?>
			<!-- Venue Display Info -->
			<div class="tribe-events-venue-details">
				<?php echo sprintf('%s', $venue_details['address']); ?>
			</div> <!-- .tribe-events-venue-details -->
		<?php endif;
	endif; ?>
</div><!-- .tribe-events-event-meta -->
<?php do_action( 'tribe_events_after_the_meta' ) ?>

<!-- Event Image -->
<?php $thumbnail = g5plus_post_thumbnail('full');
if (!empty($thumbnail)){
	echo wp_kses_post($thumbnail);
}
?>

<!-- Event Content -->
<?php do_action( 'tribe_events_before_the_content' ) ?>
<div class="tribe-events-list-event-description tribe-events-content description entry-summary">
	<?php echo tribe_events_get_the_excerpt(); ?>
	<a href="<?php echo esc_url( tribe_get_event_link() ); ?>" class="bt bt-xs bt-tertiary bt-bg" rel="bookmark"><?php esc_html_e( 'DETAILS', 'g5plus-academia' ) ?></a>
</div><!-- .tribe-events-list-event-description -->
<?php
do_action( 'tribe_events_after_the_content' );
