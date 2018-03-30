<?php
extract( shortcode_atts( array(
            "images"            => '',
            "effect"            => 'fade',
            'padding'           => 30,
            "animation_speed"   => 700,
            "slideshow_speed"   => 7000,
            "pause_on_hover"    => "false",
            "smooth_height"     => "true",
            "direction_nav"     => "true",
            'bg_color'          => '',
            'attachment'        => 'scroll',
            'bg_position'       => 'left top',
            'border_color'      => '',
            'bg_image'          => '',
            'enable_3d'         => 'false',
            'stretch_images'        => "false",
            'speed_factor'      => '0.3',
            "el_class"          => '',
        ), $atts ) );
Mk_Static_Files::addAssets('mk_fullwidth_slideshow');