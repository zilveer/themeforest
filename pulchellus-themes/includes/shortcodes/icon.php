<?php
	add_shortcode('icon', 'icon_handler');

	function icon_handler($atts, $content=null, $code="") {
	
		switch($atts['size']){
			case "small":
				$size = " icon-2x";
				break;
			case "medium":
				$size = " icon-3x";
				break;
			case "large":
				$size = " icon-4x";
				break;
		    default:
				$size = " icon-2x";
		}
		/* borders */
		if(isset($atts["borders"]) && $atts["borders"]=="yes") {
			$borders = " icon-border";
		} else {
			$borders = false;
		}
		
		return '<i class="'.$atts['style'].$size.$borders.'"></i>';
	}

?>