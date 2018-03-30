<?php


$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
//extract(shortcode_atts(array(
//    'el_width' => '',
//    'style' => '',
//    'color' => '',
//    'accent_color' => '',
//    'el_class' => '',
//    'margin_top' => '',
//    'margin_bottom' => '',
//), $atts));

echo do_shortcode('[vc_text_separator no_text="1" margin_top="'.$margin_top.'" margin_bottom="'.$margin_bottom.'" style="'.$style.'" color="'.$color.'" accent_color="'.$accent_color.'" el_width="'.$el_width.'" el_class="'.$el_class.'"]');