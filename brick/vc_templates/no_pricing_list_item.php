<?php

$args = array(
    "backgroundcolor"			        => "",
    "title"             		        => "",
	"title_color"	    		        => "",
	"title_font_size"   		        => "",
	"title_tag"		    		        => "h5",
    "title_font_family"   		        => "",
    "title_font_weight"   		        => "700",
    "text"			    		        => "",
	"text_color"	    		        => "",
	"text_font_size"    		        => "",
	"price"             		        => "0",
	"price_color"	    		        => "",
    "price_font_family"     	        => "",
	"price_font_size"   		        => "",
    "price_font_weight"	  		        => "",
    "price_font_style"	  		        => "",
    "separator"		        	        => "",
    "separator_color"			        => "",
    "separator_type"			        => "",
    "separator_width"			        => "",
    "separator_position_top"	        => "",
    "separator_position_bottom"	        => "",
    "enable_new_item"                   => "",
    "new_item_text_color"               => "",
    "new_item_icon_color"               => "",
    "enable_highlighted_item"           => "",
    "highlighted_text"                  => "",
    "highlighted_text_color"            => "",
    "highlighted_text_background_color" => "",
    "margin_bottom_item"    	        => ""


);

extract(shortcode_atts($args, $atts));

$background_color = esc_attr($backgroundcolor);
$title = esc_html($title);
$title_color = esc_attr($title_color);
$title_font_size = esc_attr($title_font_size);
$title_font_family = esc_attr($title_font_family);
$text = esc_html($text);
$text_color = esc_attr($text_color);
$text_font_size = esc_attr($text_font_size);
$price = esc_html($price);
$price_color = esc_attr($price_color);
$price_font_family = esc_attr($price_font_family);
$price_font_size = esc_attr($price_font_size);
$separator_color = esc_attr($separator_color);
$separator_width = esc_attr($separator_width);
$separator_position_top = esc_attr($separator_position_top);
$separator_position_bottom = esc_attr($separator_position_bottom);
$highlighted_text = esc_html($highlighted_text);
$highlighted_text_color = esc_attr($highlighted_text_color);
$highlighted_text_background_color = esc_attr($highlighted_text_background_color);
$new_item_text_color = esc_attr($new_item_text_color);
$new_item_icon_color = esc_attr($new_item_icon_color);
$margin_bottom_item = esc_attr($margin_bottom_item);


$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

//get correct heading value. If provided heading isn't valid get the default one
$title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];

//init variables
$html 			         = '';
$title_styles 	         = '';
$text_styles 	         = '';
$price_styles 	         = '';
$separator_styles  	     = '';
$separator_bottom_styles = '';
$background_styles       = '';
$marked_class            = '';
$new_item_html           = '';
$highlighted_text_style  = '';
$highlighted_item_style  = '';
$highlighted_text_html   = '';
$new_item_text_style     = '';
$new_item_icon_style     = '';
$list_item_style         = '';


//generate title styles
if($background_color !== '') {
    $background_styles .= 'background-color: '.$background_color.';';
}
if($title_color !== '') {
	$title_styles .= 'color: '.$title_color.';';
}

if($title_font_size !== '') {
	$title_styles .= 'font-size: '.$title_font_size.'px;';
}

if($title_font_family !== '') {
    $title_styles .= 'font-family: '.$title_font_family.';';
}

if($title_font_weight !== '') {
    $title_styles .= 'font-weight: '.$title_font_weight.';';
}

//generate text styles
if($text_color !== '') {
	$text_styles .= 'color: '.$text_color.';';
}

if($text_font_size !== '') {
	$text_styles .= 'font-size: '.$text_font_size.'px;';
}

//generate price styles
if($price_color !== '') {
	$price_styles .= 'color: '.$price_color.';';
}

if($price_font_size !== '') {
	$price_styles .= 'font-size: '.$price_font_size.'px;';
}

if($price_font_family !== '') {
    $price_styles .= 'font-family: '.$price_font_family.';';
}
if($price_font_style !== '') {
    $price_styles .= 'font-style: '.$price_font_style.';';
}
if($price_font_weight !== '') {
    $price_styles .= 'font-weight: '.$price_font_weight.';';
}

//generate separator styles
if($separator !== 'no') {
	$separator_styles .= 'style="';
    if($separator_color !== '') {
        $separator_styles .= 'border-bottom-color: ' . $separator_color . ';';
    }
    if($separator_type !== '') {
        $separator_styles .= 'border-bottom-style: ' . $separator_type . ';';
    }
    if($separator_width !== '') {
        if(!strstr($separator_width, 'px')) {
            $separator_width .= 'px';
        }
        $separator_styles .= 'border-bottom-width: ' . $separator_width . ';';
    }
    if($separator_position_top !== '') {
    	if(!strstr($separator_position_top, 'px')) {
            $separator_position_top .= 'px';
        }
        $separator_styles .= 'padding-bottom: ' . $separator_position_top . ';';
    }
    if($separator_position_bottom !== '') {
    	if(!strstr($separator_position_bottom, 'px')) {
            $separator_position_bottom .= 'px';
        }
        $separator_bottom_styles .= 'style="';
        $separator_bottom_styles .= 'margin-bottom: ' . $separator_position_bottom . ';';
        $separator_bottom_styles .= '"';
    }

    $separator_styles .= '"';
}


if ( $highlighted_text_color !== "" ){
    $highlighted_text_style .= "color: $highlighted_text_color;";
}
if ( $highlighted_text_background_color !== "" ){
    $highlighted_text_style .= "background-color: $highlighted_text_background_color;";
    $highlighted_item_style = "style='border-color:$highlighted_text_background_color;'";
}
if ( $highlighted_text_style !== "" ){
    $highlighted_text_style = "style='$highlighted_text_style'";
}
if( $enable_highlighted_item == 'enable_highlighted_item' ) {
    $marked_class .= ' highlighted_item ';
    if ( $highlighted_text !== "" ){
        $highlighted_text_html = "<span class='highlighted_text' ".$highlighted_text_style.">$highlighted_text</span>";
    }
}
if ( $new_item_text_color !== "" ){
    $new_item_text_style .= "color: $new_item_text_color;";
}
if ( $new_item_text_style !== "" ){
    $new_item_text_style = "style='$new_item_text_style'";
}
if ( $new_item_icon_color !== "" ){
    $new_item_icon_style .= "color: $new_item_icon_color;";
}
if ( $new_item_icon_style !== "" ){
    $new_item_icon_style = "style='$new_item_icon_style'";
}
if( $enable_new_item == 'enable_new_item' ) {
    $new_item_html .= '<div class="new_item">';
    $new_item_html .= '<span '.$new_item_text_style.'>' . __('NEW', 'qode') . '</span>';
    $new_item_html .= '<i class="qode_icon_font_awesome fa fa-certificate" '.$new_item_icon_style.'></i> ';
    $new_item_html .= '</div>';
}
if ( $margin_bottom_item !== "" ){
    $list_item_style = "style= 'margin-bottom: ".$margin_bottom_item."px;'";
}

$html .= '<li class="list_item '.$marked_class.'" '.$list_item_style.'>';
$html .= $highlighted_text_html;
$html .= $new_item_html;
$html .= '<ul '.$highlighted_item_style.'>';
$html .= '<li class="qode_pricing_list_item" '.$separator_styles.'>';
$html .= '<div class="qode_pricing_item_text" style="'.$background_styles.'">';
$html .= '<'.$title_tag.' class="qode_pricing_item_title" style="'.$title_styles.'">'.$title.'</'.$title_tag.'>';
$html .= '</div>'; //close div.qode_pricing_item_text
$html .= '<div class="qode_pricing_item_price"  style="'.$background_styles.'">';
$html .= '<span style="'.$price_styles.'">'.$price.'</span>';
$html .= '</div>'; // close div.qode_pricing_item_price
$html .= '</li>'; // close li.qode_pricing_list_item

$html .= '<li class="qode_pricing_item_includes_text" '.$separator_bottom_styles.'><p style="'.$text_styles.'">'.$text.'</p></li>';
// has to be in li tag, but it is not in pricing_list_item because of ::after on li element
$html .='</ul>';
$html .='</li>';

print $html;

