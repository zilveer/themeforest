<?php
$output = $css_class ='';

extract(shortcode_atts(array(
	'control_label'=>'',
	'control_name'=>'',
	'default_value'=>'',
	'options'=>'',
	'help_text'=>'',
	'required'=>'',
	'disabled'=>'',
	'attributes'=>'',
	'conditional'=>'',
	'el_class'=> '',
), $atts));

$default_value_arr = explode(',',$default_value);
$name = esc_attr($control_name);
$label = esc_html($control_label);

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $this->settings['base'].' '. $el_class,$this->settings['base'],$atts );

$output .='<div class="dhvc-form-group dhvc-form-'.$name.'-box '.$css_class.'">'."\n";
if(!empty($label)){
	$output .='<label class="dhvc-form-label" for="dhvc_form_control_'.$name.'">'.$label.(!empty($required) ? ' <span class="required">*</span>':'').'</label>' . "\n";
}
$output .='<div class="dhvc-form-select'.(!empty($conditional) ? ' dhvc-form-conditional':'').'">'."\n";
if(!empty($options)){
	
	$options_arr = json_decode(base64_decode($options));
	$select_name = (count($options_arr) > 1) ? $name.'[]' : $name;
	$output .= '<select '.(!empty($conditional) ? 'data-conditional-name="'.$name.'" data-conditional="'.esc_attr(base64_decode($conditional)).'"': '' ).' '.(!empty($disabled) ? ' disabled':'').'  id="dhvc_form_control_'.$name.'" name="'.$select_name.'" '.(($this->shortcode =='dhvc_form_multiple_select') ? 'multiple' :'' ).' class="chosen-select dhvc-form-control dhvc-form-control-'.$name.' dhvc-form-value '.(!empty($required) ? ' dhvc-form-required-entry':'').'" '.(!empty($required) ? ' required aria-required="true"':'').' '.$attributes.'>'."\n";
	if(!empty($options_arr)){
		foreach ($options_arr as $option){
			$output .= '<option '.($option->is_default === 1 ? 'selected="selected"' :'').' value="'.esc_attr($option->value).'">'.esc_html($option->label).'</option>';
		}
	}
	$output .='</select><i></i>'."\n";
}
$output .='</div>';
if(!empty($help_text)){
	$output .='<span class="dhvc-form-help">'.$help_text.'</span>' . "\n";
}
$output .='</div>'."\n";

echo $output;