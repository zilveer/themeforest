<div class="row wpv-tribe-multiple-events style-<?php echo $style ?>">
	<?php foreach($events as $i => $event): ?>
		<div class="wpv-grid grid-1-4 <?php if($i % 4 !== 0) echo 'left-border' ?>">
			<div class="event-wrapper">
				<?php
					$start = strtotime($event->EventStartDate);
					$end = strtotime($event->EventEndDate);
					$day = date('d', $start);
					$month = date_i18n('F', $start);

					$stime = date(get_option('time_format'), $start);
					$etime = date(get_option('time_format'), $end);
				?>
				<a href="<?php tribe_event_link($event) ?>" title="<?php esc_attr( $read_more_text ) ?>">
					<div class="date">
						<div class="day"><?php echo $day ?></div>
						<div class="month"><?php echo $month ?></div>
					</div>
					<h3 class="title"><?php echo $event->post_title ?></h3>
				</a>
				<div class="when-where">
					<div><?php echo $stime ?> <?php if ( $stime !== $etime ) echo '&mdash; ' . $etime ?></div>
					<div>@ <?php
						if( class_exists( 'Tribe__Events__Pro__Templates__Single_Venue' ) ) {
							echo tribe_get_venue_link( $event->ID, true );
						} else {
							echo tribe_get_venue( $event->ID );
						}
					?>
					</div>
				</div>
				<?php if ( ! empty( $read_more_text) ): ?>
					<a href="<?php tribe_event_link($event) ?>" title="<?php esc_attr( $read_more_text ) ?>" class="button button-border accent1 hover-accent1"><span class="btext"><?php echo $read_more_text // xss ok ?></span></a>
				<?php endif ?>
			</div>
		</div>
		<?php if($i % 4 == 3 && $i < count($events) - 1): ?>
			</div>
			<div class="row wpv-tribe-multiple-events">
		<?php endif ?>
	<?php endforeach; ?>
</div>