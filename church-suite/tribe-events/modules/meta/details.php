<div class="tribe-events-meta-group tribe-events-meta-group-details">
	<dl>
		<?php
		do_action( 'tribe_events_single_meta_details_section_start' );

		$time_format = get_option( 'time_format', Tribe__Date_Utils::TIMEFORMAT );
		$time_range_separator = tribe_get_option( 'timeRangeSeparator', ' - ' );

		$start_datetime = tribe_get_start_date();
		$start_date = tribe_get_start_date( null, false );
		$start_time = tribe_get_start_date( null, false, $time_format );
		$start_ts = tribe_get_start_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

		$end_datetime = tribe_get_end_date();
		$end_date = tribe_get_end_date( null, false );
		$end_time = tribe_get_end_date( null, false, $time_format );
		$end_ts = tribe_get_end_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );

		// All day (multiday) events
		if ( tribe_event_is_all_day() && tribe_event_is_multiday() ) :
			?>

			<h3> <?php esc_attr_e('Start','webnus_framework') ?> </h3>
			<dd>
				<abbr class="tribe-events-abbr updated published dtstart" title="<?php echo esc_html( $start_ts) ?>"> <?php echo esc_html( $start_date) ?> </abbr>
			</dd>

			<h3> <?php esc_attr_e( 'End','webnus_framework') ?> </h3>
			<dd>
				<abbr class="tribe-events-abbr dtend" title="<?php echo esc_html( $end_ts) ?>"> <?php echo esc_html( $end_date) ?> </abbr>
			</dd>

		<?php
		// All day (single day) events
		elseif ( tribe_event_is_all_day() ):
			?>

			<h3 class="te-date"> <?php esc_attr_e('Date','webnus_framework') ?> </h3>
			<dd>
				<abbr class="tribe-events-abbr updated published dtstart" title="<?php echo esc_html( $start_ts) ?>"> <?php echo esc_html( $start_date) ?> </abbr>
			</dd>

		<?php
		// Multiday events
		elseif ( tribe_event_is_multiday() ) :
			?>

			<h3> <?php esc_attr_e( 'Start','webnus_framework') ?> </h3>
			<dd>
				<abbr class="tribe-events-abbr updated published dtstart" title="<?php echo esc_html( $start_ts) ?>"> <?php echo esc_html( $start_datetime) ?> </abbr>
			</dd>

			<h3> <?php esc_attr_e('End','webnus_framework') ?> </h3>
			<dd>
				<abbr class="tribe-events-abbr dtend" title="<?php echo esc_html( $end_ts ) ?>"> <?php echo esc_html( $end_datetime) ?> </abbr>
			</dd>

		<?php
		// Single day events
		else :
			?>

			<h3 class="te-date"> <?php esc_html_e( 'Date', 'webnus_framework' ) ?> </h3>
			<dd>
				<abbr class="tribe-events-abbr updated published dtstart" title="<?php echo esc_html($start_ts) ?>"> <?php echo esc_html($start_date) ?> </abbr>
			</dd>

			<h3 class="te-time"> <?php esc_html_e( 'Time', 'webnus_framework' ) ?> </h3>
			<dd><abbr class="tribe-events-abbr updated published dtstart" title="<?php echo esc_html( $end_ts) ?>">
					<?php if ( $start_time == $end_time ) {
						echo esc_html( $start_time);
					} else {
						echo esc_html($start_time . $time_range_separator . $end_time);
					} ?>
				</abbr></dd>

		<?php endif ?>

		<?php
		$cost = tribe_get_formatted_cost();
		if ( ! empty( $cost ) ):
			?>
			<h3 class="te-cost"> <?php esc_html_e( 'Cost','webnus_framework') ?> </h3>
			<dd class="tribe-events-event-cost"> <?php echo esc_html($cost) ?> </dd>
		<?php endif ?>

		<?php echo tribe_meta_event_tags( esc_html__( 'Event Tags','webnus_framework'), ', ', false ) ?>

		<?php
		$website = tribe_get_event_website_link();
		if ( ! empty( $website ) ):
			?>
			<h3 class="te-web"> <?php esc_html_e( 'Website','webnus_framework') ?> </h3>
			<dd class="tribe-events-event-url"> <?php echo esc_url($website) ?> </dd>
		<?php endif ?>

		<?php do_action( 'tribe_events_single_meta_details_section_end' ) ?>
	</dl>
</div>