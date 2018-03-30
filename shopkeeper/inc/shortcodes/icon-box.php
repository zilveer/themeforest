<?php

// [icon_box]
function icon_box_shortcode($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'icon' => '',
		'icon_position' => 'top',
		'icon_style' => 'normal',
		'icon_color' => '#000',
		'icon_bg_color' => '#ffffff',
		'title' => '',
		'separator' => 'with_separator',
		'link_name' => '',
		'link_url' => ''
	), $params));
	
	if (is_numeric($icon)) {
		$icon = wp_get_attachment_url($icon);
	}
	
	/*switch ($icon_style) {
		case "normal":
			break;
		case "outlined":
			break;
		case "bg_color":
			break;
	}*/
	
	$title_markup = "";
	$content_markup = "";
	$button_markup = "";
	
	if ($title != "") $title_markup = '<h3 class="icon_box_title">' . $title . '</h3>';
	if ($content != "") $content_markup = '<div class="icon_box_content"><p>' . do_shortcode($content) . '</p></div>';
	if ($link_name != "") $button_markup = '<a class="icon_box_read_more" href="' . $link_url . '">' . $link_name . '</a>';
	
	$icon_box_markup = '		
		<div class="shortcode_icon_box icon_position_'.$icon_position.' icon_style_'.$icon_style.' '.$separator.'">
			<div class="icon_wrapper" style="background-color:'.$icon_bg_color.'; border-color:'.$icon_color.'">
				<div class="icon '.$icon.'" style="color:'.$icon_color.'"></div>
			</div>'
			.$title_markup
			.$content_markup
			.$button_markup.
		'</div>
	';
	return $icon_box_markup;
}

add_shortcode('icon_box', 'icon_box_shortcode');