<?php
		$atts = extract( shortcode_atts(
				array(
					'title'          => '',
					'per_title'      => '',
					'price'          => '',
					'button_text'    => '',
					'head_color'     => '',
					'price_bg_color' => '',
					'title_color'    => '',
					'price_color'    => '',
					'link'           => '',
					'featured' => '',
				), $atts ) );

		// $styleArray = array(
		// 	'width'            => (!empty($backing_size) && $backing_size != '100') ? $backing_size : '',
		// 	'height'           => (!empty($backing_size) && $backing_size != '100') ? $backing_size : '',
		// 	'background-color' => $backing_color
		// );

		// $backing_style = wbc_generate_css( $styleArray );
		$btn_link = wbc_build_link( $link );

		$ex_class = '';
		if( 'yes' === $featured ){
			$ex_class = ' featured-plan';
		}
		$html = '';
		$html .='<div class="wbc-price-table'.esc_attr( $ex_class ).'">';
		$html .='<div class="plan-head">'.$title.'</div>';
		$html .='<div class="plan-price">';
		$html .='<span class="plan-cost">'.$price.'</span>';
		$html .='<span class="plan-info">'.$per_title.'</span>';
		$html .='</div>';
		$html .= do_shortcode( $content );
		if( isset($btn_link['url']) && !empty($btn_link['url'])){
			$btn_title = (!empty($btn_link['title'])) ? $btn_link['title'] : __('Sign Up Now!', 'ninezeroseven' );
			$html .='<div class="plan-button">';
			$html .='<a class="button btn-primary" href="'.esc_url($btn_link['url']).'">'.esc_html( $btn_title ).'</a>';
			$html .='</div>';
		}
		$html .='</div>';



	echo !empty( $html ) ? $html :'';

?>