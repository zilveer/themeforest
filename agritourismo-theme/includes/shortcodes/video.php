<?php
	add_shortcode('ot-video', 'ot_video_handler');
	
	
	function ot_video_handler($atts, $content=null, $code="") {
		if(isset($atts['url'])) {
			$video = OT_youtube_image($atts['url']);
			$image = "http://img.youtube.com/vi/".$video."/0.jpg";
			if($atts['type']=="youtube") {
				$return =  '		
					<div class="video-container">
						<iframe width="820" height="615" src="http://www.youtube.com/embed/'.$video.'?rel=0" frameborder="0" allowfullscreen></iframe>
					</div>';
			}
			if($atts['type']=="vimeo") {
				$return =  '		
					<div class="video-container">
						<iframe src="//player.vimeo.com/video/'.$video.'?color=ff9933" width="820" height="461" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
					</div>';
			}
		} else {
			$return = "No url attribute defined!";
		
		}
			
		return $return;
	}
	
?>
