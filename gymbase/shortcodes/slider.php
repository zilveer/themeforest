<?php
//slider
function theme_slider($atts, $content)
{
	global $theme_options;
	$output = '';
	$slides_count = count($theme_options["slider_image_url"]);
	if(count($slides_count))
	{
		$output .= '<ul class="slider">';
		for($i=0; $i<$slides_count; $i++)
		{
			$output .= '<li id="slide_' . $i . '" style="background-image: url(' . $theme_options["slider_image_url"][$i] . ');">
				&nbsp;</li>';
		}
		$output .= '</ul>';
	}
	return $output;
}
add_shortcode("slider", "theme_slider");

//slider content
function theme_slider_content($atts, $content)
{
	global $theme_options;
	$output = "";
	$slides_count = count($theme_options["slider_image_url"]);
	if(count($slides_count))
	{
		$output .= '<div class="slider_content_box clearfix">';
		for($i=0; $i<$slides_count; $i++)
		{
			if($theme_options["slider_image_title"][$i]!="" || $theme_options["slider_image_subtitle"][$i]!="")
			{
				$output .= '<div id="slide_' . $i . '_content" class="slider_content"' . ($i==0 ? ' style="display: block;"' : '') . '>';
				if($theme_options["slider_image_title"][$i]!="")
					$output .= '<h1 class="title">' . ($theme_options["slider_image_title"][$i]) . '</h1>';
				if($theme_options["slider_image_subtitle"][$i]!="")
					$output .= ($theme_options["slider_image_title"][$i]!="" ? '<br />' : '') . '<h3 class="subtitle">' . esc_attr($theme_options["slider_image_subtitle"][$i]) . '</h3>';
				$output .= '</div>';
			}
		}
		$output .= '	<div class="slider_navigation controls">';
		$j = 0;
		for($i=0; $i<$slides_count; $i++)
		{
			if($theme_options["slider_image_link"][$i]!="")
				$output .= '<a class="more" href="' . esc_attr($theme_options["slider_image_link"][$i]) . '" id="slide_' . $i . '_url"' . ($i==0 ? ' style="display: block;"' : '') . '>&nbsp;</a>';
		}
		$output .= '	<a id="prev" class="prev" href="#">&nbsp;</a><a id="next" class="next" href="#">&nbsp;</a>
					</div>
				</div>';
	}
	return $output;
}
add_shortcode("slider_content", "theme_slider_content");
?>
