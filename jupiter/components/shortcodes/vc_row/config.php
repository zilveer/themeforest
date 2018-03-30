<?php
extract(shortcode_atts(array(
    'fullwidth' => 'false',
    'fullwidth_content' => 'true',
    'id' => '',
    'column_padding' => 0,
    'padding' => 0,
    'attached' => 'false',
    'visibility' => '',
    'css' => '',
    'animation' => '',
    'equal_columns' => 'false',
    'disable_element' => '',
    'el_class' => ''
) , $atts));
Mk_Static_Files::addAssets('vc_row');
