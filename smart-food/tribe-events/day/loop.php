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

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php

global $more, $post, $wp_query;
$more = false;
$current_timeslot = null;

$clear_row = '';
$clear_row_2 = '';

?>

<div class="event-day">
	<div class="tribe-events-day-time-slot">

	<?php while ( have_posts() ) : the_post(); $clear_row++; $clear_row_2++; ?>
		<?php do_action( 'tribe_events_inside_before_loop' ); ?>

		<?php if ( $current_timeslot != $post->timeslot ) :
		$current_timeslot = $post->timeslot; ?>
	</div>
	<!-- .tribe-events-day-time-slot -->

	<div class="tribe-events-day-time-slot">
		<h5><?php echo $current_timeslot; ?></h5>
		<br/>
		<?php endif; ?>

		<div class="blog-box tdp-one-third <?php if($clear_row == 3 ) { echo " tdp-column-last"; $clear_row = 0; } ?>">
			<?php tribe_get_template_part( 'list/single', 'event' ) ?>
		</div>

		<?php if($clear_row_2 == 3 ) : ?><div class="clearfix"></div><?php $clear_row_2 = 0; endif; ?>

		<?php do_action( 'tribe_events_inside_after_loop' ); ?>
	<?php endwhile; ?>

	</div>
	<!-- .tribe-events-day-time-slot -->
</div><!-- .tribe-events-loop -->
