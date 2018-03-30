<?php
add_shortcode('button', 'button_handler');

function button_handler($atts, $content=null, $code="") {
	
	/* Color */
	$color=$atts["color"];
	if(isset($atts["style"])) {
		$style = $atts["style"];
	} else {
		$style = false;
	}
	if(isset($atts["textcolor"])) {
		$textColor = $atts["textcolor"];
	} else {
		$textColor = false;
	}
	/* Size */
	if(isset($atts["size"])) {
		$size = $atts["size"];
	} else {
		$size = false;
	}
	
	/* Target */
	if(!isset($atts["target"]) || $atts["target"]=="blank") {
		$target="_blank";
	} else {
		$target="_self";
	}

	/* Icon */
	if(isset($atts["icon"]) && $atts["icon"]!="none") {
		$icon = $atts["icon"];
		$icon = "<i class=".$icon."></i>";
	} else {
		$icon = false;
	}
	
	/* link */
	if(isset($atts["link"])) {
		$link = $atts["link"];
	} else {
		$link = "#";
	}
	if($size=="small") {
		$return = '<a href="'.$link.'" style="margin-bottom:5px; background:#'.$color.'; color:#'.$textColor.';" class="button small '.$style.'-btn" target="'.$target.'">'.$icon.$content.'</a>';
	} else if($size=="medium") {
		$return = '<a href="'.$link.'" style="margin-bottom:5px; background:#'.$color.'; color:#'.$textColor.';" class="button medium '.$style.'-btn" target="'.$target.'">'.$icon.$content.'</a>';
	} else if($size=="large") {
		$return = '<a href="'.$link.'" style="margin-bottom:5px; background:#'.$color.'; color:#'.$textColor.';" class="button large '.$style.'-btn" target="'.$target.'">'.$icon.$content.'</a>';
	}  else if($size=="full") {
		$return = '<a href="'.$link.'" style="margin-bottom:5px; background:#'.$color.'; color:#'.$textColor.';" class="button full-width '.$style.'-btn" target="'.$target.'">'.$icon.$content.'</a>';
	} else {
		$return = '<a href="'.$link.'" style="margin-bottom:5px; background:#'.$color.'; color:#'.$textColor.';" class="button '.$style.'-btn" target="'.$target.'">'.$icon.$content.'</a>';
	}
	return $return;
}

?>