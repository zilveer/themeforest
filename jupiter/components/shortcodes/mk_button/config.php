<?php
global $mk_options;

extract( shortcode_atts( array(
      'el_class'                   => '',
      'id'                         => '',
      'size'                       => 'small',
      'button_custom_width'        => 0,
      'corner_style'               => 'pointed', // new added
      'btn_hover_bg'               => '',
      'btn_hover_txt_color'        => '',
      'icon'                       => '',
      'bg_color'                   => '',
      'outline_skin'               => 'dark',
      'outline_hover_skin'         => '', 
      'outline_active_color'       => '',
      'outline_active_text_color'  => '',
      'outline_hover_bg_color'     => '',
      'outline_hover_color'        => '',
      'dimension'                  => 'three',
      'text_color'                 => 'light',
      'icon_anim'                  => 'none',
      "url"                        => '',
      "nofollow"                   => 'false',
      "target"                     => '_self',
      'margin_bottom'              => 15,
      'margin_top'                 => 0,
      'margin_right'               => 15,
      'animation'                  => '',
      'visibility'                 => '',
      'fullwidth'                  => 'false',
      "align"                      => 'left',
      'letter_spacing'             => 0
), $atts ) );
Mk_Static_Files::addAssets('mk_button'); 

$bg_color = empty($bg_color) ? $mk_options['skin_color'] : $bg_color;