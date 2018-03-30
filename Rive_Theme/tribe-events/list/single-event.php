<?php 
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @package TribeEventsCalendar
 * @since  3.0
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); } ?>

<?php 

// Setup an array of venue details for use later in the template
$venue_details = array();

if ($venue_name = tribe_get_meta( 'tribe_event_venue_name' ) ) {
	$venue_details[] = $venue_name;	
}

if ($venue_address = tribe_get_meta( 'tribe_event_venue_address' ) ) {
	$venue_details[] = $venue_address;	
}
// Venue microformats
$has_venue = ( $venue_details ) ? ' vcard': '';
$has_venue_address = ( $venue_address ) ? ' location': '';
?>

<!-- Event Title -->
<?php do_action( 'tribe_events_before_the_event_title' ) ?>
<?php if ( tribe_is_new_event_day() && !tribe_is_day() && !tribe_is_multiday() ) : ?>
	<div class="post-date left">
		<div class="post-day"><?php echo tribe_get_start_date( null, false, 'd' ); ?></div>
		<div class="post-month"><?php echo tribe_get_start_date( null, false, 'M, Y' ); ?></div>
	</div>
<?php endif; ?>
<?php if( !tribe_is_day() && tribe_is_multiday() ) : ?>
	<div class="post-date left">
		<div class="post-day"><?php echo tribe_get_start_date( null, false, 'd' ); ?></div>
		<div class="post-month"><?php echo tribe_get_start_date( null, false, 'M, Y' ); ?></div>
	</div>
<?php endif; ?>
<?php if ( tribe_is_day() && $first ) : $first = false; ?>
	<div class="post-date left">
		<div class="post-day"><?php echo tribe_get_start_date( strtotime(get_query_var('eventDate')), false, 'd' ); ?></div>
		<div class="post-month"><?php echo tribe_get_start_date( strtotime(get_query_var('eventDate')), false, 'M, Y' ); ?></div>
	</div>
<?php endif; ?>
<div class="entry-content-c">
<h2 class="entry-title new">
	<a class="url" href="<?php echo tribe_get_event_link() ?>" title="<?php the_title() ?>" rel="bookmark">
		<?php the_title() ?>
	</a>
</h2>

<!-- Event Image -->
<?php echo tribe_event_featured_image( null, 'medium' ) ?>

<!-- Event Content -->
<?php do_action( 'tribe_events_before_the_content' ) ?>
<div class="tribe-events-list-event-description tribe-events-content description entry-summary tribe-events-event-entry">
	<?php the_excerpt() ?>
	<a href="<?php echo tribe_get_event_link() ?>" class="tribe-events-read-more" rel="bookmark"><?php _e( 'Find out more', 'tribe-events-calendar' ) ?> &raquo;</a>
</div>
<div class="tribe-events-event-list-meta" itemprop="location" itemscope itemtype="http://schema.org/Place">
					<table cellspacing="0">
						<?php if (tribe_is_multiday() || !tribe_get_all_day()): ?>
						<tr>
							<td class="tribe-events-event-meta-desc"><?php _e('Start:', 'tribe-events-calendar'); ?></td>
							<td class="tribe-events-event-meta-value" itemprop="startDate" content="<?php echo tribe_get_start_date(); ?>"><?php echo tribe_get_start_date(); ?></td>
						</tr>
						<tr>
							<td class="tribe-events-event-meta-desc"><?php _e('End:', 'tribe-events-calendar'); ?></td>
							<td class="tribe-events-event-meta-value" itemprop="endDate" content="<?php echo tribe_get_end_date(); ?>"><?php echo tribe_get_end_date(); ?></td>
						</tr>
						<?php else: ?>
						<tr>
							<td class="tribe-events-event-meta-desc"><?php _e('Date:', 'tribe-events-calendar'); ?></td>
							<td class="tribe-events-event-meta-value" itemprop="startDate" content="<?php echo tribe_get_start_date(); ?>"><?php echo tribe_get_start_date(); ?></td>
						</tr>
						<?php endif; ?>

						<?php
							$venue = tribe_get_venue();
							if ( !empty( $venue ) ) :
						?>
						<tr>
							<td class="tribe-events-event-meta-desc"><?php _e('Venue:', 'tribe-events-calendar'); ?></td>
							<td class="tribe-events-event-meta-value" itemprop="name">
								<?php if( class_exists( 'TribeEventsPro' ) ): ?>
									<?php tribe_get_venue_link( get_the_ID(), class_exists( 'TribeEventsPro' ) ); ?>
								<?php else: ?>
									<?php echo tribe_get_venue( get_the_ID() ); ?>
								<?php endif; ?>
							</td>
						</tr>
						<?php endif; ?>
						<?php
							$phone = tribe_get_phone();
							if ( !empty( $phone ) ) :
						?>
						<tr>
							<td class="tribe-events-event-meta-desc"><?php _e('Phone:', 'tribe-events-calendar'); ?></td>
							<td class="tribe-events-event-meta-value" itemprop="telephone"><?php echo $phone; ?></td>
						</tr>
						<?php endif; ?>
						<?php if (tribe_address_exists( get_the_ID() ) ) : ?>
						<tr>
							<td class="tribe-events-event-meta-desc"><?php _e('Address:', 'tribe-events-calendar'); ?><br />
							<?php if( get_post_meta( get_the_ID(), '_EventShowMapLink', true ) == 'true' ) : ?>
								<a class="gmap" itemprop="maps" href="<?php echo tribe_get_map_link(); ?>" title="Click to view a Google Map" target="_blank"><?php _e('Google Map', 'tribe-events-calendar' ); ?></a>
							<?php endif; ?></td>
							<td class="tribe-events-event-meta-value"><?php echo tribe_get_full_address( get_the_ID() ); ?></td>
						</tr>
						<?php endif; ?>
						<?php
							$cost = tribe_get_cost( null, true );
							if ( !empty( $cost ) ) :
						?>
						<tr>
							<td class="tribe-events-event-meta-desc"><?php _e('Cost:', 'tribe-events-calendar'); ?></td>
							<td class="tribe-events-event-meta-value" itemprop="price"><?php echo $cost; ?></td>
						 </tr>
						<?php endif; ?>
					</table>
				</div>
				</div><!-- .tribe-events-list-event-description -->
<?php do_action( 'tribe_events_after_the_content' ) ?>
