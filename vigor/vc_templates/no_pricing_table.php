<?php

$args = array(
    "type"                         => "price_on_top",
    "title"         			   => "",
    "title_color"                  => "",
    "title_background_color"       => "",
    "price"         			   => "100",
    "price_font_weight"       	   => "",
    "price_background"  	       => "",
    "currency"      			   => "$",
    "price_period"  			   => "Monthly",
	"price_period_position"  	   => "",	
    "link"          			   => "",
    "target"        		       => "_self",
    "button_text"   			   => "",
    "button_size"   			   => "",
    "button_color"                 => "",
    "button_background_color"      => "",
	"button_holder_background_color" => "",
	"button_border_color"			=> "",
	"content_background_color"	   => "",
	"content_background_image"	   => "",
    "active"        			   => "",
	"active_style"        		   => "",
    "active_text"   			   => "Best choice",
    "active_text_color"            => "",
    "active_text_background_color" => "",
	"content_text_color"		   => "",
	"content_section_full_width"   => "",	
	"title_separator"			   => "",
	"title_separator_color"		   => "",
    "title_border_bottom"          => "yes", 
    "title_border_bottom_color"    => "",
    "table_border_top"             => "yes", 
    "pricing_table_border_top_color" => "",
    "button_arrow"                   => "no",
	"disable_button_border_top"		 => "",
    "border_arround"                 => "no",
    "border_arround_color"           => "",
	"even_section_background_color"  => "",
	"odd_section_background_color"  => "",
    "odd_section_border_color"      => "",
    "even_section_border_color"      => "",	
);

extract(shortcode_atts($args, $atts));

$html						= "";
$pricing_table_clasess		= '';
$pricing_table_background 	= '';
$pricing_table_background_image	='';
$price_style_array			= array();
$price_style				= array();
$title_style                = "";
$title_top_type_title_style          = array();
$pricing_table_border_top_style      = array();
$active_holder_style_array  = array();
$active_holder_style        = "";
$active_text_style_array    = array();
$active_text_style          = "";
$title_holder_style         = "";
$button_style               = array();
$button_class               = "";
$button_holder_style        = "";
$content_text_style			= "";
$title_separator_style		= "";
$title_clasess				= "";
$active_text_position       = "";
$border_arround_style       = array();
$price_background_style     = '';

$title = esc_html($title);
$title_color = esc_attr($title_color);
$title_background_color = esc_attr($title_background_color);
$price = esc_attr($price);
$price_background = esc_attr($price_background);
$currency = esc_attr($currency);
$price_period = esc_attr($price_period);
$price_period_position = esc_attr($price_period_position);
$link = esc_url($link);
$button_text = esc_html($button_text);
$button_color = esc_attr($button_color);
$disable_button_border_top = esc_attr($disable_button_border_top);
$button_background_color = esc_attr($button_background_color);
$button_holder_background_color = esc_attr($button_holder_background_color);
$button_border_color = esc_attr($button_border_color);
$content_section_full_width = esc_attr($content_section_full_width);
$content_background_color = esc_attr($content_background_color);
$active_style = esc_html($active_style);
$active_text = esc_html($active_text);
$active_text_color = esc_attr($active_text_color);
$active_text_background_color = esc_attr($active_text_background_color);
$content_text_color = esc_attr($content_text_color);
$title_separator_color = esc_attr($title_separator_color);
$title_border_bottom_color = esc_attr($title_border_bottom_color);
$pricing_table_border_top_color = esc_attr($pricing_table_border_top_color);
$even_section_background_color = esc_attr($even_section_background_color);
$odd_section_background_color = esc_attr($odd_section_background_color);
$even_section_border_color = esc_attr($even_section_border_color);
$odd_section_border_color = esc_attr($odd_section_border_color);

if($target == ""){
    $target = "_self";
}

if($type == "price_on_top") {
    $pricing_table_clasess .= ' price_on_top';
}

if($type == "title_on_top") {
    $pricing_table_clasess .= ' title_on_top';

    if($title_border_bottom == "no"){
        $pricing_table_clasess .= ' title_top_padding_and_border';
    }
	if($content_section_full_width=="yes"){
		 $pricing_table_clasess .= ' content_full_width';
	}

	$data_attr = '';

	if($even_section_background_color != ""){
        $data_attr .= "data-even-background-color='" . $even_section_background_color . "'";
	}
	if($odd_section_background_color != ""){
        $data_attr .= "data-odd-background-color='" . $odd_section_background_color . "'";
	}	
    if($even_section_border_color != ""){
        $data_attr .= "data-even-border-color='" . $even_section_border_color . "'";
    }
    if($odd_section_border_color != ""){
        $data_attr .= "data-odd-border-color='" . $odd_section_border_color . "'";
    }   
}

if($type == "price_on_top"){
	if($price_period_position == "next_to_title"){
	$pricing_table_clasess .= '  price_period_next_to_title';
	}
	elseif($price_period_position == "bellow_title"){
		$pricing_table_clasess .= '  price_period_bellow_title';
	}
}

if($active == "yes") {
    $pricing_table_clasess .= ' active';
}

if($type == "price_on_top"){

	if($active_style == "circle" && $active == "yes"){
		$pricing_table_clasess .= ' active_circle';
	}
	elseif($active_style == "rectangle" && $active == "yes"){
		$pricing_table_clasess .= ' active_rectangle';
	}
}

if($title_separator == "yes") {
    $title_clasess .= ' active_small_separator';
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


if($price_background !== "") {
    $price_background_style .=  'style="background-color: '.$price_background.';"';
}

if($price_font_weight !== '') {
	$price_style_array[] = 'font-weight: '.$price_font_weight;
}

if(is_array($price_style_array) && count($price_style_array)) {
	$price_style = 'style="'.implode(';', $price_style_array).'"';
} else {
	$price_style = '';
}


if ( $button_size == "normal") {
    $button_class .= "normal";
}

if($content_background_color != "" && $type == "price_on_top"){
	$pricing_table_background .= "background-color: ".$content_background_color.";";
}

if($content_background_image != ""){
	if(is_numeric($content_background_image)) {
		$background_image_src = wp_get_attachment_url( $content_background_image );
	} else {
		$background_image_src = esc_url($content_background_image);
	}
	$pricing_table_background_image .= "background-image: url(".$background_image_src.");";
}

if($title_color != '') {
    $title_style = "color: '.$title_color.';";
    $title_top_type_title_style[] = "color:" .$title_color. ";";
}


if($title_separator_color != '') {
    $title_separator_style = 'style="background-color: '.$title_separator_color.';"';
}

if($title_background_color != '') {
    $title_holder_style = 'style="background-color: '.$title_background_color.';"';
}

if($title_border_bottom_color != '') {
    $title_top_type_title_style[] = "border-bottom-color:".$title_border_bottom_color.";";
}


if(is_array($title_top_type_title_style) && count($title_top_type_title_style)) {
    $title_top_type_title_style = 'style="'.implode(';', $title_top_type_title_style).'"';
} else {
    $title_top_type_title_style = '';
}

if($button_color != '') {
    $button_style[] = 'color: '.$button_color.';';
}

if($button_background_color != '') {
    $button_style[] = 'background-color: '.$button_background_color.';';    
}

if($button_border_color != '') {
    $button_style[] = 'border-color: '.$button_border_color.';';    
}

if(is_array($button_style) && count($button_style)) {
    $button_styles = 'style="'.implode(';', $button_style).'"';
} else {
    $button_styles = '';
}

if($button_holder_background_color != '') {
    $button_holder_style = 'background-color: '.$button_holder_background_color.';';    
}


if($content_text_color != '') {
    $content_text_style = "color: ".$content_text_color.";";
}

if($table_border_top == "no"){ 
    $pricing_table_border_top_style[] = "border-top:0;";
    $active_text_position = "style = top:-38px;";
}

if($table_border_top == "no" && $border_arround=="yes"){ 
    $pricing_table_border_top_style[] = "border-top:0;";
    $active_text_position = "style = top:-39px;";
}

if($pricing_table_border_top_color != ''){
    $pricing_table_border_top_style[] = "border-top-color: ".$pricing_table_border_top_color.";";
}

if(is_array($pricing_table_border_top_style) && count($pricing_table_border_top_style)) {
    $pricing_table_border_top_style = 'style="'.implode(';', $pricing_table_border_top_style).'"';
} else {
    $pricing_table_border_top_style = '';
}

if($border_arround == "yes"){
    $border_arround_style[] = "border: 1px solid #fff;";
}

if(($border_arround == "yes") && ($border_arround_color != "")){
    $border_arround_style[] = "border-color: ".$border_arround_color." ;";
}

if(($border_arround == "yes") && ($table_border_top == "yes")){
    $border_arround_style[] = "border-top: 0;";
}

if(is_array($border_arround_style) && count($border_arround_style)) {
    $border_arround_style = 'style="'.implode(';', $border_arround_style).'"';
} else {
    $border_arround_style = '';
}

$disable_button_border_top_class = '';
if($type == "title_on_top" && $disable_button_border_top == "yes"){
    $disable_button_border_top_class .= " disable_button_border_top";
}


if($type=="title_on_top"){
    $html .= "<div class='edgt_price_table ".$pricing_table_clasess."' ".$pricing_table_border_top_style.">";
}

if($type=="price_on_top"){
    $html .= "<div class='edgt_price_table ".$pricing_table_clasess."'>";
}

$html .= "<div class='price_table_inner' ".$border_arround_style.">";

if($active == 'yes') {
	if($type == "price_on_top"){
		 $html .= "<div class='active_text' ".$active_holder_style."><span class='active_text_inner'><span ".$active_text_style.">".$active_text."</span></span></div>";
	}
	if($type == "title_on_top"){
		$html .= "<div class='active_text' ".$active_text_position."><span class='active_text_inner' ".$active_holder_style."><span ".$active_text_style.">".$active_text."</span></span></div>";
	}   
}

$html .= "<ul style='".$pricing_table_background_image."' >";

if($type=="price_on_top" ){
    $html .= "<li class='prices' $price_background_style>";
    $html .= "<div class='price_in_table'>";
    $html .= "<sup class='value'>".$currency."</sup>";
    $html .= "<span class='price' ".$price_style.">".$price."</span>";
    $html .= "<span class='mark'>/ ".$price_period."</span>";

    $html .= "</div>"; // close div.price_in_table
    $html .= "</li>"; //close li.prices
    $html .= "<li class='cell table_title ".$title_clasess."' ".$title_holder_style."><span class='title_content' ".$title_style.">".$title."</span>";
    
    if($title_separator == "yes"){
        $html .="<div class='title_separator'  ".$title_separator_style."></div>";
    }
    $html .= "</li>";
}

if($type=="title_on_top"){	
    $html .= "<li class='cell table_title ".$title_clasess."' ".$title_holder_style.">";
    $html .= "<span class='title_content' ".$title_top_type_title_style.">".$title."</span>";
    $html .= "</li>";    

    $html .= "<li class='prices' $price_background_style>";
    $html .= "<div class='price_in_table'>";
    $html .= "<sup class='value'>".$currency."</sup>";
    $html .= "<span class='price' ".$price_style.">".$price."</span>";
    $html .= "<span class='mark'>/ ".$price_period."</span>";
    $html .= "</div>"; // close div.price_in_table
    $html .= "</li>"; //close li.prices	
}
if($type == "price_on_top"){
	$html .= "<li class='pricing_table_content'  style='".$content_text_style." ".$pricing_table_background."'>";
}
if($type == "title_on_top"){
	$html .= "<li class='pricing_table_content' " . $data_attr. "  style='".$content_text_style."'>";
}

$html .= edgt_remove_wpautop($content, true); //append pricing table content
$html .= "</li>";

if(isset($button_text) && $button_text !== '') {
	$html .="<li class='price_button $button_class' ".edgt_get_inline_style($button_holder_style)." >";
    if($type=="title_on_top"){
        $html .= "<div class='title_on_top_button_wrapper $disable_button_border_top_class'>";
        $html .= "<a ".edgt_get_inline_style($button_style)." href='$link' target='$target'>".$button_text."";
        if($button_arrow == "yes"){
            $html .= "<span class='arrow_right'></span>";
        }        
        $html .= "</a>";
        $html .= "</div>";
    }

    if($type=="price_on_top"){
        $html .= "<a ".edgt_get_inline_style($button_style)." href='$link' target='$target'>".$button_text."";
        if($button_arrow == "yes"){
            $html .= "<span class='arrow_right'></span>";
        }
        $html .= "</a>";
    }
	
	$html .= "</li>"; //close li.price_button
}

$html .= "</ul>";
$html .= "</div>"; //close div.price_table_inner
$html .="</div>"; //close div.edgt_price_table

print $html;