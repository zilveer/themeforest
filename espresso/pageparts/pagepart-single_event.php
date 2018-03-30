<?php

global $single_event_items_title, $previous_section, $single_event_id;

if ($single_event_id != 'next'):
	$event_args = array(
		'post__in' => array($single_event_id)
	);
else :
	$currentDate = current_time('Y-m-d H:i:s');
	$event_args = array(
		'eventDisplay' => 'custom',
		'meta_key' => '_EventStartDate',
        'meta_compare' => '>=',
        'meta_value' => $currentDate,
		'posts_per_page' => 1
	);
endif;

$event = tribe_get_events($event_args);

if (!empty($event)):
	?><section id="homepage-countdown" class="homepage-block countdown">
		<div class="shell clearfix">
			<h2 class="centered"><span><?php echo $single_event_items_title; ?></span></h2>
			<div class="widget"><?php
				foreach ($event as $e) {
				
					$start_date = strtotime(tribe_get_start_date($e->ID,false,'Y-m-d H:i:s'));
					$start_date_day = date('Y-m-d', $start_date);
					$end_date = strtotime(tribe_get_end_date($e->ID,false,'Y-m-d H:i:s'));
					$end_date_day = date('Y-m-d', $end_date);
					$all_day = tribe_event_is_all_day($e->ID);
					$time_format = get_option('time_format');
					$date_format = get_option('date_format');
					
					if ($all_day){
						$date_format = date_i18n($date_format, $start_date).' <span>&bull;</span> <em>'.__('All day','espresso').'</em>';
					} else if ($end_date_day){
						if ($start_date_day == $end_date_day){
							$date_format = date_i18n($date_format, $start_date).' <span>&bull;</span> <em>'.date($time_format,$start_date).' &ndash; '.date($time_format,$end_date).'</em>';
						} else {
							$date_format = date_i18n($date_format, $start_date).' <em>@ '.date($time_format,$start_date).'<br />'.__('to','espresso').'</em> '.date_i18n($date_format, $end_date).' <em>@'.date($time_format,$end_date).'</em>';
						}
					}
					
					?><article id="event-countdown" class="single-event-block">
						<div class="countdown-date"><?php echo date('F j, Y G i Z',$start_date); ?></div>
						<div class="event-info">
							<?php if (has_post_thumbnail($e->ID)): echo '<div class="event-img">'.get_the_post_thumbnail($e->ID,array(300,300)).'</div>'; endif; ?>
							<div class="event-content<?php if (has_post_thumbnail($e->ID)): echo ' with-img'; endif; ?>">
								<h3><a href="<?php echo tribe_get_event_link($e->ID); ?>"><?php echo apply_filters('the_title', $e->post_title); ?></a></h3>
								<small><?php echo $date_format; ?></small>
								<p><?php echo ($e->post_excerpt ? $e->post_excerpt : espressoTruncate($e->post_content,155).' ...'); ?></p>
								<a class="es-button" href="<?php echo tribe_get_event_link($e->ID); ?>"><?php _e('Event Information','espresso'); ?></a>
							</div>
						</div>
					</article><span class="hidden-timezone"><?php echo get_option('gmt_offset'); ?></span><?php
					
				}
			?></div>
		</div>
	</section><?php
endif;
wp_reset_query();