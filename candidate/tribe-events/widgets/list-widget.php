<?php
/**
 * Events List Widget Template
 * This is the template for the output of the events list widget. 
 * All the items are turned on and off through the widget admin.
 * There is currently no default styling, which is needed.
 *
 * This view contains the filters required to create an effective events list widget view.
 *
 * You can recreate an ENTIRELY new events list widget view by doing a template override,
 * and placing a list-widget.php file in a tribe-events/widgets/ directory 
 * within your theme directory, which will override the /views/widgets/list-widget.php.
 *
 * You can use any or all filters included in this file or create your own filters in 
 * your functions.php. In order to modify or extend a single filter, please see our
 * readme on templates hooks and filters (TO-DO)
 *
 * @return string
 *
 * @package TribeEventsCalendar
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_plural = tribe_get_event_label_plural();

$posts = tribe_get_list_widget_events();

//Check if any posts were found
if ( $posts ) {
?>

<ul class="upcoming-events">
<?php
	foreach( $posts as $post ) :
		setup_postdata( $post );
		$event_id = $post->ID;
?>
	<li class="tribe-events-list-widget-events <?php tribe_events_event_classes(); ?> ">
	
		<?php 
		$address = tribe_address_exists() ? '' . tribe_get_full_address() . '' : '';
		do_action( 'tribe_events_list_widget_before_the_event_title' ); 
		
		$time_format = get_option( 'time_format', Tribe__Date_Utils::TIMEFORMAT );
		$start_datetime = tribe_get_start_date();
		$start_date = tribe_get_start_date( null, false );
		$start_time = tribe_get_start_date( null, false, $time_format );
		$start_ts = tribe_get_start_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );
		
		$start_day = tribe_get_start_date( null, false, 'd' );
		$start_month = tribe_get_start_date( null, false, 'M' );
		?>
		
		
		<div class="date">
			<span>
				<span class="day"><?php echo $start_day; ?></span>
				<span class="month"><?php echo $start_month; ?></span>
			</span>
		</div>

		<?php do_action( 'tribe_events_list_widget_after_the_event_title' ); ?>	
		<!-- Event Time -->
		
		<?php do_action( 'tribe_events_list_widget_before_the_meta' ) ?>
		<div class="event-content">
			<h6><a href="<?php echo tribe_get_event_link(); ?>"><?php the_title(); ?></a></h6>
			<ul class="event-meta">
				<li><i class="icons icon-clock"></i> <?php echo tribe_events_event_schedule_details(); ?></li>
				<li><i class="icons icon-location"></i> <?php echo $address; ?></li>
			</ul>
		</div>
		
		<?php do_action( 'tribe_events_list_widget_after_the_meta' ) ?>
		
		
	</li>
<?php
	endforeach;
?>
</ul><!-- .hfeed -->
<a href="<?php echo tribe_get_events_link(); ?>" class="button transparent button-arrow"><?php _e( 'More events', 'tribe-events-calendar' );	?></a>

<?php
//No Events were Found
} else {
?>
	<p><?php printf( __( 'There are no upcoming %s at this time.', 'tribe-events-calendar' ), strtolower( $events_label_plural ) ); ?></p>
<?php
}

// Cleanup. Do not remove this.
wp_reset_postdata();
?>
