<?php
extract(shortcode_atts(array(
	'style' 			=> 'default',
    'count'             => 10,
    'offset'            => 0,
    'categories'        => '',
    'posts'             => '',
    'author'            => '',
    'image_height'      => 250,
    'pagination'        => 'true',
    'pagination_style'  => '2',
    'orderby'           => 'date',
    'order'             => 'DESC',
    'el_class'          => ''
) , $atts));

Mk_Static_Files::addAssets('mk_news');
