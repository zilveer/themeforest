<?php
extract(shortcode_atts(array(
    'el_class' => '',
    'title' => '',
    'disable_pattern' => 'true',
    'margin_bottom' => 0,
    'align' => 'left',
    'animation' => '',
    'visibility' => '',
) , $atts));

$fancy_style = '';
$pattern = !empty($disable_pattern) ? $disable_pattern : 'true';
Mk_Static_Files::addAssets('vc_column_text');
