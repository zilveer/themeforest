<?php
function webnus_wedding_divider ($atts, $content = null) {
	extract(shortcode_atts(array(
	"type"=>'1',
	), $atts));

	$out= '';
	$out .= '<div class="w-divider'.$type.'"></div>';
	return $out;
}
add_shortcode('wedding-divider','webnus_wedding_divider');
?>