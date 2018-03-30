<?php
global $mk_options;

extract( shortcode_atts( array(
            'el_class'                  => '',
            'title'                     => '',
            'style'                     => 'simple_minimal',
            'icon'                      => 'mk-li-smile',
            'icon_color'                => $mk_options['skin_color'],
            'icon_circle_color'         => $mk_options['skin_color'], // for boxed and simple minimal style
            'icon_circle_border_color'  => '', // for boxed and simple minimal style
            'box_blur'                  => 'false', // for boxed style
            'circled'                   => 'false', // for simple minimal style
            'icon_location'             => 'left', // for simple ultimate and boxed style
            'icon_size'                 => 'small', // for simple ultimate style
            'read_more_txt'             => '',
            'read_more_url'             => '',
            'text_size'                 => '16',
            'font_weight'               => 'inherit',
            'rounded_circle'            => 'false',
            'margin'                    => '30',
            'txt_color'                 => '',
            'txt_link_color'            => '',
            'title_color'               => '',
            'visibility'                => '',
            'animation'                 => '',
        ), $atts ) );

Mk_Static_Files::addAssets('mk_icon_box');



if ( !empty( $icon ) ) {
        $icon = (strpos($icon, 'mk-') !== FALSE) ? $icon : ( 'mk-'.$icon.'' );
}