<?php

extract( shortcode_atts( array(
      'flip_direction'              => 'horizontal',
      'front_background_color'      => '',
      'back_background_color'       => '',
      'min_height'                  => '300',
      'icon_type'                   => 'image',
      "image"                       => '',
      "icon"                        => 'mk-li-smile',
      'icon_size'                   => '16',
      'icon_color'                  => '',
      'front_title'                 => '',
      'front_title_size'            => '20',
      'front_title_color'           => '',
      'back_title'                  => '',
      'back_title_size'             => '20',
      'back_title_color'            => '',
      'font_weight'                 => 'inherit',
      'front_desc'                  => '',
      'front_desc_size'             => '20',
      'front_desc_color'            => '',
      'back_desc'                   => '',
      'back_desc_size'              => '20',
      'back_desc_color'             => '',
      'button_url'                  => '',
      'button_target'               => '_self',
      'button_text'                 => '',
      'button_bg_color'             => '',
      'button_bg_hover_color'       => '',
      'button_text_skin'            => 'light',
      'el_class'                    => ''
), $atts));
Mk_Static_Files::addAssets('mk_flipbox');