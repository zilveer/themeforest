<?php
$output = $lead = $text_color = $font_size = $line_height = $responsive_font = $font_size_xs = $line_height_xs =
	$font_size_sm = $line_height_sm = $font_size_md = $line_height_md = $font_weight = $el_class = $animation = $css_animation = '';

extract(shortcode_atts(array(
    'el_class' => '',
    'lead' => false,
	'text_color' => '',
    'font_size' => '',
	'line_height' => '',
	'responsive_font' => '',
	'font_size_xs' => '',
	'line_height_xs' => '',
    'font_size_sm' => '',
	'line_height_sm' => '',
    'font_size_md' => '',
    'line_height_md' => '',
    'font_weight' => '',
    'animation' => '',
    'css_animation' => 'right-to-left',
    'css' => ''
), $atts));

$el_class = $this->getExtraClass($el_class);

if ( version_compare(WPB_VC_VERSION, '4.4' ) >= 0) {
    $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'kleo_text_column wpb_content_element ' . $el_class . vc_shortcode_custom_css_class($css, ' '), $this->settings['base'], $atts);
} else {
    $css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'kleo_text_column wpb_content_element ' . $el_class, $this->settings['base'], $atts);
}

if ( $animation != '' ) {
	wp_enqueue_script( 'waypoints' );
	$css_class .= " animated {$animation} {$css_animation}";
}

if( $lead ) {
	$css_class .= ' lead';
}

/* Custom inline styles */
$style_inline = '';
$styles = '';

if ( $font_size != '' ) {
	$styles .= ' font-size:' . kleo_set_default_unit( $font_size ) . ';';
}
if ( $line_height != '' ) {
	$styles .= ' line-height:' . kleo_set_default_unit( $line_height ) . ';';
}
if ( $font_weight && $font_weight != 'normal' ) {
	$styles .= ' font-weight:' . $font_weight . ';';
}
if ( $text_color != '' ) {
	$styles .= ' color:' . $text_color . ';';
}

if ( $styles != '' ) {
	$style_inline = ' style="' . $styles . '"';
}

/* Responsive text */
$text_data = '';
if ( $responsive_font == 'yes' ) {
	$text_id = uniqid();
	$text_css = '';
	$text_el = '[data-uid="'. $text_id .'"]';

	if ( $font_size_xs != '' || $line_height_xs != '' ) {
		$text_css .= '@media (max-width: 767px) { ' .
		             $text_el . '{';

		if ($font_size_xs != '') {
			$text_css .= 'font-size: '. kleo_set_default_unit( $font_size_xs ). ' !important;';
		}

		if ( $line_height_xs != '' ) {
			$text_css .= 'line-height: '. kleo_set_default_unit( $line_height_xs ). ' !important;';
		}
		$text_css .=  '} }';
	}

	if ( $font_size_sm != '' || $line_height_sm != '' ) {
		$text_css .= '@media (min-width: 768px) and (max-width: 991px) { ' .
		             $text_el . '{';

		if ($font_size_sm != '') {
			$text_css .= 'font-size: '. kleo_set_default_unit( $font_size_sm ). ' !important;';
		}

		if ( $line_height_sm != '' ) {
			$text_css .= 'line-height: '. kleo_set_default_unit( $line_height_sm ). ' !important;';
		}
		$text_css .=  '} }';
	}

	if ( $font_size_md != '' || $line_height_md != '' ) {
		$text_css .= '@media (min-width: 992px) and (max-width: 1199px) { ' .
		             $text_el . '{';

		if ($font_size_md != '') {
			$text_css .= 'font-size: '. kleo_set_default_unit( $font_size_md ). ' !important;';
		}

		if ( $line_height_md != '' ) {
			$text_css .= 'line-height: '. kleo_set_default_unit( $line_height_md ). ' !important;';
		}
		$text_css .=  '} }';
	}

	$text_data = ' data-uid="' . $text_id . '"';
	echo  '<style>' . $text_css . '</style>';
}

$output .= "\n\t".'<div class="' . $css_class . '"' . $style_inline . $text_data . '>';
$output .= "\n\t\t".'<div class="wpb_wrapper">';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content, true);
$output .= "\n\t\t".'</div> ' . $this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> ' . $this->endBlockComment('.wpb_text_column');

echo $output;