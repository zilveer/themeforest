<?php
extract(shortcode_atts(array(
    'title' => '',
    'offset' => 0,
    'date' => '12/24/2016 12:00:00',
    'el_class' => '',
) , $atts));
Mk_Static_Files::addAssets('mk_countdown');