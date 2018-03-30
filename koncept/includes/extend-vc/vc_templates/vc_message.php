<?php
$output = $color = $el_class = $css_animation = '';
extract(shortcode_atts(array(
    'color' => 'alert-info',
    'el_class' => '',
    'css_animation' => '',
    'css_animation_speed' => 'default',
    'css_animation_delay' => '0'
), $atts));
$el_class = $this->getExtraClass($el_class);


$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'krown-alert '.$color.$el_class, $this->settings['base']);
$css_class .= $this->getCSSAnimation($css_animation);
$output .= '<div class="'.$css_class . ( $css_animation != '' ? ' animate ' . $css_animation_speed . '" data-anim-type="' . $css_animation . '" data-anim-delay="' . $css_animation_delay . '"' : '"') . '>'.wpb_js_remove_wpautop($content, true).'</div>'.$this->endBlockComment('alert box')."\n";

echo $output;
