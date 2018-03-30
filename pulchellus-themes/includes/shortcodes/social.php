<?php
	add_shortcode('social', 'social_handler');
	add_shortcode('account', 'social_handler');
	

	function social_handler($atts, $content=null, $code="") {

	
		if($code == "account") {
			/* Icon */
			$icon=$atts["icon"];
			return '<li><a href="'.$content.'" class="social-'.$icon.'" target="_blank"></a></li>';
		} elseif($code == "social") {
			$content = '<ul class="social-set">'.$content.'</ul>';
		}
		
		$content = do_shortcode($content);
		$content = remove_br($content);
		return $content;
	}
	
?>