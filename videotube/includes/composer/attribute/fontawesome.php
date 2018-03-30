<?php
if( !function_exists( 'mars_vc_fontawesome_attr' ) ){
	function mars_vc_fontawesome_attr( $settings, $value ) {
		$html = null;
		if( !function_exists( 'ebor_icons_list' ) )
			return;
		$icon_array = ebor_icons_list();
		$html .= '<div class="vc_fontawesome_attr">';
			$html .= '<select name="'.$settings['param_name'].'" id="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-textinput '.$settings['param_name'].' '.$settings['type'].'_field">';
				foreach ( $icon_array  as $k=>$v) {
					$html .= '<option '.selected( $value, $k, false ).' value="'.$k.'">'.$v.'</option>';
				}
			$html .= '</select>';
		$html .= '</div>';
		return $html;
	}
}