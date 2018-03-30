<?php
extract(shortcode_atts(array(
    'title' => '',
    'el_class' => '',
    'flickr_id' => '95572727@N00',
    'count' => '6',
    'column' => 6,
    //'thumb_size' => 's',
    //'type' => 'user',
    'api_key' => '',
    //'display' => 'latest'
) , $atts));

Mk_Static_Files::addAssets('vc_flickr');
