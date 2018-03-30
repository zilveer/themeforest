<?php
		global $wbc_list_atts;
		$font_size = $p_top = $p_left = $icon_type = $p_bottom = $p_right = $m_top = $m_left = $m_bottom = $m_right = $bg_color = $icon_style = $icon_extra = $border_width = $color = $border_color = $border_radius = '';

		$atts = shortcode_atts(
			array(
				'icon'             => 'fa fa-cogs',
				'icon_pack'        => '',
				'icon_linecons'    => '',
				'icon_typicons'    => '',
				'icon_openiconic'  => '',
				'icon_fontawesome' => '',
				'icon_entypo'      => '',
				'icon_etline'      => '',
				'icon_flaticon'    => '',
			), $atts );

		if ( is_array( $wbc_list_atts ) && count( $wbc_list_atts ) > 0 ) {
			$atts = array_merge( $atts, $wbc_list_atts );
		}

		extract( $atts );

		if(empty($icon_pack)){
			$icon_pack = 'fontawesome';
		}

		if(isset(${'icon_' . $icon_pack}) && !empty(${'icon_' . $icon_pack})){
			$icon = ${'icon_' . $icon_pack};
		}

		if(function_exists('vc_icon_element_fonts_enqueue') && $icon_pack != 'fontawesome'){
			vc_icon_element_fonts_enqueue( $icon_pack );
		}

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
		
		$iconShortcodeArray = array(
			'base'               => 'wbc_icon',
			'icon_type'           => $icon_type,
			'icon_' . $icon_pack => $icon,
			'bg_color'           => $bg_color,
			'color'              => $color,
			'border_color'       => $border_color,
			'font_size'          => $font_size,
			'border_radius'      => $border_radius,
			'icon_style'         => $icon_style,
			'icon_extra'         => $icon_extra,
			'border_width'       => $border_width,
			'icon_pack'          => $icon_pack,
		);

		/*
		$iconShortcodeArray = array(
			'base'                => 'wbc_icon',
			'icon'                => $icon,
			'icon_type'           => $icon_type,
			'icon_style'          => $icon_style,
			'icon_extra'          => $icon_extra,
			'color'               => $icon_color,
			'color_hover'         => $icon_color_hover,
			'border_color'        => $icon_border_color,
			'border_radius'       => $icon_border_radius,
			'border_width'        => $icon_border_width,
			'border_color_hover'  => $icon_border_color_hover,
			'outline_color'       => $icon_outline_color,
			'outline_width'       => $icon_outline_width,
			'outline_spacing'     => $icon_outline_spacing,
			'outline_color_hover' => $icon_outline_color_hover,
			'bg_color'            => $icon_bg_color,
			'bg_color_hover'      => $icon_bg_color_hover,
			'font_size'           => $icon_size,
			'margin_bottom'       => $icon_margin_bottom,
			'icon_pack'           => $icon_pack,
			'display_type'        => $display_type,
			'icon_' . $icon_pack  => $icon,
			'icon_img'            => $icon_img

		);
		 */

		$icon_shortcode = wbc_array_to_shortcode( $iconShortcodeArray );


		$html  = '';
		$html .= '<li class="clearfix wbc-li-list" '.$listStyle.'>';

		$html .= wbc_inline_shortcode_fix( $icon_shortcode );

		$html .= '<div class="list-content clearfix">';

		$html .= wbc_inline_shortcode_fix( $content );

		$html .= '</div>';
		$html .= '</li>';


	echo !empty( $html ) ? $html :'';

?>