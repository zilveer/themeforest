<?php
$output = $upper_text = $lower_text = $title_align = $title_size = $el_class = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
//extract(shortcode_atts(array(
//    'upper_text' => __("Title", "fame"),
//    'lower_text' => '',
//    'title_align' => 'align_center',
//    'title_size' => 'size_big',
//    'el_class' => ''
//), $atts));

$css_classes = $this->getExtraClass($el_class) . $this->getExtraClass($title_align) . $this->getExtraClass($title_size);

$output .= '<div class="a13-hellotext wpb_content_element'.$css_classes.'"><h1>'.$upper_text.'</h1><h2 class="subtitle">'.$lower_text.'</h2></div>'."\n";

echo $output;
