<?php 
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @package TribeEventsCalendar
 * @since  3.0
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); } 

global $post;

?>
<div class="swm_event_box">
	<div class="swm_evt_date_img">
		<div class="swm_evt_date">
			<span class="swm_evt_date_day"><?php echo tribe_get_start_date( $post->ID, false, ' d ' ); ?></span> 
			<span class="swm_evt_date_month"><?php echo tribe_get_start_date( $post->ID, false, ' M ' ); ?></span>
			<span class="swm_evt_date_year"><?php echo tribe_get_start_date( $post->ID, false, ' Y ' ); ?></span>
		</div>
		<div class="swm_evt_img">
			<a href="<?php echo get_the_permalink(); ?>" title=""><?php echo get_the_post_thumbnail(get_the_ID(),'events'); ?></a>
		</div>
	</div>
	<div class="clear"></div>
	<div class="swm_evt_contet">
		<div class="swm_evt_title"><a href="<?php echo get_the_permalink(); ?>" title=""><?php the_title(); ?></a></div>
		<div class="swm_evt_desc"><?php the_excerpt(); ?></div>
		<div class="swm_evt_meta_venue"> <i class="fa fa-map-marker"></i><?php echo tribe_get_meta( 'tribe_event_venue_address' ); ?></div>
	</div>
</div>