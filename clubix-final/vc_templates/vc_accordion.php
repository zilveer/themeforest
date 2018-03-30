<?php
wp_enqueue_script('jquery-ui-accordion');
$output = $title = $interval = $el_class = $type = $collapsible = $active_tab = '';
//
extract(shortcode_atts(array(
    'title' => '',
    'interval' => 0,
    'el_class' => '',
    'collapsible' => 'no',
    'active_tab' => '1',
    'type' => 'default',
), $atts));

$acc_ID = ++Haze_Shortcodes::get_instance()->accordion_instance['id'];
Haze_Shortcodes::get_instance()->accordion_instance['type'] = $type;
Haze_Shortcodes::get_instance()->accordion_instance['tab_id'] = 0;

$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion wpb_content_element ' . $el_class . ' not-column-inherit', $this->settings['base'], $atts );

$output .= '<div class="panel-group '.$el_class.'" id="accordion-0'.$acc_ID.'">';
$output .= wpb_js_remove_wpautop($content);
$output .= '</div>';

echo $output;