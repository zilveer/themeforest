<?php
namespace Libero\Modules\Counter;

use Libero\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class Counter
 */
class Counter implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'mkd_counter';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 *
	 * @see mkd_core_get_carousel_slider_array_vc()
	 */
	public function vcMap() {

		vc_map( array(
			'name' => 'Mikado Counter',
			'base' => $this->getBase(),
			'category' => 'by MIKADO',
			'admin_enqueue_css' => array(libero_mikado_get_skin_uri().'/assets/css/mkd-vc-extend.css'),
			'icon' => 'icon-wpb-counter extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' =>	array_merge(
				array(
					array(
						'type' => 'dropdown',
						'admin_label' => true,
						'heading' => 'Type',
						'param_name' => 'type',
						'value' => array(
							'Zero Counter' => 'zero',
							'Random Counter' => 'random'
						),
						'save_always' => true,
						'description' => ''
					),
					array(
						'type' => 'dropdown',
						'admin_label' => true,
						'heading' => 'Show Icon',
						'param_name' => 'show_icon',
						'value' => array(
							'No' => 'no',
							'Yes' => 'yes'
						),
						'save_always' => true
					)
				),
				libero_mikado_icon_collections()->getVCParamsArray(array('element' => 'show_icon', 'value' => array('yes'))),
				array(
					array(
						'type' => 'dropdown',
						'heading' => 'Position',
						'param_name' => 'position',
						'value' => array(
							'Left' => 'left',
							'Right' => 'right',
							'Center' => 'center'
						),
						'save_always' => true
					),
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => 'Digit',
						'param_name' => 'digit',
						'description' => ''
					),
					array(
						'type' => 'textfield',
						'heading' => 'Digit Font Size (px)',
						'param_name' => 'font_size',
						'description' => '',
						'group' => 'Design Options',
					),
					array(
						'type' => 'dropdown',
						'heading' => 'Digit Font Weight',
						'param_name' => 'font_weight',
						'value'       => array_flip(libero_mikado_get_font_weight_array(true)),
						'description' => '',
						'group' => 'Design Options',
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Digit Color',
						'param_name' => 'digit_color',
						'description' => '',
						'group' => 'Design Options',
					),
					array(
						'type' => 'textfield',
						'heading' => 'Currency',
						'param_name' => 'currency',
						'description' => 'Enter currency to be added before counter',
						'admin_label' => true
					),
					array(
						'type' => 'textfield',
						'heading' => 'Title',
						'param_name' => 'title',
						'admin_label' => true
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Title Color',
						'param_name' => 'title_color',
						'description' => '',
						'group' => 'Design Options',
					),
					array(
						'type' => 'textfield',
						'heading' => 'Text',
						'param_name' => 'text',
						'admin_label' => true,
						'description' => ''
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Text Color',
						'param_name' => 'text_color',
						'description' => '',
						'group' => 'Design Options',
					),
					array(
						'type' => 'textfield',
						'heading' => 'Padding Bottom(px)',
						'param_name' => 'padding_bottom',
						'description' => '',
						'group' => 'Design Options',
					),
					array(
						'type'       => 'textfield',
						'heading'    => 'Custom Icon Size (px)',
						'param_name' => 'custom_icon_size',
						'group'      => 'Design Options',
						'dependency' => array('element' => 'show_icon', 'value' => array('yes'))
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => 'Icon Color',
						'param_name' => 'icon_color',
						'group'      => 'Design Options',
						'dependency' => array('element' => 'show_icon', 'value' => array('yes'))
					),
				)
			)
		) );

	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'type' => '',
			'position' => '',
			'digit' => '',
			'underline_digit' => '',
			'font_size' => '',
			'font_weight' => '',
			'digit_color' => '',
			'currency' => '',
			'title' => '',
			'title_color' => '',
			'text' => '',
			'text_color' => '',
			'padding_bottom' => '',
			'show_icon' => '',
			'custom_icon_size' => '',
			'icon_color' => ''
		);

		$args = array_merge($args, libero_mikado_icon_collections()->getShortcodeParams());
		$params = shortcode_atts($args, $atts);

		$params['counter_holder_styles'] = $this->getCounterHolderStyle($params);
		$params['counter_styles'] = $this->getCounterStyle($params);
		$params['counter_data'] = $this->getCounterData($params);
		$params['text_styles'] = $this->getCounterTextStyle($params);
		$params['title_styles'] = $this->getCounterTitleStyle($params);
		$params['icon_params'] = $this->getIconParameters($params);
		$params['counter_holder_classes'] = $this->getCounterHolderClasses($params);

		//Get HTML from template
		$html = libero_mikado_get_shortcode_module_template_part('templates/counter-template', 'counter', '', $params);

		return $html;

	}

	/**
	 * Return Counter holder styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getCounterHolderStyle($params) {
		$counterHolderStyle = array();

		if ($params['padding_bottom'] !== '') {

			$counterHolderStyle[] = 'padding-bottom: ' . $params['padding_bottom'] . 'px';

		}

		return implode(';', $counterHolderStyle);
	}

	/**
	 * Return Counter styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getCounterStyle($params) {
		$counter_style = array();

		if ($params['font_size'] !== '') {
			$counter_style[] = 'font-size: ' . libero_mikado_filter_px($params['font_size']) . 'px';
		}
		if ($params['digit_color'] !== '') {
			$counter_style[] = 'color: ' . $params['digit_color'];
		}

		if ($params['font_weight'] !== '') {
			$counter_style[] = 'font-weight: ' . $params['font_weight'];
		}

		return implode(';', $counter_style);
	}

	/**
	 * Return Counter data
	 *
	 * @param $params
	 * @return string
	 */
	private function getCounterData($params) {
		$counter_data = array();

		if ($params['font_size'] !== '') {
			$counter_data[] = 'data-digit-size= ' . libero_mikado_filter_px($params['font_size']);
		}
		else{
			$counter_data[] = 'data-digit-size= 75';
		}

		return implode(' ', $counter_data);
	}

	/**
	 * Return Counter Text styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getCounterTextStyle($params) {
		$text_style = array();

		if ($params['text_color'] !== '') {
			$text_style[] = 'color: ' . $params['text_color'];
		}

		return implode(';', $text_style);
	}


	/**
	 * Return Counter Title styles
	 *
	 * @param $params
	 * @return string
	 */
	private function getCounterTitleStyle($params) {
		$title_style = array();

		if ($params['title_color'] !== '') {
			$title_style[] = 'color: ' . $params['title_color'];
		}

		return implode(';', $title_style);
	}

	/**
	 * Return Counter Class
	 *
	 * @param $params, $icon_exist
	 * @return string
	 */
	private function getCounterHolderClasses($params) {
		$counter_holder_classes = array();

		if ($params['position'] !== '') {
			$counter_holder_classes[] = $params['position'];
		}

		return implode(' ', $counter_holder_classes);
	}

	/**
	 * Returns parameters for icon shortcode as a string
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getIconParameters($params) {
		$params_array = array();

		if ($params['show_icon'] == 'yes'){

			$icon_pack_name = libero_mikado_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);

			$params_array['icon_pack']   = $params['icon_pack'];
			$params_array[$icon_pack_name] = $params[$icon_pack_name];

			if($params_array[$icon_pack_name] !== ''){

				if(!empty($params['custom_icon_size'])) {
					$params_array['custom_size'] = $params['custom_icon_size'];
				}

				$params_array['type'] = 'normal';
				$params_array['icon_color'] = $params['icon_color'];
			}
		}

		return $params_array;
	}
}