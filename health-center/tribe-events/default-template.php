<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 * @since  3.0
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); }

if ( ! is_singular() ) {
	$wpv_title = tribe_get_events_title(false);
}

get_header(); ?>
<div class="row page-wrapper">
	<?php WpvTemplates::left_sidebar() ?>
	<article <?php post_class(WpvTemplates::get_layout()) ?>>
		<?php tribe_events_before_html(); ?>
		<?php tribe_get_view(); ?>
		<?php tribe_events_after_html(); ?>
	</article>
	<?php WpvTemplates::right_sidebar() ?>

	<?php if(has_action('wpv_tribe_events_after_sidebars-1') || has_action('wpv_tribe_events_after_sidebars-2')): ?>
		</div><!-- .page-wrapper -->
		</div><!-- .limit-wrapper -->

		<?php if(has_action('wpv_tribe_events_after_sidebars-1')): ?>
			<div class="clearfix single-event-after-sidebars-1">
				<?php do_action('wpv_tribe_events_after_sidebars-1') ?>
			</div>
		<?php endif ?>
		<?php if(has_action('wpv_tribe_events_after_sidebars-2')): ?>
			<div class="clearfix single-event-after-sidebars-2">
				<div class="limit-wrapper">
					<?php do_action('wpv_tribe_events_after_sidebars-2') ?>
				</div>
			</div>
		<?php endif ?>

		<div><div> <!-- dummy tags -->
	<?php endif ?>
</div>
<?php get_footer(); ?>