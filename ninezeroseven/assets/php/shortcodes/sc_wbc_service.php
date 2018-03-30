<?php
		$atts = extract( shortcode_atts(
				array(
					'icon'            => 'fa fa-anchor',
					'title'           => '',
					'wbc_line'        => '',
					'wbc_line_height' => '',
					'wbc_line_width'  => '',
					'wbc_line_color'  => '',
					'text_align'      => '',
					'color'           => '',
					'font_size'       => '',
					'm_bottom'        => '',
					'm_top'           => '',
				), $atts ) );

		$styleArray = array(
			'font-size'     => $font_size,
			'color'         => $color,
			'margin-bottom' => $m_bottom,
			'margin-top'    => $m_top,
		);

		$style = wbc_generate_css( $styleArray );
		
		$iconShortcodeArray = array(
			'base'          => 'wbc_icon',
			'icon'          => $icon,
			// 'bg_color'      => $bg_color,
			// 'border_color'  => $border_color,
			// 'font_size'     => $font_size,
			// 'color'         => $icon_color,
			// 'border_radius' => $border_radius,
			// 'icon_style'    => $icon_style,
			// 'icon_extra'    => $icon_extra,
			// 'border_width'  => $border_width,
			// 'margin_bottom' => $margin_bottom
		);

		$icon_shortcode = wbc_array_to_shortcode( $iconShortcodeArray );

		$iconShortcodeArray = array(
			'base'     => 'wbc_hr',
			'bg_color' => $wbc_line_color,
			'width'    => $wbc_line_width,
			'height'   => $wbc_line_height,
		);

		$hr_shortcode = wbc_array_to_shortcode( $iconShortcodeArray );

		$service_title = wbc_pipe_to_color($title);

		$html  = '<div class="wbc-service">';
		$html .= do_shortcode( $icon_shortcode );
		$html .= '<h4 class="service-title">'. $service_title .'</h4>';
		$html .= '<div class="service-info">';
		$html .= do_shortcode( $content );
		$html .= '</div>';

		if( !empty( $wbc_line ) && $wbc_line == 'yes'){
			$html .= do_shortcode( $hr_shortcode );
		}

		$html .= '</div>';



	echo !empty( $html ) ? $html :'';

?>