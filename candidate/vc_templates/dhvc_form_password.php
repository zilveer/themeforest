<?php
$output = $css_class ='';

extract(shortcode_atts(array(
	'control_label'=>'',
	'control_name'=>'',
	'confirmation'=>'',
	'password_field'=>'',
	'maxlength'=>'',
	'placeholder'=>'',
	'icon'=>'',
	'help_text'=>'',
	'required'=>'',
	'readonly'=>'',
	'validator'=>'',
	'attributes'=>'',
	'el_class'=> '',
), $atts));
$name = esc_attr($control_name);
$label = esc_html($control_label);
$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $this->settings['base'].' '. $el_class,$this->settings['base'],$atts );

$input_class='';
$icon_html = '';
if(!empty($icon)){
	$input_class = ' dhvc-form-has-add-on';
	$icon_html ='<span class="dhvc-form-add-on"><i class="'.$icon.'"></i></span>'."\n";
}

$output .='<div class="dhvc-form-group dhvc-form-'.$name.'-box '.$css_class.'">'."\n";
if(!empty($label)){
	$output .='<label class="dhvc-form-label" for="dhvc_form_control_'.$name.'">'.$label.(!empty($required) ? ' <span class="required">*</span>':'').'</label>' . "\n";
}
$output .='<div class="dhvc-form-input '.$input_class.'">'."\n";
$output .= '<input autocomplete="off" type="password" id="dhvc_form_control_'.$name.'" name="'.$name.'" value="" '.(!empty($maxlength) ? ' maxlength="'.$maxlength.'"' : '')
		.' class="dhvc-form-control dhvc-form-control-'.$name.' dhvc-form-value'.(!empty($required) ? ' dhvc-form-required-entry':'').' '.(!empty($validator) ? (!empty($confirmation) ? 'dhvc-form-validate-cpassword' : 'dhvc-form-validate-password' )  : '' ).'" '.(!empty($required) ? ' required aria-required="true"':'').' '.(!empty($readonly) ? ' readonly':'').' '.(!empty($confirmation) ? 'data-validate-cpassword="'.$password_field.'"':'').' placeholder="'.$placeholder.'" '.$attributes.'>' . "\n";
$output .=$icon_html;
$output .='</div>';
if(!empty($help_text)){
	$output .='<span class="dhvc-form-help">'.$help_text.'</span>' . "\n";
}
$output .='</div>'."\n";

echo $output;