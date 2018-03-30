<?php

$el_class = '';

extract( shortcode_atts( array(
            'el_class' => '',
            'skin' => 'dark',
            'icon' => '',
            'icon_size' => 48,
            'default_txt' => '',
            'default_txt_font_weight' => 'inherit',
            'hover_txt' => '',
            'hover_font_size' => '16',
            'hover_txt_font_weight' => 'inherit',
            'hover_line_height' => '18',
            'link' => '',
            'target' => '_self',
            'font_size' => '30',
            'custom_color' => '',
            'animation' => '',
        ), $atts ) );

$output = '';

$style_id = Mk_Static_Files::shortcode_id();

if(!empty( $icon )) {
    $icon = (strpos($icon, 'mk-') !== FALSE) ? ( $icon ) : ( 'mk-'.$icon);    
} else {
    $icon = '';
}

/***********************************
Style for Custom Color
***********************************/


Mk_Static_Files::addCSS('
    #mk-box-text-'.$style_id.' .icon-txt-default{
        font-size: '.$font_size.'px;
    }
', $style_id);

if ( $skin == 'custom') {
    Mk_Static_Files::addCSS('
        #mk-box-text-'.$style_id.'.custom-skin i{
            color: '.$custom_color.' !important;
        }
        #mk-box-text-'.$style_id.'.custom-skin .icon-txt-default{
            color: '.$custom_color.' !important;
        }
        #mk-box-text-'.$style_id.'.custom-skin .icon-txt-hover{
            color: '.$custom_color.' !important;
        }
    ', $style_id);
}

/***********************************
Size Class
***********************************/
if($icon_size == '48'){
    $size_style = 'small ';
}else if($icon_size == '64'){
    $size_style = 'medium ';
}else if($icon_size == '128'){
    $size_style = 'large ';
}

$animation_css = ($animation != '') ? (' mk-animate-element ' . $animation . ' ') : '';

$output .= '<div id="mk-box-text-'.$style_id.'" class="mk-box-text '.$skin.'-skin '.$size_style.$el_class.$animation_css.'">';

$smooth_scroll = (preg_match('/#/',$link)) ? ' class="mk-smooth" ' : '';

$output .= ($link != '') ? '<a target="'.$target.'" '.$smooth_scroll.'href="'.$link.'"><i style="font-size:'.$icon_size.'px" class="'.$icon.'"></i></a>' : '<i style="font-size:'.$icon_size.'px" class="'.$icon.'"></i>';

$output .= '<span class="icon-txt-default" style="font-weight:'.$default_txt_font_weight.';">'.$default_txt.'</span>';
$output .= '<span class="icon-txt-hover" style="font-size:'.$hover_font_size.'px; line-height:'.$hover_line_height.'px; font-weight:'.$hover_txt_font_weight.';">'.$hover_txt.'</span>';


$output .= '</div>';

echo $output;

