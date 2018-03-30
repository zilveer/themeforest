<?php
extract(shortcode_atts(array(
    'title' => '',
    'link' => '',
    'el_class' => '',
    'animation' => '',
) , $atts));

Mk_Static_Files::addAssets('vc_video');