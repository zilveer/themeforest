<?php

function eventbox_shortcode ($atts, $content = null) {
	extract(shortcode_atts(array(
		'title' 	=>'',
		'date' 		=>'',
		'time' 		=>'',
		'desc'		=>'',
		'link_text'	=>'',
		'link_url'	=>''
	
	), $atts));
	
			$out  = '<div class="eventbox"><div class="eventbox-top"></div><div class="eventbox-cnt">';
			$out .= '<h2>' . $title . '</h2>';
			$out .= '<div class="date-time">';
			$out .= '<div class="date"><i class="li_calendar"></i>' . $date . '</div>';
			$out .= '<div class="heart"><i class="fa-heart"></i></div>';
			$out .= '<div class="time"><i class="fa-clock-o"></i>' . $time . '</div>';
			$out .= '</div>';
			$out .= '<p>' . $desc . '</p>';
			$out .= '<a class="magicmore" href="' . $link_url . '">' . $link_text . '</a>';
			$out .= '</div><div class="eventbox-bot"></div></div>';				

return $out;
}
add_shortcode('eventbox','eventbox_shortcode');

?>