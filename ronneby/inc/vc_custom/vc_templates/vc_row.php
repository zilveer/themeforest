<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$output = $el_class = $full_width = $full_height = $content_placement = $columns_placement = $row_effect = $row_sort_panel = $bg_check = $force_equal_height_columns = $align_content_vertically = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = $data_attr = $one_page_title = $one_page_title_text = $row_id = $row_prebuilt_classes = $overlay_html = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);
if  ($dfd_row_config) {
	$el_class .= ' '.$dfd_row_config;
}

if  ($bg_check == 'row-background-dark') {
	$el_class .= ' dfd-background-dark';
}

if  ($row_effect != '') {
	$el_class .= ' '.$row_effect;
}

if  (strcmp($force_equal_height_columns, 'main_row') === 0) {
	$el_class .= ' equal-height-columns';
}

if  ($mobile_destroy_equal_heights == 'yes') {
	$el_class .= ' mobile-destroy-equal-heights';
}

if  ($align_content_vertically == 'yes') {
	$el_class .= ' aligh-content-verticaly';
}

if  (isset($dfd_row_parallax) && !empty($dfd_row_parallax) && $dfd_row_parallax == 'on') {
	$el_class .= ' '.$dfd_row_parallax;
}

if ( ! empty( $full_height ) ) {
	$el_class .= ' dfd-row-full-height';
	if ( ! empty( $content_placement ) ) {
		$el_class .= ' dfd-row-content-' . $content_placement;
	}
	if ( ! empty( $columns_placement ) ) {
		$el_class .= ' dfd-row-content-' . $columns_placement;
	}
}

if  (isset($row_parallax_sense) && !empty($row_parallax_sense)) {
	$data_attr .= 'data-parallax_sense="'.esc_attr($row_parallax_sense).'"';
}

if  (isset($row_parallax_limit) && !empty($row_parallax_limit)) {
	$data_attr .= ' data-parallax_limit="'.esc_attr($row_parallax_limit).'"';
}

/*
if(isset($row_sort_panel) && strcmp($row_sort_panel, 'dfd-sort-columns') == 0) {
	wp_enqueue_script('isotope');
}
*/
if  (isset($one_page_title) && !empty($one_page_title)) {
	$one_page_title_text .= $one_page_title;
}
$data_attr .= ' data-dfd-dots-title="'.esc_attr($one_page_title_text).'"';

if  (isset($anchor) && !empty($anchor)) {
	$row_id .= 'id="'.esc_attr($anchor).'"';
}

if  (isset($row_prebuilt_classes) && !empty($row_prebuilt_classes)) {
	$el_class .= ' '.$row_prebuilt_classes;
}

if  (isset($row_responsive_mobile_classes) && !empty($row_responsive_mobile_classes)) {
	$row_responsive_mobile_classes = str_replace(',',' ', $row_responsive_mobile_classes );
	$el_class .= ' '.$row_responsive_mobile_classes;
}

if  (isset($row_responsive_mobile_resolutions) && !empty($row_responsive_mobile_resolutions)) {
	$row_responsive_mobile_resolutions = str_replace(',',' ', $row_responsive_mobile_resolutions );
	$el_class .= ' '.$row_responsive_mobile_resolutions;
}

if($dfd_enable_overlay) {
	if(isset($dfd_overlay_color) && !empty($dfd_overlay_color)) {
		$overlay_html .= 'background-color: '.esc_attr($dfd_overlay_color).';';
	}
	if(isset($dfd_overlay_pattern) && !empty($dfd_overlay_pattern)) {
		$overlay_html .= 'background-image: url('.get_template_directory_uri().'/inc/vc_custom/dfd_vc_background/patterns/'.esc_attr($dfd_overlay_pattern).');';
	}
	if(isset($dfd_overlay_pattern_opacity) && !empty($dfd_overlay_pattern_opacity)) {
		$overlay_html .= 'opacity: '.esc_attr($dfd_overlay_pattern_opacity/100).';';
	}
	if(isset($dfd_overlay_pattern_size) && !empty($dfd_overlay_pattern_size)) {
		$overlay_html .= 'background-size: '.esc_attr($dfd_overlay_pattern_size).'px;';
	}
	if(!empty($overlay_html))
		$overlay_html = '<div class="dfd-row-bg-overlay" style="'.$overlay_html.'"></div>';
}

$available_delimiters = dfd_vc_delimiter_styles();
$delimiter_class = $delimiter_html = $delimiter_css = '';
if  ($row_delimiter != '' && in_array($row_delimiter, $available_delimiters)) {
	$delim_bg_color = !empty($color) ? $color : 'white';
	$delimiter_class .= ' vc-row-delimiter-'.$row_delimiter;
	$delimiter_html .= '<div class="'.esc_attr($delimiter_class).'">';
	switch($row_delimiter) {
		case 4:
			$delimiter_html .= '<div class="vc-row-delimiter-bottom"></div>';
			break;
		case 5:
			$delimiter_html .= '<div class="vc-row-delimiter-bottom">'
									.'<div class="vc-row-delimiter-bottom-left"></div>'
									.'<div class="vc-row-delimiter-bottom-right"></div>'
							.'</div>';
			break;
		case 6:
			$delimiter_html .= '<div class="vc-row-delimiter-top">'
									.'<div class="vc-row-delimiter-top-left"></div>'
									.'<div class="vc-row-delimiter-top-right"></div>'
							.'</div>';
			break;
		case 7:
			$delimiter_html .= '<div class="vc-row-delimiter-top">'
									.'<div class="vc-row-delimiter-top-left"></div>'
									.'<div class="vc-row-delimiter-top-right"></div>'
							.'</div>';
			$delimiter_html .= '<div class="vc-row-delimiter-bottom">'
									.'<div class="vc-row-delimiter-bottom-left"></div>'
									.'<div class="vc-row-delimiter-bottom-right"></div>'
							.'</div>';
			break;
		case 12:
			if(isset($delimiter_bg_color_value) && !empty($delimiter_bg_color_value)) {
				$delimiter_css .= 'background: '. $delimiter_bg_color_value .'; ';
			}
			if(isset($delimiter_height) && !empty($delimiter_height)) {
				$delimiter_css .= 'height: '. $delimiter_height .'px; margin-top: -'. $delimiter_height/2 .'px;';
			}
			$delimiter_html .= '<div class="dfd-delimiter-line" style="'. $delimiter_css .'"></div>';
			break;
	}
	$delimiter_html .= '</div>';
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc-row-wrapper wpb_row ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts ) );

$custom_styles = !empty($extra_css_styles) ? 'style="'.esc_attr($extra_css_styles).'"' : '';

$output .= '<div '.$row_id.' class="'.esc_attr($css_class).'" '.$data_attr.'>';
$output .= '<div class="row" '.$custom_styles.'>';
$output .= wpb_js_remove_wpautop($content);
$output .= '</div>';
$output .= $delimiter_html;

if(isset($dfd_bg_style) && !empty($dfd_bg_style)) {
	$file = locate_template('inc/vc_custom/dfd_vc_background/front_templates/') . $dfd_bg_style . '.php';
	if(file_exists($file)) {
		include($file);
	}
}

$output .= $overlay_html;

$output .= '</div>'.$this->endBlockComment('row');

echo $output;