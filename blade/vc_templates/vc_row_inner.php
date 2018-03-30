<?php

	$output = '';

	extract(
		shortcode_atts(
			array(
				'el_class'        => '',
				'el_id'        => '',
				'css' => '',
			),
			$atts
		)
	);

	$row_classes = array( 'grve-row' );

	$css_custom = blade_grve_vc_shortcode_custom_css_class( $css, '' );
	if ( !empty( $css_custom ) ) {
		$row_classes[] = $css_custom;
	}
	if ( !empty ( $el_class ) ) {
		$row_classes[] = $el_class;
	}
	$row_css_string = implode( ' ', $row_classes );

	$wrapper_attributes = array();

	if ( !empty ( $el_id ) ) {
		$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
	}
	$wrapper_attributes[] = 'class="' . esc_attr( $row_css_string ) . '"';

	$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
	$output	.= do_shortcode( $content );
	$output	.= '</div>';


	print $output;

//Omit closing PHP tag to avoid accidental whitespace output errors.
