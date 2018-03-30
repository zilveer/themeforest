<?php
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php

// Setup an array of venue details for use later in the template
$venue_details = array();

if ( $venue_name = tribe_get_meta( 'tribe_event_venue_name' ) ) {
	$venue_details[] = $venue_name;
}

if ( $venue_address = tribe_get_meta( 'tribe_event_venue_address' ) ) {
	$venue_details[] = $venue_address;
}
// Venue microformats
$has_venue_address = ( $venue_address ) ? ' location' : '';

// Organizer
$organizer = tribe_get_organizer();

?>

<?php if(has_post_thumbnail()) : ?>
		
		<?php 
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb, 'full' ); //get full URL to image (use "large" or "medium" if the images too big)
		?>
		<figure class="post-img media event-img">
			<div class="mediaholder <?php if(is_singular( )) : ?>lightbox<?php endif;?>">
				<?php if(is_singular( )) : ?>
					<a href="<?php echo $img_url; ?>" title="<?php the_title(); ?>" class="image-link" data-effect="">
				<?php else :?>	
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="image-link" data-effect="">
				<?php endif; ?>
					<img class="event-img" src="<?php echo fImg::resize( $img_url, 780, 350, true ); ?>" alt="<?php the_title();?>"/>
					<div class="hovercover">
			            <div class="hovericon"><i class="fa fa-plus"></i></div>
			         </div>
				</a>
				<!-- Schedule & Recurrence Details -->
				<div class="badge-date">
					<?php echo tribe_events_event_schedule_details() ?>
				</div>
			</div>
		</figure>

<?php endif; ?>

<!-- Event Title -->
<?php do_action( 'tribe_events_before_the_event_title' ) ?>
<h3 class="tdp-event-title">
	<a class="url" href="<?php echo tribe_get_event_link() ?>" title="<?php the_title() ?>" rel="bookmark">
		<?php the_title() ?>
	</a>
</h3>
<?php do_action( 'tribe_events_after_the_event_title' ) ?>

<?php if ( tribe_get_cost() ) : ?>
	<div class="tribe-events-event-cost">
		<span><?php echo tribe_get_cost( null, true ); ?></span>
	</div>
<?php endif; ?>

<!-- Event Content -->
<?php do_action( 'tribe_events_before_the_content' ) ?>
<div class="tribe-events-list-event-description tribe-events-content description entry-summary">
	<?php 

	$text_desc = get_the_content(); 
				
	$trimmed_desc = wp_trim_words( $text_desc, $num_words = 30, $more = null ); 
				
	echo stripslashes($trimmed_desc); 

	?>
	<br/>

	<a href="<?php echo tribe_get_event_link() ?>" class="tdp-button small accent-color-1  tdp-all" rel="bookmark"><span class="tdp-button-inner"><?php _e( 'Find out more', 'tribe-events-calendar', 'smartfood' ) ?> &raquo;</span></a>
</div><!-- .tribe-events-list-event-description -->
<?php do_action( 'tribe_events_after_the_content' ) ?>