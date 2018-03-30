<?php
// [ux_the_title]
function ux_the_title($atts) {
  extract(shortcode_atts(array(
    'tag' => 'h1',
    'style' => 'uppercase',
    'size' => '150',
  ), $atts));

  if($size !== '100') $size = 'style="font-size:'.$size.'%"';
  
  $title = get_the_title();

  return  '<'.$tag.' class="'.$style.'"><span '.$size.'>'. esc_html($title).'</span></'.$tag.'>';
}

add_shortcode("ux_the_title", "ux_the_title");


// [ux_subnav]
function ux_subnav($atts) {
  extract(shortcode_atts(array(
    'icon' => '',
  ), $atts));
   return 'SUBNAV GOES HERE '.get_flatsome_subnav();
}

add_shortcode("ux_subnav", "ux_subnav");

// [ux_excerpt]
function ux_excerpt($atts) {
    return '<p class="lead the-excerpt">'.the_excerpt().'</p>';
}

add_shortcode("ux_excerpt", "ux_excerpt");

// [ux_breadcrumbs]
function ux_breadcrumbs($atts) {
  extract(shortcode_atts(array(
    'icon' => '',
  ), $atts));
  
    return 'BREADCRUMBS GOES HERE';
}

add_shortcode("ux_breadcrumbs", "ux_breadcrumbs");