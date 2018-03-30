<?php

if(!function_exists('hue_mikado_woo_single_style')) {

	function hue_mikado_woo_single_style() {

		$styles = array();

		if(hue_mikado_options()->getOptionValue('hide_product_info') === 'yes') {
			$styles['display'] = 'none';
		}

		$selector = array(
			'.single.single-product .product_meta'
		);

		echo hue_mikado_dynamic_css($selector, $styles);

	}

	add_action('hue_mikado_style_dynamic', 'hue_mikado_woo_single_style');

}

?>