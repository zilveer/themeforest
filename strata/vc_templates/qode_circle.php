<?php

$args = array(
    "type"                  => "",
    "background_color"      => "",
    "border_color"          => "",
    "icon"                  => "",
    "size"                  => "fa-3x",
    "icon_color"            => "",
    "image"                 => "",
    "text_in_circle"        => "",
    "text_in_circle_tag"    => "h3",
    "font_size"             => "",
    "text_in_circle_color"  => "",
    "link"                  => "",
    "link_target"           => "_self",
    "title"                 => "",
    "title_tag"             => "h3",
    "title_color"           => "",
    "text"                  => "",
    "text_color"            => ""
);

extract(shortcode_atts($args, $atts));

$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');
                
//get correct heading value. If provided heading isn't valid get the default one
$title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];
$text_in_circle_tag = (in_array($text_in_circle_tag, $headings_array)) ? $text_in_circle_tag : $args['text_in_circle_tag'];

$html                  = '';
$image_src             = '';
$image_alt             = '';
$circle_style          = '';
$text_in_circle_style  = '';
$icon_style            = '';
$title_style           = '';
$text_style            = '';

if($background_color != "") {
    $circle_style .= "background-color: ".$background_color.";";
}

if($border_color != "") {
    $circle_style .= " border-color: ".$border_color;
}

if($text_in_circle_color != "") {
    $text_in_circle_style .= "color: ".$text_in_circle_color.";";
}

if($font_size != "") {
    $text_in_circle_style .= " font-size: ".$font_size."px;";
}

if($icon_color != "") {
    $icon_style .= "color: ".$icon_color;
}

if($title_color != "") {
    $title_style .= "color: ".$title_color;
}

if($text_color != "") {
    $text_style .= "color: ".$text_color;
}

$html .= '<li class="q_circle_outer">';

if($link != ""){
    $html .= '<a href="'.$link.'" target="'.$link_target.'">';
}

$html .= '<span class="q_circle_inner"><span class="q_circle_inner2" style="'.$circle_style.'">';

if($type == "image_type"){

    if (is_numeric($image)) {
        $image_src = wp_get_attachment_url($image);
        $image_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
    }

    if($image_src != ""){
        $html .= '<img class="q_image_in_circle" src="'.$image_src.'" alt="'.$image_alt.'" />';
    }

} else if ($type == "icon_type"){
    $html .= '<i class="fa '.$icon.' '.$size.'" style="'.$icon_style.'"></i>';
} else if ($type == "text_type"){
    $html .= '<'.$text_in_circle_tag.' class="q_text_in_circle" style="'.$text_in_circle_style.'">'.$text_in_circle.'</'.$text_in_circle_tag.'>';
}

$html .= '</span></span>';

if($link != ""){
    $html .= '</a>';
}

if($title != "" || $text != ""){
    $html .= '<div class="q_circle_text_holder">';

    if($title != ""){
        $html .= '<'.$title_tag.' class="q_circle_title" style="'.$title_style.'">'.$title.'</'.$title_tag.'>';
    }

    if($text != ""){
        $html .= '<p class="q_circle_text" style="'.$text_style.'">'.$text.'</p>';
    }

    $html .= '</div>';
}

$html .= '</li>';

echo $html;