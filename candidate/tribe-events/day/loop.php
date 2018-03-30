<?php 
/**
 * Day View Loop
 * This file sets up the structure for the day loop
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/loop.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); } ?>

<?php 

global $more, $post, $wp_query;
$more = false;
$current_timeslot = null;

?>

<div class="tribe-events-loop hfeed vcalendar">
	

	<?php while ( have_posts() ) : the_post(); ?>
		<?php do_action( 'tribe_events_inside_before_loop'); ?>

		<?php if ( $current_timeslot != $post->timeslot ) : $current_timeslot = $post->timeslot; ?>
			
        <?php endif; ?>
		
	<div class="tribe-events-day-time-slot">
			
		

		<!-- Event  -->
		<div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes(' blog-post style2 ') ?>">
			<?php tribe_get_template_part( 'day/single', 'event' ) ?>
		</div><!-- .hentry .vevent -->


		<?php do_action( 'tribe_events_inside_after_loop' ); ?>
	</div><!-- .tribe-events-day-time-slot -->	
	<?php endwhile; ?>

	
</div><!-- .tribe-events-loop -->
