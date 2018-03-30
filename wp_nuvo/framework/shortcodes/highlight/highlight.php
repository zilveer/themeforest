<?php
add_shortcode('cs-highlight', 'cs_highlight_render');
function cs_highlight_render($params, $content = null) {
	extract(shortcode_atts(array(
				"color"=>"",
				"background_color"=>""), $params));
	$html =  "<span class='highlight'";
	if($color != "" || $background_color != ""){
		$html .= " style='color: ".esc_attr($color)."; background-color:".esc_attr($background_color).";'";
	}
	$html .= ">" . $content . "</span>";
	return $html;
}