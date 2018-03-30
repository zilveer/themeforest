<?php
extract( shortcode_atts( array(
    'icon_type'                     => 'icon',
    'icon_image'                    => '',
    'icon'                          => 'mk-li-smile',
    'icon_size'                     => '16',
    'icon_color'                    => '',
    'icon_background_color'         => '',
    'icon_border_color'             => '',
    'icon_hover_color'              => '',
    'icon_hover_background_color'   => '',
    'icon_hover_border_color'       => '',
    'title'                         => '',
    'title_size'                    => '20',
    'title_color'                   => '',
    'title_weight'                  => 'inherit',
    'title_top_padding'             => '10',
    'title_bottom_padding'          => '10',
    'description_color'             => '',
    'animation'                     => '',
    'read_more_url'                 => '',
    'align'                         => 'center',
    'link_target'                   => '_self',
    'el_class'                      => ''
    ),$atts )
);
Mk_Static_Files::addAssets('mk_icon_box2');