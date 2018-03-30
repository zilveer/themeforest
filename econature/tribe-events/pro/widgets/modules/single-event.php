<?php
/**
 * Single Event Template for Widgets
 *
 * This template is used to render single events for both the calendar and advanced
 * list widgets, facilitating a common appearance for each as standard.
 *
 * You can override this template in your own theme by creating a file at
 * [your-theme]/tribe-events/widgets/modules/single-widget.php
 *
 * @package TribeEventsCalendarPro
 * 
 * @cmsms_package 	EcoNature
 * @cmsms_version 	1.2.1
 */

?>
<?php do_action( 'tribe_events_list_widget_before_the_event_title' ); ?>
<div class="list-date">
	<span class="list-dayname"><?php echo tribe_get_start_date(null, false, 'D'); ?></span>
	<span class="list-daynumber"><?php echo tribe_get_start_date(null, false, 'd'); ?></span>
</div>
<div class="ovh">
	<h2 class="entry-title summary">
		<a href="<?php echo esc_url( tribe_get_event_link() ); ?>" rel="bookmark"><?php the_title(); ?></a>
	</h2>
	<div class="cmsms_widget_event_info">
		<div class="duration">
			<?php if ( isset( $cost ) && $cost && tribe_get_cost() != '' ) { ?>
				<div class="tribe-events-event-cost"><?php 
					echo tribe_get_cost( null, true ); 
				?></div>
				<span class="tribe-events-divider">|</span>
			<?php } ?>
			<?php echo tribe_events_event_schedule_details(); ?>
		</div>
	</div>

	<?php do_action( 'tribe_events_list_widget_after_the_event_title' ); ?>

	<?php do_action( 'tribe_events_list_widget_before_the_meta' ) ?>

	<div class="vcard adr location cmsms_widget_event_venue_info_loc">
	<?php 
		if ( 
			( isset( $venue ) && $venue && tribe_get_venue() != '' ) || 
			( isset( $address ) && $address && tribe_get_address() != '' ) || 
			( isset( $city ) && $city && tribe_get_city() != '' ) || 
			( isset( $region ) && $region && tribe_get_region() != '' ) || 
			( isset( $zip ) && $zip && tribe_get_zip() != '' ) || 
			( isset( $country ) && $country && tribe_get_country() != '' ) 
		) {
	?>
		<div class="cmsms_widget_event_venue_info">
			<?php if ( isset( $venue ) && $venue && tribe_get_venue() != '' ) { ?>
				<span class="fn org tribe-venue"><?php echo tribe_get_venue_link(); ?></span>
			<?php } ?>

			<?php if ( isset( $address ) && $address && tribe_get_address() != '' ) { ?>
				<span class="street-address"><?php echo tribe_get_address(); ?></span>
			<?php } ?>

			<?php if ( isset( $city ) && $city && tribe_get_city() != '' ) { ?>
				<span class="locality"><?php echo tribe_get_city(); ?></span>
			<?php } ?>

			<?php if ( isset( $region ) && $region && tribe_get_region() != '' ) { ?>
				<span class="region"><?php echo tribe_get_region(); ?></span>
			<?php	} ?>

			<?php if ( isset( $zip ) && $zip && tribe_get_zip() != '' ) { ?>
				<span class="postal-code"><?php echo tribe_get_zip(); ?></span>
			<?php } ?>

			<?php if ( isset( $country ) && $country && tribe_get_country() != '' ) { ?>
				<span class="country-name"><?php echo tribe_get_country(); ?></span>
			<?php } ?>
		</div>
	<?php 
		}
		
		
		if ( 
			( isset( $organizer ) && $organizer && tribe_get_organizer() != '' ) || 
			( isset( $phone ) && $phone && tribe_get_phone() != '' ) 
		) {
	?>
		<div class="cmsms_widget_event_venue_loc cmsms_theme_icon_person">
			<?php if ( isset( $organizer ) && $organizer && tribe_get_organizer() != '' ) { ?>
				<?php _e( 'Organizer:', 'tribe-events-calendar-pro' ); ?>
				<span class="tribe-organizer"><?php echo tribe_get_organizer_link(); ?></span>
			<?php } ?>

			<?php if ( isset( $phone ) && $phone && tribe_get_phone() != '' ) { ?>
				<span class="tel"><?php echo tribe_get_phone(); ?></span>
			<?php } ?>
		</div>
		<?php } ?>
	</div>

	<?php do_action( 'tribe_events_list_widget_after_the_meta' ) ?>
</div>


