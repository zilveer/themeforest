<?php
//social icons
function theme_social_icons_list($atts, $content)
{
	extract(shortcode_atts(array(
		"class" => "",
		"style" => ""
	), $atts));
	
	$output .= '
	<ul class="clearfix social_icons' . ($class!='' ? ' ' . $class : '') . '"' . ($style!="" ? ' style="' . $style . '"' : '') . '>
		' . do_shortcode($content) . '
	</ul>';
	return $output;
}
add_shortcode("social_icons_list", "theme_social_icons_list");
//social icon
function theme_social_icon($atts, $content)
{
	extract(shortcode_atts(array(
		"type" => "facebook",
		"url" => "#",
		"target" => "",
		"open_tag" => "<li>",
		"close_tag" => "</li>"
	), $atts));
	
	$output .= $open_tag . '<a' . ($target=="new_window" ? " target='_blank'" : "") . ' href="' . $url . '" class="social_icon ' . $type . '"></a>' . $close_tag;
	return $output;
}
add_shortcode("social_icon", "theme_social_icon");
?>