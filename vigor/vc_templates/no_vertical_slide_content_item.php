<?php

$args = array(
    "background_color" => "",
    "background_image" => "",
    "item_padding" => "",
    "alignment" => "",
	"header_style" => "",
	
);

$html = "";
$edgt_splitted_item_style = "";
$edgt_splitted_item_data = "";

extract(shortcode_atts($args, $atts));

$background_color = esc_attr($background_color);
$item_padding = esc_attr($item_padding);

if($background_color != "" || $background_image != "" || $item_padding != "" || $item_padding != "") {
    $edgt_splitted_item_style .= "style='";

    if ($background_color != "") {
        $edgt_splitted_item_style .= "background-color:".$background_color.";";
    }

    if ($background_image != "") {
        $background_image_src = wp_get_attachment_url( $background_image );
        $edgt_splitted_item_style .= "background-image:url(".$background_image_src.");";
    }

    if ($alignment != "") {
        $edgt_splitted_item_style .= "text-align:".$alignment.";";
    }

    if ($item_padding != "") {
        $edgt_splitted_item_style .= "padding:0px ".$item_padding.";";
    }

    $edgt_splitted_item_style .= "'";
}


$edgt_splitted_item_data = "data-header_style='".$header_style."'"; //render empty value also, in order to remove header style if needed


$html .= "<div class='ms-section' ".$edgt_splitted_item_style." ".$edgt_splitted_item_data." >";
$html .= do_shortcode($content);
$html .= "</div>";
print $html;

