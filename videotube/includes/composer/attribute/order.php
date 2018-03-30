<?php
if( !function_exists( 'mars_order_attr' ) ){
	function mars_order_attr( $settings, $value ) {
		$html = null;
		$order_array = array( 
			'DESC'	=>	__('DESC','mars'),
			'ASC'	=>	__('ASC','mars')
		);
		$html .= '<div class="order_attr">';
			$html .= '<select name="'.$settings['param_name'].'" id="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-textinput '.$settings['param_name'].' '.$settings['type'].'_field">';
			foreach ( $order_array  as $k=>$v) {
				$html .= '<option '.selected( $value, $k, false ).' value="'.$k.'">'.$v.'</option>';
			}
		$html .= '</select>';
		$html .= '</div>';
		return $html;
	}	
	
}