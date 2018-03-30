<?php
$output ='';

extract(shortcode_atts(array(
	'control_name'=>'',
	'el_class'=> '',
), $atts));
$name = esc_attr($control_name);
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $this->settings['base'].' '. $el_class,$this->settings['base'],$atts );

$output .='<div class="dhvc-form-group dhvc-form-'.$name.'-box '.$css_class.'">'."\n";
$output .='<div class="dhvc-form-control-'.$name.'">'."\n";
$output .= wpb_js_remove_wpautop($content, true);
$output .='</div>';
$output .='</div>'."\n";
echo $output;