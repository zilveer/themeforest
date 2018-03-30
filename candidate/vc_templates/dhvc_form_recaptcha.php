<?php
$output = $css_class ='';

extract(shortcode_atts(array(
	'type'=>'recaptcha',
	'theme'=>'',
	'language'=>'en',
	'control_label'=>'',
	'control_name'=>'',
	'placeholder'=>'',
	'help_text'=>'',
	'required'=>'1',
	'attributes'=>'',
	'el_class'=> '',
), $atts));

$name = esc_attr($control_name);
$label = esc_html($control_label);

wp_enqueue_script('dhvc-form-recaptcha');

dhvc_form_add_js_declaration('
jQuery( document ).ready(function(){
	Recaptcha.create("' . dhvc_form_get_option('recaptcha_public_key') . '", "'.$name.'", {theme: "' . $theme . '",lang : \''.$language.'\',tabindex: 0});
});
');

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $this->settings['base'].' '. $el_class,$this->settings['base'],$atts );

$output .='<div class="dhvc-form-group dhvc-form-'.$name.'-box '.$css_class.'">'."\n";
if(!empty($label)){
	$output .='<label for="'.$name.'">'.$label.(!empty($required) ? ' <span class="required">*</span>':'').'</label>' . "\n";
}
$output .='<div class="dhvc-form-group-recaptcha" id="'.$name.'"></div>';	

if(!empty($help_text)){
	$output .='<span class="help_text">'.$help_text.'</span>' . "\n";
}
$output .='</div>'."\n";

echo $output;
