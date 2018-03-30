<?php
$output = $css_class ='';

extract(shortcode_atts(array(
	'type'=>'',
	'control_label'=>'',
	'control_name'=>'',
	'placeholder'=>'',
	'help_text'=>'',
	'required'=>'',
	'readonly'=>'',
	'attributes'=>'',
	'el_class'=> '',
), $atts));

$name = esc_attr($control_name);
$label = esc_html($control_label);

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $this->settings['base'].' '. $el_class,$this->settings['base'],$atts );

$picker_class = $type=='date' ? 'dhvc-form-datepicker' : 'dhvc-form-timepicker';

$output .='<div class="dhvc-form-group dhvc-form-'.$name.'-box '.$css_class.'">'."\n";

if(!empty($label)){
	$output .='<label class="dhvc-form-label" for="dhvc_form_control_'.$name.'">'.$label.(!empty($required) ? ' <span class="required">*</span>':'').'</label>' . "\n";
}
$output .='<div class="dhvc-form-input dhvc-form-has-add-on">'."\n";
$output .= '<input type="text" id="dhvc_form_control_'.$name.'" name="'.$name.'" '
		.' class="dhvc-form-control dhvc-form-value dhvc-form-control-'.$name.' '.$picker_class.' dhvc-form-control'.(!empty($required) ? ' dhvc-form-required-entry':'').'" '.(!empty($required) ? ' required aria-required="true"':'').' '.(!empty($readonly) ? ' readonly':'').' placeholder="'.$placeholder.'" '.$attributes.'>' . "\n";
if($type =='date'){
$output .='<span class="dhvc-form-add-on"><i class="fa fa-calendar"></i></span>'."\n";
}else{
$output .='<span class="dhvc-form-add-on"><i class="fa fa-clock-o"></i></span>'."\n";
}
$output .='</div>'."\n";

if(!empty($help_text)){
	$output .='<span class="dhvc-form-help">'.$help_text.'</span>' . "\n";
}
$output .='</div>'."\n";

echo $output;