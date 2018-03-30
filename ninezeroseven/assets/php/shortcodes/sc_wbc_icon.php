<?php
$atts = extract( shortcode_atts(
				array(
					'icon'            => '',
					'icon_type'       => '',
					'icon_style'      => '',
					'icon_extra'      => '',
					'color'           => '',
					'font_size'       => '',
					'bg_color'        => '',
					'border_radius'   => '',
					'border_color'    => '',
					'border_width'    => '',
					'outline_color'   => '',
					'outline_width'   => '',
					'outline_spacing' => '',
					'width'           => '',
					'icon_link'       => '',
					'margin_bottom'   => '',
					'margin_top'      => '',
					'margin_right'    => '',
					'margin_left'     => '',

					// Hovers
					'border_color_hover'  => '',
					'outline_color_hover' => '',
					'color_hover'         => '',
					'bg_color_hover'      => '',

					'icon_pack'        => '',
					'icon_linecons'    => '',
					'icon_typicons'    => '',
					'icon_openiconic'  => '',
					'icon_fontawesome' => '',
					'icon_entypo'      => '',
					'icon_etline'      => '',
					'icon_flaticon'    => '',
					'display_type'     =>'',
					'icon_img'         =>'',

				), $atts ) );
		
		if(isset(${'icon_' . $icon_pack}) && !empty(${'icon_' . $icon_pack})){
			$icon = ${'icon_' . $icon_pack};
		}

		if( empty( $icon_pack ) ){
			$icon_pack = 'fontawesome';
			$icon = ( !empty( $icon_fontawesome) ) ? $icon_fontawesome : $icon;
		}

		if(function_exists('vc_icon_element_fonts_enqueue') && $icon_pack != 'fontawesome'){
			vc_icon_element_fonts_enqueue( $icon_pack );
		}
		

		$data_tags = '';
		$data_array = array(
			'hover-outline-color' => $outline_color_hover,
		);

		foreach ( $data_array as $key => $value ) {
			if ( !empty( $value ) ) {
				$data_tags .=' data-'.$key.'="'.esc_attr( $value ).'"';
			}
		}

		$data_tags2 = '';
		$data_array = array(
			'hover-border-color' => $border_color_hover,
			'hover-bg-color'     => $bg_color_hover,
			'hover-color'        => $color_hover,
		);

		foreach ( $data_array as $key => $value ) {
			if ( !empty( $value ) ) {
				$data_tags2 .=' data-'.$key.'="'.esc_attr( $value ).'"';
			}
		}


		if(!empty($data_tags) || !empty($data_tags2)){
			$data_tags .= ' data-custom-hover="1"';
		}

		

		$link = wbc_build_link( $icon_link );

		$iconClasses = 'wbc-icon-wrapper';

		if(!empty($icon_type)){
			$iconClasses .= ' wbc-icon-'.$icon_type;
		}

		if ( !empty( $bg_color ) || !empty( $icon_style ) && empty( $icon_type ) ) {
			$iconClasses .= ' icon-background';
		}

		if ( !empty( $icon_style ) ) {
			$iconClasses .= ' icon-'.$icon_style;
		}

		if ( !empty( $icon_extra ) ) {
			$iconClasses .= ' icon-'.$icon_extra;
		}

		$border_style = '';
		if( !empty($border_width) || !empty($border_color)){
			$border_style = 'solid';
		}

		//Style
		$border_color = ( !empty( $border_color ) ) ? $border_color : $bg_color;

		$styleArray = array(
			'font-size'        => $font_size,
			'color'            => $color,
			'background-color' => $bg_color,
			'border-width'     => $border_width,
			'border-color'     => $border_color,
			'border-style'     => $border_style,
			'width'            => $width,
			'height'           => $width,
			'line-height'      => $width,
		);

		$style = wbc_generate_css( $styleArray );

		$style2Array = array(
			'padding'       => $outline_spacing,
			'border-width'  => $outline_width,
			'border-color'  => (!empty($bg_color) && empty($outline_color)) ? $bg_color : $outline_color,
			'border-radius' => $border_radius,
			'margin-bottom' => $margin_bottom,
			'margin-right'  => $margin_right,
			'margin-top'    => $margin_top,
			'margin-left'   => $margin_left,
		);

		$style2 = wbc_generate_css( $style2Array );

		$icon_image = wp_get_attachment_image_src($icon_img,'full');

		$content_add = '';
		if( $icon_image && $display_type == 'img'){
			$iconClasses .= ' icon-img';
			$content_add .= '<img src="'. esc_attr( $icon_image[0] ).'" alt="'. esc_attr( get_the_title($icon_img )).'" width="'. esc_attr( $icon_image[1] ).'" height="'. esc_attr( $icon_image[2] ).'">';
		}else{
			$content_add .= '<i class="wbc-font-icon '.esc_attr( $icon ).'"></i>';
		}


		$html ='';
		
		$html .= '<div class="'. trim( $iconClasses ).'" '.$style2.''.$data_tags.'>';
		$html .= '<span class="wbc-icon" '.$style.''.$data_tags2.'>';
		
		$html .= $content_add;
		
		$html .= '</span></div>';

		if ( isset( $link['url'] ) && !empty( $link['url'] ) ) {
			$target = ( isset( $link['target'] ) && !empty( $link['target'] ) ) ? $link['target'] : '_self';
			$html = '<a href="'.esc_url( $link['url'] ).'" target="'.trim( esc_attr( $target ) ).'">'.$html.'</a>';
		}

		echo !empty( $html ) ? $html :'';

?>