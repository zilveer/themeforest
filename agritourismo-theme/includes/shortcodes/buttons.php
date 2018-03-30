<?php
add_shortcode('button', 'button_handler');

function button_handler($atts, $content=null, $code="") {
	extract(shortcode_atts(array('color' => null,'textcolor' => null,'type' => null,'icon' => null,), $atts) );


	if(isset($icon) && $icon!="none" ) {
		if($type=="link") {
			$icon = '<span class="icon-text left">'.htmlspecialchars_decode ($icon).'</span>';
		} else {
			$icon = '<span class="icon-text">'.htmlspecialchars_decode ($icon).'</span>';
		}
	} else {
		$icon = false;
	}


	/* Target */
	$target=$atts["target"];
	if(!isset($atts["target"]) || $atts["target"]=="blank") {
		$target="_blank";
	} else {
		$target="_self";
	}

	/* link */
	if(isset($atts["link"])) {
		$link = $atts["link"];
	} else {
		$link = "#";
	}

	if($type=="link") {
		if($icon==false) {
			$return = '<a href="'.$link.'" class="button-link" target="'.$target.'" style="background:#'.$color.'; color:#'.$textcolor.';">'.$content.'<span class="icon-text">&#9656;</span></a>';
		} else {
			$return = '<a href="'.$link.'" class="button-link" target="'.$target.'" style="background:#'.$color.'; color:#'.$textcolor.';">'.$icon.$content.'</a>';
		}
	} else {
		$return = '<a href="'.$link.'" class="styled-button" target="'.$target.'" style="background:#'.$color.'; color:#'.$textcolor.';">'.$icon.$content.'</a>';
	}

	
	return $return;
}

?>