<?php

/**
 *
 * Please see single-event.php in this directory for detailed instructions on how to use and modify these templates.
 *
 * @cmsms_package 	EcoNature
 * @cmsms_version 	1.2.1
 *
 */

?>

<script type="text/html" id="tribe_tmpl_month_mobile_day_header">
	<div class="tribe-mobile-day" data-day="[[=date]]">[[ if(date_name.length) { ]]
		<h3 class="tribe-mobile-day-heading"><?php printf( __( '%s for', 'tribe-events-calendar' ), tribe_get_event_label_plural() ); ?> <span>[[=raw date_name]]</span></h3>[[ } ]]
	</div>
</script>

<script type="text/html" id="tribe_tmpl_month_mobile">
	<div class="tribe-events-mobile hentry vevent tribe-clearfix tribe-events-mobile-event-[[=eventId]][[ if(categoryClasses.length) { ]] [[= categoryClasses]][[ } ]]">
		[[ if(imageSrc.length) { ]]
		<div class="tribe-events-event-image">
			<a href="[[=permalink]]" title="[[=title]]">
				<img src="[[=imageSrc]]" alt="[[=title]]" title="[[=title]]">
			</a>
		</div>
		[[ } ]]
		<h2 class="summary">
			<a class="url" href="[[=permalink]]" title="[[=title]]" rel="bookmark">[[=title]]</a>
		</h2>
		<div class="tribe-events-event-body">
			<div class="updated published time-details">
				<span class="date-start dtstart">[[=dateDisplay]] </span>
			</div>
			[[ if(excerpt.length) { ]]
			<p class="entry-summary description">[[=raw excerpt]]</p>
			[[ } ]]
			<a href="[[=permalink]]" class="tribe-events-read-more" rel="bookmark"><?php _e( 'Find out more »', 'tribe-events-calendar' ); ?></a>
		</div>
	</div>
</script>