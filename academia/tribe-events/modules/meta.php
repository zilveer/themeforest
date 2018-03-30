<?php
/**
 * Single Event Meta Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta.php
 *
 * @package TribeEventsCalendar
 */

do_action( 'tribe_events_single_meta_before' );
do_action( 'tribe_events_single_event_meta_primary_section_start' );
// Always include the main event details in this first section
tribe_get_template_part( 'modules/meta/details' );
tribe_get_template_part( 'modules/meta/map' );
do_action( 'tribe_events_single_event_meta_primary_section_end' );
do_action( 'tribe_events_single_meta_after' );
