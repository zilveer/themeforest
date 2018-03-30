<?php
$output = $title = '';

extract(shortcode_atts(array(
	'title' => __("Title", "richer-framework"),
	'icon' => '',
), $atts));
if($icon != '') {
	$acc_icon_pos = 'fright';
	$icon = '<i class="icon fa '.$icon.'"></i>';
} else {
	$acc_icon_pos = 'fleft';
	$icon = '';
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'acc-group', $this->settings['base'], $atts );
$output .='<div class="'.$css_class.'">';
	$output .= '<div class="accordion-title">';
    	$output .= '<div class="acc-icon '.$acc_icon_pos.'"><i class="fa fa-plus"></i></div>';
    	$output .= '<span>'. $icon .$title.'</span>';
    $output .= '</div>';
    $output .= '<div class="accordion-inner"><div class="content">';
        $output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "js_composer") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
    $output .= '</div></div>';
$output .= '</div> ' . $this->endBlockComment('.wpb_accordion_section') . "\n";

echo $output;