<?php
/**
 * Map View Loop
 * This file sets up the structure for the map view events loop
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/map/loop.php
 *
 * @package TribeEventsCalendar
 * @since  3.0
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); } ?>

<?php

global $more;
$more = false;

if(have_posts()):
?>
	<section class="wpv-tribe-events-block clearfix">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php do_action( 'tribe_events_inside_before_loop' ); ?>

			<!-- Event  -->
			<div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?>">
				<?php tribe_get_template_part( 'list/single', 'event' ) ?>
			</div><!-- .hentry .vevent -->


			<?php do_action( 'tribe_events_inside_after_loop' ); ?>
		<?php endwhile; ?>
	</section>

<?php endif ?>
