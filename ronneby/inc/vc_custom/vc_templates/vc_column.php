<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
$output = $font_color = $el_class = $width = $offset = $sort_panel_group = $column_responsive_mobile_classes = '';
/*extract(shortcode_atts(array(
    'el_class' => '',
    'width' => '1/1',
    'css' => '',
	'offset' => '',
    'column_prebuilt_classes' => '',
    'column_bg_check' => '',
    //'sort_panel_group' => 'uncategoriesed',
	'column_parallax'      => '',
	'column_parallax_sense'      => '',
	'column_parallax_limit'      => '',
), $atts));*/

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);
$width = wpb_translateColumnWidthToSpan($width);
$width = str_replace('vc_col-xs-','', $width );
$width = str_replace('vc_col-sm-','', $width );
$width = str_replace('vc_col-md-','', $width );
$width = str_replace('vc_col-lg-','', $width );
$offset = str_replace('vc_col-xs-','dfd_col-mobile-', $offset );
$offset = str_replace('vc_col-sm-','dfd_col-tablet-', $offset );
$offset = str_replace('vc_col-md-','dfd_col-laptop-', $offset );
$offset = str_replace('vc_col-lg-','dfd_col-tabletop-', $offset );
$offset = str_replace('vc_hidden-xs','dfd_vc_hidden-xs', $offset );
$offset = str_replace('vc_hidden-sm','dfd_vc_hidden-sm', $offset );
$offset = str_replace('vc_hidden-md','dfd_vc_hidden-md', $offset );
$offset = str_replace('vc_hidden-lg','dfd_vc_hidden-lg', $offset );
$width = dfd_vc_columns_to_string($width);
$width = vc_column_offset_class_merge($offset, $width);

$el_class .= ' columns';

if  (isset($column_prebuilt_classes) && !empty($column_prebuilt_classes)) {
	$el_class .= ' '.$column_prebuilt_classes;
}

if  (isset($column_responsive_mobile_classes) && !empty($column_responsive_mobile_classes)) {
	$column_responsive_mobile_classes = str_replace(',',' ', $column_responsive_mobile_classes );
	$el_class .= ' '.$column_responsive_mobile_classes;
}

if  (isset($column_responsive_mobile_resolutions) && !empty($column_responsive_mobile_resolutions)) {
	$column_responsive_mobile_resolutions = str_replace(',',' ', $column_responsive_mobile_resolutions );
	$el_class .= ' '.$column_responsive_mobile_resolutions;
}

if  (isset($column_bg_check) && strcmp($column_bg_check, 'column-background-dark') === 0) {
	$el_class .= ' dfd-background-dark';
}

if  (isset($column_parallax) && !empty($column_parallax)) {
	$el_class .= ' '.$column_parallax;
}

$data_attr = '';

if  (isset($column_parallax_sense) && !empty($column_parallax_sense)) {
	$data_attr .= 'data-parallax_sense="'.esc_attr($column_parallax_sense).'"';
}

if  (isset($column_parallax_limit) && !empty($column_parallax_limit)) {
	$data_attr .= ' data-parallax_limit="'.esc_attr($column_parallax_limit).'"';
}

//$data_attr .= 'data-category="'.esc_attr($sort_panel_group).'"';

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$output .= "\n\t".'<div class="'.$css_class.'" '.$data_attr.'>';
$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> '.$this->endBlockComment($el_class) . "\n";

echo $output;