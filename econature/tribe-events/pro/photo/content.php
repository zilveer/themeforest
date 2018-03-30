<?php
/**
 * Photo View Content
 * The content template for the photo view of events. This template is also used for
 * the response that is returned on photo view ajax requests.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/photo/content.php
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

<div id="tribe-events-content" class="tribe-events-photo">
	
	<!-- Photo View Header -->
	<?php do_action( 'tribe_events_before_header' ); ?>
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes(); ?>>
		
		<!-- Photo View Title -->
		<?php do_action( 'tribe_events_before_the_title' ); ?>
		<h1 class="tribe-events-page-title"><?php echo tribe_get_events_title(); ?></h1>
		<?php do_action( 'tribe_events_after_the_title' ); ?>
		
		<!-- Header Navigation -->
		<?php do_action( 'tribe_events_before_header_nav' ); ?>
		<?php tribe_get_template_part( 'pro/photo/nav', 'header' ); ?>
		<?php do_action( 'tribe_events_after_header_nav' ); ?>

	</div><!-- #tribe-events-header -->
	<?php do_action( 'tribe_events_after_header' ); ?>
	
	<!-- Notices -->
	<?php tribe_the_notices(); ?>
	
	<!-- Events Loop -->
	<?php if ( have_posts() ) : ?>
		<?php do_action( 'tribe_events_before_loop' ); ?>
		<?php tribe_get_template_part( 'pro/photo/loop' ); ?>
		<?php do_action( 'tribe_events_after_loop' ); ?>
	<?php endif; ?>

	<!-- List Footer -->
	<div id="tribe-events-footer">
		<?php do_action( 'tribe_events_before_footer' ); ?>
		<?php do_action( 'tribe_events_after_footer' ) ?>
	</div>

</div><!-- #tribe-events-content -->