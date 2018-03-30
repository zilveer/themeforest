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
}

// Setup an array of venue details for use later in the template
$venue_details = tribe_get_venue_details();

// Venue microformats
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

// Organizer
$organizer = tribe_get_organizer();

?>

<!-- Event Cost -->
<?php if ( tribe_get_cost() ) : ?>
	<div class="tribe-events-event-cost">
		<span><?php echo tribe_get_cost( null, true ); ?></span>
	</div>
<?php endif; ?>

<div class="container">
<div class="row">
	<div class="col-md-2">
	
	<!-- Event Meta -->
		<?php do_action( 'tribe_events_before_the_meta' ) ?>
		<div class="tribe-events-event-meta vcard">
			<div class="author <?php echo $has_venue_address; ?>">

				<!-- Schedule & Recurrence Details -->
				<div class="updated published time-details">
				<?php
				$ddate = tribe_get_start_date(null,false,'d');
				$mdate = tribe_get_start_date(null,false,'F');
				$permalink = esc_url( tribe_get_event_link());
				echo '<span class="event-d">'.$ddate.'</span><span class="event-m">'.$mdate.'</span>'
				?>
				</div>

				<?php if ( $venue_details ) : ?>
					<!-- Venue Display Info -->
					<div class="tribe-events-venue-details">
						<?php echo implode( ', ', $venue_details ); ?>
					</div> <!-- .tribe-events-venue-details -->
				<?php endif; ?>

			</div>
		</div><!-- .tribe-events-event-meta -->
		<?php do_action( 'tribe_events_after_the_meta' ) ?>
		
		
		
		<?php
			$webnus_options = webnus_options();
			$webnus_options['webnus_booking_enable'] = isset( $webnus_options['webnus_booking_enable'] ) ? $webnus_options['webnus_booking_enable'] : '';
			if($webnus_options['webnus_booking_enable']){ 
				$webnus_options['webnus_booking_form'] = isset( $webnus_options['webnus_booking_form'] ) ? $webnus_options['webnus_booking_form'] : '';
				$form_id=$webnus_options['webnus_booking_form'];
				$id = get_the_ID();
				echo'<div class="btn-wrapper"><a class="booking-button inlinelb" href="#w-book-'.$id.'" target="_self"><span class="media_label">'.esc_html__('REGISTER','webnus_framework').'</span></a><div style="display:none"><div class="w-modal modal-book" id="w-book-'.$id.'"><h3 class="modal-title">'.esc_html__('Book for ','webnus_framework').get_the_title().'</h3><br>'.do_shortcode('[contact-form-7 id="'.$form_id.'" title="Booking"]').'</div></div></div>';
			}
		?>
		
			
	</div>
	<div class="col-md-4">
		<!-- Event Image -->
		<?php echo tribe_event_featured_image( null, 'blog2_thumb' ) ?>
	</div>
	<div class="col-md-6">
		<!-- Event Title -->
		<?php do_action( 'tribe_events_before_the_event_title' ) ?>
		<h2 class="tribe-events-list-event-title entry-title summary">
			<a class="url" href="<?php echo esc_url($permalink); ?>" title="<?php the_title() ?>" rel="bookmark">
				<?php the_title() ?>
			</a>
		</h2>
		<?php do_action( 'tribe_events_after_the_event_title' ) ?>
		
		<!-- Event Content -->
		<?php do_action( 'tribe_events_before_the_content' ) ?>
		<div class="tribe-events-list-event-description tribe-events-content description entry-summary">
			<?php echo tribe_events_get_the_excerpt( null, wp_kses_allowed_html( 'post' ) ); ?>
			<a href="<?php echo esc_url($permalink); ?>" class="tribe-events-read-more" rel="bookmark"><?php esc_html_e( 'Find out more', 'webnus_framework' ) ?> &raquo;</a>
		</div><!-- .tribe-events-list-event-description -->
		<?php do_action( 'tribe_events_after_the_content' ) ?>
		
		
		<ul class="event-sharing">
			<li class="event-share"><i class="event-sharing-icon fa-share-alt"></i>
			<ul class="event-social">
				<li><a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php echo $permalink ;?>&amp;t=<?php the_title(); ?>" target="blank"><i class="fa-facebook"></i></a></li>
				<li><a class="google" href="https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=<?php echo $permalink ;?>" target="_blank"><i class="fa-google-plus"></i></a></li>
				<li><a class="twitter" href="https://twitter.com/intent/tweet?original_referer=<?php echo $permalink ;?>&amp;text=<?php the_title(); ?>&amp;tw_p=tweetbutton&amp;url=<?php echo $permalink ;?><?php echo isset( $twitter_user ) ? '&amp;via='.$twitter_user : ''; ?>" target="_blank"><i class="fa-twitter"></i></a></li>
			</ul></li>
			<li class="event-map"><a class="fancybox-media" href="<?php echo esc_url(tribe_get_map_link($id));?>"><i class="fa-map-marker"></i></a></li>
			<li><a class="inlinelb" href="#w-contact"><i class="fa-envelope-o"></i></a></li>	
		</ul>
					
	</div>
</div>
</div>