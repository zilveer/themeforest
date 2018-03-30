<?php
function mom_video($atts, $content) {
	extract(shortcode_atts(array(
		'width' => '600',
		'height' => '400',
		'id' => '',
		'type' => ''
			), $atts));
		if ($type=='youtube') {
			$type="http://www.youtube.com/embed/";
			} elseif($type == 'vimeo') {
				$type= "http://player.vimeo.com/video/";
			}							
		return '<div class="video_wrap"><iframe width="'.$width.'" height="'.$height.'" src="'.$type.$id.'"></iframe></div>';
	
	}

add_shortcode('mom_video', 'mom_video');

?>