<?php
	add_shortcode('blockquote', 'blockquote_handler');

	function blockquote_handler($atts, $content=null, $code="") {


		/* Icon */
		if(isset($atts["icon"])) {
			$icon = $atts["icon"];	
		} else {
			$icon = false;
		}


		if($icon && $icon!="hearts" && $icon!="none") {
			$icon = '<span class="icon-text">&#'.$icon.';</span>';
		} else if($icon=="hearts") {
			$icon = '<span class="icon-text">&'.$icon.';</span>';
		} else {
			$icon = false;
		}

		$return=  '<blockquote class="style-'.$atts['style'].'">';
			$return.=  $content;
		$return.=  '</blockquote>';


		return $return;
	}
?>
