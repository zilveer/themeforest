<?php
$atts = extract( shortcode_atts(
 				array(
 					'button_text'        => 'Button',
 					'align_button' =>'',

 					//Default State
 					'color'              => '',
 					'bg_color'           => '',
 					'border_color'       => '',
 					'el_class'           => '',

 					//Hover State
 					'hover_color'        => '',
 					'hover_bg_color'     => '',
 					'hover_border_color' => '',

 					'font_size'          => '',
 					'line_height'        => '',

 					'border_radius'      => '',
 					'border_width'       => '',
 					'width'              => '',
 					'link'               => '',

 					//Spacing
 					'margin_bottom'      => '',
 					'margin_top'         => '',
 					'margin_right'       => '',
 					'margin_left'        => '',

 					'padding_bottom'     => '',
 					'padding_top'        => '',
 					'padding_right'      => '',
 					'padding_left'       => '',

 				), $atts ) );

 		$link = wbc_build_link( $link );

 		if ( isset( $link['url'] ) && empty( $link['url'] ) ) {
 			$link['url'] = '#';
 		}

 		if ( !empty( $color ) ) {
 			$color = $color.' !important';
 		}

 		//Style
 		$border_color = ( !empty( $border_color ) ) ? $border_color : $bg_color;

 		$styleArray = array(
 			'font-size'        => $font_size,
 			'color'            => $color,
 			'border-radius'    => $border_radius,
 			'background-color' => $bg_color,
 			'border-width'     => $border_width,
 			'border-color'     => $border_color,
 			'width'            => $width,
 			'line-height'      => $line_height,
 			'margin-bottom'    => $margin_bottom,
 			'margin-right'     => $margin_right,
 			'margin-top'       => $margin_top,
 			'margin-left'      => $margin_left,
 			'padding-bottom'    => $padding_bottom,
 			'padding-right'     => $padding_right,
 			'padding-top'       => $padding_top,
 			'padding-left'      => $padding_left,
 		);

 		$style = wbc_generate_css( $styleArray );

 		$data_tags = ' ';
 		$data_array = array(
 			'hover-text'   => $hover_color,
 			'hover-bg'     => $hover_bg_color,
 			'hover-border' => $hover_border_color,
 		);
 		foreach ( $data_array as $key => $value ) {

 			if ( !empty( $value ) ) {
 				$data_tags .='data-'.$key.'="'.$value.'" ';
 			}
 		}

 		$html  = '';
 		if ( !empty( $el_class ) ) $el_class = ' '.$el_class;

 		$classes = 'wbc-button button btn-primary'.$el_class;

 		if ( empty( $data_tags ) || $data_tags == ' ' ) {
 			$classes = $classes.' no-hover';
 		}

 		if ( isset( $link['url'] ) && !empty( $link['url'] ) ) {
 			$target = ( isset( $link['target'] ) && !empty( $link['target'] ) ) ? $link['target'] : '_self';
 			$html = '<a '.$style.' class="'.esc_attr( $classes ).'" href="'.esc_url( $link['url'] ).'" target="'.trim( esc_attr( $target ) ).'" '.$data_tags.'>'.$button_text.'</a>';
 		}

 		if ( !empty( $align_button ) ) {
 			$html = '<div style="text-align:'.esc_attr( $align_button ).'">'.$html.'</div>';
 		}

	echo !empty( $html ) ? $html :'';

?>