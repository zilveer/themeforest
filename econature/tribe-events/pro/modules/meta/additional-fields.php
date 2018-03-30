<?php
/**
 * Single Event Meta (Additional Fields) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/details.php
 *
 * @package TribeEventsCalendarPro
 *
 * @cmsms_package 	EcoNature
 * @cmsms_version 	1.2.1
 *
 */


if ( ! isset( $fields ) || empty( $fields ) || ! is_array( $fields ) ) {
	return;
}

?>

<div class="tribe-events-meta-group tribe-events-meta-group-other">
	<h2 class="tribe-events-single-section-title"><?php _e( 'Other', 'tribe-events-calendar-pro' ) ?></h2>
	<div class="cmsms_event_meta_info">
		<?php foreach ( $fields as $name => $value): ?>
			<div class="cmsms_event_meta_info_item">
				<span class="cmsms_event_meta_info_item_title"><?php echo $name; ?></span>
				<span class="cmsms_event_meta_info_item_descr tribe-meta-value"><?php echo $value; ?></span>
			</div>
		<?php endforeach ?>
	</div>
</div>