<?php
extract(shortcode_atts(array(
    'el_class' => '',
    'color' => '#393836',
    'highlight_color' => '',
    'highlight_opacity' => 0.3,
    "size" => '18',
    'letter_spacing' => 0,
    'stroke' => 0,
    'stroke_color' => '',
    'font_weight' => 'inherit',
    'margin_bottom' => '20',
    'margin_top' => '0',
    'line_height' => '34',
    "align" => 'left',
    'animation' => '',
    "font_family" => '',
    "font_type" => '',
) , $atts));
Mk_Static_Files::addAssets('mk_title_box');
