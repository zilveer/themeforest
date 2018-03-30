<?php
namespace Libero\Modules\Shortcodes\VerticalSeparator;

use Libero\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class VerticalSeparator
 */
class VerticalSeparator implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'mkd_verticalsep';

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
	 */
	public function vcMap() {

		vc_map( array(
				'name' => 'Mikado Vertical Separator',
				'base' => $this->getBase(),
				'category' => 'by MIKADO',
				'icon' => 'icon-wpb-vert-sep extended-custom-icon',
				'allowed_container_element' => 'vc_row',
				'params' => array(
					array(
						"type" => "colorpicker",
						"holder" => "div",
						"class" => "",
						"heading" => "Color",
						"param_name" => "color",
						"value" => "",
						"description" => "Set the separator color. The default value is e8e8e8."
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => "Height (px)",
						"param_name" => "height",
						"value" => "",
						"description" => "Set the separator height. The default value is 15px."
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => "Margin Left (px)",
						"param_name" => "margin_left",
						"value" => ""
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => "Margin Right (px)",
						"param_name" => "margin_right",
						"value" => ""
					),
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => "Bottom Offset (px)",
						"param_name" => "bottom_offset",
						"value" => "",
						"description" => "Set the bottom offset for better centering, if needed."
					)
				)
		) );

	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'color' => '',
			'height' => '',
			'margin_left' => '',
			'margin_right' => '',
			'bottom_offset' => ''
		);

		$params = shortcode_atts($args, $atts);

		$params['separator_style'] = $this->getSeparatorStyle($params);

		//Get HTML from template
		$html = libero_mikado_get_shortcode_module_template_part('templates/vertical-sep-template', 'verticalseparator', '', $params);

		return $html;

	}

	/**
	 * Return Style for Vertical Separator
	 *
	 * @param $params
	 * @return string
	 */
	private function getSeparatorStyle($params) {
		$sep_style = array();

		if ($params['color'] !== '') {
			$sep_style[] = 'border-right-color: '.$params['color'];
		}

		if ($params['height'] !== '') {
			$sep_style[] = 'height: '.libero_mikado_filter_px($params['height']).'px';
		}

		if ($params['margin_left'] !== '') {
			$sep_style[] = 'margin-left: '.libero_mikado_filter_px($params['margin_left']).'px';
		}

		if ($params['margin_right'] !== '') {
			$sep_style[] = 'margin-right: '.libero_mikado_filter_px($params['margin_right']).'px';
		}

		if ($params['bottom_offset'] !== '') {
			$sep_style[] = 'margin-bottom: '.libero_mikado_filter_px($params['bottom_offset']).'px';
		}

		return implode(';', $sep_style);
	}
}