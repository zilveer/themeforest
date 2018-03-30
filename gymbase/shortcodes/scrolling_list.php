<?php
//scrolling list
function theme_scrolling_list($atts, $content)
{
	extract(shortcode_atts(array(
		"title" => "",
		"id" => ""
	), $atts));
	
	$output .= '
	<div class="clearfix">
		<div class="header_left">
			<h3 class="box_header">
				' . $title . '
			</h3>
		</div>
		<div class="header_right">
			<a href="#" id="' . $id . '_prev" class="scrolling_list_control_left icon_small_arrow left_white"></a>
			<a href="#" id="' . $id . '_next" class="scrolling_list_control_right icon_small_arrow right_white"></a>
		</div>
	</div>
	<div class="scrolling_list_wrapper">
		<ul class="scrolling_list ' . $id . '">
			' . do_shortcode($content) . '
		</ul>
	</div>';
	return $output;
}
add_shortcode("scrolling_list", "theme_scrolling_list");
?>