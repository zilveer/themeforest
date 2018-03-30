<?php
$atts = extract( shortcode_atts(
				array(
					'bg_color'      => '',
					'border_radius' => '',
					'border_color'  => '',
					'border_width'  => '',
					'border_style'  => '',
					'align'         => '',
					'color'         => '',
					'p_top'         => '',
					'p_bottom'      => '',
					'p_left'        => '',
					'p_right'       => '',
					'm_top'         => '',
					'm_bottom'      => '',
					'm_left'        => '',
					'm_right'       => '',
					//Animation
					'wbc_animation' => '',
					'wbc_duration'  => '',
					'wbc_delay'     => '',
					'wbc_offset'    => '',
					'wbc_iteration' => '',
				), $atts ) );

		$styleArray = array(
			'background-color' => $bg_color,
			'color'            => $color,
			'text-align'       => $align,
			'margin-bottom'    => $m_bottom,
			'margin-right'     => $m_right,
			'margin-top'       => $m_top,
			'margin-left'      => $m_left,
			'padding-bottom'   => $p_bottom,
			'padding-right'    => $p_right,
			'padding-top'      => $p_top,
			'padding-left'     => $p_left,
			'border-radius'    => $border_radius,
			'border-color'     => $border_color,
			'border-width'     => $border_width,
			'border-style'     => $border_style,
		);

		$wow_data_tags = '';
		$el_class = '';
		if( !empty($wbc_animation) ){
			wp_enqueue_style( 'wbc907-animated' );
			wp_enqueue_script( 'wbc-wow' );
			$el_class .= ' wow '.$wbc_animation;

			if(!empty($wbc_duration)){
				$wow_data_tags .=' data-wow-duration="'.esc_attr( $wbc_duration ).'"';
			}
			if(!empty($wbc_delay)){
				$wow_data_tags .=' data-wow-delay="'.esc_attr( $wbc_delay ).'"';
			}
			if(!empty($wbc_offset)){
				$wow_data_tags .=' data-wow-offset="'.esc_attr( $wbc_offset ).'"';
			}
			if(!empty($wbc_iteration)){
				$wow_data_tags .=' data-wow-iteration="'.esc_attr( $wbc_iteration ).'"';
			}
		}

		$style = wbc_generate_css( $styleArray );

		$html = '<div class="wbc-color-box clearfix'.$el_class.'" '.$style.''.$wow_data_tags.'>'.do_shortcode( $content ).'</div>';

	echo !empty( $html ) ? $html : '';

?>