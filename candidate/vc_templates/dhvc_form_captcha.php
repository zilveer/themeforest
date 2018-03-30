<?php
$output = $css_class = '';

extract ( shortcode_atts ( array (
		'control_label' => '',
		'control_name' => '',
		'placeholder' => '',
		'help_text' => '',
		'required' => '1',
		'attributes' => '',
		'el_class' => '' 
), $atts ) );
$name = esc_attr($control_name);
$label = esc_html($control_label);

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $this->settings['base'].' '. $el_class,$this->settings['base'],$atts );

$output .='<div class="dhvc-form-group dhvc-form-'.$name.'-box '.$css_class.'">'."\n";
if(!empty($label)){
	$output .='<label class="dhvc-form-label" for="dhvc_form_control_'.$name.'">'.$label.(!empty($required) ? ' <span class="required">*</span>':'').'</label>' . "\n";
}
$output .='<div class="dhvc-form-captcha">'."\n";
$output .='<img src="'.DHVC_FORM_URL.'/captcha.php?t='.microtime(true).'">';
$output .= '<input autocomplete="off" type="text" id="dhvc_form_control_'.$name.'" name="'.$name.'" '
		.' class="dhvc-form-control dhvc-form-control-'.$name.' dhvc-form-value'.(!empty($required) ? ' dhvc-form-required-entry dhvc-form-validate-captcha':'').'" '.(!empty($required) ? ' required aria-required="true"':'').' placeholder="'.$placeholder.'">' . "\n";
$output .='</div>';
if(!empty($help_text)){
	$output .='<span class="dhvc-form-help">'.$help_text.'</span>' . "\n";
}
$output .='</div>'."\n";

echo $output;
