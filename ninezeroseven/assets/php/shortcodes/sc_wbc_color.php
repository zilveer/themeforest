<?php
$atts = extract( shortcode_atts(
				array(
					'color'             => '',
				), $atts ) );

		$styleArray = array(
			'color'            => $color,
		);

		$style = wbc_generate_css( $styleArray );

		$html = '<span class="wbc-color" '.$style.'>'.do_shortcode( $content ).'</span>';

	echo !empty( $html ) ? $html :'';

?>