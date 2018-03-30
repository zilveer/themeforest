<?php
		$atts = extract( shortcode_atts(
				array(
					'bg_color' => '',
					'width'    => '',
					'height'   => '',
					'm_bottom' => '',
					'm_top'    => '',
					'm_left'   => '',
					'm_right'  => '',
				), $atts ) );


		$styleArray = array(
			'background-color' => $bg_color,
			'width'            => $width,
			'height'           => $height,
			'margin-bottom'    => $m_bottom,
			'margin-top'       => $m_top,
			'margin-left'      => $m_left,
			'margin-right'     => $m_right,

		);

		$style = wbc_generate_css( $styleArray );

		$html = '<hr class="wbc-hr" '. $style .' />';


	echo !empty( $html ) ? $html :'';

?>