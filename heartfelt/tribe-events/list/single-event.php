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

$venue_details = tribe_get_venue_details();

// Venue microformats
$has_venue = ( $venue_details ) ? ' vcard' : '';
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

?>

<div class="post_wrap clearfix">

		<header class="entry-header">

		<!-- Event Cost -->
		<?php if ( tribe_get_cost() ) : ?>
			<div class="tribe-events-event-cost">
				<button><?php echo tribe_get_cost( null, true ); ?></button>
			</div>
		<?php endif; ?>

		<!-- Event Title -->
		<?php do_action( 'tribe_events_before_the_event_title' ) ?>
		<h2 class="tribe-events-list-event-title entry-title summary">
			<a class="url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title() ?>" rel="bookmark">
				<?php the_title() ?>
			</a>
		</h2>
		<?php do_action( 'tribe_events_after_the_event_title' ) ?>

		</header><!-- .entry-header -->

	<!-- Event Image -->
	<a href="<?php echo esc_url( tribe_get_event_link() ) ?>" title="<?php the_title() ?>">
		<?php if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'full-width-thumbnails' );
			}
		?>
	</a>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="entry-content clearfix">

		<!-- Event Content -->
		<?php do_action( 'tribe_events_before_the_content' ) ?>
		<div class="tribe-events-list-event-description tribe-events-content description entry-summary">
			<?php echo tribe_events_get_the_excerpt(); ?>
			<a href="<?php echo esc_url( tribe_get_event_link() ); ?>" class="tribe-events-read-more" rel="bookmark"><?php esc_html_e( 'Find out more', 'heartfelt' ) ?> &rarr;</a>
		</div><!-- .tribe-events-list-event-description -->
		<?php do_action( 'tribe_events_after_the_content' ) ?>

		</div><!-- .entry-content -->

	</article><!-- #post-## -->

		<div class="entry-meta">

			<!-- Event Meta -->
			<?php do_action( 'tribe_events_before_the_meta' ) ?>
			<div class="tribe-events-event-meta vcard"> <div class="author <?php echo esc_attr( $has_venue . $has_venue_address ); ?>">

				<!-- Schedule & Recurrence Details -->
				<div class="updated published time-details">
					<?php echo tribe_events_event_schedule_details() ?>
				</div>

				<?php if ( $venue_details ) : ?>
					<!-- Venue Display Info -->
					<div class="tribe-events-venue-details">
						<?php echo implode( ', ', $venue_details) ; ?>
					</div> <!-- .tribe-events-venue-details -->
				<?php endif; ?>

			</div> </div><!-- .tribe-events-event-meta -->
			<?php do_action( 'tribe_events_after_the_meta' ) ?>

		</div><!-- .entry-meta -->

</div><!-- .post_wrap -->
