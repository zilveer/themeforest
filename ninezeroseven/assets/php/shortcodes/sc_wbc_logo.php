<?php
$atts = extract( shortcode_atts(
				array(
					'logo_image' => '',
					'logo_link' => '',
				), $atts ) );

		$link = wbc_build_link( $logo_link );

		$logo_img = wp_get_attachment_image_src( $logo_image , 'full' );

		$html  = '';
		$html .= '<div class="wbc-logo">';

		if( $logo_img ){
			$logo_html = '<img src="'. esc_attr( $logo_img[0] ).'" alt="'. esc_attr( get_the_title( $logo_image ) ).'" width="'. esc_attr( $logo_img[1] ).'" height="'. esc_attr( $logo_img[2] ).'">';
			
			if ( isset( $link['url'] ) && !empty( $link['url'] ) ) {
				$target = ( isset( $link['target'] ) && !empty( $link['target'] ) ) ? $link['target'] : '_self';
				$html .= '<a href="'.esc_url( $link['url'] ).'" target="'.trim( esc_attr( $target ) ).'">'.$logo_html.'</a>';
			}else{
				$html .= $logo_html;
			}
		}
		
		$html .= '</div>';
		

		echo !empty( $html ) ? $html :'';

?>