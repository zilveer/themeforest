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
 * @cmsms_package 	EcoNature
 * @cmsms_version 	1.2.2
 *
 */


if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

$event_id = get_the_ID();

if (have_posts()) : the_post();

?>

<div id="tribe-events-content" class="tribe-events-single vevent hentry">
	<div id="post-<?php the_ID(); ?>" <?php post_class('cmsms_single_event'); ?>>
		<div class="cmsms_single_event_header clearfix">
			<div class="cmsms_single_event_header_left clearfix">
				<?php the_title('<h1 class="tribe-events-single-event-title summary entry-title">', '</h1>'); ?>
				<div class="tribe-events-schedule updated published clearfix">
				<?php 
					echo '<h6>' . 
						tribe_events_event_schedule_details( $event_id, '', '') . 
					'</h6>';
					
					if (tribe_get_cost()) {
						echo '<h6 class="tribe-events-cost">' . tribe_get_cost( null, true ) . '</h6>';
					} 
				?>
				</div>
			</div>
			<div class="cmsms_single_event_header_right clearfix">
				<h6 class="tribe-events-back">
					<a class="cmsms-icon-calendar-8" href="<?php echo esc_url( tribe_get_events_link() ); ?>"><?php printf( __( 'All %s', 'tribe-events-calendar' ), $events_label_plural ); ?></a>
				</h6>
				<?php Tribe__Events__iCal::single_event_links(); ?>
			</div>
		</div>
		<?php 
		tribe_the_notices();
		
		if (has_post_thumbnail() || tribe_embed_google_map()) {
			echo '<div class="cmsms_single_event_inner">';
				if (has_post_thumbnail()) {
					echo '<div class="cmsms_single_event_img' . (!tribe_embed_google_map() ? ' cmsms_single_event_full_width' : '') . '">' . 
						tribe_event_featured_image($event_id, 'project-thumb', false) . 
					'</div>';
				}
				
				
				if (tribe_embed_google_map()) {
					echo '<div class="cmsms_single_event_map' . (!has_post_thumbnail() ? ' cmsms_single_event_full_width' : '') . '">';
						tribe_get_template_part('modules/meta/map');
					echo '</div>';
				}
			echo '</div>';
		}
		
		
		do_action('tribe_events_single_event_before_the_content');
		
		echo '<div class="tribe-events-single-event-description cmsms_single_event_content tribe-events-content entry-content description">';
			
			the_content();
			
		echo '</div>';
		
		remove_action('tribe_events_single_event_after_the_content', array('Tribe__Events__iCal', 'single_event_links'));
		
		do_action('tribe_events_single_event_after_the_content');
		
		
		do_action('tribe_events_single_event_before_the_meta');
		
		if (!apply_filters('tribe_events_single_event_meta_legacy_mode', false)) {
			tribe_get_template_part( 'modules/meta' );
		} else {
			echo tribe_events_single_event_meta();
		}
		
		do_action('tribe_events_single_event_after_the_meta');
		?>
	</div>
	<?php 
	$cmsms_post_type = get_post_type();
	
	$published_events = wp_count_posts($cmsms_post_type)->publish;
	
	if ($published_events > 1) {
		echo '<aside id="tribe-events-sub-nav" class="post_nav">';		
			echo '<span class="tribe-events-nav-previous cmsms_prev_post">'; 
				tribe_the_prev_event_link('%title%');
				echo '<span class="cmsms_prev_arrow"><span></span></span>';
			echo '</span>';
			
			echo '<span class="tribe-events-nav-next cmsms_next_post">';
				tribe_the_next_event_link('%title%');
				echo '<span class="cmsms_next_arrow"><span></span></span>';
			echo '</span>';
		echo '</aside>';
	}
	
	
	if (get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option('showComments', false)) {
		comments_template();
	}
	?>
</div>


<?php endif; ?>
