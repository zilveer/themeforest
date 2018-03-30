<?php
$output = $title = $interval = $el_class = $collapsible = $disable_keyboard = $active_tab = '';
//
extract(shortcode_atts(array(
    'title' => '',
    'interval' => 0,
    'el_class' => '',
    'collapsible' => 'no',
    'disable_keyboard' => 'no',
    'active_tab' => '1'
), $atts));

global $hs_active_tab, $i, $accordion;
$hs_active_tab = $active_tab;
$i = 1;
$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'panel-group' . $el_class . ' not-column-inherit', $this->settings['base'], $atts );

if($collapsible == 'yes'){
	$output .= "\n\t".'<div class="'.$css_class.'" role="tablist" aria-multiselectable="true">';
}else{
	$output .= "\n\t".'<div class="'.$css_class.'" id="accordion" role="tablist" aria-multiselectable="true">';
	$accordion = 'data-parent="#accordion"';
}
$output .= wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_accordion_heading'));
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t".'</div> ';

echo $output;