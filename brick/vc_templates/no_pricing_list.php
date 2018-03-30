<?php

$args = array(
    "type"             		=> "",
	"title"             		=> "",
    "background_image"		=> "",
    "backgroundcolor"		=> "",
    "leaders_type"			=> "",
    "item_padding"			=> "0",
    "border"			    => "no",
    "border_color"			=> "",
    "border_width"			=> "1"
);

extract(shortcode_atts($args, $atts));

//init variables
$html 			    = '';
$background_style   = '';

$title = esc_attr($title);
$background_color = esc_attr($backgroundcolor);
$item_padding = esc_attr($item_padding);
$border_color = esc_attr($border_color);
$border_width = esc_attr($border_width);

$background_style .= 'style="';

if($item_padding != 0){
    $background_style .= 'padding:'.$item_padding.';';
}

if($border != 'no'){
    if($border_color != '') {
        $background_style .= 'border-color:' . $border_color . ';';
    }
    if($border_width != '') {
        if(!strstr($border_width, 'px')) {
            $border_width .= 'px';
        }
        $background_style .= 'border-width:' . $border_width . ';';
        $background_style .= 'border-style:solid;';
    }
}

if($type == "with_background_image"){

    if($background_image != ""){
        if(is_numeric($background_image)) {
            $background_image_src = wp_get_attachment_url( $background_image );
        } else {
            $background_image_src = esc_url($background_image);
        }
        $background_style .= "background-image: url(".$background_image_src.");";
    }
    if($background_color != ""){
        $background_style .= "background-color: $background_color;";
    }
}
elseif ($type == "with_leaders") {
	$type .= ' '.$leaders_type;
	if($background_color != ""){
        $background_style .= "background-color: $background_color;";
    }
}

$background_style .= '"';

$html .= '<div class="qode_pricing_list" '.$background_style.'>';
	if($title !=''){
		$html .='<div class="qode_pricing_list_title"><span>'.$title.'</span></div>'; // close div.qode_pricing_list_title
	}	
	$html .='<ul class="qode_pricing_list_holder '.$type.'">';
		$html .= do_shortcode($content);
	$html .='</ul>'; // close ul.qode_pricing_list_holder
$html .= '</div>'; // close div.qode_pricing_list

print $html;