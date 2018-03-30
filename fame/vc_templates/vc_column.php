<?php
$output = $el_class = $width = $a13_fa_icon = $icon_color = $icon_position = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
//extract(shortcode_atts(array(
//    'el_class' => '',
//    'width' => '1/1',
//    'a13_fa_icon' => '',
//    'icon_color' => '',
//    'icon_position' => 'left',
//    'css' => ''
//), $atts));

$el_class = $this->getExtraClass($el_class);
$width = wpb_translateColumnWidthToSpan($width);

$el_class .= ' wpb_column column_container';

//is there icon?
if( $a13_fa_icon != '' ){
    $el_class .= ' column-with-icon';
    if($icon_position === 'right'){
        $el_class .= ' column-with-icon-right';
    }
    $icon_style = strlen($icon_color)? ' style="color:'.$icon_color.';"' : '';
    $a13_fa_icon = '<i class="column-icon fa fa-'.$a13_fa_icon.'"'.$icon_style.'></i>';
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );


//$output = '<div class="a13_big_icon" style="text-align:'.$icon_align.';">'.$a13_fa_icon.'</div>'."\n";

$output .= "\n\t".'<div class="'.$css_class.'">';
$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= ($a13_fa_icon != '')? "\n\t\t\t".$a13_fa_icon : '';
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> '.$this->endBlockComment($el_class) . "\n";

echo $output;