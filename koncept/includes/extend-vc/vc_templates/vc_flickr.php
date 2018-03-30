<?php

$output = '';
extract(shortcode_atts(array(
    'el_class' => '',
    'title' => '',
    'flickr_id' => '95572727@N00',
    'count' => '6',
    'type' => 'user',
    'display' => 'latest',
    'css_animation' => '',
    'css_animation_speed' => 'default',
    'css_animation_delay' => '0'
), $atts));

$el_class = $this->getExtraClass( $el_class );
$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'krown-flickr'.$el_class, $this->settings['base']);

$output .= "\n\t".'<div class="clearfix '.$css_class . ( $css_animation != '' ? ' animate ' . $css_animation_speed . '" data-anim-type="' . $css_animation . '" data-anim-delay="' . $css_animation_delay . '"' : '"') . '>';
$output .= "\n\t\t".'<ul>' . krown_parse_flickr_feed( $flickr_id, $count ) . '</ul>';
$output .= "\n\t".'</div>'.$this->endBlockComment('.wpb_flickr_widget')."\n";

echo $output;
