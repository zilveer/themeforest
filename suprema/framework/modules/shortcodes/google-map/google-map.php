<?php
namespace SupremaQodef\Modules\Shortcodes\GoogleMap;

use SupremaQodef\Modules\Shortcodes\Lib\ShortcodeInterface;

class GoogleMap implements ShortcodeInterface{
	private $base;

	function __construct() {
		$this->base = 'qodef_google_map';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {

		vc_map(
			array(
				'name' => esc_html__('Select Google Map', 'suprema'),
				'base' => $this->base,
				'category' => 'by SELECT',
				'icon' => 'icon-wpb-google-map extended-custom-icon',
				'show_settings_on_create' => true,
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => 'Address 1',
						'param_name' => 'address1',
						'admin_label' => true
					),
					array(
						'type' => 'textfield',
						'heading' => 'Address 2',
						'param_name' => 'address2',
						'admin_label' => true,
						'dependency' => Array('element' => 'address1', 'not_empty' => true)
					),
					array(
						'type' => 'textfield',
						'heading' => 'Address 3',
						'param_name' => 'address3',
						'admin_label' => true,
						'dependency' => Array('element' => 'address2', 'not_empty' => true)
					),
					array(
						'type' => 'textfield',
						'heading' => 'Address 4',
						'param_name' => 'address4',
						'admin_label' => true,
						'dependency' => Array('element' => 'address3', 'not_empty' => true)
					),
					array(
						'type' => 'textfield',
						'heading' => 'Address 5',
						'param_name' => 'address5',
						'admin_label' => true,
						'dependency' => Array('element' => 'address4', 'not_empty' => true)
					),
					array(
						'type' => 'dropdown',
						'heading' => 'Custom Map Style',
						'param_name' => 'custom_map_style',
						'value' => array(
							'No' => 'false',
							'Yes' => 'true'
						),
						'save_always' => true,
						'description' => 'Enabling this option will allow Map editing'
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Color Overlay',
						'param_name' => 'color_overlay',
						'description' => 'Choose a Map color overlay',
						'dependency' => Array('element' => 'custom_map_style', 'value' => array('true'))
					),
					array(
						'type' => 'textfield',
						'heading' => 'Saturation',
						'param_name' => 'saturation',
						'description' => 'Choose a level of saturation (-100 = least saturated, 100 = most saturated)',
						'dependency' => Array('element' => 'custom_map_style', 'value' => array('true'))
					),
					array(
						'type' => 'textfield',
						'heading' => 'Lightness',
						'param_name' => 'lightness',
						'description' => 'Choose a level of lightness (-100 = darkest, 100 = lightest)',
						'dependency' => Array('element' => 'custom_map_style', 'value' => array('true'))
					),
					array(
						'type' => 'attach_image',
						'heading' => 'Pin',
						'param_name' => 'pin',
						'description' => 'Select a pin image to be used on Google Map'
					),
					array(
						'type' => 'textfield',
						'heading' => 'Map Zoom',
						'param_name' => 'zoom',
						'description' => 'Enter a zoom factor for Google Map (0 = whole worlds, 19 = individual buildings)'
					),
					array(
						'type' => 'dropdown',
						'heading' => 'Zoom Map on Mouse Wheel',
						'param_name' => 'scroll_wheel',
						'value' => array(
							'No' => 'false',
							'Yes' => 'true'
						),
						'save_always' => true,
						'description' => 'Enabling this option will allow users to zoom in on Map using mouse wheel'
					),
					array(
						'type' => 'textfield',
						'heading' => 'Map Height',
						'param_name' => 'map_height'
					)

				)
			) );
	}

	public function render($atts, $content = null) {
		$args = array(
			'address1' => '',
			'address2' => '',
			'address3' => '',
			'address4' => '',
			'address5' => '',
			'custom_map_style' => false,
			'color_overlay' => '#393939',
			'saturation' => '-100',
			'lightness' => '-60',
			'zoom' => '12',
			'pin' => '',
			'scroll_wheel' => false,
			'map_height' => '600'
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);

		$rand_id = mt_rand(100000,3000000);

		$params['map_data'] = $this->getMapDate($params, $rand_id);
		$params['map_id'] = 'qodef-map-'.$rand_id;

		$html = suprema_qodef_get_shortcode_module_template_part('templates/google-map-template', 'google-map', '', $params);

		return $html;
	}


	/**
	 * Return Elements Holder Item style
	 *
	 * @param $params
	 * @return array
	 */
	private function getMapDate($params, $id) {

		$map_data = array();

		$addresses_array = array();
		if ($params['address1'] != '') {
			array_push($addresses_array, esc_attr($params['address1']));
		}
		if ($params['address2'] != '') {
			array_push($addresses_array, esc_attr($params['address2']));
		}
		if ($params['address3'] != '') {
			array_push($addresses_array, esc_attr($params['address3']));
		}
		if ($params['address4'] != '') {
			array_push($addresses_array, esc_attr($params['address4']));
		}
		if ($params['address5'] != '') {
			array_push($addresses_array, esc_attr($params['address5']));
		}

		if ($params['pin'] != "") {
			$map_pin = wp_get_attachment_image_src($params['pin'], 'full', true);
			$map_pin = $map_pin[0];
		} else {
			$map_pin = get_template_directory_uri() . "/assets/img/pin.png";
		}

		$map_data[] = "data-addresses='[\"". implode('","', $addresses_array) . "\"]'";
		$map_data[] = 'data-custom-map-style='. $params['custom_map_style'];
		$map_data[] = 'data-color-overlay='. $params['color_overlay'];
		$map_data[] = 'data-saturation='. $params['saturation'];
		$map_data[] = 'data-lightness='. $params['lightness'];
		$map_data[] = 'data-zoom='. $params['zoom'];
		$map_data[] = 'data-pin='. $map_pin;
		$map_data[] = 'data-unique-id='. $id;
		$map_data[] = 'data-scroll-wheel='. $params['scroll_wheel'];
		$map_data[] = 'data-height='. $params['map_height'];

		return implode(' ', $map_data);

	}


}
