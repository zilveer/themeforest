<?php
	$atts = extract( shortcode_atts(
			array(
				'user_message' => '',
				'user_name'    => '',
				'user_credit'  => '',
				'user_image'   => '',
			), $atts ) );


	$wbc_color_before = ( !empty( $wbc_color ) ) ? '[wbc_color color="'.$wbc_color.'"]' : '[wbc_color]';
	$wbc_color_after = '[/wbc_color]';

	if ( preg_match_all( "/\|([^\|]+)\|/", $user_name, $matches, PREG_SET_ORDER ) !== false ) {

		foreach ( $matches as $key => $value ) {
			if ( !empty( $matches[$key][0] ) && !empty( $matches[$key][1] ) ) {
				$user_name = str_replace( $matches[$key][0], $wbc_color_before.$matches[$key][1].$wbc_color_after, $user_name );
			}
		}
	}

	if ( preg_match_all( "/\|([^\|]+)\|/", $user_message, $matches, PREG_SET_ORDER ) !== false ) {

		foreach ( $matches as $key => $value ) {
			if ( !empty( $matches[$key][0] ) && !empty( $matches[$key][1] ) ) {
				$user_message = str_replace( $matches[$key][0], $wbc_color_before.$matches[$key][1].$wbc_color_after, $user_message );
			}
		}
	}

	// $styleArray = array(
	//  'font-size'     => $font_size,
	//  'color'         => $color,
	//  'margin-bottom' => $m_bottom,
	//  'margin-top'    => $m_top,
	// );

	// $style = wbc_generate_css( $styleArray );


	$user_img = wp_get_attachment_image_src( $user_image , 'thumbnail' );
	$user_image_html = '';

	if ( $user_img ) {
		$user_image_html = '<img src="'. esc_attr( $user_img[0] ).'" alt="'. esc_attr( get_the_title( $user_image ) ).'" width="'. esc_attr( $user_img[1] ).'" height="'. esc_attr( $user_img[2] ).'">';
	}

	$html = '<div>';
	$html .= '<div class="wbc-testimonial">';
	$html .= '<span class="testimonial-message">'. do_shortcode( $user_message ) .'</span>';
	$html .= $user_image_html;
	$html .= '<div class="testimonial-info">';
	$html .= '<div class="testimonial-name">'. do_shortcode( $user_name ) .'</div>';
	$html .= '<small>'.$user_credit.'</small>';
	$html .= '</div>';
	$html .= '</div>';
	$html .= '</div>';

	echo !empty( $html ) ? $html :'';	

?>