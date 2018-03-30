<?php
extract(shortcode_atts(array(
    'src' => '',
    'axis' => 'vertical',
    'animation' => '',
    'link' => '',
    'align' => 'left',
    'title' => '',
    'visibility' => '',
    'el_class' => '',
) , $atts));
Mk_Static_Files::addAssets('mk_moving_image');