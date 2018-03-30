<?php
extract(shortcode_atts(array(
    'el_id' => '',
    'visibility' => '',
    'is_fullwidth_content' => 'true',
    'css' => '',
    'animation' => '',
    'column_padding' => 0,
    'padding' => 0,
    'attached' => 'false',
    'disable_element' => '',
    'el_class' => '',
) , $atts));
Mk_Static_Files::addAssets('vc_row_inner');

