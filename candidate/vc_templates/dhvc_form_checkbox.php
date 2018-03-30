<?php
$output = $css_class ='';

extract(shortcode_atts(array(
	'control_label'=>'',
	'control_name'=>'',
	'options'=>'',
	'help_text'=>'',
	'required'=>'',
	'disabled'=>'',
	'conditional'=>'',
	'el_class'=> '',
), $atts));

$name = esc_attr($control_name);
$label = esc_html($control_label);

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $this->settings['base'].' '. $el_class,$this->settings['base'],$atts );

$output .='<div class="dhvc-form-group dhvc-form-'.$name.'-box '.$css_class.'">'."\n";
if(!empty($label)){
	$output .='<h5>'.$label.(!empty($required) ? ' <span class="required">*</span>':'').'</h5>' . "\n";
}
$output .='<div class="dhvc-form-checkbox'.(!empty($conditional) ? ' dhvc-form-conditional':'').'">'."\n";
if(!empty($options)){
	$options_arr = json_decode(base64_decode($options));
	$checkbox_name = (count($options_arr) > 1) ? $name.'[]' : $name;
	if(!empty($options_arr)){
		foreach ($options_arr as $option){
			$output .='<label for="dhvc_form_control_'.sanitize_title($option->value).'">';
			$output .= '<input '.(!empty($conditional) ? 'data-conditional-name="'.$name.'" data-conditional="'.esc_attr(base64_decode($conditional)).'"': '' ).' type="checkbox" '.(!empty($disabled) ? ' disabled':'').' class="dhvc-form-value dhvc-form-control-'.$name.' '.(!empty($required) && $i ==0 ? 'dhvc-form-required-entry':'').'"  id="dhvc_form_control_'.sanitize_title($option->value).'" '.($option->is_default === 1 ? 'checked="checked"' :'').' name="'.$checkbox_name.'" value="'.esc_attr($option->value).'"><i></i>';
			$output .= esc_html($option->label);
			$output .= '</label>'."\n";
		}
	}
}
$output .='</div>';
if(!empty($help_text)){
	$output .='<span class="dhvc-form-help">'.$help_text.'</span>' . "\n";
}
$output .='</div>'."\n";

echo $output;