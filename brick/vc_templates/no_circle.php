<?php

global $qodeIconCollections;

$args = array(
    "type"                          => "",
    "background_image"              => "",
    "background_color"              => "",
    "background_transparency"       => "",
	'without_double_border'			=> "",
    "border_color"                  => "",
    "border_width"                  => "",
//	"icon_pack"             		=> "",
//	"fa_icon"               		=> "",
//	"fe_icon"               		=> "",
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
    "title_tag"                     => "h4",
    "title_color"                   => "",
    "title_alignment"               => "",
    "text_alignment"                => "",
    "text"                          => "",
    "text_color"                    => "",
    "title_margin_top"              => "",
    "text_margin_top"               => ""

);

$args = array_merge($args, $qodeIconCollections->getShortcodeParams());

extract(shortcode_atts($args, $atts));

$background_color = esc_attr($background_color);
$background_transparency = esc_attr($background_transparency);
$border_color = esc_attr($border_color);
$border_width = esc_attr($border_width);
$size = esc_attr($size);
$icon_color = esc_attr($icon_color);
$text_in_circle = esc_html($text_in_circle);
$font_size = esc_attr($font_size);
$text_in_circle_color = esc_attr($text_in_circle_color);
$link = esc_url($link);
$title = esc_html($title);
$title_color = esc_attr($title_color);
$text = esc_html($text);
$text_color = esc_attr($text_color);
$title_margin_top = esc_attr($title_margin_top);
$text_margin_top = esc_attr($text_margin_top);


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
$image_with_text_style  = '';
$image_with_text_class  = '';
$circle_text_holder_style  = '';


if($background_image != "") {
    if (is_numeric($background_image)) {
        $background_image_src = wp_get_attachment_url($background_image);
    } else {
        $background_image_src = $background_image;
    }
    $circle_style .= "background-image: url('". esc_url($background_image_src) . "');";
    $circle_style .= "background-position: center center;";
}

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
    $title_style .= "color: ".$title_color;
}

if($text_color != "") {
    $text_style .= "color: ".$text_color.";";
}

if($title_margin_top != "") {
    $title_margin_top = (strstr($title_margin_top, 'px', true)) ? $title_margin_top : $title_margin_top . "px";
    $circle_text_holder_style .= "style='margin-top: ".$title_margin_top.";'";
}

if($text_margin_top != "") {
    $text_margin_top = (strstr($text_margin_top, 'px', true)) ? $text_margin_top : $text_margin_top . "px";
    $text_style .= "margin-top: ".$text_margin_top.";";
}

if($without_double_border == 'yes') {
	$circle_wrapper_classes .= ' without_double_border';
}

$html .= '<li class="q_circle_outer '.$circle_wrapper_classes.'">';

if($link != ""){
    $html .= '<a href="'.$link.'" target="'.$link_target.'">';
}
if ($type == "image_with_text_type"){
    if (is_numeric($image)) {
        $image_src = wp_get_attachment_url($image);
        $image_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
    }
    if($image_src != ""){
        $image_with_text_style .= 'background: url('.$image_src.')';
        $image_with_text_class .= 'image_with_text';
    }
}
$html .= '<span class="q_circle_inner'. $border_class.' " style="'.$circle_wrapper_style.'"><span class="q_circle_inner2 '.$image_with_text_class.'" style="'.$circle_style.' '.$image_with_text_style.'">';

if($type == "image_type"){

    if (is_numeric($image)) {
        $image_src = wp_get_attachment_url($image);
        $image_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
    }

    if($image_src != ""){
        $html .= '<img class="q_image_in_circle" src="'.$image_src.'" alt="'.$image_alt.'" />';
    }

} else if ($type == "icon_type"){
    
    $icon_collection_obj = $qodeIconCollections->getIconCollection($icon_pack);
    
    if (method_exists($icon_collection_obj, 'render')) {
        
        $html .= $icon_collection_obj->render(${$icon_collection_obj->param}, array(
            'icon_attributes' => array(
                'style' => $icon_style,
                'class' => 'process_icon '
            )
        ));
        
    }
    
    
//	if($icon_pack == "font_awesome" && $fa_icon != ""){
//		$html .= '<i class="process_icon fa '.$fa_icon.'" style="'.$icon_style.'"></i>';
//	}
//	elseif($icon_pack == "font_elegant" && $fe_icon != ""){
//		$html .= '<span class="process_icon q_font_elegant_icon '.$fe_icon.'" style="'.$icon_style.'" ></span>';
//	}
} else if ($type == "text_type"){
    $html .= '<'.$text_in_circle_tag.' class="q_text_in_circle" style="'.$text_in_circle_style.'">'.$text_in_circle.'</'.$text_in_circle_tag.'>';
}
else if ($type == "image_with_text_type"){
    $html .= '<'.$text_in_circle_tag.' class="q_text_in_circle" style="'.$text_in_circle_style.'">'.$text_in_circle.'</'.$text_in_circle_tag.'>';
}

$html .= '</span></span>';

if($link != ""){
    $html .= '</a>';
}

if($title != "" || $text != ""){
    $html .= '<div class="q_circle_text_holder  '.$title_alignment.' '.$text_alignment.' " '.$circle_text_holder_style.'>';

    if($title != ""){
        $html .= '<'.$title_tag.' class="q_circle_title" style="'.$title_style.'">'.$title.'</'.$title_tag.'>';
    }

    if($text != ""){
        $html .= '<p class="q_circle_text" style="'.$text_style.'">'.$text.'</p>';
    }

    $html .= '</div>';
}

$html .= '</li>';

print $html;