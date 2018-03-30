<?php
$output = $title =$font_color=$bg_color=$fontColor=$bgColor=$style= '';

extract(shortcode_atts(array(
	'title' => __('Section', 'ninezeroseven'),
	'font_color' => '',
	'bg_color' => ''
), $atts));

if(!empty($bg_color)){
	$bgColor = 'background-color:'.$bg_color.';';
}
if(!empty($font_color)){
	$fontColor = 'color:'.$font_color.';';
}

if(!empty($bg_color) || !empty($fontColor)){
	$style = 'style="'.$bgColor.$fontColor.'"';
}
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion_section group', $this->settings['base'], $atts );
$output .= "\n\t\t\t" . '<div class="'.$css_class.'">';
    $output .= "\n\t\t\t\t" . '<h3 class="wpb_accordion_header ui-accordion-header" '.$style.'><a href="#'.sanitize_title($title).'" '.$style.'>'.$title.'</a></h3>';
    $output .= "\n\t\t\t\t" . '<div class="wpb_accordion_content ui-accordion-content vc_clearfix">';
        $output .= ($content=='' || $content==' ') ? __('Empty section. Edit page to add content here.', 'ninezeroseven') : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
        $output .= "\n\t\t\t\t" . '</div>';
    $output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.wpb_accordion_section') . "\n";

echo !empty( $output ) ? $output : '';