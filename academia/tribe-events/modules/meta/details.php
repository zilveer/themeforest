<?php
/**
 * Single Event Meta (Details) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/details.php
 *
 * @package TribeEventsCalendar
 */


$time_format = get_option( 'time_format', Tribe__Date_Utils::TIMEFORMAT );
$time_range_separator = tribe_get_option( 'timeRangeSeparator', ' - ' );

$start_datetime = tribe_get_start_date();
$start_date = tribe_get_start_date( null, false );
$start_time = tribe_get_start_date( null, false, $time_format );
$start_ts = tribe_get_start_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

$end_datetime = tribe_get_end_date();
$end_date = tribe_get_display_end_date( null, false );
$end_time = tribe_get_end_date( null, false, $time_format );
$end_ts = tribe_get_end_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

$time_formatted = null;
if ( $start_time == $end_time ) {
	$time_formatted = esc_html( $start_time );
} else {
	$time_formatted = esc_html( $start_time . $time_range_separator . $end_time );
}

$event_id = Tribe__Main::post_id_helper();

/**
 * Returns a formatted time for a single event
 *
 * @var string Formatted time string
 * @var int Event post id
 */
$time_formatted = apply_filters( 'tribe_events_single_event_time_formatted', $time_formatted, $event_id );

/**
 * Returns the title of the "Time" section of event details
 *
 * @var string Time title
 * @var int Event post id
 */
$time_title = apply_filters( 'tribe_events_single_event_time_title', esc_html__( 'Time', 'the-events-calendar' ), $event_id );

$cost = tribe_get_formatted_cost();
$website = tribe_get_event_website_link();
?>

<div class="tribe-events-meta-group tribe-events-meta-group-details mg-bottom-60">
	<table>
		<?php
		do_action( 'tribe_events_single_meta_details_section_start' );

		// All day (multiday) events
		if ( tribe_event_is_all_day() && tribe_event_is_multiday() ) :
			?>
			<tr>
				<td> <?php esc_html_e( 'Start', 'the-events-calendar' ) ?> </td>
				<td>
					<?php echo wp_kses_post( $start_date ) ?>
				</td>
			</tr>
			<tr>
				<td> <?php esc_html_e( 'End', 'the-events-calendar' ) ?> </td>
				<td>
					<?php echo wp_kses_post( $end_date ) ?>
				</td>
			</tr>
		<?php
		// All day (single day) events
		elseif ( tribe_event_is_all_day() ):
			?>
			<tr>
				<td> <?php esc_html_e( 'Date', 'the-events-calendar' ) ?> </td>
				<td>
					<?php echo wp_kses_post( $start_date ) ?>
				</td>
			</tr>
		<?php
		// Multiday events
		elseif ( tribe_event_is_multiday() ) :
			?>
			<tr>
				<td> <?php esc_html_e( 'Start', 'the-events-calendar' ) ?> </td>
				<td>
					<?php echo wp_kses_post( $start_datetime ) ?>
				</td>
			</tr>
			<tr>
				<td> <?php esc_html_e( 'End', 'the-events-calendar' ) ?> </td>
				<td>
					<?php echo wp_kses_post( $end_datetime ) ?>
				</td>
			</tr>
		<?php
		// Single day events
		else :
			?>
			<tr>
				<td> <?php esc_html_e( 'Date', 'the-events-calendar' ) ?> </td>
				<td>
					<?php echo wp_kses_post( $start_date ) ?>
				</td>
			</tr>
			<tr>
				<td> <?php echo wp_kses_post( $time_title ); ?> </td>
				<td><div class="tribe-events-abbr updated published dtstart" title="<?php echo esc_attr( $end_ts ) ?>">
					<?php echo wp_kses_post( $time_formatted); ?>
				</div></td>
			</tr>

		<?php endif ?>

		<?php
		// Event Organizer
		$organizer_ids = tribe_get_organizer_ids();
		if(count($organizer_ids)>0)
		{
		?>
		<tr>
			<td> <?php esc_html_e( 'Organizers', 'the-events-calendar' ) ?> </td>
			<td>
		<?php
		foreach ( $organizer_ids as $organizer ) {
			if ( ! $organizer ) {
				continue;
			}
			?>
			<?php echo tribe_get_organizer( $organizer ); echo '<br>' ?>
			<?php
		}
		?>
			</td>
		</tr>
		<?php } ?>
		<?php
			if ( tribe_address_exists() ) : ?>
			<tr>
				<td> <?php esc_html_e( 'Address', 'the-events-calendar' ) ?> </td>
				<td>
					<?php echo tribe_get_full_address(); ?>
					<?php if ( tribe_show_google_map_link() ) : ?>
						<?php echo tribe_get_map_link_html(); ?>
					<?php endif; ?>
				</td>
			</tr>
			<?php endif;
		$phone   = tribe_get_phone();
		if ( ! empty( $phone ) ): ?>
			<tr>
				<td> <?php esc_html_e( 'Phone', 'the-events-calendar' ) ?> </td>
				<td class="tribe-venue-tel"> <?php echo wp_kses_post($phone) ?> </td>
			</tr>
		<?php endif ?>
		<?php
		// Event Cost
		if ( ! empty( $cost ) ) : ?>
			<tr>
				<td> <?php esc_html_e( 'Cost', 'the-events-calendar' ) ?> </td>
				<td class="tribe-events-event-cost"> <?php echo wp_kses_post( $cost ); ?> </td>
			</tr>
		<?php endif ?>
		<?php
		// Event Website
		if ( ! empty( $website ) ) : ?>
			<tr>
				<td> <?php esc_html_e( 'Website', 'the-events-calendar' ) ?> </td>
				<td class="tribe-events-event-url"> <?php echo wp_kses_post( $website); ?> </td>
			</tr>
		<?php endif ?>

		<?php do_action( 'tribe_events_single_meta_details_section_end' ) ?>
	</table>
</div>
