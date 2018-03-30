<?php
add_shortcode('button', 'button_handler');

function button_handler($atts, $content=null, $code="") {
	extract(shortcode_atts(array('color' => null,'textcolor' => null,'icon' => null,'side' => null,'size' => null,), $atts) );


	if(isset($icon) && $icon!="Select a Icon" ) {
		$icon = '<i class="fa '.$icon.'"></i>';
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

	if($icon==false) {
		$return = '<a href="'.esc_url($link).'" class="btn btn_'.$size.'" target="'.$target.'" style="background-color:#'.$color.'; color:#'.$textcolor.';">'.$content.'</a>';
	} else if($icon!=false && $side=="left") {
		$return = '<a href="'.esc_url($link).'" class="btn btn_'.$size.'" target="'.$target.'" style="background-color:#'.$color.'; color:#'.$textcolor.';">'.$icon.'&nbsp;&nbsp;'.$content.'</a>';
	} else if($icon!=false && $side=="right") {
		$return = '<a href="'.esc_url($link).'" class="btn btn_'.$size.'" target="'.$target.'" style="background-color:#'.$color.'; color:#'.$textcolor.';">'.$content.'&nbsp;&nbsp;'.$icon.'</a>';
	}

	
	return $return;
}

?>
