<?php
$output = '';
extract(shortcode_atts(array(
	'title' => '',
	'font_size' => '16',
	'line_height' => '16',
	'margin_bottom' => '10',
	'font_weight' => 'inherit',
	'icon' => 'mk-li-smile',
	'desc' => '',
), $atts));

if (!empty($icon)) {
	$icon = (strpos($icon, 'mk-') !== FALSE) ? ($icon) : ('mk-' . $icon);
} else {
	$icon = '';
}

$tab_id = hash('adler32', $title . $icon);

$output .= '<div id="' . $tab_id . '" class="mk-step">';
$output .= '<i class="step-icon ' . $icon . '"></i>';
$output .= '<div class="step-holder">';
$output .= '<div class="step-title" style="font-size:'.$font_size.'px; font-weight:'.$font_weight.'; line-height:'.$line_height.'px; margin-bottom:'.$margin_bottom.'px;">' . $title . '</div>';
$output .= '<span class="step-desc">' . $desc . '</span>';
$output .= '<p class="step-desc-responsive">' . $desc . '</p>';
$output .= '<div class="step-content">' . wpb_js_remove_wpautop($content, true) . '</div>';
$output .= '</div>';
$output .= '</div>';
echo $output;
