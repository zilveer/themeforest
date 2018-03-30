<?php

$args = array(
    "title"             		        => "",
	"title_tag"		    		        => "h5",
    "text"			    		        => "",
	"price"             		        => "0",
    "enable_highlighted_item"           => "",
    "highlighted_text"                  => "",
    "margin_bottom_item"    	        => ""
);

extract(shortcode_atts($args, $atts));

$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

//get correct heading value. If provided heading isn't valid get the default one
$title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];

//init variables
$html 			         = '';
$separator_bottom_styles = '';
$marked_class            = '';
$new_item_html           = '';
$highlighted_text_html   = '';
$list_item_style         = '';



if( $enable_highlighted_item == 'enable_highlighted_item' ) {
    $marked_class .= ' qode-highlighted-item ';
    if ( $highlighted_text !== "" ){
		$highlighted_text_html = "<div class='qode-pricing-list-highlited'><span>" . esc_html($highlighted_text) . "</span></div>";
    }
}


if ( $margin_bottom_item !== "" ){
    $list_item_style = "style= 'margin-bottom: ".esc_attr($margin_bottom_item)."px;'";
}

$html .= '<div class="qode-pricing-list-item clearfix '.esc_attr($marked_class).'" '.wp_kses($list_item_style, array('style')).'>';

    $html .='<div class="qode-pricing-list-content">';

        //top text
        $html .= '<div class="qode-pricing-list-top">';

            $html .= '<div class="qode-pricing-item-title-holder">';
                 $html .= '<'.esc_attr($title_tag).' class="qode-pricing-item-title">'.esc_html($title).'</'.esc_attr($title_tag).'>';
            $html .= '</div>';

            $html .= '<div class="pricing-list-dots"></div>';

            $html .= '<div class="qode-pricing-item-price-holder">';
                $html .= '<'.esc_attr($title_tag).' class="qode-pricing-item-price">'.esc_html($price).'</'.esc_attr($title_tag).'>';
            $html .= '</div>';

        $html .= '</div>';

        //bottom text
        $html .= '<div class="qode-pricing-list-bottom">';
            $html .= '<div class="qode-pricing-list-text">'.esc_html($text).'</div>';
            $html .= $highlighted_text_html;
        $html .= '</div>';

    $html .='</div>';

$html .='</div>';

print $html;

