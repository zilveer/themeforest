<?php
if( function_exists( 'vc_map' ) ){
	add_shortcode_param( 'multidropdown', 'bloger_multidropdown', get_template_directory_uri().'/js/multidropdown.js' );
}

function bloger_multidropdown( $settings, $value ) {
	$dependency = vc_generate_dependencies_attributes( $settings );

	$select_options = '';

	if( !empty( $settings['value'] ) ){

		foreach( $settings['value'] as $label => $key ){
			$select_options .= '<option value="'.$key.'">'.$label.'</option>';
		}

	}

	return '
		<div class="multidropdown-param">
			<input type="hidden" name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-textinput '.$settings['param_name'].' '.$settings['type'].'_field" value="'.$value.'" ' . $dependency . '/>
			<select name="'.$settings['param_name'].'[]" multiple>
				'.$select_options.'
			</select>
		</div>
	';	
}
?>