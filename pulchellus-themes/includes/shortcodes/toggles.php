<?php
	add_shortcode('toggles', 'toggles_handler');
	function toggles_handler($atts, $content=null, $code="") {
		/* Icon */
		if(isset($atts["icon"]) && $atts["icon"]!="none") {
			$icon = $atts["icon"];
			$icon = "<i class=".$icon."></i>";
		} else {
			$icon = false;
		}
		
		
        $return =  '<div class="toggle">';
			$return.=  '<h4 class="title">'.$icon.$atts["title"].'</h4>';
			$return.=  '<div class="togglebox">';
				$return.=  '<p>'.$content.'</p>';
			$return.=  '</div>';
        $return.=  '</div>';
		return $return;
	}
?>