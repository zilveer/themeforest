<?php
		$atts = extract( shortcode_atts(
				array(
					//Title
					'title'             => esc_html__('Title', 'ninezeroseven' ),
					'title_font_size'   => '',
					'title_color'       => '',
					//Percent
					'percent'           => '50',
					'percent_color'     => '',
					'percent_font_size' => '',
					'bar_height'        => '',
					'bar_color'         => '',
					'bg_color'          => '',
					'bg_spacing'        => '',
					'border_radius'     => ''
				), $atts ) );


		$data_tags = ' ';
		$data_array = array(
			'percent'  => (is_numeric($percent)) ? $percent : 0,
		);
		foreach ( $data_array as $key => $value ) {

			if ( !empty( $value ) && is_numeric( $value ) ) {
				$data_tags .='data-'.$key.'="'.$value.'" ';
			}
		}

		$styleArray = array(
			'background-color' => $bar_color,
			'height'           => $bar_height
		);

		$bar_style = wbc_generate_css( $styleArray );

		$styleArray = array(
			'background-color' => $bg_color,
			'padding'          => $bg_spacing,
			'border-radius' => $border_radius
		);

		$backing_style = wbc_generate_css( $styleArray );


		$styleArray = array(
			'color'     => $title_color,
			'font-size' =>$title_font_size
		);

		$heading_style = wbc_generate_css( $styleArray );


		$styleArray = array(
			'color'     => $percent_color,
			'font-size' => $percent_font_size
		);

		$percent_style = wbc_generate_css( $styleArray );
		
		$html  = '<div class="wbc-progress-wrap init-progress">';

		$html .= '<div class="wbc-progress-info">';
		$html .= '<span class="wbc-progress-title" '.$heading_style.'>'.$title.'</span>';
		$html .= '<span class="wbc-progress-percent" '.$percent_style.'>0%</span>';
		$html .= '</div>';

		$html .= '<div class="wbc-progress-back" '.$backing_style.'>';
		$html .= '<div class="wbc-progress"'.$data_tags.' '.$bar_style.'></div>';
		$html .= '</div>';
		$html .= '</div>';


	echo !empty( $html ) ? $html :'';

?>