<?php
function theme_tabs($atts, $content)
{
	extract(shortcode_atts(array(
		"width" => ""
	), $atts));
	
	$output .= '<div class="tabs"' . ($width!="" ? ' style="width: ' . $width . 'px"' : '') . '>
		' . do_shortcode($content) . '
	</div>';
	return $output;
}
add_shortcode("tabs", "theme_tabs");

function theme_tabs_navigation($atts, $content)
{	
	$output .= '<ul class="clearfix tabs_navigation">
		' . do_shortcode($content) . '
	</ul>';
	return $output;
}
add_shortcode("tabs_navigation", "theme_tabs_navigation");

function theme_tab($atts, $content)
{	
	global $themename;
	extract(shortcode_atts(array(
		"id" => ""
	), $atts));
	if($id!="")
	{
		$output .= '<li>
			<a title="' . esc_attr($content) . '" href="#' . $id . '">
				' . do_shortcode($content) . '
			</a>
		</li>';
	}
	else
		$output .= __("Attribute id is required. For example [tab id='tab-1']", 'medicenter');
	return $output;
}
add_shortcode("tab", "theme_tab");

function theme_tab_content($atts, $content)
{
	global $themename;
	extract(shortcode_atts(array(
		"id" => ""
	), $atts));
	
	if($id!="")
	{
		$output .= '<div id="' . $id . '">
			' . do_shortcode(apply_filters("the_content", $content)) . '
		</div>';
	}
	else
		$output .= __("Attribute id is required. For example [tab_content id='tab-1']", 'medicenter');
	return $output;
}
add_shortcode("tab_content", "theme_tab_content");
?>