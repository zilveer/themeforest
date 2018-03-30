<?php
extract( shortcode_atts( array(
    'show_as'           => 'slideshow',
    'scroll_nav'        => 'true',
    "animation_speed"   => 700,
    "slideshow_speed"   => 7000,
    "direction_nav"     => "true",
    'column'            => 3,
    'per_view'          => 4,
    'padding'           => 20,
    'el_class'          => '',
), $atts ) );
Mk_Static_Files::addAssets('mk_imagebox');
Mk_Static_Files::addAssets('mk_swipe_slideshow');