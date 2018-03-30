<?php
		$atts = extract( shortcode_atts(
				array(
					'count_from'    => '0',
					'count_to'      => '793',
					'count_speed'   => '2000',
					'interval'      => '10',
					'heading_style' => '',

					'delimiter'   => '',
					'before'      => '',
					'after'       => '',
					
					'color'       => '',
					'font_size'   => '',
					'm_bottom'    => '',
					'm_top'       => '',
				), $atts ) );

		$styleArray = array(
			'font-size'     => $font_size,
			'color'         => $color,
			'margin-bottom' => $m_bottom,
			'margin-top'    => $m_top,
		);

		$style = wbc_generate_css( $styleArray );


		$data_tags = ' ';

		$data_array = array(
			'from'             => ( is_numeric( $count_from ) ) ? $count_from : 0,
			'to'               => ( is_numeric( $count_to ) ) ? $count_to : 793,
			'speed'            => ( is_numeric( $count_speed ) ) ? $count_speed : 2000,
			'refresh-interval' => ( is_numeric( $interval ) ) ? $interval : 10,
			'delimiter'        => $delimiter,
		);

		foreach ( $data_array as $key => $value ) {

			if ( !empty( $value ) && is_numeric( $value ) ) {
				$data_tags .='data-'.$key.'="'.$value.'" ';
			}elseif ( !empty( $value ) ) {
				$data_tags .='data-'.$key.'="'.esc_attr( $value ).'" ';
			}
		}

		$heading_class = ( !empty( $heading_style ) ) ? ' special-'.$heading_style : '';
		
		$html  = '<div class="wbc-countup-wrapper'. esc_attr( $heading_class ) .'" '.$style.'>';
		$html .= $before;
		$html .= '<span class="wbc-countup count-start" '.$data_tags.'>';
		$html .= $count_from;
		$html .= '</span>';
		$html .= $after;
		$html .= '</div>';

	echo !empty( $html ) ? $html :'';

?>