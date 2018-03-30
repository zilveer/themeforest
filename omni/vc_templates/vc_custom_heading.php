<?php

/**
 * Shortcode attributes
 * @var $atts
 * @var $source
 * @var $text
 * @var $text_align
 * @var $text_marker
 * @var $marker_align
 * @var $marker_color
 * @var $link
 * @var $google_fonts
 * @var $font_container
 * @var $use_theme_fonts
 * @var $default_font_weight
 * @var $el_class
 * @var $css
 * @var $animated
 * @var $animation_delay
 * @var $font_container_data - returned from $this->getAttributes
 * @var $google_fonts_data   - returned from $this->getAttributes
 * Shortcode class
 * @var $this                WPBakeryShortCode_VC_Custom_heading
 */
$source       = $text = $text_marker = $marker_align = $marker_color = $link = $google_fonts = $font_container = $use_theme_fonts = $default_font_weight = $el_class = $css = $font_container_data = $google_fonts_data = '';
$marker_style = $main_styles = $text_align = $style = '';
// This is needed to extract $font_container_data and $google_fonts_data
extract( $this->getAttributes( $atts ) );

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );

if ( isset( $font_container_data['values']['line_height'] ) && ! empty( $font_container_data['values']['line_height'] ) ) {
	$font_container_data['values']['line_height'] = $font_container_data['values']['line_height'] . 'px';
}
if ( isset( $font_container_data['values']['font_size'] ) && ! empty( $font_container_data['values']['font_size'] ) ) {
	$font_container_data['values']['font_size'] = $font_container_data['values']['font_size'] . 'px';
}
extract( $this->getStyles( $el_class, $css, $google_fonts_data, $font_container_data, $atts ) );

$settings = get_option( 'wpb_js_google_fonts_subsets' );
if ( is_array( $settings ) && ! empty( $settings ) ) {
	$subsets = '&subset=' . implode( ',', $settings );
} else {
	$subsets = '';
}

if ( isset( $animated ) && ! ( 'none' === $animated ) ) {
	$animation_class = 'wow ' . $animated;
} else {
	$animation_class = '';
}

if ( isset( $animation_delay ) && ! empty( $animation_delay ) ) {
	$delay = 'data-wow-delay="' . $animation_delay . 's"';
} else {
	$delay = '';
}

if ( ! ( 'yes' === $use_theme_fonts ) && isset( $google_fonts_data['values']['font_family'] ) ) {
	wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
}

if ( ! empty( $styles ) ) {
	$styles_array = array();
	foreach ( $styles as $single_rule ) {
		$item                     = explode( ':', $single_rule );
		$styles_array[ $item[0] ] = $item[1];
	}
	if ( 'yes' === $use_theme_fonts && ! empty( $default_font_weight ) ) {
		$styles[] = 'font-weight:' . $default_font_weight . '';
	}

	foreach ( $styles_array as $key => $value ) {
		if ( 'color' === $key || 'text-align' === $key ) {
			$wrapper_styles[] = $key . ':' . $value;
		} else {
			$main_styles[] = $key . ':' . $value;
		}
	}

	if ( isset( $wrapper_styles ) && is_array( $wrapper_styles ) ) {
		$wrapper_style = 'style="' . esc_attr( implode( ';', $wrapper_styles ) ) . '"';
	}
	if ( is_array( $main_styles ) ) {
		$style = 'style="' . esc_attr( implode( ';', $main_styles ) ) . '"';
	}
} else {
	$style = '';
}

if ( isset( $marker_color ) && ! empty( $marker_color ) ) {
	$marker_style = 'style="background-color:' . $marker_color . '"';
}

if ( 'post_title' === $source ) {
	$text = get_the_title( get_the_ID() );
}

if ( ! empty( $link ) ) {
	$link = vc_build_link( $link );
	$text = '<a href="' . esc_attr( $link['url'] ) . '"'
	        . ( $link['target'] ? ' target="' . esc_attr( $link['target'] ) . '"' : '' )
	        . ( $link['title'] ? ' title="' . esc_attr( $link['title'] ) . '"' : '' )
	        . '>' . $text . '</a>';
}

$marker_align_class = '';

if ( isset( $text_marker ) && '1' === $text_marker ) {
	if ( 'right' === $marker_align ) {
		$marker_align_class = 'titel-right';
	} elseif ( 'center' === $marker_align ) {
		$marker_align_class = 'titel-top';
	} else {
		$marker_align_class = 'titel-left';
	}
}

if ( isset( $text_align ) && ( 'center' === $text_align ) ) {
	$text_align_class = 'text-center';
	$heading_pre      = '<div class="text-center" ' . $wrapper_style . '>';
	$heading_post     = '</div>';
} elseif ( 'right' === $text_align ) {
	$text_align_class = 'text-right';
	$heading_pre      = '<div class="text-right" ' . $wrapper_style . '>';
	$heading_post     = '</div>';
} else {
	$text_align_class = '';
	$heading_pre      = '<div ' . $wrapper_style . '>';
	$heading_post     = '</div>';
}

$output = '';
if ( apply_filters( 'vc_custom_heading_template_use_wrapper', false ) ) {
	$output .= '<div class="' . esc_attr( $css_class . ' ' . $marker_align_class . ' ' . $text_align_class . ' ' . $animation_class ) . '" ' . $delay . '>';
	$output .= '<' . $font_container_data['values']['tag'] . ' ' . $style . ' >';
	$output .= '<span class="titel-line" ' . $marker_style . '></span>';
	$output .= $text;
	$output .= '</' . $font_container_data['values']['tag'] . '>';
	$output .= '</div>';
} else {

	$output .= $heading_pre;
	$output .= '<' . $font_container_data['values']['tag'] . ' class="' . esc_attr( $css_class . ' ' . $marker_align_class . ' ' . $animation_class ) . '" ' . $style . ' ' . $delay . '>';
	$output .= '<span class="titel-line" ' . $marker_style . '></span>';
	$output .= $text;
	$output .= '</' . $font_container_data['values']['tag'] . '>';
	$output .= $heading_post;
}

echo $output;
