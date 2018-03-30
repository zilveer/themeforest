<?php
		$atts = extract( shortcode_atts(
				array(
					'size'          => '',
					'percent'       => '',
					'line_width'    => '',
					'track_color'   => '',
					'bar_color'     => '',
					'ending'        => '',
					'backing_color' => '',
					'backing_size'  => '',
					'font_color'    => '',
					'font_size'     => '',
					'margin_bottom' => ''
				), $atts ) );

		$data_tags = ' ';
		$data_array = array(
			'size'        => ( is_numeric( $size) ) ? $size : 130,
			'percent'     => ( is_numeric( $percent ) ) ? $percent : 76,
			'line-width'  => ( is_numeric( $line_width ) ) ? $line_width  : 7,
			'track-color' => ( !empty( $track_color ) ) ? $track_color : '#eee' ,
			'bar-color'   => ( !empty( $bar_color ) ) ? $bar_color : '#fa8322',
			'line-cap'    => 'square',
			'animate'     => 1500
		);

		foreach ( $data_array as $key => $value ) {

			if ( !empty( $value ) && is_numeric( $value ) ) {
				$data_tags .='data-'.$key.'="'.$value.'" ';
			}elseif ( !empty( $value ) ) {
				$data_tags .='data-'.$key.'="'.esc_attr( $value ).'" ';
			}
		}
		$styleArray = array(
			'width'         => (!empty($size) && $size != '130') ? $size : '',
			'height'        => (!empty($size) && $size != '130') ? $size : '',
			'color'         => $font_color,
			'font-size'     => $font_size,
			'margin-bottom' => $margin_bottom
			);

		$chart_style = wbc_generate_css( $styleArray );

		$styleArray = array(
			'width'            => (!empty($backing_size) && $backing_size != '100') ? $backing_size : '',
			'height'           => (!empty($backing_size) && $backing_size != '100') ? $backing_size : '',
			'background-color' => $backing_color
		);

		$backing_style = wbc_generate_css( $styleArray );
		
		$ending_char = ( !empty( $ending ) ) ? $ending : '%';

		$html  = '<div class="wbc-chart-wrap">';
		$html .= '<div class="wbc-pie-chart" '.$chart_style.'>';
		$html .= '<span class="chart chart-start" '.$data_tags.'>';
		if($backing_size != '0') $html .= '<span class="percent-backing" '.$backing_style.'></span>';
		$html .= '<span class="percent-wrap">';
		$html .= '<span class="percent" data-ending="'.esc_attr($ending_char).'">0</span>';
		$html .= '</span>';
		$html .= '</span>';
		$html .= '</div>';
		$html .= '</div>';


	echo !empty( $html ) ? $html :'';

?>