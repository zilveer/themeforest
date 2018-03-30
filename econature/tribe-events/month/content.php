<?php
/**
 * Month View Content Template
 * The content template for the month view of events. This template is also used for
 * the response that is returned on month view ajax requests.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/month/content.php
 *
 * @package TribeEventsCalendar
 *
 * @cmsms_package 	EcoNature
 * @cmsms_version 	1.2.2
 *
 */


if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<div id="tribe-events-content" class="tribe-events-month">
	
	<!-- Month Header -->
	<?php do_action( 'tribe_events_before_header' ) ?>
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
		
		<!-- Month Title -->
		<?php do_action( 'tribe_events_before_the_title' ) ?>
		<h1 class="tribe-events-page-title"><?php tribe_events_title() ?></h1>
		<?php do_action( 'tribe_events_after_the_title' ) ?>
		
		<!-- Header Navigation -->
		<?php tribe_get_template_part( 'month/nav' ); ?>
		
	</div>
	<?php do_action( 'tribe_events_after_header' ) ?>

	<!-- Notices -->
	<?php tribe_the_notices() ?>

	<!-- Month Grid -->
	<?php tribe_get_template_part( 'month/loop', 'grid' ) ?>

	<!-- Month Footer -->
	<div id="tribe-events-footer">
		<?php do_action( 'tribe_events_before_footer' ) ?>
		<?php do_action( 'tribe_events_after_footer' ) ?>
	</div>
	
	<?php tribe_get_template_part( 'month/mobile' ); ?>
	<?php tribe_get_template_part( 'month/tooltip' ); ?>
	
</div><!-- #tribe-events-content -->
