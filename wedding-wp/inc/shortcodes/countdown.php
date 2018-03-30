<?php

function webnus_countdown( $attributes, $content = null ) {
 	
	extract(shortcode_atts(array(
	"type"      => 'rose',
	'datetime' => '',
	'done' => '',
	
	
		), $attributes));
if(get_option('timezone_string')){
	date_default_timezone_set(get_option('timezone_string'));
}else{
	date_default_timezone_set('UTC');
}
	$data_until = esc_attr( strtotime( $datetime ) );
	$data_done = esc_attr( $done );
	if($type=="jasmine"){
		$label = array(
			'day' => __('DAYS', 'WEBNUS_TEXT_DOMAIN'), 
			'hours' => __('HRS', 'WEBNUS_TEXT_DOMAIN'), 
			'minutes' => __('MIN', 'WEBNUS_TEXT_DOMAIN'), 
			'seconds' => __('SEC', 'WEBNUS_TEXT_DOMAIN')
		);
	} else{
		$label = array(
			'day' => __('Days', 'WEBNUS_TEXT_DOMAIN'), 
			'hours' => __('Hours', 'WEBNUS_TEXT_DOMAIN'), 
			'minutes' => __('Minutes', 'WEBNUS_TEXT_DOMAIN'), 
			'seconds' => __('Seconds', 'WEBNUS_TEXT_DOMAIN')
		);
	}
	
 	$out  = '<div class="countdown-w ctd-' . $type . '" data-until="'. $data_until .'" data-done="'. $data_done .'" data-respond>';
	$out .= '<div class="days-w block-w"><i class="icon-w li_calendar"></i><div class="count-w"></div><div class="label-w">'. $label['day'] .'</div></div>';
	$out .= '<div class="hours-w block-w"><i class="icon-w fa-clock-o"></i><div class="count-w"></div><div class="label-w">'. $label['hours'] .'</div></div>';
	$out .= '<div class="minutes-w block-w"><i class="icon-w li_clock"></i><div class="count-w"></div><div class="label-w">'. $label['minutes'] .'</div></div>';
	$out .= '<div class="seconds-w block-w"><i class="icon-w li_heart"></i><div class="count-w"></div><div class="label-w">'. $label['seconds'] .'</div></div>';
	$out .= '</div>';
	
	return $out;

}

add_shortcode('countdown', 'webnus_countdown');		
?>