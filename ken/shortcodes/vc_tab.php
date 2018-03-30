<?php

$output = $title = $tab_id = '';
extract(shortcode_atts($this->predefined_atts, $atts));

$output .= "\n\t\t\t" . '<div id="'. $tab_id .'" class="mk-tabs-pane"><div class="inner-box">';
$output .= '<div class="title-mobile">';
if(isset($icon)) {
	$output .= '<i class="'.$icon.'"></i>';	
}
$output .= $title;
$output .= '</div>';
$output .= wpb_js_remove_wpautop($content);
$output .= "\n\t\t\t" . '<div class="clearboth"></div></div><div class="clearboth"></div></div>';

echo $output;
