<?php 

extract( shortcode_atts( array(
      'item_txt' => '',
      'item_text_size' => 16,
      'item_color' => '',
      'item_font_weight' => 'inherit',
      'item_text_align' => 'left',
      'el_class' => '',
    ), $atts ) );


$output = '';

$id = Mk_Static_Files::shortcode_id();

$force_responsive = ($item_text_size > 35) ? ' mk-force-responsive' : '';

$output .= '<div id="mk-fade-txt-item-'.$id.'" class="swiper-slide'. $force_responsive .'">
        		  '.$item_txt.'
            </div>';


Mk_Static_Files::addCSS('
  #mk-fade-txt-item-'.$id.' { 
    font-size:'.$item_text_size.'px;
    color: '.$item_color.';
    font-weight: '.$item_font_weight.';
    text-align: '.$item_text_align.';
  }
', $id);


echo $output;

