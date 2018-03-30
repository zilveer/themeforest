<?php

$args = array(
	"background_color" => "",
	"background_image" => "",
	"item_padding" => "",
	"vertical_alignment" => "",
    "item_padding_1280_1600" => "",
    "item_padding_1024_1280" => "",
    "item_padding_768_1024" => "",
    "item_padding_600_768" => "",
    "item_padding_480_600" => "",
    "item_padding_480" => ""
);

$html = "";
$qode_elements_item_style = "";
$qode_elements_item_inner_style = "";
$background_image_src = "";


extract(shortcode_atts($args, $atts));

$background_color = esc_attr($background_color);
$item_padding = esc_attr($item_padding);


if($background_color != "" || $background_image !== '' || $vertical_alignment !== ""){
	$qode_elements_item_style .= " style='";
}

if($background_color != ""){
	$qode_elements_item_style .= "background-color:" . $background_color . ";";
}

if($background_image != ""){
	if(is_numeric($background_image)) {
		$background_image_src = wp_get_attachment_url($background_image);
	} else {
		$background_image_src = $background_image;
	}
	$qode_elements_item_style .= "background-image: url(" . $background_image_src . ");";
	$qode_elements_item_style .= "background-position: center;";
    $qode_elements_item_style .= "background-repeat: no-repeat;";
    $qode_elements_item_style .= "background-size: cover;";

}

if($vertical_alignment != ""){
	$qode_elements_item_style .= "vertical-align:" . $vertical_alignment . ";";
}

if($background_color != "" || $background_image !== '' || $vertical_alignment !== ""){
	$qode_elements_item_style .= "'";
}

if($item_padding != ""){
	$qode_elements_item_inner_style = " style='padding:". $item_padding ."'";
}

//generate random class for custom responsive css
$rand_class = 'q_elements_holder_custom_' . mt_rand(100000,1000000);

//crate array with responsive breakpoints for custom css
$element_holder_item_responsive_style = array();

if ($item_padding_1280_1600 !== '') {
    $element_holder_item_responsive_style['item_padding_1280_1600'] = $item_padding_1280_1600;
}

if ($item_padding_1024_1280 !== '') {
    $element_holder_item_responsive_style['item_padding_1024_1280'] = $item_padding_1024_1280;
}
if ($item_padding_768_1024 !== '') {
    $element_holder_item_responsive_style['item_padding_768_1024'] = $item_padding_768_1024;
}
if ($item_padding_600_768 !== '') {
    $element_holder_item_responsive_style['item_padding_600_768'] = $item_padding_600_768;
}
if ($item_padding_480_600 !== '') {
    $element_holder_item_responsive_style['item_padding_480_600'] = $item_padding_480_600;
}
if ($item_padding_480 !== '') {
    $element_holder_item_responsive_style['item_padding_480'] = $item_padding_480;
}

$html .= "<div class='q_elements_item'";

$html .= $qode_elements_item_style . "><div class='q_elements_item_inner'>";
$html .= "<div class='q_elements_item_content ".esc_attr($rand_class)."'". wp_kses($qode_elements_item_inner_style, array('style')) .">";
if(count($element_holder_item_responsive_style) > 0){
    $html .= '<style type="text/css" data-type="q_elements_custom_padding" scoped>';
        if(!empty($element_holder_item_responsive_style['item_padding_1280_1600'])) {
            $html .= '@media only screen and (min-width: 1280px) and (max-width: 1600px) { ';
            $html .= '.q_elements_item_content.' . $rand_class . '{ ';
            $html .= 'padding: ' . esc_attr($element_holder_item_responsive_style['item_padding_1280_1600']) . ' !important;';
            $html .= '}';
            $html .= '}';
        }
        if(!empty($element_holder_item_responsive_style['item_padding_1024_1280'])) {
            $html .= '@media only screen and (min-width: 1024px) and (max-width: 1280px) { ';
            $html .= '.q_elements_item_content.' . $rand_class . '{ ';
            $html .= 'padding: ' . esc_attr($element_holder_item_responsive_style['item_padding_1024_1280']) . ' !important;';
            $html .= '}';
            $html .= '}';
        }
        if(!empty($element_holder_item_responsive_style['item_padding_768_1024'])) {
            $html .= '@media only screen and (min-width: 768px) and (max-width: 1024px) { ';
            $html .= '.q_elements_item_content.' . $rand_class . '{ ';
            $html .= 'padding: ' . esc_attr($element_holder_item_responsive_style['item_padding_768_1024']) . ' !important;';
            $html .= '}';
            $html .= '}';
        }
        if(!empty($element_holder_item_responsive_style['item_padding_600_768'])) {
            $html .= '@media only screen and (min-width: 600px) and (max-width: 768px) { ';
            $html .= '.q_elements_item_content.' . $rand_class . '{ ';
            $html .= 'padding: ' . esc_attr($element_holder_item_responsive_style['item_padding_600_768']) . ' !important;';
            $html .= '}';
            $html .= '}';
        }
        if(!empty($element_holder_item_responsive_style['item_padding_480_600'])) {
            $html .= '@media only screen and (min-width: 480px) and (max-width: 600px) { ';
            $html .= '.q_elements_item_content.' . $rand_class . '{ ';
            $html .= 'padding: ' . esc_attr($element_holder_item_responsive_style['item_padding_480_600']) . ' !important;';
            $html .= '}';
            $html .= '}';
        }
        if(!empty($element_holder_item_responsive_style['item_padding_480'])) {
            $html .= '@media only screen and (max-width: 480px) { ';
            $html .= '.q_elements_item_content.' . $rand_class . '{ ';
            $html .= 'padding: ' . esc_attr($element_holder_item_responsive_style['item_padding_480']) . ' !important;';
            $html .= '}';
            $html .= '}';
        }
    $html .= '</style>';
}
$html .= do_shortcode($content);
$html .= '</div></div></div>';
print $html;

