<?php
wp_enqueue_script('jquery-ui-accordion');
$output = $title = $interval = $el_class = $collapsible = $active_tab = '';
//
extract(shortcode_atts(array(
    'title' => '',
    'interval' => 0,
    'el_class' => '',
    'collapsible' => 'no',
    'active_tab' => '1'
), $atts));

$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_content_element '.$el_class.' not-column-inherit', $this->settings['base']);

if($collapsible != 'no') {
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_content_element toggles '.$el_class.' not-column-inherit', $this->settings['base']);
}

$output .= '<h3 class="no-margin-top">'. $title .'</h3>';  
$output .= "\n\t".'<ul class="accordions '.$css_class.'">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t".'</ul> '.$this->endBlockComment('.accordions');
echo $output;

