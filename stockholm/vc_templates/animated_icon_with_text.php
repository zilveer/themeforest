<?php
$args = array(
    "title"							=> "",
	"title_tag"						=> "h5",
    "text"							=> "",
	"icon_pack"						=> "",
    "fa_icon"						=> "",
    "fe_icon"						=> "",
    "linear_icon"					=> "",
    "size"							=> "",
    "icon_color"					=> "",
    "icon_background_color"			=> "",
    "border_color"					=> "",
    "icon_color_hover"				=> "",
    "icon_background_color_hover"	=> "",
    "border_color_hover"			=> ""
);

extract(shortcode_atts($args, $atts));

$style 				= "";
$style_hover 		= "";
$html 				= "";
$icon_html 			= "";
$icon_hover_html 	= "";

$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

//get correct heading value. If provided heading isn't valid get the default one
$title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];

if($icon_color != "" || $icon_background_color != "" || $border_color != "" || $size != ""){
	$style = ' style="';
	if($icon_color != "") {
		$style .='color:'.$icon_color.';';
	}
	if($icon_background_color != "") {
		$style .= "background-color: {$icon_background_color};";
	}
	if($border_color != "") {
		$style .='border-color:'.$border_color.';';
	}
	if($size != ""){
		$style .= 'font-size:'.$size.'px;';
	}
	$style .= '";';
}

if($icon_color_hover != "" || $icon_background_color_hover != "" || $border_color_hover != "" || $size != ""){

	$style_hover .= ' style="';
	if($icon_color_hover != "") {
		$style_hover .='color:'.$icon_color_hover.';';
	}
	if($icon_background_color_hover != "") {
		$style_hover .= "background-color: {$icon_background_color_hover};";
	}
	if($border_color_hover != "") {
		$style_hover .='border-color:'.$border_color_hover.';';
	}
	if($size != ""){
		$style_hover .= 'font-size:'.$size.'px;';
	}
	$style_hover .= '";';
}

if($icon_pack == 'font_awesome' && $fa_icon !== '') {
	$icon_html .= "<i class='animated_icon  fa ".$fa_icon."'" . $style . "></i>";
	$icon_hover_html .= "<i class='animated_icon fa ".$fa_icon."'" . $style_hover . "></i>";
} elseif($icon_pack == 'font_elegant' && $fe_icon !== '') {
	$icon_html .= "<span class='animated_icon " . $fe_icon."'" . $style ."></span>";
	$icon_hover_html .= "<span class='animated_icon " . $fe_icon."'" . $style_hover ."></span>";
} elseif($icon_pack == 'linear_icons' && $linear_icon !== '') {
	$icon_html .= "<i class='animated_icon lnr " . $linear_icon."'" . $style ."></i>";
	$icon_hover_html .= "<i class='animated_icon lnr " . $linear_icon."'" . $style_hover ."></i>";
}

    $html .= '<div class="animated_icon_with_text_holder">';
    $html .= '<div class="animated_icon_with_text_inner">';
		$html .= '<div class="animated_icon_holder">';
		$html .= '<div class="animated_icon">';
			$html .= '<div class="animated_icon_inner">';
				$html .= '<span class="animated_icon_front">';
					$html .= $icon_html;
				$html .= '</span>';
				$html .= '<span class="animated_icon_back">';
					$html .= $icon_hover_html;
				$html .= '</span>';
		
			$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '<div class="animated_text_holder">';
		$html .= '<div class="animated_text_holder_wrap">';
		$html .= '<div class="animated_text_holder_wrap_inner">';
		$html .= '<div class="animated_text_holder_inner">';
			$html .= '<div class="animated_title">';
				$html .= '<div class="animated_title_inner">';
					$html .= '<'.esc_attr($title_tag).'>';
						$html .= esc_html($title);
					$html .= '</'.esc_attr($title_tag).'>';
				$html .= '</div>';
			$html .= '</div>';
			$html .= '<div class="animated_text">';
				$html .= '<p><span>';
					$html .= esc_html($text);
				$html .= '</span></p>';
			$html .= '</div>';
		
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';

print $html;