<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
//extract(shortcode_atts(array(
//    'link' => '',
//    'title' => __('Text on the button', "js_composer"),
//    'color' => '',
//    'a13_fa_icon' => '',
//    'size' => '',
//    'style' => '',
//    'el_class' => '',
//    'bold' => false,
//    'uppercase' => false,
//    'position' => 'left',
//), $atts));
$uppercase = (bool)$uppercase;
$bold = (bool)$bold;

$class = 'vc_btn';
//parse link
$link = ($link=='||') ? '' : $link;
$link = vc_build_link($link);
$a_href = $link['url'];
$a_title = $link['title'];
$a_target = $link['target'];


$class .= ($color!='') ? ' vc_btn-'.$color : '';
$class .= ($size!='') ? ' vc_btn-'.$size : '';
$class .= ($style!='') ? ' vc_btn_'.$style : '';


$btn_style = ' style="';
//bold font
if($bold === true){
    $btn_style .= 'font-weight:bold;';
}
else{
    $btn_style .= 'font-weight:normal;';
}
//text transform
if($uppercase === true){
    $btn_style .= 'text-transform:uppercase;';
}
else{
    $btn_style .= 'text-transform:none;';
}
$btn_style .= '"';

$i_icon = ( $a13_fa_icon != '' ) ? ' <i class="fa fa-'.$a13_fa_icon.'"> </i>' : '';

$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' '.$class.$el_class, $this->settings['base']);

$output .= '<span>'.$i_icon.$title.'</span>';
$output = '<a class="a13-sc-button '.$css_class.'" title="'.$a_title.'" href="'.$a_href.'" target="'.$a_target.'"'.$btn_style.'>' . $output . '</a>';
$output = '<div class="a13-sc-button_wrapper" style="text-align:'.$position.';">'.$output.'</div>';

echo $output . $this->endBlockComment('vc_button') . "\n";
