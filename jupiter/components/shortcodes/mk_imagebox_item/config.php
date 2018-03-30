<?php

extract( shortcode_atts( array(
      'icon_type'                  => 'image',
      'item_video'                 => '',
      'mp4'                        => '',
      'webm'                       => '',
      'ogv'                        => '',
      'preview_image'              => '',
      'item_image'                 => '',
      'image_padding'              => 'true',
      "background_color"           => '#eaeaea',
      'item_title'                 => '',
      'title_text_size'            => 16,
      'title_color'                => '',
      'title_font_weight'          => 'inherit',
      'text_color'                 => '',
      'btn_text'                   => '',
      'btn_text_color'             => '',
      'btn_background_color'       => '',
      'btn_hover_background_color' => '',
      'btn_url'                    => '',
      'el_class'                   => '',
    ), $atts ) );
Mk_Static_Files::addAssets('mk_imagebox_item');