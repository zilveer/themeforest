<?php
$output = $title = $title_align = $title_size = $text_color = $bg_color = $el_class = $h1_style = $span_style = $bold = $font_weight = $uppercase = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
//extract(shortcode_atts(array(
//    'title' => __("Title", "fame"),
//    'title_align' => 'align_center',
//    'title_size' => 'h1',
//    'bold' => false,
//    'uppercase' => false,
//    'text_color' => false,
//    'bg_color' => false,
//    'el_class' => ''
//), $atts));
$uppercase = (bool)$uppercase;
$bold = (bool)$bold;

$css_classes = $this->getExtraClass($el_class) . $this->getExtraClass($title_align);

//bold font
if($bold === true){
    $span_style .= 'font-weight:bold;';
}
else{
    $span_style .= 'font-weight:normal;';
}
//text transform
if($uppercase === true){
    $span_style .= 'text-transform:uppercase;';
}
else{
    $span_style .= 'text-transform:none;';
}

if($text_color !== false && strlen($text_color)){
    $h1_style = 'style="color:'.$text_color.';"';
}

if($bg_color !== false && strlen($bg_color)){
    $span_style .= 'background-color:'.$bg_color.';';
}

$output .= '<'.$title_size.' class="a13-heading-color'.$css_classes.'" '.$h1_style.'><span style="'.$span_style.'">'.$title.'</span></'.$title_size.'>'."\n";

echo $output;
