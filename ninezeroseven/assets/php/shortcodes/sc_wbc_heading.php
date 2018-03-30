<?php
$atts = extract( shortcode_atts(
 				array(
					'tag'            => 'h3',
					'font_size'      => '',
					'heading_style'  => '',
					'max_width'      => '',
					'title'          => '',
					'bg_color'       => '',
					'wbc_color'      => '',
					'line_height'    => '',
					'letter_spacing' => '',
					'xs_font_size'   => '',
					'sm_font_size'   => '',
					'md_font_size'   => '',
					'align'          => '',
					'color'          => '',
					'p_top'          => '',
					'p_bottom'       => '',
					'p_left'         => '',
					'p_right'        => '',
					'm_top'          => '',
					'm_bottom'       => '',
					'm_left'         => '',
					'm_right'        => '',
 					//Animation
					'wbc_animation' => '',
					'wbc_duration'  => '',
					'wbc_delay'     => '',
					'wbc_offset'    => '',
					'wbc_iteration' => '',
 				), $atts ) );

 		$styleArray = array(
			'font-size'        => $font_size,
			'line-height'      => $line_height,
			'letter-spacing'   => $letter_spacing,
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
			'max-width'        => $max_width,
		);

		$wbc_color_before = ( !empty( $wbc_color ) ) ? '[wbc_color color="'.$wbc_color.'"]' : '[wbc_color]';
		$wbc_color_after = '[/wbc_color]';

		if ( preg_match_all( "/\|([^\|]+)\|/", $title, $matches, PREG_SET_ORDER ) !== false ) {

			foreach ( $matches as $key => $value ) {
				if ( !empty( $matches[$key][0] ) && !empty( $matches[$key][1] ) ) {
					$title = str_replace( $matches[$key][0], $wbc_color_before.$matches[$key][1].$wbc_color_after, $title );
				}
			}
		}
		
		$title = str_replace('{{PAGE_TITLE}}', get_the_title( get_the_id() ), $title);

		$tag = ( !empty( $tag ) ) ? $tag : 'h3';

		$heading_css = wbc_generate_css( $styleArray );

		$heading_class = ( !empty( $heading_style ) ) ? 'special-'.$heading_style : 'default-heading';

		if ( !empty( $xs_font_size ) ) {
			$heading_class .= ' xs-responsive-text-'.intval( $xs_font_size );
		}

		if ( !empty( $sm_font_size ) ) {
			$heading_class .= ' sm-responsive-text-'.intval( $sm_font_size );
		}

		if ( !empty( $md_font_size ) ) {
			$heading_class .= ' md-responsive-text-'.intval( $md_font_size );
		}



		$wow_data_tags = '';
		if( !empty($wbc_animation) ){
			wp_enqueue_style( 'wbc907-animated' );
			wp_enqueue_script( 'wbc-wow' );
			$heading_class .= ' wow '.$wbc_animation;

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



 		// $styleArray = array(
 		//  'font-size' => $font_size,
 		//  'line-height' => $line_height,
 		//  'color'            => $color,
 		//  'text-align'       => 'right',
 		//  // 'margin-bottom'    => $m_bottom, 		
 		//  //   'margin-right'     => $m_right,
// 		//  // 'margin-top'       => $m_top,
// 		//  // 'margin-left'      => $m_left,
// 		//  // 'padding-bottom'   => $p_bottom,
// 		//  // 'padding-right'    => $p_right,
// 		//  // 'padding-top'      => $p_top,
// 		//  // 'padding-left'     => $p_left,
// 		//  // 'border-radius'    => $border_radius,
// 		//  // 'border-color'     => $border_color,
// 		//  // 'border-width'     => $border_width,
// 		//  // 'border-style'     => $border_style,
// 		//  );
// 		// $heading_css = wbc_generate_css($styleArray);


 		$html = '';
 		$html .= '<div class="wbc-heading clearfix">';
 		$html .= '<'. esc_html( $tag ) .' class="'.esc_attr( $heading_class ).'" '.$heading_css.''.$wow_data_tags.'>';
 		$html .= do_shortcode( trim( $title ) );
 		$html .= '</'. esc_html( $tag ) .'>';
 		$html .= '</div>';

	echo !empty( $html ) ? $html :'';	

?>