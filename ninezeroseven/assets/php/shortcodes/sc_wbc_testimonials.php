<?php 
	$atts = extract( shortcode_atts(
			array(
				'count_from'  => '0',
				'count_to'    => '793',
				'speed'       => '',
				'interval'    => '10',
				'delimiter'   => '',
				'before'      => '',
				'after'       => '',
				'auto_height' => '',
				
				'color'       => '',
				'font_size'   => '',
				'm_bottom'    => '',
				'm_top'       => '',
			), $atts ) );

	$styleArray = array(
		'font-size'     => $font_size,
		'color'         => $color,
		'margin-bottom' => $m_bottom,
		'margin-top'    => $m_top,
	);

	$style = wbc_generate_css( $styleArray );

	$speed = (!empty($speed) && is_numeric($speed)) ? $speed : '7000';
	$auto_height = ($auto_height == 'yes') ? 'auto' : 'variable';
	$data_tags = ' ';
	$data_array = array(
		'item-height'   => $auto_height,
		'item-speed'   => $speed,
	);
	foreach ( $data_array as $key => $value ) {

		if ( !empty( $value ) ) {
			$data_tags .='data-'.$key.'="'.$value.'" ';
		}
	}
		
	$html  = '<div class="wbc-testimonial-wrap">';
	$html .= '<div class="wbc-testimonail-carousel"'.$data_tags.'>';
	$html .= do_shortcode($content);
	$html .= '</div>';
	$html .= '<div class="wbc-testimonial-nav">';
	$html .= '<a href="#" class="wbc-arrow-buttons carousel-prev button btn-primary"><i class="fa fa-angle-left"></i></a>';
	$html .= '<a href="#" class="wbc-arrow-buttons carousel-next button btn-primary"><i class="fa fa-angle-right"></i></a>';
	$html .= '</div>';
	$html .= '</div>';

	echo !empty($html) ? $html : '';

?>