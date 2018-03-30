<?php
if( !function_exists( 'mars_orderby_attr' ) ){
	
	function mars_orderby_attr( $settings, $value ) {
		$html = null;
		$orderby_array = post_orderby_options( 'video' );
		$html .= '<div class="orderby_attr">';
			$html .= '<select name="'.$settings['param_name'].'" id="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-textinput '.$settings['param_name'].' '.$settings['type'].'_field">';
				foreach ( $orderby_array  as $k=>$v) {
					$html .= '<option '.selected( $value, $k, false ).' value="'.$k.'">'.$v.'</option>';
				}
			$html .= '</select>';
		$html .= '</div>';
		return $html;
	}	
	
}