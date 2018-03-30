<?php

extract(shortcode_atts(array(
    'style' => 1, // only header style 1 or 3 is allowed in header shortcode
    'align'  => 'left',
    'logo' => 'true',
    'burger_icon' => 'true',
    'woo_cart' => 'true',
    'search_icon' => 'true',
    'hover_styles'  => 1,
    'menu_location'  => 'primary-menu',
    'bg_color'      => '',
    'border_color'  => '', // top and bottom border color 
    'text_color'    => '',
    'text_hover_skin'  => '',
    'el_class'  => ''

), $atts));
Mk_Static_Files::addAssets('mk_header');
global $is_header_shortcode_added;
$is_header_shortcode_added = $style;