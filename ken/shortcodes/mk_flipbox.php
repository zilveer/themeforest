<?php

global $mk_settings;

extract( shortcode_atts( array(
      'flip_direction' => 'horizontal',
      'front_background_color' => '',
      'back_background_color' => '',
      'front_opacity' => 1,
      'back_opacity' => '',
      'front_align' => 'left',
      'front_vertical_align' => 'middle',
      'box_padding' => 20,
      'box_radius' => 'false',
      'back_align' => 'left',
      'back_vertical_align' => 'middle',
      "min_height" => 300,
      "max_width" => 500,
      'front_title' => '',
      'front_title_size' => 20,
      'front_title_font_weight' => 'inherit',
      'front_title_color' => '',
      'front_desc' => '',
      'front_desc_size' => 20,
      'front_desc_line_height' => 26,
      'front_desc_color' => '',
      'back_title' => '',
      'back_title_size' => 20,
      'back_title_color' => '',
      'back_title_font_weight' => 'inherit',
      'back_desc' => '',
      'back_desc_size' => 20,
      'back_desc_line_height' => 26,
      'back_desc_color' => '',
      'button_text' => '',
      'button_url' => '',
      'button_size' => 'medium',
      'button_corner_style' => 'pointed',
      'btn_skin_1' => $mk_settings['accent-color'],
      'btn_skin_2' => $mk_settings['accent-color'],
      'btn_alignment' => 'center',
      'el_class' => ''
    ), $atts ) );

$output = $front = $flip = '';

/*Styling*/
$box_radius_class = $box_radius == 'true' ? 'border-radius-true' : '';
$box_padding_style = !empty($box_padding) ? 'padding-left:'.$box_padding.'px; padding-right:'.$box_padding.'px;' : ''; 

/*Flipbox Front*/
$front .= '<div class="mk-flipbox-front '.$box_radius_class.' va-'.$front_vertical_align.'" style="text-align:'.$front_align.'; '.$box_padding_style.' opacity:'.$front_opacity.'; '.($front_background_color ? ('background-color: '.$front_background_color.';') : '').'" >';
$front .= ' <div class="mk-flipbox-content">';
$front .= !empty($front_title) ? '<div class="front-title" style="'.($front_title_font_weight ? ('font-weight:'.$front_title_font_weight.';') : '').' font-size:'.$front_title_size.'px; line-height:'.$front_title_size.'px; '.($front_title_color ? ('color:'.$front_title_color.';') : '').'">'.$front_title.'</div>' : '';
$front .= '       <div class="front-desc" style="font-size:'.$front_desc_size.'px; line-height:'.$front_desc_line_height.'px; '.($front_desc_color ? ('color:'.$front_desc_color.';') : '').'">'.$front_desc.'</div>';
$front .= ' </div>';
$front .= '</div>';

/*Flipbox Back*/
$flip .= '<div class="mk-flipbox-back '.$box_radius_class.' va-'.$back_vertical_align.'" style="text-align:'.$back_align.'; '.$box_padding_style.' opacity:'.$front_opacity.'; '.($back_background_color ? ('background-color: '.$back_background_color.';') : '').'">';
$flip .= '  <div class="mk-flipbox-content">';
$flip .= !empty($back_title) ? '<div class="back-title" style="font-weight:'.$back_title_font_weight.'; font-size:'.$back_title_size.'px; line-height:'.$back_title_size.'px; '.($back_title_color ? ('color:'.$back_title_color.';') : '').'">'.$back_title.'</div>' : '';
$flip .= '        <div class="back-desc" style="font-size:'.$back_desc_size.'px; line-height:'.$back_desc_line_height.'px;  '.($back_desc_color ? ('color:'.$back_desc_color.';') : '').' ">'.$back_desc.'</div>';

$flip .= !empty( $button_url ) ? (do_shortcode( '[mk_button style="fill" corner_style="'.$button_corner_style.'" size="'.$button_size.'" align="'.$btn_alignment.'" bg_color="" btn_hover_bg="" text_color="" outline_skin="'.$btn_skin_1.'" outline_border_width="2" outline_hover_skin="'.$btn_skin_2.'" url="'.$button_url.'" el_class=" back-button"]'.$button_text.'[/mk_button]' )) : '' ;

$flip .= '  </div>';
$flip .= '</div>';

$output .= '<div class="mk-flipbox-container flip-'.$flip_direction.' '.$el_class.'" style="height:1px; min-height:'.$min_height.'px; max-width:'.$max_width.'px" onClick="return true">';
$output .= '      <div class="mk-flipbox-flipper">';
$output .=              $front;
$output .=              $flip;
$output .= '            <div class="clearboth"></div>';
$output .= '      </div>';
$output .= '</div>';


echo $output;
