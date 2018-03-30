<?php
		$atts = extract( shortcode_atts(
				array(
					'font_size'     => '',
					'line_height'   => '',
					'heading_style' => '',
					'wbc_color'     => '',
					'quote_message' => '',
					'quote_credit'  => '',
					'credit_color'  => '',
					'quote_color'   => '',
				), $atts ) );

		if( empty( $quote_message ) ) return;

		$wbc_color_before = ( !empty( $wbc_color ) ) ? '[wbc_color color="'.$wbc_color.'"]' : '[wbc_color]';
		$wbc_color_after = '[/wbc_color]';

		if ( preg_match_all( "/\|([^\|]+)\|/", $quote_message, $matches, PREG_SET_ORDER ) !== false ) {

			foreach ( $matches as $key => $value ) {
				if ( !empty( $matches[$key][0] ) && !empty( $matches[$key][1] ) ) {
					$quote_message = str_replace( $matches[$key][0], $wbc_color_before.$matches[$key][1].$wbc_color_after, $quote_message );
				}
			}
		}

		$styleArray = array(
			'font-size'   => $font_size,
			'line-height' => $line_height,
			'color'       => $quote_color
		);

		$style = wbc_generate_css( $styleArray );

		$heading_class = 'quote-title ';
		$heading_class .= ( !empty( $heading_style ) ) ? 'special-'.$heading_style : 'default-heading';



		$html  = '<div class="wbc-quote-sc">';
		$html .= '<h3 class="'. esc_attr( $heading_class ) .'"  '. $style .'>';
		$html .= '<i class="fa fa-quote-left"></i>';
		$html .= ' '.do_shortcode( $quote_message ). ' ';
		$html .= '<i class="fa fa-quote-right"></i>';
		$html .= '</h3>';

		if( !empty( $quote_credit ) ){
			$styleArray = array(
				'color'   => $credit_color,
			);

			$style = wbc_generate_css( $styleArray );

			$html .= '<div class="quote-reference" '. $style .'>'. $quote_credit .'</div>';
		}

		$html .= '</div>';


	echo !empty( $html ) ? $html :'';

?>