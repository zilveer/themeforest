<?php
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

if ( $target == 'same' || $target == '_self' ) { $target = ''; }
if ( $target != '' ) { $target = ' target="'.$target.'"'; }

$inverted_to = '';
$buttonclass = null;
$buttonhover = null;
if ($inverted==true) {
	$inverted_to = ' inverted';
	if($buttoncolor=="custom") {
		$buttonhover = ' data-color-button="'.$custombuttoncolor.'" data-color-text="'.$custombuttontextcolor.'" data-hover-color="'.$custombuttontexthovercolor.'"';
		$buttoncolor = ' style="border-color: '.$custombuttoncolor.'; color: '.$custombuttontextcolor.'; background-color: transparent;"';
		$buttonclass = ' custom-button-color'; 
	} else {
		$buttonhover = null;
		$buttoncolor = null;
		$buttonclass = ' normal-button-color';
	}
} else {
	if($buttoncolor=="custom") {
		$buttonhover = ' data-color-button="'.$custombuttoncolor.'" data-color-text="'.$custombuttontextcolor.'" data-hover-color="'.$custombuttontexthovercolor.'"';
		$buttoncolor = ' style="background-color: '.$custombuttoncolor.'; border-color: '.$custombuttoncolor.'; color: '.$custombuttontextcolor.';"';
		$buttonclass = ' custom-button-color'; 
	} else {
		$buttonhover = null;
		$buttoncolor = null;
		$buttonclass = ' normal-button-color';
	}
}

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'call-to-action'.$el_class, $this->settings['base']);
$class = setClass(array($css_class));

$content_call_action =  rawurldecode(base64_decode(strip_tags($content_call_action)));
$call_text_setup = null;

if ($call_action_color=="custom") { $call_text_setup = ' style="color: '.$custom_call_action_color.';"'; }

$output .= '<div'.$class.'>';
$output .= '<div class="call-action-text"><h3'.$call_text_setup.'>'.$content_call_action.'</h3></div>';
$output .= '<div class="call-action-btn">
			<a class="button-main cta'.$buttonclass.$inverted_to.'"'.$buttoncolor.$buttonhover.' href="'.$buttonlink.'"'.$target.'>'.$buttonlabel.'</a>
			</div>';
$output .= '</div>'.$this->endBlockComment('az_call_action');

echo $output;

?>