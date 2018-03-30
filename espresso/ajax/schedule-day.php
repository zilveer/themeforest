<?php

//define('WP_USE_THEMES', false);
require_once('../../../../wp-load.php');

$this_date = date('Y-m-d',strtotime($_POST['date'])).' 00:00:00';
$end_date = date('Y-m-d',strtotime($_POST['date'])).' 23:59:59';
$todays_date_alt = date('Y-m-d',strtotime($this_date));
$event_category = (isset($_POST['category']) ? $_POST['category'] : 0);

$event_args = array(
	'post_type'=>'tribe_events',
	'posts_per_page'=> -1,
	'orderby'=>'meta_value',
	'meta_key' => '_EventStartDate',
	'order'=>'asc',
	'eventDisplay'=>'custom',
	'start_date'=>$this_date,
	'end_date'=>$end_date
);

if ($event_category != 0 && $event_category != '0'){
	$event_args['tax_query'] = array(
        array(
            'taxonomy' => 'tribe_events_cat',
            'field' => 'id',
            'terms' => $event_category
        )
    );
}

$events = new WP_Query($event_args);

if ($events->have_posts()):

	$time_format = get_option('time_format');
	
	echo '<div id="schedule-day" class="fg-schedule-block">';
	
		while($events->have_posts()){
		
			$events->the_post();
			$date_key = $post->EventStartDate;
			$date_key = date('Ymd',strtotime($date_key));
			
			$event_all_day = tribe_event_is_all_day($post->ID);
			$event_id = $post->ID;
			$event_start_day = date('Y-m-d', strtotime($post->EventStartDate));
			$event_start_time = date('Y-m-d H:i:s',strtotime($post->EventStartDate));
			$event_end_day = date('Y-m-d', strtotime($post->EventEndDate));
			$event_end_time = date('Y-m-d H:i:s',strtotime($post->EventEndDate));
			$event_title = $post->post_title;
			$event_url = $post->guid;
			$event_excerpt = ($post->post_excerpt ? $post->post_excerpt : espressoTruncate($post->post_content,155).' ...');
			
			if ($event_all_day){
				$date_format = __('All day','espresso');
			} else if ($event_end_day){
				if ($event_start_day == $event_end_day){
					$date_format = date($time_format,strtotime($event_start_time)).' &ndash; '.date($time_format,strtotime($event_end_time));
				} else if ($event_start_day == $todays_date_alt) {
					$date_format = __('Starts today','espresso').' @ '.date($time_format,strtotime($event_start_time));
				} else if ($event_end_day == $todays_date_alt) {
					$date_format = __('Ends today','espresso').' @ '.date($time_format,strtotime($event_end_time));
				} else {
					$date_format = __('All day','espresso');
				}
			}
	
			echo '<div class="fg-event">';
			
				if ( has_post_thumbnail() ) {
					echo '<div class="event-thumbnail">';
					the_post_thumbnail();
					echo '</div><div class="event-content">';
				}
				
				echo '<h3>'.$event_title;
				echo '<span class="fg-event-time">';
				echo $date_format;
				echo '</span></h3>';
				echo '<p>'.$event_excerpt.'</p>';
				echo '<p><a class="fg-event-link" href="'.get_permalink($event_id).'">'.__('More Information','espresso').'</a>';
				
				if ( has_post_thumbnail() ) { echo '</div>'; }
				
			echo '</div>';
			
			wp_reset_postdata();
			
		}
	
	echo '</div>';
		
else :

	echo '<h3 class="fg-schedule-none">'.__('No events scheduled for this day.','espresso').'</h3>';

endif;