<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

get_header();
get_template_part('title_breadcrumb_bar');

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

?>
<section>
	<div class="container">
		<div id="tribe-events-pg-template">
			<?php tribe_events_before_html(); ?>
			<?php tribe_get_view(); ?>
			<?php tribe_events_after_html(); ?>
		</div> <!-- #tribe-events-pg-template -->
	</div>
</section>

<?php if (is_singular( 'tribe_events' )): ?>
	<!-- Event footer -->
	<div id="tribe-events-footer">
		<!-- Navigation -->
		<section>
			<div class="container">
				<h3 class="tribe-events-visuallyhidden"><?php printf( esc_html__( '%s Navigation', 'ABdev_aeron' ), $events_label_singular ); ?></h3>
				<ul class="tribe-events-sub-nav">
					<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
					<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
				</ul>
			</div>
		</section>
		<!-- .tribe-events-sub-nav -->
	</div>
	<!-- #tribe-events-footer -->
<?php endif ?>

<?php
get_footer();
