<?php
$output = $title = '';

extract(shortcode_atts(array(
    'title' => __("Section", 'trizzy'),
	'icon' => ''
), $atts));

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion_section group', $this->settings['base'], $atts );
$output .= "\n\t\t\t" . '<div class="'.$css_class.'">';
    
    $output .= '<h5 class="acc-trigger"><a href="#">'.$title.'</a></h5>';
    $output .= "\n\t\t\t\t" . '<div class="acc-container vc_clearfix"><div class="content">';
        $output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", 'trizzy') : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
        $output .= "\n\t\t\t\t" . '</div>';
    $output .= "\n\t\t\t" . '</div></div> ' . $this->endBlockComment('.wpb_accordion_section') . "\n";

echo $output;