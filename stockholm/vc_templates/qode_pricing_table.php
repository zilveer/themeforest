<?php

$args = array(
    "title"         			   => "",
    "title_color"                  => "",
    "title_background_color"       => "",
    "price"         			   => "100",
    "price_font_weight"       	   => "",
    "currency"      			   => "$",
    "price_period"  			   => "monthly",
    "link"          			   => "",
    "target"        		       => "_self",
    "button_text"   			   => "",
    "button_color"                 => "",
    "button_background_color"      => "",
	"content_background_color"	   => "",
    "active"        			   => "",
    "active_text"   			   => "Best choice",
    "active_text_color"            => "",
    "active_text_background_color" => "",
);

extract(shortcode_atts($args, $atts));

$html						= "";
$pricing_table_clasess		= '';
$pricing_table_background 	= '';
$price_style_array			= array();
$price_style				= array();
$title_style                = "";
$active_holder_style_array  = array();
$active_holder_style        = "";
$active_text_style_array    = array();
$active_text_style          = "";
$title_holder_style         = "";
$button_style               = "";
$button_holder_style        = "";

if($target == ""){
    $target = "_self";
}

if($active == "yes") {
    $pricing_table_clasess .= ' active';
}

if($active_text_color !== '') {
    $active_text_style_array[] = 'color: '.$active_text_color;
}

if(is_array($active_text_style_array) && count($active_text_style_array)) {
    $active_text_style = 'style="'.implode(';', $active_text_style_array).'"';
} else {
    $active_text_style = '';
}

if($active_text_background_color !== '') {
    $active_holder_style_array[] = 'background-color: '.$active_text_background_color;
}

if(is_array($active_holder_style_array) && count($active_holder_style_array)) {
    $active_holder_style = 'style="'.implode(';', $active_holder_style_array).'"';
} else {
    $active_holder_style = '';
}

if($price_font_weight !== '') {
	$price_style_array[] = 'font-weight: '.$price_font_weight;
}

if(is_array($price_style_array) && count($price_style_array)) {
	$price_style = 'style="'.implode(';', $price_style_array).'"';
} else {
	$price_style = '';
}

if($content_background_color != ""){
	$pricing_table_background .= "background-color: ".$content_background_color.";";
}

if($title_color != '') {
    $title_style = 'style="color: '.$title_color.';"';
}

if($title_background_color != '') {
    $title_holder_style = 'style="background-color: '.$title_background_color.';"';
}

if($button_color != '') {
    $button_style = 'style="color: '.$button_color.';"';
}

if($button_background_color != '') {
    $button_holder_style = 'style="background-color: '.$button_background_color.';"';
}

$html .= "<div class='q_price_table ".esc_attr($pricing_table_clasess)."'>";
$html .= "<div class='price_table_inner'>";

if($active == 'yes') {
    $html .= "<div class='active_text' ".wp_kses($active_holder_style, array('style'))."><span class='active_text_inner'><span ".wp_kses($active_text_style, array('style')).">".esc_html($active_text)."</span></span></div>";
}

$html .= "<ul>";
$html .= "<li class='cell table_title' ".wp_kses($title_holder_style, array('style'))."><span class='title_content' ".wp_kses($title_style, array('style')).">".esc_html($title)."</span>";

$html .= "<li class='prices' style='".esc_attr($pricing_table_background)."'>";
$html .= "<div class='price_in_table'>";
$html .= "<sup class='value'>".esc_html($currency)."</sup>";
$html .= "<span class='price' ".wp_kses($price_style, array('style')).">".esc_html($price)."</span>";
$html .= "<span class='mark'>".esc_html($price_period)."</span>";

$html .= "</div>"; // close div.price_in_table
$html .= "</li>"; //close li.prices

$html .= "<li class='pricing_table_content' style='".esc_attr($pricing_table_background)."'>";
$html .= do_shortcode($content); //append pricing table content
$html .= "</li>";

if(isset($button_text) && $button_text !== '') {
	$html .="<li class='price_button' ".$button_holder_style.">";
	$html .= "<a ".wp_kses($button_style, array('style'))." href='".esc_url($link)."' target='".esc_attr($target)."'>".esc_html($button_text)."</a>";
	$html .= "</li>"; //close li.price_button
}

$html .= "</ul>";
$html .= "</div>"; //close div.price_table_inner
$html .="</div>"; //close div.q_price_table

print $html;