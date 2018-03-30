<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $layout_style
 * @var $i_type
 * @var $i_icon_image
 * @var $title
 * @var $el_class
 * @var $value
 * @var $units
 * @var $color
 * @var $custom_color
 * @var $value_color
 * @var $label_value
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_Vc_Pie
 */
$title = $iconClass = $layout_style = $i_type = $i_icon_image = $el_class = $value = $units = $color = $custom_color = $value_color = $label_value = $css = '';
$atts = $this->convertOldColorsToNew($atts);
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);
global $g5plus_options;
$min_suffix = (isset($g5plus_options['enable_minifile_js']) && $g5plus_options['enable_minifile_js'] == 1) ? '.min' : '';
wp_enqueue_script('handmade_vc_pie_chart_js', THEME_URL . 'assets/vc-extend/js/jquery.vc_chart' . $min_suffix . '.js', array(), false, true);
wp_enqueue_style('handmade_vc_pie_chart_css', THEME_URL . 'assets/vc-extend/css/vc_chart' . $min_suffix . '.css', array(), false);

$colors = array(
    'blue' => '#5472d2',
    'turquoise' => '#00c1cf',
    'pink' => '#fe6c61',
    'violet' => '#8d6dc4',
    'peacoc' => '#4cadc9',
    'chino' => '#cec2ab',
    'mulled-wine' => '#50485b',
    'vista-blue' => '#75d69c',
    'orange' => '#f7be68',
    'sky' => '#5aa1e3',
    'green' => '#6dab3c',
    'juicy-pink' => '#f4524d',
    'sandy-brown' => '#f79468',
    'purple' => '#b97ebb',
    'black' => '#2a2a2a',
    'grey' => '#ebebeb',
    'white' => '#ffffff'
);

if ('custom' === $color) {
    $color = $custom_color;
} else {
    $color = isset($colors[$color]) ? $colors[$color] : '';
}

if (!$color) {
    $color = $colors['grey'];
}
if ($i_type != '' && $i_type != 'image') {
    vc_icon_element_fonts_enqueue($i_type);
    $iconClass = isset(${"i_icon_" . $i_type}) ? esc_attr(${"i_icon_" . $i_type}) : '';
}
$pie_type = ($layout_style == 'pie_icon') ? 1 : 0;
$class_to_filter = 'vc_pie_chart wpb_content_element';
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ') . $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);
$output = '<div class="handmade-pie-chart ' . $layout_style . '">';
$output .= '<div class= "handmade-pie-chart-circle ' . esc_attr($css_class) . '" data-pie-value="' . esc_attr($value) . '" data-pie-label-value="' . esc_attr($label_value) . '" data-pie-units="' . esc_attr($units) . '" data-pie-color="' . esc_attr($color) . '" data-pie-icon="' . esc_attr($pie_type) . '">';
$output .= '<div class="wpb_wrapper">';
$output .= '<div class="vc_pie_wrapper">';
$output .= '<span class="vc_pie_chart_back" style="border-color: ' . esc_attr($color) . '"></span>';
if ($layout_style != 'pie_icon') {
    $output .= "\n\t\t\t" . '<span style="color: ' . esc_attr($value_color) . '" class="vc_pie_chart_value"></span>';
} else {
    $output .= "\n\t\t\t" . '<span class="vc_pie_chart_value">';
    if ($i_type != '') {
        if ($i_type == 'image') {
            $img = wp_get_attachment_image_src($i_icon_image, 'full');
            $output .= '<img src="' . esc_attr($img[0]) . '"/>';
        } else {
            $output .= '<i style="color: ' . esc_attr($value_color) . '"  class="' . esc_attr($iconClass) . '"></i>';
        }
    }
    $output .= '</span>';
}
$output .= '<canvas width="101" height="101"></canvas>';
$output .= '</div></div></div>';

if ($title != '') {
    $output .= '<h6 class="pie-chart-title">' . esc_html($title) . '</h6>';
}
$output .= '</div>';

echo !empty($output) ? $output : '';