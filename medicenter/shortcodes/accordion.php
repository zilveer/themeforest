<?php
function theme_accordion($atts, $content)
{
	extract(shortcode_atts(array(
		"width" => ""
	), $atts));
	
	$output .= '<ul class="accordion"' . ($width!="" ? ' style="width: ' . $width . 'px"' : '') . '>
		' . do_shortcode($content) . '
	</ul>';
	return $output;
}
add_shortcode("accordion", "theme_accordion");

function theme_accordion_item($atts, $content)
{
	global $themename;
	extract(shortcode_atts(array(
		"id" => "",
		"header" => "Header",
		"subheader" => ""
	), $atts));
	
	if($id!="")
	{
		$output .= '<li>
			<div id="accordion-' . $id . '">
				<h3>' . $header . '</h3>'
				. ($subheader!="" ? '<h5>' . $subheader . '</h5>' : '') . '
			</div>
			<div class="clearfix">
			' . do_shortcode(apply_filters("the_content", $content)) . '
			</div>
		</li>';
	}
	else
		$output .= __("Attribute id is required. For example [accordion_item id='item-1']", 'medicenter');
	return $output;
}
add_shortcode("accordion_item", "theme_accordion_item");
?>