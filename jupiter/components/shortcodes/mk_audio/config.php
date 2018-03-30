<?php
extract(shortcode_atts(array(
    'mp3_file' => '',
    'ogg_file' => '',
    'audio_author' => '',
    'thumb' => '',
    'remove_thumb' => 'false',
    'el_class' => '',
    'large_player_class' => 'mk-audio-shortcode',
    'img_dimension' => 170,
    'player_background' => ''
) , $atts));
Mk_Static_Files::addAssets('mk_audio');