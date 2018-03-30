<?php

$args = array(
    "type"                          => "",
    "background_color"              => "",
    "background_transparency"       => "",
	'without_double_border'			=> "",
    "border_color"                  => "",
    "border_width"                  => "",
	"icon_pack"             		=> "",
	"fa_icon"               		=> "",
	"fe_icon"               		=> "",
	"linear_icon"              		=> "",
    "size"                          => "",
    "icon_color"                    => "",
    "image"                         => "",
    "text_in_circle"                => "",
    "text_in_circle_tag"            => "h4",
    "font_size"                     => "",
    "text_in_circle_color"          => "",
    "link"                          => "",
    "link_target"                   => "_self",
    "title"                         => "",
    "title_tag"                     => "h5",
    "title_color"                   => "",
    "text"                          => "",
    "text_color"                    => ""
);

extract(shortcode_atts($args, $atts));

$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');
                
//get correct heading value. If provided heading isn't valid get the default one
$title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];
$text_in_circle_tag = (in_array($text_in_circle_tag, $headings_array)) ? $text_in_circle_tag : $args['text_in_circle_tag'];

$html                  		= '';
$image_src             		= '';
$image_alt             		= '';
$circle_style          		= '';
$circle_wrapper_style		= '';
$border_class          		= '';
$text_in_circle_style  		= '';
$icon_style            		= '';
$title_style           		= '';
$text_style            		= '';
$circle_wrapper_classes  	= $type;


if($background_color != "") {
    if($background_transparency !="") {
        $bg_color = qode_hex2rgb($background_color);
        $circle_style .= "background-color: rgba(". $bg_color[0]."," . $bg_color[1] . "," . $bg_color[2] . "," . $background_transparency . ");";
    } else {
        
        $circle_style .= "background-color: ".$background_color.";";
        
    }
}

if($border_color != "") {
    $circle_style .= " border-color: ".$border_color.";";
	$circle_wrapper_style .= " border-color: ".$border_color.";";
}
if(intval($border_width) > 5) {
	$border_class = " big_border";
}
if($border_width != "") {
    $circle_style .= "border-width: ".$border_width."px;";
	$circle_wrapper_style .= "border-width: ".$border_width."px;";
}

if($text_in_circle_color != "") {
    $text_in_circle_style .= "color: ".$text_in_circle_color.";";
}

if($font_size != "") {
    $text_in_circle_style .= " font-size: ".$font_size."px;";
}

if($icon_color != "") {
    $icon_style .= "color: ".$icon_color.";";
}

if($size != '') {
	$icon_style .= "font-size: ".$size.'px;';
}

if($title_color != "") {
    $title_style .= "color: ".$title_color.";";
}

if($text_color != "") {
    $text_style .= "color: ".$text_color.";";
}

if($without_double_border == 'yes') {
	$circle_wrapper_classes .= ' without_double_border';
}

$html .= '<li class="q_circle_outer '.esc_attr($circle_wrapper_classes).'">';

if($link != ""){
    $html .= '<a href="'.esc_url($link).'" target="'.esc_attr($link_target).'">';
}

$html .= '<span class="q_circle_inner'. esc_attr($border_class) .'" style="'.esc_attr($circle_wrapper_style).'"><span class="q_circle_inner2" style="'.esc_attr($circle_style).'">';

if($type == "image_type"){

    if (is_numeric($image)) {
        $image_src = wp_get_attachment_url($image);
        $image_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
    }

    if($image_src != ""){
        $html .= '<img class="q_image_in_circle" src="'.esc_url($image_src).'" alt="'.esc_attr($image_alt).'" />';
    }

} else if ($type == "icon_type"){
	if($icon_pack == "font_awesome" && $fa_icon != ""){
		$html .= '<i class="process_icon fa '.esc_attr($fa_icon).'" style="'.esc_attr($icon_style).'"></i>';
	}
	elseif($icon_pack == "font_elegant" && $fe_icon != ""){
		$html .= '<span class="process_icon q_font_elegant_icon '.esc_attr($fe_icon).'" style="'.esc_attr($icon_style).'" ></span>';
	}
    elseif($icon_pack == "linear_icons" && $linear_icon != ""){
        $html .= '<i class="process_icon lnr '.esc_attr($linear_icon).'" style="'.esc_attr($icon_style).'" ></i>';
    }
} else if ($type == "text_type"){
    $html .= '<'.esc_attr($text_in_circle_tag).' class="q_text_in_circle" style="'.esc_attr($text_in_circle_style).'">'.esc_html($text_in_circle).'</'.esc_attr($text_in_circle_tag).'>';
}

$html .= '</span></span>';

if($link != ""){
    $html .= '</a>';
}

if($title != "" || $text != ""){
    $html .= '<div class="q_circle_text_holder">';

    if($title != ""){
        $html .= '<'.esc_attr($title_tag).' class="q_circle_title" style="'.esc_attr($title_style).'">'.esc_html($title).'</'.esc_attr($title_tag).'>';
    }

    if($text != ""){
        $html .= '<p class="q_circle_text" style="'.esc_attr($text_style).'">'.esc_html($text).'</p>';
    }

    $html .= '</div>';
}

$html .= '</li>';

print $html;