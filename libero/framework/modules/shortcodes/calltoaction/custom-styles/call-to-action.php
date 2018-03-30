<?php
/**
 * Custom styles for Call To Action shortcode
 * Hooks to libero_mikado_style_dynamic hook
 */

if (!function_exists('libero_mikado_call_to_action_style')) {

	function libero_mikado_call_to_action_style(){
		$selector = '.mkd-call-to-action';
		$style = array();

		$background_color = libero_mikado_options()->getOptionValue('call_to_action_bckg_color');
		if (!empty($background_color)) {
			$style['background-color'] = $background_color;
		}

		$border_color = libero_mikado_options()->getOptionValue('call_to_action_border_color');
		if (!empty($border_color)) {
			$style['border-color'] = $border_color;
		}

		echo libero_mikado_dynamic_css($selector, $style);
	}

	add_action('libero_mikado_style_dynamic', 'libero_mikado_call_to_action_style');

}

?>