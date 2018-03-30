<?php

// Recent Posts
// ----------------------------------------------------
class BoxyWidgetUpcomingEvents extends BoxyWidgetBase {
	
	/*
	* Register widget function. Must have the same name as the class
	*/
	function BoxyWidgetUpcomingEvents() {
		$widget_opts = array(
			'classname' => 'theme-widget-upcoming-events', // class of the <li> holder
			'description' => __( 'Displays your upcoming events.','espresso' ) // description shown in the widget list
		);
		// Additional control options. Width specifies to what width should the widget expand when opened
		$control_ops = array(
			//'width' => 350,
		);
		// widget id, widget display title, widget options
		parent::__construct('theme-widget-upcoming-events', __('[ESPRESSO] Upcoming Events','espresso'), $widget_opts, $control_ops);
		$this->custom_fields = array(
			array(
				'name'=>'title',
				'type'=>'text',
				'title'=>'Title', 
				'default'=>__('Upcoming Events','espresso')
			),
			array(
				'name'=>'load',
				'type'=>'integer',
				'title'=>__('How many total items?','espresso'), 
				'default'=>'3'
			)
		);
	}
	
	/*
	* Called when rendering the widget in the front-end
	*/
	function front_end($args, $instance) {
	
		extract($args);
		
		$limit = intval($instance['load']);
		$title = $instance['title'];
		
		$events = tribe_get_events(array(
			'eventDisplay'=>'list',
			'posts_per_page'=>$limit
		));
		
		if (!empty($events)) {
		
			echo ($title ? $before_title.$title.$after_title : '');
			
			foreach ($events as $event) {
			
				$start_date = strtotime(tribe_get_start_date($event->ID,false,'Y-m-d H:i:s'));
				$start_date_day = date('Y-m-d', $start_date);
				$end_date = strtotime(tribe_get_end_date($event->ID,false,'Y-m-d H:i:s'));
				$end_date_day = date('Y-m-d', $end_date);
				$all_day = tribe_event_is_all_day($event->ID);
				$time_format = get_option('time_format');
				
				if ($all_day){
					$date_format = date_i18n('F j', $start_date).'<span>&bull;</span> <em>'.__('All day','espresso').'</em>';
				} else if ($end_date_day){
					if ($start_date_day == $end_date_day){
						$date_format = date_i18n('F j', $start_date).'<span>&bull;</span> <em>'.date($time_format,$start_date).' &ndash; '.date($time_format,$end_date).'</em>';
					} else {
						$date_format = date_i18n('F j', $start_date).' <em>@ '.date($time_format,$start_date).'<br />'.__('to','espresso').'</em> '.date_i18n('F j', $end_date).' <em>@'.date($time_format,$end_date).'</em>';
					}
				}
				
				?><article class="upcoming-event-block clearfix">
					<h3><a href="<?php echo get_permalink($event->ID); ?>"><?php echo apply_filters('the_title', $event->post_title); ?></a></h3>
					<small><?php echo $date_format; ?></small>
					<p><?php echo ($event->post_excerpt ? $event->post_excerpt : espressoTruncate($event->post_content,155).' ...'); ?></p>
					<a class="es-button" href="<?php echo get_permalink($event->ID); ?>"><?php _e('Event Information','espresso'); ?></a>
				</article><?php
			}
		} wp_reset_query();
		
	}
}

?>