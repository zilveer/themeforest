<?php
		global $wbc_list_atts;
		$atts =  shortcode_atts(
			array(
				'icon_style'       => '',
				'icon_extra'       => '',
				'icon_type'        => '',
				'border_width'     => '',
				'color'            => '',
				'font_size'        => '',
				'font_color'       => '',
				'bg_color'         => '',
				'border_radius'    => '',
				'background_color' => '',
				'border_color'     => '',
				'width'            => '',
				'list_align'       => '',
				'p_top'            => '',
				'p_bottom'         => '',
				'p_left'           => '',
				'p_right'          => '',
				'm_top'            => '',
				'm_bottom'         => '',
				'm_left'           => '',
				'm_right'          => '',
			), $atts ) ;

		$wbc_list_atts = $atts;

		extract( $atts );


		$list_align = ( !empty( $list_align ) ) ? ' list-'.$list_align : '';

		$style = ( !empty( $font_color ) ) ? ' style="color:'.esc_attr( $font_color ).'"' : '';

		$html = '';

		$html .= '<div class="wbc-list-wrap">';

		if ( wbc_check_inline() ) {
			$iconClasses = 'wbc-icon ';

			if ( !empty( $bg_color ) ) {
				$iconClasses .= 'icon-background ';
			}

			if ( !empty( $icon_style ) ) {
				$iconClasses .= 'icon-'.$icon_style.' ';
			}

			if ( !empty( $icon_extra ) && !empty( $bg_color ) ) {
				$iconClasses .= 'icon-'.$icon_extra.' ';
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
				'height'           => $width,
				'line-height'      => $width,
			);

			$iconStyle = wbc_generate_css( $styleArray );

			$styleArray = array(
				'padding-top'    => $p_top,
				'padding-left'   => $p_left,
				'padding-bottom' => $p_bottom,
				'padding-right'  => $p_right,
				'margin-top'     => $m_top,
				'margin-left'    => $m_left,
				'margin-bottom'  => $m_bottom,
				'margin-right'   => $m_right,
			);

			$listStyle = wbc_generate_css( $styleArray );

			$data  = 'data-icon-'.$iconStyle;
			$data .= ' data-icon-class="'.$iconClasses.'"';
			$data .= ' data-icon-type="'.$icon_type.'"';

			if ( empty( $listStyle ) ) $listStyle = 'style=""';

			$data .= ' data-list-'.$listStyle;

			$html .= '<ul class="wbc-list'.$list_align.'"'.$style.' '.$data.'>';
		}else {
			$html .= '<ul class="wbc-list'.$list_align.'"'.$style.'>';
		}



		$html .= do_shortcode( $content );


		$html .= '</ul></div>';


	echo !empty( $html ) ? $html :'';

?>