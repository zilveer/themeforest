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
 * @var $bar_color
 * @var $bar_custom_color
 * @var $color
 * @var $custom_color
 * @var $value_color
 * @var $label_value
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_Vc_Pie
 */
$bar_color=$bar_custom_color = $iconClass = $layout_style = $i_type = $i_icon_image = $el_class = $value = $units = $color = $custom_color = $value_color = $label_value = $css = '';
$atts = $this->convertOldColorsToNew($atts);
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);
$g5plus_options = &G5Plus_Global::get_options();
$min_suffix_js = (isset($g5plus_options['enable_minifile_js']) && $g5plus_options['enable_minifile_js'] == 1) ? '.min' : '';
$min_suffix_css = (isset($g5plus_options['enable_minifile_css']) && $g5plus_options['enable_minifile_css'] == 1) ? '.min' : '';

wp_enqueue_script('academia_vc_pie_chart_js', G5PLUS_THEME_URL . 'assets/vc-extend/js/jquery.vc_chart' . $min_suffix_js . '.js', array(), false, true);
wp_enqueue_style('academia_vc_pie_chart_css', G5PLUS_THEME_URL . 'assets/vc-extend/css/vc_chart' . $min_suffix_css . '.css', array(), false);
$primary_color='';
if (isset($g5plus_options['primary_color']) && ! empty($g5plus_options['primary_color'])) {
    $primary_color = $g5plus_options['primary_color'];
}
if (empty($primary_color)) {
    $primary_color = '#9261aa';
}
$secondary_color='';
if (isset($g5plus_options['secondary_color']) && ! empty($g5plus_options['secondary_color'])) {
    $secondary_color = $g5plus_options['secondary_color'];
}
if (empty($secondary_color)) {
    $secondary_color = '#ffbd33';
}
$tertiary_color='';
if (isset($g5plus_options['tertiary_color']) && ! empty($g5plus_options['tertiary_color'])) {
    $tertiary_color = $g5plus_options['tertiary_color'];
}
if (empty($tertiary_color)) {
    $tertiary_color = '#30a8cc';
}
$colors = array(
    'p-color' => $primary_color,
    's-color' => $secondary_color,
    't-color' => $tertiary_color,
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
if ('bar_custom' === $bar_color) {
    $bar_color = $bar_custom_color;
} else {
    $bar_color = isset($colors[$bar_color]) ? $colors[$bar_color] : '';
}

if (!$bar_color) {
    $bar_color = $colors['grey'];
}
if ($i_type != '' && $i_type != 'image') {
    vc_icon_element_fonts_enqueue($i_type);
    $iconClass = isset(${"i_icon_" . $i_type}) ? esc_attr(${"i_icon_" . $i_type}) : '';
}
$pie_type = ($layout_style == 'pie_icon') ? 1 : 0;
$class_to_filter = 'vc_pie_chart wpb_content_element';
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ') . $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);
$output = '<div class= "pie-chart ' . $layout_style . ' ' . esc_attr($css_class) . '" data-pie-value="' . esc_attr($value) . '" data-pie-label-value="' . esc_attr($label_value) . '" data-pie-units="' . esc_attr($units) . '" data-pie-color="' . esc_attr($color) . '" data-pie-icon="' . esc_attr($pie_type) . '">';
$output .= '<div class="wpb_wrapper">';
$output .= '<div class="vc_pie_wrapper">';
$output .= '<span class="vc_pie_chart_back" style="border-color: ' . esc_attr($bar_color) . '"></span>';
if ($layout_style != 'pie_icon') {
    $output .= "\n\t\t\t" . '<span style="color: ' . esc_attr($value_color) . '" class="vc_pie_chart_value"></span>';
} else {
    $output .= "\n\t\t\t" . '<span class="vc_pie_chart_value">';
    if ($i_type != '') {
        if ($i_type == 'image') {
            $img = wp_get_attachment_image_src($i_icon_image, 'full');
            $output .= '<img alt="PieChart" src="' . esc_attr($img[0]) . '"/>';
        } else {
            $output .= '<i style="color: ' . esc_attr($value_color) . '"  class="' . esc_attr($iconClass) . '"></i>';
        }
    }
    $output .= '</span>';
}
$output .= '<canvas width="101" height="101"></canvas>';
$output .= '</div></div></div>';

echo !empty($output) ? $output : '';