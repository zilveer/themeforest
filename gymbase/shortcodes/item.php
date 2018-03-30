<?php
//items list
function theme_item($atts, $content)
{
	extract(shortcode_atts(array(
		"icon" => "",
		"value" => "",
		"border_color" => "",
		"text_color" => "",
		"value_color" => "",
		"type" => ""
	), $atts));
	
	$output = '
	<li' . ($icon!="" ? ' class="icon_' . $icon . '"' : '') . ($border_color!='' ? ' style="border-bottom: ' . ($border_color=='none' ? 'none' : '1px solid #' . $border_color . '') . ';"' : '') . '>';
		$output .= 	'<span ' . ($text_color!='' ? ' style="color: #' . $text_color . ';"' : '') . '>' . do_shortcode($content) . '</span>';
		if($value!=""  )
			$output .= '<div class="value"' . ($value_color!='' ? ' style="color: #' . $value_color . ';"' : '') . '>' . do_shortcode($value) . '</div>';
	$output .= '
	</li>';
	return $output;
	
//	$output .= '
//	<li' . ($icon!="" ? ' class="icon_' . $icon . '"' : '') . ($border_color!='' ? ' style="border-bottom: ' . ($border_color=='none' ? 'none' : '1px solid #' . $border_color . '') . ';"' : '') . '>
//		<span' . ($text_color!='' ? ' style="color: #' . $text_color . ';"' : '') . '>' . do_shortcode($content) . '</span>';
//		if($value!="")
//			$output .= '<div class="value"' . ($value_color!='' ? ' style="color: #' . $value_color . ';"' : '') . '>' . do_shortcode($value) . '</div>';
//	$output .= '
//	</li>';
//	return $output;
}
add_shortcode("item", "theme_item");
?>