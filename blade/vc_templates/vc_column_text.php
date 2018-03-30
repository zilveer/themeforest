<?php

	extract(
		shortcode_atts(
			array(
				'text_style' => '',
				'animation' => '',
				'animation_delay' => '200',
				'el_class' => '',
				'css' => '',
			),
			$atts
		)
	);

	if ( !empty( $animation ) ) {
		$animation = 'grve-' .$animation;
	}

	$text_classes = array( 'grve-element', 'grve-text' );
	$css_custom = blade_grve_vc_shortcode_custom_css_class( $css, '' );

	if ( !empty( $text_style ) ) {
		$text_classes[] = 'grve-' . $text_style;
	}
	if ( !empty( $el_class ) ) {
		$text_classes[] = $el_class;
	}
	if ( !empty( $css_custom ) ) {
		$text_classes[] = $css_custom;
	}
	if ( !empty( $animation ) ) {
		$text_classes[] = 'grve-animated-item';
		$text_classes[] = $animation;
	}
	$text_class_string = implode( ' ', $text_classes );

	$wrapper_attributes = array();
	$wrapper_attributes[] = 'class="' . esc_attr( $text_class_string ) . '"';
	if ( !empty( $animation ) ) {
		$wrapper_attributes[] = 'data-delay="' . esc_attr( $animation_delay ) . '"';
	}

	$content = wpautop(preg_replace('/<\/?p\>/', "\n", $content)."\n");

	echo '<div ' . implode( ' ', $wrapper_attributes ) . '>
			' . do_shortcode( shortcode_unautop( $content ) ) . '
		</div>
	';

//Omit closing PHP tag to avoid accidental whitespace output errors.
