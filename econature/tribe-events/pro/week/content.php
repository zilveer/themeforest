<?php
/**
 * Week View Content
 * The content template for the week view. This template is also used for
 * the response that is returned on week view ajax requests.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/week/content.php
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

<div id="tribe-events-content" class="tribe-events-week-grid tribe-clearfix">
	
	<!-- Calendar Header -->
	<?php do_action( 'tribe_events_before_header') ?>
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
		
		<!-- Calendar Title -->
		<?php do_action( 'tribe_events_before_the_title') ?>
		<h1 class="tribe-events-page-title"><?php tribe_events_title() ?></h1>
		<?php do_action( 'tribe_events_after_the_title') ?>
		
		<!-- Header Navigation -->
		<?php tribe_get_template_part( 'pro/week/nav', 'header' ); ?>
		
	</div><!-- #tribe-events-header -->
	<?php do_action( 'tribe_events_after_header') ?>
	
	<!-- Notices -->
	<?php tribe_the_notices() ?>
	
	<!-- Calendar Grid -->
	<?php tribe_get_template_part( 'pro/week/loop', 'grid' ) ?>

	<!-- Calendar Footer -->
	<div id="tribe-events-footer">
		<?php do_action( 'tribe_events_before_footer') ?>
		<?php do_action( 'tribe_events_after_footer') ?>
	</div><!-- #tribe-events-footer -->

	<?php tribe_get_template_part( 'pro/week/mobile' ); ?>
	<?php tribe_get_template_part( 'pro/week/tooltip' ); ?>
	
</div><!-- #tribe-events-content -->