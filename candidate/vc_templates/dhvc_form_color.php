<?php
$output = $css_class ='';

extract(shortcode_atts(array(
	'control_label'=>'',
	'control_name'=>'',
	'default_value'=>'',
	'placeholder'=>'',
	'help_text'=>'',
	'required'=>'',
	'readonly'=>'',
	'attributes'=>'',
	'el_class'=> '',
), $atts));

$name = esc_attr($control_name);
$default_value = esc_attr($default_value);
$label = esc_html($control_label);

wp_enqueue_script('dhvc-form-minicolor');
wp_enqueue_style('dhvc-form-minicolor');
dhvc_form_add_js_declaration('
jQuery(document).ready( function() {
	jQuery("#dhvc_form_control_'.$name.'").minicolors({
		theme: \'bootstrap\'
	});
});
');

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $this->settings['base'].' '. $el_class,$this->settings['base'],$atts );

$output .='<div class="dhvc-form-group dhvc-form-'.$name.'-box '.$css_class.'">'."\n";
if(!empty($label)){
	$output .='<label class="dhvc-form-label" for="dhvc_form_control_'.$name.'">'.$label.(!empty($required) ? ' <span class="required">*</span>':'').'</label>' . "\n";
}
$output .='<div class="dhvc-form-input">'."\n";
$output .= '<input type="text" id="dhvc_form_control_'.$name.'" name="'.$name.'" value="'.$default_value.'" '.(!empty($maxlength) ? ' maxlength="'.$maxlength.'"' : '')
		.' class="dhvc-form-control dhvc-form-control-'.$name.' dhvc-form-value'.(!empty($required) ? ' dhvc-form-required-entry':'').'" '.(!empty($required) ? ' required aria-required="true"':'').' '.(!empty($readonly) ? ' readonly':'').' placeholder="'.$placeholder.'" '.$attributes.'>' . "\n";
$output .='</div>';
if(!empty($help_text)){
	$output .='<span class="dhvc-form-help">'.$help_text.'</span>' . "\n";
}
$output .='</div>'."\n";

echo $output;