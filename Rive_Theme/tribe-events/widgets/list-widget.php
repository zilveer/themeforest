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
 * @since  2.1
 * @author Modern Tribe Inc.
 *
 */
if ( !defined('ABSPATH') ) { die('-1'); } 
$posts = tribe_get_list_widget_events();
//Check if any posts were found
if ( $posts ) {
?>

<ol class="hfeed vcalendar">
<?php
	foreach( $posts as $post ) :
		setup_postdata( $post );
?>
	<li class="tribe-events-list-widget-events <?php tribe_events_event_classes() ?>">
	
		<?php do_action( 'tribe_events_list_widget_before_the_event_title' ); ?>
		<!-- Event Title -->
		<div class="when">
			<?php
				$space = false;
				$output = '';
			?>
			<div class="post-date left">
				<div class="post-day"><?php echo tribe_get_start_date( $post->ID, false, 'd'  ); ?></div>
				<div class="post-month"><?php echo tribe_get_start_date( $post->ID, false, 'M, Y' ); ?></div>
			</div>
		</div>
		<div class="event">
			<h3>
				<a href="<?php echo tribe_get_event_link(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h3>
			
			<?php do_action( 'tribe_events_list_widget_after_the_event_title' ); ?>	
			<!-- Event Time -->
			
			<?php do_action( 'tribe_events_list_widget_before_the_meta' ) ?>
			<p><?php echo substr( get_the_content(), 0, 70 ) . '...'; ?></p>
			<p class="date-time"><em>
				<?php 
					if( $event->AllDay ) {
						echo ' ('.__('All Day','tribe-events-calendar').')';
					} else {
						echo tribe_get_start_date( $post->ID, false, 'h:ia' ) . ' - ' . tribe_get_end_date($post->ID, false, 'h:ia');
					}
				?>
			</em></p>
		</div>
		
		<?php do_action( 'tribe_events_list_widget_after_the_meta' ) ?>
		
		
	</li>
<?php
	endforeach;
?>
</ol><!-- .hfeed -->

<p class="tribe-events-widget-link"><a href="<?php echo tribe_get_events_link(); ?>" rel="bookmark"><?php _e( 'View All Events', 'tribe-events-calendar' );	?></a></p>

<?php
//No Events were Found
} else {
?>
	<p><?php _e( 'There are no upcoming events at this time.', 'tribe-events-calendar' ); ?></p>
<?php
}
?>
