<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

$event_id = get_the_ID();

?>

	<p class="tribe-events-back">
		<a href="<?php echo esc_url( tribe_get_events_link() ); ?>"> <?php printf( __( '&laquo; All %s', 'heartfelt' ), $events_label_plural ); ?></a>
	</p>

	<!-- Notices -->
	<?php tribe_events_the_notices() ?>

<div class="post_wrap clearfix">

	<div id="tribe-events-content" class="tribe-events-single vevent hentry">

		<header class="entry-header">

		<!-- Event Cost -->
		<?php if ( tribe_get_cost() ) : ?>
			<div class="tribe-events-event-cost">
				<button><?php echo tribe_get_cost( null, true ); ?></button>
			</div>
		<?php endif; ?>

		<?php the_title( '<h2 class="tribe-events-single-event-title summary entry-title">', '</h2>' ); ?>

		</header><!-- .entry-header -->

		<div class="entry-meta">

			<?php echo tribe_events_event_schedule_details( $event_id, '<h5>', '</h5>'); ?>

			<!-- Event header -->
			<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
				<!-- Navigation -->
				<h3 class="tribe-events-visuallyhidden"><?php printf( __( '%s Navigation', 'heartfelt' ), $events_label_singular ); ?></h3>
				<ul class="tribe-events-sub-nav">
					<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
					<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
				</ul><!-- .tribe-events-sub-nav -->
			</div><!-- #tribe-events-header -->

		</div><!-- .entry-meta -->

	<?php while ( have_posts() ) :  the_post(); ?>

	<!-- Event Image -->
	<?php if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'full-width-thumbnails' );
		}
	?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('vevent'); ?>>

			<div class="entry-content clearfix">

				<!-- Event content -->
				<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
				<div class="tribe-events-single-event-description tribe-events-content entry-content description">
					<?php the_content(); ?>
				</div><!-- .tribe-events-single-event-description -->
				<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>

			<!-- Event meta -->
			<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>

			<?php tribe_get_template_part( 'modules/meta' ); ?>

			<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>

			<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>

			</div><!-- .entry-content -->

		</article><!-- #post-ID -->

	<?php endwhile; ?>

	<!-- Event footer -->
    <div id="tribe-events-footer">

		<!-- Navigation -->
		<h3 class="tribe-events-visuallyhidden"><?php printf( __( '%s Navigation', 'heartfelt' ), $events_label_singular ); ?></h3>
		<ul class="tribe-events-sub-nav">
			<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
			<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
		</ul>
	</div><!-- #tribe-events-footer -->

	</div><!-- #tribe-events-content -->

</div><!-- .post_wrap -->
