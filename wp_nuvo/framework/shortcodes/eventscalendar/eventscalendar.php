<?php
add_shortcode('cs-event-calendar', 'cs_shortcode_event_calendar_render');

function cs_shortcode_event_calendar_render($params, $content = null)
{
    extract(shortcode_atts(array(
        'title' => '',
        'image' => '',
        'description' => '',
        'class' => ''
    ), $params));
    // date_default_timezone_set("America/Los_Angeles");
    wp_enqueue_style('fullcalendar', get_template_directory_uri() . "/framework/shortcodes/eventscalendar/css/fullcalendar.css");
    wp_enqueue_script('moment', get_template_directory_uri() . "/framework/shortcodes/eventscalendar/js/moment.min.js");
    wp_enqueue_script('fullcalendar', get_template_directory_uri() . "/framework/shortcodes/eventscalendar/js/fullcalendar.min.js");
    wp_register_script('custom.fullcalendar', get_template_directory_uri() . "/framework/shortcodes/eventscalendar/js/custom.fullcalendar.js");
    wp_localize_script('custom.fullcalendar', 'events', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
    wp_enqueue_script('custom.fullcalendar');

    ob_start();
    ?>
    <div class="cs-calendar">
        <div class="event-calendar"></div>
        <!-- Button trigger modal -->
		<button type="button" class="btn btn-primary btn-lg event-calendar-modal" data-toggle="modal" data-target="#event-calendar-modal" style="display: none;"></button>
        <!-- Modal -->
		<div class="modal fade" id="event-calendar-modal" tabindex="-1" role="dialog" style="padding-top: 100px;">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 style="text-align: center;margin-top: 20px;"><?php esc_html_e('Events', 'wp_nuvo'); ?></h4>
		      </div>
		      <div class="modal-body">
		      </div>
		    </div>
		  </div>
		</div>
    </div>
    <?php
    return ob_get_clean();
}
/**
 * get events
 */
add_action('wp_ajax_cshero_events_month', 'cshero_events_month_callback');
add_action('wp_ajax_nopriv_cshero_events_month', 'cshero_events_month_callback');

function cshero_events_month_callback()
{
    //header('Content-Type: application/json');
    global $wpdb;
    
    $month = $_REQUEST['month'];
    $year = $_REQUEST['year'];
    
    $start_month = strtotime($year.'-'.$month.'-01');
    $end_month = date('Y/m/d', strtotime('+1 month -1 second', $start_month));
    
    $start_month = date('Y/m/d', $start_month);
    
    $querystr = "
        SELECT e.post_id, e.event_name, e.event_start_date, e.event_start_time, e.event_end_date, e.event_end_time
        FROM {$wpdb->prefix}em_events as e
        WHERE e.event_status = '1'
        AND e.event_start_date >= '{$start_month}'
        AND e.event_start_date <= '{$end_month}'
    ";    
    $results = $wpdb->get_results($querystr, OBJECT);
    $events = array();
    foreach ($results as $event){
        $event_obj = new stdClass();
        
        $start_time = strtotime($event->event_start_time);
        $end_time = strtotime($event->event_end_time);
        
        $event_obj->title = $event->event_name.' ('.date('H:i a',$start_time).'-'.date('H:i a',$end_time).')';
        $event_obj->start = $event->event_start_date;
        $event_obj->url = get_the_permalink($event->post_id);
        $events[] = $event_obj;
        unset($event_obj);
    }
    die(json_encode($events));
}


/**
 * get events
 */
add_action('wp_ajax_cshero_events_date', 'cshero_events_date_callback');
add_action('wp_ajax_nopriv_cshero_events_date', 'cshero_events_date_callback');

function cshero_events_date_callback()
{
	global $wpdb;
	
	if(!empty($_REQUEST['day']) && !empty($_REQUEST['month']) && !empty($_REQUEST['year'])) {
		
		$date = date('Y/m/d', strtotime($_REQUEST['year'].'-'. $_REQUEST['month'].'-'.$_REQUEST['day']));
		
		$querystr = "
		SELECT e.post_id, e.event_name, e.event_start_date, e.event_start_time, e.event_end_date, e.event_end_time
		FROM {$wpdb->prefix}em_events as e
		WHERE e.event_status = '1'
		AND e.event_start_date = '{$date}'
		";
		
		$results = $wpdb->get_results($querystr, OBJECT);
		
		if(empty($results)) {
			echo '<span class="no-events" style="text-align: center;">' . esc_html_e('No Events.', 'wp_nuvo') . '</span>';
			exit();
		}
		
		foreach ($results as $event){
			
			$start_time = strtotime($event->event_start_time);
			$end_time = strtotime($event->event_end_time);
			
			echo '<a href="'.get_the_permalink($event->post_id).'">'.$event->event_name. ' ' .$event->event_name.' ('.date('H:i a',$start_time).'-'.date('H:i a',$end_time).')</a></br>';
		}
		
	} else {
		echo '<span class="no-events" style="text-align: center;">' . esc_html_e('No Events.', 'wp_nuvo') . '</span>';
	}

	exit();
}