<?php
$atts =  extract( shortcode_atts(
				array(
					'heading'               => '',
					'heading_color'         => '',
					'heading_size'          => '',
					'heading_margin_bottom' => '',
					'subtitle'              => '',
					'sub_color'             => '',
					//Icon
					'icon'                     => 'fa fa-cogs',
					'icon_size'                => '',
					'icon_style'               => '',
					'icon_type'                => '',
					'icon_extra'               => '',
					'icon_color'               => '',
					'icon_color_hover'         => '',
					'icon_bg_color'            => '',
					'icon_bg_color_hover'      => '',
					'icon_border_width'        => '',
					'icon_border_radius'       => '',
					'icon_border_color'        => '',
					'icon_border_color_hover'  => '',
					'icon_outline_spacing'     => '',
					'icon_outline_width'       => '',
					'icon_outline_color'       => '',
					'icon_outline_color_hover' => '',
					'icon_margin_bottom'       => '',
					'box_style'                => '',
					

					//Content
					'background_color' => '',
					'font_color'       => '',
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
					'box_style'        => '',

					//Animation
					'wbc_animation' => '',
					'wbc_duration'  => '',
					'wbc_delay'     => '',
					'wbc_offset'    => '',
					'wbc_iteration' => '',
					
					'icon_pack'        => '',
					'icon_linecons'    => '',
					'icon_typicons'    => '',
					'icon_openiconic'  => '',
					'icon_fontawesome' => '',
					'icon_entypo'      => '',
					'icon_etline'      => '',
					'icon_flaticon'    => '',
					'icon_img'         => '',
					'display_type'	=>'',

				), $atts ) );
		$wbc_color ='';
		$wbc_color_before = ( !empty( $wbc_color ) ) ? '[wbc_color color="'.$wbc_color.'"]' : '[wbc_color]';
		$wbc_color_after = '[/wbc_color]';

		if ( preg_match_all( "/\|([^\|]+)\|/", $heading, $matches, PREG_SET_ORDER ) !== false ) {

			foreach ( $matches as $key => $value ) {
				if ( !empty( $matches[$key][0] ) && !empty( $matches[$key][1] ) ) {
					$heading = str_replace( $matches[$key][0], $wbc_color_before.$matches[$key][1].$wbc_color_after, $heading );
				}
			}
		}
		if(empty($icon_pack)){
			$icon_pack = 'fontawesome';
		}

		if(isset(${'icon_' . $icon_pack}) && !empty(${'icon_' . $icon_pack})){
			$icon = ${'icon_' . $icon_pack};
		}

		if(function_exists('vc_icon_element_fonts_enqueue') && $icon_pack != 'fontawesome'){
			vc_icon_element_fonts_enqueue( $icon_pack );
		}

		if( !empty( $list_align ) && empty( $box_style ) ) $box_style = $list_align;

		$icon_margin_bottom = ( $box_style == 'center' ) ? $icon_margin_bottom : '';

		$box_style = ( !empty( $box_style ) ) ? ' icon-'.$box_style : '';

		$styleArray = array(
			'color'            => $font_color,
			'background-color' => $background_color,
			'margin-bottom'    => $m_bottom,
			'margin-right'     => $m_right,
			'margin-top'       => $m_top,
			'margin-left'      => $m_left,
			'padding-bottom'   => $p_bottom,
			'padding-right'    => $p_right,
			'padding-top'      => $p_top,
			'padding-left'     => $p_left,
		);

		$style = wbc_generate_css( $styleArray );
		
		
		
		$styleArray = array(
			'color'         => $heading_color,
			'font-size'     => $heading_size,
			'margin-bottom' => $heading_margin_bottom,
		);
		$heading_style = wbc_generate_css( $styleArray );


		$icon_margin_bottom = ( !empty( $icon_margin_bottom ) ) ? $icon_margin_bottom : '';

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

		$icon_shortcode = wbc_array_to_shortcode( $iconShortcodeArray );

		$icon_markup = wbc_inline_shortcode_fix( $icon_shortcode );

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


		$html = '';

		$html .= '<div class="wbc-icon-box clearfix'.$box_style.$el_class.'" '.$style.$wow_data_tags.'>';

		if( !empty( $heading ) && !empty( $subtitle ) ){
			$sub_color = (!empty($sub_color)) ? ' style="color:'. esc_attr( $sub_color ) .';"' : '';
			$heading = $heading.'<span'.$sub_color.' class="box-sub-heading">'.$subtitle.'</span>';
		}

		if($box_style === ' icon-left-wrap'){
			$html .= '<div class="wbc-icon-header-wrap clearfix">';
			$html .= $icon_markup;
			if(isset($heading) && !empty($heading) ) $html .= '<h4 '.$heading_style.'>'.do_shortcode( trim( $heading ) ).'</h4>';
			$html .= '</div>';
		}elseif($box_style === ' icon-right-wrap'){
			$html .= '<div class="wbc-icon-header-wrap clearfix">';
			if(isset($heading) && !empty($heading) ) $html .= '<h4 '.$heading_style.'>'.do_shortcode( trim( $heading ) ).'</h4>';
			$html .= $icon_markup;
			$html .= '</div>';
		}else{
			$html .= $icon_markup;
		}
		

		$html .= '<div class="wbc-box-content">';
		if($box_style !== ' icon-left-wrap' && $box_style !== ' icon-right-wrap'){
			if(isset($heading) && !empty($heading) ) $html .= '<h4 '.$heading_style.'>'.do_shortcode( trim( $heading ) ).'</h4>';
		}
		$html .= do_shortcode( wpautop( $content ) );
		$html .= '</div>';

		$html .= '</div>';

		echo !empty( $html ) ? $html :'';

?>