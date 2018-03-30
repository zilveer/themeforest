<?php
$atts = extract( shortcode_atts(
				array(
					'item_width'  => '',
					'item_scroll' => '',
					'item_min'    => '',
					'item_max'    => '',
				), $atts ) );


		$data_tags = ' ';
		$data_array = array(
			'item-width'  => $item_width,
			'item-scroll' => $item_scroll,
			'item-min'    => $item_min,
			'item-max'    => $item_max,
		);
		foreach ( $data_array as $key => $value ) {

			if ( !empty( $value ) && is_numeric( $value ) ) {
				$data_tags .='data-'.$key.'="'.$value.'" ';
			}
		}
		
		$html  = '<div class="wbc-logo-wrap">';
		$html .= '<div class="wbc-logo-carousel"  '.$data_tags.'>';
		$html .= do_shortcode($content);
		$html .= '</div>';
		$html .= '<a href="#" class="wbc-arrow-buttons logo-prev button btn-primary"><i class="fa fa-angle-left"></i></a>';
		$html .= '<a href="#" class="wbc-arrow-buttons logo-next button btn-primary"><i class="fa fa-angle-right"></i></a>';
		$html .= '</div>';

		echo !empty( $html ) ? $html :'';

?>