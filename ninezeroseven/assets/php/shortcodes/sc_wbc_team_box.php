<?php
$atts =  extract( shortcode_atts(
			array(
				'border_width'     => '',
				'font_size'        => '',
				'font_color'       => '',
				'bg_color'         => '',
				'border_radius'    => '',
				'background_color' => '',
				'border_color'     => '',
				'list_align'       => '',
				'member_name'      => 'Jane |Candy|',
				'member_position'  => '"Lead Coder"',
				'member_info'      => '',
				'wbc_color'        => '',
				'heading_color'    => '',
				'team_image'       => '',
				'img_size'         => ''
			), $atts ) ) ;

	$member_name_clean = str_replace("|", '', $member_name);

	$wbc_color_before = ( !empty( $wbc_color ) ) ? '[wbc_color color="'.$wbc_color.'"]' : '[wbc_color]';
	$wbc_color_after = '[/wbc_color]';

	if ( preg_match_all( "/\|([^\|]+)\|/", $member_name, $matches, PREG_SET_ORDER ) !== false ) {

		foreach ( $matches as $key => $value ) {
			if ( !empty( $matches[$key][0] ) && !empty( $matches[$key][1] ) ) {
				$member_name = str_replace( $matches[$key][0], $wbc_color_before.$matches[$key][1].$wbc_color_after, $member_name );
			}
		}
	}

	$margin_bottom = ( $list_align == 'center' ) ? $margin_bottom : '';

	$list_align = ( !empty( $list_align ) ) ? ' icon-'.$list_align : '';

	$styleArray = array(
		'color'            => $font_color,
	);

	$m_text_style = wbc_generate_css( $styleArray );

	$styleArray = array(
		'color'            => $heading_color,
	);

	$m_heading_style = wbc_generate_css( $styleArray );


	$html = '';

	$html .= '<div class="wbc-team-box clearfix'.$list_align.'" '.$m_text_style.'>';


	$mem_img_size = ( !empty( $img_size ) ) ? esc_html( $img_size ) : 'full';

	$mem_img = wp_get_attachment_image_src( $team_image , $mem_img_size );
		
	if( $mem_img ){

		$member_name_clean = ( !empty( $member_name_clean ) ) ? $member_name_clean : esc_html__('Team Member', 'ninezeroseven');

		$html .= '<img src="'. esc_attr( $mem_img[0] ).'" alt="'. esc_attr( $member_name_clean ).'" width="'. esc_attr( $mem_img[1] ).'" height="'. esc_attr( $mem_img[2] ).'">';
	}

	$html .= '<div class="wbc-team-content">';

	$html .= '<div class="team-name">';

	$html .= '<h5 '.$m_heading_style.'>'. do_shortcode( trim ( $member_name ) ).'</h5>';

	$html .= '<span>'.$member_position.'</span>';

	$html .= '</div>';

	$html .='<div class="member-details">'.do_shortcode( $member_info ).'</div>';

	$html .= '<div class="team-icons">';
		
	$html .= do_shortcode( $content );
		
	$html .= '</div></div>';

	$html .= '</div>';


	echo !empty($html) ? $html : '';
?>