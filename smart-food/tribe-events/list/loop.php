<?php
/**
 * List View Loop
 * This file sets up the structure for the list loop
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/loop.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php
global $more;
$more = false;

$clear_row = '';
$clear_row_2 = '';

?>

<div class="single-event">

	<?php while ( have_posts() ) : the_post(); $clear_row++; $clear_row_2++; ?>
		<?php do_action( 'tribe_events_inside_before_loop' ); ?>

		<!-- Event  -->
		<div class="blog-box tdp-one-third <?php if($clear_row == 3 ) { echo " tdp-column-last"; $clear_row = 0; } ?>">
			<?php tribe_get_template_part( 'list/single', 'event' ) ?>
		</div>

		<?php if($clear_row_2 == 3 ) : ?><div class="clearfix"></div><?php $clear_row_2 = 0; endif; ?>

		<?php do_action( 'tribe_events_inside_after_loop' ); ?>
	<?php endwhile; ?>

</div><!-- .tribe-events-loop -->
