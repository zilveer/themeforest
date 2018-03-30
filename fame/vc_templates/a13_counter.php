<?php
$el_class = $from = $to = $speed = $refresh_interval = $finish_text = $font_size = $text_color = '';
$bold = $uppercase = $style = $number_style = '';

wp_enqueue_script( 'jquery.countTo' );
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
//extract(shortcode_atts(array(
//    'from'      => '',
//    'to'        => '',
//    'speed'     => '',
//    'refresh_interval' => '',
//    'finish_text'   => '',
//    'font_size'     => '',
//    'text_color'    => false,
//    'bold'          => false,
//    'uppercase'     => false,
//    'el_class'      => ''
//), $atts));
$uppercase = (bool)$uppercase;
$bold = (bool)$bold;

$css_classes = $this->getExtraClass($el_class);

//bold font
if($bold === true){
    $style .= 'font-weight:bold;';
}
else{
    $style .= 'font-weight:normal;';
}

//text transform
if($uppercase === true){
    $style .= 'text-transform:uppercase;';
}
else{
    $style .= 'text-transform:none;';
}

//color
if($text_color !== false && strlen($text_color)){
    $style .= 'color:'.$text_color.';';
}

//font size of number
if(strlen($font_size)){
    $number_style .= ' style="font-size:'.((int)$font_size).'px;"';
}

//attributes for counter
$data_attr = '';
$data_arr = array('from', 'to', 'speed');
foreach($data_arr as $attr){
    if(strlen(${$attr})){
        $data_attr .= ' data-'.$attr.'="'.${$attr}.'"';
    }
}
if(strlen($refresh_interval)){
    $data_attr .= ' data-refresh-interval="'.$refresh_interval.'"';
}

$output = '<div class="a13_counter" style="'.$style.';">';
$output .= '<span class="number"'.$number_style.$data_attr.'>&nbsp;</span>';
$output .= strlen($finish_text)? ('<span class="finish-text">'.$finish_text.'</span>') : '';
$output .= '</div>'."\n";

echo $output;
