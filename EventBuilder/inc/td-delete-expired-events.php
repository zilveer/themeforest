<?php

// schedule the check_expired_events event only once
if( !wp_next_scheduled( 'check_ended_events' ) ) {
   wp_schedule_event( time(), 'daily', 'check_ended_events' );
}
 
add_action( 'check_ended_events', 'td_delete_expired_events' );
function td_delete_expired_events() {

	$deletedEvents = 0;

	query_posts( array('post_type' => 'event', 'posts_per_page' => -1, 'order' => 'DESC', 'post_status' => 'publish' ));

   	if (have_posts()) : while (have_posts()) : the_post();

		$postID = get_the_ID();

		$event_end_date = get_post_meta($postID, 'event_end_date_number', true); 
		if(!empty($event_end_date)) {

			$event_status = get_post_meta($postID, 'event_status', true);
			$enddate = get_post_meta($postID, 'event_end_date_number', true);
			$startdate = current_time('timestamp');
			if($event_status != "past") {
				if($startdate >= $enddate) {

					update_post_meta($postID, 'event_status', 'past');

					$deletedEvents++;

					global $redux_demo;
	            	$delete_state = $redux_demo['delete-elements-state'];
	            	if($delete_state == 2) {
						wp_delete_post( $postID, true );
					}

					if($delete_state == 3) {

						$event_start_date = get_post_meta($postID, 'event_start_date', true);
						$event_start_time = get_post_meta($postID, 'event_start_time', true);
						$time_in_24_hour_format  = date("H:i", strtotime($event_start_time));
						$enddate = strtotime($event_start_date." ".$time_in_24_hour_format);

						$timestamp = strtotime('+365 days', $enddate);
						update_post_meta($postID, 'event_start_date_number', $timestamp);

						$currentDateFormated = date("m/d/Y",$timestamp);
						update_post_meta($postID, 'event_start_date', $currentDateFormated);

						$timestamp = strtotime('+366 days', $enddate);
						update_post_meta($postID, 'event_end_date_number', $timestamp);

						$currentDateFormated = date("m/d/Y",$timestamp);
						update_post_meta($postID, 'event_end_date', $currentDateFormated);

						update_post_meta($postID, 'event_status', 'upcoming');
					}

				}

			}

		}

	endwhile; endif;
	wp_reset_postdata();

	$emailTo = get_option( 'admin_email' );
	$subject = "Message from ".$blog_title; 
	$body =  "Checking for ended events. ".$deletedEvents."  updated events.";
	$headers = 'From <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
				  
	wp_mail($emailTo, $subject, $body, $headers);

}