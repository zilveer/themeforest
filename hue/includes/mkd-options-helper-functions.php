<?php

if(!function_exists('hue_mikado_is_responsive_on')) {
	/**
	 * Checks whether responsive mode is enabled in theme options
	 * @return bool
	 */
	function hue_mikado_is_responsive_on() {
		return hue_mikado_options()->getOptionValue('responsiveness') !== 'no';
	}
}