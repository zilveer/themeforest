<?php
/**
 * Single Event Meta Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta.php
 *
 * @package TribeEventsCalendar
 * @since 3.6
 */

do_action( 'tribe_events_single_meta_before' );

do_action( 'tribe_events_single_event_meta_primary_section_start' );

// Always include the main event details in this first section
tribe_get_template_part( 'modules/meta/details' );

// Include organizer meta if appropriate
if ( tribe_has_organizer() ) tribe_get_template_part( 'modules/meta/organizer' );

do_action( 'tribe_events_single_event_meta_primary_section_end' );

$text = wpv_get_option( 'events-after-details-content' );
if ( ! empty( $text ) ):
?>
	<div class="wpv-single-event-after-details"><?php echo do_shortcode( $text ) ?></div>
<?php
endif;

do_action( 'tribe_events_single_meta_after' );

?>