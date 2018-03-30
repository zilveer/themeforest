<?php
/**
 * Single Event Meta (Organizer) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/details.php
 *
 * @package TribeEventsCalendar
 *
 * @cmsms_package 	EcoNature
 * @cmsms_version 	1.1.0
 *
 */

$phone = tribe_get_organizer_phone();
$email = tribe_get_organizer_email();
$website = tribe_get_organizer_website_link();
?>

<div class="tribe-events-meta-group tribe-events-meta-group-organizer">
	<h2 class="tribe-events-single-section-title"><?php _e(tribe_get_organizer_label_singular(), 'tribe-events-calendar'); ?></h2>
	<div class="cmsms_event_meta_info">
		<?php do_action('tribe_events_single_meta_organizer_section_start'); ?>
		
		<div class="cmsms_event_meta_info_item">
			<span class="cmsms_event_meta_info_item_title"><?php esc_html_e('Organizer Name:', 'cmsmasters'); ?></span>
			<span class="cmsms_event_meta_info_item_descr fn org"><?php echo tribe_get_organizer(); ?></span>
		</div>
		
		<?php if (!empty($phone)): ?>
			<div class="cmsms_event_meta_info_item">
				<span class="cmsms_event_meta_info_item_title"><?php esc_html_e('Phone:', 'tribe-events-calendar'); ?></span>
				<span class="cmsms_event_meta_info_item_descr tel"><?php echo $phone; ?></span>
			</div>
		<?php endif;
		
		
		if (!empty($email)): ?>
			<div class="cmsms_event_meta_info_item">
				<span class="cmsms_event_meta_info_item_title"><?php esc_html_e('Email:', 'tribe-events-calendar'); ?></span>
				<span class="cmsms_event_meta_info_item_descr email"><?php echo $email; ?></span>
			</div>
		<?php endif;
		
		
		if (!empty($website)): ?>
			<div class="cmsms_event_meta_info_item">
				<span class="cmsms_event_meta_info_item_title"><?php esc_html_e('Website:', 'tribe-events-calendar'); ?></span>
				<span class="cmsms_event_meta_info_item_descr url"><?php echo $website; ?></span>
			</div>
		<?php endif;
		
		do_action('tribe_events_single_meta_organizer_section_end'); ?>
	</div>
</div>