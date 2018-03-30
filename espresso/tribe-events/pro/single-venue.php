<?php
/**
 * Single Venue Template
 * The template for a venue. By default it displays venue information and lists
 * events that occur at the specified venue.
 *
 * This view contains the filters required to create an effective single venue view.
 *
 * You can recreate an ENTIRELY new single venue view by doing a template override, and placing
 * a single-venue.php file in a tribe-events/pro/ directory within your theme directory, which
 * will override the /views/single-venue.php.
 *
 * You can use any or all filters included in this file or create your own filters in
 * your functions.php. In order to modify or extend a single filter, please see our
 * readme on templates hooks and filters (TO-DO)
 *
 * @package TribeEventsCalendarPro
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$venue_id = get_the_ID();

?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="tribe-events-venue">

<div id="tribe-events-content" class="tribe-events-single">

	<p id="breadcrumbs"><a href="<?php echo tribe_get_events_link() ?>"><a href="<?php echo tribe_get_events_link() ?>" rel="bookmark"><?php _e( '&larr; Back to Events', 'tribe-events-calendar-pro' ) ?></a></p>

	<!-- Venue Title -->
	<?php do_action('tribe_events_single_venue_before_title') ?>
	<?php the_title('<h1 class="page-title"><span>','</span></h1>'); ?>
	<?php do_action('tribe_events_single_venue_after_title') ?>

	<div class="tribe-events-event-meta">

		<?php if ( tribe_show_google_map_link() && tribe_address_exists() ) : ?>
			<!-- Google Map Link -->
			<?php echo tribe_get_meta( 'tribe_event_venue_gmap_link' ); ?>
		<?php endif; ?>

		<!-- Venue Meta -->
		<?php do_action( 'tribe_events_single_venue_before_the_meta' ) ?>
		<?php echo tribe_get_meta_group( 'tribe_event_venue' ) ?>
		<?php do_action( 'tribe_events_single_venue_after_the_meta' ) ?>

	</div><!-- .tribe-events-event-meta -->

	<!-- Venue Description -->
	<?php if ( get_the_content() ) : ?>
	<div class="tribe-venue-description tribe-events-content entry-content">
		<?php if (has_post_thumbnail()){ echo '<div class="featured-image single-event-image">'; the_post_thumbnail('gallery-thumb'); echo '</div>'; } ?>
		<?php the_content(); ?>
	</div>
	<?php endif; ?>

	<!-- Upcoming event list -->
	<?php do_action( 'tribe_events_single_venue_before_upcoming_events' ) ?>

	<?php
	// Use the tribe_events_single_venuer_posts_per_page to filter the number of events to get here.
	echo tribe_venue_upcoming_events( $venue_id ); ?>

	<?php do_action( 'tribe_events_single_venue_after_upcoming_events' ) ?>
	
</div><!-- .tribe-events-venue -->
<?php
endwhile;