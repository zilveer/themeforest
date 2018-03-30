<?php

//define('WP_USE_THEMES', false);
require_once('../../../../wp-load.php');

$timezone_string = get_option('timezone_string');
if ($timezone_string):
	date_default_timezone_set(get_option('timezone_string'));
endif;

if (isset($_POST['first_day'])){
	$day = get_weekstartend(date('Y-m-d',strtotime($_POST['first_day'])));
	$day_checker_1 = $day['start'];
	$day_checker_2 = get_weekstartend(date('Y-m-d'));
	$day_checker_2 = $day_checker_2['start'];
} else {
	$day = get_weekstartend(date('Y-m-d'));
}

$current_day = date('Y-m-d H:i:s',strtotime(date('Y-m-d',$day['start']).'00:00:00'));
$todays_date = date('Ymd');
$days_done = 0;

echo '<div class="fg-schedule-tabs">';

	$date_format = get_option('date_format');

	// Display the dates (above the tabs)
	$date_first = date_i18n($date_format,$day['start']);
	$date_last = date_i18n($date_format,$day['end']);
	echo '<div class="date-range">'.$date_first.' &ndash; '.$date_last.'</div>';

	// Display the tabs
	do {
	
		$date_key = date_i18n('Ymd',strtotime($current_day));
		$start_date_for_count = date('Y-m-d',strtotime($current_day)).' 00:00:00';
		$end_date_for_count = date('Y-m-d',strtotime($current_day)).' 23:59:59';
		
		$event_category = (isset($_POST['category']) ? $_POST['category'] : 0);
		
		$event_args = array(
			'eventDisplay'=>'custom',
			'start_date'=>$start_date_for_count,
			'end_date'=>$end_date_for_count,
			'posts_per_page'=> -1
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
		
		$count_events = tribe_get_events($event_args);
		$event_count = count($count_events);
		
		echo '<a href="#" data="'.$date_key.'" class="fg-schedule-tab'.($date_key == $todays_date || isset($_POST['first_day']) && !$days_done && $day_checker_1 != $day_checker_2 ? ' active' : '').'">';
			echo '<span class="date">'.date_i18n($date_format,strtotime($current_day)).'</span>';
			echo '<span class="day">'.date_i18n('l',strtotime($current_day)).'</span>';
			echo '<span class="count'.(!$event_count ? ' empty' : '').'">'.$event_count.' '. _n('event','events',$event_count,'espresso').'</span>';
		echo '</a>';
		
		$current_day = date('Y-m-d H:i:s',strtotime($current_day . ' + 1 day'));
		$days_done++;
		
	} while ($days_done < 7);

echo '</div>';

echo '<div class="schedule-wrapper">';
	echo '<div class="schedule-content"></div>';
	echo '<div class="spinner" style="display:block;"></div>';
echo '</div>';

// END Tabs

?><script>

var currentlyLoading = false;

jQuery(document).ready(function($) {

	var event_category = $('.schedule-category').html();
	if (!event_category){ event_category = 0; }

	$('.spinner').spin('espresso');
	var tabDate = $('.fg-schedule-tab.active').attr('data');
	loadSchedule(tabDate,event_category);
	
	$('.fg-schedule-tab').click(function(e){
		e.preventDefault(); thisTab = $(this);
		if (!thisTab.hasClass('active') && currentlyLoading == false){
			var tabDate = thisTab.attr('data');
			$('.fg-schedule-tab').removeClass('active');
			thisTab.addClass('active');
			loadSchedule(tabDate,event_category);
		}
	});
	
});

function loadSchedule(date,category){

	currentlyLoading = true;
	jQuery('.schedule-content').html('');
	jQuery('.spinner').show();
	jQuery('.schedule-content').load(templateDir+'/ajax/schedule-day.php',{'date':date,'category':category},function(response, status, xhr){
		jQuery('.schedule-content').hide();
		jQuery('.spinner').hide();
		jQuery('.schedule-content').show();
		currentlyLoading = false;
	});
	
}
</script>