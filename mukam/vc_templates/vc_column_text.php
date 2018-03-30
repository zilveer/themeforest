<?php
$output = $el_class = $css_animation = $delay = $mydelay = '';

extract(shortcode_atts(array(
    'el_class' => '',
    'animation' => '',
    'delay' => ''
), $atts));


   if ( $delay != '') {
   $mydelay = ' style="animation-delay: '.$delay.'ms; -moz-animation-delay: '.$delay.'ms; -webkit-animation-delay: '.$delay.'ms;"';
   }

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'wpb_text_column wpb_content_element '.$el_class, $this->settings['base']);

$output .= "\n\t".'<div class="'.$animation.' '.$css_class.' animated"'.$mydelay.'>';
$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content, true);
$output .= "\n\t\t".'</div> ' . $this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> ' . $this->endBlockComment('.wpb_text_column');

echo $output;