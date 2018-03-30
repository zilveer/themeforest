<?php
function webnus_icon_divider ($atts, $content = null) {
	extract(shortcode_atts(array(
	'name'			=>	'',
	'color'			=>	''

	), $atts));

	$style = 'style="';
	if(!empty($color)) $style .= ' color:' . $color. ';';
	
	
	$style .= '"';						
	 $out = '<div class="sec-divider"><div class="cir '. $name .'" '.$style.'></div></div>';
	return $out;
}
add_shortcode('icon-divider','webnus_icon_divider');
?>