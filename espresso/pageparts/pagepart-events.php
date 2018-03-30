<?php

global $event_items_title, $previous_section;
$event_style = get_post_meta($post->ID,'_event_style',true);

switch ($event_style){

	case 'upcoming':
	
		$event_count = get_post_meta($post->ID,'_event_count',true);
		$event_category = get_post_meta($post->ID,'_event_category',true);
		
		$event_args = array(
			'eventDisplay'=>'list',
			'posts_per_page'=>$event_count
		);
		
		if ($event_category){
			$event_args['tax_query'] = array(
		        array(
		            'taxonomy' => 'tribe_events_cat',
		            'field' => 'id',
		            'terms' => $event_category
		        )
		    );
		}
		
		$events = tribe_get_events($event_args);
		
		$temp_count = 0; $total_count = 0;
		
		if (!empty($events)):
			?><section id="homepage-events" class="homepage-block">
				<div class="shell clearfix">
					<h2 class="centered"><span><?php echo $event_items_title; ?></span></h2>
					<div class="widget"><?php
						foreach ($events as $event) {
						
							$temp_count++; $total_count++;
						
							$start_date = strtotime(tribe_get_start_date($event->ID,false,'Y-m-d H:i:s'));
							$start_date_day = date('Y-m-d', $start_date);
							$end_date = strtotime(tribe_get_end_date($event->ID,false,'Y-m-d H:i:s'));
							$end_date_day = date('Y-m-d', $end_date);
							$all_day = tribe_event_is_all_day($event->ID);
							$time_format = get_option('time_format');
							$date_format = get_option('date_format');
							
							if ($all_day){
								$date_format = date_i18n($date_format, $start_date).'<span>&bull;</span> <em>'.__('All day','espresso').'</em>';
							} else if ($end_date_day){
								if ($start_date_day == $end_date_day){
									$date_format = date_i18n($date_format, $start_date).'<span>&bull;</span> <em>'.date($time_format,$start_date).' &ndash; '.date($time_format,$end_date).'</em>';
								} else {
									$date_format = date_i18n($date_format, $start_date).' <em>@ '.date($time_format,$start_date).'<br />'.__('to','espresso').'</em> '.date_i18n($date_format, $end_date).' <em>@'.date($time_format,$end_date).'</em>';
								}
							}
							
							if (has_post_thumbnail($event->ID)){
								$image_url = wp_get_attachment_image_src(get_post_thumbnail_id($event->ID),'recent-post-thumbnail'); $image_url = $image_url[0];
							} else {
								$image_url = false;
							}
							
							?><article class="upcoming-event-block clearfix">
								<?php if ($image_url): ?><p><a href="<?php echo tribe_get_event_link($event->ID); ?>"><img src="<?php echo $image_url; ?>" alt="<?php the_title(); ?>" /></a></p><?php endif; ?>
								<h3><a href="<?php echo tribe_get_event_link($event->ID); ?>"><?php echo apply_filters('the_title', $event->post_title); ?></a></h3>
								<small><?php echo $date_format; ?></small>
								<p><?php echo ($event->post_excerpt ? $event->post_excerpt : espressoTruncate($event->post_content,155).' ...'); ?></p>
								<a class="es-button" href="<?php echo tribe_get_event_link($event->ID); ?>"><?php _e('Event Information','espresso'); ?></a>
							</article><?php
							
							if ($temp_count == 3 && $total_count != $event_count){ echo '<div class="cl"></div>'; $temp_count = 0; }
							
						}
					?></div>
				</div>
			</section><?php
		
		endif;
		
	break;
	case 'schedule':
		
		$event_category = get_post_meta($post->ID,'_event_category',true);
		echo '<div class="schedule-category">'.($event_category ? $event_category : 0).'</div>';
		
		?><section id="homepage-events" class="homepage-block">
				<div class="shell clearfix" style="position:relative;">
					<h2 class="centered"><span><?php echo $event_items_title; ?></span></h2>
					<a href="#" class="fg-schedule-prev-week fg-schedule-week-change" data="<?php echo date('Y/m/d', strtotime('-1 week')); ?>"><?php _e('Previous Week','espresso'); ?></a>
					<a href="#" class="fg-schedule-next-week fg-schedule-week-change" data="<?php echo date('Y/m/d', strtotime('+1 week')); ?>"><?php _e('Next Week','espresso'); ?></a><?php
					echo '<div id="schedule-block" class="ajax-wrapper"><div class="spinner"></div></div>';
				?></div>
		</section><?php
	
	break;

}

wp_reset_query();